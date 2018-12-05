<?php
class sampleoutModel extends model
{
    public function sampleoutModel()
    {
        parent::__construct();
        $partmp=$this->dao->select("device,remark")->from('zt_mp')->where('deleted')->eq(0)->andWhere('no')->eq("无(非常规料号)")->fetchPairs('device','remark');
        $partsample=$this->dao->select("device,remark")->from('zt_sample')->where('deleted')->eq(0)->andWhere('no')->eq("无(非常规料号)")->fetchPairs('device','remark');
        $part=array_merge($partmp,$partsample);
        $this->notpart=$part;
    }

    public function getspecialpart()
    {
        $this->dao->connect10();
        $sql="select * from zt_wgcprorelease where mappingfrom != '' and deleted = '0'";
        $pro=mysql_query($sql);
        while($p=mysql_fetch_assoc($pro))
        {
            $v=array();
            $v['device']=$p['partnumber'];$v["package"]=$p['package'];$v["wafer_lot"]="mappingfrom";$v["qty"]=1;$v["date"]=date("Y-m-d");$v["createdate"]=date("Y-m-d");
            $v["deleted"]=0;$v["no"]="无(非常规料号)";$v["openby"]=$p['admin'];$v['remark']=$p["mappingfrom"];$v['proline']=$p['newproline'];$v['ae']=$p['ae'];

            if($p['phase4'])
            {
                $wafer=explode("\n",$p['phase4']);
                $count=count($wafer);
                $wafertmp=explode("!",$wafer[$count-1]);
                $waferre=$wafertmp[0];
                $v['release_code']=$waferre;
            }
            elseif($p['phase3'])
            {
                $wafer=explode("\n",$p['phase3']);
                $count=count($wafer);
                $wafertmp=explode("!",$wafer[$count-1]);
                $waferre=$wafertmp[0];
                $v['release_code']=$waferre;
            }
            elseif($p['phase2'])
            {
                $wafer=explode("\n",$p['phase2']);
                $count=count($wafer);
                $wafertmp=explode("!",$wafer[$count-1]);
                $waferre=$wafertmp[0];
                $v['release_code']=$waferre;
            }
            elseif($p['phase1'])
            {
                $wafer=explode("\n",$p['phase1']);
                $count=count($wafer);
                $wafertmp=explode("!",$wafer[$count-1]);
                $waferre=$wafertmp[0];
                $v['release_code']=$waferre;
            }
            $re=$this->dao->select('id,qty')->from('zt_mp')->where('device')->eq($v['device'])->andWhere('wafer_lot')->eq($v['wafer_lot'])->andWhere('deleted')->eq(0)->fetch();
            if(!$re)
            {
                $this->dao->insert("zt_mp")->data($v)->autoCheck()->exec();
				$exists[$this->dao->lastInsertID()]=$this->dao->lastInsertID();
            }
			else
			{
				$exists[$re->id]=$re->id;
			}
        }
		$this->dao->delete()->from("zt_mp")->where('no')->eq("无(非常规料号)")->andWhere('id')->notin($exists)->exec();
    }
    //样品申请记录
    public function out($orderBy,$pager,$demo)
    {
        $but=$this->loadModel('group')->getUserPairs(14);//加载指定的模版
        $but=array_keys($but);
        if($demo == 'sample')
        {
            //判断当前用户在$but中
            if(in_array($this->app->user->account,$but))
            {
                $outs=$this->dao->select("*")->from('zt_out')->where('rtype')->notlike('%demo%')
                    ->andWhere('toassign')->eq($this->app->user->account)
                    ->andWhere("areamanager")->ne("1")->andWhere("salesmanager")->ne("1")
                    ->orderBy($orderBy)
                    ->page($pager)
                    ->fetchAll('id');
            }
            else
            {
                $outs=$this->dao->select("*")->from('zt_out')
                    ->where('rtype')->notlike('%demo%')
                    ->andWhere("areamanager")->ne("1")->andWhere("salesmanager")->ne("1")
					->beginIF(in_array(24,$this->app->user->groups))
                    ->andwhere('(partn like "SY3%" or partn like "SY13%")')
                    ->fi()
					->beginIF(in_array(3,$this->app->user->groups))
                    ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="HZ")')
                    ->fi()
					->beginIF(in_array(20,$this->app->user->groups))
                    ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="TW")')
                    ->fi()
                    ->orderBy($orderBy)->page($pager)->fetchAll('id');
            }

        }
        else
        {
            if(in_array($this->app->user->account,$but))
            {
                $outs=$this->dao->select("*")->from('zt_out')
                    ->where('rtype')->like('%demo%')
                    ->andWhere('toassign')->eq($this->app->user->account)
                    ->andWhere("areamanager")->ne("1")->andWhere("salesmanager")->ne("1")
                    ->orderBy($orderBy)
                    ->page($pager)
                    ->fetchAll('id');
            }
            else
            {
                $outs=$this->dao->select("*")->from('zt_out')
                    ->where('rtype')->like('%demo%')
                    ->andWhere("areamanager")->ne("1")->andWhere("salesmanager")->ne("1")
					->beginIF(in_array(24,$this->app->user->groups))
                    ->andwhere('(partn like "SY3%" or partn like "SY13%")')
                    ->fi()
					->beginIF(in_array(3,$this->app->user->groups))
                    ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="HZ")')
                    ->fi()
					->beginIF(in_array(20,$this->app->user->groups))
                    ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="TW")')
                    ->fi()
                    ->orderBy($orderBy)->page($pager)->fetchAll('id');
            }

        }

        $wheres=explode("WHERE",$this->dao->get());
        $wheres=explode("ORDER BY",$wheres[1]);
        $orderbys=explode("limit",$wheres[1]);
        $this->session->set('exportsampleout',$wheres[0]);
        $this->session->set('exportsampleoutorderby',$orderbys[0]);
        $outswait = $this->dao->select("*")->from('zt_out')->where('id')->in(array_keys($outs))->andWhere('close')->eq('wait')->orderBy($orderBy)->fetchAll('id');
        $outsdone=$this->dao->select("*")->from('zt_out')->where('id')->in(array_keys($outs))->andWhere('close')->eq('done')->orderBy($orderBy)->fetchAll('id');
        foreach($outswait as $k=>$v)
        {
            $v->partn=trim($v->partn);
            $sampleo=array();
            $sampleo[0]="";
            if(isset($this->notpart[$v->partn])){$notpart=array($this->notpart[$v->partn],$v->partn);}else{$notpart=array($v->partn);}
            $sample = $this->dao->select("*")->from('zt_sample')
                    ->where("device")->in($notpart)
                    ->andWhere('deleted')->eq(0)
                    ->andWhere('note')->eq("1")
                    ->andWhere('inventry')->gt(0)
					->beginIF(in_array(3,$this->app->user->groups))
                    ->andwhere('region="HZ"')
                    ->fi()
					->beginIF(in_array(20,$this->app->user->groups))
                    ->andwhere('region="TW"')
                    ->fi()
                    ->fetchAll();
            if (!$sample) 
			{
                    $sample = $this->dao->select("*")->from('zt_sample')
                        ->where("device")->in($notpart)
                        ->andWhere('deleted')->eq(0)
                        ->andWhere('note')->ne("0")
                        ->andWhere('inventry')->gt(0)
						->beginIF(in_array(3,$this->app->user->groups))
						->andwhere('region="HZ"')
						->fi()
						->beginIF(in_array(20,$this->app->user->groups))
						->andwhere('region="TW"')
						->fi()
                        ->fetchAll();
            }
            foreach ($sample as $vv) 
			{
                    $qty = $this->dao->select("sum(aqty) as q")->from('zt_out')
                        ->where('type')->eq('2')
                        ->andWhere('mid')->eq($vv->id)
                        ->andWhere("close")->eq("wait")
                        ->andWhere('id')->ne($v->id)
                        ->beginIF(in_array(3,$this->app->user->groups))
						->andwhere('region="HZ"')
						->fi()
						->beginIF(in_array(20,$this->app->user->groups))
						->andwhere('region="TW"')
						->fi()
                        ->fetch();
                    if ($qty->q)
					{
                        if ($vv->qty - $qty->q > 0) 
						{
                            $sampleo[$vv->id . 'sample'] = "样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/NO:{$vv->no}/Part:{$vv->device}";
                        }
                    }
                    else 
					{
                        $sampleo[$vv->id . 'sample'] = "样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/NO:{$vv->no}/Part:{$vv->device}";
                    }
            }

            $mps = $this->dao->select("*")->from('zt_mp')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('status')->eq("可送")
                ->beginIF(in_array(3,$this->app->user->groups))
                ->andwhere('region="HZ"')
                ->fi()
			    ->beginIF(in_array(20,$this->app->user->groups))
                ->andwhere('region="TW"')
                ->fi()
                ->andWhere('qty')->gt(0)
                ->fetchAll();
            foreach($mps as $vv)
            {
                $qty = $this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where('type')->eq('1')
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere("close")->eq("wait")
                    ->beginIF(in_array(3,$this->app->user->groups))
                    ->andwhere('region="HZ"')
                    ->fi()
					->beginIF(in_array(20,$this->app->user->groups))
                    ->andwhere('region="TW"')
                    ->fi()
                    ->andWhere('id')->ne($v->id)
                    ->fetch();
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/NO:{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/NO:{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                }
            }

            $v->wait=$sampleo;//给申请中的订单绑定wait字段(数组) 页面显示主数据
        }
        $outs=$outswait + $outsdone;
        // var_dump($outsdone);die;
        return $outs;
    }
    //通过search
    public function getoutbysearch($where,$pager,$orderBy,$demo)
    {
        $but=$this->loadModel('group')->getUserPairs(14);
        $but=array_keys($but);
        if($demo=='sample')
        {
            $outs = $this->dao->select("*")->from('zt_out')
                ->where($where)
                ->andWhere('rtype')->notlike("%demo%")
                ->beginIF(in_array($this->app->user->account, $but))
                ->andWhere('toassign')->eq($this->app->user->account)
                ->fi()
                ->andWhere("areamanager")->ne("1")->andWhere("salesmanager")->ne("1")
                ->beginIF(in_array(24,$this->app->user->groups))
                ->andwhere('(partn like "SY3%" or partn like "SY13%")')
                ->fi()
			    ->beginIF(in_array(3,$this->app->user->groups))
                ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="HZ")')
                ->fi()
				->beginIF(in_array(20,$this->app->user->groups))
                ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="TW")')
                ->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll('id');
        }
        else
        {
            $outs = $this->dao->select("*")->from('zt_out')
                ->where($where)
                ->andWhere('rtype')->like("%demo%")
                ->beginIF(in_array($this->app->user->account, $but))
                ->andWhere('toassign')->eq($this->app->user->account)
                ->fi()
                ->andWhere("areamanager")->ne("1")->andWhere("salesmanager")->ne("1")
				->beginIF(in_array(24,$this->app->user->groups))
                ->andwhere('(partn like "SY3%" or partn like "SY13%")')
                ->fi()
				->beginIF(in_array(3,$this->app->user->groups))
                ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="HZ")')
                ->fi()
			    ->beginIF(in_array(20,$this->app->user->groups))
                ->andwhere('(partn not like "SY3%" and partn not like "SY13%" and region="TW")')
                ->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll('id');
        }
        $wheres=explode("WHERE",$this->dao->get());
        $wheres=explode("ORDER BY",$wheres[1]);
        $orderbys=explode("limit",$wheres[1]);
        $this->session->set('exportsampleout',$wheres[0]);
        $this->session->set('exportsampleoutorderby',$orderbys[0]);
        $outswait = $this->dao->select("*")->from('zt_out')->where('id')->in(array_keys($outs))->andWhere($where)->andWhere('close')->eq('wait')->fetchAll('id');
        $outsdone=$this->dao->select("*")->from('zt_out')->where('id')->in(array_keys($outs))->andWhere($where)->andWhere('close')->eq('done')->fetchAll('id');
        foreach($outswait as $k=>$v)
        {
            $v->partn=trim($v->partn);
            $sampleo=array();
            $sampleo[0]="";
            if(isset($this->notpart[$v->partn])){$notpart=array($this->notpart[$v->partn],$v->partn);}else{$notpart=array($v->partn);}
            $sample=$this->dao->select("*")->from('zt_sample')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('note')->eq("1")
                ->andWhere('inventry')->gt(0)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetchAll();
            if(!$sample)
            {
                $sample=$this->dao->select("*")->from('zt_sample')
                    ->where("device")->in($notpart)
                    ->andWhere('deleted')->eq(0)
                    ->andWhere('note')->ne("0")
                    ->andWhere('inventry')->gt(0)
					->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
				    ->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetchAll();
            }
            foreach($sample as $vv)
            {
                $qty = $this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where('type')->eq('2')
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere("close")->eq("wait")
                    ->andWhere('id')->ne($v->id)
                    ->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetch();
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/No:{$vv->no}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/NO:{$vv->no}/Part:{$vv->device}";
                }
            }
            $mps = $this->dao->select("*")->from('zt_mp')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('status')->eq("可送")
                ->andWhere('qty')->gt(0)
                ->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetchAll();
            foreach($mps as $vv)
            {
                $qty = $this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where('type')->eq('1')
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere("close")->eq("wait")
                    ->andWhere('id')->ne($v->id)
                    ->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetch();
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No:{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                }
            }

            $v->wait=$sampleo;

        }
        $outs=$outswait + $outsdone;

        return $outs;
    }
    function getbyid($id)
    {
        $re=$this->dao->select("*")->from('zt_out')->where('id')->eq($id)->fetch();
        if($re->close=='wait')
        {
            if(isset($this->notpart[$re->partn])){$notpart=array($this->notpart[$re->partn],$re->partn);}else{$notpart=array($re->partn);}
            $sampleo[0]="";
            $sample=$this->dao->select("*")->from('zt_sample')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('note')->eq("1")
                ->andWhere('inventry')->gt(0)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetchAll();
            if(!$sample)
            {
                $sample=$this->dao->select("*")->from('zt_sample')
                    ->where("device")->in($notpart)
                    ->andWhere('deleted')->eq(0)
                    ->andWhere('note')->eq("1")
                    ->andWhere('inventry')->gt(0)
					->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetchAll();
            }
            foreach($sample as $vv)
            {
                $qty = $this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where("close")->eq("wait")
                    ->andWhere('type')->eq(2)
                    ->andWhere('mid')->eq($vv->id)
                    ->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->andWhere('id')->ne($re->id)
                    ->fetch();
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/No:{$vv->no}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/NO:{$vv->no}/Part:{$vv->device}";
                }
            }
            $mps = $this->dao->select("*")->from('zt_mp')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('status')->eq("可送")
                ->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->andWhere('qty')->gt(0)
                ->fetchAll();
            foreach($mps as $vv)
            {
                $qty = $this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where("close")->eq("wait")
                    ->andWhere('type')->eq(1)
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere('id')->ne($re->id)
                    ->beginIF(in_array(3,$this->app->user->groups))
				    ->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetch();
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No:{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                }
            }
            $re->wait=$sampleo;
        }
        return $re;
    }
    function getbyidofauto($id)
    {
        $re=$this->dao->select("*")->from('zt_out')->where('id')->eq($id)->fetch();
        if($re->close=='wait')
        {
            $re->partn=trim($re->partn);
            $sampleo=array();
            if(isset($this->notpart[$re->partn])){$notpart=array($this->notpart[$re->partn],$re->partn);}else{$notpart=array($re->partn);}
            $mps=$this->dao->select("*")->from('zt_mp')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('status')->eq("可送")
                ->andWhere('qty')->gt(0)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetchAll();
            foreach($mps as $vv)
            {
                $qty=$this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where("close")->eq("wait")
                    ->andWhere('type')->eq(1)
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere('id')->ne($re->id)
					->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetch()
                ;
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No:{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                }
            }
            $sample=$this->dao->select("*")->from('zt_sample')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('note')->eq("1")
                ->andWhere('inventry')->gt(0)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetchAll();
            foreach($sample as $vv)
            {
                $qty=$this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where("close")->eq("wait")
                    ->andWhere('type')->eq(2)
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere('id')->ne($re->id)
					->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetch()
                ;
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/No:{$vv->no}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/NO:{$vv->no}/Part:{$vv->device}";
                }
            }
            $re->wait=$sampleo;
        }
        return $sampleo;
    }
    public function getwaitbypart($part)
    {
        $sampleo[0]="";
        $sample=$this->dao->select("*")->from('zt_sample')
            ->where("device")->eq($part)
            ->andWhere('deleted')->eq(0)
            //->andWhere('note')->eq("1")
            ->andWhere('inventry')->gt(0)
			->beginIF(in_array(3,$this->app->user->groups))
			->andwhere('region="HZ"')
			->fi()
			->beginIF(in_array(20,$this->app->user->groups))
			->andwhere('region="TW"')
            ->fetchAll();
        foreach($sample as $vv)
        {
            $qty=$this->dao->select("sum(aqty) as q")->from('zt_out')
                ->where("close")->eq("wait")
                ->andWhere('type')->eq(2)
                ->andWhere('mid')->eq($vv->id)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetch()
            ;
            if($qty->q)
            {
                if($vv->qty - $qty->q >0)
                {
                    $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/No:{$vv->no}/Part:{$vv->device}";
                }
            }
            else
            {
                $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/NO:{$vv->no}/Part:{$vv->device}";
            }
        }
        $mps=$this->dao->select("*")->from('zt_mp')
            ->where("device")->eq($part)
            ->andWhere('deleted')->eq(0)
            ->andWhere('status')->eq("可送")
            ->andWhere('qty')->gt(0)
			->beginIF(in_array(3,$this->app->user->groups))
			->andwhere('region="HZ"')
			->fi()
			->beginIF(in_array(20,$this->app->user->groups))
			->andwhere('region="TW"')
            ->fetchAll();
        foreach($mps as $vv)
        {
            $qty=$this->dao->select("sum(aqty) as q")->from('zt_out')
                ->where("close")->eq("wait")
                ->andWhere('type')->eq(1)
                ->andWhere('mid')->eq($vv->id)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetch()
            ;
            if($qty->q)
            {
                if($vv->qty - $qty->q >0)
                {
                    $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No:{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                }
            }
            else
            {
                $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
            }
        }
        return $sampleo;
    }
    //判断提交数据有多少重复
    public function outis_daoru($v)
    {
        $where="";
        foreach($v as $k=>$v)
        {
            $where.="$k = '$v' and ";
        }
        $where=substr($where,0,-5);//除掉id字段
        $re=$this->dao->select("*")->from('zt_out')->where($where)->fetch();
        if($re->id>0)
        {
            return $re->id;
        }
        else
        {
            return false;
        }
    }
    public function batchuhuo($outids)
    {
        $outs=$this->dao->select("*")->from('zt_out')->where('id')->in($outids)->fetchAll();
        foreach($outs as $k=>$v)
        {
            $v->partn=trim($v->partn);
            $sampleo=array();
            if(isset($this->notpart[$v->partn])){$notpart=array($this->notpart[$v->partn],$v->partn);}else{$notpart=array($v->partn);}
            $mps=$this->dao->select("*")->from('zt_mp')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('status')->eq("可送")
                ->andWhere('qty')->gt(0)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetchAll();
            foreach($mps as $vv)
            {
                $qty=$this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where('type')->eq('1')
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere("close")->eq("wait")
                    ->andWhere('id')->ne($v->id)
					->beginIF(in_array(3,$this->app->user->groups))
				    ->andwhere('region="HZ"')
				    ->fi()
				    ->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetch()
                ;
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No:{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'mp']="量产/ID:{$vv->id}/数量:{$vv->qty}/No{$vv->no}/Status:{$vv->status}/Part:{$vv->device}";
                }
            }
            $sample=$this->dao->select("*")->from('zt_sample')
                ->where("device")->in($notpart)
                ->andWhere('deleted')->eq(0)
                ->andWhere('note')->eq("1")
                ->andWhere('inventry')->gt(0)
				->beginIF(in_array(3,$this->app->user->groups))
				->andwhere('region="HZ"')
				->fi()
				->beginIF(in_array(20,$this->app->user->groups))
				->andwhere('region="TW"')
                ->fetchAll();
            foreach($sample as $vv)
            {
                $qty=$this->dao->select("sum(aqty) as q")->from('zt_out')
                    ->where('type')->eq('2')
                    ->andWhere('mid')->eq($vv->id)
                    ->andWhere("close")->eq("wait")
                    ->andWhere('id')->ne($v->id)
					->beginIF(in_array(3,$this->app->user->groups))
					->andwhere('region="HZ"')
					->fi()
					->beginIF(in_array(20,$this->app->user->groups))
					->andwhere('region="TW"')
                    ->fetch()
                ;
                if($qty->q)
                {
                    if($vv->qty - $qty->q >0)
                    {
                        $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/No:{$vv->no}/Part:{$vv->device}";
                    }
                }
                else
                {
                    $sampleo[$vv->id.'sample']="样品/ID:{$vv->id}/数量:{$vv->inventry}/Note:{$vv->note}/NO:{$vv->no}/Part:{$vv->device}";
                }
            }
            $v->wait=$sampleo;
        }
        return $outs;
    }
    public function batchuhuoofdemo($outids)
    {
        $outs=$this->dao->select("*")->from('zt_out')->where('id')->in($outids)->fetchAll();
        foreach($outs as $k=>$v)
        {
            $sampleo=array();
            $sampleo[0]="";
            $v->wait=$sampleo;
        }
        return $outs;
    }
    //control -> pay
    function getpay($orderby,$pager)
    {

        $re = $this->dao->select("*")->from("zt_out")
            ->where('revtype')->eq('需要付费')
            ->andWhere('area')->notin(array('SC', "TW"))
            // ->orderBy("pay_desc,".$orderby)
            
            ->orderBy($orderby)
            ->page($pager)
            ->fetchAll();

        $wheres = explode("WHERE", $this->dao->get());
        $wheres = explode("ORDER BY", $wheres[1]);
        $orderbys = explode("limit", $wheres[1]);
        $this->session->set('exportsampleout', $wheres[0]);
        $this->session->set('exportsampleoutorderby', $orderbys[0]);
        return $re;
    }

    function getpaybysearch($orderby,$pager,$where,$region = '')
    {
        $re = $this->dao->select("*")->from("zt_out")
            ->where('revtype')->eq('需要付费')
            ->andWhere('area')->notin(array('SC', "TW"))
            ->andWhere($where)
            
            ->orderBy("pay_desc," . $orderby)
            ->page($pager)
            ->fetchAll();
        $wheres = explode("WHERE", $this->dao->get());
        $wheres = explode("ORDER BY", $wheres[1]);
        $orderbys = explode("limit", $wheres[1]);
        $this->session->set('exportsampleout', $wheres[0]);
        $this->session->set('exportsampleoutorderby', $orderbys[0]);
        return $re;
    }
    function getallwareline()
    {
        $mp=$this->dao->select("sum(qty) as sum,device")->from('zt_mp')->where('deleted')->eq("0")->andWhere("qty")->gt(0)->andWhere('status')->eq('可送')->groupBy("device")->fetchAll('device');
        $sample=$this->dao->select("sum(inventry) as sum,device")->from('zt_sample')->where('deleted')->eq("0")->andWhere("inventry")->gt(0)->andWhere('note')->eq('1')->groupBy("device")->fetchAll('device');
        $last=array();
        foreach($mp as $k=>$v)
        {
            if(array_key_exists($k,$sample))
            {
                $mp[$k]->sum+=$sample[$k]->sum;
                unset($sample[$k]);
            }
        }
        $last=array_merge($mp,$sample);
        $mailstr=array();
        foreach($last as $k=>$v)
        {
            $partcontrol=$this->dao->select("num")->from("zt_partcontrol")->where("part")->eq($k)->fetch("num");
            $re=$this->getphase($k);
            if($re[0]=="p1" || $re[0]=='p2')
            {
                if($partcontrol and $partcontrol>0 and $v->sum < $partcontrol)
                {
                    $mailstr[$re[1]][$k]['str']=$k."样品库存已少于".$partcontrol;
                    $mailstr[$re[1]][$k]['qty']=$v->sum;
                }
                elseif($v->sum < 200)
                {
                    $mailstr[$re[1]][$k]['str']=$k."样品库存已少于200";
                    $mailstr[$re[1]][$k]['qty']=$v->sum;
                }
            }
            elseif($re[0]=="p4" || $re[0]=="p3")
            {
                if($partcontrol and $v->sum < $partcontrol and $partcontrol>0)
                {
                    $mailstr[$re[1]][$k]['str']=$k."样品库存已少于".$partcontrol;
                    $mailstr[$re[1]][$k]['qty']=$v->sum;
                }
                elseif($v->sum < 500)
                {
                    $mailstr[$re[1]][$k]['str']=$k."样品库存已少于500";
                    $mailstr[$re[1]][$k]['qty']=$v->sum;
                }
            }
        }
        include_once '../../lib/phpmailer/phpmailer.class.php';
        $jeanstr="";
        foreach($mailstr as $k=>$v)
        {

            $aestr="";
            foreach($v as $kk=>$vv)
            {
                if(strpos($kk,"SSL")!==false)continue;
                $aestr.="<tr><td>$kk</td><td>{$vv['qty']}</td><td>{$vv['str']}</td></tr>";
                $jeanstr.=$aestr;
            }
            $mail=new PHPMailer();
            $mail->CharSet="UTF-8";
            $mail->Encoding = "base64";
            date_default_timezone_set("Asia/Shanghai");
            //发送方设置
            $mail->IsSMTP();
            $mail->SMTPSecure = "ssl";
            $mail->SMTPAuth=true;
            $mail->Host="smtp.silergycorp.com";
            $mail->Port=465;

            $mail->Username="webmaster";
            $mail->Password="silergy#w2e3";

            $mail->From="webmaster@silergycorp.com";
            $mail->FromName="";
            //$mail->AddAddress("lisj12123@126.com","");
            //$mail->AddAttachment("d:/shopping_mylog.tar");//添加附件
            $ae=$this->getae($k);
            $mail->AddAddress($ae);
            $mail->IsHTML(true);

            $mail->Subject="样品库存警戒线通知";
            $mail->Body="<table cellspacing='0' cellpadding='0' border='1' width='500'>".$aestr."</table>";
            if(!$mail->Send())
            {
                echo "<p>邮件发送失败.</p><br />";
                var_dump($ae);
                echo "错误原因：".$mail->ErrorInfo;

            }
            else
            {
                echo "恭喜你 邮件发送成功！";
            }
            unset($mail);

        }
        $mail=new PHPMailer();
        $mail->CharSet="UTF-8";
        $mail->Encoding = "base64";
        date_default_timezone_set("Asia/Shanghai");
        //发送方设置
        $mail->IsSMTP();
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth=true;
        $mail->Host="smtp.silergycorp.com";
        $mail->Port=465;

        $mail->Username="webmaster";
        $mail->Password="silergy#w2e3";

        $mail->From="webmaster@silergycorp.com";
        $mail->FromName="";
        $mail->AddAddress("qin.chen@silergycorp.com");
        //$mail->AddAddress("lisj12123@126.com");
        $mail->IsHTML(true);

        $mail->Subject="样品库存警戒线通知Jean";
        $mail->Body="<table cellspacing='0' cellpadding='0' border='1' width='500'>".$jeanstr."</table>";
        if(!$mail->Send())
        {
            echo "<p>邮件发送失败.</p><br/>";
            echo "错误原因：".$mail->ErrorInfo;

        }
        else
        {
            echo "恭喜你 邮件发送成功！";
        }
        unset($mail);


    }
    function getphase($part)
    {
        $this->dao->connect10();
        $sql="select * from zt_wgcprorelease where partnumber = '$part' and deleted = '0'";
        $pro=mysql_query($sql);
        $pro=mysql_fetch_assoc($pro);
        if(!empty($pro['phase4']))
        {
            return array("p4",$pro['ae']);
        }
        elseif(!empty($pro['phase3']))
        {
            return array("p3",$pro['ae']);
        }
        elseif(!empty($pro['phase2']))
        {
            return array("p2",$pro['ae']);
        }
        elseif(!empty($pro['phase1']))
        {
            return array("p1",$pro['ae']);
        }
        else
        {
            return false;
        }
    }
    function getae($ae)
    {
        if(array_key_exists($ae,$this->lang->sampleout->aemail))
        {
            return $this->lang->sampleout->aemail[$ae];
        }
        else
        {
            foreach($this->lang->sampleout->aemail as $k=>$v)
            {
                if(strpos($k,$ae)!==false or strpos(strtolower($k),strtolower($ae))!==false)
                {
                    return $v;
                    break;
                }

            }
        }
    }

    //执行拒绝申请方法
    function getRefuse($id)
    {
        //原生查询
        // $pdo = new PDO('mysql:host=localhost;dbname=sample;charset=utf8', 'root', '123456');
        // $sql="UPDATE `zt_out` SET `close` = 'refuse' WHERE `id` = ".$id;
        // $res = $pdo->exec($sql);

        //dao方法
        $data = array("close"=>"refuse");
        $res=$this->dao->update("zt_out")->data($data)->where('id','=',$id)->exec();//返回受影响的条数
        if ($res) {
            return true;
        } else {
            return false;
        }

    }

    //查看权限
    function getPriv($groups)
    {
        $arr = array();
        $res = $this->dao->select("`method`")
            ->from("`zt_grouppriv`")
            ->where("`module`")->eq("sampleout")
            ->andwhere("`group`")->eq($groups)
            ->fetchAll();
        if ($res) {
            for ($i=0; $i < count($res) ; $i++) {
                $arr[$i] = $res[$i]->method;
            }
            $res = $arr;
        } else {
            $res = false;
        }

        return $res;
    }
}