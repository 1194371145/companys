<?php 
class contract extends control
{
	public $huishen;

	/**
     * Construct function, load use Model.
     * 
     * @access public
     * @return void
     */
	public function __construct()
	{
		parent::__construct();
		// 加载需要的model
		$this->loadModel('action');    // 操作记录
		$this->loadModel('search');   
		$this->loadModel('mail');      // 发邮件
		
	}

	/**
	* contractTime 定时函数来比较合约过期时间
	* @access public 
	* @return void
	*/
	public function contractTime()
	{
		$result = $this->dao->select('endtime,control')->from('zt_contract')->where('endtime')->ge(date('Y-m-d'))->andwhere('endtime')->le(date('Y-m-d',strtotime("+ 3 Month")))->andwhere('deleted')->eq(0)->andwhere('over')->eq(1)->fetchAll();
		$new_abc = array(); // 声明一个空数组 储存数据
		foreach ($result as $key => $value) 
		{
			$new_abc[] = $result[$key]->control;
		}
		$str = implode(',',$new_abc); // 将二维数组 
		// var_dump($str);
		if (!empty($str)) 
		{
			$this->mail->send($this->config->contract->LG,'合约快过期提醒','合约编号为'.$str.'的合同到期时间已不足三个月,可登录合约会审的Contract Review模块 内网地址( <a href="http://192.168.5.8:8093/">http://192.168.5.8:8093/</a> ),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093/</a>)来取消邮件提醒!');
		}
		

	}

	/**
	* changeamil 取消邮件提醒
	* @access public
	* @param $id string
	* @return void
	*/
	public function changeamil($id)
	{
		$data['deleted'] = 1;
		$res = $this->dao->update('zt_contract')->data($data)->where('id')->eq($id)->exec();
		if ($res) 
		{
			echo js::alert('该申请的邮件提示已取消,默认你已知晓该合约以快过期');
			die(js::locate($this->createLink('contract', 'contractlist'),'parent'));
		} else {
			die(js::alert('操作失败, 请联系管理员!'));
		}
	}


	/**
	* ajax 二级联动
	* @param $dept string
	* @return json
	*/
	public function ajaxgetdept()
	{
		$dept = $_POST['dept'];
		echo json_encode($this->config->contract->select[$dept]);
	}


	/**
     * Index 合同会审表单.
     * 
     * @access public
     * @return void
     */
	public function index($area = '2')
	{
		if (!empty($_POST) && !empty($_FILES))
		{
			if (empty($_FILES['myfile']['name'])) 
			{
				die(js::alert('上传的附件不能为空'));
			}

			$arre=explode(".", $_FILES['myfile']['name']);
			//获取最后一个 . 后边的字符
			$last=$arre[count($arre)-1];

			if ($last !== 'pdf' && $last !== 'docx' && $last !== 'doc' && $last !== 'xlsx' && $last !== 'xls') 
			{
				die(js::alert('请选择正确的文件格式,pdf,excel,word'));
			}
			// 整合post数据
			$data['account']    = $this->app->user->account;
			$data['dept']       = htmlspecialchars(trim($_POST['contract_dept']));
			$data['manager']    = htmlspecialchars(trim($_POST['contract_manager']));
			$data['party']      = htmlspecialchars(trim($_POST['contract_party']));
			$data['title']      = htmlspecialchars(trim($_POST['contract_title']));
			$data['pager']      = htmlspecialchars(trim($_POST['contract_number']));
			$data['remark']     = htmlspecialchars(trim($_POST['contract_remark']));
			// $data['otherparty'] = htmlspecialchars(trim($_POST['contract_otherparty']));
			$data['createdate'] = date('Y-m-d H:i:s');
			$data['control']    = $_POST['contract_control'];
			$data['areaid']     = $_POST['contract_area'];
			$result = $this->contract->insertdata($data); // 新增数据
			if(dao::isError()) 
			{
				die(js::error(dao::getError()));
			} else {
				$id = $this->dao->lastInsertID(); // 得到新增id
			}
			/**
			* 文件上传设置
			* $objectType = '', 
			* $objectID = '', 
			* $extra = '', 
			* $filesName = 'files', 
			* $labelsName = 'labels',
			*/
			$res = $this->loadModel('file')->saveContractUpload('contract',$id,'','myfile','label',$data['control']);
			// $file_id = array_keys($res[0]);   // 保存上传成功后的id
			if (!empty($res)) 
			{
				// 获取数据
				$datas['fileid']     = array_keys($res)[0];  // 附件id
				$results = $this->contract->editfileid($id,$datas);
				if ($results)
				{
					$this->action->create('contract_view',$id,'创建'); // 记录操作记录
					// 发邮件给法务人员
					$this->mail->send($this->config->contract->LG,'有一份 '.$data['otherparty'].' 的关于 '.$data['title'].' 的合约会审需签核:','由SID为'.$data['account'].'的员工申请了一份 '.$data['otherparty'].' 的关于 '.$data['title'].' 的合约会审单,测试版合约编号为'.$data['control'].'需要签核,请登录合约会审的Contract Review模块 内网地址( <a href="http://192.168.5.8:8093/">http://192.168.5.8:8093/</a> ),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093/</a>)来签核','',true);
					echo js::alert('创建成功');
					die(js::locate($this->createLink('contract', 'contractlist'),'parent'));
				} else {
					die(js::alert('创建失败'));
				}
			} else {
				$this->dao->delete()->from('zt_contract')->where('id')->eq($id)->exec(); // 文件上传失败 删除contract表中的数据
				die(js::alert('文件上传失败,请重试'));
			}

		}

		// 根据不同的区域 来生成对应的合约编号
		switch ($area) 
		{
			case '1':
				$control_date = 'TCP'.date('Ym');  // corp
				break;
			case '2':
				$control_date = 'THZ'.date('Ym');  // 杭州
				break;
			case '3':
				$control_date = 'TNJ'.date('Ym');  // 南京
				break;
			case '4':
				$control_date = 'TSM'.date('Ym');  // 萨摩亚
				break;
			case '5':
				$control_date = 'TXA'.date('Ym');  // 西安
				break;
			case '6':
				$control_date = 'TGC'.date('Ym');  // 工程
				break;
			case '7':
				$control_date = 'TSH'.date('Ym');  // 上海
				break;
			case '8':
				$control_date = 'TCD'.date('Ym');  // 成都
				break;
			case '9':
				$control_date = 'TUS'.date('Ym');  // 美国
				break;
			case '10':
				$control_date = 'TTW'.date('Ym');  // 台湾
				break;
			case '11':
				$control_date = 'TKR'.date('Ym');  // 韩国
				break;
			case '12':
				$control_date = 'TYW'.date('Ym');  // 英沃
				break;
            case '13':
                $control_date = 'THK'.date('Ym');  // 香港
                break;
            case '14':
                $control_date = 'TJA'.date('Ym');  // 日本
                break;
            case '15':
                $control_date = 'TIN'.date('Ym');  // 印度
                break;
			default:
				$control_date = 'THZ'.date('Ym');  // 默认杭州
				break;
		}
		// 
		$info = $this->dao->select()->from('zt_contract')->where('control')->like($control_date.'%')->count();
		if ($info == 0) 
		{
			$control = $control_date.'001';  // 表中无该月数据从 001 开始 
		} else {
			$infos = $this->dao->select('control')->from('zt_contract')->where('control')->like($control_date . '%')->orderBy('control_desc')->fetchAll();
			$control = $control_date . sprintf("%03d", substr($infos[0]->control, -3) + 1); // 有该月记录 取最大值加1
		}
		$this->view->area         = $area;
		$this->view->control      = $control; 
		$this->view->title        = 'Contract Form';
		$this->view->companytitle = $this->lang->contract->title[$area]; // 抬头
		$this->display();
	}


	/**
     * Contractdoc 合约文档 文件视图.
     * 
     * @access public
     * @return void
     */
     public function contractdoc()
     {
     	$this->view->title = 'All doc';
     	$this->display();
     }


 	/**
      * Contractdoclist 各地区合约文件视图列表.
      * 
      * @access public
      * @param  $type       string
      * @param  $area       string
      * @param  $over       int
      * @param  $orderBy    string 
      * @param  $recTotal   int 
      * @param  $recPerPage int 
      * @param  $pageID     int
      * @return void
      */
      public function contractdoclist($type='normal',$area='HZ',$over='',$param = 0 ,$orderBy='id_desc',$recTotal = 0,$recPerPage = 20 ,$pageID = 1)
      {
      	/* Load pager and get tasks. */
      	$this->app->loadClass('pager', $static = true);
      	$pager = new pager($recTotal, $recPerPage, $pageID);


      	if ($type != 'bySearch')
      	{
      		$where = "control LIKE '$area%'";
      	} else {
		  	$queryID=(int)$param;
	            if ($queryID) 
	              	{    
	              		$query=$this->search->getQuery($queryID);
	              	
	              		if ($query) 
	              		{
	              			$this->session->set('contractQuery',$query->sql);
							$this->session->set('contractForm',$query->form);
	              		}
	              		else
	              		{
	              			$this->session->set('contractQuery',"1 = 1");
	              		}
	              	}
	             
	        $where=$this->session->contractQuery;
      	}

      	$result = $this->contract->docbrowse($where,$orderBy,$pager,$over);
      	$this->view->datas = $result;
      	$this->config->contract->search['actionURL']=$this->createLink('contract','contractdoclist',"type=bySearch");   // search
      	$this->config->contract->search['queryID']=$queryID;
      	$this->view->searchForm=$this->fetch('search','buildForm',$this->config->contract->search);
      	$this->view->pager = $pager;
      	$this->view->title = 'Doc list';
		$this->view->justice = $this->contract->checkLgGroup();  // 法务人权限
      	$this->display();
      }

 	/**
      * list 列表页面.
      * 
      * @access public
      * @param  $type       string 
      * @param  $param      int 
      * @param  $orderBy    string 
      * @param  $recTotal   int 
      * @param  $recPerPage int 
      * @param  $pageID     int 
      * @return void
      */
	public function contractlist($type='normal',$status='all',$param = 0,$orderBy='id_desc',$recTotal = 0,$recPerPage = 20,$pageID = 1)
	{
		/* Load pager and get tasks. */
		$this->app->loadClass('pager', $static = true);
		$pager = new pager($recTotal, $recPerPage, $pageID);

		// 得到登录人的sid
		$sid = $this->app->user->account;

		if ($type != 'bySearch') 
		{
			switch ($status) {
				case 'all':
					$where = '1 = 1';            // all
					break;
				case 'agree':
					$where = 'over = 1';         // agree 条件
					break;
				case 'pending':
					$where = 'over = 5 or over = 2';        // pending 条件 ( 默认 )
					break;
				case 'modify':
					$where = 'm.approve = 2';    // 需修改 
					break;
				case 'rejective':
					$where = 'm.approve = 3';    // 被拒绝
					break;
				default:
					$where = '1 = 1';
					break;
			}
		} else {
		  	$queryID=(int)$param;
	            if ($queryID) 
	              	{    
	              		$query=$this->search->getQuery($queryID);
	              	
	              		if ($query) 
	              		{
	              			$this->session->set('contractQuery',$query->sql);
							$this->session->set('contractForm',$query->form);
	              		}
	              		else
	              		{
	              			$this->session->set('contractQuery',"1 = 1");
	              		}
	              	}
	             
	        $where=$this->session->contractQuery;
		}

			if ($status == 'modify' || $status == 'rejective') 
			{
				$conlist = $this->contract->getconlist_mr($sid,$where,$orderBy,$pager);
			} else {
				$conlist = $this->contract->getconlist($sid,$where,$orderBy,$pager);
			}

			$tabstyle[$status] = 'class = active';
			$this->view->tabstyle = $tabstyle;      // ul 导航栏默认背景
			$this->view->title = 'Contract List';   // title
			$this->config->contract->search['actionURL']=$this->createLink('contract','contractlist',"type=bySearch");   // search
			$this->config->contract->search['queryID']=$queryID;
			$this->view->searchForm=$this->fetch('search','buildForm',$this->config->contract->search);
			$this->view->datas = $conlist;
			$this->view->pager = $pager;
			$this->view->type  = $type;
			$this->view->huishen_str = $this->contract->getbyhuishen($sid); // 得到登陆人拥有的审核id
			$this->view->justice = $this->contract->checkLgGroup();  // 法务人权限
			$this->view->HR = $this->contract->checkHRGroup();  // HR权限
			$this->display();
	}


	/**
	* editself 申请人自己编辑
	* @access public
	* @param  $id   int
	* @return 
	*/
	public function editself($id='')
	{
		// 主表数据
		$datas = $this->dao->select()->from('`zt_contract`')->where('`id`')->eq($id)->fetch();
		// 从表数据
		$comments = $this->dao->select('approvedept,approvemanager,approve,comments')->from('`zt_comments`')->where('`cid`')->eq($id)->orderBy('id_asc')->fetchAll();

		if (!empty($_POST))
		{
			$editid = $_POST['editselfid']; // 此条数据的id
			$olddata = $this->dao->select('fileid,dept,manager,party,title,pager,remark,type,areaid,control,otherparty,account')->from('zt_contract')->where('id')->eq($editid)->fetch(); // 原始数据

			if (isset($_POST['contract_dept']) && isset($_POST['contract_manager'])) // 正常编辑状态
			{
				if (!empty($_FILES['myFile']['name']) && !empty($_POST['contract_dept']) && !empty($_POST['contract_manager']) && !empty($_POST['contract_party']) && !empty($_POST['contract_title']) && !empty($_POST['contract_number']))  // 有文件上传
				{
					$arre=explode(".", $_FILES['myFile']['name']);
					//获取最后一个 . 后边的字符
					$last=$arre[count($arre)-1];

					if ($last !== 'pdf' && $last !== 'docx' && $last !== 'doc' && $last !== 'xlsx' && $last !== 'xls') 
					{
						die(js::alert('请选择正确的文件格式,pdf,excel,word'));
					}
					$resfile = $this->loadModel('file')->saveContractUpload('contract',$_POST['editselfid'],'','myFile','label',$olddata->control,'edit');
				}
				if ($resfile) 
				{
					$data['fileid']  = array_keys($resfile)[0]; // 得到最新上传id
				}
				// 重整新 获取数据
				$data['dept']    = htmlspecialchars(trim($_POST['contract_dept']));
				$data['manager'] = htmlspecialchars(trim($_POST['contract_manager']));
				$data['party']   = htmlspecialchars(trim($_POST['contract_party']));
				$data['title']   = htmlspecialchars(trim($_POST['contract_title']));
				$data['pager']   = htmlspecialchars(trim($_POST['contract_number']));
				$data['remark']  = htmlspecialchars(trim($_POST['contractself_remark']));
				// $data['otherparty']  = htmlspecialchars(trim($_POST['contract_otherparty']));
				$res = $this->contract->editself($editid,$data);
			} else {
				if (empty($_FILES['myFile']['name']))
				{
					die(js::alert('你必需要上传附件后才能提交!'));
				} else {
					$arre=explode(".", $_FILES['myFile']['name']);
					//获取最后一个 . 后边的字符
					$last=$arre[count($arre)-1];

					if ($last !== 'pdf' && $last !== 'docx' && $last !== 'doc' && $last !== 'xlsx' && $last !== 'xls') 
					{
						die(js::alert('请选择正确的文件格式,pdf,excel,word'));
					}
					$resfile = $this->loadModel('file')->saveContractUpload('contract',$_POST['editselfid'],'','myFile','label',$olddata->control,'edit');
				}
				if ($resfile) 
				{
					$datafile['fileid'] = array_keys($resfile)[0];
				}
				$res = $this->contract->editfile($editid,$datafile);   // 仅更新附件  最终版

				$this->mail->send($this->config->contract->LG,'有一份 '.$olddata->otherparty.' 的关于 '.$olddata->title.' 的合约会审通知','员工编号为'.$olddata->account.'的员工申请的一份 '.$olddata->otherparty.' 的关于 '.$olddata->title.' 的合约合同,测试版合约编号为'.$olddata->control.'的合约申请合同已会审通过且申请人已上传了盖过章的最终附件,<br/>请登录合约会审的Contract Review模块的法务按钮签字生效 内网地址(<a href="http://192.168.5.8:8093/">http://192.168.5.8:8093/</a>),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093/</a>)','',true);
			}
			if(dao::isError()) die(js::error(dao::getError()));
			if ($res || $resfile) // 更新数据或文件成功均可编辑成功 
			{
				if ($resfile) 
				{
					$actionID=$this->action->create('contract_view',$editid,"更新了合约附件");
				} else {
					$actionID=$this->action->create('contract_view',$editid,"修改");
				}

				// 申请人有修改 ,如有会审人员邮件通知
				if (!empty($this->huishen)) 
				{
					// $this->mail->send($this->huishen,'合约申请变更','合约编号为'.$olddata->control.'的合约申请合同有变更,请登录合约会审的Contract Review模块 内网地址(<a href="http://192.168.5.8:8093/">http://192.168.5.8:8093/</a>),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093/</a>)来核对','',true); // 邮件
				}

				if(common::createChanges($olddata, $data)) 
				{
				  $this->action->logHistory($actionID,common::createChanges($olddata, $data));  // 操作记录
				}
				echo js::alert('编辑成功');
				die(js::locate($this->createLink('contract', 'contractlist'),'parent'));
			} else {
				die(js::alert('请确认有修改过后再提交'));
			}
		}

		// 展示法务和会审人信息 
		if (!empty($comments)) 
		{
			foreach ($comments as $k => $v) 
			{
				$stat[$v->approvedept] = $v->approvedept;
				$stat[$v->approvedept.'manager'] = $v->approvemanager;
			}
			for ($i=0; $i <count($comments) ; $i++)
			{ 
				$statu[$i+1] = $comments[$i]->approvemanager;
			}

			$this->view->stat     = $stat;     // 按钮填充 默认值
			$this->view->statu    = $statu;    // 填充 会审人权限
			$this->view->comments = $comments;
		}

		// 历史附件文件
		$selffileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('')->orderBy('id_asc')->fetchAll(); // 自己上传的记录
		$fawufileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('mystatus')->orderBy('id_asc')->fetchAll(); // 法务上传的记录
		$huishenfileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('huishen')->orderBy('id_asc')->fetchAll(); // 会审上传的记录
		$fileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->orderBy('id_desc')->fetchAll(); // 法务上传的记录
		$this->view->fileHis   = $fileHis[0];      // 全部
		$this->view->filearr2  = $fawufileHis;  // 上传的附件id数组 fawu
		$this->view->filearr1  = $selffileHis;  // 上传的附件id数组 self
		$this->view->filearr3  = $huishenfileHis;  // 上传的附件id数组 huishen
		$this->view->data    = $datas;
		$this->view->title   = 'EditSelf'; // title
		$this->view->select  = $this->config->contract->select; // 配置 select
		$this->view->actions = $this->action->getList('contract_view',$id);
		$this->display();

	}

	//  将附件映射到公共盘中
	public function getsharedirs($filename,$company,$type,$pathname,$myname)
	{
		system("net use * /del /y"); // 断开所以接连

		// var_dump($filename,$company,$type,$pathname,$myname,$this->app->getAppRoot() . "module/contract/upload/" .substr($pathname,0,strpos($pathname, '/')).'/'. $myname.'/'.substr($pathname,strpos($pathname, '/')));die;
		$content = file_get_contents($this->app->getAppRoot() . "module/contract/upload/" .substr($pathname,0,strpos($pathname, '/')).'/'. $myname.'/'.substr($pathname,strpos($pathname, '/'))); // 将文件写入一个字串
		$location = "\\\\192.168.5.9\\d$\\NetDisk\\Department";//9机器上面的d盘的baidu_syn文件夹
		// $location = "\\\\192.168.5.9\\Department";//9机器上面的d盘的baidu_syn文件夹
		$user = "administrator";//用户名
		$pass = "QQ!!rat1897!*(&";//密码
		$letter = "G";//把远程机器上的地址映射到本地的盘符
		// 下面的意思是把9机器上面的d盘映射到本地的z盘
		$cmd = "net use ".$letter.": ".$location." \"".$pass."\" /user:\"".$user."\" ";
		system($cmd);
		// $infos = iconv('utf-8','gb2312',"03.归档合同\\2.矽力杰（杭州）-合同\\11.其他(OT)");
		$info = iconv('utf-8','gb2312',"03.归档合同\\".$company."\\".$type);
		// $results = scandir("G:\Audit_Alex\\".$info);
		// var_dump($type,$company,$infos,$result,$results);exit;
		$fp = fopen("G:\Audit_Alex\\".$info."\\".$filename,"w"); //创建打开文件
		// $fp = fopen("G:\IT\\".$info."\\".$filename,"w");
		fwrite($fp,$content);   // 写入
		fclose($fp);  // 关闭资源
		// exit;
		if (file_exists("G:\Audit_Alex\\".$info."\\".$filename)) 
		{
			system("net use * /del /y"); // 断开所以接连
			echo js::alert('最终附件已同步到公共盘的合约文件');
			die(js::locate($this->createLink('contract', 'contractlist'),'parent'));
		}else{
			system("net use * /del /y"); // 断开所以连接
			die(js::alert('最终附件同步公共盘失败!'));
		}
		
	}


	/**
	* editfawu 法务编辑
	* @access public
	* @param  $id   int
	* @return 
	*/
	public function editfawu($id='')
	{
		// 主表数据
		$result = $this->dao->select()->from('`zt_contract`')->where('`id`')->eq($id)->fetch();
		// 从表数据
		$comments = $this->dao->select('approvedept,approvemanager,approve,comments')->from('`zt_comments`')->where('`cid`')->eq($id)->orderBy('id_asc')->fetchAll();

		if (!empty($_POST)) 
		{
			$editid = $_POST['editfawuid'];
			$sum = $this->dao->select()->from('`zt_contract`')->where('`id`')->eq($editid)->fetch();

			if (isset($_POST['contract_legal']) || isset($_POST['contract_service'])) // 签字汇总,并将附件同步到公共盘
			{
				if (empty($_FILES['myFile']['name']))
				{
					die(js::alert('你必需要上传最终版附件后才能提交!'));
				} else {
					$arre=explode(".", $_FILES['myFile']['name']);
					//获取最后一个 . 后边的字符
					$last=$arre[count($arre)-1];

					if ($last !== 'pdf' && $last !== 'docx' && $last !== 'doc' && $last !== 'xlsx' && $last !== 'xls') 
					{
						die(js::alert('请选择正确的文件格式,pdf,execl,word'));
					}
					$resfilefawu = $this->loadModel('file')->saveContractUpload('contract',$editid,'mystatus','myFile','label',$sum->control,'edit'); // extra 标示为法务上传的 法务修订版
					// 同步到公共盘操作
					if ($resfilefawu) 
					{
						$datas['fileid'] = array_keys($resfilefawu)[0]; // 有文件上传 获取最新的id
					} else {
						die(js::alert('文件上传失败!'));
					}
				}
				// 生成最终有效的合约编号
				$control_date_end = substr($sum->control, 1 , -3);
				$infos = $this->dao->select()->from('zt_contract')->where('endcontrol')->like($control_date_end.'%')->count();
				if ($infos == 0) 
				{
					$endcontrol = $control_date_end.'001';  // 表中无该月数据从 001 开始 
				} else {
					$infoss = $this->dao->select('control')->from('zt_contract')->where('endcontrol')->like($control_date_end.'%')->orderBy('endcontrol_desc')->fetchAll();
					$endcontrol = $control_date_end . sprintf("%03d", substr($infoss[0]->endcontrol, -3) + 1); // 有该月记录 取最大值加1
				}
				// 重整数据
				$datas['endcontrol']   = $endcontrol;
				$datas['legalapprove'] = htmlspecialchars(trim($_POST['contract_legal']));
				$datas['legalservice'] = htmlspecialchars(trim($_POST['contract_service']));
				if ($datas['legalapprove'] !== '罗梅姣' && $datas['legalapprove'] !== 'Megan') {die(js::error('请填写正确的法务名称 (罗梅姣 & Megan)'));}
				if (empty($datas['legalservice'])) {die(js::error('汇总意见不能为空'));}
				// 法务 编辑操作
				$res = $this->contract->editfawu($editid,$datas);
				if(dao::isError()) die(js::error(dao::getError()));

				// $file_data = $this->dao->select('extension,pathname')->from('zt_file')->where('id')->eq($myendfileid)->fetch();
				//  同时将最终版附件映射到公共盘中
				// $this->getsharedirs($endcontrol.'_contract.'.$file_data->extension,$this->lang->contract->titleM[$sum->areaid],$this->lang->contract->typeM[$sum->type],$file_data->pathname,$sum->control);

			} else {
				// 从表中无数据  更新主表 新增从表
				$datas['dept']        = htmlspecialchars(trim($_POST['contract_dept']));
				$datas['manager']     = htmlspecialchars(trim($_POST['contract_manager']));
				$datas['party']       = htmlspecialchars(trim($_POST['contract_party']));
				$datas['title']       = htmlspecialchars(trim($_POST['contract_title']));
				$datas['pager']       = htmlspecialchars(trim($_POST['contract_number']));
				$datas['remark']      = htmlspecialchars(trim($_POST['contractself_remark']));
				// $datas['otherparty']  = htmlspecialchars(trim($_POST['contract_otherparty']));
				$datas['startime']    = htmlspecialchars(trim($_POST['contract_startime']));
				$datas['endtime']     = htmlspecialchars(trim($_POST['contract_endtime']));
				$datas['maincontent'] = htmlspecialchars(trim($_POST['contract_maincontent']));
				$datas['clause']      = htmlspecialchars(trim($_POST['contract_clause']));
				$datas['close']       = $_POST['contract_close'];
				$datas['object']      = $_POST['contract_object'];
				$datas['type']        = $_POST['contract_type'];
				$datas['sum']         = $_POST['sum'];
				if (strtotime($datas['endtime']) < strtotime($datas['startime'])) {die(js::error('合约的结束时间不能小于开始时间'));}
				if (empty($datas['object'])) {die(js::error('合约对象不能为空'));}
				if (empty($datas['close'])) {die(js::error('重要与否不能为空'));}
				if (empty($datas['type'])) {die(js::error('合约类型不能为空'));}
				// 法务 编辑操作
				$res = $this->contract->editfawu($editid,$datas);
				if(dao::isError()) die(js::error(dao::getError()));
				// 有文件上传
				if (!empty($_FILES['myFile']['name']))
				{
					$arre=explode(".", $_FILES['myFile']['name']);
					//获取最后一个 . 后边的字符
					$last=$arre[count($arre)-1];

					if ($last !== 'pdf' && $last !== 'docx' && $last !== 'doc' && $last !== 'xlsx' && $last !== 'xls') 
					{
						die(js::alert('请选择正确的文件格式,pdf,excel,word'));
					}
					$resfilefawu = $this->loadModel('file')->saveContractUpload('contract',$editid,'mystatus','myFile','label',$sum->control,'edit'); // extra 标示为法务上传的 法务修订版
					if ($resfilefawu) 
					{
						$datafile['fileid'] = array_keys($resfilefawu)[0]; // 有文件上传 获取最新的id
						$this->contract->editfile($editid,$datafile);   // 仅更新附件  最终版
					}
				}
			}
				// 自定义一个标示 判断是否需要发送邮件
				$send_email = 1;
				// 从表 操作
				if (!empty($sum->maincontent) && !empty($sum->clause) && empty($datas['legalapprove']))
				{
					// 先删除从表中的原数据  再更新 新数据				
					$this->dao->delete()->from('`zt_comments`')->where('cid')->eq($editid)->exec(); // 清空原数据
					$send_email = 2; // 法务修改操作 无需发送邮件

				}
				// 新增 comments表数据
				$managerArr = array();  // 声明一个空数组
				foreach ($_POST['need_dept'] as $k => $v)
				{
					$datass = array('approvedept'=>$v,'approvemanager'=>$_POST['a'][$k],'cid'=>$editid); 
					$rescomment = $this->dao->insert('`zt_comments`')->data($datass)->autoCheck()->batchCheck('approvedept,approvemanager','notempty')->exec();
					array_push($managerArr,$_POST['a'][$k]);
					if(dao::isError()) die(js::error(dao::getError()));
				}
				$this->huishen = implode(',',$managerArr); // 将会审manager存入自定义属性中

				if (!empty($datas['legalapprove'])) {
				$this->action->create('contract_view',$editid,'法务签字汇总');  // 法务操作记录
					if (stripos('S00001,S00002,S00003,S00004',$sum->account) === false) 
					{
					$my_area = substr($sum->control,0,3);
					$result = $this->dao->select('pathname')->from('zt_file')->where('id')->eq($datas['fileid'])->fetch();
					$file_name = $result->pathname;
					$this->mail->send($this->config->contract->HR[$my_area],'有一份 '.$sum->otherparty.' 的关于 '.$sum->title.' 的合约会审通知','你申请的 '.$sum->otherparty.' 的关于 '.$sum->title.' 的合约会审单已被法务签字生效,整个合约申请过程已完成.最终生成的合约编号为'.$sum->endcontrol.',<br/>可登录合约会审的Contract Review模块 内网地址(<a href="http://192.168.5.8:8093/">http://192.168.5.8:8093/</a>),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093/</a>)来核对','',true,$this->app->getAppRoot() . "module/contract/upload/" . substr($file_name,0,strpos($file_name,'/')) . '/' .$sum->control.substr($file_name,strpos($file_name,'/')));
					}
				}else{
					$actionID = $this->action->create('contract_view',$editid,'法务填写');  // 法务操作记录
					if(common::createChanges($sum, $datas))
					{
					  $this->action->logHistory($actionID,common::createChanges($sum, $datas));  // 操作记录
					}
					if ($send_email == '1') //  
					{
						$this->mail->send(implode(',',$managerArr),'有一份 '.$sum->otherparty.' 的关于 '.$sum->title.' 的合约会审需要你的签核','员工编号为'.$sum->account.'的员工申请了一份 '.$sum->otherparty.' 的关于 '.$sum->title.' 的合约合同,测试版合约编号为'.$sum->control.'需要你的签核,<br/>请登录合约会审的Contract Review模块 内网地址(<a href="http://192.168.5.8:8093/">http://192.168.5.8:8093/</a>),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093/</a>)来签核','',true); // 邮件
					}
					
				}
				
			if ($rescomment || $res) 
			{
				echo js::alert('法务操作成功');
				die(js::locate($this->createLink('contract', 'contractlist'),'parent'));
			} else {
				die(js::alert('操作失败'));
			}

		}

		// 从表数据用来填充
		if (!empty($comments)) 
		{
			foreach ($comments as $k => $v) 
			{
				$stat[$v->approvedept] = $v->approvedept;
				$stat[$v->approvedept.'manager'] = $v->approvemanager;
			}
			for ($i=0; $i <count($comments) ; $i++)
			{ 
				$statu[$i+1] = $comments[$i]->approvemanager;
			}

			$this->view->stat     = $stat;     // 按钮填充 默认值
			$this->view->statu    = $statu;    // 填充 会审人权限
			$this->view->comments = $comments;
		}
		// 历史附件文件
		$selffileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('')->orderBy('id_asc')->fetchAll(); // 自己上传的记录
		$fawufileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('mystatus')->orderBy('id_asc')->fetchAll(); // 法务上传的记录
		$huishenfileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('huishen')->orderBy('id_asc')->fetchAll(); // 会审上传的记录
		$fileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->orderBy('id_desc')->fetchAll(); // 法务上传的记录
		$this->view->fileHis   = $fileHis[0];      // 全部
		$this->view->filearr2  = $fawufileHis;  // 上传的附件id数组 fawu
		$this->view->filearr1  = $selffileHis;  // 上传的附件id数组 self
		$this->view->filearr3  = $huishenfileHis;  // 上传的附件id数组 huishen
		$this->view->title    = 'EditLegal';
		$this->view->data     = $result;
		$this->view->select   = $this->config->contract->select;   // 配置 select
		$this->view->actions  = $this->action->getList('contract_view',$id);
		$this->display();
	}



	/**
	* edithuishen 主管会审
	* @access public
	* @param  $id   int
	* @return 
	*/
	public function edithuishen($id = '')
	{
		// 主表数据
		$result = $this->dao->select()->from('`zt_contract`')->where('`id`')->eq($id)->fetch();
		// 从表数据
		$comments = $this->dao->select('approvedept,approvemanager,approve,comments')->from('`zt_comments`')->where('`cid`')->eq($id)->orderBy('id_asc')->fetchAll();

		if (!empty($_POST)) 
		{
			$editid = $_POST['editselfid'];
			$old = $this->dao->select('approve,comments')->from('zt_comments')->where('`cid`')->eq($editid)->andwhere('approvemanager')->eq($this->app->user->account)->fetch();   // 根据 cid 和 manager 来查询会审的原始记录
			$resaccount = $this->dao->select('account,control,otherparty,title')->from('`zt_contract`')->where('`id`')->eq($editid)->fetch();
			// 有文件上传
			if (!empty($_FILES['myFile']['name']))
			{
				$arre=explode(".", $_FILES['myFile']['name']);
				//获取最后一个 . 后边的字符
				$last=$arre[count($arre)-1];

				if ($last !== 'pdf' && $last !== 'docx' && $last !== 'doc' && $last !== 'xlsx' && $last !== 'xls') 
				{
					die(js::alert('请选择正确的文件格式,pdf,excel,word'));
				}
				$resfilefawu = $this->loadModel('file')->saveContractUpload('contract',$editid,'huishen','myFile','label',$resaccount->control,'edit'); // extra 标示为法务上传的 法务修订版
				if ($resfilefawu) 
				{
					$datafile['fileid'] = array_keys($resfilefawu)[0]; // 有文件上传 获取最新的id
					$this->contract->editfile($editid,$datafile);   
				}
			}

			// 单条 新数据
			$data['approve']  = array_values($_POST['manager_approve'])[0];
			$data['comments'] = htmlspecialchars(trim($_POST['comments']));
			if (empty($data['approve'])){die(js::alert('请选择 同意,要修改或拒绝'));}

			$result = $this->contract->editbymanager($editid,$data);
			if(dao::isError()) die(js::error(dao::getError()));
			if ($result || $resfilefawu) 
			{
			//  判断会审人是否 全部通过
			$rss1 = $this->dao->select()->from('zt_comments')->where('cid')->eq($editid)->andwhere('approve')->ne('1')->count();
			$rss2 = $this->dao->select()->from('zt_comments')->where('cid')->eq($editid)->andwhere('approve')->eq('2')->count();
			$rss3 = $this->dao->select()->from('zt_comments')->where('cid')->eq($editid)->andwhere('approve')->eq('3')->count();

			if ($rss1 == '0') 
			{
				$dats['over'] = '1';   // 将标示改为已完成
				$this->contract->editfawu($editid,$dats);  
			} elseif($rss2 > 0 && $rss3 == '0')
			{
				$dats['over'] = '3';  // 标记为需要修改
				$this->contract->editfawu($editid,$dats);
			} elseif ($rss2 >= 0 && $rss3 > 0) {
				$dats['over'] = '4';  // 标记为拒绝
				$this->contract->editfawu($editid,$dats);
			} elseif ($rss2 == '0' && $rss3 == '0') {
				$dats['over'] = '5';   // 会审中
				$this->contract->editfawu($editid,$dats);
			}
			$actionID = $this->action->create('contract_view',$editid,'会审');
			$rss4 = $this->dao->select()->from('zt_comments')->where('cid')->eq($editid)->andwhere('approve')->eq('')->count(); // 统计是否全部会审完
			if ($rss4 == '0') 
			{
				if ($rss1 == '0') 
				{
					$this->mail->send($this->config->contract->LG,'关于 '.$resaccount->otherparty.' 的 '.$resaccount->title.' 合约会审通知','测试版合约编号为 '.$resaccount->control.' 的会审已全部通过.请登录合约会审的Contract Review模块的法务页面上传最终附件并签字汇总 内网地址(<a href="http://192.168.5.8:8093/">http://192.168.5.8:8093</a>),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093</a>)','',true);
				} else {
					$this->mail->send($resaccount->account,'关于 '.$resaccount->otherparty.' 的 '.$resaccount->title.' 合约会审通知','你申请的测试版合约编号为'.$resaccount->control.'会审未通过.请登录合约会审的Contract Review模块 内网地址(<a href="http://192.168.5.8:8093/">http://192.168.5.8:8093</a>),外网连接( <a href="http://101.68.73.134:8093/">http://101.68.73.134:8093</a>)来查看会审建议,可在编辑按钮修改并重新提交合约会审单','',true);
				}
			}
			
			if(common::createChanges($old, $data)) // 如果数据有改动 写入history表中
			{
			  $this->action->logHistory($actionID,common::createChanges($old, $data));  // 操作记录
			}
			echo js::alert('会审操作成功');
			die(js::locate($this->createLink('contract', 'contractlist'),'parent'));
			} else {
				die(js::alert('会审编辑失败'));
			}
		}

		if (!empty($comments)) 
		{
			foreach ($comments as $k => $v) 
			{
				$stat[$v->approvedept] = $v->approvedept;
				$stat[$v->approvedept.'manager'] = $v->approvemanager;
			}
			for ($i=0; $i <count($comments) ; $i++)
			{ 
				$statu[$i+1] = $comments[$i]->approvemanager;
			}

			$this->view->stat     = $stat;     // 按钮填充 默认值
			$this->view->statu    = $statu; // 填充 会审人权限
			$this->view->comments = $comments;  // 从表数据赋值
		}

		// 历史附件文件
		$selffileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('')->orderBy('id_asc')->fetchAll(); // 自己上传的记录
		$fawufileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('mystatus')->orderBy('id_asc')->fetchAll(); // 法务上传的记录
		$huishenfileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->andwhere('f.extra')->eq('huishen')->orderBy('id_asc')->fetchAll(); // 会审上传的记录
		$fileHis = $this->dao->select('f.id,u.realname')->from('zt_file')->alias('f')->leftjoin('zt_user')->alias('u')->on('f.addedBy = u.account')->where('f.objectType')->eq('contract')
										   ->andwhere('f.objectID')->eq($id)->orderBy('id_desc')->fetchAll(); // 法务上传的记录

		$this->view->fileHis   = $fileHis[0];      // 全部
		$this->view->filearr2  = $fawufileHis;  // 上传的附件id数组 fawu	 
		$this->view->filearr1  = $selffileHis;  // 上传的附件id数组
		$this->view->filearr3  = $huishenfileHis;  // 上传的附件id数组
		$this->view->title    = 'EditApprove';
		$this->view->data     = $result;
		$this->view->select   = $this->config->contract->select; // 配置 select
		$this->view->actions  = $this->action->getList('contract_view',$id);
		$this->display();

	}



	/**
	* delete 
	* @access public
	* @param  $id    int
	* @param  $type  string
	* @return 
	*/
	public function delete($id,$type='')
	{
		$control = $this->dao->select('control')->from('`zt_contract`')->where('`id`')->eq($id)->fetch();
		$date = $this->dao->select('pathname')->from('zt_file')->where('objectType')->eq('contract')->andwhere('objectID')->eq($id)->orderBy('id_asc')->fetchAll();
		$date = $date[0];
		$date = substr($date->pathname,0,strpos($date->pathname,'/')).'/';
		// 拼接路劲
	    $dir = $this->app->getAppRoot() . "module/contract/upload/" . $date . $control->control . '/';
	    // var_dump($dir);die;
	    if ($type !== 'ok') {
	        echo js::confirm('Are you sure you want to delete it', $this->inLink('delete',"id=$id&type=ok"), '', 'parent', '');
	    } else {
	       $result = $this->dao->delete()->from('`zt_contract`')
	           ->where('`id`')->eq($id)->exec(); // 删除主表
	       $results = $this->dao->delete()->from('zt_comments')->where('cid')
	       								  ->eq($id)->exec(); // 删除从表
 	       	// 删除附件记录
	       	$this->dao->delete()->from('zt_file')->where('objectID')->eq($id)->andwhere('objectType')->eq('contract')->exec();
	       	// 删除文件夹和所以文件
	       	if (file_exists($dir))
	       	{
	       		//先删除目录下的文件：
	       		$dh=opendir($dir);
	       		while ($file=readdir($dh)) 
	       		{
	       		  if($file!="." && $file!="..") 
	       		  {
	       		    $fullpath=$dir."/".$file;
	       		    if(!is_dir($fullpath)) 
	       		    {
	       		       @unlink($fullpath);
	       		  	}
	       		  }
	       		}

	       		closedir($dh);
	       		//删除当前文件夹：
	       		if(rmdir($dir)) {$ttts = 1;} 
	       	}
	       if ($result && $ttts == '1') 
	       {
	           echo js::alert('删除成功');
	           die(js::locate($this->inlink('contractlist'),'parent'));
	       } else {
	           echo js::alert('删除失败');
	           die(js::locate($this->inlink('contractlist'),'parent'));
	       }
	    }

	}


	/**
	* viewfile  合约附件视图
	* @access public
	* @param  $fileid  int
	*/
	public function viewfile($fileid)
	{
		$result = $this->dao->select('pathname,size,objectID,objectType')->from('zt_file')->where('id')->eq($fileid)->fetch();
		$file_contract = $this->dao->select('id')->from('zt_file')->where('objectType')->eq($result->objectType)->andwhere('objectID')->eq($result->objectID)->orderBy('id_desc')->fetchAll();
		$res = $this->dao->select('control')->from('zt_contract')->where('fileid')->eq($file_contract[0]->id)->fetch();
		
		$file_exten = pathinfo($result->pathname)['extension'];
		$filename = pathinfo($result->pathname)['filename'];
		// pdf 浏览
		if ($file_exten == 'pdf')  
		{
			$file_name = iconv("utf-8","gb2312",$result->pathname); // 获取文件名
			$file_path = $this->app->getAppRoot() . "module/contract/upload/" . substr($file_name,0,strpos($file_name,'/')) . '/' .$res->control.substr($file_name,strpos($file_name,'/')); // 拼接路劲

			if (!file_exists($file_path)) 
			{
				die(js::alert('操作失败,该文件不存在!'));
			}
			header("Content-type: application/pdf; charset=utf-8");
			readfile($file_path); // 拼接路劲);
		}

		// word 下载
		if ($file_exten == 'docx' || $file_exten == 'doc') 
		{	
			 $file_name = iconv("utf-8","gb2312",$result->pathname); // 获取文件名
			 $file_path = $this->app->getAppRoot() . "module/contract/upload/" . substr($file_name,0,strpos($file_name,'/')) . '/' .$res->control.substr($file_name,strpos($file_name,'/')); // 拼接路劲
			 // var_dump($filename,$file_name,$file_path);die;
			 if (!file_exists($file_path)) 
			 {
			 	die(js::alert('操作失败,该文件不存在!'));
			 }
			 // 打开读取文件
			 $fp=fopen($file_path,"r");  // 只读的方式
			 $file_size=filesize($file_path) + 100;
			 if ($file_exten == 'doc') 
			 {
			 	$filename = $res->control.'.doc';
			 } else {
			 	$filename = $res->control.'.docx';
			 }
			 // 9.下载文件需要用到的头  
	         Header("Content-type: application/octet-stream; charset=UTF-8");  
	         Header("Accept-Ranges: bytes");  
	         Header("Accept-Length:".$file_size);  
	         Header("Content-Disposition: attachment; filename=".$filename);
	         ob_clean();  // 解决乱码
	         flush();
	         $buffer=1024;  
	         $file_count=0;  
	         // 10.向浏览器返回数据  
	         while($file_count < $file_size)
	         {  
	             $file_con=fread($fp,$buffer);  
	             $file_count += $buffer;  
	             echo $file_con;  
	         }  
	         fclose($fp);
		}

		//excel 下载
		if ($file_exten == 'xlsx' || $file_exten == 'xls') 
		{
			 $file_name = iconv("utf-8","gb2312",$result->pathname); // 获取文件名
			 $file_path = $this->app->getAppRoot() . "module/contract/upload/" . substr($file_name,0,strpos($file_name,'/')) . '/' .$res->control.substr($file_name,strpos($file_name,'/')); // 拼接路劲
			 // var_dump($filename,$file_name,$file_path);die;
			 if (!file_exists($file_path)) 
			 {
			 	die(js::alert('操作失败,该文件不存在!'));
			 }
			 // 打开读取文件
			 $fp=fopen($file_path,"r");  // 只读的方式
			 $file_size=filesize($file_path) + 100;
			 if ($file_exten == 'xls') 
			 {
			 	$filename = $res->control.'.xls';
			 } else {
			 	$filename = $res->control.'.xlsx';
			 }
			 // 9.下载文件需要用到的头  
	         header("Content-type:application/vnd.ms-excel;charset=UTF-8");    
	         Header("Accept-Ranges: bytes");  
	         Header("Accept-Length:".$file_size);
	         header("Content-Disposition:filename=".$filename);
	         ob_clean();  // 解决乱码
	         flush();
	         $buffer=1024;  
	         $file_count=0;  
	         // 10.向浏览器返回数据  
	         while($file_count < $file_size)
	         {  
	             $file_con=fread($fp,$buffer);  
	             $file_count += $buffer;  
	             echo $file_con;  
	         }  
	         fclose($fp);
		}

		
	}


		/**
		* pdf 合约审核通过后 导出pdf 盖章
		* @access public
		* @param $id  int
		* @return void
		*/
		public function contractpdf($id)
		{
			// 主表
			$result = $this->dao->select('c.*,s.realname')->from('zt_contract')->alias('c')
			                    ->leftjoin('zt_user')->alias('s')
			                    ->on('c.manager = s.account')
			                    ->where('c.id')->eq($id)->fetch();

			// 从表
			$results = $this->dao->select('c.*,s.realname')->from('zt_comments')->alias('c')
			                     ->leftjoin('zt_user')->alias('s')
			                    ->on('c.approvemanager = s.account')
			                    ->where('cid')->eq($id)->fetchAll();

			// 默认按钮 
			if ($result->object == 'group')  {$group = 'checked="checked"';}
			if ($result->object == 'company') {$company = 'checked="checked"';}
			if ($result->close == 'Y') {$im_y = 'checked="checked"';}
			if ($result->close == 'N') {$im_n = 'checked="checked"';}

			// 默认按钮 dept
			foreach ($results as $k => $v) 
			{
				$dept[$v->approvedept] = 'checked="checked"';
				$comments[$k + 1] = $v->comments . ' ( ' .$v->realname. ' ) ';   // 会审
			}

			// 类型
			foreach (explode(',',$result->type) as $key => $value)
			{
				$type[$value] = 'checked="checked"';
			}

			// pdf
			require_once('../../lib/tcpdf/tcpdf.php');

			$pdfs = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
			// $pdfs = new TCPDF("P","mm",'A4');

			// 设置title
			$pdfs->SetTitle($result->endcontrol.'-From');

			//删除预定义的打印 页眉/页尾
			$pdfs->setPrintHeader(false);

			$pdfs->setPrintFooter(false);
			
			//设置默认等宽字体

			$pdfs->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			$pdfs->SetMargins(PDF_MARGIN_LEFT,15,PDF_MARGIN_RIGHT);

			$pdfs->setCellPaddings(0, 0, 0, 0);

			$pdfs->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => '0', 'color' => array(0, 0,0)));

			 //设置自动分页符

			$pdfs->SetAutoPageBreak(TRUE, 15);

			//设置图像比例因子

			$pdfs->setImageScale(PDF_IMAGE_SCALE_RATIO);

			//设置一些语言相关的字符串
			// $pdf->SetFont('times', 'I', 14);
			$pdfs->SetFont('droidsansfallback','I', 11); //解决中文乱码 

			$pdfs->AddPage();

			// header
			$header = '<table border="0">
			<tr>
			<td>
			<img src="../../lib/tcpdf//imgs/logo1.png" alt="" width="80">
			</td>
			<td colspan="5"><b style="font-size:18">'.$this->lang->contract->title[$result->areaid].'<br />合约会审单 (Contract Review Form)</b></td>
			</tr>
			<tr>
			<td width="120"><p style="font-size:10">合约管理编号:<br/>Contract Control No.:</p></td>
			<td><p style="font-size:9;">'.$result->endcontrol.'</p></td>
			<td></td>
			<td></td>
			<td><p style="font-size:9">Date:'.substr($result->createdate,0,4).'/'.substr($result->createdate,5,2).'/'.substr($result->createdate,8,2).'</p></td>
			<td><p style="font-size:9">'.substr($result->createdate,0,4).'年'.substr($result->createdate,5,2).'月'.substr($result->createdate,8,2).'日</p></td>
			</tr>
			</table>';

			// main
	$main = '<table border="1"  cellpadding="4" >
			<tr>
			<th><p style="font-size:9;">申请部门<br/>Application Dept.</p></th>
			<td style="font-size:9;">'.$result->dept.'</td>
			<th><p style="font-size:9;">部门主管<br />Dept. Manager</p></th>
			<td style="font-size:9;">'.$result->realname.'</td>
			<th><p style="font-size:9;">合约对象<br/>Contract Party</p></th>
			<td style="font-size:9;">'.$result->party.'</td>
			</tr>
			<tr>
			<th><p style="font-size:9;">合约名称<br/>Contract Title</p></th>
			<td style="font-size:9;">'.$result->title.'</td>
			<th><p style="font-size:9;">对方<br/>Party B</p></th>
			<td style="font-size:9;">'.$result->otherparty.'</td>
			<th><p style="font-size:9;">文件页数<br/>Number of Pages</p></th>
			<td style="font-size:9;">'.$result->pager.'</td>
			</tr>
			<tr>
			<th rowspan="4" >
			<p style="font-size:9;"><br/><br/><br/><br/><br/><br/><br/>合同内容及会审部门<br/>Contract Content & Review Dept</p>
			</th>
			<td colspan="5"><p style="font-size:8;">由【法务单位】审核合同内容并排定以下相关部门会审顺序 (于括号内以1,2,3...列示) : Legal Service Dept. recommends the following departments to review and comment (review order shown as 1,2,3...etc. in the parenthesis below)</p></td>
			</tr>
			<tr>
			<td><p style="font-size:9;">合同起迄时间<br/>Time Periods</p></td>
			<td><p style="font-size:9;">合约对象<br/>Contract Object</p></td>
			<td><p style="font-size:9;">主要内容摘要<br/>Main Content</p></td>
			<td><p style="font-size:9;">限制条款<br/>Restrictive Clause</p></td>
			<td><p style="font-size:9;">重要与否<br/>Important</p></td>
			</tr>
			<tr>
			<td><span style="font-size:7;">'.$result->startime.'<br/>'.$result->endtime.'</span></td>
			<td><input type="radio" name="radioquestion" id="rqa" value="group" '.$group.' readonly="readonly"/> <label for="rqa"><span style="font-size:9;">集团(group):</span></label><br/><input type="radio" name="radioquestion" id="rqa1" value="company" '.$company.' readonly="readonly"/> <label for="rqa1"><span style="font-size:9;">个别公司<br/>(company):</span></label></td>
			<td><span style="font-size:7;">'.$result->maincontent.'</textarea></td>
			<td><span style="font-size:7;">'.$result->clause.'</span></td>
			<td><input type="radio" name="radioquestion" id="rqa2" value="Y" '.$im_y.' readonly="readonly"/> <label for="rqa2"><span style="font-size:9;"> 是 (Y) </span></label><br/><input type="radio" name="radioquestion" id="rqa3" value="N" '.$im_n.' readonly="readonly"/> <label for="rqa3"><span style="font-size:9;"> 否 (N) </span></label></td>
			</tr>
			<tr>
			<td colspan="4">
			<table border="0">
			<tr><td><input type="checkbox" name="Finance" value="Finance" '.$dept['Finance'].' readonly="readonly"/> <label for="Finance"><span style="font-size:9;"> Finance </span></label></td>
			<td><input type="checkbox" name="HR" value="HR" '.$dept['HR'].' readonly="readonly"/> <label for="HR"><span style="font-size:9;"> HR </span></label></td>
			<td><input type="checkbox" name="IT" value="IT" '.$dept['IT'].' readonly="readonly"/> <label for="IT"><span style="font-size:9;"> IT </span></label></td>
			<td><input type="checkbox" name="System" value="System" '.$dept['System'].' readonly="readonly"/> <label for="System"><span style="font-size:9;"> System </span></label></td>
			</tr>
			<tr><td><input type="checkbox" name="Sales" value="Sales" '.$dept['Sales'].' readonly="readonly"/> <label for="Sales"><span style="font-size:9;"> Sales </span></label></td>
			<td><input type="checkbox" name="FAE" value="FAE" '.$dept['FAE'].' readonly="readonly"/> <label for="FAE"><span style="font-size:9;"> FAE </span></label></td>
			<td><input type="checkbox" name="QA" value="QA" '.$dept['QA'].' readonly="readonly"/> <label for="QA"><span style="font-size:9;"> QA </span></label></td>
			<td><input type="checkbox" name="IC" value="IC" '.$dept['IC'].' readonly="readonly"/> <label for="IC"><span style="font-size:9;"> IC Design </span></label></td>
			</tr>
			<tr><td><input type="checkbox" name="Layout" value="Layout" '.$dept['Layout'].'  readonly="readonly"/> <label for="Layout"><span style="font-size:9;"> Layout/CAD </span></label></td>
			<td><input type="checkbox" name="TEchology" value="TEchology"  '.$dept['TEchology'].'  readonly="readonly"/> <label for="TEchology"><span style="font-size:9;"> Technology </span></label></td>
			<td><input type="checkbox" name="Packing" value="Packing"  '.$dept['Packing'].'  readonly="readonly"/> <label for="Packing"><span style="font-size:9;"> Packaging </span></label></td>
			<td><input type="checkbox" name="Audit" value="Audit"  '.$dept['Audit'].'  readonly="readonly"/> <label for="Audit"><span style="font-size:9;"> Audit </span></label></td>
			</tr>
			<tr><td><input type="checkbox" name="Marketing" value="Marketing"  '.$dept['Marketing'].'  readonly="readonly"/> <label for="Marketing"><span style="font-size:9;"> Marketing </span></label></td>
			<td><input type="checkbox" name="Foundry" value="Foundry"  '.$dept['Foundry'].'  readonly="readonly"/> <label for="Foundry"><span style="font-size:9;"> Foundry </span></label></td>
			<td><input type="checkbox" name="IP" value="IP"  '.$dept['IP'].'  readonly="readonly"/> <label for="IP"><span style="font-size:9;"> IP </span></label></td>
			<td><input type="checkbox" name="Construction" value="Construction"  '.$dept['Construction'].'  readonly="readonly"/> <label for="Construction"><span style="font-size:9;"> Construction </span></label></td>
			</tr>
			<tr><td><input type="checkbox" name="Public" value="Public" '.$dept['Public'].' readonly="readonly"/> <label for="Public"><span style="font-size:9;">Public Relations </span></label></td>
			<td><input type="checkbox" name="Test" value="Test" '.$dept['Test'].' readonly="readonly"/> <label for="Test"><span style="font-size:9;"> Test </span></label></td>
			<td><input type="checkbox" name="Operation" value="Operation" '.$dept['Operation'].' readonly="readonly"/> <label for="Operation"><span style="font-size:9;"> Operation </span></label></td>
			<td><input type="checkbox" name="LG" value="LG" '.$dept['LG'].' readonly="readonly"/> <label for="LG"><span style="font-size:9;"> Legal </span></label></td>
			</tr>
			</table>
			</td>
			<td rowspan="2"><p style="font-size:9;"><br/><br/>共计 '.$result->sum.' 会审部门<br/>Total: '.$result->sum.' Dept.<br/><br/>法务: '.$result->legalapprove.' <br/><br/>Legal Service: <br/>'.$result->legalservice.'</p></td>
			</tr>
			<tr>
			<td><span style="font-size:9;"><br/>合约类型<br/>Contract Type</span></td>
			<td colspan="4">
			<table border="0">
			<tr>
			<td><input type="checkbox" name="销售" value="销售" '.$type['SA'].' readonly="readonly"/> <label for="销售"><span style="font-size:8;"> 销售(Sales) </span></label></td>
			<td><input type="checkbox" name="采购" value="采购" '.$type['PU'].' readonly="readonly"/> <label for="采购"><span style="font-size:8;"> 采购(Purchase) </span></label></td>
			<td><input type="checkbox" name="专利" value="专利" '.$type['PA'].' readonly="readonly"/> <label for="专利"><span style="font-size:8;"> 专利(Patent) </span></label></td>
			<td><input type="checkbox" name="研发" value="研发" '.$type['RD'].' readonly="readonly"/> <label for="研发"><span style="font-size:8;"> 研发(R&D) </span></label></td>
			</tr>
			<tr>
			<td><input type="checkbox" name="委外" value="委外" '.$type['OU'].' readonly="readonly"/> <label for="委外"><span style="font-size:8;"> 委外(Outsource) </span></label></td>
			<td><input type="checkbox" name="股权" value="股权" '.$type['SH'].' readonly="readonly"/> <label for="股权"><span style="font-size:8;"> 股权(Stock) </span></label></td>
			<td><input type="checkbox" name="融资" value="融资" '.$type['LO'].' readonly="readonly"/> <label for="融资"><span style="font-size:8;"> 融资(Finance) </span></label></td>
			<td><input type="checkbox" name="租凭" value="租凭" '.$type['LE'].' readonly="readonly"/> <label for="租凭"><span style="font-size:8;"> 租凭(Lease) </span></label></td>
			</tr>
			<tr>
			<td><input type="checkbox" name="集团" value="集团" '.$type['GR'].' readonly="readonly"/> <label for="集团"><span style="font-size:8;"> 集团(Group) </span></label></td>
			<td><input type="checkbox" name="固资" value="固资" '.$type['FI'].' readonly="readonly"/> <label for="固资"><span style="font-size:8;">固资(Fixed assets) </span></label></td>
			<td><input type="checkbox" name="其他" value="其他" '.$type['OT'].' readonly="readonly"/> <label for="其他"><span style="font-size:8;"> 其他(Others) </span></label></td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
			<th colspan="6"><span style="font-size:8;">* 经排定之会审部门请依会审顺序, 于以下字段表示意见并签章. * Each review department please provides your comments and seal in the boxes below as the review order shown above.</span></th>
			</tr>
			</table>
			<table border="1" cellspacing="0" cellpadding="6">
			<tr>
			<th style="width:49"><span style="font-size:9;">顺序<br/>order</span></th>
			<td style="width:270"><span style="font-size:9;">意 见 说 明 / 签 章<br/>Comments/Signature</span></td>
			<th style="width:49"><span style="font-size:9;">顺序<br/>order</span></th>
			<td style="width:270"><span style="font-size:9;">意 见 说 明 / 签 章<br/>Comments/Signature</span></td>
			</tr>
			<tr>
			<th><span style="font-size:9;">1</span></th>
			<td>
			<span style="font-size:8;">'.$comments[1].'</span>
			</td>
			<th><span style="font-size:9;">6</span></th>
			<td>
			<span style="font-size:8;">'.$comments[6].'</span>
			</td>
			</tr>
			<tr>
			<th><span style="font-size:9;">2</span></th>
			<td>
			<span style="font-size:8;">'.$comments[2].'</span>
			</td>
			<th><span style="font-size:9;">7</span></th>
			<td>
			<span style="font-size:8;">'.$comments[7].'</span>
			</td>
			</tr>
			<tr>
			<th><span style="font-size:9;">3</span></th>
			<td>
			<span style="font-size:8;">'.$comments[3].'</span>
			</td>
			<th><span style="font-size:9;">8</span></th>
			<td>
			<span style="font-size:8;">'.$comments[8].'</span>
			</td>
			</tr>
			<tr>
			<th><span style="font-size:9;">4</span></th>
			<td>
			<span style="font-size:8;">'.$comments[4].'</span>
			</td>
			<th><span style="font-size:9;">9</span></th>
			<td>
			<span style="font-size:8;">'.$comments[9].'</span>
			</td>
			</tr>
			<tr>
			<th><span style="font-size:9;">5</span></th>
			<td>
			<span style="font-size:8;">'.$comments[5].'</span>
			</td>
			<th><span style="font-size:9;">10</span></th>
			<td>
			<span style="font-size:8;">'.$comments[10].'</span>
			</td>
			</tr>
			<tr>
			<th style="width:80;"><span style="font-size:9">备注说明<br/>Remark</span></th>
			<td style="width:558;">
			<span style="font-size:8;">'.$result->remark.'</span>
			</td>
			</tr>
			<tr>
			<th style="width:638;">
			<span style="font-size:8;">备注: 申请部门->法务部门 (审核合同并排定会审顺序) ->各会审部门->申请部门 (详阅会审意见并协商修改) ->法务部门 (确定最终合同文本) ->行政人事部门 (用印申请及存查合约会审单正本) -> 文档归档.<br/>Process: Application Dept.->Legal Service Dept.(arrange review order)->Each Review Dept.(provide comments and seal)->Application Dept.(complete signing with contract party)->Legal Service Dept.(Determine the final text of the contract)->HR Dept.(final review and application for seal)->Audit(file)</span>
			</th>
			</tr>
			</table>';
			$txt = $header.$main;
			$pdfs->MultiCell($w, $h, $txt, $border=0, $align='L',$fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0,$ishtml=true, $autopadding=true, $maxh=0,$valign='M', $fitcell=true);
			ob_end_clean(); // 清空缓存
			$pdfs->writeHTMLCell();
			// $pdfs->Output('/wamp64/www/server-performance/module/contract/upload/form/'.$result->control.'-From.pdf', 'I');
			$pdfs->Output($result->endcontrol.'-From.pdf', 'D');



		}






}


?>