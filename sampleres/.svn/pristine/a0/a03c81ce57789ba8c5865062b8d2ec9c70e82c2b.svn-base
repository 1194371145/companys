<?php  include '../../common/view/header.html.php';?>
<style>
table{margin:auto;margin-bottom:15px;margin-top:-15px;width:100%;}
table tr td{border:1px solid #e4e4e4;text-align:left;padding-left:10px;background-color:#F9F9F5;}
table tr th{border:1px solid #e4e4e4;text-align:right;padding-right:10px;}
</style>
<table>
<tr>
	<th class="w-p5">ID:</th>
	<td class='w-p25-f'><?php echo sprintf("%03d",$out->id);?></td>
</tr>
<tr>	
	<th>关联主数据:</th>
	<td>
	<?php
		 		if($out->type=="1")
				{
					echo html::a($this->createLink('mp','viewmp',"id=$out->mid"),$lang->sampleout->type[$out->type]."ID:$out->mid");
				}
				elseif($out->type=='2')
				{
					echo html::a($this->createLink('sample','viewsample',"id=$out->mid"),$lang->sampleout->type[$out->type]."ID:$out->mid");
				}
				elseif($out->type=='3')
				{
					echo html::a("",$lang->sampleout->type[$out->type]);
				} 
	?>
	</td>
</tr>
<tr>	
	<th>申请人:</th>
	<td><?php echo $out->person;?></td>
</tr>
<tr>	
	<th>RF#:</th>
	<td><?php echo $out->rf;?></td>
</tr>
<tr>		
	<th>申请时间:</th>
	<td><?php echo $out->rdate;?></td>
</tr>
<tr>		
	<th>创建时间</th>
	<td><?php echo $out->createdate;?></td>
</tr>
<tr>		
	<th>Rtype:</th>
	<td><?php echo $out->rtype;?></td>
</tr>
<tr>		
	<th>Partn:</th>
	<td title="<?php echo $notpart[$out->partn];?>"><?php echo $out->partn;?></td>
</tr>
<tr>		
	<th>Package:</th>
	<td><?php echo $out->package;?></td>
</tr>
<tr>		
	<th>EndName:</th>
	<td><?php echo $out->endname;?></td>
</tr>
<tr>	
	<th>DisName:</th>
	<td><?php echo $out->distributor;?></td>
</tr>
<tr>	
	<th>Project:</th>
	<td><?php echo $out->projectname;?></td>
</tr>
<tr>	
	<th>申请数量:</th>
	<td><?php echo $out->qty;?></td>
</tr>
<tr>	
	<th>发货数量:</th>
	<td><?php echo $out->aqty;?></td>
</tr>
<tr>
<tr>	
	<th>价格:</th>
	<td><?php echo $out->price;?></td>
</tr>
<tr>	
	<th>金额:</th>
	<td><?php echo $out->rev;?></td>
</tr>
<tr>	
	<th>快递单号:</th>
	<td><?php echo $out->shiporder;?></td>
</tr>
<tr>	
	<th>发货时间:</th>
	<td><?php echo $out->shipdate;?></td>
</tr>
<tr>	
	<th>Stage:</th>
	<td><?php echo $out->stage;?></td>
</tr>
<tr>	
	<th>区域:</th>
	<td><?php echo $lang->sampleout->area[$out->area];?></td>
</tr>
<tr>	
	<th>费用:</th>
	<td><?php echo $lang->sampleout->revtype[$out->revtype];?></td>
</tr>
<tr>	
	<th>备注:</th>
	<td colspan='2'><?php echo $out->remark;?></td>
</tr>
<tr>	
	<th>主数据:</th>
	<td><?php echo $lang->sampleout->type[$out->type];?></td>
</tr>
<tr>	
	<th>状态:</th>
	<td><?php echo $lang->sampleout->close[$out->close];?></td>
</tr>
<tr>	
	<th>Openby:</th>
	<td><?php echo $out->openby;?></td>
</tr>
<tr>
	<th>地址:</th>
	<td><?php echo $out->toaddress; ?></td>
</tr>
<tr><td></td><td><?php echo html::backButton("style='background-color:#1A4F85;color:white'");?></td></tr>
</table>
<?php  include '../../common/view/action.html.php';?>
<?php  include '../../common/view/footer.html.php';?>