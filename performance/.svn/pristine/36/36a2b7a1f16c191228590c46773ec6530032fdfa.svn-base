
<?php include '../../common/view/header.html.php';?>
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
<table id="paramlist" class="table table-condensed table-hover table-striped tablesorter table-fixed" cellspacing="1" cellpadding="2" width="99%" align="center">
 <thead>
    <tr align="center">
         <th class="td_bg" width="5%">Sort</th>
         <th class="td_bg" width="19%" height="26">Name</th>
         <th class="td_bg" width="20%" >Type</th>
		 <th class="td_bg" width="5%" >Category</th>
	     <th class="td_bg" width="10%" >Value</th>
		 <th class="td_bg" width="12%">Action</th>
		 <th class="td_bg" width="3%">Show</th>
	     <th class="td_bg" width="7%" height=""></th>
    </tr>
</thead>
<tbody id="Searchresult">
<?php
foreach($listfield as $value)
{
?>
<tr align="center">
<td class="td_bg" width="5%"><?php echo $value->sort; ?></td>
<td class="td_bg" width="19%" style="text-align:left;"><?php common::printLink('admin', 'setparam', 'id='.$value->id, $value->fieldname);?></td>
<td class="td_bg" width="20%" ><?php echo $value->fieldtype; ?></td>
<td class="td_bg" width="5%" >Parameter</td>
<td class="td_bg" width="10%" ><?php echo $value->fieldvalue; ?></td>
<td class="td_bg" width="12%"><?php common::printLink('admin', 'setparam', 'type=edit&id='.$value->id, "Edit");?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php common::printLink('admin', 'setparam', 'type=del&confirm=no&id='.$value->id, "Delete");?>
</td>
 <td class="td_bg" width="3%">
 <?php common::printLink('admin', 'setparam', 'type=show&id='.$value->id, $value->show1 == 1 ? '√' : '×','hiddenwin');?>
 </td>
<td class="td_bg" width="7%" ></td>
</tr>
<?php
}
  ?>

  <tr>
      <th height="25" colspan="5" align="left" class="bg_tr"> <?php
     echo $pagenav;
     ?></th>
	  <th height="25" colspan="3"  align="right" class="bg_tr">

   
     </th>
  </tr>
</tbody>
</table>
  <form method='post' target='hiddenwin'>
<table class="table"  width="100%" align="center"
border="0">
    <tbody>
      <tr>
        <th height="27" colspan="3" align="left" class="bg_tr">Create Parameter<a id="error" style="display:none;margin-left:30px;"></a></th>
      </tr>
      <tr align="left">
        <td class="td_bg" width="12%" height="26">Name：</td>
        <td class="td_bg" width="88%" height="" colspan="2"><input name="fieldname" id="fieldname22" type="text" class="input"  value="<?php echo $field->fieldname;?>" size="40" />&nbsp;&nbsp;<font style="color:red">(*) 5-45 characters</font></td>
      </tr>
      <tr align="left">
        <td class="td_bg" width="12%" height="26">Value：</td>
        <td class="td_bg" width="88%" height="" colspan="2"><input name="fieldvalue" id="fieldvalue" type="text" class="input"  value="<?php echo $field->fieldvalue;?>" size="20" />&nbsp;&nbsp;<font style="color:red">(*) 用英文字母(5-20字符,单词之间不要有空格，可用"_"下划线来代替单词间空格,参数名称简写)</font></td>
      </tr>	
	  <tr align="left">
        <td class="td_bg" width="12%" height="26">Type：</td>
        <td class="td_bg" width="88%" height="" colspan="2">
        <select name="fieldtype" id="fieldtype" style="width:150px;">
        <option value="varchar">varchar</option>
<!--        <option value="int">int</option>
        <option value="tinyint">tinyint</option>-->
        </select>
        <font style="color:red">(*) </font>
       </td>
      </tr>
	  <tr align="left">
        <td class="td_bg" width="12%" height="26">Sort：</td>
        <td class="td_bg" width="88%" height="" colspan="2"><input name="sort"  type="text" class="input"  value="<?php echo $field->sort;?>" size="10" /><font style="color:#FF0000">&nbsp;&nbsp;该项必填！请输入数字</font>
		
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
