<?php 
include '../../common/view/header.html.php';
?>
<style>
table tr th{text-align:left;}
textarea{width:100%;}
/*table tr td div{margin-left: auto; margin-right: auto;}*/
table tr td div{margin-left:left;}
</style>
<div><?php echo '<b>Circle: 2017 2H</b>';?></div>
<form action="" method='post' target='hiddenwin' id='gradessubmit'>
<table style="border:0px solid #000;width:100%;overflow:hidden;text-align:center; border-collapse:separate; border-spacing:10px;">
	<caption style="font-size:22px;color:black;background-color:#fff;">Cross Table</caption>
	<tr>
		<th style='width:8%'>Item</th>
		<td style='width:15%;text-align:left;'><b>Professionality</b></td>
		<td style='width:16%;text-align:left;'><b>Co-operation</b></td>
		<td style='width:16%;text-align:left;'><b>Execution</b></td>
		<td style='width:16%;text-align:left;'><b>Responsibility</b></td>
		<td style='width:13%;text-align:left;'><b>Integrity</b></td>
		<td><b>Other Comments</b></td>
	</tr>
	<tr>
		<th>Brief Introduction</th>
		<td style='text-align:left;'><b>Professional skills</br></b><b>Creativity</b></td>
		<td style='text-align:left;'><b>Effective communication </br></b><b>Mutual understanding</b></td>
		<td style='text-align:left;'><b>Result oriented </br></b><b>Good time management</br></b><b>Prioritize skill</b></td>
		<td style='text-align:left;'><b >Willing to carry responsibility</br></b><b>Overcome difficulties</b></td>
		<td style='text-align:left;'><b>Honest</br></b><b>Reliable</b></td>
		<td></td>
	</tr>
	<?php if (in_array('de',$crossexams)): ?>
		<tr id='de'>
				<th>DE</th>
				<td><div></div></td>
				<td><div></div></td>
				<td><div></div></td>
				<td><div></div></td>
				<td><div></div></td>
				<td><?php echo html::textarea('text_de','','');?></td>
		</tr>
	<?php endif ?>
	<?php if (in_array('Technology',$crossexams)): ?>
	<tr id='technology'>
		<th>Technology 
		(CAD/Device/IC Technology)</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_technology','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('ae',$crossexams)): ?>
	<tr id='ae'>
		<th>AE</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_ae','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('layout',$crossexams)): ?>
	<tr id='layout'>
		<th>Layout</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_layout','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('testdept',$crossexams)): ?>
	<tr id='test'>
		<th>Test</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_test','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('qc',$crossexams)): ?>
	<tr id='qa'>
		<th>QA 
		(RE/FA /Quality Control)</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_qa','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('operation',$crossexams)): ?>
	<tr id='operation'>
		<th>Operation 
		(Fab/Package/Assembly)</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_operation','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('ga',$crossexams)): ?>
	<tr id='general'>
		<th>General & Administration 
		(Finance/Audit/IR/HR Software/IT/Legal/IP/Public Relationship)</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_general','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('marketing',$crossexams)): ?>
	<tr id='market'>
		<th> Marketing Incl. Marcom</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_market','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('fae',$crossexams)): ?>
	<tr id='fae'>
		<th>FAE</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_fae','','');?></td>
	</tr>
	<?php endif ?>
	<?php if (in_array('sales',$crossexams)): ?>
	<tr id='sales'>
		<th>Sales (Sales/CSR)</th>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><div></div></td>
		<td><?php echo html::textarea('text_sales','','');?></td>
	</tr>
	<?php endif ?>
		<tr><td colspan='7'><?php echo html::submitButton().html::resetButton();?></td>
		</tr>
</table>

</form>

<script type="text/javascript">
	//定义star图片的路径
	$.fn.raty.defaults.path = './js/lib/img/';

	$('form table tr td div').raty({ 
		cancel   : false, //关闭cancel
  		cancelOff: 'cancel-off-big.png',
  		cancelOn : 'cancel-on-big.png',
  		half     : false, //关闭半星
  		size     : 24,
  		starHalf : 'star-half-big.png',
  		starOff  : 'star-off-big.png',
  		starOn   : 'star-on-big.png'});
	for (var i = 0 ;i < 5 ;i++)
	{
		$('#de input:hidden:eq('+i+')').attr('name','de'+i); //重命名input表单的name
		$('#technology input:hidden:eq('+i+')').attr('name','technology'+i);
		$('#ae input:hidden:eq('+i+')').attr('name','ae'+i);
		$('#layout input:hidden:eq('+i+')').attr('name','layout'+i);
		$('#test input:hidden:eq('+i+')').attr('name','test'+i);
		$('#qa input:hidden:eq('+i+')').attr('name','qa'+i);
		$('#operation input:hidden:eq('+i+')').attr('name','operation'+i);
		$('#general input:hidden:eq('+i+')').attr('name','general'+i);
		$('#market input:hidden:eq('+i+')').attr('name','market'+i);
		$('#fae input:hidden:eq('+i+')').attr('name','fae'+i);
		$('#sales input:hidden:eq('+i+')').attr('name','sales'+i);
	}


</script>
<?php include '../../common/view/footer.html.php';?>





