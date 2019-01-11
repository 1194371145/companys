<?php
class itemModel extends model
{
	//选择题
	public function selectItem()
	{
	  
	    // return
	     $res=$this->dao->select('id,title,`option`,answers,score')->from('zt_item')->where('type')->eq(1)
	     ->orderBy('quetionID')->fetchAll();
	   foreach ($res as $key => $value) {
	   	$resre=explode("--",$value->answers);
	   	$value->answerA=$resre[0];
	   	$value->answerB=$resre[1];
	   	$value->answerC=$resre[2];
	   	$value->answerD=$resre[3];
	   	unset($value->answers);
	   } return $res;

	}
	//判断题
	public function chooseItem()
	{
	     return $this->dao->select('id,title,`option`,score')->from('zt_item')->where('type')->eq(2)
	     ->orderBy('quetionID')->fetchAll();

	}
	//答题
	public function itemJudge($select,$choose)
	{
		$data =(array)fixer::input('post')->add('create_at', time()) ->get();
		$res = [];$chengji=0;$beifen=[];
		// print_r($data);die;
		foreach ($data as $key => $value)
		{
			if( is_array($value)){
				$res[$key] = implode(",", $value);//b,c
			}else{
				$res[$key] = $value;
			}

		}
		$beifen['account']=$res['account'];
		$beifen['user_id']=$res['user_id'];
		$beifen['create_at']=$res['create_at'];
		unset($res['account'],$res['user_id'],$res['create_at']);
		$res['item_rerd'] = implode("-", $res);
		$res['account']=$beifen['account'];
		$res['user_id']=$beifen['user_id'];
		$res['create_at']=$beifen['create_at'];
		foreach ($select as $k => $v) {//选择题
			$quer="record".$v->id;
			if($v->option==$res[$quer]){
				 $chengji += 5;
			}else{
				$chengji += 0;
			}
		}
		foreach ($choose as $kcho => $vcho) {//判断题
			$seqr="select".$vcho->id;
			if($vcho->option==$res[$seqr]){
				 $chengji += 5;
			}else{
				$chengji += 0;
			}
		}
		foreach ($res as $kk => $vv)
		{//剔除无用的数组属性
			if(stristr($kk,"record")){
				unset($res[$kk]);
			}elseif (stristr($kk,"select")) {
				unset($res[$kk]);
			}else{}
		}
		$res['mark']=$chengji;
		$datares=(object)$res;
		// print($chengji);echo '<br>';print_r($datares);die;
		  $test = $this->dao->insert('zt_itemrecord')->data($datares)//对数据进行检查
        ->check('account,user_id','unique')->batchCheck('account, user_id,create_at,item_rerd,mark', 'notempty')
        ->exec();
        if (dao::isError()) {
                die(js::error(dao::getError()));
                // die(js::reload('parent'));
        }
		
	}
	public function usedItem($value)
	{
		return $this->dao->select('id,mark')->from('zt_itemrecord')
        ->where('user_id')->eq($value)->fetch();
	}




// 	print_r($res)==Array
// (
//     [account] = admin
//     [user_id] = 1
//     [record1] = B
//     [record2] = B
//     [record3] = B
//     [record6] = B,C
//     [record7] = C,D
//     [record8] = B
//     [record10] = A
//     [record11] = A,B
//     [record12] = C
//     [select4] = 5
//     [select5] = 6
//     [select9] = 5
//     [create_at] = 1544693865
// )

}
?>