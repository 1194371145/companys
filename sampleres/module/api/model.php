<?php
/**
 * The model file of api module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     api
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class apiModel extends model
{
    public function getMethod($filePath, $ext = '')
    {
        $fileName  = dirname($filePath);
        $className = basename(dirname(dirname($filePath)));
        if(!class_exists($className)) include($fileName);
        $methodName = basename($filePath);

        $method = new ReflectionMethod($className . $ext, $methodName);
        $data   = new stdClass();
        $data->startLine  = $method->getStartLine();
        $data->endLine    = $method->getEndLine();
        $data->comment    = $method->getDocComment();
        $data->parameters = $method->getParameters();
        $data->className  = $className;
        $data->methodName = $methodName;
        $data->fileName   = $fileName;
        $data->post       = false;

        $file = file($fileName);
        for($i = $data->startLine - 1; $i <= $data->endLine; $i++)
        {
            if(strpos($file[$i], '$this->post') or strpos($file[$i], 'fixer::input') or strpos($file[$i], '$_POST'))
            {
                $data->post = true; 
            }
        }
        return $data;
    }

    /**
     * Request the api.
     * 
     * @param  string $moduleName 
     * @param  string $methodName 
     * @param  string $action 
     * @access public
     * @return void
     */
    public function request($moduleName, $methodName, $action)
    {
        $host  = common::getSysURL() . $this->config->webRoot;
        $param = '';
        if($action == 'extendModel')
        {
            if(!isset($_POST['noparam']))
            {
                foreach($_POST as $key => $value) $param .= ',' . $key . '=' . $value;
                $param = ltrim($param, ',');
            }
            $url   = rtrim($host, '/') . inlink('getModel',  "moduleName=$moduleName&methodName=$methodName&params=$param", 'json');
            $url  .= $this->config->requestType == "PATH_INFO" ? '?' : '&';
            $url  .= $this->config->sessionVar . '=' . session_id();
        }
        else
        {
            if(!isset($_POST['noparam']))
            {
                foreach($_POST as $key => $value) $param .= '&' . $key . '=' . $value;
                $param = ltrim($param, '&');
            }
            $url   = rtrim($host, '/') . helper::createLink($moduleName, $methodName, $param, 'json');
            $url  .= $this->config->requestType == "PATH_INFO" ? '?' : '&';
            $url  .= $this->config->sessionVar . '=' . session_id();
        }

        /* Unlock session. After new request, restart session. */
        session_write_close();
        $content = file_get_contents($url);
        session_start();

        return array('url' => $url, 'content' => $content);
    }

    /**
     * Query sql. 
     * 
     * @param  string    $sql 
     * @param  string    $keyField 
     * @access public
     * @return array
     */
    public function sql($sql, $keyField = '')
    {
        $sql  = trim($sql);
        if(strpos($sql, ';') !== false) $sql = substr($sql, 0, strpos($sql, ';'));
        a($sql);
        if(empty($sql)) return '';

        if(stripos($sql, 'select ') !== 0)
        {
            return $this->lang->api->error->onlySelect;
        }
        else
        {
            try
            {
                $stmt = $this->dao->query($sql);
                if(empty($keyField)) return $stmt->fetchAll();
                $rows = array();
                while($row = $stmt->fetch()) $rows[$row->$keyField] = $row;
                return $rows;
            }
            catch(PDOException $e)
            {
                return $e->getMessage();
            }
        }
    }
    public function createout($post)
    {
    	$data=array();
		$data['remark1']=$post;
		//$_POST['remark1']=$post;
    	$qianv=explode("value",$post);
    	foreach($qianv as $v)
    	{
    		$vv=explode("key",$v);
    		$data[$vv[0]]=$vv[1];
    	}
		//if($data['qty']>=100){$data['approve']='1';}
		if($_POST['qty']>=100 and $_POST['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India",$_POST['area'])===false){$_POST['approve']='1';}
    	if($_POST['qty']>=500 and $_POST['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India",$_POST['area'])!==false){$_POST['approve']='1';}
		$_POST['rev']=$_POST['aqty']*$_POST['price'];
    	$this->dao->insert('zt_out')->data($_POST)->autoCheck("shipdate")
    	->check('partn','notempty')
    	->checkIF($_POST['revtype']=='需要付费','distributor',"notempty")
    	->checkIF($_POST['revtype']=='需要付费','price',"notempty")
    	->batchCheck('rdate,createdate','date')
    	->exec();
    	if(dao::isError()){die(js::error(dao::getError()));}
    	$id=$this->dao->lastInsertId();
    	$actionID=$this->loadModel('action')->create("sampleout",$id,"createoutOpenBY{$_POST['openby']}");
    	return array('re'=>'success')   ;
    }
	public function importout($post)
    {
    	$data=array();
		$data['remark']=$post;
		//$_POST['remark1']=$post;
    	$qianv=explode("value",$post);
    	foreach($qianv as $v)
    	{
    			$vv=explode("key",$v);
    			$data[$vv[0]]=$vv[1];
    	}
    	//if($data['qty']>=100){$data['approve']='1';}
		if($_POST['qty']>=100 and $_POST['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India",$_POST['area'])===false){$_POST['approve']='1';}
    	if($_POST['qty']>=500 and $_POST['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India",$_POST['area'])!==false){$_POST['approve']='1';}
    	$where="";
    	foreach($_POST as $k=>$kk)
    	{
    		$where.="$k = '$kk' and ";
    	}
    	$where=substr($where,0,-5);
    	$exist=$this->dao->select('id')->from('zt_out')->where($where)->fetch();
    	if($exist->id>0){return array('re'=>'repeat');}
    	$this->dao->insert('zt_out')->data($_POST)->autoCheck("shipdate")
    	->check('partn','notempty')
    	->checkIF($_POST['revtype']=='需要付费','distributor',"notempty")
    	->checkIF($_POST['revtype']=='需要付费','price',"notempty")
    	->batchCheck('rdate,createdate','date')
    	->exec();
    	if(dao::isError()){die(js::error(dao::getError()));}
    	$id=$this->dao->lastInsertId();
    	$actionID=$this->loadModel('action')->create("sampleout",$id,"importOpenBY{$_POST['openby']}");
    	return array('re'=>'success');
    }
   function getsamplelist()
    {
    	$account=$_POST['account'];
		
    	$re=$this->dao->select("*")->from('zt_out')
    								  ->where($_POST['where'])
    								  ->andWhere('openby')->eq("$account")
    								  ->orderBy($_POST['orderBy'])
    								  ->limit("0,1000")
    								  ->fetchAll();
		if($account=='admin' or $account=='lynn')
		{
			$re=$this->dao->select("*")->from('zt_out')
    								  ->where($_POST['where'])
    								  ->orderBy($_POST['orderBy'])
    								  ->limit("0,1000")
    								  ->fetchAll();
		}
    	return $re;							  
    }
    function getsamplelistbyanna($account)
    {
    	
    	return $this->dao->select("*")->from('zt_out')
    								  ->where($_POST['where'])
    								  ->andWhere('(area')->eq("SC")
    								  //->andWhere("revtype")->eq("需要付费")
    								   //->markRight(1)
    								  ->orWhere('openby')->eq($account)
    								  ->markRight(1)
    								  ->orderBy($_POST['orderBy'])
    								  ->limit("0,1000")
    								  ->fetchAll();
    }
	function getsamplelistbysave($account)
    {
    	
    	return $this->dao->select("*")->from('zt_out')
    								  ->where($_POST['where'])
    								  ->andWhere('(area')->eq("TW")
    								  //->andWhere("revtype")->eq("需要付费")
    								   //->markRight(1)
    								  ->orWhere('openby')->eq($account)
    								  ->markRight(1)
    								  ->orderBy($_POST['orderBy'])
    								  ->limit("0,1000")
    								  ->fetchAll();
    }
	function getsamplelistbyjapan($account)
    {
    	
    	return $this->dao->select("*")->from('zt_out')
    								  ->where($_POST['where'])
    								  ->andWhere('(area')->eq("Japan")
    								  //->andWhere("revtype")->eq("需要付费")
    								   //->markRight(1)
    								  ->orWhere('openby')->eq($account)
    								  ->markRight(1)
    								  ->orderBy($_POST['orderBy'])
    								  ->limit("0,1000")
    								  ->fetchAll();
    }
    //获取北中国
    function getsamplelistbync($account)
    {
        
        return $this->dao->select("*")->from('zt_out')
                                      ->where($_POST['where'])
                                      ->andWhere('(area')->eq("NC")
                                      //->andWhere("revtype")->eq("需要付费")
                                       //->markRight(1)
                                      ->orWhere('openby')->eq($account)
                                      ->markRight(1)
                                      ->orderBy($_POST['orderBy'])
                                      ->limit("0,1000")
                                      ->fetchAll();
    }
    function getsamplebyinsidesales()
    {
    	$orderBy=$_POST['orderBy'];
    	$where=$_POST['where'];
    	$account=$_POST['account'];
    	if(empty($where))
    	{
			if($account=='admin' or $account=='lynn')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->orderBy($orderBy)
    								  ->fetchAll();
			}
    		elseif($account!='anna' and $account!="saviny" and $account!="hasegawa" and $account!='henry' and $account!='torch' and $account !='tim')
    		{
    		return $this->dao->select("*")->from('zt_out')
    								  ->where('openby')->eq("$account")
    								  ->orderBy($orderBy)
    								  ->fetchAll();
    		}
    		elseif($account=='anna' or $account == 'torch') 
    		{
    			return $this->dao->select("*")->from('zt_out')
    								  ->where('area')->eq("SC")
    								  ->orWhere('openby')->eq($account)
    								  ->orderBy($orderBy)
    								  ->fetchAll();
    		}
			elseif($account=='saviny' or account == 'tim')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->where('area')->eq("TW")
    								  ->orWhere('openby')->eq($account)
    								  ->orderBy($orderBy)
    								  ->fetchAll();
			}
			elseif($account=='hasegawa')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->where('area')->eq("Japan")
    								  ->orWhere('openby')->eq($account)
    								  ->orderBy($orderBy)
    								  ->fetchAll();
			}
			elseif($account=='henry')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->where('area')->eq("NC")
    								  ->orWhere('openby')->eq($account)
    								  ->orderBy($orderBy)
    								  ->fetchAll();
			}
    	}
    	else 
    	{
			if($account=='admin' or $account=='lynn')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->where($where)
    								  ->orderBy($orderBy)
    								  ->fetchAll();
			}
    		elseif($account!='anna' and $account!='saviny' and $account!='hasegawa' and $account!='henry' and $account!='torch' and $account !='tim')
    		{
    		return $this->dao->select("*")->from('zt_out')
    								  ->where($where)
    								  ->andWhere('openby')->eq("$account")
    								  ->orderBy($orderBy)
    								  ->fetchAll();
    		}
    		elseif($account=='anna' or $account=='torch') 
    		{
    			return $this->dao->select("*")->from('zt_out')
    								  ->where($where)
    								  ->andWhere('(area')->eq("SC")
    								  ->orWhere('openby')->eq($account)
    								  ->markRight(1)
    								  ->orderBy($orderBy)
    								  ->fetchAll();
    		}
			elseif($account=='saviny' or $account=='tim')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->where($where)
    								  ->andWhere('(area')->eq("TW")
    								  ->orWhere('openby')->eq($account)
    								  ->markRight(1)
    								  ->orderBy($orderBy)
    								  ->fetchAll();

			}
			elseif($account=='hasegawa')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->where($where)
    								  ->andWhere('(area')->eq("Japan")
    								  ->orWhere('openby')->eq($account)
    								  ->markRight(1)
    								  ->orderBy($orderBy)
    								  ->fetchAll();

			}
			elseif($account=='henry')
			{
				return $this->dao->select("*")->from('zt_out')
    								  ->where($where)
    								  ->andWhere('(area')->eq("NC")
    								  ->orWhere('openby')->eq($account)
    								  ->markRight(1)
    								  ->orderBy($orderBy)
    								  ->fetchAll();

			}
    	}
    }
	function getsample($id)
	{
		return $this->dao->select("*")->from('zt_out')->where('id')->eq($id)->fetch();
	}
	function deletesample($id,$account)
	{
		$re=$this->dao->delete()->from('zt_out')->where('id')->eq($id)->andWhere('close')->eq('wait')->exec();
		if($re)$this->loadModel('action')->create('sampleout',$id,"删除by$account");
		if($re){return array('re'=>1);}else{return array('re'=>0);}
	}

    //获取无限制的
    function getallpart()
    {
        $mppart=$this->dao->select('device,id')->from('zt_mp')->where('deleted')->eq(0)->fetchPairs("device",'device');
        $samplepart=$this->dao->select('device,id')->from('zt_sample')->where('deleted')->eq(0)->fetchPairs("device",'device');
        $res=array_unique($mppart) + array_unique($samplepart);     
        return $res;
    }

    //获取mp和sample表中的所以part集合 三年之内的
    function getallpartall()
    {
        $mppart=$this->dao->select('device,id')->from('zt_mp')->where('deleted')->eq(0)->fetchPairs("device",'device');
        $samplepart=$this->dao->select('device,id')->from('zt_sample')->where('deleted')->eq(0)->fetchPairs("device",'device');
        $res=array_unique($mppart) + array_unique($samplepart);
        //连接远端数据库
        $db = new PDO("mysql:dbname=insidesales;host=192.168.5.16;charset=utf8;","root","Silergy13");
        $sql = "SELECT * FROM `zt_wgcprorelease` WHERE `deleted` = '0' and `status` != 'killed'";
        $result = $db->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);//返回关联数组
        //生成3年前的时间戳   2017-11-14
        $time = strtotime("-3 year",strtotime("2017-11-14"));

        //循环比较 unset时间超过3年的和不在part集合中的元素
        for ($i=0; $i < count($data); $i++) 
        {
            if (in_array($data[$i]['partnumber'], $res)) 
            {          
                if (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase4'],$result)) 
                {
                    if ($time > strtotime($result[0])) 
                    {
                        unset($res[$data[$i]['partnumber']]);
                    }
                    continue;
                } 
                elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase3'],$result)) 
                {
                    if ($time > strtotime($result[0])) 
                    {
                        unset($res[$data[$i]['partnumber']]);                        
                    }
                    continue;
                } 
                elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase2'],$result)) 
                {
                    if ($time > strtotime($result[0])) 
                    {
                        unset($res[$data[$i]['partnumber']]);                        
                    }
                    continue;
                } 
                elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase1'],$result)) 
                {
                    if ($time > strtotime($result[0])) 
                    {
                        unset($res[$data[$i]['partnumber']]);                       
                    }
                    continue;
                } 
                    
            } 
           
        }
        //返回合格的结果集
        return $res;
    }
	function getdemo()
	{
		$demos=$this->dao->select("*")->from("zt_out")
									  ->where('rtype')->like("%demo%")
									  ->andWhere(($_POST['where']))
								      //->andWhere('rtype')->like('%demo%')
								      ->andWhere('close')->eq('wait')
								      //->markRight(1)
								      ->orderBy($_POST['orderBy'])
								      ->limit("0,1000")
								      ->fetchAll();
		return $demos;
	}
	function editdemo()
	{
		$id=$_POST['id'];$account=$_POST['account'];unset($_POST['id']);unset($_POST['account']);
		$old=$this->getsample($id);
		if(empty($_POST['shiporder'])){unset($_POST['shipdate']);unset($_POST['close']);}
		$data=(object)$_POST;
		$re=$this->dao->update("zt_out")->data($data)->where('id')->eq($id)->exec();
		if($re)
		{
			$actionID=$this->loadModel('action')->create('sampleout',$id,"updateby$account");
			if(common::createChanges($old, $data))
			{
				$this->action->logHistory($actionID,common::createChanges($old, $data));
			}
		}
		
	}
}
