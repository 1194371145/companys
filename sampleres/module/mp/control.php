<?php
class mp extends control
{
	public function mp()
	{
		parent::__construct();
		$this->loadModel('action');
		$this->loadModel('search');
		include '../../lib/PHPExcel/PHPExcel.php';
		include "../../lib/PHPExcel/PHPExcel/IOFactory.php";
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
	public function index($selecttype='normal',$param=0,$orderBy='id_asc',$recTotal = 0, $recPerPage = 50, $pageID = 1)
	{
		$pager=pager::init($recTotal,$recPerPage,$pageID);
		$queryID=(int)$param;
		$region=$this->region;
		if($selecttype=='normal')
		{
			$mps=$this->mp->getallmp($orderBy,$pager,$region);
		}
		else 
		{
			if($selecttype=='bysearch')
			{
				if($queryID)
				{
					$query=$this->search->getQuery($queryID);
					if($query)
					{
						$this->session->set('mpQuery',$query->sql);
						$this->session->set('mpForm',$query->form);
					}
					else 
					{
						$this->session->set('mpQuery',"1=1");
					}
				}
			}
			$mpquery=$this->session->mpQuery;
			if(strpos($mpquery,"`Code` = 'yes'")!==false)
			{
				$mpquery=str_replace("`Code` = 'yes'", "`release_code` = `wafer_code`", $mpquery);
			}
			if(strpos($mpquery,"`Code` = 'no'")!==false)
			{
				$mpquery=str_replace("`Code` = 'no'", "`release_code` != `wafer_code`", $mpquery);
			}
			if(strpos($mpquery,"`Code` = ''")!==false)
			{
				$mpquery=str_replace("`Code` = ''", "1", $mpquery);
			}
			$mps=$this->mp->getallmpbysearch($mpquery,$orderBy,$pager,$region);
		}
		$this->config->mp->index->search['actionURL']=$this->createLink('mp','index',"selecttype=bysearch&param=myQueryID");
		$this->config->mp->index->search['queryID']=$queryID;
		$this->view->searchForm=$this->fetch('search','buildForm',$this->config->mp->index->search);
		$this->view->mps=$mps;
		$this->view->pager=$pager;
		$this->view->orderBy=$orderBy;
		$this->view->param=$param;
		$this->view->selecttype=$selecttype;
		$this->view->browseType=$selecttype;
		$this->display();
	}
	public function importbasicdata()
	{
		if(!empty($_FILES['file']))
		{
			
			if($_FILES['file']['tmp_name'])
			{
				$region=$this->region;
				if(isset($_POST['region'])){$region=$_POST['region'];}
				if(isset($_POST['openby'])){$openby=$_POST['openby'];}else{$openby=$this->app->user->account;}
				$ob=PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
				$sheetob=$ob->setActiveSheetIndex();
				$A3=trim($ob->getActiveSheet()->getCell("A3")->getValue());
				$B3=trim($ob->getActiveSheet()->getCell("B3")->getValue());
				$C3=trim($ob->getActiveSheet()->getCell("C3")->getValue());
				if($A3!='NO' or $B3!='Device' or $C3!='Package' ){die(js::error("请选择正确的文件"));}
				$allrows=$sheetob->getHighestRow();
				$fields=array(
								"A"=>"no",
								"B"=>"device",
								"C"=>"package",
								"D"=>"wafer_code",
								"E"=>"release_code",
								"F"=>"company",
								"G"=>"top_mark",
								"H"=>"wafer_lot",
								"I"=>"qty",
								"J"=>"date",
								"K"=>"remark"
								);
				$success=0;
				$repeat=0;
				$Invalid=0;
				$merge=0;
				$no="";
				for($row=4;$row<=$allrows;$row++)
				{
					$data=array();
					if(!empty($region)){$data['region']=$region;}
					for($col="A";$col<="K";$col++)
					{
						$data[$fields[$col]]=trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
					}
					if(!empty($data['no']) and $data['no']){$no=$data['no'];}
					$data['no']=$no;
					$data['qty']=intval($data['qty']);
					if(empty($data['device']) or empty($data['wafer_lot']) or empty($data['no']) or empty($data['qty'])){$Invalid++;continue;}
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
					$data['createdate']=date("Y-m-d");
					$data['openby']=$openby;
					$is_daoru=$this->mp->mpbis_daoru($data);
					if($is_daoru){$repeat++;continue;}
					$lot=intval($data['wafer_lot']);
					if($lot!='0')
					{
					$lot=str_replace($lot,"",$data['wafer_lot']);
					$lotf=substr($lot,0,1);
					if($lotf=='-'){$lot=substr($lot,1);}else{$lot=substr($lot,0);}
					}
					else 
					{
						$lot=$data['wafer_lot'];
					}
					if(empty($data['top_mark']) or empty($data['wafer_code']))
					{
						$orderdata1=$this->mp->getorderfielddata(trim($data['device']),$lot);
						$orderdata2=$this->mp->getorderfielddatebywaferlot(trim($data['device']),$lot);
						if(empty($orderdata1['top_mark']))
						{
							$data['top_mark']=$orderdata2['top_mark'];
						}
						else
						{
							$data['top_mark']=$orderdata1['top_mark'];
						}
						if(empty($orderdata1['company']))
						{
							$data['company']=$orderdata2['company'];
						}
						else
						{
							$data['company']=$orderdata1['company'];
						}
						if(empty($orderdata1['wafer_code']))
						{
							$data['wafer_code']=trim($orderdata2['wafer_code']);
						}
						else
						{
							$data['wafer_code']=trim($orderdata1['wafer_code']);
						}
					}
					if(empty($data['release_code']))
					{
						$prodata=$this->mp->getproductreleasefielddata($data['device']);
						$data['package']=$prodata['package'];$data['release_code']=trim($prodata['release_code']);
						$data['proline']=$prodata['proline'];$data['ae']=trim($prodata['ae']);
					}
					if($data['release_code']==$data['wafer_code'] and !empty($data['release_code'])){$data['status']='可送';}else{$data['status']='不可送';}
					$is_exists=$this->mp->mpbis_exists($data);
					if($is_exists)
					{
						$merge++;
						continue;
					}
					$this->dao->insert("zt_mp")->data($data)->autoCheck()->exec();
					if(dao::isError()){die(js::error(dao::getError()."\n Error in $row Row"));}
					if(!dao::isError())
					{
						$id=$this->dao->lastInsertID();
						$this->action->create("mpbasic",$id,"Open");
						$success++;
						$data['mid']=$id;
						$this->dao->insert('zt_mpi')->data($data)->autoCheck()->exec();
						if(dao::isError()){die(js::error(dao::getError()));}
						$lastid=$this->dao->lastInsertID();
						$this->action->create("mpi",$lastid,"Open");
					}
				}
				echo "<script type='text/javascript'>alert('成功:$success"."条记录 \\n 重复：$repeat"."条记录\\n 合并：$merge"."条记录\\n 无效：$Invalid"."条记录');parent.location.reload();</script>";	
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
	public function importindata()
	{
		if(!empty($_FILES['file']))
		{
			if($_FILES['file']['tmp_name'])
			{
			    $region = $this->region;
				if(isset($_POST['region'])){$region=$_POST['region'];}
				if(isset($_POST['openby'])){$openby=$_POST['openby'];}else{$openby=$this->app->user->account;}
				$ob=PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
				$sheetob=$ob->setActiveSheetIndex();
				$A3=trim($ob->getActiveSheet()->getCell("A3")->getValue());
				$B3=trim($ob->getActiveSheet()->getCell("B3")->getValue());
				$C3=trim($ob->getActiveSheet()->getCell("C3")->getValue());
				if($A3!='NO' or $B3!='Device' or $C3!='Package' ){die(js::error("请选择正确的文件"));}
				$allrows=$sheetob->getHighestRow();
				$fields=array(
								"A"=>"no",
								"B"=>"device",
								"C"=>"package",
								"D"=>"wafer_code",
								"E"=>"release_code",
								"F"=>"company",
								"G"=>"top_mark",
								"H"=>"wafer_lot",
								"I"=>"qty",
								"J"=>"date",
								"K"=>"remark"
								);
				$success=0;
				$repeat=0;
				$Invalid=0;
				$merge=0;
				$no="";
				for($row=4;$row<=$allrows;$row++)
				{
					$data=array();
					if(!empty($region)){$data['region']=$region;}
					for($col="A";$col<="K";$col++)
					{
						$data[$fields[$col]]=trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
					}
					if(!empty($data['no']) and $data['no']){$no=$data['no'];}
					$data['no']=$no;
					$data['qty']=intval($data['qty']);
					if(empty($data['device']) or empty($data['wafer_lot']) or empty($data['no']) or empty($data['qty'])){$Invalid++;continue;}
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
					$data['createdate']=date("Y-m-d");
					$data['openby']=$openby;
					$is_daoru=$this->mp->mpbis_daoru($data);
					if($is_daoru){$repeat++;continue;}
					$lot=intval($data['wafer_lot']);
					if($lot!='0')
					{
					$lot=str_replace($lot,"",$data['wafer_lot']);
					$lotf=substr($lot,0,1);
					if($lotf=='-'){$lot=substr($lot,1);}else{$lot=substr($lot,0);}
					}
					else 
					{
						$lot=$data['wafer_lot'];
					}
					if(empty($data['top_mark']) or empty($data['wafer_code']))
					{
						$orderdata1=$this->mp->getorderfielddata(trim($data['device']),$lot);
						$orderdata2=$this->mp->getorderfielddatebywaferlot(trim($data['device']),$lot);
						if(empty($orderdata1['top_mark']))
						{
							$data['top_mark']=$orderdata2['top_mark'];
						}
						else
						{
							$data['top_mark']=$orderdata1['top_mark'];
						}
						if(empty($orderdata1['company']))
						{
							$data['company']=$orderdata2['company'];
						}
						else
						{
							$data['company']=$orderdata1['company'];
						}
						if(empty($orderdata1['wafer_code']))
						{
							$data['wafer_code']=trim($orderdata2['wafer_code']);
						}
						else
						{
							$data['wafer_code']=trim($orderdata1['wafer_code']);
						}
					}
					if(empty($data['release_code']))
					{
						$prodata=$this->mp->getproductreleasefielddata($data['device']);
						$data['package']=$prodata['package'];$data['release_code']=trim($prodata['release_code']);
						$data['proline']=$prodata['proline'];$data['ae']=trim($prodata['ae']);
					}
					if($data['release_code']==$data['wafer_code'] and !empty($data['release_code'])){$data['status']='可送';}else{$data['status']='不可送';}
					$is_exists=$this->mp->mpiis_exists($data);
					if($is_exists)
					{
						$data['mid']=$is_exists;
						$this->dao->insert('zt_mpi')->data($data)->autoCheck()->exec();
						if(dao::isError()){die(js::error(dao::getError()."\n Error in $row Row"));}
						if(!dao::isError())
						{
							$id=$this->dao->lastInsertID();
							$this->action->create("mpi",$id,"Open");
							$mpqty=$this->dao->select('qty')->from('zt_mp')->where('id')->eq($is_exists)->fetch('qty');
							$this->dao->update('zt_mp')->set('qty')->eq($mpqty+$data['qty'])->where('id')->eq($is_exists)->autoCheck()->exec();
							if(dao::isError()){die(js::error(dao::getError()));}
							if(!dao::isError())
							{
								$old['qty']=$mpqty;
								$new['qty']=$mpqty + $data['qty'];
								$aciotnID=$this->action->create('mpbsic',"$is_exists","入库数量{$data['qty']} 入库记录ID$id");
								if(common::createChanges($old, $new))
								{
									$this->action->logHistory($aciotnID,common::createChanges($old, $new));
								}
							}
						}
						$merge++;
						continue;
					}
					$this->dao->insert("zt_mp")->data($data)->autoCheck()->exec();
					if(dao::isError()){die(js::error(dao::getError()."\n Error in $row Row"));}
					if(!dao::isError())
					{
						$id=$this->dao->lastInsertID();
						$this->action->create("mpbasic",$id,"Open");
						$success++;
						$data['mid']=$id;
						$this->dao->insert('zt_mpi')->data($data)->autoCheck()->exec();
						if(dao::isError()){die(js::error(dao::getError()."\n Error in $row Row"));}
						if(!dao::isError())
						{
							$id=$this->dao->lastInsertID();
							$this->action->create("mpi",$id,"Open");
						}
						$merge++;
					}
					
				}
				echo "<script type='text/javascript'>alert('生成主数据:$success"."条记录 \\n 重复：$repeat"."条记录\\n 入库：$merge"."条记录\\n 无效：$Invalid"."条记录');</script>";
				exit(js::locate('back','parent'));
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
	public function editmp($id)
	{
	    $region = $this->region;
        $mp = $this->mp->getbasicbyid($id, $region);
        if(!$mp)
		{
            echo js::error('object not exist');
            exit(js::locate('back', 'self'));
        }
		if(!empty($_POST))
		{
			$changes=$this->mp->editmp($id);
			if(dao::isError()){die(js::error(dao::getError()));}
			$actionID=$this->action->create('mpbasic',$id,'编辑');
			$this->action->logHistory($actionID,$changes);
			//$this->loadModel('sampleapp')->mappingfrom();
			die(js::locate($this->inlink('editmp',"id=$id"),'parent'));
		}
        $this->view->mp = $mp;
		$this->display();
	}
	public function async()
	{
		$mps=$this->dao->select("wafer_lot,device,id,ae,proline,wafer_code")->from('zt_mp')->where('deleted')->eq(0)->andWhere('no')->ne("无(非常规料号)")->fetchAll();
		foreach($mps as $v)
		{
					//if($v->ae and $v->proline)continue;
					$data=array();
					$lot=intval(trim($v->wafer_lot));
					if($lot!='0')
					{
					$lot=str_replace($lot,"",$v->wafer_lot);
					$lotf=substr($lot,0,1);
					if($lotf=='-'){$lot=substr($lot,1);}else{$lot=substr($lot,0);}
					}
					else 
					{
						$lot=$v->wafer_lot;
					}
					$orderdata1=$this->mp->getorderfielddata(trim($v->device),$lot);
					$orderdata2=$this->mp->getorderfielddatebywaferlot(trim($v->device),$lot);
					if(empty($orderdata1['top_mark']))
					{
						$data['top_mark']=$orderdata2['top_mark'];
					}
					else
					{
						$data['top_mark']=$orderdata1['top_mark'];
					}
					if(empty($orderdata1['company']))
					{
						$data['company']=$orderdata2['company'];
					}
					else
					{
						$data['company']=$orderdata1['company'];
					}
					if(empty($orderdata1['wafer_code']))
					{
						$data['wafer_code']=trim($orderdata2['wafer_code']);
					}
					else
					{
						$data['wafer_code']=trim($orderdata1['wafer_code']);
					}
					$prodata=$this->mp->getproductreleasefielddata(trim($v->device));
					$data['package']=$prodata['package'];$data['release_code']=trim($prodata['release_code']);
					if(!$data['top_mark'])unset($data['top_mark']);
					if(!$data['company'])unset($data['company']);
					if($v->wafer_code)unset($data['wafer_code']);
					if(!$data['package'])unset($data['package']);
					if(!$data['release_code'])unset($data['release_code']);
					//if($data['wafer_code']!=$data['release_code']){$data['status']='不可送';}
					//if($data['wafer_code']==$data['release_code']){$data['status']='可送';}
					$data['proline']=$prodata['proline'];
					$data['ae']=$prodata['ae'];
					if(!$data['proline'])unset($data['proline']);
					if(!$data['ae'])unset($data['ae']);
					if($data)$this->dao->update('zt_mp')->data($data)->where('id')->eq($v->id)->exec();
		}
		$this->loadModel('sampleapp')->mappingfrom();
		echo js::alert("success");
		die(js::locate($this->inlink('index'),'parent'));
	}
	public function viewmp($id)
	{
		$region = $this->region;
        $mp=$this->mp->getbasicbyid($id,$region);
        if(!$mp){
            echo js::error('object not exist');
            exit(js::locate('back','self'));
        }
        $this->view->mp=$mp;
        $this->view->actions=$this->action->getList('mpbasic',$id);
        $this->view->idata=$this->mp->getindata($id);
        $this->view->odata=$this->mp->getodata($id);
		$this->display();
	}
	public function deletemp($id,$confirm='no')
	{
		$region = $this->region;
        $mp=$this->mp->getbasicbyid($id,$region);
        if(!$mp){
            echo js::error('object not exist');
            exit(js::locate('back','self'));
        }
		if($confirm=='yes')
		{
			$this->dao->update('zt_mp')->set('deleted')->eq('1')->where('id')->eq($id)->exec();
			$this->action->create('mpbasic',$id,"删除");
			echo json_encode(array('result'=>'success'));
		}
	}
	public function exportresult()
	{
		$filepath="./mp.xls";
		$ob=PHPExcel_IOFactory::load($filepath);
		$ob->setActiveSheetIndex();
		$region=$this->region;
		$data=$this->mp->getexportdata($region);
		$row=4;
		foreach($data as $v)
		{
			$ob->getActiveSheet()->setCellValue("A$row",$v->no)
								 ->setCellValue("B$row",$v->device)
								 ->setCellValue("C$row",$v->package)
								 ->setCellValue("D$row",$v->wafer_code)
								 ->setCellValue("E$row",$v->release_code)
								 ->setCellValue("F$row",$v->company)
								 ->setCellValue("G$row",$v->top_mark)
								 ->setCellValue("H$row",$v->wafer_lot)
								 ->setCellValue("I$row",$v->qty)
								 ->setCellValue("J$row",$v->date)
								 ->setCellValue("K$row",$v->remark)
								 ;
			$row++;						 
		}
		$wob=PHPExcel_IOFactory::createWriter($ob,'Excel5');
		if(PATH_SEPARATOR!=":"){$filename="量产数据表.xls";}else{$filename=iconv("UTF8",auto,"量产数据表").".xls";}
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$filename");
		header("Cache-Control:max-age=0");
		$wob->save('php://output');
	}
	public function matchfactorylot()
	{
		
		//for($i=1;$i<=;$i++)
		//{
			$filename="./top/3.xls";
			$ob=PHPExcel_IOFactory::load($filename);
			$ob->setActiveSheetIndex(0);
			if($i==0){$company='Corp';}
			if($i==1){$company='HZ';}
			if($i==2){$company='NJ';}
			$company='';
			
			$row=2;
			while($part=trim($ob->getActiveSheet()->getCell("A$row")->getValue()))
			{
				$wafer_code=trim($ob->getActiveSheet()->getCell("D$row")->getValue());
				$wafer_lot=trim($ob->getActiveSheet()->getCell("F$row")->getValue());
				$package=trim($ob->getActiveSheet()->getCell("I$row")->getValue());
				$top_mark=trim($ob->getActiveSheet()->getCell("J$row")->getValue());
				$atlot=trim($ob->getActiveSheet()->getCell("O$row")->getValue());
				$mp=$this->dao->select("*")->from('zt_mp')->where('deleted')->eq(0)->andWhere('device')->eq($part)->fetchAll();
				if($mp)
				{
					foreach($mp as $v)
					{
						if(empty($v->wafer_code))
						{
							if(is_numeric(substr($v->wafer_lot,0,4))){$newwaferlot=substr($v->wafer_lot,5);}else{$newwaferlot=$v->wafer_lot;}
							if(strpos($newwaferlot,$atlot)!==false or strpos($atlot,$newwaferlot)!==false or strpos($newwaferlot,$wafer_lot)!==false or strpos($wafer_lot,$newwafer)!==false)
							{
								$this->dao->update('zt_mp')->set('remark')->eq($v->remark."#".$v->wafer_lot)
														   ->set('wafer_lot')->eq($wafer_lot)->set('package')->eq($package)
														   ->set('top_mark')->eq($top_mark)->set('wafer_code')->eq($wafer_code)
														   ->set('company')->eq($company)
														   ->where('id')->eq($v->id)
														   ->exec();
							}
						}
					}
				}
				$row++;
			}
		//}

		
	}
	function linshiupdatempstatus()
	{
		$allmp=$this->dao->select("id")->from("zt_mp")->fetchAll();
		foreach($allmp as $v)
		{
			$status=$this->dao->select("status")->from("zt_mp1")->where('id')->eq($v->id)->fetch('status');
			if($status)
			{
				$this->dao->update("zt_mp")->set('status')->eq($status)->where("id")->eq($v->id)->exec();
			}
		}
	}
}
