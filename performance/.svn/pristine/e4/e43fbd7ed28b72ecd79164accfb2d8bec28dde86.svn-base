
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<script>
$(function()
{

    setTimeout(function(){fixedTheadOfList('#paramlist')}, 100);
})
</script>
<div id='featurebar'>
  <ul class='nav'>
    <li class='active'><?php common::printLink('admin', 'safe', '', $lang->admin->safe->set);?></li>
    <li><?php common::printLink('admin', 'checkWeak', '', $lang->admin->safe->checkWeak);?></li>
    <li><?php common::printLink('admin', 'setparam', '', 'Create Parameter');?></li>
  </ul>
</div>
<div class='container mw-1000px' style="border:none;">
<table id="paramlist" class="table table-condensed table-hover table-striped tablesorter table-fixed" style="width:1100px; margin-left:0px;" cellspacing="1" cellpadding="2" width="99%" align="center">
 <thead>
    <tr align="center">
         <th class="td_bg" width="5%">id</th>
         <th class="td_bg" width="19%" height="26">Circle</th>
         <th class="td_bg" width="20%" >Begin Date</th>
		 <th class="td_bg" width="5%" >End Date</th>
	     <th class="td_bg" width="10%" >status</th>
		 <th class="td_bg" width="12%">Action</th>
	     
    </tr>
</thead>
<tbody id="Searchresult">
<?php
foreach($listcircle as $value)
{
?>
<tr align="center">
<td class="td_bg" width="5%"><?php echo $value->id; ?></td>
<td class="td_bg" width="19%" ><?php common::printLink('admin', 'setcircle', 'id='.$value->id, $value->circle);?></td>
<td class="td_bg" width="20%" ><?php echo $value->periodbegin; ?></td>
<td class="td_bg" width="5%" ><?php echo $value->periodend; ?></td>
<td class="td_bg" width="10%" ><?php echo $value->status; ?></td>
<td class="td_bg" width="12%"><?php common::printLink('admin', 'setcircle', 'type=edit&confirm=no&id='.$value->id, "Edit");?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php common::printLink('admin', 'setcircle', 'type=del&confirm=no&id='.$value->id, "Delete",'hiddenwin');?>
</td>


</tr>
<?php
}
  ?>


</tbody>
</table>
  <form method='post' target='hiddenwin' style="width:1100px; margin-left:0px; padding-left:0px;">
<table class="table"  width="100%" align="center" border="0" style="width:1100px; margin-left:0px;">
    <tbody>
      <tr>
        <th height="27" colspan="3" align="left" class="bg_tr">Set up Circle Time</th>
      </tr>
      <tr align="left">
        <td class="td_bg" width="12%" height="26">Circle：</td>
        <td class="td_bg" width="88%" height="" colspan="2"><input name="circle" id="circle" type="text" class="input"  value="<?php echo $circle->circle;?>" size="40" />&nbsp;&nbsp;<font style="color:red">(*) 20171/20172 ,5 characters</font></td>
      </tr>
      <tr align="left">
        <td class="td_bg" width="12%" height="26">Begin Date：</td>
        <td class="td_bg" width="88%" height="" colspan="2"><input name="periodbegin" id="periodbegin" type="text" class="input form-date"  value="<?php echo $circle->periodbegin;?>" size="20" />&nbsp;&nbsp;<font style="color:red"></font></td>
      </tr>	
	  <tr align="left">
        <td class="td_bg" width="12%" height="26">End Date：</td>
        <td class="td_bg" width="88%" height="" colspan="2">
        <input name="periodend" id="periodend" type="text" class="input form-date"  value="<?php echo $circle->periodend;?>" size="20" />
       </td>
      </tr>
	  <tr align="left">
        <td class="td_bg" width="12%" height="26">Status：</td>
        <td class="td_bg" width="88%" height="" colspan="2">
        <?php
        echo html::select('status', array('open'=>'open','hold'=>'hold','close'=>'close'),$circle->status, "class='form-control' style='width:100px;'");
		?>
		
		</td>
      </tr>
      <tr align="left">
        <td class="td_bg" height="26" colspan="3">&nbsp;&nbsp;<input type="submit" name="linksubmit" id="linksubmit" value="Save"/></td>
      </tr>
    </tbody>
  </table>
  </form>
</div>
<?php include '../../common/view/footer.html.php';?>
