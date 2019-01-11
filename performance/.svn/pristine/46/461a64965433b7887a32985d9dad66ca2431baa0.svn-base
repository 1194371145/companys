<?php include '../../common/view/header.html.php'; ?>
<?php include '../../common/view/colorize.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<style>
table td{text-align:center;}
</style>
<div id='featurebar'>
<span></span><?php echo "<span id='bysearchTab'><a href='#'><span class='icon-search'></span> Search </a></span> ";?>
</div>
<script language='Javascript'>
var browseType = '<?php echo $program;?>';
</script>
<div id='querybox' class="<?php if($program=='bysearch') echo 'show';?>"><?php echo $searchForm;?></div>
<table class='table table-condensed table-hover table-striped tablesorter table-fixed'>
<caption><?php echo $lang->train->commentlist;?></caption>
<thead>
<tr class='colhead'>
<th>ID</th>
<!--<th>模块名</th>-->
<th><?php echo $this->lang->train->addby;?></th>
<th><?php echo $this->lang->train->adddate;?></th>
<th><?php echo $this->lang->train->comment_title;?></th>
<th><?php echo $this->lang->train->addcontent;?></th>
<th><?php echo $this->lang->train->operation;?></th>
</tr>
</thead>
<?php foreach($comment_list as $k=>$v){?>
<tr class='a-center'>
<td class="nobr" style="color:red;"><?php echo $v->id;?></td>
<?php $rt = $this->dao->select('*')->from('zt_trainclass')->where('id')->eq($v->cid)->fetchAll();
     foreach($rt as $kk=>$vv){ ?>
<!--<td class="nobr"><?php /*echo $vv->classname;*/?></td>
--><?php }?>
<td class="nobr"><?php echo $v->account;?></td>
<td class="nobr"><?php echo $v->adddate;?></td>
<td class="nobr"><?php echo $v->title;?></td>
<td class="nobr"><?php echo $v->content;?></td>
<td class="{sorter:false}">
<font size='2' color='#696969'>
<?php common::printLink('train', 'trainreply', "id=$v->id&cid=$v->cid&onlybody=yes",$this->lang->train->reply,"","class='train_reply iframe'");?>
&nbsp;&nbsp;&nbsp;
<?php common::printLink('train', 'deletereply', "id=$v->id&cid=$v->cid",$lang->train->delete,"","hiddenwin");?>
</font>
</td>
</tr>
<?php } ;?>

</table>
<tr><td colspan='7'><?php $pager->show();?></td></tr>
<?php  include "../../common/view/footer.html.php";?>
