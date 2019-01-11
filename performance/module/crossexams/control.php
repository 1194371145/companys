<?php

class crossexams extends control
{
    public $performance = array();
    public $crossexams_all = array();
    public $crossexams_k = array();

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
        $this->loadModel('performance');
        /* Get all performance, if no, goto the create page. */
        $this->performance = $this->performance->getPairs('nocode');
        //抓取circletime 时间
        $time = date('Y-m-d');
        $circle = $this->dao->select('circle')->from('`zt_circletime`')
        									  ->where('`periodend`')->ge($time)
        									  ->andwhere('`periodbegin`')->le($time)
        									  ->fetch();

        // 指定固定的季度
        // $circle->circle = '20172';
                                              
        //获取到登录人的打分权限
        $result = $this->crossexams->getBySid($this->app->user->account,$circle->circle); 
        if ($result == false) 
        {
            $result = $this->crossexams->getBySid($this->app->user->account,'20172'); 
        }

        $this->crossexams_all = $result; //存取主表 信息
        foreach ($result as $k => $v) 
        { 
            if (strtoupper($v) == 'Y') 
            {
                $arr_crossexams[$k] = $k; //将能打分的权限存入到数组中
            }
        }
        $this->crossexams_k = $arr_crossexams;

    }
    public function import()
    {
    	header("content-type:text/html;charset=utf8");
		if(!empty($_FILES['file']))
		{   
			if(!empty($_FILES['file']['tmp_name']))
			{   
				include '../../lib/PHPExcel/PHPExcel.php';
				include '../../lib/PHPExcel/PHPExcel/IOFactory.php';
				$ob=PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
				$sheetob=$ob->setActiveSheetIndex(0);
				$allrows=$sheetob->getHighestRow();
				$A=trim($ob->getActiveSheet()->getCell("A3")->getValue());//var_dump($A);
				$B=trim($ob->getActiveSheet()->getCell("B3")->getValue());//var_dump($B);
				$C=trim($ob->getActiveSheet()->getCell("C3")->getValue());//var_dump($C);//die;
				if($A!='Department'&& $B!='SID' && $R!='Manager') 
				{
					die(js::alert("文件格式不正确 请下载正确的文件模板格式"));
					die(js::locate($this->createLink('crossexams', 'crosslist'), 'parent'));
				}
				$feild=array("A"=>"dept","B"=>"sid","C"=>"manager","D"=>"de","E"=>"Technology",
                             "F"=>"ae","G"=>"layout","H"=>"testdept","I"=>"qc",
                             "J"=>"operation","K"=>"ga","L"=>"marketing","M"=>"fae",
					         "N"=>"sales");
                      
				$success=0;
				$repeat=0;
				$fail=0;
				$Invalid=0;
				for($row=4; $row<=$allrows; $row++)
					{ 
					$data = array();
					for($col="A";$col<="N";$col++)
					{
						$data[$feild[$col]]=trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
					}
					
//					$data['finance'] = $data["General & Administration"];
//					$data['hr'] = $data["General & Administration"];
//					$data['it'] = $data["General & Administration"];
//					$data['legal'] = $data["General & Administration"];
//					$data['pr'] = $data["General & Administration"];
					if(empty($data['sid']) || empty($data['manager'])){$Invalid++;continue;}
					$get_period = $this->dao->select('*')->from('zt_circletime')->where('periodbegin')->lt(date("Y-m-d"))->andWhere('periodend')->gt(date("Y-m-d"))->fetch();
					//var_dump($get_period->circle);die;
					$data['circletime'] = $get_period->circle;
					//unset($data["General & Administration"]);
					$ty = $this->dao->select('*')->from('zt_crossexams')->where('sid')->eq($data['sid'])->andwhere('circletime')->eq($data['circletime'])->andwhere('dept')->eq($data['dept'])->fetch();
					
					if($ty)
					{
						die(js::error("chongfu"));$repeat++;continue;
					}
					else{
				    $this->dao->insert('zt_crossexams')->data($data)->exec();
				    if(dao::isError()){die(js::error(dao::getError()));}
                    $id=$this->dao->lastInsertID();
					if($id)
						{
								$success++;	
						}
						else 
						{
							   $fail++;
						}
					}                  
		     }
          echo "<script type='text/javascript'>alert('成功:$success"."条记录 \\n 重复：$repeat"."条记录\\n 无效：$Invalid"."条记录\\n 失败:$fail"."条记录');parent.location.reload();</script>";
		   		
			}

			else 
			{
				echo js::alert('请选择文件');
			}
		}
		$this->display();
	
    }

    //list 打分列表显示页面 根据季度来显示(20171,20172,20181)
    public function crosslist($program='normal',$circletime='20172',$recTotal = 0, $recPerPage = 10, $pageID = 1 , $orderBy='id_desc')
    {
        // setMenu
        $this->session->set('crossexamsList', $this->app->getURI(true));
        $this->loadModel('crossexams')->setMenu($this->performance, $circletime);
        
       $this->app->loadClass('pager', $static = true);
       $pager = new pager($recTotal, $recPerPage, $pageID);
       $sid =$this->crossexams_all->sid;
       if($program=='normal')     //正常情况下
	  {
       $data = $this->crossexams->getBySelf($circletime,$sid,$orderBy,$pager); //查询数据
	  }
	  else 
	  {
	  	$queryID=(int)$param;
            if ($queryID) 
              	{    
              		$query=$this->search->getQuery($queryID);
              	
              		if ($query) 
              		{
              			$this->session->set('crossQuery',$query->sql);
						$this->session->set('crossForm',$query->form);
              		}
              		else
              		{
              			$this->session->set('crossQuery',"1=1");
              		}
              	}
             
             $crossquery=$this->session->crossQuery;
             $data=$this->crossexams->getsearchBySelf($crossquery,$sid,$orderBy,$pager);
	  }
        $sel = empty($data[0]->circletime) ? $circletime : $data[0]->circletime;
	  	$selects = $this->dao->select()->from('`zt_circletime`')->fetchPairs('circle','circle'); //得到circle
	    $this->config->crossexams->crosslist->search['actionURL']=$this->createLink('crossexams','crosslist',"program=bysearch");
		$this->config->crossexams->crosslist->search['queryID']=$queryID;
		$this->view->searchForm=$this->fetch('search','buildForm',$this->config->crossexams->crosslist->search);
        $this->view->datas = $data;    //赋值数据
        $this->view->pager = $pager;
	    $this->view->orderBy=$orderBy;
	    $this->view->selects = $selects;
        $this->view->title = 'Cross Evaluation';
        $this->view->sel = $sel;
        $this->display();
    }




    //grade 主管打分表
    public function grades()
    {
        // setMenu
        $this->session->set('crossexamsList', $this->app->getURI(true));
        $this->loadModel('crossexams')->setMenu($this->performance, $circletime);
        if (!empty($_POST)) 
        {
            foreach ($_POST as $key => $value) 
            {
                if (strpos($key,'t_')) {
                    $arr_text[] = $value; //得到textarea数组
                } else {
                    $arr_star[] = $value; //得到star数组
                }
            }

            //数据验证
            for ($i=0; $i < count($arr_star) ; $i++) 
            { 
                if (empty($arr_star[$i]))  
                {
                    die(js::alert('Please fill out the form and submit it'));
                }
            }

            //阻止重复提交
            $sid = $this->crossexams_all->sid;
            $circle = $this->crossexams_all->circletime;
            $repeat = $this->dao->select()->from('`zt_examitems`')->where('`sid`')->eq($sid)->andwhere('`circletime`')->eq($circle)->count();
            if ($repeat > 0) {
            	echo js::alert('You have already submitted it');
            	die(js::locate($this->inlink('crosslist'),'parent'));
            }
            $arrAll = array_chunk($_POST, 6,true); //将数组按6个分割
            //执行数据验证和导入
            for ($i=0; $i < count($arrAll); $i++) 
            { 
                $crossexamsArr = array();
                foreach ($arrAll[$i] as $k => $v) 
                {
                    switch ($k) 
                    {
                        case 'text_de':
                            $crossexamsArr['item'] = 'DE';
                            break;
                        case 'text_technology':
                            $crossexamsArr['item'] = 'Technology（CAD/Device/IC Technology)';
                            break;
                        case 'text_ae':
                            $crossexamsArr['item'] = 'AE';
                            break;
                        case 'text_layout':
                            $crossexamsArr['item'] = 'Layout';
                            break;
                        case 'text_test':
                            $crossexamsArr['item'] = 'Test';
                            break;
                        case 'text_qa':
                            $crossexamsArr['item'] = 'QA（RE/FA /Quality Control）';
                            break;
                        case 'text_operation':
                            $crossexamsArr['item'] = 'Operation (Fab/Package/Assembly）';
                            break;
                        case 'text_general':
                            $crossexamsArr['item'] = 'General & Administration (Finance/Audit/IR/HR Software/IT/Legal/IP/Public Relationship)';
                            break;
                        case 'text_market':
                            $crossexamsArr['item'] = 'Marketing Incl. Marcom';
                            break;
                        case 'text_fae':
                            $crossexamsArr['item'] = 'FAE';
                            break;
                        case 'text_sales':
                            $crossexamsArr['item'] = 'Sales (Sales/CSR)';
                            break;
                        default:
                            break;
                    }

                    if (strpos($k , '0')) {
                        $crossexamsArr['professionality'] = $v;
                    } 
                    if (strpos($k , '1')) {
                        $crossexamsArr['cooperation'] = $v;
                    } 
                    if (strpos($k , '2')) {
                        $crossexamsArr['execution'] = $v;
                    } 
                    if (strpos($k , '3')) {
                        $crossexamsArr['responsibility'] = $v;
                    } 
                    if (strpos($k , '4')) {
                        $crossexamsArr['integrity'] = $v;
                    } 
                    if (strpos($k , '_')) {
                        $crossexamsArr['comment'] = strip_tags($v);
                    }

                }
        
                $crossexamsArr['sid'] = $this->crossexams_all->sid;
                $crossexamsArr['manager'] = $this->crossexams_all->manager;
                $crossexamsArr['circletime'] = $this->crossexams_all->circletime;
                //$crossexamsArr['company'] = $this->crossexams_all->company;
                $crossexamsArr['cid'] = $this->crossexams_all->id;
                //执行数据库写入
                $data = $this->crossexams->insert($crossexamsArr);
            }
           echo js::alert('Success');
           die(js::locate($this->inlink('crosslist'),'parent'));

        } 
        $this->view->title = 'Cross Table';
        $this->view->crossexams = $this->crossexams_k;
        $this->display();
    }

    //edit编辑
    public function edit($id)
    {
        $olddata = $this->dao->select()->from('`zt_examitems`')->where('`id`')->eq($id)->fetch(); // 得到原始数据
    	$name = $this->app->user->realname;
    	if (!empty($_POST)){
    	   $data = $this->dao->update('`zt_examitems`')->data($_POST)->where('`id`')->eq($_POST['id'])->exec();
    	   if ($data) 
    	   {
			$actionID=$this->loadModel('action')->create('crossexams',$id,"edit");  //操作记录
            if(common::createChanges($olddata, $_POST)) // 如果数据有改动 写入history表中
            {
                    $this->action->logHistory($actionID,common::createChanges($olddata,$_POST));
            }
    	      echo js::alert('modify successfully');
    	      die(js::locate($this->inlink('crosslist'),'parent'));
    	   } else {   	   	
    	    die(js::alert('You must have changes to submit'));
    	   }
    	} 
    	  $result = $this->crossexams->edit($id);
          $result->circletime = preg_replace('/(\d{4})(\d{1})/','$1 $2H', $result->circletime);
    	  $this->view->actions = $this->loadModel('action')->getList('crossexams',$id);
    	  $this->view->datas = $result;   
          $this->view->title = 'Cross Edit'; 
    	  $this->display(); 

    }
    public function export()
    {
    	if(!empty($_POST)){
        header("Content-type: text/html; charset=utf-8");
		include"../../lib/PHPExcel/PHPExcel.php";
		include"../../lib/PHPExcel/PHPExcel/IOFactory.php";
		$ob=new PHPExcel();	
		$ob->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$ob->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$ob->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$ob->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$ob->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$ob->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$ob->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$ob->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$ob->getActiveSheet()->getColumnDimension('I')->setWidth(60);
		$ob->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$ob->getActiveSheet()->getStyle( 'A2')->getFont()->setSize(15); 
		$ob->getActiveSheet()->getStyle( 'B2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'C2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'D2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'E2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'F2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'G2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'H2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'I2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle( 'J2')->getFont()->setSize(15);
		$ob->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$ob->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$get_exams = $this->dao->select('*')->from('zt_crossexams')->fetchAll();//var_dump($get_exams);die;
	    $get_list = $this->dao->select('*')->from('zt_examitems')->where('circletime')->eq($_POST['circle'])->beginIF(!empty($_POST['user']))->andWhere('sid')->in($_POST['user'])->fi()->fetchAll();
	    foreach($get_list as $k=>$vv)
			{
				//$data[$kk]['id']=$vv->id;
				$data[$k]['sid']=$vv->sid;
				$data[$k]['manager']=$vv->manager;
				$data[$k]['item']=$vv->item;
				/*if($vv->professionality == 1){$data[$k]['professionality'] = "Bad";}
				if($vv->professionality == 2){$data[$k]['professionality'] = "Qualified";}
				if($vv->professionality == 3){$data[$k]['professionality'] = "Common";}
				if($vv->professionality == 4){$data[$k]['professionality'] = "Favorable";}
				if($vv->professionality == 5){$data[$k]['professionality'] = "Excellent";}*/
				$data[$k]['professionality']=$vv->professionality;
			    /*if($vv->cooperation == 1){$data[$k]['cooperation'] = "Bad";}
				if($vv->cooperation == 2){$data[$k]['cooperation'] = "Qualified";}
				if($vv->cooperation == 3){$data[$k]['cooperation'] = "Common";}
				if($vv->cooperation == 4){$data[$k]['cooperation'] = "Favorable";}
				if($vv->cooperation == 5){$data[$k]['cooperation'] = "Excellent";}*/
				$data[$k]['cooperation']=$vv->cooperation;
			    /*if($vv->execution == 1){$data[$k]['execution'] = "Bad";}
				if($vv->execution == 2){$data[$k]['execution'] = "Qualified";}
				if($vv->execution == 3){$data[$k]['execution'] = "Common";}
				if($vv->execution == 4){$data[$k]['execution'] = "Favorable";}
				if($vv->execution == 5){$data[$k]['execution'] = "Excellent";}*/
				$data[$k]['execution']=$vv->execution;
			    /*if($vv->responsibility == 1){$data[$k]['responsibility'] = "Bad";}
				if($vv->responsibility == 2){$data[$k]['responsibility'] = "Qualified";}
				if($vv->responsibility == 3){$data[$k]['responsibility'] = "Common";}
				if($vv->responsibility == 4){$data[$k]['responsibility'] = "Favorable";}
				if($vv->responsibility == 5){$data[$k]['responsibility'] = "Excellent";}*/
				$data[$k]['responsibility']=$vv->responsibility;
			    /*if($vv->integrity == 1){$data[$k]['integrity'] = "Bad";}
				if($vv->integrity == 2){$data[$k]['integrity'] = "Qualified";}
				if($vv->integrity == 3){$data[$k]['integrity'] = "Common";}
				if($vv->integrity == 4){$data[$k]['integrity'] = "Favorable";}
				if($vv->integrity == 5){$data[$k]['integrity'] = "Excellent";}*/
				$data[$k]['integrity']=$vv->integrity;
				$data[$k]['comment']=$vv->comment;
				$data[$k]['circletime']=$vv->circletime;
			}
//		}var_dump($data);die;
		$ob->getActiveSheet()->setCellValue('A2',"Staff Code")
		                     ->setCellValue('B2',"Manager")
		                     ->setCellValue('C2',"Items")
		                     ->setCellValue('D2',"Professionality")
		                     ->setCellValue('E2',"Co-operation")
		                     ->setCellValue('F2',"Execution")
		                     ->setCellValue('G2',"Responsibility")
		                     ->setCellValue('H2',"Integrity")
		                     ->setCellValue('I2',"Other Comments")
		                     ->setCellValue('J2',"Circle");
		   $ss=3;                  
		 foreach($data as $ke=>$ve)
		 {                   
		 	$ob->getActiveSheet()->setCellValue("A$ss",$ve['sid'])
			                     ->setCellValue("B$ss",$ve['manager'])
			                     ->setCellValue("C$ss",$ve['item'])
			                     ->setCellValue("D$ss",$ve['professionality'])
			                     ->setCellValue("E$ss",$ve['cooperation'])
			                     ->setCellValue("F$ss",$ve['execution'])
			                     ->setCellValue("G$ss",$ve['responsibility'])
			                     ->setCellValue("H$ss",$ve['integrity'])
			                     ->setCellValue("I$ss",$ve['comment'])
			                     ->setCellValue("J$ss",$ve['circletime'])
			                     ;
		$ob->getActiveSheet()->getDefaultRowDimension("A$ss")->setRowHeight(30);
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
			                     $ss++;
		 }
		
		$ob->getActiveSheet()->setTitle("Cross Exams"); 
		$wob=PHPExcel_IOFactory::createWriter($ob,'Excel5');
		if(PATH_SEPARATOR!=":"){$filename="Cross Exams.xls";}else{$filename=iconv(auto,"UTF8" , "Cross Exams").".xls";}
		ob_end_clean();
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$filename");
		header("Cache-Control:max-age=0");
		$wob->save('php://output');
    	}
		$this->display();
		
    }



    //delect
    public function delete($id,$type='')
    {
        if ($type !== 'ok') {
            echo js::confirm('Are you sure you want to delete it', $this->inLink('delete',"id=$id&type=ok"), '', 'parent', '');
        } else {
           $result = $this->dao->delete()->from('`zt_examitems`')
               ->where('`id`')->eq($id)->exec();
           if ($result) 
           {
               // echo js::alert('Success');
               die(js::locate($this->inlink('crosslist'),'parent'));
           } else {
               echo js::alert('Fail');
           }
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
        $circles = $this->dao->select('*')->from('zt_circletime')->where('status')->eq('open')->orderBy('circle desc')->fetchAll();
        $this->view->circles  = $circles;

        $this->display();
    }



     
     
     
     
     
     
     
     
     
     
     
     
     
     
}
