<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/colorbox.html.php';?>
<?php include "../../common/view/chosen.html.php";?>
<form action="" enctype='multipart/form-data' method="post" target="hiddenwin" style="border:none;">
<table class='table table-condensed table-hover table-striped tablesorter table-datatable' style="width:100%;align:center;">
<tr>
<th>Date</th>
<td ><?php echo html::select("circle",array('2018'=>"2018",'2019'=>"2019",'2020'=>"2020"),'2018',"style='width:30%;height:40px;' onblur=getproandpack(this)");?></td>
</tr>
<?php 
 $ty = $this->dao->select('realname,account')->from('zt_user')->fetchPairs('account','realname');//var_dump($ty);die;
?>
<tr><th>Staff</th><td width="90%"><?php echo html::selectlsj("user[]",$ty,'',"style='width:100%' multiple='multiple'");?></td></tr>
<tr><td colspan="2" align="center"><?php echo html::submitButton('提交');?></td></tr>
</table>
</form>
<script type="text/javascript">
$("#user").attr('data-placeholder', "选择员工,不选择则默认选择全部员工");
$("#user").chosen();
</script>
<?php include '../../common/view/footer.lite.html.php';?>