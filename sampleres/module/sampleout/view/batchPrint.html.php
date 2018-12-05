<?php
include "../../common/view/header.html.php";
include '../../common/view/treeview.html.php';
?>
<?php include '../../common/view/datepicker.html.php';?>
<style type="text/css">
*{padding:0px;margin:0px;}
#userList{margin-top:0px;font-size:10px;;text-align:center;}
#featurebar{margin-bottom:0px;}
#userList tbody tr td{font-size:10px;margin:0px;padding:0px;}
#userList tbody tr{font-size:10px;margin:0.5px;padding:0px;}
#userList tbody form tr td input{font-size:10px;margin:0px;padding:0px;}
#userList tbody form tr td{font-size:10px;margin:0px;padding:0px;}
#userList tbody form tr{font-size:10px;margin:0.5px;padding:0px;}
#userList tbody form{font-size:10px;margin:0px;padding:0px;}
.input{width:100%;height:26px;}
#anniu{background-color:#1A4F85;padding:1.5px;border:none;color:white;font-size:10px;}
#anniu:visited,#anniu:hover,#anniu:link,#anniu:active{color:white;}
</style>
<table class="table table-condensed  table-striped tablesorter table-fixed" id='userList' style="border-collapse:collapse;">
<thead>
<tr><?php $vars="type=$type&param=$param&orderBy=%s";?>

<th style="width:40px;"><?php echo "ID";?></th>
<th style="width:54px;"><?php echo "申请人";?></th>
<th style="width:70px;"><?php echo"申请时间";?></th>
<th style="width:198px;"><?php echo "Remark";?></th>

<th style="width:65px;"><?php echo  "Rtype";?></th>

<th style="width:90px;"><?php echo "PartN";?></th>
<!--
<th style="width:99px;"><?php echo "Pack";?></th>
-->
<th style="width:90px;"><?php echo "End";?></th>
<th style="width:90px;"><?php echo  "Dis";?></th>
<th style="width:65px;"><?php echo  "Project";?></th>
<th style="width:50px;"><?php echo "Stage";?></th>
<th style="width:55px;"><?php echo  "申请量";?></th>
<th style="width:55px;"><?php echo "发货量";?></th>
<th style="width:45px;"><?php echo "Price";?></th>
<th style="width:45px;"><?php echo "Rev";?></th>
<th style="width:100px;"><?php echo "ShipOrder";?></th>
<th style="width:70px;"><?php echo "ShipDate";?></th>
<th style="width:50px;"><?php echo  "区域";?></th>
<th style="width:50px;"><?php echo  "费用";?></th>
<th><?php echo "主数据";?></th>
<th><?php echo '收件公司';?></th>
<th><?php echo '收件人';?></th>
<th><?php echo '联系电话';?></th>
<th><?php echo '详细地址';?></th>
<th><?php echo "操作";?></th>
</tr>
</thead>
<tbody>
<form action="<?php echo $this->createLink('sampleout','batchPrint','address=printAddress');?>" method="post" target="hiddenwin">
<?php $i=1;foreach($outs as $v){?>
<?php if ($v->area == 'NC' or $v->area == 'SC'): ?>
			<tr>
			<td><?php echo sprintf("%03d",$v->id);?></td>
			<td><input type='text' name='person[<?php echo $v->id;?>]' value="<?php echo $v->person;?>" class='input'/></td>
			<td><input type='text' name='rdate[<?php echo $v->id;?>]' value="<?php echo $v->rdate;?>" class='input form-date'/></td>
			<td><input type='text' name='remark[<?php echo $v->id;?>]' value="<?php echo $v->remark;?>" class='input'/></td>
			<td><input type='text' name='rtype[<?php echo $v->id;?>]' value="<?php echo $v->rtype;?>" class='input'/></td>
			
			<td title="<?php echo $notpart[$v->partn];?>"><input type='text' name='partn[<?php echo $v->id;?>]' value="<?php echo $v->partn;?>" class='input' title="<?php echo $notpart[$v->partn];?>"/></td>
			<td><input type='text' name='endname[<?php echo $v->id;?>]' value="<?php echo $v->endname;?>" class='input'/></td>
			<td><input type='text' name='distributor[<?php echo $v->id;?>]' value="<?php echo $v->distributor;?>" class='input'/></td>
			<td><input type='text' name='projectname[<?php echo $v->id;?>]' value="<?php echo $v->projectname;?>" class='input'/></td>
			<td><input type='text' name='stage[<?php echo $v->id;?>]' value="<?php echo $v->stage;?>" class='input'/></td>
			<td><input type='text' name='qty[<?php echo $v->id;?>]' value="<?php echo $v->qty;?>" class='input'/></td>
			<td><input type='text' name='aqty[<?php echo $v->id;?>]' value="<?php echo $v->aqty;?>" class='input'/></td>
			<td><input type='text' name='price[<?php echo $v->id;?>]' value="<?php echo $v->price;?>" class='input'/></td>
			<td><input type='text' name='rev[<?php echo $v->id;?>]' value="<?php echo $v->rev;?>" class='input'/></td>
			<td><input type='text' name='shiporder[<?php echo $v->id;?>]' value="<?php if($i==1){echo $v->shiporder;}else{echo "同上";}?>" class='input'/></td>
			<td>
				<input type='text' name='shipdate[<?php echo $v->id;?>]' value="<?php echo date("Y-m-d");?>" class='input form-date'/>
				<input type='hidden' name='id[<?php echo $v->id;?>]' value="<?php echo $v->id;?>"/>
			</td>
			<td><?php echo html::select("area[$v->id]",$lang->sampleout->area,$v->area,"class='input'")?></td>
			<td><?php echo html::select("revtype[$v->id]",$lang->sampleout->revtype,$v->revtype,"class='input'")?></td>
			<td align="right" style="padding:0px;margin:0px;"> 
	 		<?php 
			if($v->type=='3'){$mid=0;}elseif($v->type=='2'){$mid=$v->mid."sample";}elseif($v->type=='1'){$mid=$v->mid."mp";}
			echo html::select("mid[$v->id]",$v->wait,$mid,"class = 'mid{$v->id} input'");
			?> </td>
			<td><input type='text' name='tocompany[<?php echo $v->id;?>]' value="<?php echo $v->tocompany;?>" class='input' title="<?php echo $v->tocompany;?>"/></td>
			<td><input type='text' name='toperson[<?php echo $v->id;?>]' value="<?php echo $v->toperson;?>" class='input' title="<?php echo $v->toperson;?>"/></td>
			<td><input type='text' name='tomobile[<?php echo $v->id;?>]' value="<?php echo $v->tomobile;?>" class='input' title="<?php echo $v->tomobile;?>"/></td>
			<td><input type='text' name='toaddress[<?php echo $v->id;?>]' value="<?php echo $v->toaddress;?>" class='input' title="<?php echo $v->toaddress;?>"/></td>
			<td><?php echo html::a($this->createLink('sampleout','vieweditout',"id=$v->id"),'修改','','') ?></td> 
			</tr>
<?php endif ?>
		
<?php  $i++;}?>
<tr><td></td>
	<td align='left' colspan="23"><?php echo html::submitButton('打印');?>
	</td>
</tr>
</form>
</tbody>
</table>
<?php include "../../common/view/footer.html.php";?>



