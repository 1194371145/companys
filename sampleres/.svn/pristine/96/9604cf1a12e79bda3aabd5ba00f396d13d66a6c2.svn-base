<?php
class sample extends control
{
	public function sample()
	{
		parent::__construct();
		$this->loadModel("action");
		$this->loadModel("mp");
		$this->loadModel('search');
		include '../../lib/PHPExcel/PHPExcel.php';
		include '../../lib/PHPExcel/PHPExcel/IOFactory.php';
		if(in_array("20",$this->app->user->groups))
		{
			$this->region="TW";
		}
		elseif(array_intersect($this->app->user->groups,array(3,14)))
		{
			$this->region="HZ";
		}
		else
		{
			$this->region="";
		}
	}
	
	public function index($type='normal',$param=0,$orderBy='id_desc',$recTotal=0,$recPerPage=20,$pageID=1)
	{
		$pager=pager::init($recTotal, $recPerPage, $pageID);
		$region=$this->region;
		if($type=='normal')
		{
			$this->view->samples=$this->sample->index($orderBy,$pager,$region);
		}
		else 
		{
			$queryID=(int)$param;
			if($queryID)
			{
				$query=$this->search->getQuery($queryID);
				if($query)
				{
					$this->session->set("sampleQuery",$query->sql);
					$this->session->set("sampleForm",$query->form);
				}
				else 
				{
					$this->session->set("sampleQuery","1 = 1");
				}
			}
			$samplequery=$this->session->sampleQuery;
			$this->view->samples=$this->sample->indexsearch($samplequery,$orderBy,$pager);
		}
		$this->config->sample->index->search['actionURL']=$this->createLink('sample','index',"type=bysearch&param=myQueryID");
		$this->config->sample->index->search['queryID']=$queryID;
		$this->view->searchForm=$this->fetch('search','buildForm',$this->config->sample->index->search);
		$this->view->browseType=$type;
		$this->view->pager=$pager;
		$this->view->param=$param;
		$this->view->orderBy=$orderBy;
		$this->display();
	}
	public function importbasicdata()
	{
		header("content-type:text/html;charset=utf8");
		if(!empty($_FILES['file']))
		{
			if($_FILES['file']['tmp_name'])
			{
				$ob=PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
				$region=$this->region;
				if(isset($_POST['region'])){$region=$_POST['region'];}
				if(isset($_POST['openby'])){$openby=$_POST['openby'];}else{$openby=$this->app->user->account;}
				$sheetob=$ob->setActiveSheetIndex(0);
				$allrows=$sheetob->getHighestRow();
				$B=trim($ob->getActiveSheet()->getCell("B3")->getValue());
				$C=trim($ob->getActiveSheet()->getCell("C3")->getValue());
				$D=trim($ob->getActiveSheet()->getCell("D3")->getValue());
				$E=trim($ob->getActiveSheet()->getCell("E3")->getValue());
				if($B!='PE' or $C!="Status" or $D!="Project #" or $E!="Wafer code"){die(js::alert("文件格式不正确 请下载正确的文件模板格式"));}
				$feild=array(
				"A"=>"no","B"=>"pe","C"=>"status","D"=>"project",
				"E"=>"wafer_code","F"=>"options","G"=>"device","H"=>"mark",
				"I"=>"package","J"=>"qty","K"=>"inventry","L"=>"factory",
				"M"=>"packagetype","N"=>"waferlot","O"=>"ids","P"=>"date","Q"=>"test",
				"R"=>"remark","S"=>"note","T"=>"ordert"
				);
				$success=0;
				$repeat=0;
				$fail=0;
				$Invalid=0;
				$no="";
				for($row=4;$row<=$allrows;$row++)
				{
					$data=array();
					if(!empty($region)){$data['region']=$region;}
					for($col="A";$col<="T";$col++)
					{
						$data[$feild[$col]]=trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
					}
					if(!empty($data['no']) and $data['no']){$no=$data['no'];}
					$data['no']=$no;
					if(empty($data['device'])){$Invalid++;continue;}
					if(empty($data['date']))
					{
						$data['date']=date("Y-m-d");
					}
					else
					{
						if(!strtotime($data['date']))
						{
							$data['date']=date("Y-m-d",strtotime($this->mp->excelTime($data['date'])));
						}
						else 
						{
							$data['date']=date("Y-m-d",strtotime($data['date']));
						}
					}
					$data['qty']=intval($data['qty']);$data['inventry']=intval($data['inventry']);
					$data['createdate']=date("Y-m-d");$data['openby']=$openby;
					$is_daoru=$this->sample->is_daoru($data);
					if($is_daoru){$repeat++;continue;}
					$pro=$this->sample->getpeandphase($data['device']);
					if($pro['pe'])$data['pe']=$pro['pe'];
					if($pro['staus'])$data['status']=$pro['status'];
					$data['proline']=$pro['proline'];
					$data['ae']=$pro['ae'];
					$this->dao->insert('zt_sample')->data($data)->autoCheck()->exec();
					if(dao::isError()){die(js::error(dao::getError()));}
					$id=$this->dao->lastInsertID();
					if($id)
					{
						$this->action->create("sample","$id","Open");
						$success++;
						
					}
					else 
					{
						$fail++;
					}
				}
				echo "<script type='text/javascript'>alert('成功:$success"."条记录 \\n 重复：$repeat"."条记录\\n 无效：$Invalid"."条记录\\n 失败:$fail"."条记录');parent.location.reload();</script>";			
			}
			else
			{
				echo js::alert("请选择文件");
			}
		}
		$huangli=$this->loadModel('group')->getUserPairs(3);
		$banshichu=$this->loadModel('group')->getUserPairs(14);
		$twk=$this->loadModel('group')->getUserPairs(20);
		$this->view->openbys=array_merge($huangli,$banshichu,$twk);
		$this->display();
	
	}
	public function asyncpeandphase()
	{
		$sessionid=file_get_contents("https://csr.silergycorp.com:8585/index.php?m=api&f=getSessionID&t=json");
    	$sessionid=json_decode($sessionid);
    	$sessionid=json_decode($sessionid->data);
    	$sessionid=$sessionid->sessionID;
    	$loginarr=file_get_contents("https://csr.silergycorp.com:8585/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyw2e3&t=json");
    	$login=json_decode($loginarr);
    	if($login->status=='success')
    	{
    		$pic=file_get_contents("https://csr.silergycorp.com:8585/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=asyncpeandphase&t=json");
    		$picdata=json_decode($pic);
    		$re=json_decode($picdata->data,true);
    		foreach($re as $k=>$v)
    		{
    			if($v)
    			{	
    				$this->dao->update('zt_sample')->data($v)->where('device')->eq($k)->exec();
    			}
    		}
			$this->loadModel('sampleapp')->mappingfrom();
    	}
		echo js::alert("Success!!");
		die(js::locate($this->inlink("index")));
	}
	public function export()
	{
		$data=$this->sample->getexportdata();
		$pFilename="sample.xls";
		$ob=PHPExcel_IOFactory::load($pFilename);
		$ob->setActiveSheetIndex();
		$row=4;
		foreach($data as $v)
		{
			$ob->getActiveSheet()->setCellValue("A$row",$v->no)
								 ->setCellValue("B$row",$v->pe)
								 ->setCellValue("C$row",$v->status)
								 ->setCellValue("D$row",$v->project)
								 ->setCellValue("E$row",$v->wafer_code)
								 ->setCellValue("F$row",$v->options)
								 ->setCellValue("G$row",$v->device)
								 ->setCellValue("H$row",$v->mark)
								 ->setCellValue("I$row",$v->packagetype)
								 ->setCellValue("J$row",$v->qty)
								 ->setCellValue("K$row",$v->inventry)
								 ->setCellValue("L$row",$v->ordert)
								 ->setCellValue("M$row",$v->factory)
								 ->setCellValue("N$row",$v->package)
								 ->setCellValue("O$row",$v->waferlot)
								 ->setCellValue("P$row",$v->date)
								 ->setCellValue("Q$row",$v->test)
								 ->setCellValue("R$row",$v->remark)
								 ->setCellValue("S$row",$v->note)
								 ;
								 $row++;
			
		}
		$ob->getActiveSheet()->setTitle("sampledata");
		$wob=PHPExcel_IOFactory::createWriter($ob,'Excel5');
		if(PATH_SEPARATOR!=":"){$filename="样品数据表.xls";}else{$filename=iconv("UTF8", auto, "样品数据").".xls";}
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$filename");
		header("Cache-Control:max-age=0");
		$wob->save('php://output');
		
	}
  public function editsample($id)
	{
		if(!empty($_POST))
		{
			
			$changes=$this->sample->editsample($id);
			if(dao::isError()){die(js::error(dao::getError()));}
			$actionID=$this->action->create("sample",$id,'编辑');
			$this->action->logHistory($actionID,$changes);
			//$this->loadModel('sampleapp')->mappingfrom();
			die(js::locate($this->inlink('editsample',"id=$id"),'parent'));
		}
		$region=$this->region;
		$sample=$this->sample->getsamplebyid($id,$region);
		$this->view->sample=$sample;
		$but=$this->loadModel('group')->getUserPairs(14);
		$but=array_keys($but);
		if(in_array($this->app->user->account,$but) and $sample->openby!=$this->app->user->account)
		{
			echo js::error("此条记录没有编辑权限");
			echo "<script type='text/javascript'>history.go(-1)</script>";
		}
		if(in_array($this->app->user->account,$but) or $this->app->user->account=='admin')
		{
			$this->view->cpower=true;
		}
		else
		{
			$this->view->cpower=false;
		}
		$this->display();
	}
	public function viewsample($id)
	{

		$sample=$this->sample->getsamplebyid($id);
		$this->view->sample=$sample;
		$but=$this->loadModel('group')->getUserPairs(14);
		$but=array_keys($but);
		if(in_array($this->app->user->account,$but) and $sample->openby!=$this->app->user->account)
		{
			echo js::error("此条记录没有查看权限");
			echo "<script type='text/javascript'>history.go(-1)</script>";
		}
		$this->view->actions=$this->action->getList('sample',$id);
		$this->view->out=$this->sample->getoutofdata($id);
		$this->display();
	}
	public function deletesample($id,$confirm='no')
	{
		if($confirm=='yes')
		{
			$this->dao->update('zt_sample')->set('deleted')->eq('1')->where('id')->eq($id)->exec();
			$this->action->create('sample',$id,"删除");
			echo json_encode(array('result'=>'success'));
		}
	}
	public function tsmtoexcel()
	{
		$conn = ftp_connect("101.68.73.134") or die("Could not connect");
		$logst=ftp_login($conn,"TSMC","D73nS0tc");
		$nlist=ftp_nlist($conn,"INKLESSMAP");
		foreach($nlist as $v)
		{
			if(strpos($v,"00.TSM")!==false)
			{
				$nv=str_replace(strrchr($v,".TSM"),"",$v);
				$size=@ftp_size($conn,"INKLESSMAP/".$nv.".xls");
				if($size <=0)
				{
					$ob=new PHPExcel();
					$ob->setActiveSheetIndex();
					$fget=ftp_get($conn,$v,"INKLESSMAP/".$v,FTP_ASCII);
					if($fget)
					{
						$re=file($v);
						$cont=count($re);
						$row=1;
						foreach($re as $rk=>$rv)
						{
							if($rk<5)
							{
								$ob->getActiveSheet()->setCellValue("A$row",$rv);
							}
							elseif($rk==5)
							{
								$res=str_replace(array("\n"," "),"#",$rv);
								$resa=explode("#",$res);
								$resa=array_slice(array_filter($resa),0);
								$ob->getActiveSheet()->setCellValue("A$row",$resa[0])
									->setCellValue("B$row",$resa[1])
									->setCellValue("C$row",$resa[2].$resa[3])
									;
							}
							elseif($rk==$cont-1)
							{
								$ob->getActiveSheet()->setCellValue("C$row",$rv);
							}
							else
							{
								$res=str_replace(array("\n"," "),"#",$rv);
								$resa=explode("#",$res);
								$resa=array_slice(array_filter($resa),0);
								$ob->getActiveSheet()->setCellValue("A$row",$resa[0])
									->setCellValue("B$row",$resa[1])
									->setCellValue("C$row",$resa[2])
									;
							}
							$row++;
						}
						$ob->getActiveSheet()->setTitle("TSM");
						$wob=PHPExcel_IOFactory::createWriter($ob,'Excel5');
						$wob->save('./'.$nv.".xls");
						$sr=ftp_put($conn,"INKLESSMAP/".$nv.".xls",$nv.".xls",FTP_BINARY);
						if($sr)
						{
							unlink($nv.".xls");
						}
					}
					unlink($v);
				}
			}
		}
		ftp_close($conn);
	}
	
}
