<?php include "../../common/view/header.lite.html.php";?>
<style>
table td{text-align:center;}
</style>
<form class='form-condensed'>
<table class='table table-data table-condensed table-border' style="padding-bottom:100px;">
<tr>
	<td><?php echo html::commonButton("量产主数据模板","onclick=downtemplate(1);")?>&nbsp;&nbsp;</td>
	<td><?php echo html::commonButton("量产入库模板","onclick=downtemplate(2);")?>&nbsp;&nbsp;</td>
	<td><?php echo html::commonButton("量产出库模板","onclick=downtemplate(3);")?>&nbsp;&nbsp;</td>
</tr>
<tr>
	<td><?php echo html::commonButton("样品主数据模板","onclick=downtemplate(4);")?>&nbsp;&nbsp;</td>
	<td><?php echo html::commonButton("样品入库模板","onclick=downtemplate(5);")?>&nbsp;&nbsp;</td>
	<td><?php echo html::commonButton("样品出库模板","onclick=downtemplate(6);")?>&nbsp;&nbsp;</td>
</tr>
</table>
</form>
<script type="text/javascript">
function downtemplate(e)
{
	location.href="<?php echo $this->createLink('admin','template');?>"+"&id="+e;
}
</script>
<?php include "../../common/view/footer.lite.html.php";?>