<?php

class admin extends control
{


	/**
	 * Ignore notice of register and bind.
	 * 
	 * @access public
	 * @return void
	 */
	public function ignore()
	{
		$this->loadModel('setting')->setItem('system.common.global.community', 'na');
		die(js::locate(inlink('index'), 'parent'));
	}
	
    /**
     * catch data from some excel file to database
     * @access public
     * @return void
     */
    public function getDatabyExcels()
    {
     
      //$path = "../admin/tmpfile";
      $path = "../admin/newtmpfile2";	
      $filearr = scandir($path);
      //print_r($filearr);exit;
      foreach($filearr as $key => $value ) 
      {
      	if($key > 1)
      	{

      	   //$newfilename = substr($value,0,6);
      	   //copy($path.'/'.$value,$path2.$newfilename.'.xls');
      	   echo $value;
      	   $this->admin->getDatabyExcelsFile($path.'/'.$value,$value);
      	}
      }
      echo $key;
      die(js::alert('Capture success !'));
      
    }





    /**
     * Account safe.
     * 
     * @access public
     * @return void
     */
    public function safe()
    {
        if($_POST)
        {
            $data = fixer::input('post')->get();
            $this->loadModel('setting')->setItems('system.common.safe', $data);
            die(js::reload('parent'));
        }
        $this->view->title      = $this->lang->admin->safe->common . $this->lang->colon . $this->lang->admin->safe->set;
        $this->view->position[] = $this->lang->admin->safe->common;
        $this->display();
    }

    /**
     * check if can review and if in circle time
     * @param string $circletime
     * @access public
     * @return void
     */
    public function checkifvalid($circletime)
    {
       
    
    }
    
    
    
    
    /**
     * Check weak user.
     * 
     * @access public
     * @return void
     */
    public function checkWeak()
    {
        $this->view->title      = $this->lang->admin->safe->common . $this->lang->colon . $this->lang->admin->safe->checkWeak;
        $this->view->position[] = html::a(inlink('safe'), $this->lang->admin->safe->common);
        $this->view->position[] = $this->lang->admin->safe->checkWeak;
        $this->view->weakUsers  = $this->loadModel('user')->getWeakUsers();
        $this->display();
    }
    public function deletesameemail()
    {
       $list = $this->dao->select('id,username')->from('510_user')->fetchAll();
       foreach($list as $value)
       {
          $this->dao->delete()->from('510_user')->where('id')->ne($value->id)->andWhere('username')->eq($value->username)->exec();
       }
       echo "success";exit;
    }
    
    /**
     * get user data from ESPM system with API
     * 
     */
	public function synUserData()
    {
    	$sidresult =file_get_contents("http://192.168.5.8:8084/index.php?m=api&f=getSessionID&t=json");
    	$sidresulttmp = json_decode($sidresult);
    	$sessiondata = json_decode($sidresulttmp->data);
    	$sessionid = $sessiondata->sessionID;
    	
    	$loginjson = file_get_contents("http://192.168.5.8:8084/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyq1w2e3&t=json");
    	$loginobj = json_decode($loginjson);
    	
    	if($loginobj->status == 'success')
    	{
    		$userdata = file_get_contents("http://192.168.5.8:8084/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=getalluser&t=json");
    		$userdatatmp = json_decode($userdata);
    		$userarr = json_decode($userdatatmp->data,true);
            foreach($userarr as $value)
            {
               if($value['gender'] == "男") $gender = "m";
               if($value['gender'] == "女") $gender = "f";
               //$supersid = $this->dao->select('supersid')->from('zt_user')->where('account')->eq($value['staffcode'])->fetch('supersid');
               //if(strlen($supersid) < 2)
               //{
                  $supersid = $value['zgsid'];
               //}
               $data = array('account'=>$value['staffcode'],'supervise'=>$value['higherup'],'supersid'=>$supersid,'realname'=>$value['account'],'position'=>$value['zhiwei'],'password'=>$value['password'],'gender'=>$gender,'join'=>$value['ruzhidate']);
               $data['dept'] = $value['companyname'];
               $existID = $this->dao->select('id')->from('zt_user')->where('account')->eq($value['staffcode'])->fetch('id');
               if($existID > 0)
               {
                  ////$this->dao->update('zt_user')->data($data)->where('account')->eq($value['staffcode'])->exec();
               }
               else
               {
                  $this->dao->insert('zt_user')->data($data)->exec();
               }
            }
    	}
    	die(js::alert('Synchronize successfully !'));
    	exit;
    }

    /**
     * update manager flag
     */
    public function updateifmanager()
    {
    	include '../../lib/PHPExcel/PHPExcel.php';
    	include '../../lib/PHPExcel/PHPExcel/Reader/Excel5.php';
    	include '../../lib/PHPExcel/PHPExcel/IOFactory.php';
    	$phpob = PHPExcel_IOFactory::createReader('Excel5');
    	$phpobj = $phpob->load('manager22.xls');
    	$asvalue = $phpobj->getActiveSheet()->getCell("A2")->getValue();
    	$phpe = $phpobj->setActiveSheetIndex(0);
    	$countrows = $phpe->getHighestRow();
    	for($i = 1;$i < $countrows; $i++)
    	{
    	   $data[] = array('sid'=>trim($phpobj->getActiveSheet()->getCell("A".$i)->getValue()),'manager'=>trim($phpobj->getActiveSheet()->getCell("B".$i)->getValue()));
    	}
    	foreach($data as $value)
    	{
    	   $this->dao->update('zt_user')->set('manager')->eq($value['manager'])->where('account')->eq($value['sid'])->exec();
    	}
    	echo 'success';
    	exit;
    }
    
    /**
     * update promotion data
     */
    public function updatepromotion()
    {
    	include '../../lib/PHPExcel/PHPExcel.php';
    	include '../../lib/PHPExcel/PHPExcel/Reader/Excel5.php';
    	include '../../lib/PHPExcel/PHPExcel/IOFactory.php';
    	$phpob = PHPExcel_IOFactory::createReader('Excel5');
    	$phpobj = $phpob->load('promotionlist201801.xls');
    	$phpe = $phpobj->setActiveSheetIndex(0);
    	$countrows = $phpe->getHighestRow();
    	for($i = 1;$i < $countrows; $i++)
    	{
    	   if(strlen(trim($phpobj->getActiveSheet()->getCell("B".$i)->getValue())) > 2 )
    	   {
    	      $data[] = array('sid'=>trim($phpobj->getActiveSheet()->getCell("B".$i)->getValue()),'postition'=>trim($phpobj->getActiveSheet()->getCell("C".$i)->getValue()));
    	   }
    	}
    	foreach($data as $value)
    	{
    	   $this->dao->update('zt_user')->set('position')->eq($value['postition'])->where('account')->eq($value['sid'])->exec();
    	}
    	echo 'promotion success';
    	exit;
    }    
    /*
     * set circle time
     * @param string $type
     * @param string $confirm
     * @param int $id
     * @access public
     * @return void
     */
    public function setcircle($type = '',$confirm = 'no',$id = 0)
    {
       $listcircle = $this->dao->select('*')->from('zt_circletime')->orderby('circle desc')->fetchAll();
       $circle = $this->dao->select('*')->from('zt_circletime')->where('id')->eq($id)->fetch();
       
       if($_POST)
       {
          $data = fixer::input('post')->get();
          if($id > 0 && $type == "edit")
          {
             $this->dao->update('zt_circletime')->data($data)->where('id')->eq($id)->exec();
             if(dao::getError())
             {
             	die(js::error(dao::getError()));
             }
          }
          else 
          {
             $this->dao->insert('zt_circletime')->data($data)->exec();
             if(dao::getError())
             {
             	die(js::error(dao::getError()));
             }
             
          }
          echo js::alert('Operation success !');
          die(js::locate($this->createLink('admin', 'setcircle'), 'parent'));
       }
       if($id > 0 && $type == "del")
       {
       	if($confirm == 'no')
        {
        	die(js::confirm('Do you confirm delete ?', $this->createLink('admin', 'setcircle', "type=del&confirm=yes&id=".$circle->id)));
        }
        else
        {
        	
        	$this->dao->delete()->from('zt_circletime')->where('id')->eq($id)->exec();
        	if(dao::getError())
        	{
        	   die(js::error(dao::getError()));
        	}
        	echo js::alert('Delete success !');
            die(js::locate($this->createLink('admin', 'setcircle'), 'parent'));
        }
       }
       $this->view->title = "Set Circle";
       $this->view->position[] = "Set Circle";
       $this->view->listcircle = $listcircle;
       $this->view->circle = $circle;
       $this->display();
    }    
    
    
    /**
     * update performance master's supervisor and supervisor SID
     * @access public
     * @return void
     */
    public function updatesuperformaster()
    {
       $master = $this->dao->select('id,staffcode,zgname,zgsid')->from('zt_performancemaster')->fetchAll();
       foreach($master as $value)
       {
          $user = $this->dao->select('supervise,supersid')->from('zt_user')->where('account')->eq($value->staffcode)->fetch();
          if(strlen($user->supersid) > 1)
          {
             $this->dao->update('zt_performancemaster')->data(array('zgname'=>$user->supervise,'zgsid'=>$user->supersid))->where('id')->eq($value->id)->exec();
          }
       }
       
       echo "success !";exit;
    
    }
    
    public function addcaregoryone()
    {
       $sidlist = $this->dao->select('staffcode')->from('zt_performanceability')->where('zhouqi')->eq('20172')->groupby('staffcode')->fetchAll();
       foreach($sidlist as $value)
       {
          $category = $this->dao->select('category')->from('zt_performanceability')
                      ->where('staffcode')->eq($value->staffcode)
                      ->andWhere('zhouqi')->eq('20172')
                      ->andWhere('category')->eq(1)
                      ->fetch('category');
          $category2 = $this->dao->select('*')->from('zt_performanceability')
                      ->where('staffcode')->eq($value->staffcode)
                      ->andWhere('zhouqi')->eq('20172')
                      ->andWhere('category')->eq(2)
                      ->fetch();
          $allweight = $this->dao->select("weight")->from('zt_performanceability')
                         ->where('staffcode')->eq($value->staffcode)
                         ->andWhere('zhouqi')->eq('20172')
                         ->fetchAll();  
          $totalweight = 0; 
          foreach($allweight as $v)
          {
             $totalweight += $v->weight;
          }                      
          if($category > 0)            
          {
             
          }
          else
          {
             unset($category2->id);
             $category2->category = 1;
             $category2->item = "Team spirit, getting along with co-workers. Resolving confilict in a positive and constructive manner.";
             $category2->weight = 1 - $totalweight;
             //print_r($category2);
             //$this->dao->insert('zt_performanceability')->data($category2)->exec();
             echo "m<br/>";
          
          }
       }
       echo "success";exit;
    }
    
    
    /*
     * test analyse stdf file 
     */
    public function teststdf()
    { 

    	$filehander = fopen('test.std','r');

    	$file_read = fread($filehander,4);
    	//echo $file_read;
        //$arrdata = unpack('C6str',$file_read);
        echo bin2hex($file_read);exit;
        
        //print_r($arrdata);exit;
  /*       
  $file_type = "vnd.ms-excel";  
  $file_ending = "xls";  
  header("Content-Type: application/$file_type;charset=utf-8");  
  header("Content-Disposition: attachment; filename=testm".".$file_ending");  
  header("Pragma: no-cache");  
  */
        //echo $file_read;exit;
        foreach($arrdata as $value)
        {
           echo chr($value);
        }
        exit;
        
    
    }
    
   public function getallemial() 
   {
   	require_once('../../lib/PHPExcel/PHPExcel.php');
   	require_once('../../lib/PHPExcel/PHPExcel/IOFactory.php');
   	$parent = scandir("./Personalemail");
   	foreach($parent as $value)
   	{
   	   if($value != "." && $value != "..")
   	   {
   	      $child = scandir("./Personalemail/".$value);
   	     
   	      foreach($child as $subvalue)
   	      {
   	      	if($subvalue != "." && $subvalue != ".." && strpos($subvalue,'$') === false)
   	      	{
   	      		//$tmpfilepath = $subvalue;
   	      		
   	      		$ob = PHPExcel_IOFactory::load("./Personalemail/".$value."/".$subvalue);
   	      		
   	      		$sheetob=$ob->setActiveSheetIndex(0);
   	      		$allrows = $sheetob->getHighestRow();
   	      		if($allrows > 200) $allrows = 200;
   	      		
   	      		for($row=2; $row<=$allrows; $row++)
   	      		{
   	      			for($col="A";$col<="H";$col++)
   	      			{
   	      				if(strlen(trim($ob->getActiveSheet()->getCell("G$row")->getValue())) > 3)
   	      				{
   	      				   $arr[$row-1][$col] = trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
   	      				}
   	      			}

   	      		}
   	      		foreach($arr as $tmp)
   	      		{
   	      		   $tmparr = array('username'=>$tmp['A'],'engname'=>$tmp['B'],'dept'=>$tmp['C'],'title'=>$tmp['D'],'local'=>$tmp['F'],'email'=>$tmp['G']);
   	      		   $tmparr['SID'] = $this->dao->select("account")->from('zt_user')
   	      		   ->where(' ( realname')->eq($tmparr['username'])
   	      		   ->orWhere('realname')->eq($tmparr['engname'])
   	      		   ->markright(1)
   	      		   ->andWhere('dept')->eq($tmparr['dept'])
   	      		   ->fetch('account');
   	      		   $this->dao->insert('zt_tmpuserinfo')->data($tmparr)->exec();
   	      		   unset($tmparr);
   	      		}
               unset($arr);
   	      	}
   	      }
   	   }
   	}
   	echo "success";
   	exit;

   	exit;
   } 
   
   
   
   public function updateemail()
   {
      $users = $this->dao->select('email,account')->from('zt_user')->fetchAll();
      foreach($users as $user)
      {
         if(strlen($user->email) < 6)
         {
            $email = $this->dao->select('email')->from('zt_tmpuserinfo')->where('SID')->eq($user->account)->fetch('email'); 
            if($email)
            {
               $this->dao->update('zt_user')->data(array('email'=>$email))->where('account')->eq($user->account)->exec();
            }
         }
      }
      echo "success";exit;
   }   

}
