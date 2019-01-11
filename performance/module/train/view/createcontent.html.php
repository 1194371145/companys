<?php include "../../common/view/header.html.php";?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<style type="text/css">
#classname{ width:30%; height:30px; border:2px; border:1px solid #C0C0C0;}
#document{ width:30%; height:30px; border:2px; border:1px solid #C0C0C0;}
#introduction{ width:100%; height:30px; border:2px; border:1px solid #C0C0C0;}
table tr{border:1px solid #C0C0C0;}
</style>
<form action=""  method='post' enctype='multipart/form-data' target="hiddenwin">
<table class='table  tablesorter table-datatable' align="center" style="width:80%;">
<caption text-align="left"><?php echo "Create content of the article";?></caption>
<tr><td colspan='2'><font color="red">Please make sure that the title and content you add are not duplicated.</font></td></tr>
<tr>
<th><?php echo $this->lang->train->module_class;?></th><td><?php echo html::select('classname',$get_classname,'',"class='classname'")?></td>
</tr>
<tr>
<th><?php echo $lang->train->decument_class;?></th><td><?php echo html::input('document','',"class='text-1'")?></td>
</tr>
<tr><th width="180px"><?php echo $this->lang->train->introduction;?></th><td><?php echo html::textarea("introduction" ,'', "class='text-1'");?></td></tr>
<tr><th width="180px"><?php echo $this->lang->train->decument_content;?></th><td><?php echo html::textarea("content" ,'', "rows='15' class='text-1'");?></td></tr>
</table>
<br/><br/>
<div style="text-align:center;"><td class='a-center'><?php echo html::submitButton() . html::resetButton();?></td></div>
</form>
<?php include "../../common/view/footer.html.php";?>