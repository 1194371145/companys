<?php

class performance extends control
{
    public $performance = array();

    /**
     * Construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);

       
        /* Load need modules. */
        $this->loadModel('tree');
        $this->loadModel('performance');
        
        /* Get all performance, if no, goto the create page. */
        $this->performance = $this->performance->getPairs('nocode');
        
        if(empty($this->performance) and strpos(',create,index,showerrornone,', $this->methodName) === false and $this->app->getViewType() != 'mhtml') $this->locate($this->createLink('product', 'create'));
        $this->view->performance = $this->performance;
    }


    /**
     * Edit a product.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function edit($productID, $action = 'edit', $extra = '')
    {
        if(!empty($_POST))
        {
            $changes = $this->product->update($productID); 
            if(dao::isError()) die(js::error(dao::getError()));
            if($changes)
            {
                $actionID = $this->loadModel('action')->create('product category', $productID, 'edited');
                $this->action->logHistory($actionID, $changes);
            }
            echo js::alert('Update success !');
            die(js::locate(inlink('all', "product=$productID"), 'parent'));
        }
        $classinfo = $this->dao->select('*')->from('zt_performancemaster')->where('id')->eq($productID)->fetch();
        $this->product->setMenu($this->performance, key($this->performance));
        $this->view->title      = $this->lang->product->edit." Product Category";
        $this->view->position[] = $this->view->title;
        $this->view->classinfo = $classinfo;
        $this->view->category = $this->product->dafenglei_select(0,0,$classinfo->f_id);
        $this->view->parameter = $this->product->get_paramter_checkbox();
        $this->view->selectedparameter = $this->product->get_paramter_checkbox($classinfo->param,$classinfo->id);
        $this->display();
    }

    /**
     * Delete a product.
     * 
     * @param  int    $productID 
     * @param  string $confirm    yes|no
     * @access public
     * @return void
     */
    public function delete($PID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->performance->confirmDelete, $this->createLink('performance', 'delete', "PID=$PID&confirm=yes")));
        }
        else
        {
            $this->loadModel('performance')->delete($PID);
            echo js::alert('Delete success !');
            die(js::locate($this->createLink('performance', 'all'), 'parent'));
        }
    }





    /**
     * Drop menu page.
     * 
     * @param  int    $productID 
     * @param  string $module 
     * @param  string $method 
     * @param  string $extra 
     * @access public
     * @return void
     */
    public function ajaxGetDropMenu($productID, $module, $method, $extra)
    {
		
        $this->view->link      = $this->loadModel('performance')->getProductLink($module, $method, $extra);
        $this->view->productID = $productID;
        $this->view->module    = $module;
        $this->view->method    = $method;
        $this->view->extra     = $extra;
        $circles = $this->dao->select('*')->from('zt_circletime')->where('status')->ne('hold')->orderBy('circle desc')->fetchAll();
        $this->view->circles  = $circles;
        
        $this->display();
    }




    /**
     * All performance list.
     * 
     * @param  string $status 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function all($CID = 20181,$status = 'all', $param = 0,$orderBy = 'zhouqi_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
    	
        $this->session->set('performanceList', $this->app->getURI(true));
        
        $this->loadModel('performance')->setMenu($this->performance,$CID);
        
        /* Load pager and get tasks. */
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
        
        
        if($status != 'bySearch')
        {
        	$perlists = $this->performance->getPerList($CID,$status, 30, $orderBy, $pager);
        }
        else
        {
        	$queryID=(int)$param;
        	if($queryID)
        	{
        		$query = $this->search->getQuery($queryID);
        		
        		if($query)
        		{
        			$this->session->set("performanceQuery",$query->sql);
        			$this->session->set("performanceForm",$query->form);
        		}
        		else
        		{
        			$this->session->set("performanceQuery","1 = 1");
        		}
        	}
        	else
        	{
        		if($this->session->performanceQuery == false) $this->session->set('performanceQuery', ' 1 = 1');
        	}
           
        	$where = $this->session->performanceQuery;
        	
        	$perlists = $this->performance->getsearch($CID,$where,$orderBy,$pager);
        		
        }
        foreach($perlists as $key => $value)
        {
           $totalscore = $this->performance->getTotalScore($value->staffcode,$value->zhouqi);
           $perlists[$key]->totalscore = $totalscore;
           $perlists[$key]->zhiwei = $this->dao->select('position')->from('zt_user')->where('account')->eq($value->staffcode)->fetch('position');
        }
        /* Build search form. */
        $actionURL = $this->createLink('performance', 'all', "CID=$CID&browseType=bySearch&queryID=myQueryID");
        $this->config->performance->search['onMenuBar'] = 'yes';
        $this->performance->buildSearchForm($CID, $this->performance, $queryID, $actionURL);
        if($status == "all")
        {
        	$tabstyle['all'] = "class='active'";
        }elseif($status == "open")
        {
           $tabstyle['open'] = "class='active'";
        }elseif($status == "submitted")
        {
           $tabstyle['submitted'] = "class='active'";
        }elseif($status == "close")
        {
           $tabstyle['close'] = "class='active'";
        }
        else{}
        $this->app->loadLang('my');
        $this->view->title        = "List";
        $this->view->position[]   = $this->lang->performance->allPerformance;
        $this->view->perlists     = $perlists;
        $this->view->pager        = $pager;
        $this->view->recTotal     = $pager->recTotal;
        $this->view->recPerPage   = $pager->recPerPage;
        $this->view->orderBy      = $orderBy;
        $this->view->CID      = $CID;
        $this->view->tabstyle      = $tabstyle;
        $this->view->searchForm=$this->fetch('search','buildForm',$this->config->register->searchre);
        $this->display();
    }
   
    /**
     * 
     * 
     */
     public function create()
     {
        	$ty = $this->loadModel('performance')->checkHRGroup();//var_dump($ty);die;
        	$zhuguan = $this->dao->select('supersid')->from('zt_user')->where('supersid')->eq($this->app->user->account)->fetch();//var_dump($zhuguan);die;
	        if($ty==false && $this->app->user->account != 'admin' && $zhuguan==false)
	        {
                echo js::error("No permission to open this page!");
				echo "<script type='text/javascript'>history.go(-1)</script>";
            }
     	$this->loadModel('performance')->setMenu($this->performance, $CID);
     	$this->performance->setMenu($this->performance, $CID);
     	if(!empty($_POST))
     	{
     		$CID = $this->loadModel('performance')->creategoal();
     		if(dao::isError()) die(js::error(dao::getError()));
			$this->loadModel('action')->create('performance', $CID, 'create');
			echo js::alert('Create successful ');
			die(js::locate($this->createLink('performance', 'all'), 'parent'));
     	}
     	
     	 $hr = $this->performance->checkHRGroup();
     	 if($hr===true && $this->app->user->account != 'admin')
     	 {
     	 	$tps = $this->dao->select('account,realname')->from('zt_user')->fetchAll();
     	 	foreach($tps as $k=>$v)
     	 	{
     	 		$names[$v->account]=$v->realname;
     	 	}
     	 }
     	 else 
     	 {
	     	$tp = $this->dao->select('account,realname')->from('zt_user')->where('supervise')->eq($this->app->user->realname)->fetchAll();
	     	foreach($tp as $key=>$value)
	     	{
	     		$names[$value->account]=$value->realname;
	     	}//var_dump($names);die;
     	 }
     	 
     	$zhouqi = $this->dao->select("*")->from('zt_circletime')->where('status')->eq("open")->OrderBy("id_desc")->limit("3")->fetchAll();
     	foreach($zhouqi as $kk=>$vv)
     	{
     		$tys[$vv->circle] = substr($vv->circle,0,4)." ".substr($vv->circle,4,1)."H";
     	}
     	$this->view->title        = "Add Performance Form";
     	$this->view->position[]   = "Add Performance Form";
     	$this->view->zhouqi= $tys;
     	$this->view->names = $names;
     	$this->view->Hr  =$hr;
     	$this->display();
     	
     }
     
 /** 
  * download 
  * @param int $PID
  * @access public
  * @return void
  */
     
  public function download($PID)
  { 
 	 //header("content-type:text/html;charset=utf8"); 
 	 if(empty($_POST))
      {
 		include '../../lib/PHPExcel/PHPExcel.php';
	 	include"../../lib/PHPExcel/PHPExcel/Reader/Excel2007.php";
	 	include '../../lib/PHPExcel/PHPExcel/Writer/Excel2007.php';
	 	include '../../lib/PHPExcel/PHPExcel/IOFactory.php';
	 	$re=$this->dao->select("*")->from('zt_performancemaster')->where('id')->eq($PID)/*->andwhere('status')->eq('close')*/->fetch();//var_dump($re);die;
	 	$arr = $this->dao->select("*")->from('zt_user')->where('account')->eq($re->staffcode)->fetch();
	 	$att = $this->dao->select("*")->from('zt_user')->where('account')->eq($arr->supersid)->fetch();
	 	$de = $this->dao->select('*')->from('zt_performanceitem')->where('mid')->eq($PID)->andWhere('itemfrom')->eq("S")->fetchAll();//var_dump($de);
	 	$ce = $this->dao->select("*")->from('zt_performanceability')->where('mid')->eq($PID)->OrderBy('category_asc')->fetchAll();//var_dump($ce);die;
        foreach($de as $k =>$v)
        {
        	if($v->itemfrom=="S")
        	{
             $tp += $v->weight * $v->scorebysuper;
        	}
        }
	 	foreach($ce as $ky=>$vy)
        {
        	$tat += $vy->weight * $vy->scorebysuper;
        }
        $bai1 = "0.7";
        $bai2 = "0.3";
        $total = ($tp*$bai1) + ($tat*$bai2);//获取到工作能力和工作内容的总分
	    $readob=PHPExcel_IOFactory::createReader('Excel2007');//var_dump($readob);die;
	    $readobb=$readob->load("../../www/data/notify/ppp.xlsx");//var_dump($readobb);die;
	    if($_POST['taitou']==""){$A1='';}
 		$readobb->getActiveSheet()->setCellValue("B3",$re->name);
 		$readobb->getActiveSheet()->setCellValue("E3",$arr->dept);
 		$readobb->getActiveSheet()->setCellValue("H3",$arr->position);
 		$readobb->getActiveSheet()->setCellValue("J2",$re->adddate);
 		$readobb->getActiveSheet()->setCellValue("J3",$arr->join);
 		$readobb->getActiveSheet()->setCellValue("B4",$re->zgname);
 		$readobb->getActiveSheet()->setCellValue("E4",$att->dept);
 		$readobb->getActiveSheet()->setCellValue("H4",$att->position);
 		$readobb->getActiveSheet()->setCellValue("B5",$re->zhouqi);
 		$readobb->getActiveSheet()->setCellValue("G5",$total);
 	   	$readobb->getActiveSheet()->insertNewRowBefore(16,1);
 	   	$readobb->getActiveSheet()->mergeCells('B16:C16'); 
 	   	$readobb->getActiveSheet()->mergeCells('E16:F16'); 
 	   	$readobb->getActiveSheet()->mergeCells('G16:H16'); 
 		$j=8;
if(count($de,1)<=7)
{
 		for($i=0;$i<count($de,1);$i++)
 	    { 
 	     $j++;
 		 $readobb->getActiveSheet()->setCellValue("A$j",$i+1);
 		 $readobb->getActiveSheet()->setCellValue("B$j",$de[$i]->goalitem);
 		 $readobb->getActiveSheet()->setCellValue("D$j",($de[$i]->weight)* "100"."%");
 		 $readobb->getActiveSheet()->setCellValue("E$j",$de[$i]->reviewbymyself);
 		 $readobb->getActiveSheet()->setCellValue("G$j",$de[$i]->reviewbysuper);
 		 $readobb->getActiveSheet()->setCellValue("I$j",$de[$i]->score);
 		 $readobb->getActiveSheet()->setCellValue("J$j",$de[$i]->scorebysuper);
 		 $readobb->getActiveSheet()->setCellValue("K$j",$de[$i]->weight*$de[$i]->scorebysuper); 
 		 $sumitem+=$de[$i]->weight*$de[$i]->scorebysuper;
 		}
 		//$readobb->getActiveSheet()->insertNewRowBefore(16, 1);
 		$readobb->getActiveSheet()->setCellValue("K17",$sumitem); 
 		$pt=19;
 		if(count($ce,1)==5)
 		{
 			
	 		for($i=0;$i<=4;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
	 		    //$readobb->getActiveSheet()->insertNewRowBefore(25, 1);
		 		$readobb->getActiveSheet()->setCellValue("K26",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B27",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B27')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C28",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C29",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C28')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A31","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
		 		$py=32;
			 		if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C39",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I39",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(38, 5);
				 	   	$readobb->getActiveSheet()->mergeCells('B38:I38'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J38:K38');
				 	   	$readobb->getActiveSheet()->mergeCells('B39:I39');
				 	   	$readobb->getActiveSheet()->mergeCells('J39:K39');
				 	   	$readobb->getActiveSheet()->mergeCells('B40:I40');
				 	   	$readobb->getActiveSheet()->mergeCells('J40:K40');
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C44",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I44",$re->supersignature);
			 		}
 		}
 		if(count($ce,1)==6)
 		{
 			
	 		for($i=0;$i<=5;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
	 		    //$readobb->getActiveSheet()->insertNewRowBefore(25, 1);
		 		$readobb->getActiveSheet()->setCellValue("K26",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B27",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B27')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C28",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C29",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C28')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A31","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
		 		$py=32;
			 		if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C39",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I39",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(38, 5);
				 	   	$readobb->getActiveSheet()->mergeCells('B38:I38'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J38:K38');
				 	   	$readobb->getActiveSheet()->mergeCells('B39:I39');
				 	   	$readobb->getActiveSheet()->mergeCells('J39:K39');
				 	   	$readobb->getActiveSheet()->mergeCells('B40:I40');
				 	   	$readobb->getActiveSheet()->mergeCells('J40:K40');
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C44",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I44",$re->supersignature);
			 		}
 		}
 		   if(count($ce,1)==7)
 		   {            
 		   	$readobb->getActiveSheet()->insertNewRowBefore(26, 1);
			$readobb->getActiveSheet()->mergeCells('B26:C26');
		    $readobb->getActiveSheet()->mergeCells('E26:H26');  
 		   	for($i=0;$i<=6;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
		 		     $readobb->getActiveSheet()->setCellValue("K27",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B28",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B28')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C29",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C30",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A32","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
                $py=33;   
 		        if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C40",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I40",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(38,5);
				 	   	$readobb->getActiveSheet()->mergeCells('B38:I38'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J38:K38');
				 	   	$readobb->getActiveSheet()->mergeCells('B39:I39');
				 	   	$readobb->getActiveSheet()->mergeCells('J39:K39');
				 	   	$readobb->getActiveSheet()->mergeCells('B40:I40');
				 	   	$readobb->getActiveSheet()->mergeCells('J40:K40');
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C45",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I45",$re->supersignature);
			 		}
 		   }
          if(count($ce,1)==8)
 		   {            
 		   	$readobb->getActiveSheet()->insertNewRowBefore(26, 2);
			$readobb->getActiveSheet()->mergeCells('B26:C26');
		    $readobb->getActiveSheet()->mergeCells('E26:H26');  
		    $readobb->getActiveSheet()->mergeCells('B27:C27');
		    $readobb->getActiveSheet()->mergeCells('E27:H27');
 		   	for($i=0;$i<=7;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
		 		     $readobb->getActiveSheet()->setCellValue("K29",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B29",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C30",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C31",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A33","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
                $py=34;   
 		        if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{ 
                          if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C41",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I41",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(39,5);
				 	   	$readobb->getActiveSheet()->mergeCells('B39:I39'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J39:K39');
				 	   	$readobb->getActiveSheet()->mergeCells('B40:I40');
				 	   	$readobb->getActiveSheet()->mergeCells('J40:K40');
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
				 	   	$readobb->getActiveSheet()->mergeCells('B43:I43');
				 	   	$readobb->getActiveSheet()->mergeCells('J43:K43');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   
					 		if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C45",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I45",$re->supersignature);
			 		}
 		   }
 		
}
if(count($de,1)<=10 && count($de,1)>7)
{        
	        $readobb->getActiveSheet()->insertNewRowBefore(17,2);
 	    	$readobb->getActiveSheet()->mergeCells('B17:C17'); 
 	   	    $readobb->getActiveSheet()->mergeCells('E17:F17');
 	   	    $readobb->getActiveSheet()->mergeCells('G17:H17');
 	   	    $readobb->getActiveSheet()->mergeCells('B18:C18'); 
 	   	    $readobb->getActiveSheet()->mergeCells('E18:F18');
 	   	    $readobb->getActiveSheet()->mergeCells('G18:H18');
		 for($i=0;$i<count($de,1);$i++)
		 	    { 
		 	     $j++;
		 		 $readobb->getActiveSheet()->setCellValue("A$j",$i+1);
		 		 $readobb->getActiveSheet()->setCellValue("B$j",$de[$i]->goalitem);
		 		 $readobb->getActiveSheet()->setCellValue("D$j",($de[$i]->weight)* "100"."%");
		 		 $readobb->getActiveSheet()->setCellValue("E$j",$de[$i]->reviewbymyself);
		 		 $readobb->getActiveSheet()->setCellValue("G$j",$de[$i]->reviewbysuper);
		 		 $readobb->getActiveSheet()->setCellValue("I$j",$de[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$j",$de[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$j",$de[$i]->weight*$de[$i]->scorebysuper); 
		 		 $sumitem+=$de[$i]->weight*$de[$i]->scorebysuper;
		 		}
		 		//$readobb->getActiveSheet()->insertNewRowBefore(16, 1);
		 		$readobb->getActiveSheet()->setCellValue("K19",$sumitem); 
		 		$pt=21;
        if(count($ce,1)==5)
 		{
 			
	 		for($i=0;$i<=4;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
	 		    //$readobb->getActiveSheet()->insertNewRowBefore(25, 1);
		 		$readobb->getActiveSheet()->setCellValue("K28",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B29",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C30",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C31",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A33","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
		 		$py=34;
			 		if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C41",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I41",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(40,5);
				 	   
				 	   	$readobb->getActiveSheet()->mergeCells('B40:I40');
				 	   	$readobb->getActiveSheet()->mergeCells('J40:K40');
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
				 	   	$readobb->getActiveSheet()->mergeCells('B43:I43'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J43:K43');
				 	   	$readobb->getActiveSheet()->mergeCells('B44:I44');
				 	   	$readobb->getActiveSheet()->mergeCells('J44:K44');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C46",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I46",$re->supersignature);
			 		}
 		}
        if(count($ce,1)==6)
 		{
 			
	 		for($i=0;$i<=5;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
	 		    //$readobb->getActiveSheet()->insertNewRowBefore(25, 1);
		 		$readobb->getActiveSheet()->setCellValue("K28",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B29",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C30",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C31",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A33","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
		 		$py=34;
			 		if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C41",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I41",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(40,5);
				 	   
				 	   	$readobb->getActiveSheet()->mergeCells('B40:I40');
				 	   	$readobb->getActiveSheet()->mergeCells('J40:K40');
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
				 	   	$readobb->getActiveSheet()->mergeCells('B43:I43'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J43:K43');
				 	   	$readobb->getActiveSheet()->mergeCells('B44:I44');
				 	   	$readobb->getActiveSheet()->mergeCells('J44:K44');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C46",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I46",$re->supersignature);
			 		}
 		}
 		if(count($ce,1)==7)
 		   {          
 		   	$readobb->getActiveSheet()->insertNewRowBefore(26, 1);
			$readobb->getActiveSheet()->mergeCells('B26:C26');
		    $readobb->getActiveSheet()->mergeCells('E26:H26');  
 		   	for($i=0;$i<=6;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
		 		     $readobb->getActiveSheet()->setCellValue("K29",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B30",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C31",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C32",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C32')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A34","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
                $py=35;   
 		        if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C42",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I42",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(41,5);
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
				 	   	$readobb->getActiveSheet()->mergeCells('B43:I43'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J43:K43');
				 	   	$readobb->getActiveSheet()->mergeCells('B44:I44');
				 	   	$readobb->getActiveSheet()->mergeCells('J44:K44');
				 	   	$readobb->getActiveSheet()->mergeCells('B45:I45');
				 	   	$readobb->getActiveSheet()->mergeCells('J45:K45');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C47",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I47",$re->supersignature);
			 		}
 		   
 		   }
 		if(count($ce,1)==8)
 		   {          
 		   	$readobb->getActiveSheet()->insertNewRowBefore(26, 2);
			$readobb->getActiveSheet()->mergeCells('B26:C26');
		    $readobb->getActiveSheet()->mergeCells('E26:H26');  
		    $readobb->getActiveSheet()->mergeCells('B27:C27');
		    $readobb->getActiveSheet()->mergeCells('E27:H27');
 		   	for($i=0;$i<=7;$i++)
	 	     {   
		 	     $pt++;
		 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
		 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
		 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
		 	 	 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
		 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
		 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
		 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
		 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
	 		 }
		 		     $readobb->getActiveSheet()->setCellValue("K30",$sumability);	
		 		     $readobb->getActiveSheet()->setCellValue("B31",$re->statement);
		 		     $readobb->getActiveSheet()->getStyle('B31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     //var_dump($re);die;
		 		     $readobb->getActiveSheet()->setCellValue("C32",$re->review_strength);
		 		     $readobb->getActiveSheet()->setCellValue("C33",$re->review_improve);
		 		     $readobb->getActiveSheet()->getStyle('C32')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		     $readobb->getActiveSheet()->getStyle('C33')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
		 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);//var_dump($get_zhouqi);die;
		 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
				$sted = $this->dao->select('*')->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();//var_dump($sted);die;
                $readobb->getActiveSheet()->setCellValue("A35","Goals for Next review Cycle（From：　".date("m/d/Y",strtotime($sted->periodbegin))."  To  ".date("m/d/Y",strtotime($sted->periodend))."）");		// 		if(count($fe,1)>5)
                $py=36;   
 		        if(count($fe,1)<=5)
			 		{
					 	for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C43",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I43",$re->supersignature);
			 		}
		 		elseif(count($fe,1)>5 && count($fe,1)<=10) 
			 		{  
			 			$readobb->getActiveSheet()->insertNewRowBefore(41,5);
				 	   	$readobb->getActiveSheet()->mergeCells('B41:I41');
				 	   	$readobb->getActiveSheet()->mergeCells('J41:K41');
				 	   	$readobb->getActiveSheet()->mergeCells('B42:I42');
				 	   	$readobb->getActiveSheet()->mergeCells('J42:K42');
				 	   	$readobb->getActiveSheet()->mergeCells('B43:I43'); 
				 	   	$readobb->getActiveSheet()->mergeCells('J43:K43');
				 	   	$readobb->getActiveSheet()->mergeCells('B44:I44');
				 	   	$readobb->getActiveSheet()->mergeCells('J44:K44');
				 	   	$readobb->getActiveSheet()->mergeCells('B45:I45');
				 	   	$readobb->getActiveSheet()->mergeCells('J45:K45');
			 			for($i=0;$i<=count($fe,1);$i++)
					 	{   if(!empty($fe[$i]->goalitem))
					 	    {
					 	     $py++;
					 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
					 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
					 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
					 	    }
					 	} 
					 	$readobb->getActiveSheet()->setCellValue("C48",$re->staffsignature);
				 		$readobb->getActiveSheet()->setCellValue("I48",$re->supersignature);
			 		}
 		   
 		   }
}
	    $wob = new PHPExcel_Writer_Excel2007($readobb);
		//$wob=PHPExcel_IOFactory::createWriter($readobb,"Excel2007");
	    $re=$this->dao->select("*")->from('zt_performancemaster')->where('id')->eq($PID)/*->andwhere('status')->eq('close')*/->fetch();
	    if(PATH_SEPARATOR!=":")
	    {
	    	$filename= $re->staffcode."_".$re->zhouqi."_"."Performance_Appraisal_Form"."_".$re->name.".xlsx";
	    }
	    else
	    {
	        $filename=iconv("UTF8", auto, $re->staffcode."_".$re->zhouqi."_"."Performance_Appraisal_Form"."_".$re->name).".xlsx";
	    }
		
		
		ob_end_clean();
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$filename");
		header("Cache-Control:max-age=0");
		$wob->save('php://output');
		}
 	
 }

 /**
  * Ajax
  * @access public
  * @return array
  */
public function ajaxgetjoindate()
	{  
	$result = $this->dao->select('*')->from('zt_user')
	          ->where('account')->eq(trim($this->post->name))
	          ->fetch();
	  $arr = $this->dao->select('*')->from('zt_user')->where('account')->eq($result->supersid)->fetch();
	  
		      $strarr = array("position"=>$result->position,"join"=>$result->join,"supervise"=>$result->supervise,"zgzhiwei"=>$arr->position,"department"=>$result->dept,"zgdept"=>$arr->dept);
		      echo json_encode($strarr);
		      exit;
	}    
     
     
     
     
     
     
     
     /**
      * review by staff
      * @param int $PID
      * @access public
      * @return void
      */
     public function review($PID)
     {
     	$get_master = $this->loadModel('performance')->getById($PID);//var_dump($get_master);die;
     	$get_user = $this->dao->select('*')->from('zt_user')->where('account')->eq($get_master->staffcode)->fetch();
     	$get_zgtitle = $this->dao->select('*')->from('zt_user')->where('account')->eq($get_user->supersid)->fetch();
     	$scoreobj = $this->performance->getTotalScore($get_master->staffcode,$get_master->zhouqi);
     	$this->performance->setMenu($this->performance, $get_master->zhouqi);
     	//$get_master = $this->performance->getById($PID);
     	$hrgroup = $this->performance->checkHRGroup();
        if($this->app->user->account != $get_master->staffcode && $this->app->user->account != "admin" && $hrgroup === false)
     	{
     	   die(js::error('You can not access this detail !'));
     	}
     	if(!empty($_POST))
     	{
     		if($this->app->user->account != $get_master->staffcode)
     		{
     			die(js::error("You can not save this form except $get_master->name !"));
     		}
     		if($get_master->status == "close" || $get_master->circlestatus == "close")
     		{
     		   die(js::error('You can not do any operation when status/circie time was closed !'));
     		}
     		if($scoreobj->total > 0) 
     		{
     		   die(js::error('You can not do any operation after supervisor reviewed !'));
     		}
     		//limit review in some time 
     		$limitbegin = strtotime($get_master->periodend) - 16*24*3600;
     		$limitend = $limitbegin + 25*24*3600; 
     		if(mktime() < $limitbegin || mktime() > $limitend)
     		{
     		   die(js::error('You only can fill out content between '.date("m/d/Y",$limitbegin) .' to '.date('m/d/Y',$limitend)));
     		}
     		
     		$changes = $this->performance->reviewmyself($PID);    		 
     		if($changes)
     		{
     			$actionID = $this->loadModel('action')->create('performance', $PID, 'summarize');
     			$this->action->logHistory($actionID, $changes);
     		}     		
     		echo js::alert("Save success !");
     		die(js::locate($this->createLink('performance', 'review', "PID=$PID"), 'parent'));
     	}
     	
     	$this->view->score = $scoreobj;
        $this->view->title        = "Review";
        $this->view->position[]   = "Review yourself";     	
     	$this->view->get_master = $get_master;
     	$this->view->get_user = $get_user;
     	$this->view->get_zgtitle = $get_zgtitle;
     	$this->view->get_item = $get_master->items;
     	$this->view->get_nextitem = $get_master->nextitems;
     	$this->view->actions  = $this->loadModel('action')->getList('performance', $PID);
     	$this->view->get_ability = $get_master->ability;
     	$this->display();
     }
     
     /**
      * review by staff
      * @param int $PID
      * @access public
      * @return void
      */
     public function superviserreview($PID)
     {
        $get_master = $this->loadModel('performance')->getById($PID);
        $get_user = $this->dao->select('*')->from('zt_user')->where('account')->eq($get_master->staffcode)->fetch();
     	$get_zgtitle = $this->dao->select('*')->from('zt_user')->where('account')->eq($get_user->supersid)->fetch();
     	$this->performance->setMenu($this->performance, $get_master->zhouqi);
     	$hrgroup = $this->performance->checkHRGroup();
     	if($this->app->user->account != $get_master->zgsid && $this->app->user->account != "admin" && $hrgroup === false)
     	{
     		die(js::error('You can not access this detail !'));
     	}
     	
     	//limit review in some time
     	$limitbegin = strtotime($get_master->periodend) - 5*24*3600;
     	$limitend = $limitbegin + 16*24*3600;
     	if(mktime() < $limitbegin || mktime() > $limitend)
     	{
     		//die(js::error('You only can review member between '.date("m/d/Y",$limitbegin) .' to '.date('m/d/Y',$limitend)));
     	}
     	if(!empty($_POST))
     	{
     		if($this->app->user->account != $get_master->zgsid)
     		{
     			die(js::error("You can not review this form except $get_master->zgname !"));
     		}
     		if($get_master->status == "close" || $get_master->circlestatus == "close")
     		{
     			die(js::error('You can not do any operation when status/circie time was closed !'));
     		}
     	    if(strlen($get_master->staffsignature) < 2)
     		{
     			die(js::error('You can not do any operation before team member sign off !'));
     		}     		

     				
     		$changes = $this->performance->superviserreview($PID);
     		if($changes)
     		{
     			$actionID = $this->loadModel('action')->create('performance', $PID, 'review');
     			$this->action->logHistory($actionID, $changes);
     		}
     		echo js::alert("Review success !");
     		die(js::locate($this->createLink('performance', 'superviserreview', "PID=$PID"), 'parent'));
     	}
     	$this->view->score = $this->performance->getTotalScore($get_master->staffcode,$get_master->zhouqi);
     	$this->view->title        = "Review";
     	$this->view->position[]   = "Superviser Review";
     	$this->view->get_master = $get_master;
     	$this->view->get_user = $get_user;
     	$this->view->get_zgtitle = $get_zgtitle;
     	$this->view->get_item = $get_master->items;
     	$this->view->get_nextitem = $get_master->nextitems;
     	$this->view->actions  = $this->loadModel('action')->getList('performance', $PID);
     	$this->view->get_ability = $get_master->ability;
     	$this->display();
     }     
     
     /**
      * export performancemaster
      * @param int $zhouqi
      * @access public
      * @return void
      */
     public function export($zhouqi)
     {  //print_r($zhouqi);die;
     	header("Content-type: text/html; charset=utf-8");
		include"../../lib/PHPExcel/PHPExcel.php";
		include"../../lib/PHPExcel/PHPExcel/IOFactory.php";
		$ob=new PHPExcel();
		$ob->getActiveSheet()->getColumnDimension('A')->setWidth(12);
		$ob->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$ob->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$ob->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$ob->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$ob->getActiveSheet()->getColumnDimension('F')->setWidth(30);
		$ob->getActiveSheet()->getColumnDimension('G')->setWidth(40);
		$ob->getActiveSheet()->getColumnDimension('H')->setWidth(40);
		$ob->getActiveSheet()->getColumnDimension('I')->setWidth(40);
		$ob->getActiveSheet()->getColumnDimension('J')->setWidth(12);
		$ob->getActiveSheet()->getColumnDimension('K')->setWidth(12);
		$ob->getActiveSheet()->getColumnDimension('L')->setWidth(12);
		$ob->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$getmaster = $this->dao->select('*')->from('zt_performancemaster')->where('zhouqi')->eq($zhouqi)->fetchAll();
		
		foreach($getmaster as $kk=>$vv)
		{
			$arr = $this->dao->select('*')->from('zt_user')->where('account')->eq($vv->staffcode)->fetch();
			$totals = $this->loadModel('performance')->getTotalScore($vv->staffcode,$vv->zhouqi);
			$re[$kk]['id']=$vv->id;
			$re[$kk]['staffcode']=$vv->staffcode;
			$re[$kk]['zhouqi']=$vv->zhouqi;
			$re[$kk]['name']=$vv->name;
			$re[$kk]['position']=$arr->position;
			$re[$kk]['zgstaffcode']=$arr->supersid;
			$re[$kk]['zgname']=$arr->supervise;
			$re[$kk]['statement']=$vv->statement;
			$re[$kk]['review_strength']=$vv->review_strength;
			$re[$kk]['review_improve']=$vv->review_improve;
			$re[$kk]['total']=$totals->total;
			$re[$kk]['status']=$vv->status;
		}
		$ob->getActiveSheet()->setCellValue('A1',"ID")
		                     ->setCellValue('B1',"Staff Code")
		                     ->setCellValue('C1',"Circle")
		                     ->setCellValue('D1',"Name")
		                     ->setCellValue('E1',"Position")
		                     ->setCellValue('F1',"Super Sid")
		                     ->setCellValue('G1',"Superviser")
		                     ->setCellValue('H1',"Employee's Statement")
		                     ->setCellValue('I1',"Employee's Strength")
		                     ->setCellValue('J1',"Improvements and development")
		                     ->setCellValue('K1',"Score")
		                     ->setCellValue('L1',"Status")
		                     ;
		                     
		$ob->getActiveSheet()->getStyle("A1:K1")->getFont()->setBold(true);
		$ss=2;
		
		foreach($re as $k=>$ve)
		{
			$ob->getActiveSheet()->setCellValue("A$ss",$ve['id'])
			                     ->setCellValue("B$ss",$ve['staffcode'])
			                     ->setCellValue("C$ss",$ve['zhouqi'])
			                     ->setCellValue("D$ss",$ve['name'])
			                     ->setCellValue("E$ss",$ve['position'])
			                     ->setCellValue("F$ss",$ve['zgstaffcode'])
			                     ->setCellValue("G$ss",$ve['zgname'])
			                     ->setCellValue("H$ss",$ve['statement'])
			                     ->setCellValue("I$ss",$ve['review_strength'])
			                     ->setCellValue("J$ss",$ve['review_improve'])
			                     ->setCellValue("K$ss",$ve['total'])
			                     ->setCellValue("L$ss",$ve['status'])
			                     ;
		$ob->getActiveSheet()->getStyle("A$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("B$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("C$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("D$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("E$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("F$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("G$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("H$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("I$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("J$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("K$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle("L$ss")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$ob->getActiveSheet()->getStyle( "A$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "B$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "C$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "D$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "E$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "F$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "G$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "H$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "I$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "J$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "K$ss")->getAlignment()->setShrinkToFit(true);
		$ob->getActiveSheet()->getStyle( "L$ss")->getAlignment()->setShrinkToFit(true);
		$ss++;
		}
		$ob->getActiveSheet()->setTitle("Performance_List"); 
		$wob=PHPExcel_IOFactory::createWriter($ob,'Excel5');
		if(PATH_SEPARATOR!=":"){$filename="Performance_List.xls";}else{$filename=iconv(auto,"UTF8" , "Performance_List").".xls";}
		ob_end_clean();
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$filename");
		header("Cache-Control:max-age=0");
		$wob->save('php://output');
		
		$this->display();
     }
     
     
     
     /**
      * superviser close the performance for team member
      * @param int $PID
      * @access public
      * @return void
      */
     public function close($PID,$confirm="no")
     {
        $masterinfo = $this->loadModel('performance')->getById($PID);
        $score = $this->performance->getTotalScore($masterinfo->staffcode,$masterinfo->zhouqi);
        if(strlen($masterinfo->supersignature) > 1 && $score->total > 0)
        {
        if($confirm == 'no')
        {
           die(js::confirm("Have you completed performance conversation with your team members before you 'CLOSE' his/her PERFORMANCE REVIEW？",$this->createLink('performance', 'close', "PID=$PID&confirm=yes"),$this->inlink('all')));
        }
        else 
        {
          $this->dao->update('zt_performancemaster')->set('status')->eq('close')->where('id')->eq($PID)->exec();
        }
          echo js::alert('Close success !');
          //echo js::locate($this->server->HTTP_REFERER,'parent');
          echo js::locate($this->createlink('performance','all','PID=20181'),'parent');
        }
        else
        {
           die(js::error('Your must fill out [Reviewer Signature & Date] and score for this member ! '));
        }
     }
     
     /**
      * import single excel file
      */
     public function import()
     {
        
     	if(isset($_POST))
     	{
     		if(!empty($_FILES['file']['tmp_name']))
     		{
     			if(strrchr($_FILES['file']['name'],".") == ".xls" || strrchr($_FILES['file']['name'],".") == ".xlsx")
     			{
     				$circlestatus = $this->dao->select('status')->from('zt_circletime')->where('circle')->eq($this->post->circle)->fetch('status');
     				if($circlestatus == "close") die(js::error('Can not import excel file when circle time was closed !'));
     				$this->loadModel('admin')->getDatabyExcelsFile($_FILES['file']['tmp_name'],$_FILES['file']['name'],$this->post->circle);
     				echo js::alert('Import success !');
     				echo js::locate($this->createlink('performance','all','CID='.$this->post->circle),'parent');
     			}
     		}
     	}
        $this->display();
     }
     /**
	 *Batch export zip file : user or manager
	 */
	 public function batchdownload()
	 {
		 if(!empty($_POST))
		 {
			include '../../lib/PHPExcel/PHPExcel.php';
	 		include '../../lib/PHPExcel/PHPExcel/IOFactory.php';
			$this->deldir("performancemaster/");
			if(in_array('all',$_POST['manager']) and !empty($_POST['manager']))
			{
				$pid=$this->getusermanager(array(),$_POST['zhouqi']);
				foreach($pid as $v)
				{
					$readobb=PHPExcel_IOFactory::load("../../www/data/notify/ppp.xlsx");
					$this->batchdownloadofdownload($v,$readobb);
					unset($readobb);
				}
				$this->downzip();

			}
			elseif(!empty($_POST['manager']))
			{
				$pid=$this->getusermanager($_POST['manager'],$_POST['zhouqi']);
				foreach($pid as $v)
				{
					$readobb=PHPExcel_IOFactory::load("../../www/data/notify/ppp.xlsx");
					$this->batchdownloadofdownload($v,$readobb);
					unset($readobb);
				}
				$this->downzip();
				
			}
			else
			{
				echo js::error("请选择导出人员");
			}
		 }
		 $manager= $this->dao->select("account,realname")->from("zt_user")->where("deleted")->eq(0)->andWhere("manager")->eq("Y")->orderBy("realname_asc")->fetchPairs('account',"realname");
		 $zhouqi=$this->dao->select("circle")->from("zt_circletime")->orderBy("circle_desc")->fetchPairs('circle',"circle");
		 $this->view->manager=$manager;
		 $this->view->zhouqi=$zhouqi;
		 $this->display();
	 }
	 /**
	 * zip performance 
	 */
	function downzip($filename='performance')
	{
		$zip = new ZipArchive();
		if($zip->open($filename.'.zip', ZIPARCHIVE::OVERWRITE)=== TRUE)
		{
			$this->zip("performancemaster/", $zip); 
			$zip->close(); 
			
			
			header("Cache-Control: max-age=0" );
			header("Content-Description: File Transfer" );
			header('Content-disposition: attachment; filename=' . basename ($filename.'.zip' ) ); 
			header("Content-Type: application/zip" ); 
			header("Content-Transfer-Encoding: binary" ); 
			header('Content-Length: ' . filesize($filename.'.zip')+100 ); 
			@readfile ($filename.'.zip'  );
			@unlink($filename.'.zip'  );
		}
	}
	function zip($path,$zip)
	{
		$handler=opendir($path); //打开当前文件夹由$path指定。
		while(($filename=readdir($handler))!==false){
			if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
				if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
					$this->zip($path."/".$filename, $zip);
				}else{ //将文件加入zip对象
					$zip->addFile($path."/".$filename);
				}
			}
		}
		@closedir($path);
	}
	/**
	* cancle performance file
	*/
	function deldir($dirName)
	{
		if(file_exists($dirName) && $handle=opendir($dirName))
		{         
			while(false!==($item = readdir($handle)))
			{            
				if($item!= "." && $item != "..")
				{                            
					unlink($dirName.'/'.$item);               
				}         
			}         
		closedir( $handle); 
		} 
	}
	/*
	*get user pid
	*/
	function getusermanager($sid,$zhouqi)
	{
	   $touser=$this->dao->select("account")->from("zt_user")->where("deleted")->eq(0)
		   ->beginIF(!empty($sid))->andWhere("supersid")->in($sid)->fi()->fetchPairs('account',"account");
	   $allpid=$this->dao->select('id')->from('zt_performancemaster')->where('staffcode')->in($touser)->andWhere('zhouqi')->eq($zhouqi)->fetchPairs("id","id");
	   return $allpid;

	}
	public function batchdownloadofdownload($PID,$readobb)
  { 
 	
	 	$re=$this->dao->select("*")->from('zt_performancemaster')->where('id')->eq($PID)/*->andwhere('status')->eq('close')*/->fetch();//var_dump($re);die;
	 	$de = $this->dao->select('*')->from('zt_performanceitem')->where('mid')->eq($PID)->fetchAll();//var_dump($de);
	 	$ce = $this->dao->select("*")->from('zt_performanceability')->where('mid')->eq($PID)->OrderBy('category_asc')->fetchAll();//var_dump($ce);die;

		foreach($de as $k =>$v)
        {
        	if($v->itemfrom=="S")
        	{
             $tp += $v->weight * $v->scorebysuper;
        	}
        }
	 	foreach($ce as $ky=>$vy)
        {
        	$tat += $vy->weight * $vy->scorebysuper;
        }
        $bai1 = "0.7";
        $bai2 = "0.3";
        $total = ($tp*$bai1) + ($tat*$bai2);

	    if($_POST['taitou']==""){$A1='';}
 		$readobb->getActiveSheet()->setCellValue("B3",$re->name);
 		$readobb->getActiveSheet()->setCellValue("E3",$re->department);
 		$readobb->getActiveSheet()->setCellValue("H3",$re->zhiwei);
 		$readobb->getActiveSheet()->setCellValue("J2",$re->adddate);
 		$readobb->getActiveSheet()->setCellValue("J3",$re->ruzhidate);
 		$readobb->getActiveSheet()->setCellValue("B4",$re->zgname);
 		$readobb->getActiveSheet()->setCellValue("E4",$re->zgdepartment);
 		$readobb->getActiveSheet()->setCellValue("H4",$re->zgzhiwei);
 		$readobb->getActiveSheet()->setCellValue("B5",$re->zhouqi);
 		$readobb->getActiveSheet()->setCellValue("G5",$total);

 	   	$readobb->getActiveSheet()->insertNewRowBefore(16,1);
 	   	$readobb->getActiveSheet()->mergeCells('B16:C16'); 
 	   	$readobb->getActiveSheet()->mergeCells('E16:F16'); 
 	   	$readobb->getActiveSheet()->mergeCells('G16:H16'); 
 		$j=8;
 		for($i=0;$i<count($de,1);$i++)
 	    { 
 	     $j++;
 		 $readobb->getActiveSheet()->setCellValue("A$j",$i+1);
 		 $readobb->getActiveSheet()->setCellValue("B$j",$de[$i]->goalitem);
 		 $readobb->getActiveSheet()->setCellValue("D$j",($de[$i]->weight)* "100"."%");
 		 $readobb->getActiveSheet()->setCellValue("E$j",$de[$i]->reviewbymyself);
 		 $readobb->getActiveSheet()->setCellValue("G$j",$de[$i]->reviewbysuper);
 		 $readobb->getActiveSheet()->setCellValue("I$j",$de[$i]->score);
 		 $readobb->getActiveSheet()->setCellValue("J$j",$de[$i]->scorebysuper);
 		 $readobb->getActiveSheet()->setCellValue("K$j",$de[$i]->weight*$de[$i]->scorebysuper); 
 		 $sumitem+=$de[$i]->weight*$de[$i]->scorebysuper;
 		}
 		$readobb->getActiveSheet()->setCellValue("K17",$sumitem);  
	 	$pt=19;
 		for($i=0;$i<=5;$i++)
 	     {   
	 	     $pt++;
	 		 $readobb->getActiveSheet()->setCellValue("A$pt",$ce[$i]->category);
	 		 $readobb->getActiveSheet()->setCellValue("B$pt",$ce[$i]->item);
	 		 $readobb->getActiveSheet()->setCellValue("D$pt",$ce[$i]->weight);
	 		 $readobb->getActiveSheet()->setCellValue("E$pt",$ce[$i]->reviewitem);
	 		 $readobb->getActiveSheet()->setCellValue("I$pt",$ce[$i]->score);
	 		 $readobb->getActiveSheet()->setCellValue("J$pt",$ce[$i]->scorebysuper);
	 		 $readobb->getActiveSheet()->setCellValue("K$pt",($ce[$i]->weight)*$ce[$i]->scorebysuper);
	 		 $sumability +=($ce[$i]->weight)*$ce[$i]->scorebysuper;
 		 }
 		     $readobb->getActiveSheet()->setCellValue("K26",$sumability);	
 		     $readobb->getActiveSheet()->setCellValue("B27",$re->statement);
 		     //var_dump($re);die;
 		     $readobb->getActiveSheet()->setCellValue("C28",$re->review_strength);
 		     $readobb->getActiveSheet()->setCellValue("C29",$re->review_improve);
 		$get_zhouqi = $this->loadModel('admin')->getnextzhouqi($re->zhouqi);
 		$fe = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($re->staffcode)->andWhere('zhouqi')->eq($get_zhouqi)->andWhere('itemfrom')->eq("S")->fetchAll();
		$dates = $this->dao->select("*")->from('zt_circletime')->where('circle')->eq($get_zhouqi)->fetch();
 		$readobb->getActiveSheet()->setCellValue("A31","Goals for Next review Cycle（From：　".$dates->periodbegin." To ".$dates->periodend.")");
 		if(count($fe,1)>5)
 	    {
	 	   	$readobb->getActiveSheet()->insertNewRowBefore(38, 2);
	 	   	$readobb->getActiveSheet()->mergeCells('B38:I38'); 
	 	   	$readobb->getActiveSheet()->mergeCells('J38:K38');
	 	   	$readobb->getActiveSheet()->mergeCells('B39:I39');
	 	   	$readobb->getActiveSheet()->mergeCells('J39:K39'); 
 	    }
 		$py=32;
	 	for($i=0;$i<=count($fe,1);$i++)
	 	{   
	 	     $py++;
	 		 $readobb->getActiveSheet()->setCellValue("A$py",$i+1);
	 		 $readobb->getActiveSheet()->setCellValue("B$py",$fe[$i]->goalitem);
	 		 $readobb->getActiveSheet()->setCellValue("J$py",$fe[$i]->weight);
	 	}    
             $rt = $readobb->getActiveSheet()->getCell("A39")->getValue();//var_dump($rt);die;
             if($rt!="Emplyee Signature & Date")
             {
 			 $readobb->getActiveSheet()->setCellValue("C41",$re->staffsignature);
	 		 $readobb->getActiveSheet()->setCellValue("I41",$re->supersignature);
             }
             else 
             {
              $readobb->getActiveSheet()->setCellValue("C39",$re->staffsignature);
	 		  $readobb->getActiveSheet()->setCellValue("I39",$re->supersignature);
             }
		$wob=PHPExcel_IOFactory::createWriter($readobb,"Excel2007");
	    $re=$this->dao->select("*")->from('zt_performancemaster')->where('id')->eq($PID)/*->andwhere('status')->eq('close')*/->fetch();
	    if(PATH_SEPARATOR!=":")
	    {
	    	$filename= $re->staffcode."_".$re->zhouqi."_"."Performance_Appraisal_Form"."_".$re->name.".xlsx";
	    }
	    else
	    {
	        $filename=iconv("UTF8", auto, $re->staffcode."_".$re->zhouqi."_"."Performance_Appraisal_Form"."_".$re->name).".xlsx";
	    }
		$filename=mb_convert_encoding($filename,"GBK",auto);
		$wob->save("./performancemaster/".$filename);
		unset($readobb);
		unset($wob);
 	
 }
  
 /*
  * 设置path路径，暂时设置6层。。。后续再改
  */
 public function updatepath()
 {    
 	$acc = $this->dao->select('*')->from('zt_user')->where('account')->notin('admin,silergyapi')->OrderBy('account')->fetchAll();
 	//var_dump($acc);die;
 	foreach($acc as $k=>$v)
 	{//var_dump($v->account);
 	    $t1 = $this->dao->select('*')->from('zt_user')->where('supersid')->eq($v->account)->fetchAll();
 	    if($t1)
 	    {
 	    	foreach($t1 as $k1=>$v1)
 	    	{
 	    		$str .= $v->account.";".$v1->account.";"."=";//var_dump($str);die;
 	    		$t2 = $this->dao->select('*')->from('zt_user')->where('supersid')->eq($v1->account)->fetchAll();
 	    		if($t2)
 	    		{
 	    			foreach($t2 as $k2=>$v2)
 	    			{
 	    			 $str .= $v->account.";".$v1->account.";".$v2->account.";"."=";	
 	    			 $t3 = $this->dao->select('*')->from('zt_user')->where('supersid')->eq($v2->account)->fetchAll();
 	    			 if($t3)
 	    			 {
 	    			 	foreach($t3 as $k3=>$v3)
 	    			 	{
 	    			 		$str .= $v->account.";".$v1->account.";".$v2->account.";".$v3->account.";"."=";
 	    			 		$t4 = $this->dao->select('*')->from('zt_user')->where('supersid')->eq($v3->account)->fetchAll();
 	    			 		if($t4)
 	    			 		{
	 	    			 		foreach($t4 as $k4=>$v4)
	 	    			 		{
	 	    			 			$str .= $v->account.";".$v1->account.";".$v2->account.";".$v3->account.";".$v4->account.";"."=";
	 	    			 			$t5 = $this->dao->select('*')->from('zt_user')->where('supersid')->eq($v4->account)->fetchAll();
	 	    			 			if($t5)
	 	    			 			{
	 	    			 				foreach($t5 as $k5=>$v5)
	 	    			 				{
	 	    			 					$str .= $v->account.";".$v1->account.";".$v2->account.";".$v3->account.";".$v4->account.";".$v5->account.";"."=";
	 	    			 					$t6 = $this->dao->select('*')->from('zt_user')->where('supersid')->eq($v5->account)->fetchAll();
	 	    			 					if($t6)
	 	    			 					{
	 	    			 						foreach($t6 as $k6=>$v6)
	 	    			 						{
	 	    			 							$str .= $v->account.";".$v1->account.";".$v2->account.";".$v3->account.";".$v4->account.";".$v5->account.";".$v6->account.";"."=";
	 	    			 						}
	 	    			 					}
	 	    			 				}
	 	    			 			}
	 	    			 		}
 	    			 		}
 	    			 	}
 	    			 }
 	    		   }
 	    		}
 	    	}
 	     
 	    }
 	   
 	}//var_dump($str);die;
 	$arr = explode("=",$str);//var_dump($arr);//die;
 	foreach($arr as $ks=>$vs)
 	{   
 		if(substr($vs,0,7) != "S00001;")
	 	{
	 		unset($vs);
	 	}
	 	else 
	 	{  
	 		$kp = substr($vs,-7);
	 		$jq = substr($kp,0,6);
	 	    $aty[$jq] = $vs;
	 	}
 	}//var_dump($aty);die;
 	foreach($aty as $kt => $vt)
 	{//var_dump($kt,$vt);die;
 		$this->dao->update('zt_user')->set('userpath')->eq($vt)->where('account')->eq($kt)->exec();
 	}
 }
/*
 * 上级间接查看下属考核情况
 */
 public function subordinates($CID = 20172,$program='normal',$param = 0, $orderBy = 'zhouqi_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
 {
 	$this->session->set('performanceList', $this->app->getURI(true));
    $this->loadModel('performance')->setMenu($this->performance,$CID);
    $this->app->loadClass('pager', true);
    $pager = new pager($recTotal, $recPerPage, $pageID);
    if($program =='normal')
    {
    $ty = $this->performance->getxiashu($CID,10,$orderBy, $pager);	
    }
    else 
    {
    	$queryID=(int)$param;
        	if($queryID)
        	{
        		$query = $this->search->getQuery($queryID);
        		
        		if($query)
        		{
        			$this->session->set("subQuery",$query->sql);
        			$this->session->set("subForm",$query->form);
        		}
        		else
        		{
        			$this->session->set("subQuery","1 = 1");
        		}
        	}
        	else
        	{
        		if($this->session->subQuery == false) $this->session->set('subQuery', ' 1 = 1');
        	}
           
        	$where = $this->session->subQuery;//var_dump($where);die;
        	
        	$ty = $this->performance->getxiashusearch($CID,$where,$orderBy,$pager);//var_dump($ty);die;
    }
    foreach($ty as $key => $value)
        {
           $totalscore = $this->performance->getTotalScore($value->staffcode,$value->zhouqi);
           $ty[$key]->totalscore = $totalscore;
           $ty[$key]->zhiwei = $this->dao->select('position')->from('zt_user')->where('account')->eq($value->staffcode)->fetch('position');
        }
        $this->config->performance->subordinates->search['actionURL']=$this->createLink('performance','subordinates',"CID=$CID&program=bysearch");
		$this->config->performance->subordinates->search['queryID']=$queryID;
		$this->view->searchForm=$this->fetch('search','buildForm',$this->config->performance->subordinates->search);
 	$this->view->perlists     = $ty;
    $this->view->pager        = $pager;
    $this->view->recTotal     = $pager->recTotal;
    $this->view->recPerPage   = $pager->recPerPage;
    $this->view->orderBy      = $orderBy;
    //$this->view->searchForm=$this->fetch('search','buildForm',$this->config->register->searchre);
 	$this->display();
 }
 /*
  *更新数据库（HR提供的关于添加QA质量的方法） 
  *  
  */
   public function update()
   {  
   $ty = $this->dao->select('*')->from('zt_performancemaster')->where('zhouqi')->eq('20181')->andwhere('status')->eq('open')->OrderBy('staffcode')->fetchAll();//var_dump($ty);die;
   	foreach($ty as $k=>$v)
   	{
   		$staff = $this->dao->select('*')->from('zt_user')->where('account')->eq($v->staffcode)->fetch();//var_dump($staff);die;
   		$re = $this->dao->select('*')->from('zt_performanceability')->where('mid')->eq($v->id)->fetchAll();
   		if($staff->dept =="DE" && $staff->manager =="Y")
   		{
   			
   			if(substr($re[0]->item,0,4)=="Team")
   			{
   			 $abilitys->addby = $this->app->user->realname;
     	 	 $abilitys->mid = $v->id;
     	 	 $abilitys->category=$this->lang->performance->decategory;
     	 	 $abilitys->biaoshi = '1';
     	 	 $abilitys->staffcode=$v->staffcode;
     	 	 $abilitys->zhouqi=$v->zhouqi;
     	 	 $abilitys->item=$this->lang->performance->deability;
     	 	 $abilitys->weight=$this->lang->performance->demanager;
   			for($j=0;$j<=7;$j++)
	     	 {
	     	  $abls->addby       =$abilitys->addby;
	     	  $abls->mid         =$abilitys->mid;
	     	  $abls->category    =$abilitys->category[$j];
	     	  $abls->biaoshi     =$abilitys->biaoshi;
	     	  $abls->staffcode   =$abilitys->staffcode;
	     	  $abls->zhouqi      =$abilitys->zhouqi;
	     	  $abls->item        =$abilitys->item[$j];
	     	  $abls->weight      =$abilitys->weight[$j];
	     	  $this->dao->insert('zt_performanceability')->data($abls)->exec();
	     	 }
   			}
   			else 
   			{
   			 $abilitys->addby = $this->app->user->realname;
     	 	 $abilitys->mid = $v->id;
     	 	 $abilitys->category=$this->lang->performance->decategory;
     	 	 $abilitys->biaoshi = '1';
     	 	 $abilitys->staffcode=$v->staffcode;
     	 	 $abilitys->zhouqi=$v->zhouqi;
     	 	 $abilitys->item=$this->lang->performance->deabilityz;
     	 	 $abilitys->weight=$this->lang->performance->demanager;
   			for($j=0;$j<=7;$j++)
	     	 {
	     	  $ablsz->addby       =$abilitys->addby;
	     	  $ablsz->mid         =$abilitys->mid;
	     	  $ablsz->category    =$abilitys->category[$j];
	     	  $ablsz->biaoshi     =$abilitys->biaoshi;
	     	  $ablsz->staffcode   =$abilitys->staffcode;
	     	  $ablsz->zhouqi      =$abilitys->zhouqi;
	     	  $ablsz->item        =$abilitys->item[$j];
	     	  $ablsz->weight      =$abilitys->weight[$j];
	     	  $this->dao->insert('zt_performanceability')->data($ablsz)->exec();
	     	 }	
   			}
   		}
   		if($staff->dept =="DE" && $staff->manager =="N")
   		{
   			if(substr($re[0]->item,0,4)=="Team")
   			{
   			 $abilitys->addby = $this->app->user->realname;
     	 	 $abilitys->mid = $v->id;
     	 	 $abilitys->category=$this->lang->performance->category;
     	 	 $abilitys->biaoshi = '1';
     	 	 $abilitys->staffcode=$v->staffcode;
     	 	 $abilitys->zhouqi=$v->zhouqi;
     	 	 $abilitys->item=$this->lang->performance->deabilitystaff;
     	 	 $abilitys->weight=$this->lang->performance->destaff;
   			for($j=0;$j<=5;$j++)
	     	 {
	     	  $abls->addby       =$abilitys->addby;
	     	  $abls->mid         =$abilitys->mid;
	     	  $abls->category    =$abilitys->category[$j];
	     	  $abls->biaoshi     =$abilitys->biaoshi;
	     	  $abls->staffcode   =$abilitys->staffcode;
	     	  $abls->zhouqi      =$abilitys->zhouqi;
	     	  $abls->item        =$abilitys->item[$j];
	     	  $abls->weight      =$abilitys->weight[$j];
	     	  $this->dao->insert('zt_performanceability')->data($abls)->exec();
	     	 }
   			}
   			else 
   			{
   			 $abilitys->addby = $this->app->user->realname;
     	 	 $abilitys->mid = $v->id;
     	 	 $abilitys->category=$this->lang->performance->category;
     	 	 $abilitys->biaoshi = '1';
     	 	 $abilitys->staffcode=$v->staffcode;
     	 	 $abilitys->zhouqi=$v->zhouqi;
     	 	 $abilitys->item=$this->lang->performance->deabilitystaffz;
     	 	 $abilitys->weight=$this->lang->performance->destaff;
   			for($j=0;$j<=5;$j++)
	     	 {
	     	  $abls->addby       =$abilitys->addby;
	     	  $abls->mid         =$abilitys->mid;
	     	  $abls->category    =$abilitys->category[$j];
	     	  $abls->biaoshi     =$abilitys->biaoshi;
	     	  $abls->staffcode   =$abilitys->staffcode;
	     	  $abls->zhouqi      =$abilitys->zhouqi;
	     	  $abls->item        =$abilitys->item[$j];
	     	  $abls->weight      =$abilitys->weight[$j];
	     	  $this->dao->insert('zt_performanceability')->data($abls)->exec();
	     	 }	
   			}
   		}
   		if($staff->dept !="DE" && $staff->manager =="Y")
   		{
   		
   			if(substr($re[0]->item,0,4)=="Team")
   			{
   			 $abilitys->addby = $this->app->user->realname;
     	 	 $abilitys->mid = $v->id;
     	 	 $abilitys->category=$this->lang->performance->categorypuj;
     	 	 $abilitys->biaoshi = '1';
     	 	 $abilitys->staffcode=$v->staffcode;
     	 	 $abilitys->zhouqi=$v->zhouqi;
     	 	 $abilitys->item=$this->lang->performance->abilitys;
     	 	 $abilitys->weight=$this->lang->performance->weightmanager;
   			for($j=0;$j<=6;$j++)
	     	 {
	     	  $abls->addby       =$abilitys->addby;
	     	  $abls->mid         =$abilitys->mid;
	     	  $abls->category    =$abilitys->category[$j];
	     	  $abls->biaoshi     =$abilitys->biaoshi;
	     	  $abls->staffcode   =$abilitys->staffcode;
	     	  $abls->zhouqi      =$abilitys->zhouqi;
	     	  $abls->item        =$abilitys->item[$j];
	     	  $abls->weight      =$abilitys->weight[$j];
	     	  $this->dao->insert('zt_performanceability')->data($abls)->exec();
	     	 }
   			}
   			else 
   			{
   			 $abilitys->addby = $this->app->user->realname;
     	 	 $abilitys->mid = $v->id;
     	 	 $abilitys->category=$this->lang->performance->categorypuj;
     	 	 $abilitys->biaoshi = '1';
     	 	 $abilitys->staffcode=$v->staffcode;
     	 	 $abilitys->zhouqi=$v->zhouqi;
     	 	 $abilitys->item=$this->lang->performance->abilityzg;
     	 	 $abilitys->weight=$this->lang->performance->weightmanager;
   			for($j=0;$j<=6;$j++)
	     	 {
	     	  $ablsz->addby       =$abilitys->addby;
	     	  $ablsz->mid         =$abilitys->mid;
	     	  $ablsz->category    =$abilitys->category[$j];
	     	  $ablsz->biaoshi     =$abilitys->biaoshi;
	     	  $ablsz->staffcode   =$abilitys->staffcode;
	     	  $ablsz->zhouqi      =$abilitys->zhouqi;
	     	  $ablsz->item        =$abilitys->item[$j];
	     	  $ablsz->weight      =$abilitys->weight[$j];
	     	  $this->dao->insert('zt_performanceability')->data($ablsz)->exec();
	     	 }	
   			}
   		}
   		if($staff->dept !="DE" && $staff->manager =="N")
   		{
	   		if(substr($re[0]->item,0,4)=="Team")
	   			{
	   			 $abilitys->addby = $this->app->user->realname;
	     	 	 $abilitys->mid = $v->id;
	     	 	 $abilitys->category=$this->lang->performance->categorputstaff;
	     	 	 $abilitys->biaoshi = '1';
	     	 	 $abilitys->staffcode=$v->staffcode;
	     	 	 $abilitys->zhouqi=$v->zhouqi;
	     	 	 $abilitys->item=$this->lang->performance->abilitysstaff;
	     	 	 $abilitys->weight=$this->lang->performance->weightstaff;
	   			for($j=0;$j<=4;$j++)
		     	 {
		     	  $abls->addby       =$abilitys->addby;
		     	  $abls->mid         =$abilitys->mid;
		     	  $abls->category    =$abilitys->category[$j];
		     	  $abls->biaoshi     =$abilitys->biaoshi;
		     	  $abls->staffcode   =$abilitys->staffcode;
		     	  $abls->zhouqi      =$abilitys->zhouqi;
		     	  $abls->item        =$abilitys->item[$j];
		     	  $abls->weight      =$abilitys->weight[$j];
		     	  $this->dao->insert('zt_performanceability')->data($abls)->exec();
		     	 }
	   			}
	   			else 
	   			{
	   			 $abilitys->addby = $this->app->user->realname;
	     	 	 $abilitys->mid = $v->id;
	     	 	 $abilitys->category=$this->lang->performance->categorputstaff;
	     	 	 $abilitys->biaoshi = '1';
	     	 	 $abilitys->staffcode=$v->staffcode;
	     	 	 $abilitys->zhouqi=$v->zhouqi;
	     	 	 $abilitys->item=$this->lang->performance->deabilitysputstaff;
	     	 	 $abilitys->weight=$this->lang->performance->weightstaff;
	   			for($j=0;$j<=4;$j++)
		     	 {
		     	  $ablsz->addby       =$abilitys->addby;
		     	  $ablsz->mid         =$abilitys->mid;
		     	  $ablsz->category    =$abilitys->category[$j];
		     	  $ablsz->biaoshi     =$abilitys->biaoshi;
		     	  $ablsz->staffcode   =$abilitys->staffcode;
		     	  $ablsz->zhouqi      =$abilitys->zhouqi;
		     	  $ablsz->item        =$abilitys->item[$j];
		     	  $ablsz->weight      =$abilitys->weight[$j];
		     	  $this->dao->insert('zt_performanceability')->data($ablsz)->exec();
		     	 }	
	   			}	
   		}
   	 }
   }
   /**
    * 设置公司层级
    */
   public function deeps()
   {
   	$allp = $this->dao->select('*')->from('zt_user')->where('account')->notin('admin,silergyapi')->OrderBy('account')->fetchAll();
    foreach($allp as $k=>$v)
    {
    	$ty = substr_count($v->userpath ,";");//var_dump($ty);die;
       	$this->dao->update('zt_user')->set('deep')->eq($ty)->where('account')->eq($v->account)->exec();
    }
   }
   
   public function see($PID)
   { 
   	$get_master = $this->loadModel('performance')->getById($PID);
    $get_user = $this->dao->select('*')->from('zt_user')->where('account')->eq($get_master->staffcode)->fetch();
    $get_zgtitle = $this->dao->select('*')->from('zt_user')->where('account')->eq($get_user->supersid)->fetch(); 
        $this->view->score = $this->performance->getTotalScore($get_master->staffcode,$get_master->zhouqi);
     	$this->view->title        = "view";
     	$this->view->position[]   = "view";
     	$this->view->get_master = $get_master;
     	$this->view->get_user = $get_user;
     	$this->view->get_zgtitle = $get_zgtitle;
     	$this->view->get_item = $get_master->items;
     	$this->view->get_nextitem = $get_master->nextitems;
     	$this->view->actions  = $this->loadModel('action')->getList('performance', $PID);
     	$this->view->get_ability = $get_master->ability;
   	$this->display();
   }
//整合18年1H未签核的人员
   public function getweishe()
   {
   	$getuser = $this->dao->select('*')->from('zt_user')->where('deleted')->eq(0)->fetchAll();
   	foreach($getuser as $v)
   	{
   	 $ty[$v->account] = $this->dao->select('*')->from('zt_performanceitem')->where('staffcode')->eq($v->account)->andwhere('zhouqi')->eq("20181")->fetch();	
   	 
   	}//var_dump($ty);die;
   	foreach($ty as $kk=>$vv)
   	{
   		if(empty($vv->id))
   		{
   			$at[$kk]=$kk;
   		}
   	}//var_dump($at);die;
   	//$rt = $this->dao->select("*")->from("zt_performancemaster")->where('staffcode')->in($at)->fetchAll();
   	$rt = $this->dao->select("*")->from("zt_user")->where('account')->in($at)->fetchAll();

   	    header("Content-type: text/html; charset=utf-8");
		include"../../lib/PHPExcel/PHPExcel.php";
		include"../../lib/PHPExcel/PHPExcel/IOFactory.php";
		$ob=new PHPExcel();
		$ss=2;
		foreach($rt as $k=>$v)
		{
		$ob->getActiveSheet()->setCellValue("A$ss",$v->account)
			                     ->setCellValue("B$ss",$v->realname)
			                     ->setCellValue("C$ss",$v->supervise)
			                     ->setCellValue("D$ss",$v->supersid)
			                     ->setCellValue("E$ss",$v->join)
			                     ;
			                     $ss++;
		}
		$ob->getActiveSheet()->setTitle("Performance_List"); 
		$wob=PHPExcel_IOFactory::createWriter($ob,'Excel5');
		if(PATH_SEPARATOR!=":"){$filename="Performance_List.xls";}else{$filename=iconv(auto,"UTF8" , "Performance_List").".xls";}
		ob_end_clean();
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$filename");
		header("Cache-Control:max-age=0");
		$wob->save('php://output');
   }
   /*将没有自动生成工作能力的项补缺（30%）
    * 单个补上的方法
    * 
    */
   public function xinzeng()
   {  
    $ty = $this->dao->select('*')->from('zt_performancemaster')->where('id')->eq("2093")->andwhere('zhouqi')->eq('20182')->fetch();
    //var_dump($ty);die;
    $mubiao = $lang->performance->abilitysstaff;
//    $arr1[1]['mid']= $ty->id;
//    $arr1[1]['staffcode']=$ty->staffcode;
//    $arr1[1]['item'] = '严格执行工作QA流程，防止品质问题，避免重复性错误';
//    $arr1[1]['weight'] ='0.1';
    
//    $arr1[2]['mid']= $ty->id;
//    $arr1[2]['staffcode']=$ty->staffcode;
//    $arr1[2]['item'] = '具备团队合作精神，能以大局为重，与同事良好配合,彼此体谅,不参与小团体。';
//    $arr1[2]['weight'] ='0.25';  
    
//    $arr1[3]['mid']= $ty->id;
//    $arr1[3]['staffcode']=$ty->staffcode;
//    $arr1[3]['item'] = '能有效与同事,上下级沟通，准确传递信息,不会因为沟通不畅影响或延缓工作。';
//    $arr1[3]['weight'] ='0.25'; 
    
//    $arr1[4]['mid']= $ty->id;
//    $arr1[4]['staffcode']=$ty->staffcode;
//    $arr1[4]['item'] = '敢于创新，能主动面对问题，解决问题。';
//    $arr1[4]['weight'] ='0.2'; 
    
    $arr1[5]['mid']= $ty->id;
    $arr1[5]['staffcode']=$ty->staffcode;
    $arr1[5]['item'] = '纪律性强，自觉遵守公司各项制度，不无故迟到早退或旷工；积极参加公司各项活动，关心公司发展并积极提出合理化建议。';
    $arr1[5]['weight'] ='0.2'; 
    //var_dump($arr1);die;
    foreach($arr1 as $k=>$v)
    {
    	$this->dao->insert('zt_performanceability')->data($v)->exec();var_dump($this->dao->get());
    }
   
   }
     
     
     
     
     
}
