<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<style type="text/css">
.texts{width:100%;}
</style>
<div style="width:60%;">
<form action="" method='post' enctype="multipart/form-data" target="hiddenwin" class='form-condensed'>
<table align='center' width="90%" >
<caption><?php echo $lang->train->Reply_Comments;?></caption>
<tr><th><?php echo $lang->train->replyby;?></th><td><?php echo html::input("account" ,$this->app->user->account, "readonly='readonly'disabled='true'");?></td></tr>
<tr><th><?php echo $lang->train->replydate;?></th><td><?php echo html::input("adddate" ,date("Y-m-d H:i:s"), "readonly='readonly'disabled='true'");?></td></tr>
<tr><th><?php echo $lang->train->replycontent;?></th><td><?php echo html::textarea("content" ,"", "rows='9' class=texts ");?></td></tr>
</table>
<div style="text-align:center;"><td><?php echo html::submitButton() . html::resetButton();?></td></div>
</form>
</div>
<?php include "../../common/view/footer.html.php";?>