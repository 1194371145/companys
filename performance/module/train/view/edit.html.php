<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<style type="text/css">
.text-2{width:100%}
</style>
<div width="100%">
<form action="" method='post' enctype="multipart/form-data" target="hiddenwin" class='form-condensed'>
<table class='table  tablesorter table-datatable'  align='center'  class='table-5 a-left'>
<caption><?php echo $lang->train->edit_headline;?></caption>
<tr><th width="180px"><?php echo $lang->train->decument_class;?>:</th><td weight="190px"><?php echo $edit_model;?></td></tr>
<tr><th width="180px"><?php echo $lang->train->decument_title?>:</th><td><?php echo html::input('classname',$edit_title,"class='text-2'");?></td></tr>
</table>
<div style="text-align:center;"><td class='a-center'><?php echo html::submitButton() . html::resetButton();?></td></div>
</form>
</div>
<?php include "../../common/view/footer.lite.html.php";?>
