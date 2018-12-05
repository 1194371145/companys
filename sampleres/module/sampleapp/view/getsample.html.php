<?php include "../../common/view/header.html.php";?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';include '../../common/view/treeview.html.php';?>
<style type="text/css">
.table th{width:15%;text-align:right;padding-right:10px;}
.area-1{width:90%;}
</style>
<form action="" method='post' enctype="multipart/form-data" target="hiddenwin">
<table class="table table-condensed  table-striped tablesorter table-fixed">
<caption style="padding-left:1%;font-size:18px;color:red;"><b>View</b></caption>
<tr>	
	<th>Name:</th>
	<td><?php echo $sample->person;?></td>
</tr>
<tr>	
	<th>RF#:</th>
	<td><?php echo $sample->rf;?></td>
</tr>
<tr>		
	<th>Request Date:</th>
	<td><?php echo $sample->rdate;?></td>
</tr>
<tr>		
	<th>CreateDate:</th>
	<td><?php echo $sample->createdate;?></td>
</tr>
<tr>		
	<th>Request Type:</th>
	<td><?php echo $sample->rtype;?></td>
</tr>
<tr>		
	<th>Part Number:</th>
	<td><?php echo $sample->partn;?></td>
</tr>
<tr>		
	<th>Package Type:</th>
	<td><?php echo $sample->package;?></td>
</tr>
<tr>		
	<th>End Customer:</th>
	<td><?php echo $sample->endname;?></td>
</tr>
<tr>	
	<th>Distributor:</th>
	<td><?php echo $sample->distributor;?></td>
</tr>
<tr>	
	<th>Price:</th>
	<td><?php echo $sample->price;?></td>
</tr>
<tr>	
	<th>Project Name:</th>
	<td><?php echo $sample->projectname;?></td>
</tr>
<tr>	
	<th>Quantity:</th>
	<td><?php echo $sample->qty;?></td>
</tr>
<tr>	
	<th>Ship Quantity:</th>
	<td><?php echo $sample->aqty;?></td>
</tr>
<tr>	
	<th>Rev:</th>
	<td><?php echo $sample->prict * $sample->aqty;?></td>
</tr>
<tr>
<tr>	
	<th>Stage(1-7#):</th>
	<td><?php echo $sample->stage;?></td>
</tr>
<tr>	
	<th>Ship date:</th>
	<td><?php echo $sample->shipdate;?></td>
</tr>
<tr>	
	<th>Ship Order:</th>
	<td><?php echo $sample->shiporder;?></td>
</tr>
<tr>	
	<th>Area:</th>
	<td><?php echo $sample->area;?></td>
</tr>
<tr>	
	<th>Mode of payment:</th>
	<td><?php
	if($sample->revtype == '需要付费'){echo "<b>Pay</b>";}
	if($sample->revtype == '不需付费'){echo "<b>Free</b>";}
	?></td>
</tr>
<tr>	
	<th>Status</th>
	<td><?php 
	if($sample->close=='wait'){echo "<b style='color:red;'>Not shipped</d>";}
		if($sample->close=='done'){echo "<b style='color:green;'>shipped</b>";}
	?></td>
</tr>
<tr>	
	<th>Receipt company:</th>
	<td><?php 
	echo $sample->tocompany;
	?></td>
</tr>
<tr>	
	<th>Consignee:</th>
	<td><?php 
	echo $sample->toperson;
	?></td>
</tr>
<tr>	
	<th>Contact number:</th>
	<td><?php 
	echo $sample->tomobile;
	?></td>
</tr>
<tr>	
	<th>Detailed Address:</th>
	<td><?php 
	echo $sample->toaddress;
	?></td>
</tr>
<tr>	
	<th>Remark:</th>
	<td><?php echo html::textarea('remark',$sample->remark,"class='area-1' rows=6");?>
	</td>
</tr>
<tr>	
	<!-- <th><?php echo html::BackButton();?></th> -->
	<th><?php echo "<a href='javascript:history.go(-1);' class='btn btn-back' >Back</a>";?></th>
	<td>
	</td>
</tr>
</table>
</form>
<?php include "../../common/view/action.html.php";?>
<?php include "../../common/view/footer.html.php";?>