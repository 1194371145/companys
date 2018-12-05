<?php include "../../common/view/header.html.php";?>
<?php include '../../common/view/treeview.html.php';?>
<?php include '../../common/view/colorize.html.php';?>
<?php include '../../common/view/tablesorter.html.php';?>
<style type="text/css">
#wgcfixedtheadoflist{margin:-10px;padding:0px;}
#wgcfixedtheadoflist{margin-top:-20px;}
#wgcfixedtheadoflist td,#wgcfixedtheadoflist th{font-size:12px;text-align:left;}
</style>
<div id='featurebar'>
<ul class='nav'>
    <li id='bysearchTab'><a href='#'><i class='icon-search icon'></i>&nbsp;Search</a></li>
  </ul>
<div class='actions'>
<?php echo html::a($this->createLink('sampleapp','exportdatasample',"type=All"),'Export All Data','','style="float:right;"');?>
&nbsp;
<?php echo html::a($this->createLink('sampleapp','exportdatasample',"type=re"),'Export Data','','style="float:right;margin-right:15px;"');?>
</div>
<div id='querybox' class='<?php if($type == 'search'){ echo 'show';}?>'><?php echo $searchForm;?></div>
</div>
<script language='Javascript'>
var browseType = '<?php echo $browseType;?>';
</script>
<form action="" method="post" name="mybatchform" target="hiddenwin">
<table class='table table-condensed  table-striped tablesorter table-fixed' style="overflow:auto;" id='wgcfixedtheadoflist'>
<thead>
<tr>
<th style="width:25px;"></th>
<th style='width:120px;text-align:left;'>Action</th>
<th>Name</th>
<th>RequestDate</th>
<th>RequstType</th>
<th>part</th>
<th>Mapping</th>
<th>AE</th>
<th>EndName</th>
<th>DisName</th>
<th style="width:70px;">Quantity</th>
<th style="width:60px">price</th>
<th style="width:70px;">PayStatus</th>
<th style="width:60px;">area</th>
<th>ShipOrder</th>
<th>ShipDate</th>
<th>Pre_shipdDate</th>
<th>Status</th>
<th>Note</th>
<th>Remark</th>
<th>Reason</th>
</tr>
</thead>
<?php 
foreach($samplelist as $v)
{
?>
<tr style="text-align:center;">
<td>
	<?php 
	if (common::hasPriv('sampleapp','batchaudit') and strpos("admin,lynn,henry,torch,tim",$this->app->user->account) !==false) 
	{
			if ($v->approve !== '0' and $v->approve !=='2') 
			{
				if ($this->app->user->account == 'lynn') 
				{
					if ($v->areamanager=='2' and empty($v->salesmanager)) 
					{
			 		echo "<input type='checkbox' value='$v->id' name='batchapp[$v->id]' '/>";
					}
				} else {
					if (empty($v->areamanager)) 
					{
			 		echo "<input type='checkbox' value='$v->id' name='batchapp[$v->id]' '/>";
					}
				}
			}			
	}
	?>
</td>
<td style="text-align:left;font-weight:bold;">
	<?php echo html::a($this->createLink('sampleapp','getsample',"id={$v->id}"),"<font color='red'>View</font>");?>
&nbsp;
	<?php //判断权限
	if (common::hasPriv('sampleapp','audit') and strpos("admin,lynn,henry,torch,tim",$this->app->user->account) !==false) 
	{
			if ($v->approve !== '0' and $v->approve !=='2') 
			{
				if ($this->app->user->account == 'lynn') 
				{
					if ($v->areamanager=='2' and empty($v->salesmanager)) 
					{
			 		echo "<a href='#' class='check' id=$v->id approve=$v->approve partn=$v->partn><font color='red'>Approve</font></a>";	
					}
				} else {
					if (empty($v->areamanager)) 
					{
			 		echo "<a href='#' class='check' id=$v->id approve=$v->approve partn=$v->partn><font color='red'>Approve</font></a>";	
					}
				}
			}
			
	}
	if (common::hasPriv('sampleout','deleteout') and $v->person==$this->app->user->account and $v->close=='wait') {
		echo "&nbsp;";
		echo html::a($this->createLink('sampleout','deleteout',"id={$v->id}"),"<font color='red'>Delete</font>",'hiddenwin');
	}
	?>
</td>
		<td title="<?php echo $v->person; ?>"><?php echo $v->person;?></td>
		<td title="<?php echo $v->rdate; ?>"><?php echo $v->rdate;?></td>
		<td title="<?php echo $v->rtype; ?>"><?php echo $v->rtype;?></td>
		<td title="<?php echo $v->partn; ?>"><?php echo $v->partn;?></td>
		<td title="<?php echo $v->mappingfrom; ?>"><?php echo $v->mappingfrom;?></td>
		<td title="<?php echo $v->ae; ?>">
		<?php 
			if($v->rtype =='demo')
			{
				$email=$this->dao->select("email")->from("zt_user")->where('account')->in(explode(',',$v->ae))->fetchPairs('email',"email");
				echo '<a href="mailto:'.implode(";",$email).'" target="_blank" style="color:blue;">'.$v->ae." </a>";
			}
			else
			{
				echo "";
			}
		?>
		</td>
		<td title="<?php echo $v->endname;?>"><?php echo $v->endname;?></td>
		<td title="<?php echo $v->distributor;?>"><?php echo $v->distributor;?></td>
		<td><?php echo $v->qty;?></td>
		<td><?php echo $v->price;?></td>
		<td style="color:blue;"><?php if($v->revtype=='不需付费'){echo "Free";}else{ echo "Pay";} ?></td>
		<td class="js_area"><?php echo $v->area;?></td>
		<td title="<?php echo $v->shiporder; ?>"><?php echo $v->shiporder;?></td>
		<td title="<?php echo $v->shipdate; ?>"><?php echo $v->shipdate;?></td>
		<td title="<?php echo $v->preshipdate; ?>"><?php echo $v->preshipdate;?></td>
		<td class="my_status"><?php 
		if ($v->close=='wait') 
		{
			if ($v->area=='NC' || $v->area=='SC' || $v->area=='TW') 
			{
				if ($v->approve == '1' or $v->approve == '3') 
				{
					if ($v->area =='NC'){$area = 'henry';}						
					if ($v->area =='SC'){$area = 'torch';}						
					if ($v->area =='TW'){$area = 'tim';}						
					if (empty($v->areamanager) and empty($v->salesmanager)) 
					{
						// echo "<b style='color:red;'>Waiting for ".$area." approve</td>";
						echo "<b style='color:red;'>Pending...</b>";
					}
					if ($v->areamanager == '1' and empty($v->salesmanager)) 
					{
						echo "<b style='color:red;'>Rejected by ".$area."</d>";

					}
					if ($v->areamanager == '2' and empty($v->salesmanager)) 
					{
						// echo "<b style='color:red;'>Waiting for lynn approve</td>";
						echo "<b style='color:red;'>Approved by ".$area."</b>";
					}
					if ($v->areamanager == '2' and $v->salesmanager=='1') 
					{
						echo "<b style='color:red;'>Rejected by lynn</d>";
					}
					if ($v->areamanager == '2' and $v->salesmanager=='2') 
					{
						// echo "<b style='color:green;'>Approve has passed,Waiting for shipment</td>";
						echo "<b style='color:red;'>NOT shipped</b>";
					}
				}
				if ($v->approve == '0') 
				{
					echo "<b style='color:red;'>NOT shipped</b>"; 
				}
				if ($v->approve == '2') 
				{
					// echo "<b style='color:green;'>Approve has passed,Waiting for shipment</td>";
					echo "<b style='color:red;'>NOT shipped</b>";
				}
			} else {
				echo "<b style='color:red;'>NOT shipped</b>";
			}
		}
		
		if($v->close=='done'){echo "<b style='color:green;'>Shipped</b>";}
		?></td>
		<td title="" class="my_td" style="color:blue;">
			<?php
			if ($v->approve=='1' and ($v->area=='NC' or $v->area=='SC') and ($v->revtype != '需要付费')) {
				echo "Free request quantity excess 30pieces,need approve";
			}
			if ($v->approve=='1' and ($v->area=='TW') and ($v->revtype != '需要付费')) {
				echo "Free request quantity excess 100pieces,need approve";
			}
			if ($v->approve == '1' and $v->revtype == '需要付费') {
				echo "Pay request quantity excess 500pieces,need approve";
			}
			if ($v->approve=='3') {
				echo "Release date excess 3 year,need approve";
			}
			?>
		</td>
		<td title="<?php echo $v->remark;?>"><?php echo $v->remark;?></td>
		<!-- Reason -->
		<td title="<?php echo $v->reason;?>" style='color:red;'><b><?php echo $v->reason;?></b></td>
		
</tr>
<?php 
}
?>
 <tr id='batchAgree'>
	<td colspan="17">
		<?php if (common::hasPriv('sampleapp','batchaudit') and strpos("admin,lynn,henry,torch,tim",$this->app->user->account) !==false) {
		echo "<input type='submit' value='批量审核' class='btn btn-primary' onclick='batchapprove()'>";
		} ?>
	</td>
 </tr>

</table>
</form>
<!-- 分页 -->
<div style="margin-bottom: 30px;margin-top: 10px;"><?php echo $pager->show();?></div>
<script type="text/javascript">
// 显示  title
$('.my_td').on('mouseover',function(){
	$(this).attr('title',$(this).html());
});
$('.my_td').on('mouseout',function(){
	$(this).attr('title','');
});

// 显示 status title
$('.my_status').on('mouseover',function(){
	$(this).attr('title',$(this).find('b').html());
});
$('.my_status').on('mouseout',function(){
	$(this).attr('title','');
});


// approve
$('.check').click(function(){
	
	var id = this.getAttribute('id')
	var approve = this.getAttribute('approve')
	var partn = this.getAttribute('partn')
	var obj = this; 

	var str = '';
	// //请求出货量
	// $.ajax({
	// 	type:'get',
	// 	url: "<?php echo $this->createLink('sampleapp','getshipmentbypart');?>",
	// 	data:'part='+ partn,
	// 	dataType: 'json',
	// 	async:false,
	// 	success:function(data){

	// 		if (data >= 100) {str = 'This agent has shipped 100k in the past three months,which can be shipped in bulk';} else {str =''}
	// 	},
	// 	error:function(){
	// 		// alert('ajax请求失败!');
	// 	}
	// });

	layer.confirm('Are you sure ? <br /> If you reject it.you must add reason',{
		icon: 3,
		area:'350px',
		title:'Warning',
		btn:['Agree','Reject','Cancel']
	},
	function(index){
		layer.close(index);  // 同意 回调函数
		window.location.href="<?php echo $this->createLink('sampleapp','audit')?>"+"&id="+id+"&status=1";
	}, function(index){
		layer.prompt({      // 拒绝 回调函数
		formType: 2,
		value: '',
		title: 'Please Add remark or It will not submit',
		area: ['300px', '100px'] //自定义文本域宽高
		}, function(value, index, elem){
		// alert(value); //得到value
		layer.close(index);
		window.location.href="<?php echo $this->createLink('sampleapp','audit')?>"+"&id="+id+"&status=2&reason="+value;
		});
		// layer.close(index);
		// window.location.href="<?php echo $this->createLink('sampleapp','audit')?>"+"&id="+id+"&status=2";
	}, function(){
	// layer.msg("取消");  // 取消 无操作
	});

	
});


	// 批量同意
	function batchapprove()
	{
		if(confirm('Are you sure batch agreement?'))
		{
			document.mybatchform.action="<?php echo $this->createLink('sampleapp','batchaudit');?>";
			document.mybatchform.submit();
		} else {
			window.location.reload(); // 重载页面并刷新
		}

	}

</script>
<?php include "../../common/view/footer.html.php";?>
