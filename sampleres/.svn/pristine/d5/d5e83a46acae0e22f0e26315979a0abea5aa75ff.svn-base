<?php include '../../common/view/header.html.php';?>
<form method='post' target='hiddenwin'>
<table align='center' class='table-5' style="width:700px;">
  <caption><?php echo $lang->project->statusUndone?></caption>
  <tr>
    <th class='w-80px'><?php echo $lang->sampleapp->id?></th>
    <th><?php echo $lang->sampleapp->project_tracking_num?></th>
    <th><?php echo $lang->sampleapp->customer_name?></th>
    <th class='w-150px'><?php echo $lang->sampleapp->status?></th>
    <th class='w-130px'><?php echo $lang->sampleapp->order?></th>
  </tr>
  <?php foreach($projects as $project):?>
  <?php if($project->deleted != 0 && $project->status >= 0 ) continue;?>
  <tr class='a-center'>
    <td><?php echo $project->id?></td>
    <td class='a-left'><?php echo $project->project_tracking_num?></td>
    <td class='a-left'><?php echo $project->customer_name?></td>
    <td><?php 
	$sv = "s".$project->status;
	echo $project->status." - ".$lang->project->statusv->$sv;
	?></td>
    <td><?php echo html::input($project->id, $project->order, "size='5'")?></td>
  </tr>
  <?php endforeach;?>
  <tr><td colspan='5' align='center'><?php echo html::submitButton() . html::resetButton()?></td></tr>
</table>
</form>
<form method='post' target='hiddenwin' style="display:none;">
<table align='center' class='table-5'>
  <caption><?php echo $lang->project->statusDone?></caption>
  <tr>
    <th class='w-80px'><?php echo $lang->project->id?></th>
    <th><?php echo $lang->project->name?></th>
    <th class='w-80px'><?php echo $lang->project->order?></th>
  </tr>
  <?php foreach($projects as $project):?>
  <?php if($project->status != 'done') continue;?>
  <tr class='a-center'>
    <td><?php echo $project->id?></td>
    <td class='a-left'><?php echo $project->name?></td>
    <td><?php echo html::input($project->id, $project->order, "size='5'")?></td>
  </tr>
  <?php endforeach;?>
  <tr><td colspan='3' align='center'><?php echo html::submitButton() . html::resetButton()?></td></tr>
</table>
</form>
<?php include '../../common/view/footer.html.php';?>

