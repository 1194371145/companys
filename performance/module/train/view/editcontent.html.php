<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<style type="text/css">
.tt{width:100%}
</style>
<div style="border:1px solid #E5E5E5">
<form action="" method='post' enctype="multipart/form-data" target="blank">
<table align='center' width="100%">
<caption width="100%"><?php echo $lang->train->edit_content;?></caption>
<tr><th width= "200px"><?php echo $lang->train->introduction;?></th><td><?php echo html::textarea("introduction" ,$getcontentid->introduction, "class='tt'");?></td></tr>
<tr><th width= "200px"><?php echo $lang->train->decument_content;?></th><td><?php echo html::textarea("content" ,$getcontentid->content, "rows=20 class='tt'");?></td></tr>
</table>
<div style="text-align:center;"><td><?php echo html::submitButton() . html::resetButton();?></td></div>
<?php /*include "../../common/view/action.html.php";*/?>
</form>
</div>
<?php include "../../common/view/footer.html.php";?>