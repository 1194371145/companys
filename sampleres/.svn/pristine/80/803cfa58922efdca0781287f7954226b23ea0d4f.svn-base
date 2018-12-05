<?php  include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<style type="text/css">
#userList{margin-top:0px;}
#featurebar{margin-bottom:0px;}
</style>
<script language='Javascript'>
var browseType = '<?php echo $browseType;?>';
</script>
<div id='featurebar'>
  <ul class='nav'>
    <li id='bysearchTab'><a href='#'><i class='icon-search icon'></i>&nbsp;搜索</a></li>
  </ul>
  <div class='actions'>
    <?php common::printLink('mp', 'exportresult',"", "<font color='red'><b>导出数据</b></font>","hiddenwin");?>
  </div>
  <div id='querybox' class='<?php if($browseType == 'bysearch') echo 'show';?>'><?php echo $searchForm;?></div>
</div>
<table class='table table-condensed table-hover table-striped tablesorter table-fixed' id='userList'>
<thead>
<?php $vars="selecttype=$selecttype&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";?>
<tr class="colhead">
<th style="width:2.5%;"><?php common::printOrderLink('id', $orderBy, $vars, "ID")?></th>
<th style="width:5%;"><?php common::printOrderLink('no', $orderBy, $vars, "位置");?></th>
<th><?php common::printOrderLink('device', $orderBy, $vars, "PartN");?></th>
<th><?php common::printOrderLink('Package', $orderBy, $vars, "Package");?></th>
<th><?php //common::printOrderLink('wafer_code', $orderBy, $vars, "wafer_code");?>Wafer_code</th>
<th><?php //common::printOrderLink('release_code', $orderBy, $vars, "Release_code");?>Release_code</th>
<th><?php common::printOrderLink('company', $orderBy, $vars, "Company");?></th>
<th><?php //common::printOrderLink('top_mark', $orderBy, $vars, "Top_mark");?>Top_mark</th>
<th><?php //common::printOrderLink('wafer_lot', $orderBy, $vars, "Conn");?>Conn</th>
<th><?php common::printOrderLink('qty', $orderBy, $vars, "Qty");?></th>
<th><?php common::printOrderLink('date', $orderBy, $vars, "Date");?></th>
<th><?php common::printOrderLink('remark', $orderBy, $vars, "备注");?></th>
<th><?php common::printOrderLink('status', $orderBy, $vars, "状态");?></th>
<th><?php common::printOrderLink('createdate', $orderBy, $vars, "Createdate");?></th>
<th style="width:4.5%;"><?php common::printOrderLink('openby', $orderBy, $vars, "Openby");?></th>
<th style="width:5.8%;">操作</th>
</tr>
</thead>
<tbody>
<?php foreach($mps as $key=>$value){?>
<tr align="center">
<td title="<?php echo $value->id;?>"><?php echo html::a($this->createLink('mp','viewmp',"id={$value->id}"),sprintf("%03d",$value->id));?></td>
<td title="<?php echo $value->no;?>"><?php echo $value->no;?></td>
<td style="text-align:left;" title="<?php echo $value->device;?>"><?php echo html::a($this->createLink('mp','viewmp',"id={$value->id}"),$value->device);?></td>
<td style="text-align:left;" title="<?php echo $value->package;?>"><?php echo $value->package;?></td>
<td title="<?php echo $value->wafer_code;?>"><?php echo $value->wafer_code;?></td>
<td title="<?php echo $value->release_code;?>"><?php echo $value->release_code;?></td>
<td title="<?php echo $value->company;?>"><?php echo $value->company;?></td>
<td title="<?php echo $value->top_mark?>"><?php echo $value->top_mark;?></td>
<td style="text-align:left;" title="<?php echo $value->wafer_lot;?>"><?php echo $value->wafer_lot;?></td>
<td title="<?php echo $value->qty;?>"><?php echo $value->qty;?></td>
<td title="<?php echo $value->date?>"><?php echo $value->date;?></td>
<td title="<?php echo $value->remark;?>"><?php echo $value->remark;?></td>
<td title="<?php echo $value->status;?>" <?php if($value->status=='可送'){echo "style='background-color:green;'";}else{ echo "style='background-color:red;'";}?>><?php echo $value->status;?></td>
<td title="<?php echo $value->createdate;?>"><?php echo $value->createdate;?></td>
<td title="<?php echo $value->openby;?>"><?php echo $value->openby;?></td>
<td>
<?php 
if(common::hasPriv("mp", "viewmp")){echo html::a($this->createLink('mp','viewmp',"id={$value->id}"),"详细");}
if(common::hasPriv("mp", "editmp")){echo html::a($this->createLink('mp','editmp',"id={$value->id}"),"编辑");}
if(common::hasPriv("mp", "deletemp"))
{
 	//echo html::a($this->createLink('mp','deletemp',"id={$value->id}"),"删除");
	$deleteURL = $this->createLink('mp', 'deletemp', "id=$value->id&confirm=yes");
	echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"userList\",\"你确定要删除吗\")", '删除', '', "class='btn-icon'");
}
?>
</td>
</tr>
<?php }?>
</tbody>
<tfoot>
<tr><td colspan="16" align="right"><?php echo $pager->show();?></td></tr>
</tfoot>
</table>
</script>
<?php  include '../../common/view/footer.html.php';?>