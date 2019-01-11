<?php include '../../common/view/header.lite.html.php';?>
<style>
.text-1{width:100%}
</style>
<form action=""  method='post' enctype='multipart/form-data' target="hiddenwin">
<table class='table  tablesorter table-datatable' align="center" width = "100%">
<caption style="background:#F0F8FF;width:100%;"><?php echo $lang->train->create_classname;?></caption>
<tr><th width="200px"><?php echo $lang->train->content_name;?></th><td><?php echo html::input('classname','','class=text-1')?></td></tr>
<tr><td colspan='6' align='center'><?php echo html::submitButton().html::resetButton();?></td></tr>
</table>
</form>
<?php  include "../../common/view/footer.lite.html.php";?> 