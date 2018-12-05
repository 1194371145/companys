<?php
include "../../common/view/header.html.php";
include '../../common/view/treeview.html.php';

?>
<style type="text/css">
*{padding:0px;margin:0px;}
#userList{margin-top:0px;font-size:10px;;text-align:center;}
#featurebar{margin-bottom:0px;}
#userList tbody tr td{font-size:10px;margin:0px;padding:0px;}
#userList tbody tr{font-size:10px;margin:0.5px;padding:0px;}
#userList tbody form tr td input{font-size:10px;margin:0px;padding:0px;}
#userList tbody form tr td{font-size:10px;margin:0px;padding:0px;}
#userList tbody form tr{font-size:10px;margin:0.5px;padding:0px;}
#userList tbody form{font-size:10px;margin:0px;padding:0px;}
.input{width:100%;height:26px;}
#anniu{background-color:#1A4F85;padding:1.5px;border:none;color:white;font-size:10px;margin:6px 0px 6px 0px;}
#anniu:visited,#anniu:hover,#anniu:link,#anniu:active{color:white;}
#anniu:visited{background-color:black;}

.btn_refuse{padding:1.5px;border:none;font-size:10px;margin:6px 0px 6px 0px;z-index:100}
.btn_refuse:hover,.btn_refuse:link,.btn_refuse:active{color:white;}


</style>
<script language='Javascript'>
var browseType = '<?php echo $browseType;?>';
</script>
<div id='featurebar'>
  <ul class='nav'>
    <li id='bysearchTab'><a href='#'><i class='icon-search icon'></i>&nbsp;搜索</a></li>
  </ul>
  <div class='actions'>
    <?php common::printLink('sampleout', 'exportout',"", "<font color='red'><b>导出数据</b></font>","hiddenwin");?>
  </div>
  <div id='querybox' class='<?php if($browseType == 'bysearch') echo 'show';?>'><?php echo $searchForm;?></div>
</div>
<table class="table table-condensed  table-striped tablesorter table-fixed" id='userList'>
<thead>
<tr><?php $vars="type=$type&param=$param&orderBy=%s&recTotal=$pager->recTotal&recPerPage=$pager->recPerPage&pageID=$pager->pageID";?>
<th style="width:20px;"></th>
<th style="width:40px;"><?php common::printOrderLink("id", $orderBy, $vars, "ID");?></th>
<th style="width:54px;"><?php common::printOrderLink("person", $orderBy, $vars, "申请人");?></th>
<th style="width:70px;"><?php common::printOrderLink("rdate", $orderBy, $vars, "申请时间");?></th>
<th style="width:198px;"><?php common::printOrderLink("remark", $orderBy, $vars, "Remark");?></th>

<th style="width:65px;"><?php common::printOrderLink("rtype", $orderBy, $vars, "Rtype");?></th>

<th style="width:90px;"><?php common::printOrderLink("partn", $orderBy, $vars, "PartN");?></th>
<!--
<th style="width:99px;"><?php common::printOrderLink("package", $orderBy, $vars, "Pack");?></th>
-->
<th style="width:90px;"><?php common::printOrderLink("endname", $orderBy, $vars, "End");?></th>
<th style="width:90px;"><?php common::printOrderLink("distributor", $orderBy, $vars, "Dis");?></th>
<th style="width:65px;"><?php common::printOrderLink("projectname", $orderBy, $vars, "Project");?></th>
<th style="width:50px;"><?php common::printOrderLink("stage", $orderBy, $vars, "Stage");?></th>
<th style="width:55px;"><?php common::printOrderLink("qty", $orderBy, $vars, "申请量");?></th>
<th style="width:55px;"><?php common::printOrderLink("aqty", $orderBy, $vars, "发货量");?></th>
<th style="width:45px;"><?php common::printOrderLink("price", $orderBy, $vars, "Price");?></th>
<th style="width:45px;"><?php common::printOrderLink("rev", $orderBy, $vars, "Rev");?></th>
<th style="width:100px;"><?php common::printOrderLink("shiporder", $orderBy, $vars, "ShipOrder");?></th>
<th style="width:70px;"><?php common::printOrderLink("shipdate", $orderBy, $vars, "ShipDate");?></th>
<th style="width:50px;"><?php common::printOrderLink("area", $orderBy, $vars, "区域");?></th>
<th style="width:50px;"><?php common::printOrderLink("revtype", $orderBy, $vars, "费用");?></th>
<th><?php common::printOrderLink("mid", $orderBy, $vars, "主数据");?></th>
<th style="width:45px;"><?php common::printOrderLink("close", $orderBy, $vars, "状态");?></th>
<th style="width:130px;">操作</th>
</tr>
</thead>
<form action="<?php echo $this->createLink("sampleout","signpay");?>" method="post" enctype='multipart/form-data' target="hiddenwin">
<tbody>
<?php foreach($out as $v){?>
		<tr class='input'>
		<td><?php if($v->pay=='wait'){?><input type='checkbox' value='<?php echo $v->id;?>' name='pay[]'/><?php }?></td>
		<td><?php echo sprintf("%03d",$v->id);?>
		<td><?php echo $v->person;?></td>
		<td><?php echo $v->rdate;?></td>
		<td title="<?php echo $v->remark;?>"><?php echo $v->remark;?></td>
		
		<td><?php echo $v->rtype;?></td>
		
		<td title="<?php echo $notpart[$v->partn];?>"><?php echo $v->partn;?></td>
		<!--
		<td><?php echo $v->package;?></td>
		-->
		<td><?php echo $v->endname;?></td>
		<td><?php echo $v->distributor;?></td>
		<td><?php echo $v->projectname;?></td>
		<td><?php echo $v->stage;?></td>
		<td><?php echo $v->qty;?></td>
		<td><?php echo $v->aqty;?></td>
		<td><?php echo $v->price;?></td>
		<td><?php echo $v->rev;?></td>
		<td><?php echo $v->shiporder;?></td>
		<td><?php echo $v->shipdate;?></td>
		<td><?php echo $v->area;?></td>
		<td><?php echo $v->revtype;?></td>
		<td>
		<?php 
				if($v->type=="1")
				{
					$no=$this->dao->select('no')->from('zt_mp')->where('id')->eq($v->mid)->fetch('no');
					echo html::a($this->createLink('mp','viewmp',"id=$v->mid"),$lang->sampleout->type[$v->type].$no);
				}
				elseif($v->type=='2')
				{
					$no=$this->dao->select('packagetype,date')->from('zt_sample')->where('id')->eq($v->mid)->fetch();
					echo html::a($this->createLink('sample','viewsample',"id=$v->mid"),substr($lang->sampleout->type[$v->type],0,2,'UTF-8').date("y/n/j",strtotime($no->date)).$no->packagetype);
				}
				elseif($v->type=='3')
				{
					echo html::a("",$lang->sampleout->type[$v->type]);
				}
		?>
		</td>
		<td><?php echo $lang->sampleout->close[$v->close];?></td>
		<td align="justify" style="text-align:right;">
		<?php echo html::a($this->createLink('sampleout','viewout',"id=$v->id"),'详情',"","id='anniu'");?>
		</td>
		</tr>		
<?php  }?>
</tbody>
<tfoot>
<tr><td colspan='11' align='left'><?php echo html::commonButton("全选","onclick='quanxuan();'"); ?>
								  <?php echo html::commonButton("反全选","onclick='fanquanxuan();'"); ?>
								  <?php echo html::submitButton('批量标示付费');?>
	</td>
	<td colspan='11'><?php echo $pager->show();?></td>
</tr>
</tfoot>
</form>
</table>
<script type="text/javascript">
function quanxuan()
{
	var t=$("[type='checkbox']");
	t.each(function(e){
		this.checked='checked';
		});
}
function fanquanxuan()
{
	var t=$("[type='checkbox']");
	t.each(function(e){
		if(this.checked)
		{
			this.checked='';
		}
		else
		{
			this.checked='checked';
		}
		});
}
//拒绝申请
// function refuse()
// {
// 	console.log(this.('#rid'));
// }
</script>
<?php include "../../common/view/footer.html.php";?>
