<?php 
include '../../common/view/header.html.php';
include '../../common/view/treeview.html.php';
include '../../common/view/tablesorter.html.php';
include '../../common/view/datepicker.html.php';
include '../../common/view/kindeditor.html.php';
?>
<script>
$(function(){
         var outer = $('.outer').height();
		 var rightmanual = $('#rightmanual').height();
		 if(outer < rightmanual+30)
		 {
			 $('.outer').height(rightmanual+50);
		 }

	if($("#rds tr td img").attr('width') > 920)
		  {
			  $("#rds tr td img").attr('width','920');
		  }
});
</script>
<div id='featurebar' style="margin-bottom:0px;"></div>
<div align="center" id=>
<table class='table  tablesorter table-datatable' style="width:80%;text-align:center; border:1px solid #E0E0FF;">
<tr valign='top'>
<td style="width:200px;vertical-align:top;">
<div style="width:100%;background:#EBF1F9;">Directory Structure</div>
<div class='box-content' style="width:100%;height:auto;border:1px solid #F9F9F9; margin:0 auto;">
	      <?php /*echo $getsqls;*/?>
	      <?php $getsql = $this->dao->select('*')->from('zt_trainclass')->fetchAll();
	       foreach($getsql as $k=>$v){
	       if($v->f_id=="0"){
	      ?>
	      <ul style='font-size:20px;text-align:left;' id=<?php echo $v->id;?> ><font size='2' color='#000000' face='Microsoft YaHei'><?php echo $v->classname;?></font>
	      <span><font size="2" color="blue"><?php common::printLink('train', 'edittoptitle', "id=$v->id&f_id=$v->f_id",$this->lang->train->edit,"","class='edittoptitle iframe'");?></font></span>
	      <span><font size="2" ><?php common::printLink('train', 'deltoptitle', "id=$v->id&f_id=$v->f_id",$this->lang->train->delete,"hiddenwin");?></font></span>
	      <?php $getsqls = $this->dao->select('*')->from('zt_trainclass')->where("f_id")->ne(0)->fetchAll();
	      foreach($getsqls as $kk=>$vv){
				if($vv->f_id == $v->id){
				?>
	      <li style='font-size:9px;list-style-type:none;' id=<?php echo $vv->id;?>>
	      <p style='width:250px;'>&nbsp;&nbsp;|--
	      <a href=index.php?m=train&f=trainlist&id=<?php echo $vv->id;?>&f_id=<?php echo $vv->f_id;?>>
	        <font size='2' color='#0080FF' face='Microsoft YaHei'><?php echo $vv->classname;?></font>
	      </a>
	      <?php $but=$this->loadModel('group')->getUserPairs(14); 
	            if(!in_array($this->app->user->account,$but)){?>
	      <span><?php common::printLink('train', 'edit', "id=$vv->id&f_id=$vv->f_id",$this->lang->train->edit,"","class='edittitle iframe'");?>
	            <?php common::printLink('train', 'delete', "id=$vv->id&f_id=$vv->f_id",$this->lang->train->delete,"hiddenwin");?> </span>
	      </p>
	      </li>
	      <?php }}}?>
	      </ul>
	      <?php }}?>
	    </div>
	    <!--<div class='box-content' style="width:100%;height:253px;border:1px solid #F9F9F9; "></div>
--></td>
<td style="width:1000px;">
<div style="height:auto;width:100%;align:center;overflow:hidden;" id="rightmanual">
<table class='table table-condensed table-hover  tablesorter table-datatable' style="background:#F9F9F9; cellspacing:0px;width:100%;" >
<tr><td colspan='6' align="center"><font size="3" color="#000000" face='STHeiti'><?php echo $get_title->classname; ?></font></td></tr>	       
<tr>
<td align='center'"><font size="2" color="#7B7B7B"><?php echo $lang->train->createdate;?>:</font><?php echo $get_content->adddate;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="2" color="	#7B7B7B"><?php echo $lang->train->createby;?>:</font><?php echo $get_content->createby;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="2" color="	#7B7B7B"><?php echo $lang->train->lastupdate;?>:</font><?php echo $get_content->lastupdate;?></td>
</tr>
<tr><td align="left" colspan='6'><font size="3" color="#7B7B7B"><?php echo $lang->train->introduction;?>:</font><br/><?php echo $get_content->introduction;?></td></tr>
</table>
       <table id="rds" class='table table-condensed table-hover tablesorter table-datatable fixed' width="100%" style="border-collapse:collapse;border:1px solid #E0E0FF;">
       <tr><td align="left"><font size="2"><?php if(!empty($get_content->content)){echo $get_content->content;}else{echo "NULL";}?></font></td></tr>
       <td align="center" colspan='3'><font><?php common::printLink('train', 'editcontent', "id=$get_content->id&typeid=$get_content->typeid",html::submitButton("Edit_content"));?></font></td>
        </table>      
	    <table class='table table-condensed table-hover tablesorter table-datatable' width="100%" style="border-collapse:collapse;">
	    <?php /*echo $commentlist;*/?>
	    <?php $trr = $this->dao->select('*')->from('zt_traincomment')->where('cid')->eq($_GET['id'])->orderBy(id_desc)->fetchAll();
	          foreach($trr as $k=>$v){
	          if($v->f_tid == 0){
	    ?>
	    </table>
	    <table class='table table-condensed table-hover tablesorter table-datatable fixed' width="100%" style="background:#F9F9F9;align:center;">
	    <tr bgcolor='#F9F9F9'>
	    <th width = "120px"><?php echo $this->lang->train->comment_title;?>:</th><td><font size='2' color='#696969' width = "10px"><?php echo $v->title;?></font></td>
	    <th width = "120px"><?php echo $this->lang->train->addby;?>:</th><td><font size='2' color='#696969' width = "60px"><?php echo $v->account;?></font></td>
		<th width = "120px"><?php echo $this->lang->train->adddate;?>:</th><td><font size='2' color='#696969' width = "60px"><?php echo $v->adddate;?></font></td>
		<td id=<?php echo $v->cid;?>>
		<font size='2' color='#F9F9F9'>
		<?php common::printLink('train', 'trainreply', "id=$v->id&cid=$v->cid&onlybody=yes",$lang->train->reply,"","class='train_reply iframe'");?></font></td>
        <br/>
		<tr><td colspan=3 style="text-align:left;"><font size='2'><p><?php echo $v->content;?></p></font></td></tr>
	    <?php } $i=1;foreach($trr as $kk=>$vv){ ;
	          if($vv->f_tid == $v->id){;?>
	    <tr bgcolor='#F9F9F9'><td ><?php echo $i++."&nbsp;"."Floor";?></td><td colspan=2 ><font size='2' color='#696969'><?php echo $this->lang->train->replyby;?>:<?php echo $vv->account;?></font></td>
		<td colspan=3 ><font size='2' color='#F9F9F9'><?php echo $this->lang->train->replydate;?>:<?php echo $vv->adddate;?></font></td>
		<td id=<?php echo $vv->cid;?>></td>
		<br/> 
	    <tr><td colspan=2  height="50px" style="text-align:left;"><span style="font-size:9pt;"> <?php echo $vv->content;?></span></td></tr>

	    <?php }}}?>
	    <form action="" method='post' enctype="multipart/form-data" target="hiddenwin">
	    <table class='table table-condensed table-hover tablesorter table-datatable' width="100%" style="background:#F9F9F9;align:center;">
	       <!--<tr><td><font size="3" color="gray"><?php echo html::textarea("contents" ,'', "rows='10' class='text-1' style='width:100%;'");?></td></tr>
	    -->
	    <tr><th><?php echo $this->lang->train->addby;?></th><td align="left"><?php echo html::input("account" ,$this->app->user->account, "class='text-3'readonly='readonly'disabled='true'");?></td></tr>
		<tr><th><?php echo $this->lang->train->adddate;?></th><td align="left"><?php echo html::input("adddate" ,date("Y-m-d H:i:s"), "class='text-3'readonly='readonly'disabled='true'");?></td></tr>
		<tr><th><?php echo $this->lang->train->comment_title;?></th><td align="left"><font size="3" color="red"><?php echo html::input("title" ,'', "class='text-3'");?></td></tr>
		<tr><th><?php echo $this->lang->train->addcontent;?></th><td align="left"><font size="3" color="red"><?php echo html::textarea("content" ,'', "rows='15' class='text-1'");?></td></tr>
		</table>
		<table class='table table-condensed table-hover  table-datatable' width="100%" style="text-align:center;"><td><?php echo html::submitButton() . html::resetButton();?></td></table>
	    </form>
	    </table>
	    </div>
	    </td>
</tr>
</table>
</div>

<?php include '../../common/view/footer.html.php';?>
