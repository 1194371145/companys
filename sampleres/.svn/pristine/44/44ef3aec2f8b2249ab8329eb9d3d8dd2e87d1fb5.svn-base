<?php
/**
 * The control file of project module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2012(QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     project
 * @version     $Id: control.php 2657 2012-02-23 01:46:06Z shiyangyangwork@yahoo.cn $
 * @link        http://www.zentao.net
 */
class sampleappModel extends model
{
    /* The members every linking. */
    const LINK_MEMBERS_ONE_TIME = 20;

    /** sample list view 的model层
     * @where    查询条件
     * @pager    分页参数
     * @orderBy  排序
     * @area     所属区域
     * @name     登录人的account名
     */
    public function getlist($where,$pager,$orderby,$area,$name,$region = '')
    {
      if ($area == 'all')
      {
          return $this->dao->select("*")->from("`zt_out`")
              ->where($where)
              ->orderBy($orderby)
              ->page($pager)
              ->fetchAll();
      } elseif ($area == 'self') 
      {
          return $this->dao->select('*')->from("`zt_out`")
              ->where($where)
              ->beginIF($name == 'reffert')
              ->andWhere('openby')->in(array($name,'craig'))
              ->fi()
			  ->beginIF($name != 'reffert')
              ->andWhere('openby')->in(array($name))
              ->fi()
              ->orderBy($orderby)
              ->page($pager)
              ->fetchAll();
      } else 
      {
          return $this->dao->select('*')->from("`zt_out`")
              ->where($where)
              ->andwhere('(area')->eq($area)
              ->orwhere('openby')->eq($name)
              ->markRight(1)
              ->orderBy($orderby)
              ->page($pager)
              ->fetchAll();
      }

    }

    /** demo list view 的model层
     * @where    查询条件
     * @pager    分页参数
     * @orderBy  排序
     * @area     所属区域
     * @name     登录人的account名
     */
    public function demoList($where,$pager,$orderby,$area,$name)
    {
      if ($area == 'all') 
      {
        return  $this->dao->select("*")->from("`zt_out`")
                          ->where($where)
                          ->orderBy($orderby)
                          ->page($pager)
                          ->fetchAll();
      } elseif ($area == 'self') 
      {
        return $this->dao->select('*')->from("`zt_out`")
                         ->where($where)
                         ->andWhere('openby')->eq($name)
                         ->orderBy($orderby)
                         ->page($pager)
                         ->fetchAll();
      } else 
      {
        return $this->dao->select('*')->from("`zt_out`")
                         ->where($where)
                         ->andwhere('(area')->eq($area)
                         ->orwhere('openby')->eq($name)
                         ->markRight(1)
                         ->orderBy($orderby)
                         ->page($pager)
                         ->fetchAll();
      }

    }


    //导入数据到数据库
    public function importout($data)
      {
          $where="";
          foreach($data as $k => $kk)
          {
              $where.="$k = '$kk' and ";
          }
          $where=substr($where,0,-5);
          $exist=$this->dao->select('id')->from('zt_out')->where($where)->fetch();
          if($exist->id > 0){return array('re'=>'repeat');}//统计重复的数据
          $this->dao->insert('zt_out')->data($data)->autoCheck("shipdate")
          ->check('partn','notempty')
          ->checkIF($data['revtype']=='需要付费','distributor',"notempty")
          ->checkIF($data['revtype']=='需要付费','price',"notempty")
          ->batchCheck('rdate,createdate','date')
          ->exec();
          if(dao::isError()){die(js::error(dao::getError()));}
          $id=$this->dao->lastInsertId();
          $actionID=$this->loadModel('action')->create("sampleout",$id,"importout"); //记录操作者的本次操作
          return array('re'=>'success');
      }

    //获取dis集合
   public function getDistributorArrsampleofhznj($pdo)
   {
      $sql = 'SELECT `cardcode`,`cardname`,`cardfname` FROM `zt_wgcdis` WHERE `cardcode` NOT LIKE "V%" and `validfor` = "Y" and `cardcode` not in("D00075") ORDER BY `cardcode`';
      $result = $pdo->query($sql);
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
      $arr = array();
      $arr[''] = '';
      for ($i=0; $i <count($data) ; $i++) { 
        $arr[$data[$i]['cardcode'].'-'.$data[$i]['cardname']] = $data[$i]['cardcode'].'-'.$data[$i]['cardname'];
      }
      return $arr;
   }

   //getallpart  获取sample数据库 无限制的集合
   function getallpart()
   {
       $mppart=$this->dao->select('device,id')->from('zt_mp')->where('deleted')->eq(0)->fetchPairs("device",'device');
       $samplepart=$this->dao->select('device,id')->from('zt_sample')->where('deleted')->eq(0)->fetchPairs("device",'device');
       $res=array_unique($mppart) + array_unique($samplepart);     
       return $res;
   }

   //获取mp和sample表中的所以part集合 三年之内的 关联insidesales
   function getallpartall($pdo)
   {
       $res = $this->getallpart();
       $sql = "SELECT * FROM `zt_wgcprorelease` WHERE `deleted` = '0' and `status` != 'killed'";
       $result = $pdo->query($sql);
       $data = $result->fetchAll(PDO::FETCH_ASSOC);//返回关联数组
       //生成3年前的时间戳   2017-11-14
       $time = strtotime("-3 year",strtotime($this->lang->sampleapp->date));
       //循环比较 unset时间超过3年的和不在part集合中的元素
       for ($i=0; $i < count($data); $i++) 
       {
           if (in_array($data[$i]['partnumber'], $res)) 
           {          
               if (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase4'],$result)) 
               {
                   if ($time > strtotime($result[0])) 
                   {
                       unset($res[$data[$i]['partnumber']]);
                   }
                   continue;
               } 
               elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase3'],$result)) 
               {
                   if ($time > strtotime($result[0])) 
                   {
                       unset($res[$data[$i]['partnumber']]);                        
                   }
                   continue;
               } 
               elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase2'],$result)) 
               {
                   if ($time > strtotime($result[0])) 
                   {
                       unset($res[$data[$i]['partnumber']]);                        
                   }
                   continue;
               } 
               elseif (preg_match("/\d{4}-\d{1,2}-\d{1,2}$/",$data[$i]['phase1'],$result)) 
               {
                   if ($time > strtotime($result[0])) 
                   {
                       unset($res[$data[$i]['partnumber']]);                       
                   }
                   continue;
               }                    
           } 
          
       }
       //返回合格的结果集
       return $res;
   }


   //查询sample的单条数据
   function getsample($id)
   {
    return $this->dao->select("*")->from('zt_out')->where('id')->eq($id)->fetch();
   }

   //执行单条数据的编辑操作
   function editdemo($data,$olddata)
   {
    $id=$data['id'];unset($data['id']);
    if(empty($data['shiporder'])){unset($data['shipdate']);unset($data['close']);}
    $re=$this->dao->update("zt_out")->data($data)->where('id')->eq($id)->exec();
    if($re)
    {
      if($data['close']=='done'){$ship="Shiped";}else{$ship='Edit';}$actionID=$this->loadModel('action')->create('sampleout',$id,$ship);
      if(common::createChanges($old, $data)) // 如果数据有改动 写入history表中
      {
        $this->action->logHistory($actionID,common::createChanges($olddata, $data));
      }
    }
    
   }


   //sample application 的save方法
   public function createout($data)
   {
    $data['rev']=$data['aqty']*$data['price'];
    $this->dao->insert('zt_out')->data($data)->autoCheck("shipdate")
    ->check('partn','notempty')
    ->checkIF($data['revtype']=='需要付费','distributor',"notempty")
    ->checkIF($data['revtype']=='需要付费','price',"notempty")
    ->batchCheck('rdate,createdate','date')
    ->exec();
    if(dao::isError()){die(js::error(dao::getError()));}
    $id=$this->dao->lastInsertId();
    $actionID=$this->loadModel('action')->create("sampleout",$id,"createout"); //申请操作的记录
    return array('re'=>'success');
   }


   /**
    * Save order 
    * 
    * @access public
    * @return void
    */
   public function save_order($pdo)
   {
       foreach($_POST as $projectID => $order)
       {
          //生成sql语句
          $sql = 'UPDATE `zt_custom` SET `order` = "'.$order.'" WHERE `id` = "'.$projectID.'"';
          $pdo->exec($sql);//执行update工作
          // $this->dao->update(WGC_TABLE_CUSTOM)->set('`order`')->eq($order)->where('id')->eq($projectID)->exec();
       }
   }


   //审核
   public function audit($id,$data)
   {
      if ($data['status'] == '2') 
      {
        $msg = '同意';
      } else {
        $msg = '拒绝';
      }
      unset($data['status']);  // 删除多余字段
      $old = (object)array();  // 申明老的数据用于做比较
      $olddata = $this->dao->select('approve,areamanager,salesmanager')->from('zt_out')->where('id')->eq($id)->fetch();
      if (!empty($data['areamanager'])) 
      {
        $old->areamanager=$olddata->areamanager;
      } else {
        if (empty($data['approve'])) 
        {
          $old->salesmanager=$olddata->salesmanager;
        } else {
          $old->salesmanager=$olddata->salesmanager;
          $old->approve=$olddata->approve;

        }
      }
      $re = $this->dao->update("zt_out")->data($data)->where('id')->eq($id)->exec();
      if ($re) 
      {
        $actionID = $this->loadModel('action')->create("sampleout",$id,$msg);
        if (common::createChanges($old,$data)) 
        {
          $this->action->logHistory($actionID,common::createChanges($old,$data));
        }
      }
      return $re;
   }

   public function mappingfrom()
   {
		$all=$this->dao->select("*")->from("zt_out")->where("rtype")->eq('demo')->andWhere('close')->eq('wait')->fetchAll();
		$notpart=$this->loadModel('sampleout')->notpart;
		foreach($all as $v)
	    {
			$mappingfrom=$notpart[$v->partn];
			$proline=$this->dao->select("proline")->from("zt_mp")->where("device")->eq($v->partn)->andWhere("deleted")->eq('0')->fetch("proline");
			if(!$proline)
			{
				$proline=$this->dao->select("proline")->from("zt_sample")->where("device")->eq($v->partn)->andWhere("deleted")->eq('0')->fetch("proline");
			}
			$ae=implode(",",$this->lang->sampleout->prolinedemo[$proline]);
			$this->dao->update("zt_out")->set("mappingfrom")->eq($mappingfrom)->set("proline")->eq($proline)->set("ae")->eq($ae)->where("id")->eq($v->id)->exec(); 
	    }
   }


   
}
