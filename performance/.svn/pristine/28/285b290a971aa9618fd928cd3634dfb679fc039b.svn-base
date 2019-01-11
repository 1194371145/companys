<?php
class train extends control
{
function __construct()
	{
		parent::__construct ();
		$this->loadModel ( 'user' );
		$this->loadModel ( 'action' );
		$this->loadModel ( 'file' );
		$this->loadModel ( 'mail' );
		$this->loadModel ('search');
		$this->loadModel('tree');
		$this->loadModel ( 'dept' );
		$this->loadModel('train');
	}
function index()
{
	$ids = $this->dao->select('min(id) as idt')->from('zt_trainclass')->where('f_id')->eq('1')->fetch();
//var_dump($ids->idt);die;
		$this->locate($this->inlink('trainlist',"id=$ids->idt&f_id=1"),'parent');


	    //index页面
}
public function trainlist($idt,$f_idt,$recTotal=0,$recPerPage=20,$pageID=1)
{ // var_dump($id);die;
    $this->app->loadClass('pager',true);
	$pager=pager::init($recTotal,$recPerPage,$pageID);
    //$ert = $this->dao->select('count(id) as ids')->from('zt_traincomment')->where('cid')->eq($id)->fetchAll();
    //$classid = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($cid->cid)->fetch();
if(!empty($_POST))
	{
		$id = $this->train->add_reply();
		if($file){$fileaction=''.$this->lang->addFiles.join(',',$file);}
				$this->action->create('文档',$id ,"创建 ",  $fileaction);
                $this->loadModel('action')->create('文档', $id, '创建');
                echo js::alert('success');
                die(js::locate($this->createLink('train', 'trainlist',"id=$idt&f_id=$f_idt"), 'parent')); 
	}
	$this->view->title        = "Train List";
	$this->view->getsqls=$this->train->gettree();//var_dump($this->view->getsqls);die;//树状结构
	$this->view->get_content=$this->train->get_content();//var_dump($this->view->get_content);die;//文章内容遍历
    $this->view->get_title=$this->train->get_title();//var_dump($this->view->get_title);die;//标题的遍历
    $this->view->commentlist=$this->train->commentlist($pager);
    $this->view->orderBy=$orderBy;
	$this->view->pager=$pager;
	$this->display();
}

public function createtrain()
{
	$idt = $this->dao->select('min(id) as idt')->from('zt_trainclass')->where('f_id')->eq('1')->fetch();
if(!empty($_POST))
	{
		$id = $this->train->createtrain();
		if($file){$fileaction=''.$this->lang->addFiles.join(',',$file);}
				$this->action->create('文档分类',$id ,"创建 ",  $fileaction);
                $this->loadModel('action')->create('文档分类', $id, '创建');
                echo js::alert('success');
                die(js::locate($this->createLink("train", "trainlist","id=$idt->idt&f_id=1"), 'top')); 
	}
	$this->view->title        = "Create Train";
	$this->display(); 
}
/*
 * 创建文档
 */
public function createcontent()
{ 
	$idt = $this->dao->select('min(id) as idt')->from('zt_trainclass')->where('f_id')->eq('1')->fetch();
	if(!empty($_POST))
	{
		$id = $this->train->createcontent();
		if($file){$fileaction=''.$this->lang->addFiles.join(',',$file);}
				$this->action->create('content',$id ,"create ",  $fileaction);
                $this->loadModel('action')->create('content', $id, 'create');
                echo js::alert('success');
                die(js::locate($this->createLink('train', 'trainlist',"id=$idt->idt&f_id=1"), 'parent')); 
	}
	$this->view->title        = "Create Content";
    $this->view->get_classname=$this->train->get_classname();//添加数据的模块名
	$this->display();
}
/*
 * 标题名称修改
 */
public function edit($ids,$f_id)
{
	$classid = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($cid->cid)->fetch();
    if(!empty($_POST))
    {
    	$changes = $this->train->updatetitle($id);//var_dump($changes);die;
    	if($file){$fileaction=''.$this->lang->addFiles.join(',',$file);}
		$actionID=$this->action->create("标题","$id","编辑" , $fileaction);
		$this->action->logHistory($actionID,$changes);
		//echo "<script type='text/javascript'>history.go(-1)</script>";
		die(js::locate($this->createLink('train','trainlist',"id=$classid->id&f_id=$classid->f_id"),'top'));
    }
	$this->view->edit_model=$this->train->edit_model();
	$this->view->edit_title=$this->train->edit_title();
	$this->view->get_classname=$this->train->get_classname();
	$this->display();
}
/*
 * 删除标题
 */
public function delete($id,$f_id,$confirm='no')
{ 
if($confirm == 'no')
        {
            die(js::confirm("Are you sure to delete this data?", $this->createLink('train', 'delete', "id=$id&f_id=$f_id&confirm=yes")));
        }else 
        {
			$re=$this->dao->delete()->from('zt_trainclass')->where('id')->eq($id)->exec();
			$this->action->create('标题',"$id","删除");
			die(js::locate($this->createLink('train','trainlist'),'parent'));
        }
}
/*
 * 编辑手册内容
 */
public function editcontent($id,$typeid)
{   
        $oldcontent = $this->train->getcontentid($id,$typeid);
		if($oldcontent->createby!=$this->app->user->account)
		{
			        echo js::error("Please follow the correct process to edit the document!");
					echo "<script type='text/javascript'>history.go(-1)</script>";
		}
	$get_fid = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($typeid)->fetch();
    $this->view->getcontentid = $this->train->getcontentid($id,$typeid);
if(!empty($_POST))
    {
    	$changes = $this->train->updatecontent($id,$typeid);
    	if($file){$fileaction=''.$this->lang->addFiles.join(',',$file);}
		$actionID=$this->action->create("内容","$id","编辑", $fileaction);
		$this->action->logHistory($actionID,$changes);
		die(js::locate($this->createLink('train','trainlist',"id=$typeid&f_id=$get_fid->f_id"),'parent'));
    }
	$this->display();
}
/*
 * 回复功能
 */
public function trainreply($id)
{
    $cid = $this->dao->select('*')->from('zt_traincomment')->where('id')->eq($id)->fetch();
    $classid = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($cid->cid)->fetch();
	if(!empty($_POST))
	{
		$id = $this->train->trainreply();
		if($file){$fileaction=''.$this->lang->addFiles.join(',',$file);}
		$this->action->create('文档',$id ,"创建 ",  $fileaction);
	    $this->loadModel('action')->create('文档', $id, '创建');
	    echo js::alert('success');
	    die(js::locate($this->createLink('train', 'trainlist',"id=$classid->id&f_id=$classid->f_id"), 'top')); 
	}
    $this->display();	
}
/*
 * 删除顶部标题功能
 */
public function edittoptitle($id,$f_id)
{    
	$this->view->old_top_title = $this->train->old_top_title($id,$f_id);
	$idt = $this->dao->select('min(id) as idt')->from('zt_trainclass')->where('f_id')->eq('1')->fetch();
	if(!empty($_POST))
	{
		$id = $this->train->edittoptitle($id);
		if($file){$fileaction=''.$this->lang->addFiles.join(',',$file);}
		$this->action->create('toptitle',$id ,"edit ",  $fileaction);
	    $this->loadModel('action')->create('toptitle', $id, 'edit');
	    echo js::alert('success');
	    die(js::locate($this->createLink('train', 'trainlist',"id=$idt->idt&f_id=1"), 'top'));  
	}
    $this->display();	
}
public function deltoptitle($id,$f_id,$confirm="no")
{
    $classid = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($cid->cid)->fetch();
	$pp = $this->dao->select('*')->from('zt_trainclass')->where('f_id')->eq($id)->fetchAll(); //var_dump($pp);die;
	if(!empty($pp))
	{
		echo js::error("Delete without permission!");
		echo "<script type='text/javascript'>history.go(-1)</script>";
		
	}
	else 
	{
		if($confirm == 'no')
	    {
	     die(js::confirm("Are you sure to delete this data?", $this->createLink('train', 'deltoptitle', "id=$id&f_id=$f_id&confirm=yes")));
	    }
	    else 
	    {
		$re=$this->dao->delete()->from('zt_trainclass')->where('id')->eq($id)->exec();//var_dump($re);die;
		$this->action->create('top_title',"$id","删除");
		die(js::locate($this->createLink('train','trainlist',"id=$classid->id&f_id=$classid->f_id"),'parent'));
	    }
	}
	
}
public function commentlist($program='normal',$recTotal=0,$recPerPage=20,$pageID=1)
{   
	$this->app->loadClass('pager', $static = true);
    $pager = new pager($recTotal, $recPerPage, $pageID);
    if($program=='normal')     //正常情况下
	{
	$result = $this->train->comment_list($orderBy,$pager);
	}
	else 
	{
	        $queryID=(int)$param;
            if ($queryID) 
              	{    
              		$query=$this->search->getQuery($queryID);
              	
              		if ($query) 
              		{
              			$this->session->set('commentQuery',$query->sql);
						$this->session->set('commentForm',$query->form);
              		}
              		else
              		{
              			$this->session->set('commentQuery',"1=1");
              		}
              	}
             
             $commentquery=$this->session->commentQuery; //var_dump($orderBy);die;
             $result=$this->train->search_comment_list($commentquery,$orderBy,$pager);
	}
	    $this->config->train->commentlist->search['actionURL']=$this->createLink('train','commentlist',"program=bysearch&");
		$this->config->train->commentlist->search['queryID']=$queryID;
		$this->view->searchForm=$this->fetch('search','buildForm',$this->config->train->commentlist->search);
		$this->view->title        = "Comment List";
		$this->view->browseType=$type;
		$this->view->comment_list = $result;
		$this->view->pager = $pager;
		$this->view->orderBy=$orderBy;
		$this->display();
}

public function deletereply($id,$cid,$confirm="no")
{
if($confirm == 'no')
	    {
	     die(js::confirm("Are you sure to delete this data?", $this->createLink('train', 'deletereply', "id=$id&cid=$cid&confirm=yes")));
	    }
	    else 
	    {
		$re=$this->dao->delete()->from('zt_traincomment')->where('id')->eq($id)->exec();//var_dump($re);die;
		$this->action->create('top_title',"$id","删除");
		die(js::locate($this->createLink('train','commentlist'),'parent'));
	    }
}


















}
?>