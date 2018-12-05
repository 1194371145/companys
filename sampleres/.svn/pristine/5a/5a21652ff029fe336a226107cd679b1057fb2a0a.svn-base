<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';include '../../common/view/treeview.html.php';?>
<style type="text/css">
</style>
<div class='container mw-1400px'>
  <div id='titlebar'>
    <div class='heading'>
      <strong><small class='text-muted'><i class='icon icon-plus'></i></small> <?php echo "申请记录编辑";?></strong>
    </div>
  </div>
<form action="<?php echo $this->createLink("sampleout",'vieweditout',"id=$out->id");?>" method='post' enctype="multipart/form-data" target="hiddenwin">
<table class="table table-form">

<tr>
	<th class="w-p10">ID:</th>
	<td class='w-p25-f'><?php echo sprintf("%03d",$out->id);?></td><td></td>
</tr>
<tr>	
	<th>关联主数据:</th><?php if($out->type=='3'){$mid=0;}elseif($out->type=='1'){$mid=$out->mid."mp";}elseif($out->type=='2'){$mid=$v->mid."sample";}?>
	<td><?php echo html::select('mid',$out->wait,$mid,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>申请人:</th>
	<td><?php echo html::input('person',$out->person,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>RF#:</th>
	<td><?php echo html::input('rf',$out->rf,"class='form-control' ");?></td><td></td>
</tr>
<tr>		
	<th>申请时间:</th>
	<td><?php echo html::input('rdate',$out->rdate,"class='form-control form-date' ");?></td><td></td>
</tr>
<tr>		
	<th>创建时间</th>
	<td><?php echo html::input('createdate',$out->createdate,"class='form-control form-datetime' ");?></td><td></td>
</tr>
<tr>		
	<th>Rtype:</th>
	<td><?php echo html::input('rtype',$out->rtype,"class='form-control' ");?></td><td></td>
</tr>
<tr>		
	<th>Partn:</th>
	<td title="<?php echo $notpart[$out->partn];?>"><?php echo html::input('partn',$out->partn,"class='form-control' title='{$notpart[$out->partn]}'");?></td><td></td>
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
	<td><?php echo html::input('projectname',$out->projectname,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>申请数量:</th>
	<td><?php echo html::input('qty',$out->qty,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>发货数量:</th>
	<td><?php echo html::input('aqty',$out->aqty,"class='form-control' ");?></td><td></td>
</tr>
<tr>
<tr>	
	<th>价格:</th>
	<td><?php echo html::input('price',$out->price,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>金额:</th>
	<td><?php echo html::input('rev',$out->rev,"class='form-control' ");?></td><td></td>
</tr>
<tr>	
	<th>快递单号:</th>
	<td><?php echo html::input('shiporder',$out->shiporder,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>发货时间:</th>
	<td><?php echo html::input('shipdate',$out->shipdate,"class='form-control form-date'");?></td><td></td>
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
	<td><?php echo html::input('tocompany',$out->tocompany,"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>
	<th>收件人:</th>
	<td><?php echo html::input('toperson',$out->toperson,"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>
	<th>联系人电话:</th>
	<td><?php echo html::input('tomobile',$out->tomobile,"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>
	<th>详细地址:</th>
	<td><?php echo html::input('toaddress',$out->toaddress,"class='form-control'");?></td><td style="color:#d2322d;font-size: 24px">* </td>
</tr>
<tr>	
	<th>备注:</th>
	<td colspan='2'><?php echo html::textarea('remark',$out->remark,"rows='8' class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>主数据:</th>
	<td><?php echo $lang->sampleout->type[$out->type];?></td><td></td>
</tr>
<tr>	
	<th>状态:</th>
	<td><?php echo $lang->sampleout->close[$out->close];?></td><td></td>
</tr>
<tr>	
	<th>Openby:</th>
	<td><?php echo $out->openby;?></td><td></td>
</tr>
<tr><td></td>
	<td colspan='2'>
	<input type='submit' value='保存'  class='btn' style='background-color:#1A4F85;color:white;'/>
	<input type='button' value='出货'  class='btn' onclick="outku();" style='background-color:#1A4F85;color:white'/> 
	<?php echo html::backButton();?>
	<td style="color:#d2322d;font-size: 24px">* 为必填项!</td>
	</td>
</tr>
</table>
</form>
</div>
<script type='text/javascript'>
function outku()
{
	var mid=$("#mid").val();
	$('form').attr('action',"<?php echo $this->createLink("sampleout",'vieweditout',"id=$out->id&type=chuhuo");?>");
	if(mid=='0')
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
	$('form').attr('action',"<?php echo $this->createLink("sampleout",'vieweditout',"id=$out->id");?>");
}
</script>
<?php include "../../common/view/action.html.php";?>
<?php  include '../../common/view/footer.html.php';?>