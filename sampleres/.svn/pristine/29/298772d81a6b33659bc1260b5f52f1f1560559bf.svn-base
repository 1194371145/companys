<?php
class sampleModel extends model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($orderBy,$pager,$region)
	{
		$but=$this->loadModel('group')->getUserPairs(14);
		$but=array_keys($but);
		$this->session->set("exportsampleorder",$orderBy);
		$re=$this->dao->select("*")->from('zt_sample')->where('deleted')->eq(0)
														 ->beginIF(!empty($region))
														 ->andWhere('openby')->eq($this->app->user->account)
														 ->fi()
														 ->orderBy($orderBy)->page($pager)->fetchAll('id');
		$sql=$this->dao->get();
		$sqla=explode("WHERE",$sql);
		$sqlaa=explode("ORDER",$sqla[1]);
		$this->session->set('exportsamplesql',$sqlaa[0]);
		return $re;
	}
	public function indexsearch($where,$orderBy,$pager,$region)
	{
		$but=$this->loadModel('group')->getUserPairs(14);
		$but=array_keys($but);
		$this->session->set("exportsampleorder",$orderBy);
		$re=$this->dao->select("*")->from('zt_sample')
										->where($where)
										->andWhere('deleted')->eq(0)
										->beginIF(!empty($region))
										->andWhere('openby')->eq($this->app->user->account)
										->fi()
										->orderBy($orderBy)
										->page($pager)
										->fetchAll('id');
		$sql=$this->dao->get();
		$sqla=explode("WHERE",$sql);
		$sqlaa=explode("ORDER",$sqla[1]);
		$this->session->set('exportsamplesql',$sqlaa[0]);
		return $re;

	}
	function getsamplebyid($id)
	{
		return $this->dao->select("*")->from('zt_sample')->where('id')->eq($id)
		->beginIF(!empty($region))
        ->andwhere('region')->eq($region)
        ->fi()	
		->andWhere('deleted')->eq("0")->fetch();
	}
	function editsample($id)
	{
		$old=$this->getsamplebyid($id);
		foreach($_POST as $key=>$value)
		{
			$where.=trim($key)." = '".trim($value)."' and ";
		}
		$where=substr($where,0,-4);
		$idd=$this->dao->select('id')->from('zt_sample')->where($where)->andWhere("deleted")->eq(0)->andWhere("id")->ne($id)->fetch("id");
		if($idd)
		{
			die(js::error("修改信息造成数据重复请修正"));
		}
		$pro=$this->getpeandphase(trim($_POST['device']));

		if(empty($_POST['pe']))$_POST['pe']=$pro['pe'];
		if(empty($_POST['status']))$_POST['status']=$pro['status'];
		if(empty($_POST['proline']))$_POST['proline']=$pro['proline'];
		if(empty($_POST['ae']))$_POST['ae']=$pro['ae'];
		$data=fixer::input('post')
					->stripTags()
					->get();
		$this->dao->update("zt_sample")->data($data)->autoCheck()->check("device","notempty")->where('id')->eq($id)->exec();
		if(dao::isError()){die(js::error(dao::getError()));}
		if(common::createChanges($old, $data))
		{
			return common::createChanges($old, $data);
		}
	}
	function is_daoru($v)
	{
		unset($v['pe']);unset($v['status']);
		$str=" ";
		foreach($v as $key=>$value)
		{
			$str.=$key." = '".$value."' and ";
		}
		$str=substr($str,0,-4);
		$re=$this->dao->select("id")->from('zt_sample')->where($str)->andWhere('deleted')->eq(0)->fetch();
		if($re->id)
		{
			return $re->id;
		}
		else
		{
			return false;
		}
	}
	public function getpeandphase($part)
	{  
		$sessionid=file_get_contents("https://csr.silergycorp.com:8585/index.php?m=api&f=getSessionID&t=json");
    	$sessionid=json_decode($sessionid);
    	$sessionid=json_decode($sessionid->data);
    	$sessionid=$sessionid->sessionID;
    	$loginarr=file_get_contents("https://csr.silergycorp.com:8585/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyw2e3&t=json");
    	$login=json_decode($loginarr);
    	if($login->status=='success')
    	{
    		$pic=file_get_contents("https://csr.silergycorp.com:8585/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=getpeandphase&params=part=$part&t=json");
    		$picdata=json_decode($pic);
    		$re=json_decode($picdata->data,true);
    		return $re;
    	}
	}
	public function getexportdata()
	{
		return $this->dao->select("*")->from('zt_sample')->where($this->session->exportsamplesql)->andWhere('deleted')->eq(0)->orderBy($this->session->exportsampleorder)->fetchAll();
	}
	public function getoutofdata($id)
	{
		return $this->dao->select("*")->from('zt_out')->where('mid')->eq($id)->andWhere('close')->eq('done')->andWhere("type")->eq(2)->fetchAll();
	}
	
}
