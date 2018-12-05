<?php  include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<style type="text/css">
#userList{margin-top:0px;}
#featurebar{margin-bottom:0px;}
.wait{color:red;font-style:italic;}
</style>
<script language='Javascript'>
var browseType = '<?php echo $browseType;?>';
</script>
<div id='featurebar'>
  <ul class='nav'>
    <li id='bysearchTab'><a href='#'><i class='icon-search icon'></i>&nbsp;搜索</a></li>
  </ul>
  <div class='actions'>
    <?php common::printLink('sample', 'export',"", "<font color='red'><b>导出数据</b></font>","hiddenwin");?>
  </div>
  <div id='querybox' class='<?php if($browseType == 'bysearch') echo 'show';?>'><?php echo $searchForm;?></div>
</div>
<table class='table table-condensed table-hover table-striped tablesorter table-fixed' id='userList'>
<thead>
<?php $vars="type=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";?>
<tr class="colhead">
<th style="width:3.5%;"><?php common::printOrderLink('id', $orderBy, $vars, "ID")?></th>
<th style="width:5%;"><?php common::printOrderLink('pe', $orderBy, $vars, "PE");?></th>
<th><?php common::printOrderLink('status', $orderBy, $vars, "Status");?></th>
<th><?php common::printOrderLink('project', $orderBy, $vars, "Project");?></th>
<th><?php //common::printOrderLink('wafer_code', $orderBy, $vars, "WFCode");?>WFCode</th>
<th><?php common::printOrderLink('options', $orderBy, $vars, "Options");?></th>
<th><?php common::printOrderLink('device', $orderBy, $vars, "PartN");?></th>
<th><?php common::printOrderLink('mark', $orderBy, $vars, "Mark");?></th>
<th><?php common::printOrderLink('package', $orderBy, $vars, "Package");?></th>
<th><?php common::printOrderLink('qty', $orderBy, $vars, "Qty");?></th>
<th><?php common::printOrderLink('inventry', $orderBy, $vars, "Inventry");?></th>
<th><?php common::printOrderLink('ordert', $orderBy, $vars, "Ordert#");?></th>
<th><?php common::printOrderLink('factory', $orderBy, $vars, "Factory");?></th>
<th><?php common::printOrderLink('packagetype', $orderBy, $vars, "包装");?></th>
<th><?php common::printOrderLink('waferlot', $orderBy, $vars, "WaferLot");?></th>
<th><?php echo "片号";?></th>
<th><?php common::printOrderLink('date', $orderBy, $vars, "ArrDate");?></th>
<th><?php common::printOrderLink('test', $orderBy, $vars, "Test");?></th>
<th><?php common::printOrderLink('note', $orderBy, $vars, "Note");?></th>
<th><?php common::printOrderLink('remark', $orderBy, $vars, "Remark");?></th>
<th><?php common::printOrderLink('createdate', $orderBy, $vars, "Create");?></th>
<th style="width:4.5%;"><?php common::printOrderLink('openby', $orderBy, $vars, "Openby");?></th>
<th style="width:5.8%;">操作</th>
</tr>
</thead>
<tbody>
<?php foreach($samples as $key=>$value){?>
<tr align="center" <?php if($value->approve=='wait'){echo "class='wait'";}?>>
<td title="<?php echo $value->id;?>"><?php echo html::a($this->createLink('sample','viewsample',"id={$value->id}"),sprintf("%03d",$value->id));?></td>
<td title="<?php echo $value->pe;?>"><?php echo $value->pe;?></td>
<td style="text-align:left;" title="<?php echo $value->status;?>"><?php echo $value->status;?></td>
<td style="text-align:left;" title="<?php echo $value->project;?>"><?php echo $value->project;?></td>
<td title="<?php echo $value->wafer_code;?>"><?php echo $value->wafer_code;?></td>
<td title="<?php echo $value->options;?>"><?php echo $value->options;?></td>
<td title="<?php echo $value->device;?>"><?php echo html::a($this->createLink('sample','viewsample',"id={$value->id}"),$value->device);?></td>
<td title="<?php echo $value->mark?>"><?php echo $value->mark;?></td>
<td style="text-align:left;" title="<?php echo $value->package;?>"><?php echo $value->package;?></td>
<td title="<?php echo $value->qty;?>"><?php echo $value->qty;?></td>
<td title="<?php echo $value->inventry?>"><?php echo $value->inventry;?></td>
<td title="<?php echo $value->ordert?>"><?php echo $value->ordert;?></td>
<td title="<?php echo $value->factory;?>"><?php echo $value->factory;?></td>
<td title="<?php echo $value->packagetype;?>"><?php echo $value->packagetype;?></td>
<td title="<?php echo $value->waferlot;?>"><?php echo $value->waferlot;?></td>
<td title="<?php echo $value->ids;?>"><?php echo $value->ids;?></td>
<td title="<?php echo $value->date;?>"><?php echo $value->date;?></td>
<td title="<?php echo $value->test;?>"><?php echo $value->test;?></td>
<td title="<?php echo $value->note;?>" <?php if(strpos($value->note,"1")!==false){echo "style='background-color:green;'";}?>><?php echo $value->note;?></td>
<td title="<?php echo $value->remark;?>"><?php echo $value->remark;?></td>
<td title="<?php echo $value->createdate;?>"><?php echo $value->createdate;?></td>
<td title="<?php echo $value->openby;?>"><?php echo $value->openby;?></td>
<td>
<?php 
if(common::hasPriv("sample", "viewsample")){echo html::a($this->createLink('sample','viewsample',"id={$value->id}"),"详细");}
if(common::hasPriv("sample", "editsample")){echo html::a($this->createLink('sample','editsample',"id={$value->id}"),"编辑");}
if(common::hasPriv("sample", "deletesample"))
{
 	//echo html::a($this->createLink('mp','deletemp',"id={$value->id}"),"删除");
	$deleteURL = $this->createLink('sample', 'deletesample', "id=$value->id&confirm=yes");
	echo html::a("javascript:ajaxDelete(\"$deleteURL\",\"userList\",\"你确定要删除吗\")", '删除', '', "class='btn-icon'");
}
?>
</td>
</tr>
<?php }?>
</tbody>
<tfoot>
<tr><td colspan="23" align="right"><?php echo $pager->show();?></td></tr>
</tfoot>
</table>
</script>
<?php  include '../../common/view/footer.html.php';?>