<?php include '../../common/view/header.html.php';?>
<style type='text/css'>
.group-item {display:block; width:180px; float:left}
.outer .table th{vertical-align: middle;}
#td,#td1,.w-100px{border:1px solid #DDDDDD;backgroud-color:#F9F9F9;}
.table,.table tr,.table tr th,.table tr td{border:1px solid #DDDDDD;backgroud-color:#F9F9F9;}
</style>
<div class="col-main">
<form method='post' enctype='multipart/form-data' target='' onsubmit="setDownloading();" class='form-condensed pdb-20'>
<table align='center' class='table table-form'>
<tr><th class='w-100px' style="vertical-align: middle;">经理:<b><input type='checkbox' onclick='checkall(this, "td");' checked='checked'></b></th>
					<td id='td'  class='f-14px pv-10px'>
					<?php
					foreach($manager as $k=>$v)
					{
					?>	
							<div class='group-item'><?php echo html::checkbox('manager', array($k => $v), '',"checked='checked'");?></div>
					<?php
					}
					?>
					</td>
</tr>
<tr><th class='w-100px' style="vertical-align:middle;">所有:<b><input type='checkbox' onclick='checkall(this, "td1");' ></b></th>
					<td id='td1'  class='f-14px pv-10px'>
					
					<div class='group-item'><?php echo html::checkbox('manager', array('all' => '所有员工'), '',"");?></div>
					
					</td>
</tr>
<tr><th class='w-100px' style="vertical-align:middle;">考核周期:</th><td><?php echo html::select('zhouqi',$zhouqi,'',"style='width:50%;border:1px solid black;'");?></td></tr>
<tr><th></th><td><?php echo html::submitButton('Download');?></td></tr>
</table>
</form>
</div>
<script type="text/javascript">
function setDownloading()
{
    if($.browser.opera) return true;   // Opera don't support, omit it.

    $.cookie('downloading', 0);
    time = setInterval("closeWindow()", 300);
    return true;
}

function closeWindow()
{
    if($.cookie('downloading') == 1 || i >= 30)
    {
        parent.$.fn.colorbox.close();
        $.cookie('downloading', null);
        clearInterval(time);
    }
    i ++;
}
function checkall(checker, id)
{
    $('#' + id + ' input').each(function() 
    {
        $(this).attr("checked", checker.checked)
    });
}
</script>

<?php include '../../common/view/footer.html.php';?>