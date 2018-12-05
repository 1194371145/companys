<?php  include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<style type="text/css">
</style>
<div class='container mw-1400px'>
  <div id='titlebar'>
    <div class='heading'>
      <strong><small class='text-muted'><i class='icon icon-plus'></i></small> <?php echo "样品主数据编辑";?></strong>
    </div>
  </div>
<form action="" method='post' enctype="multipart/form-data" target="hiddenwin" class='form-condensed'>
<table class="table table-form">
<?php if($app->user->account=='chenqin'){?>
<tr>
	<th class="w-p10">NO:</th>
	<td class='w-p25-f'><?php echo html::input('no',$sample->no,"class='form-control' style='display:none;'");echo $sample->no;?></td><td></td>
</tr>
<tr>	
	<th>PE:</th>
	<td><?php echo html::input('pe',$sample->pe,"class='form-control' style='display:none;'");echo $sample->pe;?></td><td></td>
</tr>
<tr>	
	<th>状态:</th>
	<td><?php echo html::input('status',$sample->status,"class='form-control' style='display:none'");echo $sample->status;?></td><td></td>
</tr>
<tr>	
	<th>Project:</th>
	<td><?php echo html::input('project',$sample->project,"class='form-control' style='display:none;'");echo $sample->project;?></td><td></td>
</tr>
<tr>		
	<th>Wafer_code:</th>
	<td><?php echo html::input('wafer_code',$sample->wafer_code,"class='form-control' style='display:none;'");echo $sample->wafer_code;?></td><td></td>
</tr>
<tr>		
	<th>Options:</th>
	<td><?php echo html::input('options',$sample->options,"class='form-control' style='display:none;'");echo $sample->options;?></td><td></td>
</tr>
<tr>		
	<th>Device:</th>
	<td><?php echo html::input('device',$sample->device,"class='form-control' style='display:none;'");echo $sample->device;?></td><td></td>
</tr>
<tr>		
	<th>Mark:</th>
	<td><?php echo html::input('mark',$sample->mark,"class='form-control' style='display:none;'");echo $sample->mark;?></td><td></td>
</tr>
<tr>		
	<th>Package:</th>
	<td><?php echo html::input('package',$sample->package,"class='form-control' style='display:none;'");echo $sample->package;?></td><td></td>
</tr>
<tr>		
	<th>Qty:</th>
	<td><?php echo html::input('qty',$sample->qty,"class='form-control' style='display:none;'");$sample->qty;?></td><td></td>
</tr>
<tr>	
	<th>Inventry:</th>
	<td><?php echo html::input('inventry',$sample->inventry,"class='form-control' style='display:none;'");echo $sample->inventry;?></td><td></td>
</tr>
<tr>	
	<th>Ordert#:</th>
	<td><?php echo html::input('ordert',$sample->ordert,"class='form-control' style='display:none;'");echo $sample->ordert;?></td><td></td>
</tr>
<tr>	
	<th>工厂:</th>
	<td><?php echo html::input('factory',$sample->factory,"class='form-control' style='display:none;'");echo $sample->factory;?></td><td></td>
</tr>
<tr>	
	<th>包装</th>
	<td><?php echo html::input('packagetype',$sample->packagetype,"class='form-control' style='display:none;'");echo $sample->packagetype;?></td><td></td>
</tr>
<tr>	
	<th>WaferLot:</th>
	<td><?php echo html::input('waferlot',$sample->waferlot,"class='form-control' style='display:none;'");echo $sample->waferlot;?></td><td></td>
</tr>
<tr>	
	<th>片号:</th>
	<td><?php echo html::input('ids',$sample->ids,"class='form-control' style='display:none;'");echo $sample->ids;?></td><td></td>
</tr>
<tr>
<tr>	
	<th>申请时间</th>
	<td><?php echo html::input('date',$sample->date,"class='form-control form-date' style='display:none;'");echo $sample->date;?></td><td></td>
</tr>
<tr>	
	<th>TEST</th>
	<td><?php echo html::input('test',$sample->test,"class='form-control' style='display:none;'");echo $sample->test;?></td><td></td>
</tr>
<tr>	
	<th>Note</th>
	<td><?php echo html::input('note',$sample->note,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>备注:</th>
	<td colspan="2"  style='display:none;'><?php echo html::textarea('remark',$sample->remark,"rows='8' class='form-control'");?></td><td><?php echo $sample->remark; ?></td>
</tr>
<tr>	
	<th>核对:</th>
	<td colspan="2"><?php echo html::select('approve',$lang->sample->hedui,$sample->approve,"class='form-control' style='width:18%;'");?></td>
</tr>
<?php }?>
<?php if($app->user->account=='huangli'){ ?>
<tr>
	<th class="w-p10">NO:</th>
	<td class='w-p25-f'><?php echo html::input('no',$sample->no,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>PE:</th>
	<td><?php echo html::input('pe',$sample->pe,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>状态:</th>
	<td><?php echo html::input('status',$sample->status,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Project:</th>
	<td><?php echo html::input('project',$sample->project,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Wafer_code:</th>
	<td><?php echo html::input('wafer_code',$sample->wafer_code,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Options:</th>
	<td><?php echo html::input('options',$sample->options,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Device:</th>
	<td><?php echo html::input('device',$sample->device,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Mark:</th>
	<td><?php echo html::input('mark',$sample->mark,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Package:</th>
	<td><?php echo html::input('package',$sample->package,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Qty:</th>
	<td><?php echo html::input('qty',$sample->qty,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Inventry:</th>
	<td><?php echo html::input('inventry',$sample->inventry,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Ordert#:</th>
	<td><?php echo html::input('ordert',$sample->ordert,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>工厂:</th>
	<td><?php echo html::input('factory',$sample->factory,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>包装</th>
	<td><?php echo html::input('packagetype',$sample->packagetype,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>WaferLot:</th>
	<td><?php echo html::input('waferlot',$sample->waferlot,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>片号:</th>
	<td><?php echo html::input('ids',$sample->ids,"class='form-control'");?></td><td></td>
</tr>
<tr>
<tr>	
	<th>申请时间</th>
	<td><?php echo html::input('date',$sample->date,"class='form-control form-date'");?></td><td></td>
</tr>
<tr>	
	<th>TEST</th>
	<td><?php echo html::input('test',$sample->test,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Note</th>
	<td><?php echo html::input('note',$sample->note,"class='form-control' style='display:none;'");echo $sample->note;?></td><td></td>
</tr>
<tr>	
	<th>备注:</th>
	<td colspan="2"><?php echo html::textarea('remark',$sample->remark,"rows='8' class='form-control'");?></td>
</tr>
<tr>	
	<th>核对:</th>
	<td colspan="2"><?php echo html::select('approve',$lang->sample->hedui,$sample->approve,"class='form-control' style='width:18%;display:none;'");echo $lang->sample->hedui[$sample->approve];?></td>
</tr>
<?php }?>
<?php if($cpower){ ?>
<tr>
	<th class="w-p10">NO:</th>
	<td class='w-p25-f'><?php echo html::input('no',$sample->no,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>PE:</th>
	<td><?php echo html::input('pe',$sample->pe,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>状态:</th>
	<td><?php echo html::input('status',$sample->status,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Project:</th>
	<td><?php echo html::input('project',$sample->project,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Wafer_code:</th>
	<td><?php echo html::input('wafer_code',$sample->wafer_code,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Options:</th>
	<td><?php echo html::input('options',$sample->options,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Device:</th>
	<td><?php echo html::input('device',$sample->device,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Mark:</th>
	<td><?php echo html::input('mark',$sample->mark,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Package:</th>
	<td><?php echo html::input('package',$sample->package,"class='form-control'");?></td><td></td>
</tr>
<tr>		
	<th>Qty:</th>
	<td><?php echo html::input('qty',$sample->qty,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Inventry:</th>
	<td><?php echo html::input('inventry',$sample->inventry,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Ordert#:</th>
	<td><?php echo html::input('ordert',$sample->ordert,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>工厂:</th>
	<td><?php echo html::input('factory',$sample->factory,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>包装</th>
	<td><?php echo html::input('packagetype',$sample->packagetype,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>WaferLot:</th>
	<td><?php echo html::input('waferlot',$sample->waferlot,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>片号:</th>
	<td><?php echo html::input('ids',$sample->ids,"class='form-control'");?></td><td></td>
</tr>
<tr>
<tr>	
	<th>申请时间</th>
	<td><?php echo html::input('date',$sample->date,"class='form-control form-date'");?></td><td></td>
</tr>
<tr>	
	<th>TEST</th>
	<td><?php echo html::input('test',$sample->test,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>Note</th>
	<td><?php echo html::input('note',$sample->note,"class='form-control'");?></td><td></td>
</tr>
<tr>	
	<th>备注:</th>
	<td colspan="2"><?php echo html::textarea('remark',$sample->remark,"rows='8' class='form-control'");?></td>
</tr>
<tr>	
	<th>核对:</th>
	<td colspan="2"><?php echo html::select('approve',$lang->sample->hedui,$sample->approve,"class='form-control' style='width:18%;'");?></td>
</tr>
<?php }?>
<tr><td></td><td colspan='2'><?php echo html::submitButton().html::backButton();?></td></tr>
</table>
</form>
</div>
<?php  include '../../common/view/footer.html.php';?>