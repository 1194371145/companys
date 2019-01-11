<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<?php include '../../common/view/sortable.html.php';?>

<style>
table tr td div{margin-left: auto; margin-right: auto;}
table tr{height:50px;}
table tr th{text-align:center;}	
table tr td{text-align:center;}
</style>

<div id='featurebar'>
<!-- <div><?php echo html::select('selects',$selects,$sel,"style='float:left;margin-top:4px;'");?></div> -->
<span></span><?php echo "<span id='bysearchTab'><a href='#'><span class='icon-search'></span> Search </a></span> ";?>
</div>
<script language='Javascript'>
var browseType = '<?php echo $program;?>';
</script>
<div id='querybox' class="<?php if($program=='bysearch') echo 'show';?>"><?php echo $searchForm;?></div>
<table class='table table-condensed table-hover table-striped tablesorter table-datatable table-fixed'>
	<thead>
		<tr>
			<th style="width:4%">ID</th>
			<th style="width:4%">SID</th>
			<th style="width:4%">Manager</th>
			<th style="width:10%">Item</th>
			<th>Professionality</th>
			<th>Co-operation</th>
			<th>Execution</th>
			<th>Responsibility</th>
			<th>Integrity</th>
			<th style="width:15%">Other comments</th>
			<th>Circle</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id='tbody_star'>
		<?php foreach ($datas as $v): ?>
			<tr>
				<td><?php echo $v->id;?></td>
				<td><?php echo $v->sid;?></td>
				<td><?php echo $v->manager;?></td>
				<td title="<?php echo $v->item;?>" style="text-align: left;"><?php echo $v->item;?></td>
				<td><div data-score="<?php echo $v->professionality;?>"></div></td>
				<td><div data-score="<?php echo $v->cooperation;?>"></div></td>
				<td><div data-score="<?php echo $v->execution;?>"></div></td>
				<td><div data-score="<?php echo $v->responsibility;?>"></div></td>
				<td><div data-score="<?php echo $v->integrity;?>"></div></td>
				<td title="<?php echo $v->comment;?>"><?php echo $v->comment;?></td>
				<td><?php echo preg_replace('/(\d{4})(\d{1})/','$1 $2H',$v->circletime);?></td>
				<td><?php echo html::a($this->inLink('edit',"id=$v->id"),'Edit','',"style='color:#1e232f;font-size:15px;'");?>
					<?php if ($this->app->user->account == 'admin'): ?>
						&nbsp;
						<?php echo html::a($this->inLink('delete',"id=$v->id"),'Delete','hiddenwin',"style='color:#1e232f;font-size:15px;' ");?>
					<?php endif ?>					
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<script type="text/javascript">
	//定义star图片的路径
	$.fn.raty.defaults.path = './js/lib/img/';

	$('#tbody_star tr td div').raty({
		score: function() {
   		return $(this).attr('data-score');
	},
	readOnly: true,
	size    : 24,
	starOff : 'star-off.png',
	starOn  : 'star-on.png'

  });


	// 重载页面
	$('#selects').on('change',function(){
		var circle = $('#selects').val();
		window.location.href = "http://192.168.5.8:8093/index.php?m=crossexams&f=crosslist&program=normal&circletime="+circle;
		// window.location.href = "http://localhost/performance/www/index.php?m=crossexams&f=crosslist&program=normal&circletime="+circle;
	});

</script>
<tr><td colspan='7'><?php $pager->show();?></td></tr>
<?php include '../../common/view/footer.html.php';?>