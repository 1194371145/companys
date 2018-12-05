<?php include "../../common/view/header.html.php";?>
<?php include "../../common/view/autocomplete.html.php";?>
<style type="text/css">
.table th{width:15%;text-align:right;padding-right:10px;}
.area-1{width:90%;}
.text-3{width:20%;}
.table tr td span{color:red;font-size:18px;font-weight:bold;display:inline;}

</style>
<form action="" method='post' target="hiddenwin" id='confirmsubmit' enctype="multipart/form-data">
<table class="table">
<tr><th></th><td style="font-size:15px;font-weight:bold;">Sample Application Form</td></tr>
<tr>	
	<th>Name:</th>
	<td><?php echo html::input('person',$name,"class='text-3'");?><span class="star">*</span></td>
</tr>
<tr>	
	<th>RF#:</th>
	<td><?php echo html::input('rf',date("YmdHis"),"class='text-3'");?></td>
</tr>
<tr>		
	<th>Request Date:</th>
	<td><?php echo html::input('rdate',date("Y-m-d"),"class='text-3 date'");?></td>
</tr>
<tr>		
	<th>Request Type:</th>
	<td><?php echo html::select('rtype',array("sample"=>"sample","demo"=>"EVB"),"sample","class='text-3' onchange='demotype1(this);'");?><span class="star">*</span></td>
</tr>
<tr id='partbut'>		
	<th>Part Number:</th>
	<td>
	<?php echo html::input('partn',"","class='text-3' style='display:;'");?><span class="star">*</span><em id='myPartn' style="font-size:20px;"></em>
	</td>
</tr>
<tr>		
	<th>Package Type:</th>
	<td><?php echo html::input('package',"","class='text-3'");?></td>
</tr>
<tr>	
	<th>Mode of payment:</th>
	<td><?php echo html::select('revtype',array("需要付费"=>"Pay",'不需付费'=>"Free"),"","class='text-3' onchange='qingkong();'");?><b style='color:red;display:none;'></b><span class="star">*</span></td>
</tr>
<tr>		
	<th>End Customer:</th>
	<td><?php echo html::input('endname',"","class='text-3'");?></td>
</tr>
<tr>	
	<th>Distributor:</th>
	<td><?php echo html::select('distributor',$dis,"","class='text-3'");?><span id='span'></span><b style='color:red;'><span class="star">*</span>If the samples are paid , must select a distributor . </b></td>
</tr>
<tr>	
	<th>Price:</th>
	<td><?php echo html::input('price',0,"class='text-3'");?><b style='color:red;'>$ (Must USD !!)</b></td>
</tr>
<tr>	
	<th>Project Name:</th>
	<td><?php echo html::input('projectname',"","class='text-3'");?></td>
</tr>
<tr>	
	<th>Quantity:</th>
	<td><?php echo html::input('qty',0,"class='text-3'");?><span class="star">*</span></td>
</tr>
<tr>
<tr>	
	<th>Stage(1-7#):</th>
	<td><?php echo html::input('stage',"","class='text-3'");?></td>
</tr>
<tr id='demotypetr'>	
	<th>DemoType:</th>
	<td><?php echo html::select('demotype',array(""=>"","stardard"=>"stardard","customized"=>"customized"),"","class='text-3'");?><span id='span'></span><b style='color:red;'><span class="star"></span>If you apply for EVB, you must select a value.</b></td>
</tr>
<tr id='demofile'>	
	<th>Demo customized file:</th>
	<td><?php echo html::file('files');?><span id='span'></span><b style='color:red;'><span class="star"></span>If customized EVB is required, upload files must be uploaded.</b></td>
</tr>
<tr>
	<th>Mail payment method</th>
	<td><?php echo html::select('mailpay',array("contract_sender"=>"contract_sender","receiver"=>"receiver"),'contract_sender',"class='text-3'");?></td>
</tr>
<tr>	
	<th>Receipt company:</th>
	<td><?php echo html::input('tocompany',"","class='text-3'");?><span class="star">*</span></td>
</tr>
<tr>	
	<th>Consignee:</th>
	<td><?php echo html::input('toperson',"","class='text-3'");?><span class="star">*</span></td>
</tr>
<tr>	
	<th>Contact number:</th>
	<td><?php echo html::input('tomobile',"","class='text-3'");?><span class="star">*</span></td>
</tr>
<tr>	
	<th>Detailed Address:</th>
	<td><?php echo html::input('toaddress',"","class='area-1'");?><span class="star">*</span></td>
</tr>

<tr>	
	<th>Remark:</th>
	<td><?php echo html::textarea('remark',$out->remark,"class='area-1' rows=6");?>
	<?php echo html::hidden('createdate',date("Y-m-d H:i:s"));?>
   <?php echo html::hidden('openby',$name);?>
	</td>
</tr>
<tr><td><?php echo html::hidden('area', $address, '');?></td>
	<td>
	<?php echo html::commonButton("Save","onclick='confirmsubmit();'");?>
	</td>
</tr>
</table>
</form>
<script type="text/javascript">
var autoListall = "<?php echo join(',', $autolistall);?>".split(',');
$(function(){
    $("#partn").autocomplete(autoListall,{multiple: false,mustMatch: true});
	//$("#demotypetr").css("display","none");
	//$("#demotype").attr('disabled',"disabled");
	//$("#demofile").css("display","none");
});
function demotype11(e)
{
    if(e.value=='demo')
	{
		$("#demotypetr").css("display","");
		$("#demotype").attr('disabled',false);
		$("#demofile").css("display","");
	}
	else
	{
		$("#demotypetr").css("display","none");
		$("#demotype").attr('disabled',"disabled");
		$("#demofile").css("display","none");
	}

}
function checkdis()
{
	if($("#revtype").val()=='需要付费')
	{
	var disv=$("#distributor").val();
	$.ajax({
		url:"<?php echo $this->createLink('project','checksampledis');?>" +"&dis="+disv,
		type:"post",
		data:"dis="+disv,
		dataType:"html",
		success:function(e){
		if(e)
		{
			$("#span").text(e);
		}
		else
		{
			$("#span").html("<b style='margin-right:10px;font-size:15px;'>not match</b>");
			$("#distributor").val("");
		}	
		}
		});
	}
	else{$("#span").html("");}
	
}
function qingkong()
{
	$("#distributor").val("");
}
function confirmsubmit()
{
	var source_area = $('#hidden_area').val(); //得到用户来源区域
	var sam = $('#rtype').val(); // 得到样品类型
	var revtype = $('#revtype').val(); //得到付费信息
	var qty = $('#qty').val();  //得到申请数量
	var partn = $('#partn').val(); //得到料号 
	var approve1 = '';
	var App_person = ''; // 审核人
	var person = '';
	if (sam == 'sample') 
	{
		switch(source_area)
		{
		case 'NC':
		case 'CN':
		  App_person = 'henry or lynn'; //审核人
		  break;
		case 'SC':
		  App_person = 'torch or lynn';
		  break;
		case 'TW':
		   App_person = 'tim or lynn';
		   break;
		default:
		   App_person = 'lynn';
		   break;
		}
		if ((source_area == 'CN' || source_area == 'NC' || source_area == 'SC') && partn !== '')
		{
			$.ajax({
				type:"get",
				url: "<?php echo $this->inLink('ajaxgetpart');?>",
				data:'partn='+partn,
				dataType:'json',
				async:false,
				success:function(e){

					if (e == 0) {approve1 = '1'} else {approve1 = '2'}
				},
				error:function(){
				}
			});
		}else if(source_area =='TW' && partn !== '')
		{
			approve1 = '4';  // 来自台湾
		} else {
			approve1 = '3';  //区域来自 中国以外的
		}

		if (approve1 == '1') 
		{
			person = "P3 release date excess 3 year must be checked by "+App_person+" approve";
		} 
		if(approve1 == '2') 
		{			
			if (revtype == '不需付费' && qty > 30) 
				{person = "Free request quantity excess 30pieces must be checked by "+App_person+" approve";
		}else if(revtype != '不需付费' && qty > 500){
			person = "Pay request quantity excess 500pieces must be checked by "+App_person+" approve";
		} else {
			person = "Are you sure to submit it? You will not be able to edit after submit.";
		}
		}	

		if (approve1 == '4') 
		{    
			if (revtype == '不需付费' && qty > 100) 
				{person = "Free request quantity excess 100pieces must be checked by "+App_person+" approve";
		}else if(revtype != '不需付费' && qty > 500){
			person = "Pay request quantity excess 500pieces must be checked by "+App_person+" approve";
		} else {
			person = "Are you sure to submit it? You will not be able to edit after submit.";

		}

		}
		
		if (approve1 == '3') {person = "Are you sure to submit it? You will not be able to edit after submit.";}

		if(confirm(person))
		{
			$("#confirmsubmit").submit();
		}

	} else {
		if(confirm("Are you sure to submit it? You will not be able to edit after submit."))
		{
			$("#confirmsubmit").submit();
		}
	}


}

</script>
<?php include "../../common/view/footer.html.php";?>