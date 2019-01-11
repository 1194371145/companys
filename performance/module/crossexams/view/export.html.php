<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/colorbox.html.php';?>
<?php include "../../common/view/chosen.html.php";?>
<form action="" enctype='multipart/form-data' method="post" target="hiddenwin" style="border:none;">
<table class='table table-condensed table-hover table-striped tablesorter table-datatable' style="width:100%;align:center;">
<tr>
<th>Circle</th>
<td ><?php echo html::select("circle",array('20181'=>"20181H",'20172'=>"20172H",'20171'=>"20171H"),'20172',"style='width:20%;height:30px;' onblur=getproandpack(this)");?></td>
</tr>
<?php 
 $ty = $this->dao->select('manager,sid')->from('zt_crossexams')->fetchPairs('sid','manager');//var_dump($ty);die;
?>
<tr><th>Manager</th><td width="80%"><?php echo html::selectlsj("user[]",$ty,'',"style='width:100%' multiple='multiple'");?></td></tr>
<tr><td colspan="2" align="center"><?php echo html::submitButton('提交');?></td></tr>
</table>
</form>
<script type="text/javascript">
$("#user").attr('data-placeholder', "选择员工,不选择则默认选择全部员工");
$("#user").chosen();
</script>
<?php include '../../common/view/footer.lite.html.php';?>