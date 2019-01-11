<?php
class crossexamsModel extends model
{
    /**
     * Get crossexams info by id.
     * 
     * @param  int    $circleID 
     * @access public
     * @return object
     */
    public function getById($ID)
    {
        
    }      

    //通过用户sid 和 circletime  得到权限 zt_crossexams
    public function getBySid($sid,$circle)
    {
        return $this->dao->select()->from('`zt_crossexams`')
                                   ->where('`sid`')->eq($sid)
                                   ->andwhere('`circletime`')->eq($circle)
                                   ->fetch();
    }


    //对数据验证,并写入数据库
    public function insert($arri)
    {
        $result = $this->dao->insert('`zt_examitems`')->data($arri)
                         ->autoCheck()
                         ->batchCheck('professionality, cooperation, execution,responsibility,integrity,sid,manager,circletime', 'notempty')
                         ->exec();
        if(dao::isError()) die(js::error(dao::getError())); 
    }

    //通过用户sid  得到数据 zt_examitems
    public function getBySelf($circletime,$sid,$orderBy,$pager)
    {
        $hr = $this->loadModel('performance')->checkHRGroup();
        return $this->dao->select()->from('`zt_examitems`')
                                   ->where('`circletime`')->eq($circletime)
                                   ->beginIF($hr == false && $this->app->user->account != 'admin')
                                   ->andwhere('`sid`')->eq($sid)
                                   ->fi()
                                   ->orderBy($orderBy)
                                   ->page($pager)
                                   ->fetchAll();
    }
    public function getsearchBySelf($crossquery,$sid,$orderBy,$pager)
    {
        $hr = $this->loadModel('performance')->checkHRGroup();
        return $this->dao->select()->from('`zt_examitems`')
                                   ->where($crossquery)
                                   ->beginIF($hr == false && $this->app->user->account != 'admin')
                                   ->andwhere('`sid`')->eq($sid)
                                   ->fi()
                                   ->orderBy($orderBy)
                                   ->page($pager)
                                   ->fetchAll();
    }

    //edit 单条数据
    public function edit($id)
    {
        return $this->dao->select()->from('`zt_examitems`')
                                   ->where('`id`')->eq($id)
                                   ->fetch();
    }
     
     
     


     
     /**
      * Set menu. 
      * 
      * @param  array  $performances 
      * @param  int    $performanceID 
      * @param  string $extra 
      * @access public
      * @return void
      */
     public function setMenu($performances, $CID, $branch = 0, $extra = '')
     {
      
         if($CID < 2)
         {
            $CID = date("Y");
            $month = date('n');
            if($month > 8 || $month < 2)
            {
               $CID .= 2;
            }
            else 
            {
                $CID .= 1;
            }
         }
         $currentModule = $this->app->getModuleName();
         $currentMethod = $this->app->getMethodName();


         $selectHtml = $this->loadModel('crossexams')->select($performances, $CID, $currentModule, $currentMethod, $extra, $branch);

         foreach($this->lang->crossexams->menu as $key => $menu)
         {
             $replace = $key == 'list' ? $selectHtml : $CID;  // 遍历menu  如果是list则重新设置
             common::setMenuVars($this->lang->crossexams->menu, $key, $replace);
         }
         
     }


     /**
      * Create the select code of circle. 
      * 
      * @param  array     $products 
      * @param  int       $productID 
      * @param  string    $currentModule 
      * @param  string    $currentMethod 
      * @param  string    $extra 
      * @access public
      * @return string
      */
     public function select($circles, $circleID, $currentModule, $currentMethod, $extra = '', $branch = 0)
     {
         if(!$circleID)
         {
             unset($this->lang->crossexams->menu->branch);
             return;
         }
         if($currentMethod == "view") $currentMethod = "browse";
         setCookie("lastcircle", $circleID, $this->config->cookieLife, $this->config->webRoot);
         
         $currentCircle = $this->loadModel('performance')->getCircleById($circleID);
         $output  = "<a id='currentItem' href=\"javascript:showDropMenu('crossexams', '$circleID', '$currentModule', '$currentMethod', '$extra')\">".$this->getDesCircle($currentCircle->circle)." <span class='icon-caret-down'></span></a><div id='dropMenu'><i class='icon icon-spin icon-spinner'></i></div>";
        
         if($currentCircle->status != 'hold')
         {
            
             $this->lang->crossexams->menu->branch = str_replace('@branch@', $this->lang->crossexams->branchName[$currentProduct->type], $this->lang->crossexams->menu->branch);
             
             $branchName = isset($branches[$branch]) ? $branches[$branch] : $branches[0];
             $output    .= '</li><li>';
             //$output    .= "<a id='currentBranch' href=\"javascript:showDropMenu('branch', '$circleID', '$currentModule', '$currentMethod', '$extra')\">{$branchName} <span class='icon-caret-down'></span></a><div id='dropMenu'><i class='icon icon-spin icon-spinner'></i></div>";
         }
         return $output;
     }    

     
     /*
      * get description of circle
      */
     public function getDesCircle($circle)
     {
      $tmpname = substr($circle,0,4)." ".substr($circle,4,1)."H ";
      $tmpname .= " crossexams Appraisal";
      return $tmpname;
     }
     
     
     
     
     
     
     
     
     
     
     
     
     
     
}
