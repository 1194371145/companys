<?php
/**
 * The control file of company module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     company
 * @version     $Id: control.php 5100 2013-07-12 00:25:23Z zhujinyonging@gmail.com $
 * @link        http://www.zentao.net
 */
class company extends control
{
    /**
     * Construct function, load dept and user models auto.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('dept');
    }

    /**
     * Index page, header to browse.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $this->locate($this->createLink('company', 'browse'));
    }

    /**
     * Browse departments and users of a company.
     * 
     * @param  int    $param 
     * @param  string $type 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function browse($param = 0, $type = 'bydept', $orderBy = 'id', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->loadModel('search');
        $this->lang->set('menugroup.company', 'company');

        $deptID = $type == 'bydept' ? (int)$param : 0;
        $this->company->setMenu($deptID);

        /* Save session. */
        $this->session->set('userList', $this->app->getURI(true));

        /* Set the pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        /* Build the search form. */
        $queryID   = $type == 'bydept' ? 0 : (int)$param;
        $actionURL = $this->createLink('company', 'browse', "param=myQueryID&type=bysearch");
        $this->company->buildSearchForm($queryID, $actionURL);

        /* Get users. */
        $users = $this->company->getUsers($type, $queryID, $deptID, $sort, $pager);

        /* Assign. */
        $this->view->title       = $this->lang->company->index . $this->lang->colon . $this->lang->dept->common;
        $this->view->position[]  = $this->lang->dept->common;
        $this->view->users       = $users;
        $this->view->searchForm  = $this->fetch('search', 'buildForm', $this->config->company->browse->search);
        $this->view->deptTree    = $this->dept->getTreeMenu($rooteDeptID = 0, array('deptModel', 'createMemberLink'));
        $this->view->parentDepts = $this->dept->getParents($deptID);
        $this->view->orderBy     = $orderBy;
        $this->view->deptID      = $deptID;
        $this->view->pager       = $pager;
        $this->view->param       = $param;
        $this->view->type        = $type;

        $this->display();
    }

    /**
     * Edit a company.
     * 
     * @access public
     * @return void
     */
    public function edit()
    {
        if(!empty($_POST))
        {
            $this->company->update();
            if(dao::isError()) die(js::error(dao::getError()));

            /* reset company in session. */
            $company = $this->loadModel('company')->getFirst();
            $this->session->set('company', $company);

            die(js::reload('parent.parent'));
        }

        $this->company->setMenu();
        $title      = $this->lang->company->common . $this->lang->colon . $this->lang->company->edit;
        $position[] = $this->lang->company->edit;
        $this->view->title     = $title;
        $this->view->position  = $position;
        $this->view->company   = $this->company->getById($this->app->company->id);

        $this->display();
    }

    /**
     * View a company.
     * 
     * @access public
     * @return void
     */
    public function view()
    {
        $this->company->setMenu();
        $this->view->title      = $this->lang->company->common . $this->lang->colon . $this->lang->company->view;
        $this->view->position[] = $this->lang->company->view;
        $this->view->company    = $this->company->getById($this->app->company->id);
        $this->display();
    }

    /**
     * Company dynamic.
     * 
     * @param  string $browseType 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function dynamic($browseType = 'today', $param = '', $orderBy = 'date_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->company->setMenu();
        $this->app->loadLang('user');
        $this->app->loadLang('project');
        $this->loadModel('action');

        /* Save session. */
        $uri = $this->app->getURI(true);
        $this->session->set('productList',     $uri);
        $this->session->set('productPlanList', $uri);
        $this->session->set('releaseList',     $uri);
        $this->session->set('storyList',       $uri);
        $this->session->set('projectList',     $uri);
        $this->session->set('taskList',        $uri);
        $this->session->set('buildList',       $uri);
        $this->session->set('bugList',         $uri);
        $this->session->set('caseList',        $uri);
        $this->session->set('testtaskList',    $uri);

        /* Set the pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        /* Set the user and type. */
        $account = $browseType == 'account' ? $param : 'all';
        $product = $browseType == 'product' ? $param : 'all';
        $project = $browseType == 'project' ? $param : 'all';
        $period  = ($browseType == 'account' or $browseType == 'product' or $browseType == 'project') ? 'all'  : $browseType;
        $queryID = ($browseType == 'bysearch') ? (int)$param : 0;

        /* Get products' list.*/
        $products = $this->loadModel('product')->getPairs('nocode');
        $products = array($this->lang->company->product) + $products;
        $this->view->products = $products;



        /* Get users.*/
        $users = $this->loadModel('user')->getPairs('nodeleted|noclosed');
        $users[''] = $this->lang->company->user;
        $this->view->users    = $users; 

        /* The header and position. */
        $this->view->title      = $this->lang->company->common . $this->lang->colon . $this->lang->company->dynamic;
        $this->view->position[] = $this->lang->company->dynamic;

        /* Get actions. */
        if($browseType != 'bysearch') 
        {
            $actions = $this->action->getDynamic($account, $period, $sort, $pager, $product, $project);
        }
        else
        {
            $actions = $this->action->getDynamicBySearch($products, $projects, $queryID, $sort, $pager); 
        }

        /* Build search form. */
        $projects[0] = '';
        $products[0] = '';
        $users['']   = '';
        ksort($projects);
        ksort($products);
        $projects['all'] = $this->lang->project->allProject;
        $products['all'] = $this->lang->product->allProduct;
        $this->config->company->dynamic->search['actionURL'] = $this->createLink('company', 'dynamic', "browseType=bysearch&param=myQueryID");
        $this->config->company->dynamic->search['queryID']   = $queryID;
        $this->config->company->dynamic->search['params']['project']['values'] = $projects;
        $this->config->company->dynamic->search['params']['product']['values'] = $products; 
        $this->config->company->dynamic->search['params']['actor']['values']   = $users; 
        $this->loadModel('search')->setSearchParams($this->config->company->dynamic->search);

        /* Assign. */
        $this->view->browseType = $browseType;
        $this->view->account    = $account;
        $this->view->product    = $product;
        $this->view->project    = $project;
        $this->view->queryID    = $queryID; 
        $this->view->actions    = $actions;
        $this->view->orderBy    = $orderBy;
        $this->view->pager      = $pager;
        $this->view->param      = $param;
        $this->display();
    }
    /**
     * 内控设置题目
     */
    public function setItem()
    {
        $group_id=19;//默认group表id为19的为内控部门
        $account=$this->app->user->account;//获取当前用户
        $res=$this->company->userGroup($account,$group_id);
        // print_r($res);die;
        //当前用户有权限访问该接口时
        if($res){
            $select=$this->company->selectitem();//选择题
            $panduan=$this->company->panduanitem();//判断题
            $this->view->selectres=$select;
            $this->view->panduanres=$panduan;
        $this->company->setMenu();//下面标题输出Company::Info
        $this->view->title= $this->lang->company->common . $this->lang->colon . $this->lang->company->view;
        $this->view->position[] = $this->lang->company->item;//设置尾部所属快
        $this->view->company    = $this->company->getById($this->app->company->id);
        }else{//该用户不属于内控部门时
            echo js::error("您没有权限进行出题");
            echo "<script type='text/javascript'>history.go(-1)</script>";
        }
        $this->display();
    }
    public function uitemRecord($company='1',$search = 'normal',$param = 0,$orderBy = 'id_desc', $recTotal = 0, $recPerPage = 2, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
 // print_r($pager);
        $group_id=19;//默认group表id为19的为内控部门
        $account=$this->app->user->account;//获取当前用户
        $res=$this->company->userGroup($account,$group_id);//当前用户有权限访问该接口时
        if($res){
        if($search == 'normal'){
        $gets = $this->company->getLisplan($orderBy,$pager);
      }else{//搜索功能
        $queryID=(int)$param;
        if($queryID){
          $query = $this->search->getQuery($queryID);
          if($query){
            $this->session->set("deviceQuery",$query->sql);
            $this->session->set("deviceQuery",$query->form);
          }else{
            $this->session->set("deviceQuery","1 = 1");
          }
        }
        else
        {
          if($this->session->deviceQuery == false) $this->session->set('deviceQuery', ' 1 = 1');
        }

        $where = $this->session->deviceQuery;//var_dump($where);die;
        $gets = $this->company->searchLisplan($where,$company,$orderBy,$pager);//var_dump($list);die;
      }
        $this->config->company->devicecode->search['actionURL']=$this->createLink('company','uitemRecord',"company=$company&program=bysearch");
            $this->config->company->devicecode->search['queryID']=$queryID;
            $this->view->searchForm=$this->fetch('search','buildForm',$this->config->company->devicecode->search);
           // if(!empty($_POST)){//如果提交了搜索
           //    $gets = $this->company->searchLisplan($orderBy,$pager);
           //   }else{
           //      $gets = $this->company->getLisplan($orderBy,$pager);
           //   }
        $this->view->list = $gets;
        $this->view->pager        = $pager;
        $this->view->recTotal     = $pager->recTotal;
        $this->view->recPerPage   = $pager->recPerPage;
        $this->view->orderBy      = $orderBy;
        //下面输出基本的模块内容
        $this->company->setMenu();
        $this->view->title= $this->lang->company->common . $this->lang->colon . $this->lang->company->view;
        $this->view->position[] = $this->lang->company->item;//设置尾部所属快
        $this->view->company    = $this->company->getById($this->app->company->id);
        }else{//该用户不属于内控部门时
            echo js::error("您没有权限进行出题");
            echo "<script type='text/javascript'>history.go(-1)</script>";
        }
        $this->display();
    }
    /**
     * 出题块，选择填空题
     * @param   $type ==judge时为判断题，==selt为选择题
     * @return [type]       [description]
     */
    public function createitem($type)
    {
        $group_id=19;//默认group表id为19的为内控部门
        $account=$this->app->user->account;//获取当前用户
        $res=$this->company->userGroup($account,$group_id);
        //当前用户有权限访问该接口时
        if($res){
            if($type==judge){//判断题
                if(!empty($_POST)){
                    $_POST['quetionID']=trim($_POST['quetionID']);
                    $_POST['title']=trim($_POST['title']);
                    if(empty($_POST['quetionID'])||empty($_POST['title'])||!is_numeric($_POST['quetionID'])){
                    echo js::alert("请答题完成");
                    die(js::locate($this->createLink('company','setItem'),'parent'));
                }
                    // print_r($_POST);die;
            $rrs = $this->company->createitemJudge();
            if(dao::isError()) die(js::error(dao::getError()));
        die(js::locate($this->createLink('company','setItem'),'parent'));
                }
            }elseif($type==selt){//选择题
                if(!empty($_POST)){
                    $_POST['quetionID']=trim($_POST['quetionID']);
                    $_POST['title']=trim($_POST['title']);
                    $_POST['answerA']=trim($_POST['answerA']);
                    $_POST['answerB']=trim($_POST['answerB']);
                    $_POST['answerC']=trim($_POST['answerC']);
                    $_POST['answerD']=trim($_POST['answerD']);
                     if(empty($_POST['quetionID'])||empty($_POST['title'])||empty($_POST['answerA'])||empty($_POST['answerB'])||empty($_POST['answerC'])||empty($_POST['answerD'])||!is_numeric($_POST['quetionID'])||!isset($_POST['option'])){
                    echo js::alert("请答题完成");
                    die(js::locate($this->createLink('company','setItem'),'parent'));
                }
                    // print_r($_POST);die;
            $rrs = $this->company->createitem();
            if(dao::isError()) die(js::error(dao::getError()));
        die(js::locate($this->createLink('company','setItem'),'parent'));
                }
            }
            
            // echo $type;
        }else{//该用户不属于内控部门时
            echo js::error("您没有权限进行出题");
            echo "<script type='text/javascript'>history.go(-1)</script>";
        }
        $this->view->itemtype = $type;//题目类型
        $this->view->questionId = $this->company->questionId();//自动定位题号
        $this->display();
    }
    /**
     * 答题记录详细
     * @return [type]       [description]
     */
    public function showsetitem($id)
    {
        $res=$this->company->shows($id);
        $ress=$this->company->showsitem($res);
        $this->view->itemfor = $res;//题目出于谁
        $this->view->record = $ress;//答题记录
        $this->view->questionId = $this->company->questionId();//自动定位题号
        $this->display();
    }
    public function itemexec($id,$type)
    {
        $res= $this->dao->select('*')->from("zt_item")->where("id")->eq($id)->fetch();
        $arr=explode("--",$res->answers);
        $this->view->res = $res;
        $this->view->arr = $arr;
        $this->view->type = $type;
        $this->display();
    }
    public function edititem($id,$type)
    {
        $res= $this->dao->select('*')->from("zt_item")->where("id")->eq($id)->fetch();
        $arr=explode("--",$res->answers);
        if(!empty($_POST)){
             $arr=[];
            if($type==select){
                 $_POST[title]=trim($_POST[title]);
            $_POST[answersA]=trim($_POST[answersA]);
            $_POST[answersB]=trim($_POST[answersB]);
            $_POST[answersC]=trim($_POST[answersC]);
            $_POST[answersD]=trim($_POST[answersD]);
            if(empty($_POST[title])||empty($_POST[answersA])||empty($_POST[answersB])||empty($_POST[answersC])||empty($_POST[answersD])){
                    echo js::alert("请答题完成");
                    die(js::locate($this->createLink('company','setItem'),'parent'));
                }
            $arr['title']=$_POST[title];
            unset($_POST[title]);
            $arr['answers']=implode("--", $_POST);
            // print_r($arr);die;
            }elseif($type==panduan){
                $arr['title']=trim($_POST[title]);
                if(empty($arr['title'])){
                    echo js::alert("请答题完成");
                    die(js::locate($this->createLink('company','setItem'),'parent'));
                }
            // print_r($arr);die;
            }
            $ress=$this->company->updateitemid($arr,$id);
            if(dao::isError()) die(js::error(dao::getError()));
        die(js::locate($this->createLink('company','setItem'),'parent'));
            
        }
        $this->view->res = $res;
        $this->view->arr = $arr;
        $this->view->type = $type;
        $this->display();
    }

}
