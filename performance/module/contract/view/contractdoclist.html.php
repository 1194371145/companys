<?php 
include '../../common/view/header.html.php';
include '../../common/view/tablesorter.html.php';
?>
<style>
	#contractlist thead tr th{text-align:left;}
	#contractTop ul li{list-style: none;}
    #contractTop{margin: -22px -20px 20px;
        padding: 0px 10px 7px; font-size: 14px;height:50px;  background: #ebf1f9;border-bottom: 1px solid #ddd;  line-height: 30px;margin-bottom:10px;}
  .nav li{float:left;}
  .nav li a{padding: 10px 10px;}
  .nav .active a{color:#1e232f!important;font-weight: bold;}
</style>
<script language='Javascript'>
var browseType = '<?php echo $browseType;?>';
</script>
<div id='contractTop'>
	<ul class='nav' style='background:#ebf1f9;height:44px;'>
    <li id='bysearchTab'><a href='#' style='height:44px;'><i class='icon-search icon'></i>&nbsp;Search</a></li>
	</ul>
</div>
<div id='querybox' style="margin-top:0px;" class="<?php if($type=='bySearch'){echo "show";}?>"><?php echo $searchForm?></div>
  <table class='table table-striped table-bordered table-hover' id='contractlist'>
  	<thead>
    <tr>
      <th>编号  <br/>(No.)</th>
      <th>申请人 <br/>(SID)</th>
      <th>类型 <br/>(Contract Type)</th>
      <th>合约会审单编号生效版 <br/>(Contract End Control)</th>
      <th>合约会审单编号会审版 <br/>(Contract Control)</th>
      <th  style='width:5%;'>合同起迄时间 <br/>(Time Periods)</th>
      <th>合同名称 <br/>(Contract Object)</th>
      <th>对方 <br/>(Other Company)</th>
      <th>公司方 <br/>(Company)</th>
      <th style='width:25%;'>内容摘要 <br/>(Main Content)</th>
      <th style='width:4%;'>状态 <br/>(Status)</th>
      <th>备注 <br/>(Remark)</th>
      <th style='width:17%;'>操作 <br/>(Action)</th>
    </tr>
  	</thead>
      <tbody>
        <?php $j=1; foreach ($datas as $v) { ?>
          <tr>
            <td><?php echo $j;?></td>
            <td><?php echo $v->account; ?></td>
            <td><?php echo $this->lang->contract->type[$v->type]; ?></td>
            <td><?php echo $v->endcontrol; ?></td>
            <td><?php echo $v->control; ?></td>
            <td><?php echo $v->startime;?><br/><?php echo $v->endtime; ?></td>
            <td><?php echo $v->title; ?></td>
            <td><?php echo $v->otherparty; ?></td>
            <td><?php echo $this->lang->contract->company; ?></td>
            <td><?php echo $v->maincontent; ?></td>
            <td>
              <?php 
              if ($v->over == '2') {echo "<span style='color:blue;'>等待会审</span>";}
              if ($v->over == '3') {echo "<span style='color:red;'>需要修改</span>";}
              if ($v->over == '4') {echo "<span style='color:red;'>被拒绝</span>";}
              if ($v->over == '5') {echo "<span style='color:blue;'>会审中</span>";}
              if ($v->over == '1' and empty($v->legalapprove)) {echo "<span style='color:green;'>会审已通过待法务签字汇总</span>";}
              if ($v->over == '1' and !empty($v->legalapprove)) {echo "<span style='color:green;'>会审完成</span>";}
              ?>
            </td>
            <td><?php echo $v->remark; ?></td>
            <td>
              <?php // 编辑self
              if ($this->app->user->account == $v->account || $this->app->user->account == 'admin') 
              {
              echo html::a($this->inLink('editself',"id=$v->id"),'编辑','',"style='color:rgb(66,133,244)!important'"); 
              } 
              ?>
              <?php // 法务
              if ($justice || $this->app->user->account == 'admin')
              {
              echo html::a($this->inLink('editfawu',"id=$v->id"),'法务','',"style='color:rgb(234,67,53)!important';"); 
              } 
              ?>
              <?php // 会审
              if (strpos($huishen_str,$v->id) !== false || $this->app->user->account == 'admin')
              {
              echo html::a($this->inLink('edithuishen',"id=$v->id"),'会审','',"style='color:rgb(52,168,83)!important'");
              } 
              ?>

              <?php if ($this->app->user->account == $v->account || $this->app->user->account == 'admin') 
              { 
                echo html::a($this->inLink('delete',"id=$v->id"),'Delete','hiddenwin',"style='float:right;color:#fff!important;' class='btn btn-danger btn-xs'");
              }
              ?>
              <?php echo html::a($this->inLink('viewfile',"fid=$v->fileid"),'查看附件','_blank',"style='float:right;margin-right:5px;color:#fff!important;' class='btn btn-primary btn-xs'") ?>
              <?php if(($justice || $HR || $this->app->user->account == 'admin') && !empty($v->endcontrol)) 
              {
              echo html::a($this->inLink('contractpdf',"id=$v->id"),'导出合约pdf','',"style='float:right;margin-right:5px;color:#fff!important;' class='btn btn-success btn-xs'");
              } 
              ?>
            </td>
          </tr>
        <?php $j++; } ?>
      </tbody>
  </table>
  <div><?php $pager->show();?></div>




<?php include '../../common/view/footer.html.php';?>
