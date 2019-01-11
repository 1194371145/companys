<?php

class survey extends control
{
    //var $one;
    public function __construct($module = '', $method = '')
    {
        parent::__construct($module, $method);
        $this->loadModel('user');
        $this->loadModel('dept');
        $this->loadModel('mail');
        //$this->my->setMenu();
    }
    
	public function surveylist()
	{
		$this->display();
	}
	public function createsurvey()
	{
		$ty = $this->dao->select('*')->from('zt_survey')->where('staffcode')->eq($this->app->user->account)->andwhere("year")->eq(date("Y"))->fetch();
		if($ty)
		{
		echo js::alert("You cannot repeat to submit the survey as you have done it already.");
	    die(js::locate($this->createLink('my','dynamic'), 'parent'));
		}
			if(!empty($_POST))
			{
				if($this->app->user->local != "杭州")
				{
					$id = $this->survey->createsurvey();
					if(dao::isError()) die(js::error(dao::getError()));
				    $this->loadModel('action')->create('survey', $id, 'createsurvey');
				    echo js::alert('Create successful ');
				    die(js::locate($this->createLink('my','dynamic'), 'parent'));
				}
				else 
				{
					$one= $this->survey->createsurvey();//var_dump($one);die;
					die(js::locate(inlink('thumbup'), 'parent'));
				}
			 $this->survey->createsurvey();
			}
			$this->view->title = "Staff Satisfaction Survey";
		    $this->display();
		
	}
public function thumbup()
	{  
		if(!empty($_POST))
		{
        $ID = $this->survey->thumbup();
        if(dao::isError()) die(js::error(dao::getError()));
	    $this->loadModel('action')->create('survey', $ID, 'createsurvey');
	    echo js::alert('Create successful ');
	    die(js::locate($this->createLink('my','dynamic'), 'parent'));
		}
		$this->display();
	}
	
	public function export()
    {
    	if(!empty($_POST)){
        header("Content-type: text/html; charset=utf-8");
		include"../../lib/PHPExcel/PHPExcel.php";
		include"../../lib/PHPExcel/PHPExcel/IOFactory.php";
		$ob=new PHPExcel();	
	    $get_list = $this->dao->select('*')->from('zt_survey')->where('year')->eq($_POST['circle'])->beginIF(!empty($_POST['user']))->andWhere('staffode')->in($_POST['user'])->fi()->fetchAll();
        foreach($get_list as $kk=>$vv)
        {   $arr[$vv->id][] = $vv;
        	$arr[$vv->id][] = $this->dao->select('*')->from('zt_thumbup')->where('tid')->eq($vv->id)->fetch();
        	$arr[$vv->id][] = $this->dao->select('*')->from('zt_hzblock')->where('xid')->eq($vv->id)->fetch();
        	
        }
        foreach($arr as $k=>$v)
        {
        	//$niming = $this->dao->select('*')->from("zt_user")->where("account")->eq($v[0]->staffcode)->fetch();
        	$data[$k]['id']=$v[0]->id;$data[$k]['staffcode']=$v[0]->staffcode;$data[$k]['year']=$v[0]->year;
        	$data[$k]['silergyyears']=$v[0]->silergyyears;$data[$k]['workyears']=$v[0]->workyears;$data[$k]['val1']=$v[0]->val1;
        	$data[$k]['val2']=$v[0]->val2;$data[$k]['val3']=$v[0]->val3;$data[$k]['val4']=$v[0]->val4;
        	$data[$k]['val5']=$v[0]->val5;$data[$k]['val6']=$v[0]->val6;$data[$k]['val7']=$v[0]->val7;
        	$data[$k]['val8']=$v[0]->val8;$data[$k]['val9']=$v[0]->val9;$data[$k]['val10']=$v[0]->val10;
        	$data[$k]['val11']=$v[0]->val11;$data[$k]['val12']=$v[0]->val12;$data[$k]['val13']=$v[0]->val13;
        	$data[$k]['val14']=$v[0]->val14;$data[$k]['val15']=$v[0]->val15;$data[$k]['val16']=$v[0]->val16;
        	$data[$k]['val17']=$v[0]->val17;$data[$k]['val18']=$v[0]->val18;$data[$k]['val19']=$v[0]->val19;
        	$data[$k]['val20']=$v[0]->val20;$data[$k]['val21']=$v[0]->val21;$data[$k]['val22']=$v[0]->val22;
        	$data[$k]['val23']=$v[0]->val23;$data[$k]['val24']=$v[0]->val24;$data[$k]['val25']=$v[0]->val25;
        	$data[$k]['val26']=$v[0]->val26;$data[$k]['val27']=$v[0]->val27;$data[$k]['val28']=$v[0]->val28;
        	$data[$k]['val29']=$v[0]->val29;$data[$k]['val30']=$v[0]->val30;$data[$k]['val30']=$v[0]->val30;
        	$data[$k]['val31']=$v[0]->val31;$data[$k]['val31']=$v[0]->val31;$data[$k]['val32']=$v[0]->val32;
        	$data[$k]['val33']=$v[0]->val33;$data[$k]['val34']=$v[0]->val34;$data[$k]['val35']=$v[0]->val35;
        	$data[$k]['val36']=$v[0]->val36;
        	
        	$data[$k]['idea1']=$v[0]->idea1;$data[$k]['idea2']=$v[0]->idea2;
        	$data[$k]['idea3']=$v[0]->idea3;$data[$k]['idea4']=$v[0]->idea4;$data[$k]['idea5']=$v[0]->idea5;
        	$data[$k]['idea6']=$v[0]->idea6;$data[$k]['idea7']=$v[0]->idea7;$data[$k]['idea8']=$v[0]->idea8;
        	$data[$k]['idea9']=$v[0]->idea9;$data[$k]['idea10']=$v[0]->idea10;$data[$k]['idea11']=$v[0]->idea11;
        	$data[$k]['idea12']=$v[0]->idea12;$data[$k]['idea13']=$v[0]->idea13;$data[$k]['idea14']=$v[0]->idea14;
        	$data[$k]['idea15']=$v[0]->idea15;$data[$k]['idea16']=$v[0]->idea16;$data[$k]['idea17']=$v[0]->idea17;
        	$data[$k]['idea18']=$v[0]->idea18;$data[$k]['idea19']=$v[0]->idea19;$data[$k]['idea20']=$v[0]->idea20;
        	$data[$k]['idea21']=$v[0]->idea21;$data[$k]['idea22']=$v[0]->idea22;$data[$k]['idea23']=$v[0]->idea23;
        	$data[$k]['idea24']=$v[0]->idea24;$data[$k]['idea25']=$v[0]->idea25;$data[$k]['idea26']=$v[0]->idea26;
        	$data[$k]['idea27']=$v[0]->idea27;$data[$k]['idea28']=$v[0]->idea28;$data[$k]['idea29']=$v[0]->idea29;
        	$data[$k]['idea30']=$v[0]->idea30;$data[$k]['idea31']=$v[0]->idea31;$data[$k]['idea32']=$v[0]->idea32;
        	$data[$k]['idea33']=$v[0]->idea33;$data[$k]['idea34']=$v[0]->idea34;$data[$k]['idea35']=$v[0]->idea35;
        	$data[$k]['idea36']=$v[0]->idea36;
        	
        	$data[$k]['value1']=$v[1]->value1;$data[$k]['value2']=$v[1]->value2;$data[$k]['value3']=$v[1]->value3;
        	$data[$k]['value4']=$v[1]->value4;$data[$k]['value5']=$v[1]->value5;$data[$k]['value6']=$v[1]->value6;
        	$data[$k]['value7']=$v[1]->value7;$data[$k]['suggest1']=$v[1]->suggest1;$data[$k]['facility1']=$v[1]->facility1;
        	$data[$k]['facility2']=$v[1]->facility2;$data[$k]['facility3']=$v[1]->facility3;$data[$k]['facility4']=$v[1]->facility4;
        	$data[$k]['facility5']=$v[1]->facility5;$data[$k]['facility6']=$v[1]->facility6;$data[$k]['facility7']=$v[1]->facility7;
        	$data[$k]['facility8']=$v[1]->facility8;$data[$k]['suggest2']=$v[1]->suggest2;$data[$k]['welfare1']=$v[1]->welfare1;
        	$data[$k]['welfare2']=$v[1]->welfare2;$data[$k]['welfare3']=$v[1]->welfare3;$data[$k]['welfare4']=$v[1]->welfare4;
        	$data[$k]['welfare5']=$v[1]->welfare5;$data[$k]['welfare6']=$v[1]->welfare6;$data[$k]['welfare7']=$v[1]->welfare7;
        	$data[$k]['welfare8']=$v[1]->welfare8;$data[$k]['welfare9']=$v[1]->welfare9;$data[$k]['welfare10']=$v[1]->welfare10;
        	$data[$k]['welfare11']=$v[1]->welfare11;$data[$k]['welfare12']=$v[1]->welfare12;$data[$k]['welfare13']=$v[1]->welfare13;
        	$data[$k]['welfare14']=$v[1]->welfare14;$data[$k]['welfare15']=$v[1]->welfare15;$data[$k]['welfare16']=$v[1]->welfare16;
        	$data[$k]['welfare17']=$v[1]->welfare17;$data[$k]['welfare18']=$v[1]->welfare18;$data[$k]['welfare19']=$v[1]->welfare19;
        	$data[$k]['welfare20']=$v[1]->welfare20;$data[$k]['welfare21']=$v[1]->welfare21;$data[$k]['suggest3']=$v[1]->suggest3;
        	$data[$k]['suggest4']=$v[1]->suggest4;$data[$k]['suggest5']=$v[1]->suggest5;
        	
        	$data[$k]['re1']=$v[2]->re1;$data[$k]['re2']=$v[2]->re2;$data[$k]['re3']=$v[2]->re3;
        	$data[$k]['re4']=$v[2]->re4;$data[$k]['re5']=$v[2]->re5;$data[$k]['re6']=$v[2]->re6;
        	$data[$k]['re7']=$v[2]->re7;$data[$k]['re8']=$v[2]->re8;$data[$k]['ttx1']=$v[2]->ttx1;
        	$data[$k]['ttx2']=$v[2]->ttx2;$data[$k]['ttx3']=$v[2]->ttx3;$data[$k]['ttx4']=$v[2]->ttx4;
        	$data[$k]['ttx5']=$v[2]->ttx5;$data[$k]['ttx6']=$v[2]->ttx6;$data[$k]['ttx7']=$v[2]->ttx7;
        	$data[$k]['ttx8']=$v[2]->ttx8;$data[$k]['xinsuggest1']=$v[2]->xinsuggest1;
        	$data[$k]['xinsuggest2']=$v[2]->xinsuggest2;
        	$data[$k]['xinsuggest3']=$v[2]->xinsuggest3;
        }
		//var_dump($data);die;
		$ob->setactivesheetindex(0);
		$ob->getActiveSheet()->getStyle('1')->getFont()->setSize(12);
		$ob->getDefaultStyle()->getFont('1')->setName('Arial');
		$ob->getActiveSheet()->setCellValue('A1',"ID")
		                     ->setCellValue('B1',"部门")
		                     ->setCellValue('C1',"地区")
		                     ->setCellValue('D1',"日期")
		                     ->setCellValue('E1',"矽力杰工作年份")
		                     ->setCellValue('F1',"累计工作年份")
		                     ->setCellValue('G1',$this->lang->survey->citems[1])
		                     ->setCellValue('H1',$this->lang->survey->citems[2])
		                     ->setCellValue('I1',$this->lang->survey->citems[3])
		                     ->setCellValue('J1',$this->lang->survey->citems[4])
		                     ->setCellValue('K1',$this->lang->survey->citems[5])
		                     ->setCellValue('L1',$this->lang->survey->citems[6])
		                     ->setCellValue('M1',$this->lang->survey->citems[7])
		                     ->setCellValue('N1',$this->lang->survey->citems[8])
		                     ->setCellValue('O1',$this->lang->survey->citems[9])
		                     ->setCellValue('P1',$this->lang->survey->citems[10])
		                     ->setCellValue('Q1',$this->lang->survey->citems[11])
		                     ->setCellValue('R1',$this->lang->survey->citems[12])
		                     ->setCellValue('S1',$this->lang->survey->citems[13])
		                     ->setCellValue('T1',$this->lang->survey->citems[14])
		                     ->setCellValue('U1',$this->lang->survey->citems[15])
		                     ->setCellValue('V1',$this->lang->survey->citems[16])
		                     ->setCellValue('W1',$this->lang->survey->citems[17])
		                     ->setCellValue('X1',$this->lang->survey->citems[18])
		                     ->setCellValue('Y1',$this->lang->survey->citems[19])
		                     ->setCellValue('Z1',$this->lang->survey->citems[20])
		                     ->setCellValue('AA1',$this->lang->survey->citems[21])
		                     ->setCellValue('AB1',$this->lang->survey->citems[22])
		                     ->setCellValue('AC1',$this->lang->survey->citems[23])
		                     ->setCellValue('AD1',$this->lang->survey->citems[24])
		                     ->setCellValue('AE1',$this->lang->survey->citems[25])
		                     ->setCellValue('AF1',$this->lang->survey->citems[26])
		                     ->setCellValue('AG1',$this->lang->survey->citems[27])
		                     ->setCellValue('AH1',$this->lang->survey->citems[28])
		                     ->setCellValue('AI1',$this->lang->survey->citems[29])
		                     ->setCellValue('AJ1',$this->lang->survey->citems[30])
		                     ->setCellValue('AK1',$this->lang->survey->citems[31])
		                     ->setCellValue('AL1',$this->lang->survey->citems[32])
		                     ->setCellValue('AM1',$this->lang->survey->citems[33])
		                     ->setCellValue('AN1',$this->lang->survey->citems[34])
		                     ->setCellValue('AO1',$this->lang->survey->citems[35])
		                     ->setCellValue('AP1',$this->lang->survey->citems[36])
		                    /*IDEA*/
		                     ->setCellValue('AQ1',$this->lang->survey->citems[1])
		                     ->setCellValue('AR1',$this->lang->survey->citems[2])
		                     ->setCellValue('AS1',$this->lang->survey->citems[3])
		                     ->setCellValue('AT1',$this->lang->survey->citems[4])
		                     ->setCellValue('AU1',$this->lang->survey->citems[5])
		                     ->setCellValue('AV1',$this->lang->survey->citems[6])
		                     ->setCellValue('AW1',$this->lang->survey->citems[7])
		                     ->setCellValue('AX1',$this->lang->survey->citems[8])
		                     ->setCellValue('AY1',$this->lang->survey->citems[9])
		                     ->setCellValue('AZ1',$this->lang->survey->citems[10])
		                     ->setCellValue('BA1',$this->lang->survey->citems[11])
		                     ->setCellValue('BB1',$this->lang->survey->citems[12])
		                     ->setCellValue('BC1',$this->lang->survey->citems[13])
		                     ->setCellValue('BD1',$this->lang->survey->citems[14])
		                     ->setCellValue('BE1',$this->lang->survey->citems[15])
		                     ->setCellValue('BF1',$this->lang->survey->citems[16])
		                     ->setCellValue('BG1',$this->lang->survey->citems[17])
		                     ->setCellValue('BH1',$this->lang->survey->citems[18])
		                     ->setCellValue('BI1',$this->lang->survey->citems[19])
		                     ->setCellValue('BJ1',$this->lang->survey->citems[20])
		                     ->setCellValue('BK1',$this->lang->survey->citems[21])
		                     ->setCellValue('BL1',$this->lang->survey->citems[22])
		                     ->setCellValue('BM1',$this->lang->survey->citems[23])
		                     ->setCellValue('BN1',$this->lang->survey->citems[24])
		                     ->setCellValue('BO1',$this->lang->survey->citems[25])
		                     ->setCellValue('BP1',$this->lang->survey->citems[26])
		                     ->setCellValue('BQ1',$this->lang->survey->citems[27])
		                     ->setCellValue('BR1',$this->lang->survey->citems[28])
		                     ->setCellValue('BS1',$this->lang->survey->citems[29])
		                     ->setCellValue('BT1',$this->lang->survey->citems[30])
		                     ->setCellValue('BU1',$this->lang->survey->citems[31])
		                     ->setCellValue('BV1',$this->lang->survey->citems[32])
		                     ->setCellValue('BW1',$this->lang->survey->citems[33])
		                     ->setCellValue('BX1',$this->lang->survey->citems[34])
		                     ->setCellValue('BY1',$this->lang->survey->citems[35])
		                     ->setCellValue('BZ1',$this->lang->survey->citems[36])
		                     ;
		   $ss=2;                  
		 foreach($data as $ke=>$ve)
		 {   // var_dump($ve['silergyyears']);die;  
		 	if($ve['silergyyears']=="silergy1"){$rt = "0-1 Years";} 
		    if($ve['silergyyears']=="silergy2"){$rt = "1-3 Years";}
		    if($ve['silergyyears']=="silergy3"){$rt = "3-5 Years";}
		    if($ve['silergyyears']=="silergy4"){$rt = "5-10 Years";}
		    if($ve['workyears']=="work1"){$rts = "0-1 Years";} if($ve['workyears']=="work2"){$rts = "1-5 Years";} 
		    if($ve['workyears']=="work3"){$rts = "5-10 Years";} if($ve['workyears']=="work4"){$rts = "10-15 Years";} 
		    if($ve['workyears']=="work5"){$rts = "Over 15 Years";}    

		    $niming = $this->dao->select('*')->from("zt_user")->where("account")->eq($ve['staffcode'])->fetch();
		 	$ob->getActiveSheet()->setCellValue("A$ss",$ve['id'])
		 	                     ->setCellValue("B$ss",$niming->dept)
		 	                     ->setCellValue("C$ss",$niming->local)
		 	                     ->setCellValue("D$ss",$ve['year']) 
		 	                     ->setCellValue("E$ss",$rt)
			                     ->setCellValue("F$ss",$rts)
			                     ->setCellValue("G$ss",$ve['val1']) 
			                     ->setCellValue("H$ss",$ve['val2'])
			                     ->setCellValue("I$ss",$ve['val3']) 
			                     ->setCellValue("J$ss",$ve['val4']) 
			                     ->setCellValue("K$ss",$ve['val5'])
			                     ->setCellValue("L$ss",$ve['val6'])
			                     ->setCellValue("M$ss",$ve['val7']) 
			                     ->setCellValue("N$ss",$ve['val8'])
			                     ->setCellValue("O$ss",$ve['val9']) 
			                     ->setCellValue("P$ss",$ve['val10']) 
			                     ->setCellValue("Q$ss",$ve['val11'])
			                     ->setCellValue("R$ss",$ve['val12']) 
			                     ->setCellValue("S$ss",$ve['val13'])
			                     ->setCellValue("T$ss",$ve['val14'])
			                     ->setCellValue("U$ss",$ve['val15']) 
			                     ->setCellValue("V$ss",$ve['val16']) 
			                     ->setCellValue("W$ss",$ve['val17'])
			                     ->setCellValue("X$ss",$ve['val18'])
			                     ->setCellValue("Y$ss",$ve['val19'])
			                     ->setCellValue("Z$ss",$ve['val20'])
			                     ->setCellValue("AA$ss",$ve['val21']) 
			                     ->setCellValue("AB$ss",$ve['val22'])
			                     ->setCellValue("AC$ss",$ve['val23'])
			                     ->setCellValue("AD$ss",$ve['val24'])
			                     ->setCellValue("AE$ss",$ve['val25'])
			                     ->setCellValue("AF$ss",$ve['val26'])
			                     ->setCellValue("AG$ss",$ve['val27'])
			                     ->setCellValue("AH$ss",$ve['val28'])
			                     ->setCellValue("AI$ss",$ve['val29'])
			                     ->setCellValue("AJ$ss",$ve['val30'])
			                     ->setCellValue("AK$ss",$ve['val31'])
			                     ->setCellValue("AL$ss",$ve['val32'])
			                     ->setCellValue("AM$ss",$ve['val33'])
			                     ->setCellValue("AN$ss",$ve['val34']) 
			                     ->setCellValue("AO$ss",$ve['val35'])
			                     ->setCellValue("AP$ss",$ve['val36'])
			                     ->setCellValue("AQ$ss",$ve['idea1'])
			                     ->setCellValue("AR$ss",$ve['idea2'])
			                     ->setCellValue("AS$ss",$ve['idea3'])
			                     ->setCellValue("AT$ss",$ve['idea4'])
			                     ->setCellValue("AU$ss",$ve['idea5'])
			                     ->setCellValue("AV$ss",$ve['idea6'])
			                     ->setCellValue("AW$ss",$ve['idea7'])
			                     ->setCellValue("AX$ss",$ve['idea8'])
			                     ->setCellValue("AY$ss",$ve['idea9'])
			                     ->setCellValue("AZ$ss",$ve['idea10'])
			                     ->setCellValue("BA$ss",$ve['idea11'])
			                     ->setCellValue("BB$ss",$ve['idea12'])
			                     ->setCellValue("BC$ss",$ve['idea13'])
			                     ->setCellValue("BD$ss",$ve['idea14'])
			                     ->setCellValue("BE$ss",$ve['idea15'])
			                     ->setCellValue("BF$ss",$ve['idea16'])
			                     ->setCellValue("BG$ss",$ve['idea17'])
			                     ->setCellValue("BH$ss",$ve['idea18'])
			                     ->setCellValue("BI$ss",$ve['idea19'])
			                     ->setCellValue("BJ$ss",$ve['idea20'])
			                     ->setCellValue("BK$ss",$ve['idea21'])
			                     ->setCellValue("BL$ss",$ve['idea22'])
			                     ->setCellValue("BM$ss",$ve['idea23'])
			                     ->setCellValue("BN$ss",$ve['idea24'])
			                     ->setCellValue("BO$ss",$ve['idea25'])
			                     ->setCellValue("BP$ss",$ve['idea26'])
			                     ->setCellValue("BQ$ss",$ve['idea27'])
			                     ->setCellValue("BR$ss",$ve['idea28'])
			                     ->setCellValue("BS$ss",$ve['idea29'])
			                     ->setCellValue("BT$ss",$ve['idea30'])
			                     ->setCellValue("BU$ss",$ve['idea31'])
			                     ->setCellValue("BV$ss",$ve['idea32'])
			                     ->setCellValue("BW$ss",$ve['idea33'])
			                     ->setCellValue("BX$ss",$ve['idea34'])
			                     ->setCellValue("BY$ss",$ve['idea35'])
			                     ->setCellValue("BZ$ss",$ve['idea36'])
			                     ;
			                     $ss++;
		 }
		 $ob->getActiveSheet()->setTitle("员工满意度调查卷1"); 
		 $ob->createSheet();  
		 $ob->setactivesheetindex(1); 
         $ob->getActiveSheet()->setCellValue('A1',"部门")
         					 ->setCellValue('B1',"地区")
                             ->setCellValue('C1',$this->lang->survey->csanitation[1])
		                     ->setCellValue('D1',$this->lang->survey->csanitation[2])
		                     ->setCellValue('E1',$this->lang->survey->csanitation[3])
		                     ->setCellValue('F1',$this->lang->survey->csanitation[4])
		                     ->setCellValue('G1',$this->lang->survey->csanitation[5])
		                     ->setCellValue('H1',$this->lang->survey->csanitation[6])
		                     ->setCellValue('I1',$this->lang->survey->csanitation[7])
		                     ->setCellValue('J1',"办公场所、实验室环境建议")
		                     ->setCellValue('K1',$this->lang->survey->cfacility[1])
		                     ->setCellValue('L1',$this->lang->survey->cfacility[2])
		                     ->setCellValue('M1',$this->lang->survey->cfacility[3])
		                     ->setCellValue('N1',$this->lang->survey->cfacility[4])
		                     ->setCellValue('O1',$this->lang->survey->cfacility[5])
		                     ->setCellValue('P1',$this->lang->survey->cfacility[6])
		                     ->setCellValue('Q1',$this->lang->survey->cfacility[7])
		                     ->setCellValue('R1',$this->lang->survey->cfacility[8])
		                     ->setCellValue('S1',"实验室内、仪器、设备、电子元件建议")
		                     ->setCellValue('T1',$this->lang->survey->cwelfare[1])
		                     ->setCellValue('U1',$this->lang->survey->cwelfare[2])
		                     ->setCellValue('V1',$this->lang->survey->cwelfare[3])
		                     ->setCellValue('W1',$this->lang->survey->cwelfare[4])
		                     ->setCellValue('X1',$this->lang->survey->cwelfare[5])
		                     ->setCellValue('Y1',$this->lang->survey->cwelfare[6])
		                     ->setCellValue('Z1',$this->lang->survey->cwelfare[7])
		                     ->setCellValue('AA1',$this->lang->survey->cwelfare[8])
		                     ->setCellValue('AB1',$this->lang->survey->cwelfare[9])
		                     ->setCellValue('AC1',$this->lang->survey->cwelfare[10])
		                     ->setCellValue('AD1',$this->lang->survey->cwelfare[11])
		                     ->setCellValue('AE1',$this->lang->survey->cwelfare[12])
		                     ->setCellValue('AF1',$this->lang->survey->cwelfare[13])
		                     ->setCellValue('AG1',$this->lang->survey->cwelfare[14])
		                     ->setCellValue('AH1',$this->lang->survey->cwelfare[15])
		                     ->setCellValue('AI1',$this->lang->survey->cwelfare[16])
		                     ->setCellValue('AJ1',$this->lang->survey->cwelfare[17])
		                     ->setCellValue('AK1',$this->lang->survey->cwelfare[18])
		                     ->setCellValue('AL1',$this->lang->survey->cwelfare[19])
		                     ->setCellValue('AM1',$this->lang->survey->cwelfare[20])
		                     ->setCellValue('AN1',$this->lang->survey->cwelfare[21])
		                     ->setCellValue('AO1',"薪酬/福利等建议")
		                     ->setCellValue('AP1',"点评心中的矽力杰")
		                     ->setCellValue('AQ1',"未涉及问题阐述")
		                     ;
		 $ss=2;
    	 foreach($data as $ke=>$ve)
		 {   // var_dump($ve);die;
//		 	if(!empty($ve['re1']))
//		 	{  
		    $jia = $this->dao->select('*')->from("zt_user")->where("account")->eq($ve['staffcode'])->fetch();// var_dump($jia);die;          
		 	$ob->getActiveSheet()->setCellValue("A$ss",$jia->dept) 
								 ->setCellValue("B$ss",$jia->local) 
								 ->setCellValue("C$ss",$ve['value1']) 
								 ->setCellValue("D$ss",$ve['value2']) 
								 ->setCellValue("E$ss",$ve['value3'])
			                     ->setCellValue("F$ss",$ve['value4']) 
			                     ->setCellValue("G$ss",$ve['value5']) 
			                     ->setCellValue("H$ss",$ve['value6'])
			                     ->setCellValue("I$ss",$ve['value7']) 
			                     ->setCellValue("J$ss",$ve['suggest1'])
			                     ->setCellValue("K$ss",$ve['facility1'])
			                     ->setCellValue("L$ss",$ve['facility2'])
			                     ->setCellValue("M$ss",$ve['facility3'])
			                     ->setCellValue("N$ss",$ve['facility4'])
			                     ->setCellValue("O$ss",$ve['facility5'])
			                     ->setCellValue("P$ss",$ve['facility6'])
			                     ->setCellValue("Q$ss",$ve['facility7'])
			                     ->setCellValue("R$ss",$ve['facility8'])
			                     ->setCellValue("S$ss",$ve['suggest2'])
			                     ->setCellValue("T$ss",$ve['welfare1'])
			                     ->setCellValue("U$ss",$ve['welfare2'])
			                     ->setCellValue("V$ss",$ve['welfare3'])
			                     ->setCellValue("W$ss",$ve['welfare4'])
			                     ->setCellValue("X$ss",$ve['welfare5'])
			                     ->setCellValue("Y$ss",$ve['welfare6'])
			                     ->setCellValue("Z$ss",$ve['welfare7'])
			                     ->setCellValue("AA$ss",$ve['welfare8'])
			                     ->setCellValue("AB$ss",$ve['welfare9'])
			                     ->setCellValue("AC$ss",$ve['welfare10'])
			                     ->setCellValue("AD$ss",$ve['welfare11'])
			                     ->setCellValue("AE$ss",$ve['welfare12'])
			                     ->setCellValue("AF$ss",$ve['welfare13'])
			                     ->setCellValue("AG$ss",$ve['welfare14'])
			                     ->setCellValue("AH$ss",$ve['welfare15'])
			                     ->setCellValue("AI$ss",$ve['welfare16'])
			                     ->setCellValue("AJ$ss",$ve['welfare17'])
			                     ->setCellValue("AK$ss",$ve['welfare18'])
			                     ->setCellValue("AL$ss",$ve['welfare19'])
			                     ->setCellValue("AM$ss",$ve['welfare120'])
			                     ->setCellValue("AN$ss",$ve['welfare21'])
			                     ->setCellValue("AO$ss",$ve['suggest3'])
			                     ->setCellValue("AP$ss",$ve['suggest4'])
			                     ->setCellValue("AQ$ss",$ve['suggest5'])
			                     ;
//		 	}
        $ss++;
		 }
		 $ob->getActiveSheet()->setTitle("员工满意度调查卷2"); 
		 $ob->createSheet();  
         $ob->setactivesheetindex(2); 
         $ob->getActiveSheet()->getStyle('1')->getFont()->setSize(12);
		 $ob->getDefaultStyle()->getFont('1')->setName('Arial');
          $ob->getActiveSheet()->setCellValue('A1',"部门")
                             ->setCellValue('B1',"地区")
                             ->setCellValue('C1',"打分1")
                             ->setCellValue('D1',"打分2")
                             ->setCellValue('E1',"打分3")
                             ->setCellValue('F1',"打分4")
                             ->setCellValue('G1',"打分5")
                             ->setCellValue('H1',"打分6")
                             ->setCellValue('I1',"打分7")
                             ->setCellValue('J1',"打分8")
		                     ->setCellValue('K1',"新大楼，我上下班，路途用时更少")
		                     ->setCellValue('L1',"新大楼，我上下班交通更便利")
		                     ->setCellValue('M1',"新大楼，班车接送，我更需要")
		                     ->setCellValue('N1',"新大楼，以“缩短午休时间” 来换取 “下班时间提早”，我更需要")
		                     ->setCellValue('O1',"新大楼，茶水间、哺乳室等公共区域，我更需要")
		                     ->setCellValue('P1',"新大楼，休闲运动、跑道、健身器材等公共区域设施，我更需要")
		                     ->setCellValue('Q1',"新大楼，食堂、超市、水果店、咖啡店、便利店等生活设施，我更需要")
		                     ->setCellValue('R1',"新大楼，幼儿班、 小托班等家庭服务设施，我更需要")
		                     ->setCellValue('S1',"对于食堂，您还有什么宝贵意见，您可在此处详尽阐述。")
		                     ->setCellValue('T1',"对于公司考勤时间设置，您还有什么宝贵意见，您可在此处详尽阐述。")
		                     ->setCellValue('U1',"上述问题未涉及的，您可在此处详尽阐述。")
		                     ;
		 $ss=2;
         foreach($data as $ke=>$ve)
		 {   // var_dump($ve['silergyyears']);die;
             $pian = $this->dao->select('*')->from("zt_user")->where("account")->eq($ve['staffcode'])->fetch();             
		 	$ob->getActiveSheet()->setCellValue("A$ss",$pian->dept)
		 						 ->setCellValue("B$ss",$pian->local)
		 	                     ->setCellValue("C$ss",$ve['re1']) 
		 	                     ->setCellValue("D$ss",$ve['re2'])
			                     ->setCellValue("E$ss",$ve['re3']) 
			                     ->setCellValue("F$ss",$ve['re4'])
			                     ->setCellValue("G$ss",$ve['re5'])
			                     ->setCellValue("H$ss",$ve['re6']) 
			                     ->setCellValue("I$ss",$ve['re7']) 
			                     ->setCellValue("J$ss",$ve['re8'])
			                     ->setCellValue("K$ss",$ve['ttx1'])
			                     ->setCellValue("L$ss",$ve['ttx2'])
			                     ->setCellValue("M$ss",$ve['ttx3'])
			                     ->setCellValue("N$ss",$ve['ttx4'])
			                     ->setCellValue("O$ss",$ve['ttx5'])
			                     ->setCellValue("P$ss",$ve['ttx6'])
			                     ->setCellValue("Q$ss",$ve['ttx7'])
			                     ->setCellValue("R$ss",$ve['ttx8'])
			                     ->setCellValue("S$ss",$ve['xinsuggest1'])
			                     ->setCellValue("T$ss",$ve['xinsuggest2'])
			                     ->setCellValue("U$ss",$ve['xinsuggest3']);
        $ss++;
		 }
        
        
		$ob->getActiveSheet()->setTitle("杭州新大楼调查卷"); 
		$wob=PHPExcel_IOFactory::createWriter($ob,'Excel5');
		if(PATH_SEPARATOR!=":"){$filename="员工满意度调查.xls";}else{$filename=iconv(auto,"UTF8" , "员工满意度调查").".xls";}
		ob_end_clean();
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$filename");
		header("Cache-Control:max-age=0");
		$wob->save('php://output');
    	}
		$this->display();
		
    }
	
    public function remind()
    {
    	$allstaff = $this->dao->select('*')->from('zt_user')->fetchAll();
    	foreach($allstaff as $k => $v)
    	{   
    	$ty = "<div><p style='font-weight:bold;'>Last Reminding! Survey will be closed in 2 hours! Thanks for your co-operation to fill it ASAP.<br/>
                                            最后提醒！调查系统将于2小时后关闭，感谢您的参与填写！</p><br/>
                   <p>Dear All,</p><br/>
                   <p>You are warmly welcomed to join the Staff Satisfaction Survey from May 4 to May 8. It's secret completely.
					<br/>Pls log-in Silergy Performance Appraisal System to find the Survey page.
				    <br/> * New members for the system pls check your email for further information.</p><br/>
				    <p><a  href='http://101.68.73.134:8093'>http://101.68.73.134:8093</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				    ( <a href='http://192.168.5.8:8093'> http://192.168.5.8:8093</a>  or you can lick this when you in Silergy Office )</p>
                   <br/><p>Looking forward to your real thoughts and suggestions.
					   <br/>* HR help : eva.wei@silergycorp.com 
					   <br/>* IT help : yun.yao@silergycorp.com </p> <br/>
					<p>满意度问卷调查上线了，请登录 Silergy Performance Appraisal System找到Staff Satisfaction Survey 页面。问卷开放期间：5月4日-5月8日。问卷调查匿名提交。</p>     
					<br/><p>*新员工请稍后查询个人邮箱，会有登录方式及信息提示。</p>  
					<br/><p>外网： <a href='http://101.68.73.134:8093'>http://101.68.73.134:8093</a> &nbsp;&nbsp;&nbsp;&nbsp;(内网： <a href='http://192.168.5.8:8093'>http://192.168.5.8:8093</a>  )如有问题，可咨询当地HR及IT。</p>
					<br/><br/><p>Best Regards</p></div>";
    		$linkone = $this->dao->select('*')->from('zt_survey')->where('staffcode')->eq($v->account)->andwhere('year')->eq(date("Y"))->fetch();
    		if(!$linkone)
    		{ 
    			$this->mail->send($v->account,"调查问卷提示",$ty,"",true);
    			unset($ty);
    		}
   	  }
    }
    
//    public function updates()
//    {
//    	$tys = $this->dao->select('*')->from('zt_tmpuserinfo')->fetchAll();
//    	foreach($tys as $k=>$v)
//    	{
//    		$this->dao->update('zt_user')->set('email')->eq($v->email)->where('account')->eq($v->SID)->exec();
//    	}
//    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	
}
?>