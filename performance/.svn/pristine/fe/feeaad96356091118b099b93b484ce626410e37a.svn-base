<?php
/**
 * The model file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     company
 * @version     $Id: model.php 5086 2013-07-10 02:25:22Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php
class companyModel extends model
{
    /**
     * Set menu.
     * 
     * @param  int    $dept 
     * @access public
     * @return void
     */
    public function setMenu($dept = 0)
    {
        common::setMenuVars($this->lang->company->menu, 'name', array($this->app->company->name));
        common::setMenuVars($this->lang->company->menu, 'addUser', array($dept));
        common::setMenuVars($this->lang->company->menu, 'batchAddUser', array($dept));
    }

    /**
     * Get company list.
     * 
     * @access public
     * @return void
     */
    public function getList()
    {
        return $this->dao->select('*')->from(TABLE_COMPANY)->fetchAll();
    }

    /**
     * Get the first company.
     * 
     * @access public
     * @return void
     */
    public function getFirst()
    {
        return $this->dao->select('*')->from(TABLE_COMPANY)->orderBy('id')->limit(1)->fetch();
    }
    
    /**
     * Get company info by id.
     * 
     * @param  int    $companyID 
     * @access public
     * @return object
     */
    public function getByID($companyID = '')
    {
        return $this->dao->findById((int)$companyID)->from(TABLE_COMPANY)->fetch();
    }

    /**
     * Get users.
     *
     * @param  string $type
     * @param  int    $queryID
     * @param  int    $deptID
     * @param  string $sort
     * @param  object $pager
     * @access public
     * @return array
     */
    public function getUsers($type, $queryID, $deptID, $sort, $pager)
    {
        /* Get users. */
        if($type == 'bydept')
        {
            $childDeptIds = $this->loadModel('dept')->getAllChildID($deptID);
            return $this->dept->getUsers($childDeptIds, $pager, $sort);
        }
        else
        {
            if($queryID)
            {
                $query = $this->loadModel('search')->getQuery($queryID);
                if($query)
                {
                    $this->session->set('userQuery', $query->sql);
                    $this->session->set('userForm', $query->form);
                }
                else
                {
                    $this->session->set('userQuery', ' 1 = 1');
                }
            }
            return $this->loadModel('user')->getByQuery($this->session->userQuery, $pager, $sort);
        }
    }

    /**
     * Update a company.
     * 
     * @access public
     * @return void
     */
    public function update()
    {
        $company   = fixer::input('post')->get();        
        if($company->website  == 'http://') $company->website  = '';
        if($company->backyard == 'http://') $company->backyard = '';
        $companyID = $this->app->company->id;
        $this->dao->update(TABLE_COMPANY)
            ->data($company)
            ->autoCheck()
            ->batchCheck($this->config->company->edit->requiredFields, 'notempty')
            ->batchCheck('name', 'unique', "id != '$companyID'")
            ->where('id')->eq($companyID)
            ->exec();
    }

    /**
     * Build search form.
     *
     * @param  int    $queryID
     * @param  string $actionURL
     * @access public
     * @return void
     */
    public function buildSearchForm($queryID, $actionURL)
    {
        $this->config->company->browse->search['actionURL'] = $actionURL;
        $this->config->company->browse->search['queryID']   = $queryID;
        $this->config->company->browse->search['params']['dept']['values'] = array('' => '') + $this->loadModel('dept')->getOptionMenu();

        $this->loadModel('search')->setSearchParams($this->config->company->browse->search);
    }
    /**
     * 获取他的group组名
     * @param string $value [description]
     */
    public function userGroup($account,$group_id)
    {
         return $this->dao->select('*')->from('zt_usergroup')
        ->where('account')->eq($account)->andWhere('`group`')->eq($group_id)->fetch();
    }
    /**
     * 选择题
     * @param  [type] 1为选择题，2位判断题
     * @return [type]       [description]
     */
    public function createitem()
    {
        // print_r($_POST['option']);die;

        $data =(array)fixer::input('post')->add('create_at', time()) ->get();
         if(empty($_POST['option'])){
            $options="";
        }else{
             $options=implode(",",$data[option]);
        }
        // print_r($data);die;
       
        $answer=array('answers'=>$data[answerA].'--'.$data[answerB].'--'.$data[answerC].'--'.$data[answerD],'type'=>1,'option'=>$options);
        unset($data[answerA],$data[answerB],$data[answerC],$data[answerD]);
        $datares=(object)array_merge($data,$answer);
        // print_r($datares);die;
        $test = $this->dao->insert('zt_item')->data($datares)//对数据进行检查
        ->check('quetionID','unique')->batchCheck('quetionID, title,answers,option', 'notempty')
        ->exec();
        if (dao::isError()) {
                die(js::error(dao::getError()));
                // die(js::reload('parent'));
        }
    }
    /**
     * 判断题
     * @param 
     * @return [type]       [description]
     */
    public function createitemJudge()
    {
        $data =(array)fixer::input('post')->add('create_at', time()) ->get();
        $answer=array('type'=>2);
        $datares=(object)array_merge($data,$answer);
        $test = $this->dao->insert('zt_item')->data($datares)//对数据进行检查
        ->check('quetionID','unique')->batchCheck('quetionID, title,option', 'notempty')
        ->exec();
        if (dao::isError()) {
                die(js::error(dao::getError()));
                // die(js::reload('parent'));
        }
    }
    //自动定位题号
    public function questionId()
    {
        $res=$this->dao->select('*')->from('zt_item')->orderBy('quetionID desc')->fetch();
        $questionId=$res->quetionID+1;
        return $questionId;
    }
    public function getLisplan($orderBy = 'id_desc', $pager = null)
    {
        return $this->dao->select('*')->from('zt_itemrecord')->orderBy($orderBy)->page($pager)->fetchAll();
    }
    public function searchLisplan($company, $pager = null, $orderBy)
    {
        // return
        //  $res=$this->dao->select('*')->from('zt_itemrecord')->where("account")->like("%".$data['search']."%")->orderBy($orderBy)->page($pager)->fetchAll();
         return $this->dao->select('*')->from("zt_itemrecord")->where("company")->eq("1")->andwhere($company)->OrderBy($orderBy)->page($pager)->fetchAll();
            
         // echo $this->dao->printSQL();die;
         // print_r($res);die;
    }
    public function shows($id)
     {
        return $res= $this->dao->select('*')->from("zt_itemrecord")->where("id")->eq($id)->fetch();
     }
     public function showsitem($data)
     {
        //获取当前用户答题记录
         $data=explode("-",$data->item_rerd);
         $res= $this->dao->select('`option`')->from("zt_item")->orderBy('`type`,quetionID')->fetchAll();
         $last_names = array_column($res, 'option');
         $res=[];$arr=[];
         foreach ($data as $key => $value) {
            if ($value==$last_names[$key]) {
                if($value==5){
                    $value="✔";
                }elseif($value==6){ $value="✘";}
                    $arr['array']=$value;
                    $arr['message']="right";
            }else{
                $arr['array']=$value;
                    $arr['message']="wrong";
            }

             $res[$key] = $arr;
         }
         return $res;
     }
     //选择判断题
      public function selectitem()
     {
        return $res= $this->dao->select('*')->from("zt_item")->where("type")->eq(1)->orderBy('quetionID')->fetchAll();
     }
     public function panduanitem()
     {
        return $res= $this->dao->select('*')->from("zt_item")->where("type")->eq(2)->orderBy('quetionID')->fetchAll();
     }
     public function updateitemid($arr,$id)
     {
        return $this->dao->update('zt_item')->data($arr)->where('id')->eq($id)->exec();
     }

}
