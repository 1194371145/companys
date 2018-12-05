<?php
class mpModel extends model
{
	public function __construct()
	{
		$this->loadModel('action');
		parent::__construct();
	}
	function excelTime($date, $time = false) {
	if(function_exists('GregorianToJD')){
	if (is_numeric( $date )) {
	$jd = GregorianToJD( 1, 1, 1970 );
	$gregorian = JDToGregorian( $jd + intval ( $date ) - 25569 );
	$date = explode( '/', $gregorian );
	$date_str = str_pad( $date [2], 4, '0', STR_PAD_LEFT )
	."-". str_pad( $date [0], 2, '0', STR_PAD_LEFT )
	."-". str_pad( $date [1], 2, '0', STR_PAD_LEFT )
	. ($time ? " 00:00:00" : '');
	return $date_str;
	}
	}else{
	$date=$date>25568?$date+1:25569;
	/*There was a bug if Converting date before 1-1-1970 (tstamp 0)*/
	$ofs=(70 * 365 + 17+2) * 86400;
	$date = date("Y-m-d",($date * 86400) - $ofs).($time ? " 00:00:00" : '');
	}
	  return $date;
	}
	public function getallmp($orderBy,$pager,$region = '')
	{
		$re=$this->dao->select("*")->from('zt_mp')
							   ->where('deleted')->eq(0)
                               ->beginIF(!empty($region))
							   ->andWhere('openby')->eq($this->app->user->account)
                               ->FI()
							   ->orderBy($orderBy)
							   ->page($pager)
							   ->fetchAll();
		$where=$this->dao->get();
		$where=explode("WHERE",$where);
		$where=$where[1];
		$where=explode("ORDER", $where);
		$this->session->set("exportmp",$where[0]);
		$order=explode("limit",$where[1]);
		$this->session->set("exportorder",str_replace("BY", "",$order[0]));
		return $re;					   
	}
	public function getallmpbysearch($where,$orderBy,$pager,$region)
	{
        $re = $this->dao->select("*")->from('zt_mp')
            ->where('deleted')->eq(0)
            ->beginIF($where)
            ->andWhere($where)
            ->fi()
            ->beginIF(!empty($region))
			->andwhere('openby')->eq($this->app->user->account)
            ->fi()
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll();
		$where=$this->dao->get();
		$where=explode("WHERE",$where);
		$where=$where[1];
		$where=explode("ORDER", $where);
		$this->session->set("exportmp",$where[0]);
		$order=explode("limit",$where[1]);
		$this->session->set("exportorder",str_replace("BY", "",$order[0]));
		return 	$re;				   
	}
	public function getbasicbyid($id,$region = '')
	{
		return $this->dao->select("*")->from('zt_mp')
									  ->where('id')->eq($id)
									  ->andWhere('deleted')->eq(0)
                                      ->beginIF(!empty($region))
                                      ->andwhere('region')->eq($region)
                                      ->fi()
									  ->fetch();
	}
	public function getexportdata($region = '')
	{
        return $this->dao->select("*")->from('zt_mp')
            ->where($this->session->exportmp)
            ->beginIF($region)
            ->andwhere('region')->eq($region)
            ->fi()
            ->orderBy($this->session->exportorder)
            ->fetchAll();
    }
	public function editmp($id)
	{
		$olddata=$this->getbasicbyid($id);
		$existsid=$this->dao->select("id")->from('zt_mp')
										->where('device')->eq($_POST['device'])
										->andWhere('wafer_lot')->eq($_POST['wafer_lot'])
										->andWhere('deleted')->eq(0)
										->andWhere('id')->ne($id)
										->fetch('id');
		if($existsid->id>0){die(js::error("修改后的信息已经存在请核对！！！"));}
		
					$lot=intval($_POST['wafer_lot']);
					if($lot!='0')
					{
					$lot=str_replace($lot,"",$_POST['wafer_lot']);
					$lotf=substr($lot,0,1);
					if($lotf=='-'){$lot=substr($lot,1);}else{$lot=substr($lot,0);}
					}
					else 
					{
						$lot=$_POST['wafer_lot'];
					}
					$orderdata1=$this->getorderfielddata($_POST['device'],$lot);
					//var_dump($lot,$_POST['device'],$orderdata1);
					$orderdata2=$this->getorderfielddatebywaferlot($_POST['device'],$lot);
					//var_dump($orderdata2);die;
					//die;
					if(empty($_POST['top_mark']))
					{
						$_POST['top_mark']=!empty($orderdata1['top_mark']) ? $orderdata1['top_mark'] : $orderdata2['top_mark'];
					}
					
					if(empty($_POST['company']))
					{
						$_POST['company']=!empty($orderdata1['company']) ? $orderdata1['company'] : $orderdata2['company'];
					}
					if(empty($_POST['wafer_code']))
					{
						$_POST['wafer_code']=!empty($orderdata1['wafer_code']) ? $orderdata1['wafer_code'] : $orderdata2['wafer_code'];
					}
					$prodata=$this->getproductreleasefielddata($_POST['device']);
					if(empty($_POST['release_code'])){$_POST['release_code']=$prodata['release_code'];}
					if(empty($_POST['package'])){$_POST['package']=$prodata['package'];}
					if(empty($_POST['proline'])){$_POST['proline']=$prodata['proline'];}
					if(empty($_POST['ae'])){$_POST['ae']=$prodata['ae'];}
		$newdata=fixer::input('post')
				        ->stripTags()
				       // ->setIF(trim($_POST['release_code'])!=trim($_POST['wafer_code']),"status","不可送")
				        //->setIF(trim($_POST['release_code'])==trim($_POST['wafer_code']),"status","可送")
				        ->get()
				        ;
		$this->dao->update('zt_mp')->data($newdata)
								   ->autoCheck()
								   ->batchCheck($this->config->mp->editmp->requiredFields,"notempty")
								   ->check('qty','int')
								   ->where('id')->eq($id)
								   ->exec()
								   ;
		if(!dao::isError()){return common::createChanges($olddata, $newdata);}						   			        
		
	}
	public function mpbis_daoru($v)
	{
		$id=$this->dao->select("*")->from('zt_mpi')
							   ->where('device')->eq($v['device'])->andWhere('wafer_lot')->eq($v['wafer_lot'])
							   ->andWhere('date')->eq($v['date'])->andWhere('no')->eq($v['no'])->andWhere('qty')->eq($v['qty'])
							   ->andWhere('remark')->eq($v['remark'])
							   ->andWhere('deleted')->eq(0)
							   ->andWhere("region")->eq($v['region'])
							   ->fetch('id');
		if($id){return true;}else{return false;}
	}
	public function mpbis_exists($v)
	{
		$re=$this->dao->select('id,qty')->from('zt_mp')->where('device')->eq($v['device'])->andWhere('wafer_lot')->eq($v['wafer_lot'])->andWhere('deleted')->eq(0)->andWhere("region")->eq($v['region'])->fetch();
		if($re->id)
		{
			$this->dao->update('zt_mp')->set('qty')->eq($v['qty']+$re->qty)->autoCheck()->where('id')->eq($re->id)->exec();
			if(!dao::isError())
			{
				$v['mid']=$re->id;
				$this->dao->insert('zt_mpi')->data($v)->autoCheck()->exec();
				if(dao::isError()){die(js::error(dao::getError()));}
				$lastid=$this->dao->lastInsertID();
				$this->action->create("mpi",$lastid,"open");
				
				$actionID=$this->action->create('mpbasic',"$re->id","合并(入库)数量{$v['qty']} 入库ID: $lastid");
				$new=$old=$re;
				$new->qty=$re->qty + $v['qty'];
				if(common::createChanges($old, $new))
				{
					$this->action->logHistory($actionID,common::createChanges($old, $new));
				}
				return true;
			}
		}
		else 
		{
			return false;
		}
		
	}
	public function mpiis_exists($v)
	{
		$re=$this->dao->select('id,qty')->from('zt_mp')->where('device')->eq($v['device'])->andWhere('wafer_lot')->eq($v['wafer_lot'])->andWhere('deleted')->eq(0)->andWhere("region")->eq($v['region'])->fetch();
		if($re->id)
		{
			//$this->dao->update('zt_mp')->set('qty')->eq($v['qty']+$re->qty)->autoCheck()->where('id')->eq($re->id)->exec();
			//if(!dao::isError())
			//{
				//$this->action->create('mpbasic',"$re->id","入库{$v['qty']}");
				return $re->id;
			//}
		}
		else 
		{
			return false;
		}
		
	}
	public function getorderfielddatebywaferlot($part,$lot)
	{
		$sessionid=file_get_contents("https://csr.silergycorp.com:8585/index.php?m=api&f=getSessionID&t=json");
    	$sessionid=json_decode($sessionid);
    	$sessionid=json_decode($sessionid->data);
    	$sessionid=$sessionid->sessionID;
    	$loginarr=file_get_contents("https://csr.silergycorp.com:8585/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyw2e3&t=json");
    	$login=json_decode($loginarr);
    	if($login->status=='success')
    	{
    		$pic=file_get_contents("https://csr.silergycorp.com:8585/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=getorderfielddatebywaferlot&params=part=$part,lot=$lot&t=json");
    		$picdata=json_decode($pic);
    		$re=json_decode($picdata->data,true);
    		return $re;
    	}
	}
	public function getorderfielddata($part,$lot)
	{
		$sessionid=file_get_contents("https://csr.silergycorp.com:8585/index.php?m=api&f=getSessionID&t=json");
    	$sessionid=json_decode($sessionid);
    	$sessionid=json_decode($sessionid->data);
    	$sessionid=$sessionid->sessionID;
    	$loginarr=file_get_contents("https://csr.silergycorp.com:8585/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyw2e3&t=json");
    	$login=json_decode($loginarr);
    	if($login->status=='success')
    	{
    		$pic=file_get_contents("https://csr.silergycorp.com:8585/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=getorderfielddata&params=part=$part,lot=$lot&t=json");
    		$picdata=json_decode($pic);
    		$re=json_decode($picdata->data,true);
    		return $re;
    	}
		
	}
	public function getproductreleasefielddata($part)
	{
		$sessionid=file_get_contents("https://csr.silergycorp.com:8585/index.php?m=api&f=getSessionID&t=json");
    	$sessionid=json_decode($sessionid);
    	$sessionid=json_decode($sessionid->data);
    	$sessionid=$sessionid->sessionID;
    	$loginarr=file_get_contents("https://csr.silergycorp.com:8585/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyw2e3&t=json");
    	$login=json_decode($loginarr);
    	if($login->status=='success')
    	{
    		$pic=file_get_contents("https://csr.silergycorp.com:8585/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=getproductreleasefielddata&params=part=$part&t=json");
    		$picdata=json_decode($pic);
    		$re=json_decode($picdata->data,true);
    		return $re;
    	}
	}
	function getmpbyid($id,$region = '')
	{
		return $this->dao->select("*")->from('zt_mp')->where('id')->eq($id)->andWhere('deleted')->eq(0)->beginIF($region)->andwhere('region')->eq($region)->fi()->fetch();
	}
	function getindata($id)
	{
		return $this->dao->select('*')->from('zt_mpi')->where('mid')->eq($id)->fetchAll();
	}
	function getodata($id)
	{
		return $this->dao->select("*")->from('zt_out')->where('mid')->eq($id)->andWhere('close')->eq('done')->andWhere("type")->eq(1)->fetchAll();
	}
}