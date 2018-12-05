<?php
/**
 * The model file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: model.php 2692 2012-03-02 08:55:37Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class projectModel extends model
{
    /* The members every linking. */
    const LINK_MEMBERS_ONE_TIME = 20;

    /**
     * Check the privilege. 
     * 
     * @param  object    $project 
     * @access public
     * @return bool
     */
    public function checkPriv($project)
    {
		if(trim($this->app->user->account) == trim($project->openby) ) return true;
        /* If is admin, return true. */
        $account = ',' . $this->app->user->account . ',';
        if(strpos($this->app->company->admins, $account) !== false) return true; 
        /* If project is open, return true. */
        if($project->acl == 'open') return true;

        /* Get team members. */
        $teamMembers = $this->getTeamMemberPairs($project->id);

        /* If project is private, only members can access. */
        if($project->acl == 'private')
        {
            return isset($teamMembers[$this->app->user->account]);
        }

        /* Project's acl is custom, check the groups. */
        if($project->acl == 'custom')
        {
			
			
            if(isset($teamMembers[$this->app->user->account])) return true;
            $userGroups    = $this->loadModel('user')->getGroups($this->app->user->account);
            $projectGroups = explode(',', $project->whitelist);
            foreach($userGroups as $groupID)
            {
                if(in_array($groupID, $projectGroups)) return true;
            }
            $openbyGroups = $this->loadModel('user')->getGroupsName($project->openby);
            $userGroup = $this->loadModel('user')->getGroupsName($this->app->user->account);
            //if(strpos($userGroup, $openbyGroups) !== false && $userGroup != $userGroups) return true;
			if(strpos($userGroup, $openbyGroups) !== false && strpos($userGroup,'manager') !== false) return true;
			
            return false;
        }
    }
    /**
     * Check approve privilege
     * @param object $project
     * @access public
     * @return bool
     */
    public function checkWgcPriv()
    {
       $project = $this->getById(intval($_GET['projectID']));
       //if(strpos($this->app->company->admins,$this->app->user->account) > 0 ) return true;
       $account = $this->app->user->account;
       if($project->acl != 'custom') return false;
       $userGroups    = $this->loadModel('user')->getGroups($this->app->user->account);
       $address = $this->user->getById($project->requestby);
       $managergroup = $this->lang->project->mgrgroup[$address->address]; 
       if(in_array($managergroup,$userGroups))
       {
          return true;
       }
       else 
       {
       	  
          return false;
       }      
    }
    //check if need ceo approve or not 
    public function checkAdminPriv()
    {
       if(strpos($this->app->company->admins.",issac",$this->app->user->account) > 0 )
       {
          return true;
       }
       else 
       {
          return false;
       }
       $projectID = intval($_GET['projectID']);
       $result = $this->dao->select('signature')->from(WGC_TABLE_APPROVE)->where('cid')->eq($projectID)->andWhere('role')->eq(0)->fetch();
       if(!$result) return false;
       if($result->signature == "reject") return true;
       if($result->signature == "approve") return false;
       
       return false;
    }
    //edit privilege
    public function checkEditPriv()
    {
       $projectID = intval($_GET['projectID']);
       $result = $this->dao->select('signature')->from(WGC_TABLE_APPROVE)->where('cid')->eq($projectID)->fetch();
       if($result) return false;
       $result2 = $this->dao->select('status')->from(WGC_TABLE_CUSTOM)->where('id')->eq($projectID)->fetch();
       if($result2->status != "Pending") return false;
       return true;
    }
    /**
     * get approve info by projectID
     * @param int $projectID
     * @access public
     * @return array
     */
    public function getApproveInfo($projectID)
    {
       $result = $this->dao->select('*')->from(WGC_TABLE_APPROVE)->where('cid')->eq($projectID)->andWhere('deleted')->eq(0)->fetchAll();
       if(!$result) return array();
       foreach($result as $key => $value)
       {
          $approveinfo[$value->role] = $value;
       }
       return $approveinfo;
    }
    
    /**
     * check the priv has mgr mgr
     */
    public function checkAdminGroup()
    {
        /* if is admin group return true */
        $admingroup = $this->dao->select('account')->from(TABLE_USERGROUP)->where('`group`')->eq(1)->fetchAll();
        if(isset($admingroup))
        {
           foreach($admingroup as $value)
           {
           	  $arradmingroups[] = $value->account;  
           }
           $admingroup = implode(',',$arradmingroups);
           if(strpos($admingroup,$this->app->user->account) !== false)
           {
              return true;
           }
           else 
           {
              return false;
           }
        }
        else
        {
           return false;
        }
    
    }
    /**
     * Set menu.
     * 
     * @param  array  $projects 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function setMenu($projects, $projectID)
    {
    	
        /* Check the privilege. */
        if($projects and !isset($projects[$projectID]) and !$this->checkPriv($this->getById($projectID)))
        {
            echo(js::alert($this->lang->project->accessDenied));
            die(js::locate('back'));
        }

        $moduleName = $this->app->getModuleName();
        $methodName = $this->app->getMethodName();
        $selectHtml = $this->select($projects, $projectID, $moduleName, $methodName);
        foreach($this->lang->project->menu as $key => $menu)
        {
            $replace = $key == 'list' ? $selectHtml . $this->lang->arrow : $projectID;
            common::setMenuVars($this->lang->project->menu, $key,  $replace);
        }
    }

    /**
     * Create the select code of projects. 
     * 
     * @param  array     $projects 
     * @param  int       $projectID 
     * @param  string    $currentModule 
     * @param  string    $currentMethod 
     * @access public
     * @return string
     */
    public function select($projects, $projectID, $currentModule, $currentMethod)
    {
        /* See product's model method:select. */
        $switchCode  = "switchProject($('#projectID').val(), '$currentModule', 'view');";
        $onchange    = "onchange=\"$switchCode\""; 
        $onkeypress  = "onkeypress=\"eventKeyCode=event.keyCode; if(eventKeyCode == 13) $switchCode\""; 
        $onclick     = "onclick=\"eventKeyCode = 13; $switchCode\""; 
        $selectHtml  = html::select('projectID', $projects, $projectID, "tabindex=2 $onchange $onkeypress");
        $selectHtml .= html::commonButton($this->lang->go, "id='projectSwitcher' tabindex=3 $onclick");
        return $selectHtml;
    }

    /**
     * Save the project id user last visited to session.
     * 
     * @param  int   $projectID 
     * @param  array $projects 
     * @access public
     * @return int
     */
    public function saveState($projectID, $projects)
    {
        if($projectID > 0) $this->session->set('project', (int)$projectID);
        if($projectID == 0 and $this->cookie->lastProject)    $this->session->set('project', (int)$this->cookie->lastProject);
        if($projectID == 0 and $this->session->project == '') $this->session->set('project', $projects[0]);
        if(!in_array($this->session->project, $projects)) $this->session->set('project', $projects[0]);
        return $this->session->project;
    }

    /**
     * Save order 
     * 
     * @access public
     * @return void
     */
    public function saveOrder()
    {
        foreach($_POST as $projectID => $order)
        {
            $this->dao->update(WGC_TABLE_CUSTOM)->set('`order`')->eq($order)->where('id')->eq($projectID)->exec();
        }
    }



    /*
     * insert visit note
     */
    public function createnote()
    {
    
    	$note = fixer::input('post')->get();
    	$this->dao->insert(WGC_TABLE_VISITNOTE)->data($note)
    	->batchcheck($this->config->project->createnote->requiredFields,'notempty')->exec();
    	
    }
    
    
    public function create($copyProjectID = '')
    {
    	
        $this->lang->project->team = $this->lang->project->teamname;
        $oldrfq = $this->getOldRfq($this->app->user->account,trim($this->post->partnumber),$this->post->distributor,$this->post->end_customer);
        //print_r($oldrfq);exit;
        $project = fixer::input('post')
            ->add('acl',"custom")
            ->add('status','Pending')
            ->add('openby',$this->app->user->account)
            ->add('oldrfq',$oldrfq)
            ->add('requestby',$this->app->user->id)
            ->add('whitelist', implode(',',$this->post->whitelist))
            ->add('createdate',date("Y-m-d"))
            ->get();
        if(floatval($this->app->post->price_cus)/floatval($this->app->post->price_dis) > 1.1 && $this->app->post->region == "CN") die(js::error('commission must less than or equal to 10%'));
        if(floatval($this->app->post->price_cus)/floatval($this->app->post->price_dis) > 1.11 && $this->app->post->region != "CN") die(js::error('commission must less than 11%'));
        $this->dao->insert(WGC_TABLE_CUSTOM)->data($project)
            ->autoCheck($skipFields = 'reason')
            ->batchcheck($this->config->project->create->requiredFields, 'notempty')
            ->checkIF($project->initial_date != '', 'date', 'date')
            ->checkIF($project->price_dis != '', 'price_cus', 'ge', $project->price_dis)
			//->checkIF($project->price_dis != '', 'commission', 'lt', '11')
            ->check('rfqcode', 'unique')
            ->exec();        
        $projectID     = $this->dao->lastInsertId();
        /* Add the creater to the team. */
        if(!dao::isError())
        {
            $today         = helper::today();
            $creatorExists = false;
            /* Copy team of project. */
            if($copyProjectID != '') 
            {
                $members = $this->dao->select('*')->from(TABLE_TEAM)->where('project')->eq($copyProjectID)->fetchAll();
                foreach($members as $member)
                {
                    $member->project = $projectID;
                    $member->join    = $today;
                    $this->dao->insert(TABLE_TEAM)->data($member)->exec();
                    if($member->account == $this->app->user->account) $creatorExists = true;
                }
            }

            /* Add the creator to team. */
            if($copyProjectID == '' or !$creatorExists)
            {
                $member->project  = $projectID;
                $member->account  = $this->app->user->account;
                $member->join     = $today;
                $member->days     = $project->days;
                $member->hours    = $this->config->project->defaultWorkhours;
                $this->dao->insert(TABLE_TEAM)->data($member)->exec();
            }
          
            return $projectID;
        } 
    }    
    
    
    /**
     * Update a rfq info .
     * 
     * @param  int    $projectID 
     * @access public
     * @return array
     */
    public function update($projectID)
    {
        $oldProject = $this->getById($projectID);
        $team = $this->getTeamMemberPairs($projectID);
        $this->lang->project->team = $this->lang->project->teamname;
        $projectID = (int)$projectID;
        $project = fixer::input('post')
            ->stripTags('end_customer')
            ->add('whitelist','1,8')
            ->get();

        if(floatval($this->app->post->price_cus)/floatval($this->app->post->price_dis) > 1.1 && $this->app->post->region == "CN") die(js::error('commission must less than or equal to 10%'));
        if(floatval($this->app->post->price_cus)/floatval($this->app->post->price_dis) > 1.11 && $this->app->post->region != "CN") die(js::error('commission must less than 11%'));            
        $this->dao->update(WGC_TABLE_CUSTOM)->data($project)
            ->batchcheck($this->config->project->edit->requiredFields, 'notempty')          
            ->check('rfqcode', 'unique', "id!=$projectID")
            ->where('id')->eq($projectID)
            ->limit(1)
            ->exec();
           

        //echo "<script>alert('".serialize($oldProject)."');</script>";

        
        if(!dao::isError()) return common::createChanges($oldProject, $project);
    }
    /*
     * cancel rfq
     * @param int $projectID
     * @return bool
     */
    public function cancelrfq($projectID)
    {
       
       $res = $this->dao->update(WGC_TABLE_CUSTOM)->set('status')->eq('cancel')->where('id')->eq($projectID)->exec();
       if($res) return true;
       return false;
    }
    /**
     * Update approve info 
     * @access public
     * @return array
     */
    public function updateApprove($projectID=0)
    {
       $projectID = intval($projectID);
       $oldapproinfo = $this->dao->select('*')->from(WGC_TABLE_CUSTOM)->where('id')->eq($projectID)->fetch();    		
       if($oldapproinfo->status == "Cancel")
       { 
          echo js::error("Cancelled quotation cannot be modified"); 
          exit;
       }      
       if(isset($_POST['mgrprice']) || isset($_POST['mgrcomment']) || isset($_POST['mgrsignature']))
       {
       	  $oldapproinfo = $this->dao->select('*')->from(WGC_TABLE_APPROVE)->where('cid')->eq($projectID)->andWhere('role')->eq(0)->fetch();
       	  
       	  if(isset($_POST['mgrprice']) && trim($_POST['mgrsignature']) != "reject") 
       	  {
       	    if(!is_numeric($_POST['mgrprice']) || $_POST['mgrprice'] < 0)
       	  	{
       	  	 echo js::error("Please input numeric !");
       	  	 exit;
       	  	}
       	  }
          $mgrdata = array('cid'=>$projectID,'role'=>0,'signdate'=>helper::today(),'comment'=>$oldapproinfo->comment,'signature'=>$oldapproinfo->signature);
		  $mgrdata['price'] = $oldapproinfo->price;
          $mgrdata['comment'] = $oldapproinfo->comment;
          $mgrdata['signature'] = $oldapproinfo->signature;
          if(trim($this->post->mgrprice) != "") $mgrdata['price'] = trim($this->post->mgrprice);
          if(trim($this->post->mgrcomment) != "") $mgrdata['comment'] = trim($this->post->mgrcomment);
          if(trim($this->post->mgrsignature) != "") $mgrdata['signature'] = trim($this->post->mgrsignature);          
          
          $this->dao->replace(WGC_TABLE_APPROVE)->data($mgrdata)->exec();
          if(trim($_POST['mgrsignature']) == "reject")
          {
             $this->dao->update(WGC_TABLE_APPROVE)->data(array('signature'=>"reject"))->where('cid')->eq($projectID)->andWhere('role')->eq(4)->exec();
          }
          $this->updateStatus($projectID);
          if(!dao::isError()) return common::createChanges($oldapproinfo, $mgrdata);
          
       }
       if(isset($_POST['ceoprice']) || isset($_POST['ceocomment']) || isset($_POST['ceosignature']))
       {
       	  $oldapproinfo = $this->dao->select('*')->from(WGC_TABLE_APPROVE)->where('cid')->eq($projectID)->andWhere('role')->eq(4)->fetch();
       	  if(isset($_POST['ceoprice']) )
       	  { 
       	  	if(!is_numeric($_POST['ceoprice']) || $_POST['ceoprice'] < 0)
       	  	{
       	  	 echo js::error("Please input numeric !");
       	  	 exit;
       	  	}
       	  }
          $mgrdata = array('cid'=>$projectID,'role'=>4,'signdate'=>helper::today(),'comment'=>$oldapproinfo->comment,'signature'=>$oldapproinfo->signature);
		  $mgrdata['price'] = $oldapproinfo->price;
          $mgrdata['comment'] = $oldapproinfo->comment;
          $mgrdata['signature'] = $oldapproinfo->signature;
          if(trim($this->post->ceoprice) != "") $mgrdata['price'] = trim($this->post->ceoprice);
          if(trim($this->post->ceocomment) != "") $mgrdata['comment'] = trim($this->post->ceocomment);
          if(trim($this->post->ceosignature) != "") $mgrdata['signature'] = trim($this->post->ceosignature);
          $this->dao->replace(WGC_TABLE_APPROVE)->data($mgrdata)->exec();
          $this->updateStatus($projectID);
          if(!dao::isError()) return common::createChanges($oldapproinfo, $mgrdata);
       } 
         

    }
    
    /**
     * update request quotation status and active by approve info
     * @param int $projectID
     * @access public
     * @return void
     */
    public function updateStatus($projectID = 0)
    {
       $projectinfo = $this->getById($projectID);
       $statusinfo = $this->dao->select('role,signature')->from(WGC_TABLE_APPROVE)->where('cid')->eq($projectID)->fetchAll();
       $lowprice = $this->dao->select('partnumber,mgrprice,ceoprice')
                             ->from(WGC_TABLE_LOWPRICE)
                             ->where('partnumber')->eq(strtoupper(trim($projectinfo->partnumber)))
                             ->andWhere('mgrprice')->gt(0)
                             ->fetch();
       if(!isset($statusinfo))
       { 
       	   $statusstr = "Pending";
       }
       else
       {
          foreach($statusinfo as $key => $value)
          {
             $tmp[$value->role] = $value->signature;
          }
       if(!$lowprice)
       {
          if($tmp[0] == "approve" && $tmp[4] == "reject")
          {
             $statusstr = "Reject";
          }
          elseif($tmp[0] == "approve" && $tmp[4] != "reject" &&  $tmp[4] != "approve")
          {
             $statusstr = "Pending";
          }         
          elseif(!isset($tmp[0]) && $tmp[4] == "reject")
          {
             $statusstr = "Reject";
          }
          elseif($tmp[0] == "reject" || $tmp[4] == "reject")
          {
             $statusstr = "Reject";
          }
          elseif($tmp[4] == "approve")
          {
             $statusstr = "Approved";
          }
          else 
          {
             $statusstr = "Pending";
          }
       }
       else
       {
          $lowmgrprice = $lowprice->mgrprice;
          $lowceoprice = $lowprice->ceoprice;
          if($tmp[0] == "approve" && $this->post->mgrprice >= $lowmgrprice && $lowmgrprice > 0 && $tmp[4] != "reject")
          {
             $statusstr = "Approved";
          }
          elseif($tmp[0] == "approve" && $this->post->mgrprice < $lowmgrprice && $tmp[4] != "reject" &&  $tmp[4] != "approve")
          {
             $statusstr = "Pending";
          }         
          elseif($tmp[4] == "reject")
          {
             $statusstr = "Reject";
          }
          elseif($tmp[4] == "approve")
          {
             $statusstr = "Approved";
          }
          else 
          {
             $statusstr = "Pending";
          }
          
       }

       }
       $updatedate = array('status'=>trim($statusstr));
       if($statusstr == "Approved" && ($this->post->ceoprice > 0 || $this->post->mgrprice > 0))
       {
       	  if($this->post->ceoprice > 0)
       	  {
             $updatedate['price_dis'] = $this->post->ceoprice;
			 /*
			 if($projectinfo->region == "china")
             {
                $updatedate['price_cus'] = $this->post->ceoprice*$projectinfo->commission + $this->post->ceoprice;
             }
             else 
             {
                $updatedate['price_cus'] = $projectinfo->price_cus*$projectinfo->commission + $this->post->ceoprice;
             }
			 */

       	  }
       	  else
       	  {
       	     $updatedate['price_dis'] = $this->post->mgrprice;
       	  }
       }
       $this->dao->update(WGC_TABLE_CUSTOM)->data($updatedate)->where('id')->eq($projectID)->exec();           
       if($statusstr == "Approved")
       {
       	 $projectinfo = $this->getById($projectID);
   	      //update cancel      	  
          $this->dao->update(WGC_TABLE_CUSTOM)->data(array('status'=>'Cancel'))
                    ->where('status')->eq('Approved')
                    ->andWhere('openby')->eq($projectinfo->openby)
                    ->andWhere('partnumber')->eq($projectinfo->partnumber)
                    ->andWhere('distributor')->eq($projectinfo->distributor)
                    ->andWhere('end_customer')->eq($projectinfo->end_customer)
                    ->andWhere('`date`')->lt($projectinfo->date)
                    ->exec();
         //save quotation info to SBO by DI API
         
		 //$this->saveQuotationToSBO($projectinfo,"old_SLGKM01");
		
		 $this->saveQuotationToSBO($projectinfo,"SLGHZ05");
         //$this->saveQuotationToSBO($projectinfo,"SLGKM01");
         //$this->saveQuotationToSBO($projectinfo,"SLGNJ06");
         
       }
    }
    
    
    /*
     * save quotation info to SBO by DI API
     * @param str $DB
     * @return int  
     */
    public function saveQuotationToSBO($projectinfo,$DB = 'SLGKM02')
    {
         $mycomp = $this->dao->connectToSBO($DB);
         if($mycomp->Connect == 0)
         {
         	$vitem = $mycomp->GetBusinessObject(4);
            if($vitem->GetByKey($projectinfo->partnumber) == true )
            {
               $duedate = date("Y/m/d",strtotime($projectinfo->date)+3600*24*intval($projectinfo->validperiod));
               $vatgroup = "X0";
               if($DB  == "SLGKM01") $vatgroup = "X0";
               if($DB  == "SLGHZ05" || $DB  == "SLGNJ06") $vatgroup = "X1";
               $oQuotations = $mycomp->GetBusinessObject(23);
               $oQuotations->CardCode = strval($projectinfo->distributor);
               $oQuotations->DocDueDate = strval($duedate);//"2013/10/10"
               $oQuotations->UserFields->Fields->Item("U_Ccode")->Value = trim($projectinfo->end_customer);//C001014
               $oQuotations->UserFields->Fields->Item("U_Sprice")->Value = $projectinfo->price_cus;
               $oQuotations->UserFields->Fields->Item("U_PONum")->Value = $projectinfo->id;
               $oQuotations->Lines->Itemcode = trim($projectinfo->partnumber);//SY7208ABC
               $oQuotations->Lines->Price = $projectinfo->price_dis;
               $oQuotations->Lines->Currency = "USD";
               $oQuotations->Lines->VatGroup = $vatgroup;
               $oQuotations->Lines->Quantity = 999999999;
               //$oQuotations->Lines->UserFields->Fields->Item("U_Ccode")->Value = "C001013";
               $result = $oQuotations->Add();
               if($result != 0)
               {
                  $a=0;
                  $b="000";
                  $mycomp->GetLastError($a,$b);
                  $errordata = array('sboerror'=>trim($b));
                  $this->dao->update(WGC_TABLE_CUSTOM)->data($errordata)->where('id')->eq($project->id)->exec();
                  die(js::alert($b));
               }

            }
         
            //return $result;
         }
         
    }
    
    /**
     * Update a project by no post.
     * 
     * @param  int    $projectID 
     * @access public
     * @return array
     */
    public function updatedata($projectID,$data)
    {
        $oldProject = $this->getById($projectID);
        $team = $this->getTeamMemberPairs($projectID);
        $this->lang->project->team = $this->lang->project->teamname;
        $projectID = (int)$projectID;

              
        $this->dao->update(WGC_TABLE_CUSTOM)->data($data)
            ->autoCheck($skipFields = 'initial_date')
            ->batchcheck($this->config->project->edit->requiredFields, 'notempty')           
            ->check('project_tracking_num', 'unique', "id!=$projectID")
            ->where('id')->eq($projectID)
            ->limit(1)
            ->exec();
           

        //echo "<script>alert('".serialize($oldProject)."');</script>";

        
        if(!dao::isError()) return common::createChanges($oldProject, $data);
    }
    
 
    /**
     * Get project pairs.
     * 
     * @param  string $mode     all|noclosed or empty 
     * @access public
     * @return array
     */
    public function getPairs($mode = '')
    {
        $orderBy  = !empty($this->config->project->orderBy) ? $this->config->project->orderBy : 'id, `order`, status';
        $mode    .= $this->cookie->projectMode;
        /* Order by status's content whether or not done */
        $projects = $this->dao->select('*')->from(WGC_TABLE_CUSTOM)
            //->where('iscat')->eq(0)
            ->Where('deleted')->eq(0)
            ->orderBy('date desc')
            ->fetchAll();
        $pairs = array();
        foreach($projects as $project)
        {
            //if(strpos($mode, 'noclosed') !== false and $project->status == 'done') continue;
            if($this->checkPriv($project))
            {
                if(strpos($mode, 'nocode') === false and $project->rfqcode)
                {
                    $firstChar = strtoupper(substr($project->rfqcode, 0, 1));
                    if(ord($firstChar) < 127) $project->rfqcode =  $firstChar . ':' . $project->rfqcode;
                }
                $pairs[$project->id] = $project->rfqcode;
            }
        }

        /* If the pairs is empty, to make sure there's an project in the pairs. */
        if(empty($pairs) and isset($projects[0]) and $this->checkPriv($projects[0]))
        {
            $firstProject = $projects[0];
            $pairs[$firstProject->id] = $firstProject->name;
        }
        return $pairs;
    }

    /**
     * Get project lists.
     * 
     * @param  string $status  all|undone|wait|running
     * @param  int    $limit 
     * @access public
     * @return array
     */
    public function getList($status = 'all', $limit = 0, $productID = 0)
    {
        if($productID != 0)
        {
            $result = $this->dao->select('t2.*')
                ->from(TABLE_PROJECTPRODUCT)->alias('t1')
                ->leftJoin(WGC_TABLE_CUSTOM)->alias('t2')
                ->on('t1.project = t2.id')
                ->where('t1.product')->eq($productID)
                ->andWhere('t2.deleted')->eq(0)
                ->orderBy('`order`')
                ->beginIF($limit)->limit($limit)->fi()
                ->fetchAll('id');
        }
        else
        {
            $result = $this->dao->select('*')->from(WGC_TABLE_CUSTOM)->where('deleted')->eq(0)
                //->beginIF($status != 'all' and $status != 'undone')->andWhere('status')->in($status)->fi()
                ->orderBy('`order`,id')
                ->beginIF($limit)->limit($limit)->fi()
                ->fetchAll('id');
        }
        foreach($result as $key => $value)
        {
           if(!$this->checkPriv($value))
           {
              unset($result[$key]);
           }
        }
        return $result;
    }



    
    /**
     * Get projects lists grouped by product.
     * 
     * @access public
     * @return array
     */
    public function getProductGroupList()
    {
        $list = $this->dao->select('t1.id, t1.name, t2.product')->from(TABLE_PROJECT)->alias('t1')
            ->leftJoin(TABLE_PROJECTPRODUCT)->alias('t2')->on('t1.id = t2.project')
            ->where('t1.deleted')->eq(0)
            ->orderBy('t1.id')
            ->fetchGroup('product');

        foreach($list as $id => $product)
        {
            foreach($product as $ID => $project)
            {
                if(!$this->checkPriv($this->getById($project->id))) 
                {
                    unset($list[$id][$ID]);
                }
            }
        }

        return $list;
    }

    
    /*
     * get project & revision info 
     * @param str $status
     * @access public
     * @return array
     */
    public function getProjectStatsAll($status = 'undone',$projectID = 0)
    {


    	
        $this->loadModel('report');
        $limit = 20;
        $projects =  $this->dao->select('*, IF(INSTR(" done", status) < 2, 0, 1) AS isDone')->from(WGC_TABLE_PROJECT)->where('deleted')->eq(0)
                ->beginIF($status == 'undone')->andWhere('status')->ne('done')->fi()
                ->beginIF($status != 'all' and $status != 'undone')->andWhere('status')->in($status)->fi()
                ->orderBy('id desc')//$this->config->project->orderBy
                ->beginIF($limit)->limit($limit)->fi()
                ->fetchAll('id');
        $stats    = array();
        

        //print_r($projects);
        /* Get total estimate, consumed and left hours of project. */
        $emptyHour = (object)array('totalEstimate' => 0, 'totalConsumed' => 0, 'totalLeft' => 0, 'progress' => 0);       
        foreach($projects as $keyp => $value)
        {
           $tmpproject = $projects[$keyp];
           $tmpproject->maxrevision = $this->loadModel('dept')->getMaxrevision($keyp);
           for($i = 0; $i< $tmpproject->maxrevision+1; $i++)
           {
            $hours[$keyp][$i] = $this->dao->select('project, SUM(estimate) AS totalEstimate, SUM(consumed) AS totalConsumed')
            ->from(WGC_TABLE_SIGNOFF)
            ->where('project')->eq($keyp)
            ->andWhere('revision')->eq($i)
            ->andWhere('deleted')->eq(0)
            ->groupBy('project')
            ->fetch();  
            
            $lefts[$keyp][$i] = $this->dao->select('project, SUM(`left`) AS totalLeft')
            ->from(WGC_TABLE_SIGNOFF)
            ->where('project')->in(array_keys($projects))
            ->andWhere('revision')->eq($i)
            ->andWhere('deleted')->eq(0)
            ->groupBy('project')
            ->fetch();

               $hours[$keyp][$i]->totalLeft = $lefts[$keyp][$i]->totalLeft;
               $hours[$keyp][$i]->totalEstimate = round($hours[$keyp][$i]->totalEstimate,1);
               $hours[$keyp][$i]->totalConsumed = round($hours[$keyp][$i]->totalConsumed,1);
               $hours[$keyp][$i]->totalLeft = isset($hours[$keyp][$i]->totalLeft) ? round($hours[$keyp][$i]->totalLeft, 1) : $emptyHour->totalLeft;
               $hours[$keyp][$i]->totalReal     = $hours[$keyp][$i]->totalConsumed + $hours[$keyp][$i]->totalLeft;
               $hours[$keyp][$i]->progress      = $hours[$keyp][$i]->totalReal ? round($hours[$keyp][$i]->totalConsumed / $hours[$keyp][$i]->totalReal, 3) * 100 : 0;
               
               $hours[$keyp][$i]->definition  = $this->getStepInfoByArr($keyp, array(9,10,11),$i);
               $hours[$keyp][$i]->icdesign  = $this->getStepInfoByArr($keyp, array(12,13,40,39,41,15,16),$i);
               $hours[$keyp][$i]->iclayout  = $this->getStepInfoByArr($keyp, array(17,18,19,42,20),$i);
               $hours[$keyp][$i]->manufacturing  = $this->getStepInfoByArr($keyp, array(21,22,36),$i);
               $hours[$keyp][$i]->acburnin  = $this->getStepInfoByArr($keyp, array(27),$i);
               $hours[$keyp][$i]->tapeout  = $this->getStepInfoByArr($keyp, array(24,25,26,43),$i);
               $hours[$keyp][$i]->aedebug  = $this->getStepInfoByArr($keyp, array(28,29),$i);
               $hours[$keyp][$i]->dedebug  = $this->getStepInfoByArr($keyp, array(30,31,32),$i);
               $hours[$keyp][$i]->tedebug  = $this->getStepInfoByArr($keyp, array(33),$i);
               //get post step info
               if(isset($_POST['wgcstage']))
               {
    	          $wgcstage = $_POST['wgcstage'];
    	          foreach($wgcstage as $stage)
    	          {
    	             if(isset($hours[$keyp][$i]->$stage) && $hours[$keyp][$i]->$stage != "yes") unset($hours[$keyp][$i]);
    	          }
               }
    	       
               $burns[$keyp][$i] = $this->getBurnData($keyp,$i);
               foreach($burns[$keyp][$i] as $data2) $mm[$keyp][$i][] = $data2->value; 
              // print_r($mm);    
               $tmpproject->burns = $mm[$keyp];
               $stepstr[$keyp][$i] = $this->getEveryStepInfo($keyp, $i);
               //get post schedule info
               if(isset($_POST['schedule']))
               {
               	   if(trim($_POST['schedule']) == "beforehand" && $stepstr[$keyp][$i]['schedule'] <= 0) unset($hours[$keyp][$i]);
               	   if(trim($_POST['schedule']) == "delay" && $stepstr[$keyp][$i]['schedule'] >= 0) unset($hours[$keyp][$i]);
               }
               $tmpproject->everystep = $stepstr[$keyp];
               
               unset($stepstr[$i]);
               unset($mm[$i]);  
           } 
        
          unset($i);
        }
        /* Process projects. */
        foreach($projects as $key => $project)
        {
            if($this->checkPriv($project) || $this->checkAdminGroup())
            {
                // Process the end time.
                //$project->end = date(DT_DATE4, strtotime($project->end));
                /* Process the burns. */
                //$project->burns = array();
                $stats[] = $project;
                /* Process the hours. */
                $project->hours = isset($hours[$project->id]) ? $hours[$project->id] : $emptyHour;

            }
            else
            {
                unset($projects[$key]);
                
            }
        }
        //print_r($stats);
        return $stats;
        
    }
    /*
     * get step info 
     * @param int $projectID,
     * @param array $step
     * @param int $revision
     * @access public
     * @return string
     */
    public function getStepInfoByArr($projectID,$step,$revision = 0)
    {
       if(count($step) < 1) return "no";
       $steparr = array();
       //get all must stepitem
       $stepitem = $this->dao->select('step')->from(WGC_TABLE_SIGNITEM)
                 ->where('project')->eq($projectID)
                 ->andWhere('revision')->eq($revision)
                 ->andWhere('muststep')->eq(1)
                 ->fetchAll();
       foreach($step as $value)
       {
          foreach($stepitem as $item)
          {
             if($value == $item->step) $steparr[] = $value;
          }
       }
       if(count($steparr) < 1) return "yes";
       $lastyes = 1;
       foreach($steparr as $value2)
       {
         $yes = $this->loadModel('dept')->getStepOk($projectID,$value2,$revision);
         $lastyes = $lastyes*$yes;
       }       
       return $lastyes == 1 ? "yes" : "no";
    }
    /*get phase and schedule info */
    public function getEveryStepInfo($projectID,$revision)
    {
       
       if($phase == "P1" || $phase == "P2" || $phase == "P3" || $phase == "P4")
       {
          $phase = substr($phase,1,1);
       }
       else
       {
          $phase = 0;
       }
       $revisioninfo['phase'] = $phase;
       $revisioninfo['schedule'] = 0;
       //get schedule info
       $stepitem = $this->dao->select('project,step')->from(WGC_TABLE_SIGNITEM)
                 ->where('project')->eq($projectID)
                 ->andWhere('revision')->eq($revision)
                 ->andWhere('muststep')->eq(1)
                 ->fetchAll();
       if(isset($stepitem))
       {
          $steparr = array();
          foreach($stepitem as $item)
          {
             $stepstatus = $this->dept->getStepOk($projectID,$item->step,$revision);
             if($stepstatus == 1) $steparr[] = $item->step;
          }
          if(count($steparr) > 0)
          {
          	$schedule = $this->dao->select('SUM(consumed) AS totalconsumed,SUM(estimate) AS totalestimate')->from(WGC_TABLE_SIGNOFF)
          	            ->where('project')->eq($projectID)->andWhere('revision')->eq($revision)->andWhere('step')->in(implode(',',$steparr))
          	            ->groupBy('project')
          	            ->fetch();
          	if(isset($schedule->totalconsumed))
          	{
          	   $scheduleall = $schedule->totalestimate - $schedule->totalconsumed;
          	   $revisioninfo['schedule'] = $scheduleall;
          	}           
          }
       }
       return $revisioninfo;
    }
    /**
     * Get project by id.
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function getById($projectID)
    {
        $project = $this->dao->findById((int)$projectID)->from(WGC_TABLE_CUSTOM)->fetch();
        if(!$project) return false;
        return $project;
    }
   public function dataExists($data)
   {
      $exists_p = $this->dao->select('id')->from(WGC_TABLE_CUSTOM)
                ->where('customer_name')->eq($data['customer_name'])
                ->andWhere('project_name')->eq($data['project_name'])
                ->andWhere('initial_date')->eq($data['initial_date'])
                ->andWhere('silergy_part_num')->eq($data['silergy_part_num'])
                ->andWhere('eau')->eq($data['eau'])
                ->andWhere('BINARY est_price')->eq($data['est_price'])
                ->andWhere('openby')->eq($this->app->user->account)
                ->fetch();
     if(!$exists_p) return 0;
     return $exists_p;
   	
   }
    /*
     * get wafercode by parentid
     * @param int $parent
     * @access public
     * @return str
     */
    public function getWafercodeByParent($parent = 0)
    {
       $waferinfo = $this->dao->select('wafercode')->from(WGC_TABLE_PRODUCT)->where('id')->eq($parent)->fetch();
       if(isset($waferinfo->wafercode)) return $waferinfo->wafercode;
       
    }
    
    /**
     * Get wgcproject by id.
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function getwgcById($projectID)
    {
        return $this->dao->findById((int)$projectID)->from(WGC_TABLE_PROJECT)->fetch();
        
    }
    /**
     * Get the default managers for a project from it's related products. 
     * 
     * @param  int    $projectID 
     * @access public
     * @return object
     */
    public function getDefaultManagers($projectID)
    {
        $managers = $this->dao->select('PO,QM,RM')->from(TABLE_PRODUCT)->alias('t1')
            ->leftJoin(TABLE_PROJECTPRODUCT)->alias('t2')->on('t1.id = t2.product')
            ->where('t2.project')->eq($projectID)
            ->fetch();
        if($managers) return $managers;

        $managers->PO = '';
        $managers->QM = '';
        $managers->RM = '';
        return $managers;
    }

    /**
     * Get products of a project.
     * 
     * @param  int    $projectID 
     * @access public
     * @return array
     */
    public function getProducts($projectID)
    {
        return $this->dao->select('t2.id, t2.name')->from(TABLE_PROJECTPRODUCT)->alias('t1')
            ->leftJoin(TABLE_PRODUCT)->alias('t2')
            ->on('t1.product = t2.id')
            ->where('t1.project')->eq((int)$projectID)
            ->fetchPairs();
    }

    /**
     * Update products of a project.
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function updateProducts($projectID)
    {
        $this->dao->delete()->from(TABLE_PROJECTPRODUCT)->where('project')->eq((int)$projectID)->exec();
        if(!isset($_POST['products'])) return;
        $products = array_unique($_POST['products']);
        foreach($products as $productID)
        {
            $data->project = $projectID;
            $data->product = $productID;
            $this->dao->insert(TABLE_PROJECTPRODUCT)->data($data)->exec();
        }
    }

    /**
     * Get related projects 
     * 
     * @param  int    $projectID 
     * @access public
     * @return array
     */
    public function getRelatedProjects($projectID)
    {
        $products = $this->dao->select('product')->from(TABLE_PROJECTPRODUCT)->where('project')->eq((int)$projectID)->fetchAll('product');
        if(!$products) return array();
        $products = array_keys($products);
        return $this->dao->select('t1.id, t1.name')->from(TABLE_PROJECT)->alias('t1')
            ->leftJoin(TABLE_PROJECTPRODUCT)->alias('t2')
            ->on('t1.id = t2.project')
            ->where('t2.product')->in($products)
            ->andWhere('t1.id')->ne((int)$projectID)
            ->andWhere('t1.deleted')->eq(0)
            ->orderBy('t1.id')
            ->fetchPairs();
    }




    /**
     * Get child projects.
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function getChildProjects($projectID)
    {
        return $this->dao->select('id, name')->from(TABLE_PROJECT)->where('parent')->eq((int)$projectID)->fetchPairs();
    }

    /**
     * Update childs.
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function updateChilds($projectID)
    {
        $sql = "UPDATE " . TABLE_PROJECT . " SET parent = 0 WHERE parent = '$projectID'";
        $this->dbh->exec($sql);
        if(!isset($_POST['childs'])) return;
        $childs = array_unique($_POST['childs']);
        foreach($childs as $childProjectID)
        {
            $sql = "UPDATE " . TABLE_PROJECT . " SET parent = '$projectID' WHERE id = '$childProjectID'";
            $this->dbh->query($sql);
        }
    }

    /**
     * Link story.
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function linkStory($projectID)
    {
        if($this->post->stories == false) return false;
        $this->loadModel('action');
        $versions = $this->loadModel('story')->getVersions($this->post->stories);
        foreach($this->post->stories as $key => $storyID)
        {
            $productID = $this->post->products[$key];
            $data->project = $projectID;
            $data->product = $productID;
            $data->story   = $storyID;
            $data->version = $versions[$storyID];
            $this->dao->insert(TABLE_PROJECTSTORY)->data($data)->exec();
            $this->story->setStage($storyID);
            $this->action->create('story', $storyID, 'linked2project', '', $projectID);
        }        
    }

    /**
     * Unlink story. 
     * 
     * @param  int    $projectID 
     * @param  int    $storyID 
     * @access public
     * @return void
     */
    public function unlinkStory($projectID, $storyID)
    {
        $this->dao->delete()->from(TABLE_PROJECTSTORY)->where('project')->eq($projectID)->andWhere('story')->eq($storyID)->limit(1)->exec();
        $this->loadModel('story')->setStage($storyID);
        $this->loadModel('action')->create('story', $storyID, 'unlinkedfromproject', '', $projectID);
        $tasks = $this->dao->select('id')->from(TABLE_TASK)->where('story')->eq($storyID)->andWhere('project')->eq($projectID)->andWhere('status')->in('wait,doing')->fetchPairs('id');
        $this->dao->update(TABLE_TASK)->set('status')->eq('cancel')->where('id')->in($tasks)->exec();
        foreach($tasks as $taskID)
        {
            $changes  = $this->loadModel('task')->cancel($taskID);
            $actionID = $this->action->create('task', $taskID, 'Canceled');
            $this->action->logHistory($actionID, $changes);
        }
    }

    /**
     * Get team members. 
     * 
     * @param  int    $projectID 
     * @access public
     * @return array
     */
    public function getTeamMembers($projectID)
    {
        return $this->dao->select('t1.*, t1.hours * t1.days AS totalHours, t2.realname')->from(TABLE_TEAM)->alias('t1')
            ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account = t2.account')
            ->where('t1.project')->eq((int)$projectID)
            ->andWHere('t2.company')->eq($this->app->company->id)
            ->fetchAll('account');
    }

    /**
     * Get team members in pair.
     * 
     * @param  int    $projectID 
     * @param  string $params 
     * @access public
     * @return array
     */
    public function getTeamMemberPairs($projectID, $params = '')
    {
        $users = $this->dao->select('t1.account, t2.realname')->from(TABLE_TEAM)->alias('t1')
            ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account = t2.account')
            ->where('t1.project')->eq((int)$projectID)
            ->andWHere('t2.company')->eq($this->app->company->id)
            ->beginIF($params == 'nodeleted')
            ->andWhere('t2.deleted')->eq(0)
            ->fi()
            ->fetchPairs();
        if(!$users) return array();
        foreach($users as $account => $realName)
        {
            $firstLetter = ucfirst(substr($account, 0, 1)) . ':';
            $users[$account] =  $firstLetter . ($realName ? $realName : $account);
        }
        return array('' => '') + $users;
    }

    /**
     * Manage team members.
     * 
     * @param  int    $projectID 
     * @access public
     * @return void
     */
    public function manageMembers($projectID)
    {
        extract($_POST);

        $accounts = array_unique($accounts);
        foreach($accounts as $key => $account)
        {
            if(empty($account)) continue;

            $member->role  = $roles[$key];
            $member->days  = $days[$key];
            $member->hours = $hours[$key];
            $mode        = $modes[$key];

            if($mode == 'update')
            {
                $this->dao->update(TABLE_TEAM)->data($member)->where('project')->eq((int)$projectID)->andWhere('account')->eq($account)->exec();
            }
            else
            {
                $member->project = (int)$projectID;
                $member->account = $account;
                $member->join    = helper::today();
                $this->dao->insert(TABLE_TEAM)->data($member)->exec();
            }
        }        
    }

    /**
     * Unlink a member.
     * 
     * @param  int    $projectID 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function unlinkMember($projectID, $account)
    {
        $this->dao->delete()->from(TABLE_TEAM)->where('project')->eq((int)$projectID)->andWhere('account')->eq($account)->exec();
    }

    /**
     * Compute burn of a project.
     * 
     * @access public
     * @return array
     */
    public function computeBurn()
    {
        $today    = helper::today();
        $burns    = array();

        $projects = $this->dao->select('id, name')->from(WGC_TABLE_PROJECT)
            ->where("end >= '$today'")
            ->orWhere('end')->eq('0000-00-00')
            ->fetchPairs();
        if(!$projects) return $burns;
        foreach($projects as $key=>$value)
        {
           $revisioninfo = $this->dao->select('revision')->from(WGC_TABLE_SIGNOFF)->where('project')->eq($key)->orderBy('revision desc')->limit(1)->fetch();
           $revision = $revisioninfo->revision;
           $burnss[] = $this->dao->select("project, '$today' AS date, '$revision' AS revision, sum(`left`) AS `left`, SUM(consumed) AS `consumed`")
            ->from(WGC_TABLE_SIGNOFF)
            ->where('project')->in($key)
            ->andWhere('deleted')->eq('0')
            ->andWhere('revision')->eq($revisioninfo->revision)
            ->groupBy('project')
            ->fetchAll();
            unset($revisioninfo);
            unset($revision);
        }
        foreach($burnss as $value)
        {
           if(isset($value[0]))
           {
              $burnsss[] = $value[0];
           }
        }
        //print_r($burnsss);
        $burns = $this->dao->select("project, '$today' AS date, sum(`left`) AS `left`, SUM(consumed) AS `consumed`")
            ->from(WGC_TABLE_SIGNOFF)
            ->where('project')->in(array_keys($projects))
            ->andWhere('deleted')->eq('0')
            ->groupBy('project')
            ->fetchAll();
       //print_r($burns);
      
        foreach($burnsss as $Key => $burn)
        {
            $this->dao->replace(TABLE_BURN)->data($burn)->exec();
            $burn->projectName = $projects[$burn->project];
        }
        return $burnsss;
    }
   
    /**
     * Get data of burn down chart.
     * 
     * @param  int    $projectID 
     * @param  int    $itemCounts 
     * @access public
     * @return array
     */
    public function getBurnData($projectID = 0,$revision = 0 ,$itemCounts = 30)
    {
        /* Get project and burn counts. */
        $project    = $this->getById($projectID);
        $burnCounts = $this->dao->select('count(*) AS counts')->from(TABLE_BURN)->where('project')->eq($projectID)->andWhere('revision')->eq($revision)->fetch('counts');

        /* If the burnCounts > $itemCounts, get the latest $itemCounts records. */
        $sql = $this->dao->select('date AS name, `left` AS value')->from(TABLE_BURN)->where('project')->eq((int)$projectID)->andWhere('revision')->eq($revision);
        if($burnCounts > $itemCounts)
        {
            $sets = $sql->orderBy('date DESC')->limit($itemCounts)->fetchAll('name');
            $sets = array_reverse($sets);
        }
        else
        {
            /* The burnCounts < itemCounts, after getting from the db, padding left dates. */
            $sets    = $sql->orderBy('date ASC')->fetchAll('name');
            $current = helper::today();
/*            if($project->end != '0000-00-00')
            {
                $period = helper::diffDate($project->end, $project->begin) + 1;
                $counts = $period > $itemCounts ? $itemCounts : $period;
            }
            else
            {
                $counts = $itemCounts;
            }*/
            //add wgc
            if($project->days != 0)
            {
                
                $counts = intval($project->days);
            }
            else
            {
                $counts = $itemCounts;
            }
            
            
            for($i = 0; $i < $counts - $burnCounts; $i ++)
            {
                if(helper::diffDate($current, $project->end) > 0) break;
                
                if(!isset($sets[$current]))
                {
                    $sets[$current]->name = $current;
                    $sets[$current]->value = '';
                }
                $nextDay = date(DT_DATE1, strtotime('next day', strtotime($current)));
                $current = $nextDay;
            }
        }
        foreach($sets as $set) $set->name = substr($set->name, 5);
        return $sets;
    }

    public function getBurnDataFlot($projectID = 0, $itemCounts = 30)
    {
    	/* get max revision  */
    	$maxrevision = $this->loadModel('dept')->getMaxrevision($projectID);
        /* Get project and burn counts. */
        $project    = $this->getById($projectID);
        $burnCounts = $this->dao->select('count(*) AS counts')->from(TABLE_BURN)->where('project')->eq($projectID)->andWhere('revision')->eq($maxrevision)->fetch('counts');

        /* If the burnCounts > $itemCounts, get the latest $itemCounts records. */
        $sql = $this->dao->select('date AS name, `left` AS value')->from(TABLE_BURN)->where('project')->eq((int)$projectID)->andWhere('revision')->eq($maxrevision);
        if($burnCounts > $itemCounts)
        {
            $sets = $sql->orderBy('date DESC')->limit($itemCounts)->fetchAll('name');
            $sets = array_reverse($sets);
        }
        else
        {
            /* The burnCounts < itemCounts, after getting from the db, padding left dates. */
            $sets    = $sql->orderBy('date ASC')->fetchAll('name');
            $current = helper::today();
            if($project->end != '0000-00-00')
            {
                $period = helper::diffDate($project->end, $project->begin) + 1;
                $counts = $period > $itemCounts ? $itemCounts : $period;
            }
            else
            {
                $counts = $itemCounts;
            }

            for($i = 0; $i < $counts - $burnCounts; $i ++)
            {
                if(helper::diffDate($current, $project->end) > 0) break;
                if(!isset($sets[$current]))
                {
                    $sets[$current]->name = $current;
                    $sets[$current]->value = '';
                }
                $nextDay = date(DT_DATE1, strtotime('next day', strtotime($current)));
                $current = $nextDay;
            }
        }
        $count = 0;
        foreach($sets as $set) 
        {
            $set->name = (string)strtotime("$set->name UTC") . '000';
            $count ++;
        }
        $sets['count'] = $count;
        return $sets;
    }

    /**
     * Get taskes by search.
     * 
     * @param  string $condition 
     * @param  object $pager 
     * @param  string $orderBy 
     * @access public
     * @return array
     */
    public function getSearchTasks($condition, $pager, $orderBy)
    {
        if(strpos(",admin,issac,lynn,", $this->app->user->account) !== false)
        {
    	$taskIdList = $this->dao->select('*')
            ->from(WGC_TABLE_CUSTOM)
            ->where($condition)
            ->andWhere('deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
        }
        elseif(strpos(",luis,", $this->app->user->account) !== false)
        {
            $taskIdList = $this->dao->select('*')
            ->from(WGC_TABLE_CUSTOM)
            ->where($condition)
            ->andWhere('region')->eq('china')
            ->andWhere('deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
        }
        elseif(strpos(",frankie,", $this->app->user->account) !== false)
        {
            $taskIdList = $this->dao->select('*')
            ->from(WGC_TABLE_CUSTOM)
            ->where($condition)
            ->andWhere('region')->eq('taiwan')
            ->andWhere('deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
        }
        elseif(strpos(",joshuah,", $this->app->user->account) !== false)
        {
            $taskIdList = $this->dao->select('*')
            ->from(WGC_TABLE_CUSTOM)
            ->where($condition)
            ->andWhere('region')->eq('korea')
            ->andWhere('deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
        }
        else 
        {
            $taskIdList = $this->dao->select('*')
            ->from(WGC_TABLE_CUSTOM)
            ->where($condition)
            ->andWhere('openby')->eq($this->app->user->account)
            ->andWhere('region')->eq('korea')
            ->andWhere('deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
        	
        }
/*        foreach($taskIdList as $key => $value)
        {
        	if(!$this->checkPriv($value))
        	{
        	   unset($taskIdList[$key]);
        	}
        }*/
        $sql = explode('WHERE', $this->dao->get());
        $sql = explode('ORDER', $sql[1]);
        $this->session->set('projectCondition', $sql[0]);       
        return $taskIdList;
    }

    /**
     * Get bugs by search in project. 
     * 
     * @param  int    $products 
     * @param  int    $projectID 
     * @param  int    $sql 
     * @param  int    $pager 
     * @param  int    $orderBy 
     * @access public
     * @return void
     */
    public function getSearchBugs($products, $projectID, $sql, $pager, $orderBy)
    {
        return $this->dao->select('*')->from(TABLE_BUG)
            ->where($sql)
            ->andWhere('status')->eq('active')
            ->andWhere('toTask')->eq(0)
            ->andWhere('tostory')->eq(0)
            ->beginIF(!empty($products))->andWhere('product')->in(array_keys($products))->fi()
            ->beginIF(empty($products))->andWhere('project')->eq($projectID)->fi()
            ->andWhere('deleted')->eq(0)
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
    }

    /**
     * Get resolved bugs of a project
     * 
     * @param  int    $projectID 
     * @access public
     * @return array
     */
    public function getResolvedBugs($projectID)
    {
        $project  = $this->getById($projectID);
        $products = $this->dao->select('product')->from(TABLE_PROJECTPRODUCT)->where('project')->eq($projectID)->fetchPairs('product');
        return $this->dao->select('id, title, status')->from(TABLE_BUG)
            ->where('status')->eq('resolved')
            ->andWhere('resolvedDate')->ge($project->begin)
            ->andWhere('resolution')->eq('fixed')
            ->andWhere('product')->in($products)
            ->fetchAll();
    }
    
    /* check account pri is self or admin
     * @param int $projectID
     * @param str $account
     * @access public
     * @return str
     */ 
    public function checkAccountPri($projectID,$account)
    {
       $loginer = $this->app->user->account;
       if(strpos($this->app->company->admins, $loginer) !== false) return true;
       if($this->checkAdminGroup()) return true;
       if($loginer == trim($account)) return true;
       echo js::error('Can not review the item  !');
       die(js::locate('back')); 
    }
    
    /*
     * get parent project select html
     */
    public function dafenglei_select($m,$id,$index)
    {
       $str = "";
	   $class_arrobject = $this->dao->select('id,`name`,`parent`,`order`')->from(WGC_TABLE_PRODUCT)->orderby('`order` asc,id asc')->fetchAll();
	   if(!$class_arrobject) echo '';
	   foreach($class_arrobject as $value)
	   {
	   	$class_arr[] = array($value->id,$value->name,$value->parent,$value->order);
	   }
	   
       $n = str_pad('',$m,'-',STR_PAD_RIGHT);
	   $n = str_replace("-","&nbsp;&nbsp;",$n);
	  
	   for($i=0;$i<count($class_arr);$i++)
	   {

		   if($class_arr[$i][2]==$id)
		   {
			   if($class_arr[$i][0]==$index)
			   {
				   $str .=  "        <option value=\"".$class_arr[$i][0]."\" selected=\"selected\">".$n."|--".$class_arr[$i][1]."</option>\n";
			   }
			   else
			   {
				   $str .=  "        <option value=\"".$class_arr[$i][0]."\">".$n."|--".$class_arr[$i][1]."</option>\n";
			   }
			   $str .= $this->dafenglei_select($m+1,$class_arr[$i][0],$index);

		   }

	   }
	   
	   return $str;

   } 


   public function sendApproveMail($region='china',$mailname = 'admin')
   {

  

   	   $toList      = $mailname;
       $ccList      = "admin";
       $subject     = date("Y-m-d")." Request For Quotation list ";
       $ccList      = "";
	   $datestr = date("Y-m-d",(mktime()-24*3600));
	   if(strpos($mailname,'issac') != false || strpos($mailname,'wugaochao') != false || strpos($mailname,'mengjingzhen') != false)
	   {
    	   $result = $this->dao->select('a.*,b.role,b.signature,b.signdate')->from('zt_custom')->alias('a')->leftJoin('zt_approve')->alias('b')
    	         ->on('a.id = b.cid')
                 ->where('a.status')->eq("Pending")
			     ->andWhere('b.role')->eq('0')
			     ->andWhere('b.signature')->eq('approve')
			     ->andWhere('b.signdate')->ge($datestr) 
                 
                 ->fetchAll();	
	   }
	   else
	   {
	   
          $result = $this->dao->select('*')->from(WGC_TABLE_CUSTOM)
                 ->where('`createdate`')->eq(date("Y-m-d"))
                 ->andWhere('status')->eq("Pending")
                 ->beginIF($region != "*")->andWhere('region')->like($region)->fi()
                 ->fetchAll();	   
	   }
       if(count($result) < 1) return false;
	   
       $str .= "<style> table {font-size:11px;} .fuck tr td {border:1px solid #ccc;}</style>";
       $str .= "Hi ".$mailname ."<br/>"." &nbsp;&nbsp;&nbsp;".date("Y.m.d")." of ".$region." Request for Quotation as follows :";
       $str .= "&nbsp;&nbsp;&nbsp;<table class='fuck' width='1360' style='border:1px solid #CCC;border-collapse:collapse'><tr class='colhead' style='background:#ccc'><th class='w-id'>ID</th><th width='120'>RFQ#</th><th width='80'>Part Number</th><th width='100'>End Customer</th><th width='100'>Distributor</th><th width='60'>Resell Price</th><th width='60'>Dist. Price</th><th>Usuage(kpcs)</th><th width='80'>Commission</th><th width='80'>Request by</th><th width='80'>Date</th><th width='60'>Valid Date</th><th width='60'>Old RFQ</th><th width='80'>Sales</th> <th width='60'>End APP.</th><th width='60'>Region</th><th width='80'>Status</th><th width='120'>Reason</th><th width='80' style='color:#ff0000;width:100px;'>Action</th>";
       $j = 1;
       foreach($result as $value)
       {
              if($value->oldrfq)
              {
                 $oldprice = $this->getById($value->oldrfq);
                 if($oldprice->price_cus)
                 {
                    $oldinfo = $oldprice->price_dis."($oldprice->price_cus)";
                 }
                 else
                 {
                    $oldinfo = $oldprice->price_dis;
                 
                 }  
              }        	
       	  if($j % 2 == 0)
       	  {
       	  	 $str .= "<tr style='background:#A6F0FD;'>";
       	  }
       	  else 
       	  {
       	     $str .= "<tr>";
       	  }
          $str .= "<td>$value->id</td><td>$value->rfqcode</td><td>$value->partnumber</td><td>$value->end_cus_code</td><td>$value->discode</td><td>$value->price_cus</td><td>$value->price_dis</td><td>$value->usage</td>";
          $str .= "<td>$value->commission</td><td>$value->openby</td><td>$value->date</td><td>$value->validperiod</td><td>$oldinfo</td><td>$value->sales</td><td>$value->endapp</td><td>$value->region</td><td>$value->status</td><td>$value->reason</td><td>&nbsp;&nbsp;</td>";
          $str .= "</tr>";
          unset($oldinfo);
          $j++;
       }
       $str .= "</table>";
   	   $this->loadModel('mail')->send($toList,$subject , $str, $ccList);
   	   
       
   
   	   
       
   }


   public function sendMailToSales()
   {
      $sales = $this->dao->select('account,dept')->from(TABLE_USER)->where('dept')->in('1,13')->andWhere('account')->ne('issac')->fetchAll();
      $datestr = date("Y-m-d",(mktime()-24*3600));
      foreach($sales as $valueu)
      {
         $result = $this->dao->select('a.*')->from(WGC_TABLE_CUSTOM)->alias('a')
                   ->leftJoin(TABLE_ACTION)->alias('b')
                   ->on('a.id = b.objectID')
                   ->where('a.openby')->eq($valueu->account)
                   ->andWhere('b.date')->ge($datestr)
                   ->andWhere('b.action')->eq('updated')
                   ->groupBy('a.id')
                   ->fetchAll();
          //echo $this->dao->get();  exit;   
         if(count($result) > 0) 
         {
         $toList      = $valueu->account;
         $ccList      = "";
         $subject     = date("Y-m-d")." Request For Quotation result list ";
         $ccList      = "";
         $str .= "<style> table {font-size:11px;} .fuck tr td {border:1px solid #ccc;}</style>";
         $str .= "Hi ".$toList ."<br/>"." &nbsp;&nbsp;&nbsp;".date("Y.m.d")." Request for Quotation feedback as follows :";
         $str .= "&nbsp;&nbsp;&nbsp;<table class='fuck' width='1360' style='border:1px solid #CCC;border-collapse:collapse'><tr class='colhead' style='background:#ccc'><th class='w-id'>ID</th><th class='w-120px'>RFQ#</th><th class='w-80px'>Part Number</th><th class='w-100px'>End Customer</th><th class='w-100px'>Distributor</th><th class='w-60px'>Resell Price</th><th class='w-60px'>Dist. Price</th><th class='w-80px'>Commission</th><th class='w-80px'>Request by</th><th class='w-80px'>Date</th><th class='w-60px'>Valid Date</th><th class='w-60px'>Old RFQ</th><th class='w-80px'>Sales</th> <th class='w-60px'>End APP.</th><th class='w-60px'>Region</th><th class='w-80px'>Status</th>";    
         foreach($result as $value)
         {
              if($value->oldrfq)
              {
                 $oldprice = $this->getById($value->oldrfq);
                 if($oldprice->price_cus)
                 {
                    $oldinfo = $oldprice->price_dis."($oldprice->price_cus)";
                 }
                 else
                 {
                    $oldinfo = $oldprice->price_dis;
                 
                 }  
              }         	 
       	     $str .= "<tr>";
             $str .= "<td>$value->id</td><td>$value->rfqcode</td><td>$value->partnumber</td><td>$value->end_cus_code</td><td>$value->discode</td><td>$value->price_cus</td><td>$value->price_dis</td>";
             $str .= "<td>$value->commission</td><td>$value->openby</td><td>$value->date</td><td>$value->validperiod</td><td>$oldinfo</td><td>$value->sales</td><td>$value->endapp</td><td>$value->region</td><td>$value->status</td>";
             $str .= "</tr>";
             unset($oldinfo);
         }
         $str .= "</table>";

         $this->loadModel('mail')->send($toList,$subject , $str, $ccList);
         unset($str);
         }
      }
              
   }

   /*
    * get old rfq by user or sales
    * @param string $user
    * @access public
    * @return object 
    */ 
   public function getOldRfq($user,$part = "",$dis = "",$end = "")
   {
      $result = $this->dao->select('id,rfqcode,discode,end_cus_code,partnumber,distributor,end_customer')
                ->from(WGC_TABLE_CUSTOM)
                ->where('openby')->eq($user)
                ->andWhere('distributor')->eq($dis)
                ->andWhere('end_customer')->eq($end)
                ->andWhere('partnumber')->eq($part)
                ->andWhere('status')->eq("Approved")
                ->andWhere('deleted')->eq(0)
                ->orderBy('id desc')
                ->limit('0,1')
                ->fetch();
     return $result->id;
/*     $arr[0] = "No Old RFQ  ";
     if($result)
     {
     	
        foreach($result as $value)
        {
           $arr[$value->id] = $value->id."+".$value->rfqcode."+".$value->partnumber."+".$value->distributor."+".$value->end_customer;
        }
     }
     return $arr;*/
   }
   
   /*
    * get end and distributor info
    */
   public function getDistributorArr()
   {
   	  
      $mycomp = $this->dao->connectToSBO("SLGHZ05");
      if($mycomp->Connect == 0)
      {
      $vpartner = $mycomp->GetBusinessObject(300);
      $vpartner->DoQuery("select CardCode,CardName from OCRD where CardCode like 'D0%' or CardCode like 'E0%' order by CardName asc");
      $vpartner->MoveFirst;
      while($vpartner->EOF != 1)
      {
         $arr[$vpartner->Fields->Item(0)->value] = iconv('gbk','UTF-8',$vpartner->Fields->Item(1)->value);
         $vpartner->MoveNext;
      }
      }
      return $arr;
   }

   /*
    * get end and end customer info
    */
   public function getEndcustomerArr()
   {
   	  
      $mycomp = $this->dao->connectToSBO("SLGHZ05");
      if($mycomp->Connect == 0)
      {
      $vpartner = $mycomp->GetBusinessObject(300);
      $vpartner->DoQuery("select CardCode,CardName,CardFName,U_CAgent from OCRD where CardCode like 'C0%' or CardCode like 'E0%' order by CardCode desc");
      $vpartner->MoveFirst;
      while($vpartner->EOF != 1)
      {
      	 if(iconv('gbk','UTF-8',$vpartner->Fields->Item(3)->value) != "" ) 
		 {
		    $disname = " - distributor:" . iconv('gbk','UTF-8',$vpartner->Fields->Item(3)->value);
		 }
		 if(iconv('gbk','UTF-8',$vpartner->Fields->Item(2)->value) != "" ) 
		 {
		    $cardfname = " - " . iconv('gbk','UTF-8',$vpartner->Fields->Item(2)->value);
		 }
		 else 
		 {
		    $cardfname = "";
		 }
         $arr[$vpartner->Fields->Item(0)->value] = $vpartner->Fields->Item(0)->value ." - ". iconv('gbk','UTF-8',$vpartner->Fields->Item(1)->value)." ".$cardfname.$disname;
        
		 $vpartner->MoveNext;
      }
      }
      return $arr;
   
   }
   
   /*
    * check partnumber exist
    * @param string $partnumber
    */
   public function existPartnumber($partnumber)
   {
      
   	  $result = $this->dao->select('partnumber')->from(WGC_TABLE_LOWPRICE)->where('partnumber')->eq($partnumber)->fetch();
   	  if(!isset($result->partnumber)) echo js::error('Part number does not exist!');
   }

   
}
