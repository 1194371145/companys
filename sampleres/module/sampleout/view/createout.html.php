<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';include '../../common/view/treeview.html.php';?>
<style type="text/css">
</style>
<div class='container mw-1400px'>
  <div id='titlebar'>
    <div class='heading'>
      <strong><small class='text-muted'><i class='icon icon-plus'></i></small> <?php echo "填写申请记录";?></strong>
    </div>
  </div>
<form action="#" method='post' enctype="multipart/form-data" target="hiddenwin">
<table class="table table-form">
<tr>	
	<th>申请人:</th>
	<td><?php echo html::input('person',$app->user->account,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>RF#:</th>
	<td><?php echo html::input('rf',date("YmdHis"),"class='form-control' ");?></td><td></td>
</tr>
<tr>		
	<th>申请时间:</th>
	<td><?php echo html::input('rdate',date("Y-m-d"),"class='form-control form-date' ");?></td><td></td>
</tr>
<tr>		
	<th>Rtype:</th>
	<td><?php echo html::input('rtype',$out->rtype,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Partn:</th>
	<td title="<?php echo $notpart[$v->partn];?>"><?php echo html::input('partn',$out->partn,"class='form-control' onblur='getwait(this);' title=\" {$notpart[$v->partn]}\"");?></td><td></td>
</tr>
<tr>	
	<th style="width:10%;">关联主数据:</th>
	<td class='w-p25-f'>
	<select id="wait" style="width:100%;" class='form-control' name="mid" >
	
	</select>
	</td>
	<td></td>
</tr>
<tr>		
	<th>Package:</th>
	<td><?php echo html::input('package',$out->package,"class='form-control' ");?></td><td></td>
</tr>
<tr>		
	<th>EndName:</th>
	<td><?php echo html::input('endname',$out->endname,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>DisName:</th>
	<td><?php echo html::input('distributor',$out->distributor,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>Project:</th>
	<td><?php echo html::input('projectname',$out->project,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>申请数量(K):</th>
	<td><?php echo html::input('qty',"","class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>发货数量(K):</th>
	<td><?php echo html::input('aqty',"","class='form-control' ");?></td><td></td>
</tr>
<tr>
<tr>	
	<th>价格:</th>
	<td><?php echo html::input('price',"0","class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>金额:</th>
	<td><?php echo html::input('rev',"0","class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>快递单号:</th>
	<td><?php echo html::input('shiporder',"快速出货","class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>发货时间:</th>
	<td><?php echo html::input('shipdate',date('Y-m-d'),"class='form-control form-date'");?></td><td></td>
</tr>
<tr>	
	<th>Stage:</th>
	<td><?php echo html::input('stage',$out->stage,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>区域:</th>
	<td><?php echo html::select('area',$lang->sampleout->area,$out->area,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>费用:</th>
	<td><?php echo html::select('revtype',$lang->sampleout->revtype,$out->revtype,"class='form-control'");?></td><td></td>
</tr>
<tr>
	<th>收件公司:</th>
	<td><?php echo html::input('tocompany','',"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>
	<th>收件人:</th>
	<td><?php echo html::input('toperson','',"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>
	<th>联系人电话:</th>
	<td><?php echo html::input('tomobile','',"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>
	<th>详细地址:</th>
	<td><?php echo html::input('toaddress','',"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>	
	<th>备注:</th>
	<td colspan='2'><?php echo html::textarea('remark',$out->remark,"rows='8' class='form-control' style='resize:none;'");?></td><td></td>
</tr>

<tr><td></td>
	<td colspan='2'>
	<input type='submit' value='保存'  class='btn' style='background-color:#1A4F85;color:white;'/>
	<input type='button' value='出货'  class='btn' style='background-color:#1A4F85;color:white;' onclick='outku();'/>
	</td>
	<td style="color:#d2322d;font-size: 24px">* 为必填项!</td>
</tr>
</table>
</form>
</div>
<script type="text/javascript">
$(function(){getwait();});
function outku()
{	
	var mid=$('#wait').val();
	$('form').attr('action',"<?php echo $this->createLink("sampleout",'createout',"type=chuhuo");?>");
	if(!mid || mid=='0')
	{
		if(confirm('此条出库记录无关联主数据   是否继续'))
		{
			$("form").submit();
		}
	}
	else
	{
		$("form").submit();
	}
	$('form').attr('action',"<?php echo $this->createLink("sampleout",'createout');?>");
}

function getwait()
{
	var part=$('#partn').val();
	$.ajax({
		url:"<?php echo $this->createLink('sampleout','getwaitbypart');?>",
		data:"part="+part,
		type:"post",
		dataType:'html',
		success:function(o)
		{
			$("#wait").html(o);
		}	
		});
}
</script>
<?php  include '../../common/view/footer.html.php';?>