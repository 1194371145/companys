<?php 
include '../../common/view/header.html.php';
js::set('myId',$datas->id);
?>
<style>
	form table tr th{width:15%;height:40px;}
	table tr td span{font-size:15px;color:red;}
</style>
<form action="" method='post' target='hiddenwin' id='editsubmit'>
	<table class='table table-condensed table-hover table-striped tablesorter table-datatable' style="overflow:auto;">
	<caption style="font-size:18px;color:black;"><b>Details</b></caption>
	<tr>
		<th>SID:</th>
		<td><?php echo $datas->sid;?></td>
	</tr>
	<tr>
		<th>Manager:</th>
		<td><?php echo $datas->manager;?></td>
	</tr>
	<tr>
		<th>CID:</th>
		<td><?php echo $datas->cid;?></td>
	</tr>
	<tr>
		<th>Item:</th>
		<td><?php echo $datas->item;?></td>
	</tr>
	<tr>
		<th>Professionality:</th>
		<td><?php echo html::select('professionality',$lang->crossexams->selects,$datas->professionality,"style='width:100px;'");?>
			<span></span>
		</td>
	</tr>
	<tr>
		<th>Co-operation:</th>
		<td><?php echo html::select('cooperation',$lang->crossexams->selects,$datas->cooperation,"style='width:100px;'");?>
			<span></span>
		</td>
	</tr>
	<tr>
		<th>Execution:</th>
		<td><?php echo html::select('execution',$lang->crossexams->selects,$datas->execution,"style='width:100px;'");?>
			<span></span>
		</td>
	</tr>
	<tr>
		<th>Responsibility:</th>
		<td><?php echo html::select('responsibility',$lang->crossexams->selects,$datas->responsibility,"style='width:100px;'");?>
			<span></span>
		</td>
	</tr>
	<tr>
		<th>Integrity:</th>
		<td><?php echo html::select('integrity',$lang->crossexams->selects,$datas->integrity,"style='width:100px;'");?>
			<span></span>
		</td>
	</tr>
	<tr>
		<th>Othre comments:</th>
		<td><?php echo html::textarea('comment',$datas->comment,"style='width:80%;font-size:18px;' rows=5");?>
			<span></span>
		</td>
	</tr>
	<tr>
		<th>Circletime:</th>
		<td><?php echo $datas->circletime;?></td>
	</tr>
	<tr>
		<td colspan='7' style="text-align: center;"><?php echo html::commonButton("Save","onclick='editsubmit();' style='background-color:#304269;color:#fff'").'&nbsp'.html::BackButton()?></td>
	</tr>
	<input type="hidden" name='id' value="<?php echo $datas->id;?>">
	</table>
</form>

<script type="text/javascript">
	function mySelect() //自定义加载函数
	{
		var selects = $("table tr td select"); //得到select标签集合
		for (var i = 0; i < selects.length; i++) 
		{
			var select = $("table tr td select:eq("+i+")");
			var n = select.val();
			switch(n)
			{
			case '5':
			  select.next('span').html('Gorgeous');
			  break;
			case '4':
			  select.next('span').html('Good');
			  break;
			case '3':
			  select.next('span').html('Regular');
			  break;
			case '2':
			  select.next('span').html('Poor');
			  break;
			case '1':
			  select.next('span').html('Bad');
			  break;	
			default:
			}
		}
	}

	//首次加载自动触发
	mySelect();

	// change
	$("table tr td select").on('change',function(){
		mySelect(); //change事件触发
	});

	//submit 验证
	function editsubmit()
	{
		layer.confirm(
			'Are you sure you want to submit it ?',
			{btn:['Agree','Refuse'],title:'Warm prompt'},
			function(index){
				layer.close(index);
				$("#editsubmit").submit();
			},
			function(){
				layer.msg('You cancel this operation',{shift: -1},function(){
					window.location.reload(); //刷新当前页面
				});

		});

	}

</script>
<?php include '../../common/view/action.html.php'; ?>
<?php include '../../common/view/footer.html.php';?>
