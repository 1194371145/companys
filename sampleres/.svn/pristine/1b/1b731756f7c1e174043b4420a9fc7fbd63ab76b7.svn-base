<?php
/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: control.php 2657 2012-02-23 01:46:06Z shiyangyangwork@yahoo.cn $
 * @link        http://www.zentao.net
 */
class sampleapp extends control
{      
      //生成不同地区的数组集合
      //admin
      private $super = array('admin','lynn');
      //TW
      private $TW = array('saviny','tim');
      //NC
      private $NC = array('henry');
      //SC
      private $SC = array('anna','torch');
      //Japan
      private $Japan = array('hasegawa');
	  //US
      private $US = array('reffert','craig');
      //demo 组的成员
      private $Demo = array('chenfuyong','louhanglei','houshaohai','liaojianfeng','SH1_DEMO','SH2_DEMO','weihuiyou','xianteam','xiamenteam');

      private $mppart=array();
      private $allmppart=array();
	  private $insidesales=array('user'=>'root',"password"=>"Silergy13","host"=>"192.168.5.16");
    public function __construct()
    {
        parent::__construct();
		$this->app->setClientLang("zh-cn");
		$this->app->loadLang('sampleout');
		$this->app->setClientLang("en");
    }

    //自定义pdo对象
    public function pdo($dbname)
    {
        $pdo = new PDO("mysql:dbname=$dbname;host=".$this->insidesales['host'].";charset=utf8",$this->insidesales['user'],$this->insidesales['password']);
        return $pdo;
    }
    //Sample List 列表
    /**
    * $type    判断是否通过搜索查询
    * $excel   判断是否是导出数据,是否需要渲染view输出
    */

    function getsamplelist($type='normal',$excel='',$param = 0,$recTotal = 0, $recPerPage = 30, $pageID = 1,$orderBy='id_desc')
    {
        $name = $this->app->user->account;
        if (in_array($name, $this->super)) {
            $area = 'all'; //查看所有
        } elseif (in_array($name, $this->TW)) {
            $area = 'TW';
        } elseif (in_array($name, $this->NC)) {
            $area = 'NC';
        } elseif (in_array($name, $this->SC)) {
            $area = 'SC';
        } elseif (in_array($name, $this->Japan)) {
            $area = 'Japan';
        } elseif(in_array($name, $this->US))
		{
			$area = 'US';
		}
		else	
		{
            $area = 'self';//仅限查看自己
        }

        /* 加载分页类，并生成pager对象。*/
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
        //全部列表
        if ($type == 'normal') {
            $where = '1 = 1'; //无搜索条件时的where    
        }
        //通过search会生成一个where条件
        if ($type == 'search') {
            if ($this->session->sampleappQuery) 
            {
                $where = '1 = 1 and' .$this->session->sampleappQuery;//从session中获取where条件
            }else{
                $where = '1 = 1'; //无搜索条件时的where    
            }
        }
        /** 将参数传给model，进行处理
         * @where    查询条件
         * @pager    分页参数
         * @orderBy  排序
         * @area     所属区域
         * @name     登录人的account名
         */
        
        if ($excel == 'export') 
        {
            return $this->sampleapp->getlist($where,$pager='',$orderBy,$area,$name,$region); //如果是导出数据,直接返回结果集无需渲染输出
        } else {
            /* 赋值到模板。*/
            $users = $this->sampleapp->getlist($where,$pager,$orderBy,$area,$name,$region);
            $this->config->sampleapp->sample->search['actionURL']=$this->createLink('sampleapp','getsamplelist',"type=search");//搜索的url
            $this->view->samplelist=$users;
            $this->view->pager = $pager;
            $this->view->searchForm  = $this->fetch('search', 'buildForm', $this->config->sampleapp->sample->search); //搜索
            $this->view->orderBy=$orderBy;
            $this->view->type=$type;
            $this->view->param=$param;
            $this->view->title='Sample List';
            $this->display();
        }

    }


    //demolist列表页
    /**
    * $type    判断是否通过搜索查询
    * $excel   判断是否是导出数据,是否需要渲染view输出
    */
    public function demolist($type='normal',$excel='',$param = 0,$recTotal = 0, $recPerPage = 30, $pageID = 1,$orderBy='id_desc')
    {
        $name = $this->app->user->account;
        if(in_array($name, $this->super) or array_intersect(array(13,22,3),$this->app->user->groups))
		{
            $area = 'all';//可以看到所以的申请
        }
		elseif(in_array($name, $this->TW))
		{
            $area = 'TW';
        }
		elseif(in_array($name, $this->NC))
		{
            $area = 'NC';
        }
		elseif(in_array($name, $this->SC))
		{
            $area = 'SC';
        }
		elseif(in_array($name, $this->Japan))
		{
            $area = 'Japan';
        }
	    else
		{
            $area = 'self';//仅仅只能查看自己的申请
        }

        /* 加载分页类，并生成pager对象。*/
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
        //全部列表
        if($type == 'normal')
		{
            $where = '`rtype` like "%demo%"'; //无搜索条件时的where    
        }
        //通过search会生成一个where条件
        if($type == 'search')
		{
            if($this->session->sampleappQuery) 
            {
                $where = '`rtype` like "%demo%" and'.$this->session->sampleappQuery;//从session中获取where条件
            }
			else
			{
                $where = '`rtype` like "%demo%"'; //无搜索条件时的where
            }
        }
        /** 将参数传给model，进行处理
         * @where    查询条件
         * @pager    分页参数
         * @orderBy  排序
         * @area     所属区域
         * @name     登录人的account名
         */
        if ($excel == 'export') 
        {
            return $this->sampleapp->demoList($where,$pager='',$orderBy,$area,$name); //如果是导出数据直接return结果集
        }
		else
		{
            $users = $this->sampleapp->demoList($where,$pager,$orderBy,$area,$name);
            /* 赋值到模板。*/
            $this->config->sampleapp->demo->search['actionURL']=$this->createLink('sampleapp','demolist',"type=search");//搜索的url
            $this->view->samplelist=$users;
            $this->view->pager = $pager;
            $this->view->searchForm  = $this->fetch('search', 'buildForm', $this->config->sampleapp->demo->search); //搜索
            $this->view->orderBy=$orderBy;
            $this->view->type=$type;
            $this->view->param=$param;
            $this->view->title='Demo List';
            $this->display();
        }
    }


    //exportdatasample    samplelist导出excel表数据方法 
    public function exportdatasample($type='re')
    {
        if($type =='re')
        {
            $re = $this->getsamplelist($type ='search',$excel ='export'); //调用getsamplelist方法,返回符合条件的结果集
        }
        if($type =='All')
        {
            $re = $this->getsamplelist($type ='normal',$excel ='export');
        }

        // $re = $this->sampleapp->getExport($data); //得到数据
        require_once '../../lib/PHPExcel/PHPExcel.php';
        require_once '../../lib/PHPExcel/PHPExcel/IOFactory.php';
        $pathfile="./sample.xls";
        $ob=PHPExcel_IOFactory::load($pathfile);
        $ob->setActiveSheetIndex(0);
        $style=$ob->getActiveSheet()->getStyle('B4');
        $row=4;
        for ($i=0; $i < count($re); $i++) 
        {
            $ob->getActiveSheet()->setCellValue("A$row",$re[$i]->person)
                                 ->setCellValue("B$row",$re[$i]->rdate)
                                 ->setCellValue("C$row",$re[$i]->rf)
                                 ->setCellValue("D$row",$re[$i]->rtype)
                                 ->setCellValue("E$row",$re[$i]->partn)
                                 ->setCellValue("F$row",$re[$i]->package)
                                 ->setCellValue("G$row",$re[$i]->endname)
                                 ->setCellValue("H$row",$re[$i]->distributor)
                                 ->setCellValue("I$row",$re[$i]->projectname)
                                 ->setCellValue("J$row",$re[$i]->stage)
                                 ->setCellValue("K$row",$re[$i]->qty)
                                 ->setCellValue("L$row",$re[$i]->aqty)
                                 ->setCellValue("M$row",$re[$i]->price)
                                 ->setCellValue("N$row",$re[$i]->rev)
                                 ->setCellValue("O$row",$re[$i]->shiporder)
                                 ->setCellValue("P$row",$re[$i]->shipdate)
                                 ->setCellValue("Q$row",$re[$i]->remark)
                                 ->setCellValue("R$row",$re[$i]->area)
                                 ->setCellValue("S$row",$re[$i]->revtype)
                                 ;
                                 $row++;
        }
        $ob->getActiveSheet()->duplicateStyle($style,"A4:T".$row);
        $ob->getActiveSheet()->setTitle('SampleList');
        $wob=PHPExcel_IOFactory::createWriter($ob,"Excel5");
        if(PATH_SEPARATOR!=":"){$filename="SampleList.xls";}else{$filename=iconv("UTF8", auto, "SampleList").".xls";}
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=$filename");
        header("Cache-Control:max-age=0");
        $wob->save('php://output');
    }

    //exportdatademo    demolist导出excel表数据方法 
    public function exportdatademo($type='re')
    {
        if($type =='re') 
        {
            $re = $this->demolist($type ='search',$excel ='export'); //调用demolist方法,返回符合条件的结果集
        }
        if($type =='All')
        {
            $re = $this->demolist($type ='normal',$excel ='export');

        }
        require_once '../../lib/PHPExcel/PHPExcel.php';
        require_once '../../lib/PHPExcel/PHPExcel/IOFactory.php';
        $pathfile="./sample.xls";
        $ob=PHPExcel_IOFactory::load($pathfile);
        $ob->setActiveSheetIndex(0);
        $style=$ob->getActiveSheet()->getStyle('B4');
        $row=4;
        for ($i=0; $i < count($re); $i++) 
        {
            $ob->getActiveSheet()->setCellValue("A$row",$re[$i]->person)
                                 ->setCellValue("B$row",$re[$i]->rdate)
                                 ->setCellValue("C$row",$re[$i]->rf)
                                 ->setCellValue("D$row",$re[$i]->rtype)
                                 ->setCellValue("E$row",$re[$i]->partn)
                                 ->setCellValue("F$row",$re[$i]->package)
                                 ->setCellValue("G$row",$re[$i]->endname)
                                 ->setCellValue("H$row",$re[$i]->distributor)
                                 ->setCellValue("I$row",$re[$i]->projectname)
                                 ->setCellValue("J$row",$re[$i]->stage)
                                 ->setCellValue("K$row",$re[$i]->qty)
                                 ->setCellValue("L$row",$re[$i]->aqty)
                                 ->setCellValue("M$row",$re[$i]->price)
                                 ->setCellValue("N$row",$re[$i]->rev)
                                 ->setCellValue("O$row",$re[$i]->shiporder)
                                 ->setCellValue("P$row",$re[$i]->shipdate)
                                 ->setCellValue("Q$row",$re[$i]->remark)
                                 ->setCellValue("R$row",$re[$i]->area)
                                 ->setCellValue("S$row",$re[$i]->revtype)
                                 ;
                                 $row++;
        }
        $ob->getActiveSheet()->duplicateStyle($style,"A4:T".$row);
        $ob->getActiveSheet()->setTitle('SampleList');
        $wob=PHPExcel_IOFactory::createWriter($ob,"Excel5");
        if(PATH_SEPARATOR!=":"){$filename="SampleList.xls";}else{$filename=iconv("UTF8", auto, "SampleList").".xls";}
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=$filename");
        header("Cache-Control:max-age=0");
        $wob->save('php://output');
    }

    //单条数据的详情页
    public function getsample($id)
    {

        $data = $this->dao->select("*")->from('zt_out')->where('id')->eq($id)->fetch();
        if(!$data){
            echo js::error('object not existl');
            exit(js::locate('back','parent'));
        }
       $this->view->sample = $data;
       $this->view->title = 'View';
       $this->view->actions = $this->loadModel("action")->getList("sampleout",$id);
       $this->display();

    }


    //Sample Template 导出sampleout模版
    public function Sampletmp()
    {
        $file_dir = './';
        $file_name ="sampleout.xls";
        $kuozhan=strrchr($file_name,".");
        $file = fopen($file_dir . $file_name,"r"); 
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($file_dir . $file_name));
        Header("Content-Disposition: attachment; filename=" . "sample".$kuozhan);
        
        echo fread($file,filesize($file_dir . $file_name));
        fclose($file);
        exit();
    }


    //Import Sample 导入sample模版
    public function importout()
    {
        header("content-type:text/html;charset=utf8");
        $name = $this->app->user->account;//得到登录人的用户名
        $myAddress = $this->dao->select('address')->from('zt_user')->where('account')->eq($name)->fetch();
        if ($myAddress->address) {
            $address = $myAddress->address;
        } else {
            $address = '';
        }
        $this->getmppartall();   //调用此方法 ,填充mppart 和 allmppart 数组
		$notpart=$this->loadModel("sampleout")->notpart;
        if(!empty($_FILES['file']))
        {
            if($_FILES['file']['tmp_name'])
            {
                include '../../lib/PHPExcel/PHPExcel.php';
                include "../../lib/PHPExcel/PHPExcel/IOFactory.php";
                $ob=PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);
                $sheetob=$ob->setActiveSheetIndex();
                $A13=trim($ob->getActiveSheet()->getCell("A13")->getValue());
                $B13=trim($ob->getActiveSheet()->getCell("B13")->getValue());
                $C13=trim($ob->getActiveSheet()->getCell("C13")->getValue());
                $N13=trim($ob->getActiveSheet()->getCell("N13")->getValue());
                if($A13!='Request Type' or $B13!='Part Number' or $C13!='Package Type' ){die(js::error("Please correct files"));}
                if(empty($N13))die(js::error("Please re download the template has been updated"));
                $fields=array(
                        "A"=>"rtype","B"=>"partn",
                        "C"=>"package","D"=>'endname',
                        "E"=>"projectname","F"=>"stage",
                        "G"=>'qty',"I"=>"remark","H"=>"set",
                        "J"=>"person","K"=>"distributor",
                        "L"=>"price","M"=>"rev","N"=>"revtype","O"=>"tocompany",
                        "P"=>"toperson","Q"=>"tomobile","R"=>"toaddress","S"=>"mailpay",
                        );
                $repeat=0;
                $success=0;
                $invalid=0;
                $invalidstr ="";
                $part=0;
                $partstr="";
                $dis=0;
                $disstr="";
                $str="";
                $price=0;
                $pricestr="";
                $complete=0;
                $completestr="";
                $myNum=0;      //统计本月免费申请次数超过四次的
                $myPartn="";               
                $i = 0; //声明一个变量
                $row = 14;                
                while ($partnumber = trim($ob->getActiveSheet()->getCell("B$row")->getValue())) 
                {                       
                    for($col="A";$col<="S";$col++)
                    {
                        $arr[$i][$fields[$col]]=trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
                    }
                    unset($arr[$i]['set']);
                    if(empty($arr[$i]['partn']) or empty($arr[$i]['rtype']))
                        {
                            $invalid++; //统计无效数据
                            $invalidstr.=$row."th,";
                            $row++;
                            continue;
                        }
                    if (!empty($arr[$i]['partn'])) {
                        $arr[$i]['partn'] = trim($arr[$i]['partn']); //如果输入的料号不为空 
                    }

                    if(!in_array($arr[$i]['partn'],$this->allmppart))
                    {
                        $part++;
                        $partstr.=$row."th,";
                        $row++;
                        continue;
                    }
                    if(empty($arr[$i]['tocompany']) or empty($arr[$i]['toperson']) or empty($arr[$i]['tomobile']) or empty($arr[$i]['toaddress']))
                    {
                        $complete++;
                        $completestr.=$row."th,";
                        $row++;
                        continue;
                    }

                    if(strtolower($arr[$i]['revtype'])=='y'){$arr[$i]['revtype']='需要付费';}else{$arr[$i]['revtype']='不需付费';}
                    if(strtolower($arr[$i]['mailpay'])=='r'){$arr[$i]['mailpay']='receiver';}else{$arr[$i]['mailpay']='contract_sender';}

                    $di=$this->checksampledis1($arr[$i]['distributor']); //通过模糊查询得到完整的营销商
                    if($arr[$i]['revtype']=='需要付费' and empty($arr[$i]['distributor']))
                    {
                        $dis++;
                        $disstr.=$row."th,";
                        $row++;
                        continue;
                    }
                    if($arr[$i]['revtype']=='需要付费' and !$di)
                    {
                        $dis++;
                        $disstr.=$row."th,";
                        $row++;
                        continue;
                    }
                    if($arr[$i]['revtype']=='需要付费' and empty($arr[$i]['price']))
                    {
                        $price++;
                        $pricestr.=$row."th,";
                        $row++;
                        continue;
                    }
                    if($arr[$i]['revtype']=='需要付费' and filter_var($arr[$i]['price'],FILTER_VALIDATE_FLOAT)===false)
                    {
                        $price++;
                        $pricestr.=$row."th,";
                        $row++;
                        continue;
                    }
                    if(!empty($arr[$i]['distributor'])){$arr[$i]['distributor'] = $di;}
                    $arr[$i]['rdate']=date("Y-m-d");
                    $arr[$i]['rf']=date("YmdHis");
                    $arr[$i]['shipdate']="0000-00-00";
                    $arr[$i]['area']=$address;
                    $arr[$i]['openby']=$name;
                    $arr[$i]['person']=$name;
                    $arr[$i]['createdate']=date("Y-m-d H:i:s");
                    $arr[$i]['qty']=(int)$arr[$i]['qty'];$arr[$i]['aqty']=(int)$arr[$i]['qty'];$arr[$i]['price']=(float)$arr[$i]['price'];
                    $arr[$i]['rev']=$arr[$i]['aqty'] * $arr[$i]['price'];
					$arr[$i]['mappingfrom']=$notpart[$arr[$i]['partn']];
					if(strpos(strtolower($arr[$i]['rtype']),'demo') === false){$arr[$i]['rtype']='sample';}else{$arr[$i]['rtype']='demo';}

                    if (strpos(strtolower($arr[$i]['rtype']),'demo') === false and strpos("TW,NC,SC,CN",$address) !== false) 
                    {
                        if ($address == "TW") 
                        {
							$TWid=$this->dao->select("id")->from("zt_mp")->where("region")->eq("TW")->andWhere('device')->eq($arr[$i]['partn'])->fetch("id");
                            if (($arr[$i]['qty']>100 and $arr[$i]['revtype']!='需要付费') or ($arr[$i]['qty']>500 and $arr[$i]['revtype']=='需要付费')) 
                            {
                                $arr[$i]['approve'] = '1';  // TW
                                $arr[$i]['rstatus'] = '1';
                            }
							if($TWid>0){$arr[$i]['region']="TW";}
                        } else {
                            if (!in_array($arr[$i]['partn'],$this->mppart)) 
                            {
                                $arr[$i]['approve'] = '3';  // SC NC
                                $arr[$i]['rstatus'] = '3';
                            } else {
                                if (($arr[$i]['qty']>30 and $arr[$i]['revtype']!='需要付费') or ($arr[$i]['qty']>500 and $arr[$i]['revtype']=='需要付费'))
                                {
                                    $arr[$i]['approve'] = '1'; // SC NC
                                    $arr[$i]['rstatus'] = '1';
                                }
                            }
                        }
                    }
					if(strpos(strtolower($arr[$i]['rtype']),'demo') !== false)
					{
						$arr[$i]['demotype']="stardard";
						$proline=$this->dao->select("proline")->from("zt_mp")->where("device")->eq($arr[$i]['partn'])->andWhere("deleted")->eq('0')->fetch("proline");
						$proline=trim($proline);
						if(!$proline)
						{
							$proline=$this->dao->select("proline")->from("zt_sample")->where("device")->eq($arr[$i]['partn'])->andWhere("deleted")->eq('0')->fetch("proline");
							$proline=trim($proline);
							if(!$proline)
							{
								$prorelease=$this->loadModel("mp")->getproductreleasefielddata($arr[$i]['partn']);
								$proline=$prorelease['proline'];
								if(!$proline)
								{
									$demostr.=$arr[$i]['partn'];
								}
							}
						}
						$arr[$i]['proline']=$proline;
						$arr[$i]['ae']=implode(",",$this->lang->sampleout->prolinedemo[$arr[$i]['proline']]);
					}
                    $i++;
                    $row++;
                }

                if ($dis>0 or $part>0 or $price>0 or $complete>0 or $invalid>0) //只要有不符合条件的全部不让写入数据库
                {
                    echo "<div style='border:2px dashed red;padding:13px;color:red;border-radius: 5px;'>";
                    echo "<p style='color:red;font-weight:bold;'>The import file has errors as follows:</p>";
                    if($invalid > 0)
                    {
                        echo "Data rows :<b style='color:red;'>".substr($invalidstr,0,-1)."</b> do not meet the requirements（A,B columns cannot be empty）<br/><br/>";
                    }
                    if($price > 0)
                    {
                        echo "Data rows :<b style='color:red;'>".substr($pricestr,0,-1)."</b> do not meet the requirements（The paid sample ,price must be greater than zero）<br/><br/>";
                    }
                    if($dis > 0)
                    {
                        echo "Data rows :<b style='color:red;'>".substr($disstr,0,-1)."</b> do not meet the requirements（The paid sample ,the agent must be the standard agent name in ERP）<br/><br/>";
                    }
                    if($complete > 0)
                    {
                        echo "Data rows :<b style='color:red;'>".substr($completestr,0,-1)."</b> do not meet the requirements（Receipt company, Consignee,Contact number,Detailed Address not empty）<br/><br/>";
                    }
                    if($part > 0)
                    {
                        echo "Data rows :<b style='color:red;'>".substr($partstr,0,-1)."</b> do not meet the requirements（The name of the part must be standard and allowed to be applied）<br/><br/>";
                    }
                    echo "</div>";                   
                }
				else
				{
                    for ($i=0; $i < count($arr); $i++) 
                    { 
                        if ($arr[$i]['revtype']=='不需付费' and strpos(strtolower($arr[$i]['rtype']),'demo') === false) 
                        {
                            $date = date('Y-m').'-'.'01'; //得到该月一号 Y-m-01
                            $time = date('Y-m-d');  //得到当天时间  Y-m-d
                            $result = $this->dao->select('partn')
                                                ->from('zt_out')
                                                ->where('partn')->eq($arr[$i]['partn'])
                                                ->andwhere('person')->eq($this->app->user->account)
                                                ->andwhere('revtype')->eq('不需付费')
                                                ->andwhere('rdate')->ge($date)
                                                ->andwhere('rdate')->le($time)
                                                ->andwhere('rtype')->in('Samples,sample')
                                                ->fetchAll(); 
                            $num = count($result); //如果不需要收费 统计该样品本月申请的数量
                            if($num > 4 and $this->app->user->account!='saviny') 
                            {
                                $myPartn .= ($arr[$i]['partn'].' '); //得到本月超过4次的料号
                                $myNum ++;
                                continue;
                            } 
                        }
                        $re = $this->sampleapp->importout($arr[$i]); //执行将数据写入数据库操作                      
                        if($re['re']=='success')
                        {
                            $success++; //成功条数
                            continue;
                        }
                        elseif($re['re']=='repeat') 
                        {
                            $repeat++; //重复条数
                            continue;
                        }
                        else 
                        {
                            $invalid++; //无效条数
                            continue;
                        }
                    }// END FOR
					if(!empty($demostr))
					{
						$str="DEMO申请：料号：<b style='color:red;'>".$demostr."</b>无产线和AE信息，请及时在prorelease系统维护！！";
						$tolist=implode(",",array_keys($this->loadModel('group')->getUserPairs("21")));
						$tocc=implode(",",array_keys($this->loadModel('group')->getUserPairs("22")));
						$this->loadModel("mail")->send($tolist,"需维护产线和AE信息",$str,$tocc.",admin",true);
					}
                    if ($myNum > 0) 
                    {
                        echo "<script type='text/javascript'>alert('Success: $success"." records \\n Repeat：$repeat"." records\\n The partnumber：$myPartn"." \\n Free applications have been made more than four times this month : $myNum "."recodes');parent.location.reload();</script>";
                    }
					else
					{ 
                        echo "<script type='text/javascript'>alert('Success: $success"." records \\n Repeat：$repeat"." records');parent.location.reload();</script>";
                    }
                }
          
            }
            else
            {
                echo js::alert("请选择文件");
            }
        }
        $this->display();

    }


    //从zt_wgcdis 表中返回一个一维数组 得到营销商
    public function checksampledis1($dis)
    {
        $pdo = $this->pdo('insidesales');//得到pdo对象
        //准备sql语句
        $sql = 'SELECT `cardcode`,`cardname` FROM `zt_wgcdis` WHERE `cardcode` NOT LIKE "V%" and `cardname` like "%'.$dis.'%"';
        $result = $pdo->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
		$data['cardname']=trim($data['cardname']);
        return $data['cardname'];
    }


    //Sample Application 样品申请页面
    public function createout()
    {
        header("content-type:text/html;charset=utf8;");
        $name = $this->app->user->account;
        $myAddress = $this->dao->select('address')->from('zt_user')->where('account')->eq($name)->fetch();
        if ($myAddress->address) {
            $address = $myAddress->address;
        }else{
            $address = '';
        }

        $this->view->address=$address;
        $this->view->title='Sample Application';
		$this->view->name=$name;
        $this->getmppartall(); 
        if(!empty($_POST))
        {
            if(filter_var($_POST['qty'],FILTER_VALIDATE_FLOAT) === false or $_POST['qty'] <= 0)
            {
                die(js::error("Quantity must greater than 0"));
            }
            if(filter_var($_POST['price'],FILTER_VALIDATE_FLOAT) === false)
            {
                die(js::error("price must numberic"));
            }
            $part = trim($_POST['partn']);
            if(empty($part)){die(js::error('partn not empty'));}
			$notpart=$this->loadModel("sampleout")->notpart;
			$_POST['mappingfrom']=$notpart[$_POST['partn']];
            //在NCN 和 SCN 地区的sample申请,超过3年时间的料号 需要审核 approve 状态为3
            //审核 sample样品 大陆 和 TW 区域

            if ($_POST['rtype'] == 'sample' && ($address =='NC' || $address=='SC' || $address == 'TW')) 
            {
                if ($address == 'TW') 
                {
					$TWid=$this->dao->select("id")->from("zt_mp")->where("region")->eq("TW")->andWhere('device')->eq($part)->fetch("id");
                    if (($_POST['qty']>100 and $_POST['revtype'] !='需要付费') || ($_POST['qty']>500 and $_POST['revtype'] =='需要付费')) 
                    {
                        $_POST['approve'] = '1';
                        $_POST['rstatus'] = '1';  // TW 
                    }
					if($TWid>0)
					{
						$_POST['region']="TW";
					}
                }
				else
				{
                    if (!in_array($part, $this->mppart)) 
                    {
                        $_POST['approve'] = '3';
                        $_POST['rstatus'] = '3'; // 
                    }
					else
					{
                        if (($_POST['qty']>30 and $_POST['revtype'] !='需要付费') || ($_POST['qty']>500 and $_POST['revtype'] =='需要付费'))
                        {
                            $_POST['approve'] = '1';
                            $_POST['rstatus'] = '1';  // NC SC 
                        }
                    }
                }
            }
			if($_POST['rtype'] == 'demo')
			{
				if(empty($_POST['demotype'])){die(js::error("Demotype is not empty!!"));}
				if($_POST['demotype']=='customized' and !$_FILES['files']['tmp_name'])
				{
					die(js::error("Customized demo must upload file!!!"));
				}
				$proline=$this->dao->select("proline")->from("zt_mp")->where("device")->eq($part)->andWhere("deleted")->eq('0')->fetch("proline");
				$proline=trim($proline);
				if(!$proline)
				{
					$proline=$this->dao->select("proline")->from("zt_sample")->where("device")->eq($part)->andWhere("deleted")->eq('0')->fetch("proline");
					$proline=trim($proline);
					if(!$proline)
					{
						$prorelease=$this->loadModel("mp")->getproductreleasefielddata($part);
						$proline=$prorelease['proline'];
						if(!$proline)
						{
						$str="DEMO申请：料号：<b style='color:red;'>".$_POST['partn']."</b>无产线和AE信息，请及时在prorelease系统维护！！";
						$tolist=implode(",",array_keys($this->loadModel('group')->getUserPairs("21")));
						$tocc=implode(",",array_keys($this->loadModel('group')->getUserPairs("22")));
						$this->loadModel("mail")->send($tolist,"需维护产线和AE信息",$str,$tocc.",admin",true);
						}
					}
				}
				$_POST['proline']=$proline;
				$_POST['ae']=implode(",",$this->lang->sampleout->prolinedemo[$_POST['proline']]);

				$files=$this->loadModel('file')->getUpload();
				move_uploaded_file($files[0]['tmpname'], $this->file->savePath . $files[0]['pathname']);
				$_POST['demofile']=$files[0]['pathname'];
				$_POST['demofiletitle']=$files[0]['title'];

			}
			else
			{
				unset($_POST['demotype']);
			}


            $tocompany = trim($_POST['tocompany']);
            if(empty($tocompany)){die(js::error('Receipt company not empty'));}
            $toperson=trim($_POST['toperson']);
            if(empty($toperson)){die(js::error('Consignee not empty'));}
            $tomobile=trim($_POST['tomobile']);
            if(empty($tomobile)){die(js::error('Contact number not empty'));}
            $toaddress=trim($_POST['toaddress']);
            if(empty($toaddress)){die(js::error('Detailed Address not empty'));}

            if(!strtotime($_POST['rdate'])){die(js::error("Date format must be 0000-00-00 ."));}
            if($_POST['revtype'] == '需要付费')
            {
                if(empty($_POST['distributor'])){die(js::error("You must select a distributor"));}
                if(empty($_POST['price'])){die(js::error('Price must greater than 0.'));}
            }
		    else
			{
                if($_POST['rtype'] == 'sample')
				{
                    $date = date('Y-m').'-'.'01'; //得到该月一号 Y-m-01
                    $time = date('Y-m-d');  //得到当天时间  Y-m-d

                    $result = $this->dao->select('partn,rdate')
                                        ->from('zt_out')
                                        ->where('partn')->eq($part)
                                        ->andwhere('person')->eq($_POST['person'])
                                        ->andwhere('revtype')->eq('不需付费')
                                        ->andwhere('rdate')->ge($date)
                                        ->andwhere('rdate')->le($time)
                                        ->andwhere('rtype')->in('sample,Samples')
                                        // ->printSQL();
                                        ->fetchAll(); 
                    $num = count($result); //如果不需要收费 统计该样品本月申请的数量
                    if ($num > 4 and $this->app->user->account!='saviny') {die(js::error('The PartNumber has been applied for free more than four times this month! Please pay.'));} //超过四次拒绝申请
                }             
            }
            $_POST['aqty']=$_POST['qty'];
            $_POST['person'] = $_POST['openby'] = $this->app->user->account;
    
			
            $re = $this->sampleapp->createout($_POST); //执行数据库操作
            if($re['re']=='success')
            {
                echo js::alert('Apply success !');
            }
            else 
            {
                echo js::alert(' Failed,please check and apply again !');
                
            }
            die(js::locate($this->inlink('createout'),'parent'));
            
        }
        //视图渲染
		
        $b=str_replace(array("\r\n", "\r", "\n"),"",join(",",$this->allmppart));
        $this->view->autolistall=split(",",$b);//无限制的集合
        $this->view->dis=$this->sampleapp->getDistributorArrsampleofhznj($this->pdo('insidesales'));
        $this->display();
    }

    //getmppart    获取mppart集合
    public function getmppart()
    {   
        $re = $this->sampleapp->getallpartall($this->pdo('insidesales'));
        $this->mppart= $re + $this->lang->sampleapp->sample->specialpart;
    }
    //getmppartall 获取所以的mppart集合
    public function getmppartall()
    {
        $re=$this->sampleapp->getallpart();
        $pdo = $this->pdo('insidesales');
        $sql = 'SELECT partnumber FROM `zt_wgcprorelease` WHERE partnumber LIKE "SY2%" and mappingfrom != "" and deleted = "0"';
		$sql = 'SELECT * FROM `zt_wgcprorelease` WHERE `deleted` = "0" and `status` != "killed"';
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        //声明一个空数组
        $partrelease = array();
        for ($i=0; $i < count($data); $i++) { 
            $partrelease[$data[$i]['partnumber']] = $data[$i]['partnumber'];
        }
        $res=$re + $this->lang->sampleapp->sample->specialpart + $partrelease;
        $this->allmppart = $res;   //将所以的mppart集合存入allmppart数组中   
        $sql = 'SELECT * FROM `zt_wgcprorelease` WHERE `deleted` = "0" and `status` != "killed"';
        $result = $pdo->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        //生成3年前的时间戳   2017-11-14
        $time = strtotime("-3 year",strtotime($this->lang->sampleapp->date));
        //循环比较 unset时间超过3年的和不在part集合中的元素
        for ($i=0; $i < count($data); $i++) 
        {
            if (in_array($data[$i]['partnumber'], $res)) 
            {          
                if (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase4'],$result)) 
                {
                    if ($time > strtotime($result[0]) and !empty($data[$i]['phase4'])) 
                    {
                        unset($res[$data[$i]['partnumber']]);
                    }
                    continue;
                } 
                elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase3'],$result)) 
                {
                    if ($time > strtotime($result[0]) and !empty($data[$i]['phase3'])) 
                    {
                        unset($res[$data[$i]['partnumber']]);                        
                    }
                    continue;
                } 
                elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase2'],$result)) 
                {
                    if ($time > strtotime($result[0]) and !empty($data[$i]['phase2'])) 
                    {
                        unset($res[$data[$i]['partnumber']]);                        
                    }
                    continue;
                } 
                elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase1'],$result)) 
                {
                    if ($time > strtotime($result[0]) and !empty($data[$i]['phase1'])) 
                    {
                        unset($res[$data[$i]['partnumber']]);                       
                    }
                    continue;
                } 
                    
            } 
                   
        }
        $this->mppart = $res; //将查询的数据存入mppart数组中
            
    }

    //demolist 的 editdemo
    function editdemo($id)
    {
        $re=$this->sampleapp->getsample($id);
        $this->view->demo=$re;
        
        if(!empty($_POST))//执行edit操作
        {
            $data['id']=$id;
            $data['shiporder']=$_POST['shiporder'];
            $data['shipdate']=date("Y-m-d");
            $data['close']='done';
			$data['preshipdate']=$_POST["preshipdate"];
            $this->sampleapp->editdemo($data,$re);
            echo "<script type='text/javascript'>parent.parent.location.reload();</script>";
        }
        $this->display();
    }


    //审核 id是需要审核的样品 reason是同意或拒绝的原因 status是用来判断审核是否通过 
    public function audit($id,$status,$reason='')
    {
     if($this->app->user->account == 'lynn')
     {
         if ($status == '1') 
         { 
             $data['approve'] = '2';   // 同意
             $data['salesmanager'] = '2';
             $data['status'] = '2';
         } else {
             $data['salesmanager'] = '1'; // 拒绝
             $data['reason'] = $reason;
             $data['status'] = '1';
         }
     } else {
         if ($status == '1') 
         {
             $data['areamanager'] = '2';   // 同意
             $data['status'] = '2';
         } else {
             $data['areamanager'] = '1';   // 拒绝
             $data['reason'] = $reason;
             $data['status'] = '1';
         }
     }
    
     if (!empty($data)) 
     {
         $result = $this->sampleapp->audit($id,$data);
     }

     $server = $_SERVER['HTTP_REFERER']; 
     die(js::locate($server,'parent'));      
    }


    /**
    *  批量同意
    */
    public function batchaudit()
    {
      if (empty($_POST)) 
      {
          die(js::alert('Please choose at least one record'));
      }
      if ($this->app->user->account == 'lynn') 
      {
        $data['approve'] = '2';   // 同意
        $data['salesmanager'] = '2';
        $data['status'] = '2';
        foreach ($_POST['batchapp'] as $key => $value) 
        {
          $this->sampleapp->audit($value,$data);
        }
      } else {
        $data['areamanager'] = '2';   // 同意
        $data['status'] = '2';
        foreach ($_POST['batchapp'] as $key => $value) 
        {
          $this->sampleapp->audit($value,$data);
        }
      }

      $server = $_SERVER['HTTP_REFERER']; 
      die(js::locate($server,'parent'));
    }

   //获取过去3个月的出货量
   public function getshipmentbypart($part='')
   {
	    $part=trim($part);
        $sessionid=file_get_contents("https://csr.silergycorp.com:8585/index.php?m=api&f=getSessionID&t=json");
        $sessionid=json_decode($sessionid);
        $sessionid=json_decode($sessionid->data);
        $sessionid=$sessionid->sessionID;
        $loginarr=file_get_contents("https://csr.silergycorp.com:8585/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyw2e3&t=json");
        $login=json_decode($loginarr);
        if($login->status=='success')
        {
            $pic=file_get_contents("https://csr.silergycorp.com:8585/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=getshipmentbypart&params=part=$part&t=json");
            $picdata=json_decode($pic);
            $re=json_decode($picdata->data,true);
            echo $re;           //返回出货量 单位 K 
        }
   }

   //获取fcst过去3个月的出货量
   public function getfcstbypart($part='')
   {
	    $part=trim($part);
        $sessionid=file_get_contents("https://csr.silergycorp.com:8585/index.php?m=api&f=getSessionID&t=json");
        $sessionid=json_decode($sessionid);
        $sessionid=json_decode($sessionid->data);
        $sessionid=$sessionid->sessionID;
        $loginarr=file_get_contents("https://csr.silergycorp.com:8585/index.php?sid={$sessionid}&m=user&f=login&account=silergyapi&password=silergyw2e3&t=json");
        $login=json_decode($loginarr);
        if($login->status=='success')
        {
            $pic=file_get_contents("https://csr.silergycorp.com:8585/index.php?&sid={$sessionid}&m=api&f=getModel&module=api&methodName=getfcstbypart&params=part=$part&t=json");
            $picdata=json_decode($pic);
            $re=json_decode($picdata->data,true);
            echo $re;       //返回出货量 单位 K 
        }
   }


   //ajax获取NC 或 SC 三年以外的料号集合
   public function ajaxgetpart($partn)
   {
        $this->getmppartall(); 
        if (in_array($partn, $this->mppart)) 
        {
            echo 1; //在3年集合以内的 无需审核
        } else {
            echo 0; //不在3年集合以内的 需要审核
        }
   }
   public function matchsy2()
   {
		$all=$this->dao->select("*")->from("zt_out")->fetchAll();
		foreach($all as $v)
	    {
			if($v->rtype=='demo' or $v->rtype=='sample')continue;
			if(strpos(strtolower($v->rtype),'demo')===false)
			{
				$rtype='sample';
			}
			else
			{
				$rtype="demo";
			}
			$this->dao->update("zt_out")->set("rtype")->eq($rtype)->where("id")->eq($v->id)->exec(); 
	    }
   }
   public function mappingfrom()
   {
		$all=$this->dao->select("*")->from("zt_out")->where("rtype")->eq('demo')->andWhere('close')->eq('wait')->fetchAll();
		$this->loadModel('sampleout')->getspecialpart();
		$notpart=$this->sampleout->notpart;
		foreach($all as $v)
	    {
			$data=array();
			$v->partn=trim($v->partn);
			$v->ae=trim($v->ae);
			$v->proline=trim($v->proline);
			$v->mappingfrom=trim($v->mappingfrom);
			if($v->ae and $v->proline)continue;
			if(empty($v->mappingfrom) or !$v->mappingfrom){$data['mappingfrom']=$notpart[$v->partn];}
			$proline=$this->dao->select("proline")->from("zt_mp")->where("device")->eq($v->partn)->andWhere("deleted")->eq('0')->fetch("proline");
			$proline=trim($proline);
			if(!$proline or empty($proline))
			{
				$proline=$this->dao->select("proline")->from("zt_sample")->where("device")->eq($v->partn)->andWhere("deleted")->eq('0')->fetch("proline");
				$proline=trim($proline);
				if(!$proline or empty($proline))
				{
					$prorelease=$this->loadModel("mp")->getproductreleasefielddata(trim($v->partn));
					$proline=$prorelease['proline'];
					$proline=trim($proline);
				}
				
			}
			$ae=implode(",",$this->lang->sampleout->prolinedemo[$proline]);
			if(empty($v->proline) or !$v->proline){$data['proline']=$proline;}
			if(empty($v->ae) or !$v->ae){$data['ae']=$ae;}
			
			$this->dao->update("zt_out")->data($data)->where("id")->eq($v->id)->exec(); 
	    }
   }
   public function test123()
	{
	  $mp=$this->loadModel("mp")->getproductreleasefielddata("SY8851BDFC");
	  var_dump($mp);
	}


}
