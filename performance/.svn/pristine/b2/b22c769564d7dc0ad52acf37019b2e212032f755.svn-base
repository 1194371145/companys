<?php
/**
 * The control file of dashboard module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     dashboard
 * @version     $Id: control.php 5020 2013-07-05 02:03:26Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
class my extends control
{
    /**
     * Construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($module = '', $method = '')
    {
        parent::__construct($module, $method);
        $this->loadModel('user');
        $this->loadModel('dept');
        $this->my->setMenu();
    }

    /**
     * Index page, goto todo.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
    	echo js::locate($this->createLink('my', 'dynamic'));
    	exit;
        $this->view->title = $this->lang->my->common;
        $this->display();
    }

    /**
     * My todos. 
     * 
     * @param  string $type 
     * @param  string $account 
     * @param  string $status 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function todo($type = 'today', $account = '', $status = 'all', $orderBy = "date_desc,status,begin", $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        /* Save session. */
        $uri = $this->app->getURI(true);
        $this->session->set('todoList', $uri);
        $this->session->set('bugList',  $uri);
        $this->session->set('taskList', $uri);

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        if($this->app->getViewType() == 'mhtml') $recPerPage = 10;
        $pager = pager::init($recTotal, $recPerPage, $pageID);

        /* The title and position. */
        $this->view->title      = $this->lang->my->common . $this->lang->colon . $this->lang->my->todo;
        $this->view->position[] = $this->lang->my->todo;

        /* Append id for secend sort. */
        $sort = $this->loadModel('common')->appendOrder($orderBy);

        /* Assign. */
        $this->view->todos        = $this->loadModel('todo')->getList($type, $account, $status, 0, $pager, $sort);
        $this->view->date         = (int)$type == 0 ? date(DT_DATE1) : date(DT_DATE1, strtotime($type));
        $this->view->type         = $type;
        $this->view->recTotal     = $recTotal;
        $this->view->recPerPage   = $recPerPage;
        $this->view->pageID       = $pageID;
        $this->view->status       = $status;
        $this->view->account      = $this->app->user->account;
        $this->view->orderBy      = $orderBy == 'date_desc,status,begin,id_desc' ? '' : $orderBy;
        $this->view->pager        = $pager;
        $this->view->importFuture = ($type != 'today');

        $this->display();
    }



    /**
     * Edit profile 
     * 
     * @access public
     * @return void
     */
    public function editProfile()
    {
        if($this->app->user->account == 'guest') die(js::alert('guest') . js::locate('back'));
        if(!empty($_POST))
        {
            $this->user->update($this->app->user->id);
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate($this->createLink('my', 'profile'), 'parent'));
        }

        $this->view->title      = $this->lang->my->common . $this->lang->colon . $this->lang->my->editProfile;
        $this->view->position[] = $this->lang->my->editProfile;
        $this->view->user       = $this->user->getById($this->app->user->account);

        $this->display();
    }

    /**
     * Change password 
     * 
     * @access public
     * @return void
     */
    public function changePassword()
    {
        if($this->app->user->account == 'guest') die(js::alert('guest') . js::locate('back'));
        if(!empty($_POST))
        {
            $this->user->updatePassword($this->app->user->id);
            if(dao::isError()) die(js::error(dao::getError()));
            die(js::locate($this->createLink('my', 'profile'), 'parent'));
        }

        $this->view->title      = $this->lang->my->common . $this->lang->colon . $this->lang->my->changePassword;
        $this->view->position[] = $this->lang->my->changePassword;
        $this->view->user       = $this->user->getById($this->app->user->account);

        $this->display();
    }



    /**
     * Delete a contact list.
     *
     * @param  int    $listID
     * @param  string $confirm
     * @access public
     * @return void
     */
    public function deleteContacts($listID, $confirm = 'no')
    {
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->user->contacts->confirmDelete, inlink('deleteContacts', "listID=$listID&confirm=yes")));
        }
        else
        {
            $this->user->deleteContactList($listID);
            die(js::locate(inlink('manageContacts'), 'parent'));
        }
    }

    /**
     * Build contact lists.
     *
     * @access public
     * @return void
     */
    public function buildContactLists()
    {
        $this->view->contactLists = $this->user->getContactLists($this->app->user->account, 'withnote');
        $this->display();
    }

    /**
     * View my profile.
     * 
     * @access public
     * @return void
     */
    public function profile()
    {
        if($this->app->user->account == 'guest') die(js::alert('guest') . js::locate('back'));

        $user = $this->user->getById($this->app->user->account);

        $this->view->title      = $this->lang->my->common . $this->lang->colon . $this->lang->my->profile;
        $this->view->position[] = $this->lang->my->profile;
        $this->view->user       = $user;
        $this->view->groups     = $this->loadModel('group')->getByAccount($this->app->user->account);
        $this->view->deptPath   = $this->dept->getParents($user->dept); 
        $this->display();
    }

    /**
     * My dynamic.
     * 
     * @param  string $type 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function dynamic($type = 'today', $orderBy = 'date_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
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

        /* The header and position. */
        $this->view->title      = $this->lang->my->common . $this->lang->colon . $this->lang->my->dynamic;
        $this->view->position[] = $this->lang->my->dynamic;

        /* Assign. */
        $this->view->type       = $type;
        $this->view->recTotal   = $recTotal;
        $this->view->recPerPage = $recPerPage;
        $this->view->pageID     = $pageID;
        $this->view->orderBy    = $orderBy;
        $this->view->pager      = $pager;
        $this->view->actions    = $this->loadModel('action')->getDynamic($this->app->user->account, $type, $sort, $pager);
        $this->display();
    }

    /**
     * Unbind ranzhi 
     * 
     * @param  string $confirm 
     * @access public
     * @return void
     */
    public function unbind($confirm = 'no')
    {
        $this->loadModel('user');
        if($confirm == 'no')
        {
            die(js::confirm($this->lang->user->confirmUnbind, $this->createLink('my', 'unbind', "confirm=yes")));
        }
        else
        {
            $this->user->unbind($this->app->user->account);
            die(js::locate($this->createLink('my', 'profile'), 'parent'));
        }
    }

}
