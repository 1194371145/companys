<?php

class item extends control
{
    //var $one;
    public function __construct($module = '', $method = '')
    {
        parent::__construct();
        $this->loadModel('item');
        //$this->my->setMenu();
    }
    public function index()
    {
        $this->locate($this->createLink('item', 'browse'));
    }
    /**
     * 内控题目模块
     * @return [type] [description]
     */
	public function browse()
	{
         $usedselect=$this->item->usedItem($this->app->user->id);//判断是否已经答过题
         if($usedselect){//return 
            $this->locate($this->createLink('item', 'useditem'));
         }
            $select=$this->item->selectItem();
             $choose=$this->item->chooseItem();
             if(!empty($_POST)){
                $counts=$this->dao->select('*')->from('zt_item')->count();
                $count=$counts+2;
                $post=count($_POST);
                if($count!=count($_POST)){
                    die(js::alert("请答题完成"));
                }
                $rrs = $this->item->itemJudge($select,$choose);
                if(dao::isError()) die(js::error(dao::getError()));
        die(js::locate($this->createLink('item','useditem'),'parent'));
             }
             // print_r($select);
             // echo '<br>';
             // print_r($choose);die;
            $this->view->choitem = $choose;//判断题
            $this->view->selitem = $select;//选择题

		    $this->display();
	}
    public function useditem()
    {
        $mark=$this->dao->select('id,mark')->from('zt_itemrecord')
        ->where('user_id')->eq($this->app->user->id)->fetch();
         $this->view->mark = $mark->mark;//选择题
        $this->display();
    }

	
}
?>