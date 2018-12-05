<?php  include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<style type="text/css">
</style>
<div class='container mw-1400px'>
  <div id='titlebar'>
    <div class='heading'>
      <strong><small class='text-muted'><i class='icon icon-plus'></i></small> <?php echo "量产主数据编辑";?></strong>
    </div>
  </div>
<form action="" method='post' enctype="multipart/form-data" target="hiddenwin" class='form-condensed'>
<table class="table table-form">
<tr>
	<th class="w-p10">箱号:</th>
	<td class='w-p25-f'><?php echo html::input('no',$mp->no,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Dvice#:</th>
	<td><?php echo html::input('device',$mp->device,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Package:</th>
	<td><?php echo html::input('package',$mp->package,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Wafer_code:</th>
	<td><?php echo html::input('wafer_code',$mp->wafer_code,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Release_code:</th>
	<td><?php echo html::input('release_code',$mp->release_code,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Company:</th>
	<td><?php echo html::input('company',$mp->company,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Top_mark:</th>
	<td><?php echo html::input('top_mark',$mp->top_mark,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Conn:</th>
	<td><?php echo html::input('wafer_lot',$mp->wafer_lot,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Qty:</th>
	<td><?php echo html::input('qty',$mp->qty,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Date:</th>
	<td><?php echo html::input('date',$mp->date,"class='form-control form-date'");?></td><td></td>
</tr>
<?php if ($this->app->user->account == 'chenqin' || $this->app->user->account == 'admin' || $this->app->user->account == 'saviny' or $this->app->user->account == 'jessie'): ?>
	<tr>	
		<th>状态:</th>
		<td><?php echo html::select('status',array("可送"=>"可送","不可送"=>"不可送"),$mp->status,"class='form-control'");?></td><td></td>
	</tr>
<?php else: ?>
	<tr style='display:none;'>	
		<th>状态:</th>
		<td><?php echo html::select('status',array("可送"=>"可送","不可送"=>"不可送"),$mp->status,"class='form-control' style='display:none;'");?></td><td></td>
	</tr>
<?php endif ?>
<tr>	
	<th>备注:</th>
	<td colspan="2"><?php echo html::textarea('remark',$mp->remark,"rows='8' class='form-control'");?></td>
</tr>
<tr><td></td><td colspan='2'><?php echo html::submitButton().html::backButton();?></td></tr>
</table>
</form>
</div>
<?php  include '../../common/view/footer.html.php';?>