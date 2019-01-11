<?php 
class contractModel extends model
{
	public function index()
	{
		
	}


	// 获取申请人所以信息
	public function getallcontract($account)
	{
		// return $this->dao->select()
	}


	/**
	* 新增一个合约申请方法
	* @param   $data array
	* @return  bool
	*/
	public function insertdata($data)
	{
		$result = $this->dao->insert('`zt_contract`')
							->data($data)->autoCheck()
							->batchCheck('dept,manager,party,title,pager', 'notempty')
							->exec();
		return $result;
	}


	/**
	* 合约列表页面
	* @param   string  $sid
	* @param   string  $where
	* @param   string  $orderBy
	* @param   string  $pager
	* @return   array
	*/
	public function getconlist($sid,$where,$orderBy,$pager)
	{
		$lg = $this->checkLgGroup();        // 检查法务权限
		$HR = $this->checkHRGroup();        // 检查hr权限
		$datas = $this->getbyhuishen($sid); //通过sid  附表关联id字符串 
		return $this->dao->select()->from('`zt_contract`')
							->where($where)
							->beginIF(empty($datas) && $sid !== 'admin' && $lg === false && $HR ===false)
							->andwhere('( account')->eq($sid)
							->markright(1)
							->fi()
							->beginIF(!empty($datas) && $sid !== 'admin' && $lg === false && $HR ===false)
							->andwhere('( id')->in($datas)
							->markright(1)
							->orwhere('account')->eq($sid)
							->fi()
							->orderBy($orderBy)
							->page($pager)
							->fetchAll();
							// ->PrintSQL();

	}


	/**
	* 合约列表页面 待修改 被拒绝 approve=2 approve=3
	* @param   string  $sid
	* @param   string  $where
	* @param   string  $orderBy
	* @param   string  $pager
	* @return   array
	*/
	public function getconlist_mr($sid,$where,$orderBy,$pager)
	{
		$lg = $this->checkLgGroup();        // 检查法务权限
		$HR = $this->checkHRGroup();        // 检查hr权限
		$str   = $this->getconlist_mr_abr($where);
		$datas = $this->getbyhuishen($sid);   //通过sid  附表关联id字符串 
		$res = $this->dao->select()->from('`zt_contract`')
							->where('id')->in($str)
							->beginIF(empty($datas) && $sid !== 'admin' && $lg === false && $HR ===false)
							->andwhere('( account')->eq($sid)
							->markright(1)
							->fi()
							->beginIF(!empty($datas) && $sid !== 'admin' && $lg === false && $HR ===false)
							->andwhere('( id')->in($datas)
							->orwhere('account')->eq($sid)
							->markright(1)
							->fi()
							->orderBy($orderBy)
							->page($pager)
							->fetchAll();
		return $res;
	}


	/** 
	* 通过where条件 查看登录人拥有的会审信息
	* @param   string  $where
	* @return  string
	*/
	public function getconlist_mr_abr($where)
	{ 
		$lg = $this->checkLgGroup();        // 检查法务权限
		$HR = $this->checkHRGroup();        // 检查hr权限
		$res = $this->dao->select('m.cid')->from('`zt_comments`')->alias('m')
							->beginIF($this->app->user->account !== 'admin' && $lg === false && $HR === false)
							->leftjoin('zt_contract')->alias('c')
							->on('m.cid = c.id')
							->where('( c.account')->eq($this->app->user->account)
							->markright(1)
							->fi()
							->beginIF($this->app->user->account == 'admin' || $lg !== false || $HR !== false)
							->where(' ( 1 = 1 ) ')
							->fi()
							->andwhere($where)
							->fetchAll();
		$abr = array(); // 声明一个空数组 储存数据
		foreach($res as $key => $val)
		{
			if(!in_array($res[$key]->cid,$abr))
			{ 
				$abr[] = $res[$key]->cid;
			} else { 
				unset($res[$key]); 
			} 
		}
		return implode(',', $abr);
		// var_dump(implode(',', $abr));die;

	}

	/**
	* 更新最新的附件id
	* @param $id   string
	* @param $data array
	* @return bool
	*/
	public function editfileid($id,$data)
	{
		return $this->dao->update('zt_contract')->data($data)
						 ->autoCheck()
					     ->batchCheck('fileid','notempty')
					     ->where('id')
					     ->eq($id)
					     ->exec();
		
	}

	/**
	* 编辑
	* @param $id   string
	* @param $data array
	* @return bool
	*/
	public function editself($id,$data)
	{
		return $this->dao->update('zt_contract')->data($data)
						 ->autoCheck()
						 ->batchCheck('dept,manager,party,title,pager','notempty')
						 ->where('id')
						 ->eq($id)
						 ->exec();
		
	}

	/**
	* 更新最终版合约附件
	* @param $id   string
	* @param $data array
	* @return bool
	*/
	public function editfile($id,$data)
	{
		return $this->dao->update('zt_contract')->data($data)
						 ->where('id')
						 ->eq($id)
						 ->exec();
		
	}

	/**
	* 法务操作
	* @param $id    string
	* @param $data  array
	* @return bool
	*/
	public function editfawu($id,$data)
	{
		return $this->dao->update('`zt_contract`')->data($data)
						 ->autoCheck()
						 ->batchCheck('startime,endtime,maincontent,clause,sum,dept,manager,party,title,pager,','notempty')
						 ->where('id')
						 ->eq($id)
						 ->exec();
	}

	/**
	* 会审人操作
	* @param $cid string
	* @param $data array
	* @return bool
	*/
	public function editbymanager($cid,$data)
	{
		return $this->dao->update('`zt_comments`')->data($data)
						 ->autoCheck()
						 ->batchCheck('comments,approve','notempty')
						 ->where('`cid`')->eq($cid)
						 ->andwhere('`approvemanager`')->eq($this->app->user->account)
						 ->exec();

		// return $this->dao->update('`zt_comments`')->data($data)->autoCheck()->batchCheck('comments,approve','notempty')
		//  				 ->where('`cid`')->eq($cid)->andwhere('`approvemanager`')->eq('S00773')->exec();
	}

	/**
	* 通过sid 来得到会审人信息
	* @param  $sid string
	* @return string
	*/
	public function getbyhuishen($sid)
	{
		$result = $this->dao->select('cid')->from('zt_comments')
							->where('approvemanager')->eq($sid)
							->fetchAll();
		$new_abr = array(); // 声明一个空数组 储存数据
		foreach ($result as $key => $value) 
		{
			$new_abr[] = $result[$key]->cid;
		}
		return implode(',',$new_abr); // 将二维数组 以字符串形式返回

	}



	/**
	 * Check 法务 group
	 * @access public
	 * @return bool
	 */
	public function checkLgGroup()
	{
	    $lggroup = $this->dao->select('`group`')->from('zt_usergroup')
	    					 ->where('account')->eq($this->app->user->account)
	    					 ->andWhere('`group`')->eq(17)->fetch('group');
	    if($lggroup == 17)
	    { 
	       return true;   
	    }
	    else
	    {
	       return false;
	    }  
	}

	/**
	 * Check HR group
	 * @access public
	 * @return bool
	 */
	public function checkHRGroup()
	{
	    $lggroup = $this->dao->select('`group`')->from('zt_usergroup')
	    					 ->where('account')->eq($this->app->user->account)
	    					 ->andWhere('`group`')->eq(18)->fetch('group');
	    if($lggroup == 18)
	    { 
	       return true;   
	    }
	    else
	    {
	       return false;
	    }  
	}


	/**
	* 归档视图的法务方法
	* @access public
	* @param  $where     string 
	* @param  $orderBy   string 
	* @param  $pager     string 
	* @return array
	*/
	public function docbrowse($where,$orderBy,$pager,$over)
	{
		return $this->dao->select()->from('zt_contract')
								   ->where($where)
								   ->beginIF(!empty($over))
								   ->andwhere(' ( over')
								   ->eq($over)
								   ->markright(1)
								   ->fi()
								   ->orderBy($orderBy)
								   ->page($pager)
								   ->fetchAll();
	}






}


?>