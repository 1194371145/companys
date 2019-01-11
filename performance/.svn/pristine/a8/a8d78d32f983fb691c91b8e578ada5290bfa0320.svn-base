<?php
class adminModel extends model
{
    /**
     * The api agent(use snoopy).
     * 
     * @var object   
     * @access public
     */
    public $agent;

    /**
     * The api root.
     * 
     * @var string
     * @access public
     */
    public $apiRoot;

    /**
     * The construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setAgent();
    }

    /**
     * Set the api agent.
     * 
     * @access public
     * @return void
     */
    public function setAgent()
    {
        $this->agent = $this->app->loadClass('snoopy');
    }

    /**
     * Post data form  API 
     * 
     * @param  string $url 
     * @param  string $formvars 
     * @access public
     * @return void
     */
    public function postAPI($url, $formvars = "")
    {
		$this->agent->cookies['lang'] = $this->cookie->lang;
    	$this->agent->submit($url, $formvars);
		return $this->agent->results;
    }


    /**
     * Get state of company.
     * 
     * @param  int    $companyID 
     * @access public
     * @return void
     */
    public function getStatOfCompany($companyID)
    {
    }


	/**
	 * Get register information. 
	 * 
	 * @access public
	 * @return object
	 */
	public function getRegisterInfo()
    {
        $register = new stdclass();
		$register->company = $this->app->company->name;
		$register->email   = $this->app->user->email;
		return $register;
	}
	
    /**
     * catch data from some excel file to database
     * @param string filename
     * @access public
     * @return void
     */	
	public function getDatabyExcelsFile($path,$filename,$circietime = "")
	{
		
		require_once('../../lib/PHPExcel/PHPExcel.php');
		require_once('../../lib/PHPExcel/PHPExcel/IOFactory.php');
		
		$ob = PHPExcel_IOFactory::load($path);
		
		$sheetob=$ob->setActiveSheetIndex(0);
		
		if(strlen(trim($ob->getActiveSheet()->getCell("B3")->getValue())) < 2)
		{
		   $sheetob=$ob->setActiveSheetIndex(1);
		}
		
		$allrows=$sheetob->getHighestRow();
		for($row=2; $row<=$allrows; $row++)
		{
			for($col="A";$col<="K";$col++)
			{
				$arr[$row-1][$col]=trim($ob->getActiveSheet()->getCell("$col$row")->getValue());
			}

		}
		
		if(trim($arr[2]['A']) != '被评估者姓名' && strtolower(trim($arr[2]['A'])) != 'employee')
		{
			die(js::error($filename.' template incorrect '));
		}
		$arr[2]['J'] = $this->excelTime($arr[2]['J'],false);
		//$staffs = $this->dao->select('*')->from('zt_staff')->where('name')->eq($arr[2]['B'])->fetch();
		//$code = $staffs->staffcode;
		
		if(trim($arr[4]['F']) == "Total Score")
		{
			if(strlen($arr[4]['C']) == 5)
			{
				$zhouqi = $arr[4]['C'];
			}
			else
			{
				$zhouqi = substr($arr[4]['C'],0,4);
				if(strpos($arr[4]['C'],'1H') !== false)
				{
					$zhouqi .= "1";
				}
				if(strpos($arr[4]['C'],'2H') !== false)
				{
					$zhouqi .= "2";
				}
			}
			
		}
		else 
		{
			if(strlen($arr[4]['B']) == 5)
			{
				$zhouqi = $arr[4]['B'];
			}
			else
			{
				$zhouqi = substr($arr[4]['B'],0,4);
				if(strpos($arr[4]['B'],'1H') !== false)
				{
					$zhouqi .= "1";
				}
				if(strpos($arr[4]['B'],'2H') !== false)
				{
					$zhouqi .= "2";
				}
			}
		}
		if(strlen($zhouqi) < 1)
		{
		   $zhouqi = trim($arr[4]['B']);
		}
		if(strlen($circietime) > 1 && $circietime != $zhouqi)
		{
		   die(js::error($circietime.'/'.$zhouqi.'The select circie time is different from the circle in excel file ! '));
		   
		}
		$staffcode = substr(trim($filename),0,6);
		$checkmm = $this->dao->select('id')->from('zt_performancemaster')->where('staffcode')->eq($staffcode)->andWhere('zhouqi')->eq($zhouqi)->fetch('id');
		if($checkmm > 0) return '';
		//insert data to master table
		foreach ($arr as $k => $v)
		{
		   if($v['B'] == "总结主要优点" || strtolower($v['B']) == "employee's strength")
		   {
		     $start0 = $k;
		     
		     break;
		   } 
		}
		
		//get index for review signature
		foreach ($arr as $ki => $vi)
		{
		   if($vi['A'] == "被评估者签名及日期" || strtolower($vi['A']) == "emplyee signature & date")
		   {
		     $signindex = $ki;
		     break;
		   } 
		}		
		$uid = $this->dao->select('id')->from('zt_user')->where('account')->eq($staffcode)->fetch('id');
		$zgsid = $this->dao->select('supersid')->from('zt_user')->where('account')->eq($staffcode)->fetch(supersid);
		if(strlen($zgsid) < 3) echo js::alert($staffcode.' did not match the superviser code !');
		$master = array('uid'=>$uid,
		                'zhouqi'=>$zhouqi,
		                'staffcode'=>$staffcode,
		                'name'=>trim($arr[2]['B']),
		                'department'=>trim($arr[2]['E']),
		                'zhiwei'=>trim($arr[2]['H']),
		                'ruzhidate'=>trim($arr[2]['J']),
		                'zgname'=>trim($arr[3]['B']),
		                'zgdepartment'=>trim($arr[3]['E']),
		                'zgzhiwei'=>trim($arr[3]['H']),
		                'zgsid'=>$zgsid,
		                'statement'=>trim($arr[$start0-1]['B']),
		                'review_strength'=>trim($arr[$start0]['C']),
		                'review_improve'=>trim($arr[$start0+1]['C']),
		                'staffsignature'=>trim($arr[$signindex]['C']),
		                'supersignature'=>trim($arr[$signindex]['I']),
		                'status'=>strlen(trim($arr[$signindex]['I'])) > 2 ? 'close' : 'open',
		                'adddate'=>date("Y-m-d") 
		                );
		               
		$this->dao->replace('zt_performancemaster')->data($master)->exec();  
		$mid = $this->dao->select('id')->from('zt_performancemaster')->where('staffcode')->eq($staffcode)->andWhere('zhouqi')->eq($zhouqi)->fetch('id');
		//get ability items
		$startab = $start0-9;
		
		for($b = $startab ; $b < $start0-2 ;$b++)
		{
			if(strlen($arr[$b]["B"]) > 3 && strtolower(trim($arr[$b]["A"])) != "categories")
			{
				$performanceability = array('mid'=>$mid,
						                'staffcode'=>$staffcode,
						                'category'=>intval($arr[$b]["A"]),
						                'zhouqi'=>$zhouqi,
						                'weight'=>$arr[$b]["D"] > 1 ? $arr[$b]["D"]/100 : $arr[$b]["D"],
						                'item'=>$arr[$b]["B"],
						                'reviewitem'=>$arr[$b]["E"],
			                            'score'=>$arr[$b]["I"],
			                            'scorebysuper'=>$arr[$b]["J"],
						                'addby'=>"admin",
						                'adddate'=>date("Y-m-d")
				);
				$alilityarr[] = $performanceability;
				$this->dao->replace('zt_performanceability')->data($performanceability)->exec();
				
			}
			
		}
		
		//get current circle time item
		$this->dao->delete()->from('zt_performanceitem')->where('staffcode')->eq($staffcode)->andWhere('zhouqi')->eq($zhouqi)->exec();
		
		foreach ($arr as $key => $value)
		{
			if($value['D'] == '绩效考核对照得分情况' || strtolower($value['D']) == 'performance review comparison')
			{
				$start = $key+2;
				for($i =$start;$i<=$start+8;$i++)
				{
					if(intval($arr[$i]["A"]) > 0 && strlen(trim($arr[$i]["B"]))> 1)
					{
						$end = $i;
						$performanceitems = array('mid'=>$mid,
						                     'staffcode'=>$staffcode,
						                     'category'=>intval($arr[$i]["A"]),
						                     'goalitem'=>trim($arr[$i]["B"]),
						                     'weight'=>$arr[$i]["D"] > 1 ? $arr[$i]["D"]/100 :$arr[$i]["D"],
						                     'score'=>intval($arr[$i]["I"]),
						                     'scorebysuper'=>intval($arr[$i]["J"]),
						                     'zhouqi'=>$zhouqi,
						                     'reviewbymyself'=>$arr[$i]["E"],
						                     'reviewbysuper'=>$arr[$i]["G"],
						                     'itemfrom'=>$arr[$i]["D"] > 0 ? 'S' : 'M',
						                     'addby'=>"admin",
						                     'adddate'=>date("Y-m-d")
						);
						$this->dao->replace('zt_performanceitem')->data($performanceitems)->exec();
					}
					if(strtolower($arr[$i]["A"]) == "categories") break 2;
				}
				break;
			}
			
		}
		
		//get next circle time data and delete old detail item 
		$this->dao->delete()->from('zt_performanceitem')->where('staffcode')->eq($staffcode)->andWhere('zhouqi')->eq($this->getnextzhouqi($zhouqi))->exec();            
		foreach ($arr as $key => $value)
		{
			if($value['B'] == '工作考核具体目标和考核标准' || strtolower($value['B']) == 'specific goals and objectives')
			{
				$start = $key+1;
				if(intval($arr[$start]["A"]) > 0 && strlen(trim($arr[$start]["B"]))> 1)
				{
					$master['zhouqi'] = $this->getnextzhouqi($zhouqi);
					$master['status'] = "open";
					$master['statement'] = "";
					$master['review_strength'] = "";
					$master['review_improve'] = "";
					$master['staffsignature'] = "";
					$master['supersignature'] = "";
					$this->dao->replace('zt_performancemaster')->data($master)->exec();
					$nextmid = $this->dao->lastInsertID();
					foreach($alilityarr as $abv)
					{
					   $abv['mid'] = $nextmid;
					   $abv['score'] = 0;
					   $abv['scorebysuper'] = 0;
					   $abv['reviewitem'] = '';
					   $abv['zhouqi'] = $this->getnextzhouqi($zhouqi);
					   $this->dao->replace('zt_performanceability')->data($abv)->exec();
					}
				}
				for($i = $start;$i<= count($arr);$i++)
				{
					if(intval($arr[$i]["A"]) > 0 && strlen(trim($arr[$i]["B"]))> 1)
					{
						$end = $i;
						$performanceitems = array('mid'=>$nextmid,
						                     'staffcode'=>$staffcode,
						                     'category'=>intval($arr[$i]["A"]),
						                     'goalitem'=>trim($arr[$i]["B"]),
						                     'weight'=>$arr[$i]["J"] > 1 ? $arr[$i]["J"]/100 : $arr[$i]["J"],
						                     'zhouqi'=>$this->getnextzhouqi($zhouqi),
						                     'itemfrom'=>$arr[$i]["J"] > 0 ? 'S' : 'M',
						                     'addby'=>"admin",
						                     'adddate'=>date("Y-m-d")
						                     );
						                     
						$this->dao->replace('zt_performanceitem')->data($performanceitems)->exec();                     
                        
					                        				                     
						                     
					}
				}
				break;
			}
			
		}
        
        //echo $staffcode;
	    
	}

	/**
	 * 
	 * get the pre circle time
	 * @param str $zhouqi
	 * @access public
	 * @return str 
	 */
    public function getnextzhouqi($zhouqi)
    {
       if(substr($zhouqi,4,1) == 2)
       {
          $year = intval(substr($zhouqi,0,4))+1;
          $circle = $year."1";
       }
       else 
       {
          $circle = intval($zhouqi) + 1;
       }
       return $circle;
    
    }
	/** transfer execl time to php datetime 
	 *@param int $exceldate
	 *@param bool $time
	 *@access public
	 *@return string 
	 */

	public function excelTime($date, $time = false)    
	{
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
	
	/**
	 * 
	 * 转换编码，将Unicode编码转换成可以浏览的utf-8编码
	 * @param $name
	 */
	public function unicode_decode($name)
	{
		$pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
		preg_match_all($pattern, $name, $matches);
		
		if (!empty($matches))
		{
			$name = '';
			for ($j = 0; $j < count($matches[0]); $j++)
			{
				$str = $matches[0][$j];
				if (strpos($str, '\\u') === 0)
				{
					$code = base_convert(substr($str, 2, 2), 16, 10);
					$code2 = base_convert(substr($str, 4), 16, 10);
					$c = chr($code).chr($code2);
					$c = iconv('UCS-2', 'UTF-8', $c);
					$name .= $c;
				}
				else
				{
					$name .= $str;
				}
			}
		}
		return $name;
	}
	
	
}
