<?php
class trainModel extends model
{
public function __construct()
	{
		parent::__construct();
	}
	
public function createtrain()
{
	if(empty($_POST['classname']))
	{
		die(js::error('文档分类内容不能为空!!!'));
	}
	$data=fixer::input('post')->stripTags()->get();//var_dump($data);die;
	$this->dao->insert("zt_trainclass")->data($data)->autoCheck()->exec();
    if(!dao::isError())
        {
           return $this->dao->lastInsertID();
            
        }
        else
        {
          die(js::error(dao::getError()));
        }      
}
public function gettree()
{
	$getsql = $this->dao->select('*')->from('zt_trainclass')->fetchAll();
	foreach($getsql as $k=>$v)
	{
		if($v->f_id==0)
		{   $getsqls = $this->dao->select('*')->from('zt_trainclass')->where("f_id")->ne(0)->fetchAll();
			$get.= "<ul style='font-size:20px;' id=$v->id>"/*."<a href='index.php?m=train&f=trainlist&id=$v->id&f_id=$v->f_id'>"*/."<font size='3' color='#000000' face='Microsoft YaHei'>".$v->classname."</font>"/*."</a>"*/;
			foreach($getsqls as $kk=>$vv)
			{
				if($vv->f_id == $v->id)
				{
					$get.="<li style='font-size:15px;list-style-type:none;' id=$vv->id>"."<p style='width:250px;'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---"."<a href='index.php?m=train&f=trainlist&id=$vv->id&f_id=$vv->f_id'>"."<font size='2' color='#000000' face='Microsoft YaHei'>".$vv->classname."</font>"."</a>".html::a(helper::createLink('train', 'edit', "id={$vv->id}&f_id={$vv->f_id}"), "<font size='3' color='#DC143C' face='Microsoft YaHei'>编辑</font>").html::a(helper::createLink('train', 'delete', "id={$vv->id}&f_id={$vv->f_id}"), "<font size='3' color='#DC143C' face='Microsoft YaHei'>删除</font>")."</p>"."</li>";
/*				foreach($getsqls as $ks=>$vs)
				{
					if($vs->f_id == $vv->id)
					{
					$get.="<li style='font-size:15px;list-style-type:none;' id=$vs->id>"."<p style='width:280px;'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|---"."<a href='index.php?m=train&f=trainlist&id=$vs->id&f_id=$vs->f_id'>"."<font color='red'>".$vs->classname."</font>"."</a>".html::a(helper::createLink('train', 'edit', "id={$vs->id}&f_id={$vs->f_id}"), "编辑").html::a(helper::createLink('train', 'delete', "id={$vs->id}&f_id={$vs->f_id}"), "删除")."</p>"."</li>";
						
					}
				}*/
				}
			}
		}$get .= "</ul>";
	}
	return $get;
	
}
/*
 * 对象转化为shuzu
 */
public function object2array($object) {
  if (is_object($object)) {
    foreach ($object as $key => $value) {
      $array[$key] = $value;
    }
  }
  else {
    $array = $object;
  }
  return $array;
}
/*
 * 根据GET过来的id
 * 获取对应文章的数据
 */
public function get_content()
{
  $ret = $this->dao->select("*")->from('zt_traincontent')->where('typeid')->eq($_GET['id'])->fetch();//var_dump($ret);die;
  return $ret;
}
/*public function get_typeid()
{
	$re = $this->get_content();var_dump($re);die;
}*/
/*
 * 链接trainclass
 * 获取classname
 */
public function get_title()
{
  $title = $this->dao->select("*")->from('zt_trainclass')->where('id')->eq($_GET['id'])->andwhere('f_id')->eq($_GET['f_id'])->fetch();//var_dump($ret);die;
  return $title;
}
///*
// * 编辑tree
// */
//public function edit_train()
//{//var_dump($_GET['f_id']);die;
//	$edit_tree = $this->get_title();//var_dump($edit_tree);die;
//	$re =  html::a(helper::createLink('train', 'edit', "id={$_GET['id']}&f_id={$_GET['f_id']}"), "编辑");
//	return $re;
//}


/*
 * 创建文章
 */
public function createcontent()
{
    if(empty($_POST['classname']))
    {
    	die(js::error("The Class Name Cannot Be Empty!"));
    }
    if(empty($_POST['document']))
    {
    	die(js::error("The Document Cannot Be Empty!"));
    }
    if(empty($_POST['introduction']))
    {
    	die(js::error("The Introduction Cannot Be Empty!"));
    }
    if(empty($_POST['content']))
    {
    	die(js::error("The Content Cannot Be Empty!"));
    }
    $get_f_id = $this->dao->select('*')->from('zt_trainclass')->where('classname')->eq($_POST['classname'])->fetch();//var_dump($get_f_id);die;
	$this->dao->insert('zt_trainclass')->set('classname')->eq($_POST['document'])->set('f_id')->eq($get_f_id->id)->autoCheck()->exec();
	$ty = $this->dao->lastInsertID();//var_dump($ty);die;
	
	$data=fixer::input('post')->stripTags("content") 
	          ->add('typeid',$ty) 
	          ->add('createby',$this->app->user->account) 
	          ->add('adddate',date("Y-m-d H:i:s"))
	          ->remove('document,classname')
			  ->get();
     $this->dao->insert('zt_traincontent')->data($data)->exec();
     if(!dao::isError())
        {
           return $this->dao->lastInsertID();
            
        }
        else
        {
          die(js::error(dao::getError()));
        }	
}
/*
 * 查询trainclass的classname数据
 */
public function get_classname()
{
	$get_name = $this->dao->select('*')->from('zt_trainclass')->where('f_id')->eq(0)->fetchAll();//var_dump($get_name);die;
	foreach($get_name as $k=>$v)
	{
		$get_names[$v->classname] = $v->classname;
	}
	return $get_names;
}
public function edit_title()
{
	$editt = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($_GET['id'])->andwhere('f_id')->eq($_GET['f_id'])->fetch();
	$editts = $editt->classname;
	return $editts;
}
public function edit_model()
{
	$editm = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($_GET['f_id'])->fetch();//var_dump($editm);die;
	$editmodel = $editm->classname;
	return $editmodel;
}
public function get_titleId($id,$f_id)
{
	return $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($_GET['id'])->andwhere('f_id')->eq($_GET['f_id'])->fetch();
}
/*
 * 编辑
 */
public function updatetitle()
{
	if(empty($_POST['classname']))
	{
		die(js::error("请保证标题不为空!"));
	}
	$data=fixer::input('post')->stripTags()->get();
    $this->dao->update('zt_trainclass')->data($data)->autoCheck()->where('id')->eq($_GET['id'])->exec();
	if(dao::isError()){die(js::alert(dao::getError()));}
	return $changes;
}
public function getcontentid($id,$typeid)
{
	return $this->dao->select('*')->from('zt_traincontent')->where('id')->eq($id)->andwhere('typeid')->eq($typeid)->fetch();
	
}
public function updatecontent($id,$typeid)
{   //var_dump(strip_tags($_POST['content']));die;
	if(empty($_POST['content']))
	{
		die(js::error('Please ensure that the article is not empty!'));
	}
    if(empty($_POST['introduction']))
	{
		die(js::error('Please ensure that the summary is not empty!'));
	}
	$data=fixer::input('post')->stripTags('content')
	           //->add('content',strip_tags($_POST['content']))
	           ->add("typeid",$typeid)
	           ->add("lastupdate",date("Y-m-d"))
	           ->add("lastcreateby",$this->app->user->account)
	           ->get();//var_dump($data);die;
	$tt = $this->dao->update('zt_traincontent')->data($data)->autoCheck()->where('id')->eq($id)->exec();
    if(dao::isError()){die(js::error(dao::getError()));}
	$changes=common::createChanges($olddata, $data);
	return $changes;
}
public function commentlist($id,$pager)
{
	$trr = $this->dao->select('*')->from('zt_traincomment')->where('cid')->eq($_GET['id'])->page($pager)->fetchAll();//var_dump($trr);die;
	foreach($trr as $k=>$v)
	{   if($v->f_tid == 0)
		{
			$get_comment .= "<table class='table-1 tablesorter'><tr bgcolor='#D0D0D0'><td><font size='2' color='#696969'>"."发表用户:".$v->account."</font></td>".
			                    "<td><font size='2' color='#696969'>"."&nbsp;&nbsp;&nbsp;&nbsp;"."发表时间:".$v->adddate."</font></td>"
			                   ."<td id=$v->cid>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::a(helper::createLink('train', 'trainreply', "id={$v->id}&cid={$v->cid}"), "回复")."</td>"
			                   ."<br/>".
			                   "<tr><td colspan=3><font size='4'>"."<p>".$v->content."</p>"."</font></td></tr>";
		}
		foreach($trr as $kk=>$vv)
		{
			if($vv->f_tid == $v->id)
			{
			$get_comment .= "<tr bgcolor='#F0F8FF'><td><font size='2' color='#696969'>"."回复用户:".$vv->account."</font></td>".
			                    "<td><font size='2' color='#696969'>"."&nbsp;&nbsp;&nbsp;&nbsp;"."回复时间:".$vv->adddate."</font></td>"
			                   ."<td id=$vv->cid>"./*"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::a(helper::createLink('train', 'trainreply', "id={$vv->id}&cid={$vv->cid}"), "回复").*/"</td>"
			                   ."<br/>".
			                   "<tr><td colspan=3><font size='4'>"."<p>".$vv->content."</p>"."</font></td></tr>";
			}
		}
	}
	return $get_comment."</table>";
}
/*public function get_replycontent($id,$cid)
{
	return $this->dao->select('*')->from('zt_traincomment')->where('id')->eq($_GET['id'])->andwhere('cid')->eq($_GET['cid'])->fetch();
}*/
public function trainreply($id,$cid)
{  
	 $ty = $this->dao->select("MAX(id) as ids")->from("zt_traincomment")->fetch();//var_dump($ty);die;
	$get_d = $this->dao->select('*')->from('zt_traincomment')->where('id')->eq($_GET['id'])->andwhere('cid')->eq($_GET['cid'])->fetch();
	if(empty($_POST['content']))
	{
		die(js::error("Comment content cannot be empty!"));
	}

	$data=fixer::input('post')->stripTags('content')
	            ->add('cid',$_GET['cid'])
	            ->add('f_tid',$_GET['id'])
	            ->add('account',$this->app->user->account) 
	            ->add('adddate',date('Y-m-d H:i:s'))    
	            ->get();//var_dump($data);die;
	 $this->dao->insert('zt_traincomment')->data($data)->exec();
     if(!dao::isError())
        {
           return $this->dao->lastInsertID();
            
        }
        else
        {
          die(js::error(dao::getError()));
        }	
}
public function add_reply($id)
{   
	//if(empty($id)){die(js::error("Without an article, you can't comment for now!"));}
	if(empty($_POST['content']))
	{
		die(js::error("Comment content cannot be empty!"));
	}
	if(empty($_POST['title']))
	{
		die(js::error("Comment title cannot be empty!"));
	}
	$datas=fixer::input('post')->stripTags("content")
	            ->add('cid',$_GET['id'])
	            ->add('f_tid',"0")
	            ->add('account',$this->app->user->account)
	            ->add('adddate',date("Y-m-d H:i:s"))
	            ->get();
    $this->dao->insert('zt_traincomment')->data($datas)->exec();
    if(!dao::isError())
        {
           return $this->dao->lastInsertID();
            
        }
        else
        {
          die(js::error(dao::getError()));
        }            
}
public function old_top_title($id,$f_id)
{
  $old_topt = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($id)->andwhere('f_id')->eq(0)->fetch();
  return $old_topt->classname;
}
public function edittoptitle($id)
{
	$data = fixer::input('post')->stripTags()->get();
	$this->dao->update('zt_trainclass')->data($data)->autoCheck()->where('id')->eq($id)->exec();
	if(dao::isError()){die(js::alert(dao::getError()));}
	return $changes;
}
public function comment_list($orderBy,$pager)
{
   return $this->dao->select('*')->from('zt_traincomment')->where('f_tid')->eq(0)->orderBy('id_desc')->page($pager)->fetchAll();
}
public function search_comment_list($commentquery,$orderBy,$pager)
{
	return $this->dao->select('*')->from('zt_traincomment')->where('f_tid')->eq(0)->andwhere($commentquery)->orderBy('id_desc')->page($pager)->fetchAll();
}





















}