<?php include "../../common/view/header.html.php";?>
<?php include '../../common/view/tablesorter.html.php';?>
<div id='featurebar'>
<ul class='nav'>
    <li id='bysearchTab'><a href='#'><i class='icon-search icon'></i>&nbsp;Search</a></li>
  </ul>
<div class='actions'>
<?php common::printLink('sampleapp','exportdatademo',"type=All",'<b style="font-weight:bold;color:red;">Export All Data</b>');?>
&nbsp;&nbsp;
<?php common::printLink('sampleapp','exportdatademo',"type=re",'<b style="font-weight:bold;color:red;">Export Data</b>');?>
</div>
<div id='querybox' class='<?php if($type == 'search'){ echo 'show';}?>'><?php echo $searchForm;?></div>
</div>
<script language='Javascript'>
var browseType = '<?php echo $browseType;?>';
</script>
<style type="text/css">
#wgcfixedtheadoflist{margin-top:-20px;}
#wgcfixedtheadoflist th,#wgcfixedtheadoflist.td{text-align:left;}
</style>
<table class='table table-condensed  table-striped tablesorter table-fixed' style="overflow:auto;" id='wgcfixedtheadoflist'>
<thead>
<tr>
<th>Action</th>
<th>Name</th>
<th>RequestDate</th>
<th>partnumber</th>
<th>Mapping</th>
<th>Proline</th>
<th>AE</th>
<th>EndName</th>
<th>DisName</th>
<th>Quantity</th>
<th>area</th>
<th>ShipOrder</th>
<th>ShipDate</th>
<th>Status</th>
<th>Pre_shipdate</th>
<th>DempType</th>
<th>File</th>
<th>Remark</th>
</tr>
</thead>
<tbody>
<?php 
foreach($samplelist as $v)
{
?>
<tr>
		<td><?php common::printLink('sampleapp','getsample',"id={$v->id}","<font color='red'><b>View</b></font>");?>
		&nbsp;
			<?php common::printLink('sampleapp','editdemo',"id={$v->id}","<font color='red'><b>Edit</b></font>","","class='editdemo'");?>
		</td>
		<td title="<?php echo $v->person;?>"><?php echo $v->person;?></td>
		<td title="<?php echo $v->rdate;?>"><?php echo $v->rdate;?></td>
		<td title="<?php echo $v->partn;?>"><?php echo $v->partn;?></td>
		<td title="<?php echo $v->mapping;?>"><?php echo $v->mappingfrom;?></td>
		<td title="<?php echo $v->proline;?>"><?php echo $v->proline;?></td>
		<td title="<?php echo $v->ae;?>"><?php echo $v->ae;?></td>
		<td title="<?php echo $v->endname;?>"><?php echo $v->endname;?></td>
		<td title="<?php echo $v->distributor;?>"><?php echo $v->distributor;?></td>
		<td title="<?php echo $v->qty;?>" style="text-align:center;"><?php echo $v->qty;?></td>
		<td title="<?php echo $v->area;?>"><?php echo $v->area;?></td>
		<td title="<?php echo $v->shiporder;?>"><?php echo $v->shiporder;?></td>
		<td title="<?php echo $v->shipdate;?>"><?php echo $v->shipdate;?></td>
		<td><?php 
		if($v->close=='wait'){echo "<b style='color:red;'>Not shipped</td>";}
		if($v->close=='done'){echo "<b style='color:green;'>shipped</b>";}
		?></td>
		<td title="<?php echo $v->preshipdate;?>"><?php echo $v->preshipdate;?></td>
		<td title="<?php echo $v->demotype;?>"><?php echo $v->demotype;?></td>
		<td><?php if($v->demotype=='customized'){echo html::a($this->createLink('sampleout',"downloaddemofile","demoid=$v->id"),"<b style='color:blue;'>Download</b>");}?></td>
		<td title="<?php echo $v->remark;?>"><?php echo $v->remark;?></td>
</tr>
<?php 
}
?>
<tbody>
<tfoot>
<tr><td colspan="18" style="text-align:right;"><?php echo $pager->show();?></td></tr>
</tfoot>
</table>

<script type="text/javascript">
function setsubmenuexportbusinessplan111(){if($(".editdemo").size()){$(".editdemo").colorbox({width:760,height:200,iframe:true,transition:"elastic",speed:350,scrolling:true})}}
$(function(){setsubmenuexportbusinessplan111();});
</script>
<?php include "../../common/view/footer.html.php";?>
