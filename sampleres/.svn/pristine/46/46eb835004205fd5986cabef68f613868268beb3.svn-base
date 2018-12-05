<?php
class sampleout extends control
{
    public function sampleout()
    {
        parent::__construct();
        $this->loadModel('search');
        $this->loadModel("action");
        $this->loadModel('mp');
        $this->loadModel('sample');
        $this->view->notpart=$this->sampleout->notpart;

    }

    //自定义pdo对象
    public function pdo($dbname)
    {
        $pdo = new PDO("mysql:dbname=$dbname;host=192.168.5.16;charset=utf8",'root','Silergy13');
        return $pdo;
    }
    //样品申请记录
    public function out($type='normal',$param='0',$orderBy='close_asc,id_desc',$recTotal=0,$recPerPage=20,$pageID=1)
    {
        // header("content-type:text/html;charset=utf8;");
        $pager=pager::init($recTotal,$recPerPage,$pageID);

        if($type=='normal')
        {
            $out=$this->sampleout->out($orderBy,$pager,'sample');

        }
        //通过search显示
        if($type=='bysearch')
        {
            $queryID=(int)$param;
            if($queryID)
            {
                $query=$this->search->getQuery($queryID);
                if($query)
                {
                    $this->session->set("sampleoutQuery",$query->sql);
                    $this->session->set("sampleoutForm",$query->form);
                }
                else
                {
                    $this->session->set("sampleoutQuery","1 = 1");
                }
            }
            else
            {
                if($this->session->sampleoutQuery == false) $this->session->set('sampleoutQuery', ' 1 = 1');
            }
            $where=$this->session->sampleoutQuery;


            $out=$this->sampleout->getoutbysearch($where,$pager,$orderBy,'sample');
        }

        $this->config->sampleout->out->search['actionURL']=$this->createLink('sampleout','out',"type=bysearch&param=myQueryID");
        $this->config->sampleout->out->search['queryID']=$queryID;
        $this->view->searchForm=$this->fetch('search','buildForm',$this->config->sampleout->out->search);
        $this->view->out=$out;
        $this->view->pager=$pager;
        $this->view->param=$param;
        $this->view->orderBy=$orderBy;
        $this->view->type=$type;
        $this->view->browseType=$type;
        $toassign=$this->loadModel('group')->getUserPairs(14);
        $toassign['']="";
        $this->view->toassign=$toassign;
        // var_dump($this->view);die;
        $this->display();
    }
    public function demo($type='normal',$param='0',$orderBy='close_asc,id_desc',$recTotal=0,$recPerPage=20,$pageID=1)
    {
        header("content-type:text/html;charset=utf8;");
        $pager=pager::init($recTotal,$recPerPage,$pageID);
        if($type=='normal')
        {
            $out=$this->sampleout->out($orderBy,$pager,'demo');

        }
        if($type=='bysearch')
        {
            $queryID=(int)$param;
            if($queryID)
            {
                $query=$this->search->getQuery($queryID);
                if($query)
                {
                    $this->session->set("sampleoutQuery",$query->sql);
                    $this->session->set("sampleoutForm",$query->form);
                }
                else
                {
                    $this->session->set("sampleoutQuery","1 = 1");
                }
            }
            else
            {
                if($this->session->sampleoutQuery == false) $this->session->set('sampleoutQuery', ' 1 = 1');
            }
            $where=$this->session->sampleoutQuery;

            $out=$this->sampleout->getoutbysearch($where,$pager,$orderBy,"demo");
        }
        $this->config->sampleout->out->search['actionURL']=$this->createLink('sampleout','demo',"type=bysearch&param=myQueryID");
        $this->config->sampleout->out->search['queryID']=$queryID;
        $this->view->searchForm=$this->fetch('search','buildForm',$this->config->sampleout->out->search);
        $this->view->out=$out;
        $this->view->pager=$pager;
        $this->view->param=$param;
        $this->view->orderBy=$orderBy;
        $this->view->type=$type;
        $this->view->browseType=$type;
        $toassign=$this->loadModel('group')->getUserPairs(14);
        $toassign['']="";
        $this->view->toassign=$toassign;
        $this->display();
    }

    //申请记录-申请付费标示
    public function pay($type='normal',$param='0',$orderBy='close_asc,id_desc',$recTotal=0,$recPerPage=20,$pageID=1)
    {
        header("content-type:text/html;charset=utf8;");
        $pager=pager::init($recTotal,$recPerPage,$pageID);
        //查看该用户的分组权限
        $priv = $this->sampleout->getPriv($this->app->user->groups['1']);
		$region='HZ';
        if($type=='normal')
        {
            $out=$this->sampleout->getpay($orderBy,$pager,$region);

        }
        if($type=='bysearch')
        {
            $queryID=(int)$param;
            if($queryID)
            {
                $query=$this->search->getQuery($queryID);
                if($query)
                {
                    $this->session->set("sampleoutQuery",$query->sql);
                    $this->session->set("sampleoutForm",$query->form);
                }
                else
                {
                    $this->session->set("sampleoutQuery","1 = 1");
                }
            }
            else
            {
                if($this->session->sampleoutQuery == false) $this->session->set('sampleoutQuery', ' 1 = 1');
            }
            $where=$this->session->sampleoutQuery;
            $out=$this->sampleout->getpaybysearch($orderBy,$pager,$where,$region);

        }
        $this->config->sampleout->out->search['actionURL']=$this->createLink('sampleout','pay',"type=bysearch&param=myQueryID");
        $this->config->sampleout->out->search['queryID']=$queryID;
        $this->view->searchForm=$this->fetch('search','buildForm',$this->config->sampleout->out->search);
        $this->view->out=$out;
        $this->view->pager=$pager;
        $this->view->param=$param;
        $this->view->orderBy=$orderBy;
        $this->view->type=$type;
        $this->view->browseType=$type;
        $this->view->priv=$priv;
        $this->display();
    }
    function signpay()
    {
        if(!empty($_POST))
        {
            $this->dao->update('zt_out')->set('pay')->eq('done')
                ->where('id')->in($_POST['pay'])
                ->andWhere('pay')->eq('wait')
                ->andWhere('revtype')->eq('需要付费')
                ->exec();
            die(js::locate($this->inlink('pay'),'parent'));
        }
    }
    public function deleteout($id,$confirm='no')
    {
        if($confirm=='no'){die(js::confirm("确定要删除吗 次删除无法恢复",$this->inlink('deleteout',"id=$id&confirm=yes")));}
        if($confirm!='no')
        {
            $olddata=$this->dao->select("demofile")->from("zt_out")->where("id")->eq($id)->fetch('demofile');
            $res = $this->dao->delete()->from('zt_out')->where('id')->eq($id)->exec();
            if($res)
			{
                $this->action->create('sampleout',$id,"删除");
				@unlink($this->loadModel('file')->savePath.$olddata);
            }
            else
			{
                die(js::error('object not exist'));
            }
            echo "<script language='javascript'>parent.location.reload();</script>";
        }
    }
	public function downloaddemofile($demoid)
	{
			$olddata=$this->dao->select("demofile,demofiletitle")->from("zt_out")->where("id")->eq($demoid)->fetch();
			$file_dir =  $this->loadModel('file')->savePath;
			$file_name = $olddata->demofile;
			$title=$olddata->demofiletitle;
			$kuozhan=strrchr($file_name,".");
			$file = fopen($file_dir . $file_name,"r");          
			Header("Content-type: application/octet-stream");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ".filesize($file_dir . $file_name));
			Header("Content-Disposition: attachment; filename=" . $title.$kuozhan);
			echo fread($file,filesize($file_dir . $file_name));
			fclose($file);
			exit();
	}
    //导入申请表
    public function importout()
    {
        header("content-type:text/html;charset=utf8");
        if(!empty($_FILES['file']))
        {
            if($_FILES['file']['tmp_name'])
            {
                include '../../lib/PHPExcel/PHPExcel.php';
                include "../../lib/PHPExcel/PHPExcel/IOFactory.php";
                $ob=PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
                $sheetob=$ob->setActiveSheetIndex();
                //$A3=trim($ob->getActiveSheet()->getCell("A3")->getValue());
                //$B3=trim($ob->getActiveSheet()->getCell("B3")->getValue());
                //$C3=trim($ob->getActiveSheet()->getCell("C3")->getValue());
                //if($A3!='Name' or $B3!='Request Date' or $C3!='RF' ){die(js::error("请选择正确的文件"));}
                $A13=trim($ob->getActiveSheet()->getCell("A13")->getValue());
                $B13=trim($ob->getActiveSheet()->getCell("B13")->getValue());
                $C13=trim($ob->getActiveSheet()->getCell("C13")->getValue());
                if($A13!='Request Type' or $B13!='Part Number' or $C13!='Package Type' ){die(js::error("请选择正确的文件"));}
                $allrows=$sheetob->getHighestRow();

                $fields=array(
                    //"A"=>"person"    , "F"=>"package",
                    //"B"=>"rdate"     , "G"=>"endname",
                    //				   "H"=>"distributor",
                    //"C"=>"rf"        , "I"=>"projectname",
                    //"D"=>'rtype'    , "J"=>"stage",
                    //"E"=>"partn"     , "K"=>"qty",
                    //"L"=>"aqty"      , "M"=>"price",
                    //"N"=>"rev" ,"O"=>"shiporder",
                    //"P"=>"shipdate","Q"=>'remark'
                    "A"=>"rtype","B"=>"partn",
                    "C"=>"package","D"=>'endname',
                    "E"=>"projectname","F"=>"stage",
                    "G"=>'qty',"I"=>"remark","H"=>"set",
                    "J"=>"person","K"=>"distributor",
                    "L"=>"price",
                );
                $repeat=0;
                $success=0;
                $invalid=0;
                $str="";
                for($row=14;$row<=$allrows;$row++)
                {
                    $data=array();
                    for($col="A";$col<="L";$col++)
                    {
                        $data[$fields[$col]]=trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
                    }
                    unset($data['set']);
                    if(empty($data['partn']) or empty($data['rtype'])){$invalid++;continue;}
                    /*if(empty($data['rdate']))
                    {
                        $data['rdate']=date("Y-m-d");
                    }
                    else
                    {
                        if(!strtotime($data['rdate']))
                        {
                            $data['rdate']=date("Y-m-d",strtotime($this->mp->excelTime($data['rdate'])));
                        }
                        else
                        {
                            $data['rdate']=date("Y-m-d",strtotime($data['rdate']));
                        }
                    }*/
                    $data['rf']=date("YmdHis");
                    $data['rdate']=date("Y-m-d");
                    $data['shipdate']="0000-00-00";
                    $data['area']=$this->post->area;
                    $data['openby']=$this->app->user->account;
                    $data['createdate']=date("Y-m-d H:i:s");
                    $data['qty']=(int)$data['qty'];$data['aqty']=(int)$data['qty'];$data['price']=(float)$data['price'];
                    $data['rev']=$data['aqty'] * $data['price'];
                    if($data['qty']>30 and $data['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India,EU",$data['area'])===false){$data['approve']='1';}
                    if($data['qty']>100 and $data['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India,EU",$data['area'])!==false){$data['approve']='1';}
                    $is_dao=$this->sampleout->outis_daoru($data);

                    if($is_dao){$repeat++;continue;}//统计重复数据
                    $this->dao->insert('zt_out')->data($data)->autoCheck()->exec();
                    if(dao::isError()){die(js::error(dao::getError()));}//抛出异常
                    $id=$this->dao->lastInsertID();
                    $this->action->create('sampleout',"$id","Open");
                    $success++;//新增成功数量
                    if($data['qty']>30 and $data['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India,EU",$data['area'])===false)
                    {
                        $str.="<tr><td>{$data['partn']}</td><td>{$data['person']}</td><td>{$data['qty']}</td><td>{$data['endname']}</td><td>{$data['distributor']}</td><td>{$data['revtype']}</td><td>{$data['price']}</td></tr>";
                    }
                    if($data['qty']>100 and $data['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India,EU",$data['area'])!==false)
                    {
                        $str.="<tr><td>{$data['partn']}</td><td>{$data['person']}</td><td>{$data['qty']}</td><td>{$data['endname']}</td><td>{$data['distributor']}</td><td>{$data['revtype']}</td><td>{$data['price']}</td></tr>";
                    }
                }
                if(!empty($str))
                {
                    $str="<table border='1' cellspacing='0'><tr><td>申请人</td><td>产品型号</td><td>申请数量</td><td>EndName</td><td>DisName</td><td>付费</td><td>价格</td></tr>".$str."</table>";

                }
                echo "<script type='text/javascript'>alert('成功:$success"."条记录 \\n 重复：$repeat"."条记录\\n 无效：$invalid"."条记录');parent.location.reload();</script>";
            }
            else
            {
                echo js::alert("请选择文件");
            }
        }
        $this->display();
    }

    //导出表
    public function exportout()
    {
		$region="HZ";
        if($region == 'all') $region = '';
        // $pager=pager::init(0,20,1);
        $sampleouts = $this->dao->select("*")->from('zt_out')->where($this->session->exportsampleout)
            ->beginIF($region)
            ->andwhere('region')->eq($region)
            ->fi()
            //->andWhere('close')->eq('done')
            ->orderBy($this->session->exportsampleoutorderby)
            ->fetchAll();
        include "../../lib/PHPExcel/PHPExcel.php";
        include "../../lib/PHPExcel/PHPExcel/IOFactory.php";
        //设置导出表格大小
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array( 'memoryCacheSize' => '512MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);

        $pathfile="./sampleout.xls";
        $ob=PHPExcel_IOFactory::load($pathfile);
        $ob->setActiveSheetIndex(0);
        $style=$ob->getActiveSheet()->getStyle('B4');
        $row=4;
        foreach($sampleouts as $v)
        {
            $ob->getActiveSheet()->setCellValue("A$row",$v->person)
                ->setCellValue("B$row",$v->rdate)
                ->setCellValue("C$row",$v->rf)
                ->setCellValue("D$row",$v->rtype)
                ->setCellValue("E$row",$v->partn)
                ->setCellValue("F$row",$v->package)
                ->setCellValue("G$row",$v->endname)
                ->setCellValue("H$row",$v->distributor)
                ->setCellValue("I$row",$v->projectname)
                ->setCellValue("J$row",$v->stage)
                ->setCellValue("K$row",$v->qty)
                ->setCellValue("L$row",$v->aqty)
                ->setCellValue("M$row",$v->price)
                ->setCellValue("N$row",$v->rev)
                ->setCellValue("O$row",$v->shiporder)
                ->setCellValue("P$row",$v->shipdate)
                ->setCellValue("Q$row",$v->remark)
                ->setCellValue("R$row",$v->area)
                ->setCellValue("S$row",$v->revtype)
                ->setCellValue("T$row",$this->lang->sampleout->type[$v->type])
            ;$row++;
        }
        $ob->getActiveSheet()->duplicateStyle($style,"A4:T".$row);
        $ob->getActiveSheet()->setTitle('申请记录');
        $wob=PHPExcel_IOFactory::createWriter($ob,"Excel5");
        if(PATH_SEPARATOR!=":"){$filename="申请记录.xls";}else{$filename=iconv("UTF8", auto, "申请记录").".xls";}
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=$filename");
        header("Cache-Control:max-age=0");
        $wob->save('php://output');
    }
    //提交申请记录表
    public function createout()
    {
        if($_POST)
        {
            //去掉数据两侧的空格和标签
            $_POST['tomobile'] = trim($_POST['tomobile']);
            if(!isset($_GET['type'])) //保存
            {
                if(filter_var($_POST['aqty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['price'],FILTER_VALIDATE_FLOAT)===false
                    or filter_var($_POST['qty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['rev'],FILTER_VALIDATE_FLOAT)===false
                )
                {
                    die(js::error("申请数量,发货数量,价格,金额 必须为数字"));
                }
                $data=fixer::input('post')
                    ->stripTags()
                    ->addIF(strpos(trim($_POST['mid']),'sample')!==false,'type','2')
                    ->addIF(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false,'type','1')
                    ->addIF(trim($_POST['mid'])=='0','type','3')
                    ->addIF(intval($_POST['qty'])>30 and $_POST['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India,EU",$_POST['area']) ===false,'approve','1')
                    ->addIF(intval($_POST['qty'])>100 and $_POST['revtype']!='需要付费' and strpos("KR,TW,US,Japan,India,EU",$_POST['area']) !==false,'approve','1')
                    ->setForce('mid',intval($_POST['mid']))
                    ->setForce("rev",$_POST['aqty'] * $_POST['price'])
                    ->add('openby',$this->app->user->account)
                    ->add('createdate',date("Y-m-d H:i:s"))
                    ->get();
                $this->dao->insert('zt_out')->data($data)->autoCheck()
                    ->checkIF($_POST['revtype'] =='需要付费','distributor',"notempty")
                    ->checkIF($_POST['revtype'] =='需要付费','price',"notempty")
                    ->batchCheck('shipdate,rdate,createdate','date')
                    ->batchCheck('partn,tocompany,toperson,tomobile,toaddress','notempty')
                    ->exec();
                if(dao::isError()){die(js::error(dao::getError()));}
                $id=$this->dao->lastInsertId();
                $actionID=$this->action->create("sampleout",$id,"Open");

                if(isset($_GET['type'])) //出货
                {
                    if(filter_var($_POST['aqty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['qty'],FILTER_VALIDATE_FLOAT)===false
                        or filter_var($_POST['price'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['rev'],FILTER_VALIDATE_FLOAT)===FALSE
                    )
                    {
                        die(js::error("申请数量,发货数量,价格,金额 必须为数字"));
                    }
                    if(intval($_POST['aqty'])==0){die(js::error("出货数量不能为0"));}
                    $data=fixer::input('post')
                        ->stripTags()
                        ->addIF(strpos(trim($_POST['mid']),'sample')!==false,'type','2')
                        ->addIF(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false,'type','1')
                        ->addIF(trim($_POST['mid'])=='0','type','3')
                        ->setForce('mid',intval($_POST['mid']))
                        ->add('openby',$this->app->user->account)
                        ->add('createdate',date("Y-m-d H:i:s"))
                        ->add('close','done')
                        ->setForce("rev",$_POST['aqty'] * $_POST['price'])
                        ->get();
                    $this->dao->insert('zt_out')->data($data)->autoCheck()
                        ->checkIF($_POST['revtype']=='需要付费','distributor',"notempty")
                        ->checkIF($_POST['revtype']=='需要付费','price',"notempty")
                        ->batchCheck('shiporder,shipdate,tocompany,toperson,tomobile,toaddress','notempty')
                        ->batchCheck('shipdate,rdate,createdate','date')
                        ->check('partn','notempty')
                        ->exec();
                    if(dao::isError()){die(js::error(dao::getError()));}
                    $id=$this->dao->lastInsertID();
                    $actionID=$this->action->create("sampleout",$id,"OpenAnd完成出货");
                    if(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false)
                    {
                        $mp=$this->mp->getmpbyid(intval($_POST['mid']));
                        $this->dao->update('zt_out')->set('conn')->eq($mp->wafer_lot)
                            ->autoCheck()
                            ->where('id')->eq($id)
                            ->exec();
                        $mqty=$mp->qty;
                        if($mqty < $_POST['aqty'])
                        {
                            die(js::error("关联主数据的库存数量已不能满足本条出库记录的需求  因此无法出货"));
                            $this->dao->update('zt_mp')->set('qty')->eq(0)->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                            if(dao::isError()){js::error(dao::getError());}
                            $actionID=$this->action->create("mpbasic",intval($_POST['mid']),"出库:".$mqty." 出库ID：".$id);
                            $mpn=(object)array();
                            $mpn->qty=0;
                            if(common::createChanges($mp, $mpn))
                            {
                                $this->action->logHistory($actionID,common::createChanges($mp, $mpn));
                            }
                            $this->dao->update('zt_out')->set('rev')->eq($_POST['price']*$mqty)
                                ->set('aqty')->eq($mqty)
                                ->autoCheck()
                                ->where('id')->eq($id)
                                ->exec();
                            $data->aqty=$_POST['aqty']-$mqty;
                            $data->mid=0;
                            $data->type='3';
                            $data->close='wait';
                            $data->revtype='不需付费';
                            $this->dao->insert("zt_out")->data($data)->autoCheck()->exec();
                            if(dao::isError()){die(js::error(dao::getError()));}
                            $lastid=$this->dao->lastInsertID();
                            $this->action->create("sampleout","$lastid","Open");
                        }
                        else
                        {
                            $this->dao->update('zt_mp')->set('qty')->eq($mqty-intval($_POST['aqty']))->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                            if(dao::isError()){die(js::error(dao::getError()));}
                            $actionID=$this->action->create("mpbasic",intval($_POST['mid']),"出库:".$_POST['aqty']." 出库ID：".$id);
                            $mpn=(object)array();
                            $mpn->qty=$mp->qty - $_POST['aqty'];
                            if(common::createChanges($mp, $mpn))
                            {
                                $this->action->logHistory($actionID,common::createChanges($mp, $mpn));
                            }
                        }
                    }
                    elseif(strpos($_POST['mid'],'sample')!==false)
                    {
                        $sample=$this->sample->getsamplebyid(intval($_POST['mid']));
                        $this->dao->update('zt_out')->set('conn')->eq($sample->waferlot)
                            ->autoCheck()->where('id')->eq($id)->exec();
                        $mqty=$sample->inventry;
                        if($mqty < $_POST['aqty'])
                        {
                            die(js::error("关联主数据的库存数量已不能满足本条出库记录的需求  无法出货"));
                            $this->dao->update('zt_sample')->set('inventry')->eq(0)->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                            if(dao::isError()){js::error(dao::getError());}
                            $actionID=$this->action->create("sample",intval($_POST['mid']),"出库:".$mqty." 出库ID：".$id);
                            $samplen=(object)array();
                            $samplen->inventry=0;
                            if(common::createChanges($sample, $samplen))
                            {
                                $this->action->logHistory($actionID,common::createChanges($sample, $samplen));
                            }
                            $this->dao->update('zt_out')->set('aqty')->eq($mqty)
                                ->set('rev')->eq($_POST['price']*$mqty)
                                ->autoCheck()->where('id')->eq($id)->exec();
                            $data->aqty=$_POST['aqty']-$mqty;
                            $data->mid=0;
                            $data->close='wait';
                            $data->revtype='不需付费';
                            $data->type='3';
                            $this->dao->insert("zt_out")->data($data)->autoCheck()->exec();
                            if(dao::isError()){die(js::error(dao::getError()));}
                            $lastid=$this->dao->lastInsertID();
                            $this->action->create("sampleout","$lastid","Open");
                        }
                        else
                        {
                            $this->dao->update('zt_sample')->set('inventry')->eq($mqty-intval($_POST['aqty']))->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                            if(dao::isError()){die(js::error(dao::getError()));}
                            $actionID=$this->action->create("sample",intval($_POST['mid']),"出库:".$_POST['aqty']." 出库ID：".$id);
                            $samplen=(object)array();
                            $samplen->inventry=$sample->inventry - $_POST['aqty'];
                            if(common::createChanges($sample, $samplen))
                            {
                                $this->action->logHistory($actionID,common::createChanges($sample, $samplen));
                            }
                        }
                    }
                }
                //die(js::locate($this->inlink('out'),'parent'));
                if(strpos(strtolower($_POST['rtype']),demo)!==false)die(js::locate($this->inlink('demo'),'parent'));
                if(strpos(strtolower($_POST['rtype']),demo)===false)die(js::locate($this->inlink('out'),'parent'));
            }

            $this->view->position[]='<a href="">填写申请记录</a>';
            $this->display();
        }
    }
    public function getwaitbypart()
    {
        if(!empty($_POST))
        {
            $part=trim($_POST['part']);
            $re=$this->sampleout->getwaitbypart($part);
            $str="";
            foreach($re as $k=>$v)
            {
                $str.="<option value='".$k."'>".$v."</option>";
            }
            echo $str;
        }
    }
    public function editout()
    {
        if($_POST)
        {
			$region="HZ";
            if($region == 'all') $region = '';
            $out=$this->sampleout->getbyid($_POST['id'],$region);
            if(!$out)die(js::error('object not exist'));
            if(isset($_POST['anniu']))
            {
                if(filter_var($_POST['aqty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['price'],FILTER_VALIDATE_FLOAT)===false
                    or filter_var($_POST['qty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['rev'],FILTER_VALIDATE_FLOAT)===false
                )
                {
                    die(js::error("申请数量,发货数量,price,rev 必须为数字"));
                }
                $data=fixer::input('post')
                    ->stripTags()
                    ->addIF(strpos(trim($_POST['mid']),'sample')!==false,'type','2')
                    ->addIF(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false,'type','1')
                    ->addIF(trim($_POST['mid'])=='0','type','3')
                    ->setForce('mid',intval($_POST['mid']))
                    ->setForce("rev",$_POST['aqty'] * $_POST['price'])
                    ->remove('anniu')
                    ->get();
                $this->dao->update('zt_out')->data($data)->autoCheck()
                    ->check('partn','notempty')
                    ->checkIF($_POST['revtype']=='需要付费','distributor',"notempty")
                    ->checkIF($_POST['revtype']=='需要付费','price',"notempty")
                    ->batchCheck('shipdate,rdate,createdate','date')
                    ->where('id')->eq($_POST['id'])
                    ->exec();
                if(dao::isError()){die(js::error(dao::getError()));}
                $actionID=$this->action->create("sampleout",$_POST['id'],"编辑");
                if(common::createChanges($out, $data))
                {
                    $this->action->logHistory($actionID,common::createChanges($out, $data));
                }
            }
            if(!isset($_POST['anniu']))
            {
                if(filter_var($_POST['aqty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['qty'],FILTER_VALIDATE_FLOAT)===false
                    or filter_var($_POST['price'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['rev'],FILTER_VALIDATE_FLOAT)===FALSE
                )
                {
                    die(js::error("申请数量,发货数量,price,rev 必须为数字"));
                }
                if(intval($_POST['aqty'])==0){die(js::error("出货数量不能为0"));}
                $_POST['shipdate']=date("Y-m-d");
                $data=fixer::input('post')
                    ->stripTags()
                    ->addIF(strpos(trim($_POST['mid']),'sample')!==false,'type','2')
                    ->addIF(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false,'type','1')
                    ->addIF(trim($_POST['mid'])=='0','type','3')
                    ->setForce('mid',intval($_POST['mid']))
                    ->add('close','done')
                    ->setForce("rev",$_POST['aqty'] * $_POST['price'])
                    ->get();
                $this->dao->update('zt_out')->data($data)->autoCheck()
                    ->checkIF($_POST['revtype']=='需要付费','distributor',"notempty")
                    ->checkIF($_POST['revtype']=='需要付费','price',"notempty")
                    ->batchCheck('shiporder,shipdate','notempty')
                    ->batchCheck('shipdate,rdate,createdate','date')
                    ->check('partn','notempty')
                    ->where('id')->eq($_POST['id'])->exec();
                if(dao::isError()){die(js::error(dao::getError()));}
                $actionID=$this->action->create("sampleout",$_POST['id'],"完成出货");
                if(common::createChanges($out, $data))
                {
                    $this->action->logHistory($actionID,common::createChanges($out, $data));
                }
                if(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false)
                {
                    $mp=$this->mp->getmpbyid(intval($_POST['mid']),$region);
                    if(!$mp){
                        die('库存id不存在');
                    }
                    $this->dao->update('zt_out')
                        ->set('conn')->eq($mp->wafer_lot)
                        ->autoCheck()
                        ->where('id')->eq($_POST['id'])
                        ->exec();
                    $mqty=$mp->qty;
                    if($mqty < $_POST['aqty'])
                    {
                        die(js::error("关联主数据的库存数量已不能满足本条出库记录的需求  因此无法出货"));
                        $this->dao->update('zt_mp')->set('qty')->eq(0)->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){js::error(dao::getError());}
                        $actionID=$this->action->create("mpbasic",intval($_POST['mid']),"出库:".$mqty." 出库ID：".$_POST['id']);
                        $mpn=(object)array();
                        $mpn->qty=0;
                        if(common::createChanges($mp, $mpn))
                        {
                            $this->action->logHistory($actionID,common::createChanges($mp, $mpn));
                        }
                        $this->dao->update('zt_out')->set('rev')->eq($_POST['price']*$mqty)
                            ->set('aqty')->eq($mqty)
                            ->autoCheck()
                            ->where('id')->eq($_POST['id'])
                            ->exec();
                        $data->aqty=$_POST['aqty']-$mqty;
                        $data->mid=0;
                        $data->type='3';
                        $data->close='wait';
                        $data->revtype='不需付费';
                        $this->dao->insert("zt_out")->data($data)->autoCheck()->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $lastid=$this->dao->lastInsertID();
                        $this->action->create("sampleout","$lastid","Open");
                    }
                    else
                    {
                        $this->dao->update('zt_mp')->set('qty')->eq($mqty-intval($_POST['aqty']))->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $actionID=$this->action->create("mpbasic",intval($_POST['mid']),"出库:".$_POST['aqty']." 出库ID：".$_POST['id']);
                        $mpn=(object)array();
                        $mpn->qty=$mp->qty - $_POST['aqty'];
                        if(common::createChanges($mp, $mpn))
                        {
                            $this->action->logHistory($actionID,common::createChanges($mp, $mpn));
                        }
                    }
                }
                elseif(strpos($_POST['mid'],'sample')!==false)
                {
                    $sample=$this->sample->getsamplebyid(intval($_POST['mid']));
                    $this->dao->update('zt_out')
                        ->set('conn')->eq($sample->waferlot)
                        ->autoCheck()->where('id')->eq($_POST['id'])->exec();
                    $mqty=$sample->inventry;
                    if($mqty < $_POST['aqty'])
                    {
                        die(js::error("关联主数据的库存数量已不能满足本条出库记录的需求  因此无法出货"));
                        $this->dao->update('zt_sample')->set('inventry')->eq(0)->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){js::error(dao::getError());}
                        $actionID=$this->action->create("sample",intval($_POST['mid']),"出库:".$mqty." 出库ID：".$_POST['id']);
                        $samplen=(object)array();
                        $samplen->inventry=0;
                        if(common::createChanges($sample, $samplen))
                        {
                            $this->action->logHistory($actionID,common::createChanges($sample, $samplen));
                        }
                        $this->dao->update('zt_out')->set('aqty')->eq($mqty)
                            ->set('rev')->eq($_POST['price']*$mqty)
                            ->autoCheck()->where('id')->eq($_POST['id'])->exec();
                        $data->aqty=$_POST['aqty']-$mqty;
                        $data->mid=0;
                        $data->close='wait';
                        $data->revtype='不需付费';
                        $data->type='3';
                        $this->dao->insert("zt_out")->data($data)->autoCheck()->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $lastid=$this->dao->lastInsertID();
                        $this->action->create("sampleout","$lastid","Open");
                    }
                    else
                    {
                        $this->dao->update('zt_sample')->set('inventry')->eq($mqty-intval($_POST['aqty']))->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $actionID=$this->action->create("sample",intval($_POST['mid']),"出库:".$_POST['aqty']." 出库ID：".$_POST['id']);
                        $samplen=(object)array();;
                        $samplen->inventry=$sample->inventry - $_POST['aqty'];
                        if(common::createChanges($sample, $samplen))
                        {
                            $this->action->logHistory($actionID,common::createChanges($sample, $samplen));
                        }
                    }
                }
            }
            //die(js::locate($this->inlink('out'),'parent'));
            echo "<script type='text/javascript'>parent.location.reload();</script>";
        }
    }
    //详情方法
    public function viewout($id)
    {
		$region='HZ';
        if($region == 'all') $region = '';
        $out=$this->sampleout->getbyid($id,$region);
        if(!$out){
            echo js::error('object not exist');
            exit(js::locate('back','self'));
        }

        $but=$this->loadModel('group')->getUserPairs(14);
        $but=array_keys($but);
        if(in_array($this->app->user->account,$but) and $out->toassign!=$this->app->user->account)
        {
            echo js::error("此条记录没有查看权限");
            echo "<script type='text/javascript'>history.go(-1)</script>";
        }
        $this->view->out=$out;
        $this->view->position[]="<a href=''>申请记录视图</a>";
        $this->view->actions=$this->action->getList('sampleout',$id);
        $this->display();
    }

    //拒绝申请方法
    public function refuse($id,$confirm='NO')
    {
        if ($confirm == 'NO') {
            die(js::confirm("确定要拒绝该申请吗?",$this->inlink('refuse',"id=$id&confirm=YES"),$this->inlink('pay')));
        } else {
            //通过id来改out表的申请状态
            $result = $this->sampleout->getRefuse($id);
            if ($result) {
                echo js::alert('已拒绝该申请');
                echo js::refresh($this->inlink('pay'), 'top', '2');//确认成功返回页面
            } else {
                echo js::error('操作失败,请重试');
                echo "<script type='text/javascript'>history.go(-1)</script>";//失败返回上一级目录
            }
        }


    }
    //编辑样品申请方法
    public function vieweditout($id)
    {
        header("content-type:text/html;charset=utf8");
		$region="HZ";
        if($region == 'all') $region = '';
        $out=$this->sampleout->getbyid($id,$region);
        $but=$this->loadModel('group')->getUserPairs(14);
        $but=array_keys($but);
        if(in_array($this->app->user->account,$but) and $out->toassign!=$this->app->user->account)
        {
            echo js::error("此条记录没有编辑权限");
            echo "<script type='text/javascript'>history.go(-1)</script>";
        }
        if(!$out)die(js::error('object not exist'));
        if($_POST)
        {
            if(!isset($_GET['type']))
            {
                //去掉两端的特殊字符
                $_POST['tomobile'] = trim($_POST['tomobile']);
                if(filter_var($_POST['aqty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['price'],FILTER_VALIDATE_FLOAT)===false
                    or filter_var($_POST['qty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['rev'],FILTER_VALIDATE_FLOAT)===false
                )
                {
                    die(js::error("申请数量,发货数量,价格,金额 必须为数字"));
                }
                $data=fixer::input('post')
                    ->stripTags()
                    ->addIF(strpos(trim($_POST['mid']),'sample')!==false,'type','2')
                    ->addIF(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false,'type','1')
                    ->addIF(trim($_POST['mid'])=='0','type','3')
                    ->setForce('mid',intval($_POST['mid']))
                    ->setForce("rev",$_POST['aqty'] * $_POST['price'])
                    ->get();
                $this->dao->update('zt_out')->data($data)->autoCheck()
                    ->check('partn','notempty')
                    ->checkIF($_POST['revtype']=='需要付费','distributor',"notempty")
                    ->checkIF($_POST['revtype']=='需要付费','price',"notempty")
                    ->batchCheck('shipdate,rdate,createdate','date')
                    ->batchCheck('tocompany,toaddress,tomobile,toperson','notempty')
                    ->where('id')->eq($id)
                    ->exec();
                if(dao::isError()){die(js::error(dao::getError()));}
                $actionID=$this->action->create("sampleout",$id,"编辑");
                if(common::createChanges($out, $data))
                {
                    $this->action->logHistory($actionID,common::createChanges($out, $data));
                }
                echo "<script type='text/javascript'>parent.location.reload();</script>";
            }
            if(isset($_GET['type']))
            {
                if(filter_var($_POST['aqty'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['qty'],FILTER_VALIDATE_FLOAT)===false
                    or filter_var($_POST['price'],FILTER_VALIDATE_FLOAT)===false or filter_var($_POST['rev'],FILTER_VALIDATE_FLOAT)===FALSE
                )
                {
                    die(js::error("申请数量,发货数量,价格,金额 必须为数字"));
                }
                if(intval($_POST['aqty'])==0){die(js::error("出货数量不能为0"));}
                $_POST['shipdate']=date("Y-m-d");
                $data=fixer::input('post')
                    ->stripTags()
                    ->addIF(strpos(trim($_POST['mid']),'sample')!==false,'type','2')
                    ->addIF(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false,'type','1')
                    ->addIF(trim($_POST['mid'])=='0','type','3')
                    ->setForce('mid',intval($_POST['mid']))
                    ->add('close','done')
                    ->setForce("rev",$_POST['aqty'] * $_POST['price'])
                    ->get();
                $this->dao->update('zt_out')->data($data)->autoCheck()
                    ->checkIF($_POST['revtype']=='需要付费','distributor',"notempty")
                    ->checkIF($_POST['revtype']=='需要付费','price',"notempty")
                    ->batchCheck('shiporder,shipdate,toaddress,tomobile,toperson,tocompany','notempty')
                    ->batchCheck('shipdate,rdate,createdate','date')
                    ->check('partn','notempty')
                    ->where('id')->eq($id)->exec();
                if(dao::isError()){die(js::error(dao::getError()));}
                $actionID=$this->action->create("sampleout",$id,"完成出货");
                if(common::createChanges($out, $data))
                {
                    $this->action->logHistory($actionID,common::createChanges($out, $data));
                }
                if(strpos(trim($_POST['mid']),'mp')!==false and strpos(trim($_POST['mid']),'sample')===false)
                {
                    $mp=$this->mp->getmpbyid(intval($_POST['mid']),$region);
                    if(!$mp){
                        die(js::error('mp not exist'));
                    }
                    $this->dao->update('zt_out')
                        ->set('conn')->eq($mp->wafer_lot)
                        ->autoCheck()
                        ->where('id')->eq($id)
                        ->exec();
                    $mqty=$mp->qty;
                    if($mqty < $_POST['aqty'])
                    {
                        die(js::error("关联主数据的库存数量已不能满足本条出库记录的需求  因此无法出货"));
                        $this->dao->update('zt_mp')->set('qty')->eq(0)->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){js::error(dao::getError());}
                        $actionID=$this->action->create("mpbasic",intval($_POST['mid']),"出库:".$mqty." 出库ID：".$id);
                        $mpn=(object)array();
                        $mpn->qty=0;
                        if(common::createChanges($mp, $mpn))
                        {
                            $this->action->logHistory($actionID,common::createChanges($mp, $mpn));
                        }
                        $this->dao->update('zt_out')->set('rev')->eq($_POST['price']*$mqty)
                            ->set('aqty')->eq($mqty)
                            ->autoCheck()
                            ->where('id')->eq($id)
                            ->exec();
                        $data->aqty=$_POST['aqty']-$mqty;
                        $data->mid=0;
                        $data->type='3';
                        $data->close='wait';
                        $data->revtype='不需付费';
                        $this->dao->insert("zt_out")->data($data)->autoCheck()->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $lastid=$this->dao->lastInsertID();
                        $this->action->create("sampleout","$lastid","Open");
                    }
                    else
                    {
                        $this->dao->update('zt_mp')->set('qty')->eq($mqty-intval($_POST['aqty']))->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $actionID=$this->action->create("mpbasic",intval($_POST['mid']),"出库:".$_POST['aqty']." 出库ID：".$id);
                        $mpn=(object)array();
                        $mpn->qty=$mp->qty - $_POST['aqty'];
                        if(common::createChanges($mp, $mpn))
                        {
                            $this->action->logHistory($actionID,common::createChanges($mp, $mpn));
                        }
                    }
                }
                elseif(strpos($_POST['mid'],'sample')!==false)
                {
                    $sample=$this->sample->getsamplebyid(intval($_POST['mid']));
                    $this->dao->update('zt_out')
                        ->set('conn')->eq($sample->waferlot)
                        ->autoCheck()->where('id')->eq($id)->exec();
                    $mqty=$sample->inventry;
                    if($mqty < $_POST['aqty'])
                    {
                        die(js::error("关联主数据的库存数量已不能满足本条出库记录的需求  因此无法出货"));
                        $this->dao->update('zt_sample')->set('inventry')->eq(0)->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){js::error(dao::getError());}
                        $actionID=$this->action->create("sample",intval($_POST['mid']),"出库:".$mqty." 出库ID：".$id);
                        $samplen=(object)array();
                        $samplen->inventry=0;
                        if(common::createChanges($sample, $samplen))
                        {
                            $this->action->logHistory($actionID,common::createChanges($sample, $samplen));
                        }
                        $this->dao->update('zt_out')->set('aqty')->eq($mqty)
                            ->set('rev')->eq($_POST['price']*$mqty)
                            ->autoCheck()->where('id')->eq($id)->exec();
                        $data->aqty=$_POST['aqty']-$mqty;
                        $data->mid=0;
                        $data->close='wait';
                        $data->revtype='不需付费';
                        $data->type='3';
                        $this->dao->insert("zt_out")->data($data)->autoCheck()->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $lastid=$this->dao->lastInsertID();
                        $this->action->create("sampleout","$lastid","Open");
                    }
                    else
                    {
                        $this->dao->update('zt_sample')->set('inventry')->eq($mqty-intval($_POST['aqty']))->autoCheck()->where('id')->eq(intval($_POST['mid']))->exec();
                        if(dao::isError()){die(js::error(dao::getError()));}
                        $actionID=$this->action->create("sample",intval($_POST['mid']),"出库:".$_POST['aqty']." 出库ID：".$id);
                        $samplen=(object)array();
                        $samplen->inventry=$sample->inventry - $_POST['aqty'];
                        if(common::createChanges($sample, $samplen))
                        {
                            $this->action->logHistory($actionID,common::createChanges($sample, $samplen));
                        }
                    }
                }
                //die(js::locate($this->inlink('out'),'parent'));
                //echo "<script type='text/javascript'>history.go(-1);parent.location.reload();</script>";
                if(strpos(strtolower($_POST['rtype']),demo)!==false)die(js::locate($this->inlink('demo'),'parent'));
                if(strpos(strtolower($_POST['rtype']),demo)===false)die(js::locate($this->inlink('out'),'parent'));
            }
        }
        $this->view->out=$out;
        $this->view->actions=$this->action->getList('sampleout',$id);
        $this->view->position[]="详细编辑";
        $this->display();
    }
    function shenhe()
    {
		$region="HZ";
        if($region == 'all') $region = '';
        $old_data=$this->dao->select('approve')->from('zt_out')->where('id')->eq($_POST['id'])->beginIF($region)->andwhere('region')->eq($region)->fi()->fetch();
        if(!$old_data) die('object ont exist');
        $id=$this->dao->update('zt_out')->set('approve')->eq(2)->where('id')->eq($_POST['id'])->exec();
        $old=(object)array();
        $new=(object)array();
        $old->approve=$old_data->approve;
        if($id)
        {
            $new->approve=2;
            $actionID=$this->action->create("sampleout",intval($_POST['id']),'Approved');
            if(common::createChanges($old, $new))
            {
                $this->action->logHistory($actionID,common::createChanges($old, $new));
            }
            echo true;
        } else {
            echo false;
        }
    }
    public function mailsample()
    {
        $re=array();
        $outs=$this->dao->select("*")->from('zt_out')
            ->where('createdate')->like(date("Y-m-d")."%")
            //->where('createdate')->le("2018-01-15")
            ->andWhere('close')->eq('wait')
            ->andWhere('approve')->in(array("1","3"))
            ->fetchAll();
        foreach($outs as $v)
        {
            if($v->areamanager == '1' or $v->salesmanager == '1')continue;
            if($v->approve=='1'){$approvemark="申请数量超出限制";}
            if($v->approve=='3'){$approvemark="Relase date 超过3年";}
            $str="<tr><td>$v->rdate</td><td>$v->person</td><td>$v->qty</td><td>$v->partn</td><td>$v->revtype</td><td>$v->distributor</td><td>$v->endname</td><td>$v->price</td><td style='color:red;'>$approvemark</td></tr>";
            if($v->areamanager == '')
            {
                if($v->area=='SC')
                {
                    if(array_key_exists('torch',$re))
                    {
                        $re['torch'].=$str;
                    }
                    else
                    {
                        $re['torch']=$str;
                    }
                }
                elseif($v->area=='NC')
                {
                    if(array_key_exists('henry',$re))
                    {
                        $re['henry'].=$str;
                    }
                    else
                    {
                        $re['henry']=$str;
                    }
                }
                elseif($v->area=='TW')
                {
                    if(array_key_exists('tim',$re))
                    {
                        $re['tim'].=$str;
                    }
                    else
                    {
                        $re['tim']=$str;
                    }
                }
            }
            elseif($v->salesmanager== '')
            {
                if(array_key_exists('lynn',$re))
                {
                    $re['lynn'].=$str;
                }
                else
                {
                    $re['lynn']=$str;
                }
            }
        }
        foreach($re as $k=>$v)
        {
            $mailstr="<table cellspacing='0' border='1'><tr><td>申请时间</td><td>申请人</td><td>申请数量</td><td>申请产品</td><td>申请费用</td><td>代理商</td><td>终端</td><td>价格</td><td>审核原因</td></tr>".$v."</table><br/><br/><br/>以上样品申请记录需要您进入系统进行审核！<br/>登陆站点地址：<a href='http://101.68.73.134:8072'>样品申请系统</a><br/>账户密码等同insidesales系统"
            ;
            $this->loadModel('mail')->send($k,date("Y-m-d").'样品申请审核',$mailstr,'admin',true);
        }
    }
    public function maildemo()
    {
        if(date("Y-m-d H:i:s") <= date("Y-m-d")." 14:01:00")
        {
            $start=date("Y-m-d")." 00:00:01";
            $end=date("Y-m-d")." 14:00:00";
        }
        if(date("Y-m-d H:i:s") > date("Y-m-d")." 14:01:00")
        {
            $start=date("Y-m-d")." 14:00:01";
            $end=date("Y-m-d")." 23:59:59";
        }
        //$start="2018-07-13 00:00:01";
        //$end="2018-07-13 14:00:00";
		$array=array();
        $outs=$this->dao->select("*")->from('zt_out')
            ->where('createdate')->ge($start)
            ->andWhere('createdate')->le($end)
            ->andWhere('close')->eq('wait')
            ->andWhere('rtype')->like("%demo%")
            ->fetchAll();
        $str="<table cellspacing='0' border='1'><tr><td>申请时间</td><td>申请人</td><td>申请数量</td><td>Request Type</td><td>申请产品</td><td>说明</td><td>收件公司</td><td>收件人</td><td>联系电话</td><td>详细地址</td><td>代理商</td><td>终端</td><td>Stage</td><td>Package</td><td>Mapping From</td></tr>";
        foreach($outs as $v)
        {
			if($v->ae)
			{
				$tolist=implode(",",$this->lang->sampleout->prolinedemo[$v->proline]);
				$array[$tolist].="<tr><td>$v->createdate</td><td>$v->person</td><td>$v->qty</td><td>$v->rtype</td><td>$v->partn</td><td>$v->remark</td><td>$v->tocompany</td><td>$v->toperson</td><td>$v->tomobile</td><td>$v->toaddress</td><td>$v->distributor</td><td>$v->endname</td><td>$v->stage</td><td>$v->package</td><td>$v->mappingfrom</td></tr>";

			}
        }
		$str1="</table><br/><br/>";
		$str1.="<a href='http://101.68.73.134:8072/index.php'>Demo系统站点：</a>";

		foreach($array as $k=>$v)
		{
			if($v){$this->loadModel('mail')->send($k,date("Y-m-d")."当天".date("H:i:s")."前的Demo产品申请",$str.$v.$str1,'admin,huangli',true);}
			//$this->loadModel('mail')->send($k,date("Y-m-d")."当天"."14点"."前的Demo产品申请",$str.$v.$str1,'admin,huangli',true);
			//$this->loadModel('mail')->send(admin,date("Y-m-d")."当天".date("H:i:s")."前的Demo产品申请".$k,$str.$v.$str1,'',true);
		}
        //$toarr=$this->loadModel("group")->getUserPairs(13);
        //$tostr=implode(",",array_keys($toarr));
        //if($outs){$this->loadModel('mail')->send($tostr,date("Y-m-d")."当天".date("H:i:s")."前的Demo产品申请",$str,'admin,huangli',true);}
       
    }
    //批量收货
    public function batchuhuo()
    {
        header("content-type:text/html;charset=utf8");
        $outids=$this->post->sampleid;
        $outids=explode(",",$outids);
        $outids=array_unique($outids);
        unset($outids[0]);
        if(!empty($_POST['id']))
        {
            $shiporder="";
            foreach($_POST['id'] as $k=>$v)
            {
                $data=array();
                if(!isset($_POST['mid'][$k]))continue;
                $id=intval($_POST['mid'][$k]);
                $type=str_replace($id,"",$_POST['mid'][$k]);
                $waits=$this->sampleout->getbyidofauto($v);
                foreach($waits as $wk=>$wv)
                {
                    $wid=intval($wk);
                    $wtype=str_replace($wid,"",$wk);
                    if($wtype=='mp')
                    {
                        $wmp=$this->mp->getmpbyid($wid);
                        if($wmp->qty>=$_POST['aqty'][$k])
                        {
                            $id=$wid;
                            $type=$wtype;
                            break;
                        }
                    }
                    if($wtype=='sample')
                    {
                        $wsample=$this->sample->getsamplebyid($wid);
                        if($wsample->inventry>=$_POST['aqty'][$k])
                        {
                            $id=$wid;
                            $type=$wtype;
                            break;
                        }
                    }
                }
                if($type=='mp')
                {
                    $mp=$this->mp->getmpbyid($id);
                    if($mp->qty<$_POST['aqty'][$k])continue;
                    if(empty($_POST['shiporder'][$k]))continue;
                    if($_POST['shiporder'][$k]=='同上' and !empty($shiporder))
                    {
                        $_POST['shiporder'][$k]=$shiporder;
                    }
                    else
                    {
                        if($_POST['shiporder'][$k]!='同上'){$shiporder=$_POST['shiporder'][$k];}
                    }
                    $data['person']=$_POST['person'][$k];$data['rdate']=$_POST['rdate'][$k];$data['remark']=$_POST['remark'][$k];$data['rtype']=$_POST['rtype'][$k];$data['partn']=$_POST['partn'][$k];$data['endname']=$_POST['endname'][$k];
                    $data['distributor']=$_POST['distributor'][$k];$data['projectname']=$_POST['projectname'][$k];$data['stage']=$_POST['stage'][$k];$data['qty']=$_POST['qty'][$k];$data['aqty']=$_POST['aqty'][$k];$data['price']=$_POST['price'][$k];
                    $data['rev']=$_POST['aqty'][$k] * $_POST['price'][$k];$data['shiporder']=$_POST['shiporder'][$k];$data['shipdate']=$_POST['shipdate'][$k];$data['area']=$_POST['area'][$k];$data['revtype']=$_POST['revtype'][$k];$data['mid']=$id;
                    $data['type']=1;$data['close']='done';
                    $data['conn']=$mp->wafer_lot;
                    $sampleout=$this->sampleout->getbyid($v);
                    if(!$sampleout)continue;
                    $this->dao->update('zt_out')->data($data)->where("id")->eq($v)->exec();
                    if(!dao::isError())
                    {
                        $actionID=$this->action->create('sampleout',$v,"完成出货");
                        if(common::createChanges($sampleout, $data))
                        {
                            $this->action->logHistory($actionID,common::createChanges($sampleout, $data));
                        }
                    }
                    $this->dao->update('zt_mp')->set('qty')->eq($mp->qty-$_POST['aqty'][$k])->where('id')->eq($id)->exec();
                    $old=(object)array();
                    $new=(object)array();
                    $old->qty=$mp->qty;
                    $new->qty=$mp->qty - $_POST['aqty'][$k];
                    $actionID=$this->action->create("mpbasic",$id,"出库:".$_POST['aqty'][$k]." 出库ID：".$v);
                    if(common::createChanges($old, $new))
                    {
                        $this->action->logHistory($actionID,common::createChanges($old, $new));
                    }
                }
                if($type=='sample')
                {
                    $sample=$this->sample->getsamplebyid($id);
                    if($sample->inventry<$_POST['aqty'][$k])continue;
                    if(empty($_POST['shiporder'][$k]))continue;
                    if($_POST['shiporder'][$k]=='同上' and !empty($shiporder))
                    {
                        $_POST['shiporder'][$k]=$shiporder;
                    }
                    else
                    {
                        if($_POST['shiporder'][$k]!='同上'){$shiporder=$_POST['shiporder'][$k];}
                    }
                    $data['person']=$_POST['person'][$k];$data['rdate']=$_POST['rdate'][$k];$data['remark']=$_POST['remark'][$k];$data['rtype']=$_POST['rtype'][$k];$data['partn']=$_POST['partn'][$k];$data['endname']=$_POST['endname'][$k];
                    $data['distributor']=$_POST['distributor'][$k];$data['projectname']=$_POST['projectname'][$k];$data['stage']=$_POST['stage'][$k];$data['qty']=$_POST['qty'][$k];$data['aqty']=$_POST['aqty'][$k];$data['price']=$_POST['price'][$k];
                    $data['rev']=$_POST['aqty'][$k] * $_POST['price'][$k];$data['shiporder']=$_POST['shiporder'][$k];$data['shipdate']=$_POST['shipdate'][$k];$data['area']=$_POST['area'][$k];$data['revtype']=$_POST['revtype'][$k];$data['mid']=$id;
                    $data['type']=2;$data['close']='done';
                    $data['conn']=$sample->waferlot;
                    $sampleout=$this->sampleout->getbyid($v);
                    if(!$sampleout)continue;
                    $this->dao->update('zt_out')->data($data)->where("id")->eq($v)->exec();
                    if(!dao::isError())
                    {
                        $actionID=$this->action->create('sampleout',$v,"完成出货");
                        if(common::createChanges($sampleout, $data))
                        {
                            $this->action->logHistory($actionID,common::createChanges($sampleout, $data));
                        }
                    }
                    $this->dao->update('zt_sample')->set('inventry')->eq($sample->inventry-$_POST['aqty'][$k])->where('id')->eq($id)->exec();
                    $old=(object)array();
                    $new=(object)array();
                    $old->inventry=$sample->inventry;
                    $new->inventry=$sample->inventry - $_POST['aqty'][$k];
                    $actionID=$this->action->create("sample",$id,"出库:".$_POST['aqty'][$k]." 出库ID：".$v);
                    if(common::createChanges($old, $new))
                    {
                        $this->action->logHistory($actionID,common::createChanges($old, $new));
                    }
                }
            }
            echo js::alert("Success");
            die(js::locate($this->inlink('out'),'parent'));

        }
        $this->view->outs=$this->sampleout->batchuhuo($outids);
        $this->display();
    }
    //打印
    public function batchPrint()
    {
        header("content-type:text/html;charset=utf8");
        if (isset($_GET['address']))
        {
			$region="HZ";
            if ($region == 'all') $region = '';
            //查询数据
            $data = $this->dao->select("`tocompany`,`toperson`,`tomobile`,`toaddress`")
                ->from('zt_out')->where("`id`")->in($_POST['id'])
                ->beginIF($region)
                ->andwhere('region')->eq($region)
                ->fi()
                ->orderBy($this->session->exportsampleoutorderby)
                ->fetchAll();
            if(!$data) die(js::error('object not exist'));
            //声明一个标示
            $tem = false;
            //判断data数组不是全部为空
            for ($i=0; $i < count($data) ; $i++) {
                if (!empty($data[$i]->tocompany) and !empty($data[$i]->toperson) and !empty($data[$i]->tomobile) and !empty($data[$i]->toaddress)) {
                    $tem = true; //只要有一条合理的数据即合理
                }
            }
            //如无数据符合要求 中止表格的导出
            if (!$tem) {
                echo js::alert("收货信息不完整,请先去完善收货信息!");
                die(js::locate($this->inlink('out'),'parent')); //重定向到申请记录首页
            }
            //加载PHPExcel插件
            include "../../lib/PHPExcel/PHPExcel.php";
            include "../../lib/PHPExcel/PHPExcel/IOFactory.php";
            //自定义模版
            $pathfile="./print.xls";
            $ob=PHPExcel_IOFactory::load($pathfile);
            $ob->setActiveSheetIndex(0);
            $date = date('m-d',time()); // 获取当天时间 m-d
            $a = explode('-', $date);
            $a[0] .= '月';
            $a[1] .= '日';
            $date= implode($a, '');
            $row = 4;
            for ($i=0; $i < count($data) ; $i++) {
                if (empty($data[$i]->tocompany) or empty($data[$i]->toperson) or empty($data[$i]->tomobile) or empty($data[$i]->toaddress))
                {
                    continue;//跳过不符合条件的数据
                } else {
                    //将合理数据写入表格中
                    $ob->getActiveSheet()->setCellValue("B$row",$data[$i]->tocompany)
                        ->setCellValue("C$row",$data[$i]->toperson)
                        ->setCellValue("D$row",$data[$i]->tomobile)
                        ->setCellValue("E$row",$data[$i]->tomobile)
                        ->setCellValue("F$row",$data[$i]->toaddress)
                        ->setCellValue("G$row",'寄付月结')
                        ->setCellValue("H$row",'5711222699')
                        ->setCellValue("I$row",'芯片')
                        ->setCellValue("J$row",'芯片')
                        ->setCellValue("L$row",'1')
                        ->setCellValue("M$row",'1')
                        ->setCellValue("N$row",'1')
                        ->setCellValue("O$row",'1')
                        ->setCellValue("P$row",'顺丰次日')
                        ->setCellValue("AP$row",'Holly')
                        ->setCellValue("AQ$row",$date)
                    ;
                    $row++;
                }
            }

            // $ob->getActiveSheet()->duplicateStyle($style,"A4:T".$row);//从指定的单元格复制样式信息
            $ob->getActiveSheet()->setTitle('地址表');
            if(PATH_SEPARATOR!=":"){$filename="顺丰地址.xls";}else{$filename=iconv("UTF8", auto, "顺丰地址").".xls";}
            ob_end_clean();//清除缓冲区,避免乱码
            header("Content-type:application/vnd.ms-excel");
            header("Content-Disposition:attachment;filename=$filename");
            header("Cache-Control:max-age=0");
            $wob=PHPExcel_IOFactory::createWriter($ob,"Excel5");
            $wob->save('php://output');

        } else
        {
            //单条打印 通过get方式
            if ($_GET['id']) {
                $outids = $this->get->id;
            } else {
                //批量打印通过post方式
                $outids=$this->post->sampleid;
                $outids=explode(",",$outids);
                $outids=array_unique($outids);
                unset($outids[0]);
            }
            //加载打印详情页面
            $this->view->outs=$this->sampleout->batchuhuo($outids);
            $this->display();
        }

    }
    public function batchuhuoofdemo()
    {
        header("content-type:text/html;charset=utf8");
        $outids=$this->post->sampleid;
        $outids=explode(",",$outids);
        $outids=array_unique($outids);
        unset($outids[0]);
        if(!empty($_POST['id']))
        {
            $shiporder="";
            foreach($_POST['id'] as $k=>$v)
            {
                $data=array();
                if(empty($_POST['shiporder'][$k]))continue;
                if($_POST['shiporder'][$k]=='同上' and !empty($shiporder))
                {
                    $_POST['shiporder'][$k]=$shiporder;
                }
                else
                {
                    if($_POST['shiporder'][$k]!='同上'){$shiporder=$_POST['shiporder'][$k];}
                }
                $data['person']=$_POST['person'][$k];$data['rdate']=$_POST['rdate'][$k];$data['remark']=$_POST['remark'][$k];$data['rtype']=$_POST['rtype'][$k];$data['partn']=$_POST['partn'][$k];$data['endname']=$_POST['endname'][$k];
                $data['distributor']=$_POST['distributor'][$k];$data['projectname']=$_POST['projectname'][$k];$data['stage']=$_POST['stage'][$k];$data['qty']=$_POST['qty'][$k];$data['aqty']=$_POST['aqty'][$k];$data['price']=$_POST['price'][$k];
                $data['rev']=$_POST['aqty'][$k] * $_POST['price'][$k];$data['shiporder']=$_POST['shiporder'][$k];$data['shipdate']=$_POST['shipdate'][$k];$data['area']=$_POST['area'][$k];$data['revtype']=$_POST['revtype'][$k];$data['mid']=0;
                $data['type']=3;$data['close']='done';
                $sampleout=$this->sampleout->getbyid($v);
                $this->dao->update('zt_out')->data($data)->where("id")->eq($v)->exec();
                if(!dao::isError())
                {
                    $actionID=$this->action->create('sampleout',$v,"完成出货");
                    if(common::createChanges($sampleout, $data))
                    {
                        $this->action->logHistory($actionID,common::createChanges($sampleout, $data));
                    }
                }
            }
            echo js::alert("Success");
            die(js::locate($this->inlink('demo'),'parent'));

        }
        $this->view->outs=$this->sampleout->batchuhuoofdemo($outids);
        $this->display();
    }
    public function partnum($part="")
    {
        $partold=$part;
        $part=$this->dao->select("*")->from("zt_partcontrol")->where("part")->eq($part)->fetch();
        if(!empty($_POST))
        {
            if(!empty($_POST['num']) and (int)$_POST["num"] > 0)
            {
                $data=fixer::input('post')
                    ->get();
                if($part->id>0)
                {
                    $this->dao->update("zt_partcontrol")->data($data)->autoCheck()->where('id')->eq($part->id)->exec();
                    if(common::createChanges($part,$data))
                    {
                        $actionID=$this->action->create("wareline",$part->id,"编辑");
                        $this->action->logHistory($actionID,common::createChanges($part, $data));
                    }
                }
                else
                {
                    $this->dao->insert("zt_partcontrol")->set('part')->eq($partold)->set('num')->eq($_POST['num'])->autoCheck()->exec();
                    $id=$this->dao->lastInsertId();
                    if($id)
                    {
                        $this->action->create("wareline",$id,"设置了库存警戒线");
                    }
                }
                echo "<script type='text/javascript'>parent.location.reload();</script>";

            }
            else
            {
                echo js::alert("警戒库存数量必须为不为空并且大于零的整数");
            }
        }
        $this->view->part=$part;
        $this->view->actions=$this->action->getList("wareline",$part->id);
        $this->display();
    }
    public function wareline()
    {
        $allpart=$this->loadModel('api')->getallpart();
        $a=str_replace(array("\r\n", "\r", "\n"),"",join(",",$allpart));
        $this->view->allpart=split(",",$a);
        $this->display();
    }
    public function ajaxpartnum()
    {
        $part=$_POST['part'];
        $num=$this->dao->select("*")->from("zt_partcontrol")->where("part")->eq($part)->fetch('num');
        echo json_encode(array('re'=>$num));
    }
    public function getallwareline()
    {

    }
    public function test()
    {
        $this->sampleout->getspecialpart();
    }
    public function importuser16to08()
    {
        $pdo = new PDO("mysql:dbname=insidesales;host=192.168.5.16;charset=utf8",'root','Silergy13');
        $sql="select * from `zt_user` where deleted='0' and account in(select account from `zt_usergroup` where `group` not in(1,8,23,29,30,32,33,38,39,41,46,52,55,57,59,60))";
        $result=$pdo->query($sql);
        $result=$result->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $k=>$v)
        {
            if($v['address']=='SCN'){$v['address']='SC';}if($v['address']=='In'){$v['address']='India';}
            if($v['address']=='NCN'){$v['address']='NC';}if($v['address']=='JP'){$v['address']='Japan';}
            //$v['password']=md5("silergy2017");
            $exists=$this->dao->select('id')->from("zt_user")->where('account')->eq($v['account'])->fetch("id");
            if($exists>0)
            {
                if(in_array($v['account'],array("admin","chenqin","huangli","silergyapi","opp")))continue;
                $this->dao->update("zt_user")
                    ->set('password')->eq($v['password'])
                    ->set('realname')->eq($v['realname'])
                    ->set('email')->eq($v['email'])
                    ->set('address')->eq($v['address'])
                    ->where("account")->eq($v['account'])
                    ->exec();
            }
            else
            {

                $this->dao->insert("zt_user")
                    ->set('account')->eq($v['account'])
                    ->set('password')->eq($v['password'])
                    ->set('realname')->eq($v['realname'])
                    ->set('email')->eq($v['email'])
                    ->set('address')->eq($v['address'])
                    ->exec();
            }

        }
    }
    public function exportoutbypart()
    {
        $re=array();
        $samplepart=$this->dao->select("partn")->from("zt_out")->where("rdate")->like("2018-02%")->orWhere('rdate')->like("2018-03%")->orWhere("rdate")->like("2018-01%")->fetchPairs("partn","partn");
        $array=array("SC","NC","TW");
        foreach($array as $vv)
        {
            foreach($samplepart as $v)
            {
                $m1=$this->dao->select("aqty")->from("zt_out")->where("rdate")->like("2018-01%")->andWhere("partn")->eq($v)->andWhere('close')->eq('done')->andWhere("area")->eq($vv)->andWhere('rtype')->like("%sample%")->fetchAll();
                $m1sum=$this->dao->select("sum(aqty) as sum")->from("zt_out")->where("rdate")->like("2018-01%")->andWhere("partn")->eq($v)->andWhere('close')->eq('done')->andWhere("area")->eq($vv)->andWhere('rtype')->like("%sample%")->fetch();
                $m2=$this->dao->select("aqty")->from("zt_out")->where("rdate")->like("2018-02%")->andWhere("partn")->eq($v)->andWhere('close')->eq('done')->andWhere("area")->eq($vv)->andWhere('rtype')->like("%sample%")->fetchAll();
                $m2sum=$this->dao->select("sum(aqty) as sum")->from("zt_out")->where("rdate")->like("2018-02%")->andWhere("partn")->eq($v)->andWhere('close')->eq('done')->andWhere("area")->eq($vv)->andWhere('rtype')->like("%sample%")->fetch();
                $m3=$this->dao->select("aqty")->from("zt_out")->where("rdate")->like("2018-03%")->andWhere("partn")->eq($v)->andWhere('close')->eq('done')->andWhere("area")->eq($vv)->andWhere('rtype')->like("%sample%")->fetchAll();
                $m3sum=$this->dao->select("sum(aqty) as sum")->from("zt_out")->where("rdate")->like("2018-03%")->andWhere("partn")->eq($v)->andWhere('close')->eq('done')->andWhere("area")->eq($vv)->andWhere('rtype')->like("%sample%")->fetch();
                if(empty($m2) and empty($m1) and empty($m3))continue;
                $re[$vv][strtoupper($v)]['m1k']=$m1sum->sum;
                $re[$vv][strtoupper($v)]['m1c']=count($m1);
                $re[$vv][strtoupper($v)]['m2k']=$m2sum->sum;
                $re[$vv][strtoupper($v)]['m2c']=count($m2);
                $re[$vv][strtoupper($v)]['m3k']=$m3sum->sum;
                $re[$vv][strtoupper($v)]['m3c']=count($m3);
            }
        }
        include "../../lib/PHPExcel/PHPExcel.php";
        include "../../lib/PHPExcel/PHPExcel/IOFactory.php";
        $ob=new PHPExcel();
        $one=0;
        foreach($re as $k=>$vv)
        {
            $ob->setActiveSheetIndex($one);
            $ob->createSheet();
            $ob->getActiveSheet()->getDefaultStyle()->getFont()->setName('Times New Roman');
            $ob->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
            $ob->getActiveSheet()->setCellValue("A1","Partnumber")
                ->setCellValue("B1","201801(sum)")
                ->setCellValue("C1","201801(qty)")
                ->setCellValue("D1","201802(sum)")
                ->setCellValue("E1","201802(qty)")
                ->setCellValue("F1","201803(sum)")
                ->setCellValue("G1","201803(qty)")
            ;
            /* set borders*/
            $ob->getActiveSheet()->getStyle("A1")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $ob->getActiveSheet()->getStyle("A1")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $ob->getActiveSheet()->getStyle("A1")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $ob->getActiveSheet()->getStyle("A1")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $ob->getActiveSheet()->getStyle("A1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $ob->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $row=2;
            foreach($vv as $kk=>$v)
            {
                $ob->getActiveSheet()->setCellValue("A$row",$kk)->setCellValue("B$row",$v['m1c'])
                    ->setCellValue("C$row",$v['m1k'])
                    ->setCellValue("D$row",$v['m2c'])
                    ->setCellValue("E$row",$v['m2k'])
                    ->setCellValue("F$row",$v['m3c'])
                    ->setCellValue("G$row",$v['m3k'])
                ;
                $row++;
            }
            $ob->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);$ob->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
            $ob->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);$ob->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
            $ob->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);$ob->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
            $ob->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
            $ob->getActiveSheet()->freezePane('A2');
            $ob->getActiveSheet()->setTitle($k);
            /* copy style*/
            $ob->getActiveSheet()->duplicateStyle($ob->getActiveSheet()->getStyle("A1"),"A1:G$row");
            $one++;
        }
        $ob->setActiveSheetIndex(0);
        $wob=PHPExcel_IOFactory::createWriter($ob,"Excel2007");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=sampleout1_2_3data'.'.xlsx');
        header('Cache-Control: max-age=0');
        $wob->save('php://output');
        exit;
    }

    public function sendWarnlineToAE(){
        $wareQtyDefault = array('P1' =>200,'P2' => 200,'P3' => 500,'P4' => 500);
        $sample_data = $this->dao->select('if(`status`= "","P1",`status`) as `status`,SUBSTRING(device,3) as dev,device,inventry,"sample" as type')->from('zt_sample')->where('deleted')->eq('0')->andWhere('note')->like('%1%')->get();
        $mp_data = $this->dao->select('"P1" as `status`,SUBSTRING(device,3) as dev,device,qty,"mp" as type')->from('zt_mp')->where('deleted')->eq('0')->andWhere('zt_mp.status')->eq('可送')->andWhere('no')->ne('无(非常规料号)')->get();
        $data = $this->dao->select('a.`status`, a.dev,a.device,sum(a.inventry) as qty,a.type')->from("({$sample_data} UNION $mp_data) as a")->groupby('dev')->fetchAll('dev');
        $ware_data = array(); //低于警戒数量的值;
        if($data){
            foreach ($data as $k =>$v){
                $wareqty = $this->dao->select('max(num) as num')->from('zt_partcontrol')->where('num')->gt(0)->andWhere('SUBSTRING(part,3)')->eq($k)->fetch('num');
                if(empty($wareqty)){
                    $wareqty = $wareQtyDefault[$v->status];
                }
                if($v->qty < $wareqty){
                    $ware_data[$k] = $v;
                    $ware_data[$k]->wareqty = $wareqty;
                    $parn_num = $this->dao->select("*,concat(`type`,'-',`device`) as partn_detail")->from("({$sample_data} UNION $mp_data) as a")->where('dev')->eq($k)->fetchAll('partn_detail');
                    $ware_data[$k]->parn_detail = implode('/',array_keys($parn_num));
                }

            }
        }

        $str="<table cellspacing='0' border='1'><tr><td>partn</td><td>库存数量</td><td>警戒数量</td></tr>";
        foreach ($ware_data as $k => $v){
            $str.="<tr><td>$v->parn_detail</td><td>$v->qty</td><td>$v->wareqty</td>></tr>";
        }
        $str.="</table>";
        echo $str;die;
//        $toarr=$this->loadModel("group")->getUserPairs(13);
//        $tostr=implode(",",array_keys($toarr));
//        if($outs){$this->loadModel('mail')->send($tostr,date("Y-m-d")."当天".date("H:i:s")."前的Demo产品申请",$str,'admin,huangli',true);}

    }


}