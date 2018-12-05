
<?php if(isset($tips)):?>
<?php include '../../common/view/header.lite.html.php';?>
<?php include '../../common/view/colorbox.html.php';?>
<body style='background:white'>
<script language='Javascript'>
var tips      = <?php echo json_encode($tips);?>;
var projectID = <?php echo $projectID;?>;
defaultURL    = createLink('project', 'task', 'projectID=' + projectID);
$(document).ready(function() 
{
    $.fn.colorbox({html:tips, open:true, width:480, height:280});
    setTimeout( function() {location.href=defaultURL}, 5000);
});
</script>
</body>
</html>
<?php exit;?>
<?php endif;?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<style>
.wgc1 { border:none;}
#first_a,#first_end { position:absolute; width:180px; height:auto; left:0px; top:20px; background:#CCC; display:none; z-index:999;}
#first_end { width:330px;}
</style>
<script>
var region = "<?php echo $this->app->user->address ;?>";
$().ready(function(){
                        var A;
						var B;
						var C;
						$("#price_dis").bind('blur',function(){
                                                              if(region == "CN" || region == "SCN" || region == "NCN")
															  {
																  B = $("#price_dis").val();
															  }
															  else
															  {
																  B = $("#price_cus").val() ;
															   }
															   C = (parseFloat($("#price_cus").val(),10) - parseFloat($("#price_dis").val(),10))/B;
															   $("#commission").val((C*100).toFixed(2));
															 });
							$("#price_cus").bind('blur',function(){
                                                               if(region == "CN" || region == "SCN" || region == "NCN")
															  {
																  B = $("#price_dis").val();
															  }
															  else
															  {
																  B = $("#price_cus").val();
															   }
															   C = (parseFloat($("#price_cus").val(),10) - parseFloat($("#price_dis").val(),10))/B;
															   $("#commission").val((C*100).toFixed(2));
															 });						
						
						
						//初始化discode,end_cus_code and bind value
						$("#end_cus_code").val($("#end_customer").find('option:selected').text()); 
						$("#discode").val($("#distributor").find('option:selected').text()); 
						$("#end_customer").bind('blur',function(){
																  $("#end_cus_code").val($("#end_customer").find('option:selected').text()); 
																})

						$("#end_customer").bind('change',function(){
							                                      var dkey = $("#end_customer").find('option:selected').val();
                                                                  $("#end_custmp").val($("#end_customer").find('option:selected').val()); 
														          $.post('index.php?m=project&f=ajaxGetDisCode',{cardcode:dkey},function(v){
																															              $("#distributor").val(v);  
																																	  }) 

																})
						$("#distributor").bind('blur',function(){
																  $("#discode").val($("#distributor").find('option:selected').text()); 
																})
					//part number 
					$("#partnumber").focus().live('keyup',function(){
														     var nkey=$.trim($(this).val());
															 if(nkey==''||nkey==null)
															 {
			                                                   $("#first_a").hide();
															 }
															 else
															 {
																$.post('index.php?m=project&f=ajaxGetPartNo',{cardcode:nkey},function(v){
																																	  
																																	  $("#first_a").html(v);  
																																	  $("#first_a").show();
																																	  
			                                                    $("#first_a table tr td a").live('click',function(){
					                                            $("#partnumber").val($(this).attr('id'));
					                                            $("#first_a").hide('slow');})
																																	  }) 
															 }
														   })
					
					//end customer
										//part number 
					$("#end_custmp").focus().live('keyup',function(){
														     var nkey=$.trim($(this).val());
															 if(nkey==''||nkey==null)
															 {
			                                                   $("#first_end").hide();
															 }
															 else
															 {
																$.post('index.php?m=project&f=ajaxGetEndCode',{cardcode:nkey},function(v){
																																	  
																																	  $("#first_end").html(v);  
																																	  $("#first_end").show();
																																	  
			                                                    $("#first_end table tr td a").live('click',function(){
					                                            $("#end_custmp").val($(this).attr('id'));
																var dkey = $(this).attr('id');
														        $.post('index.php?m=project&f=ajaxGetDisCode',{cardcode:dkey},function(v){
																															             $("#distributor").val(v);  
																																	  }) 
																$("#end_customer").val($(this).attr('id'));
					                                            $("#first_end").hide('slow');})
																																	  }) 
															 }
														   })
					
					
				   })
function wgchidden()
{
	$("#first_a").hide('slow');
}
function wgchiddenend()
{
	$("#first_end").hide('slow');
}
</script>
<form method='post' target='hiddenwin'>
  <table align='center' class='table-1 a-left'> 
    <caption><?php echo $lang->project->create;?> Request For Quotation Form</caption>
    <tr>
      <th class='rowhead' style="width:200px;"><?php echo $lang->project->rfqcode;?></th>
      <td><?php echo html::input('rfqcode', $rfqcode, "class='text-3'");?>
      &nbsp;
      Must be Unique<span title='region+name(3 characters)+Y+m+d+self increasing number' class='question'> ? </span>
      </td>
    </tr>

     
    <tr>
      <th class='rowhead'><?php echo $lang->project->region;?></th>
      <td><?php echo html::select('region', $lang->project->regions,$copyproject->region,"class='text-3'");?></td>
    </tr>     
    
    <tr>
      <th class='rowhead' style="width:200px;"><?php echo $lang->project->sales;?></th>
      <td>
	  <?php //echo html::select('sales', $salesall,$sales,"class='text-3'");?>
	  <?php echo html::select('sales', $salesall,$copyproject->sales,"class='text-3'");?>
      </td>
    </tr> 
    <tr>
      <th class='rowhead' style="width:200px;"><?php echo $lang->project->fae;?></th>
      <td>
      <!--< ?php echo html::select('fae', $faeall,$fae,"class='text-3'");?>-->
      <?php echo html::input('fae', $copyproject->fae, "class='text-3'");?>
      </td>
    </tr>  
    <tr>
      <th class='rowhead' style="width:200px;"><?php echo "End Application";?></th>
      <td><?php echo html::select('endapp',$lang->project->endcat,$copyproject->endapp,"class='text-3' ");?>
      </td>
    </tr>     
    <tr style="display:none">
      <th class='rowhead' style="width:200px;"><?php echo $lang->project->oldrfq;?></th>
      <td>
	      <?php //echo html::select('oldrfq', $oldrfq,$copyproject->oldrfq, "style='width:500px;'");?>
         
      </td>
    </tr> 
        
             
    <tr style="display:none">
      <th class='rowhead'  ><?php echo $lang->project->end_cus_code;?></th>
      <td><?php echo html::input('end_cus_code', $copyproject->end_cus_code, "class='text-3'");?>
      <?php echo html::input('discode', $copyproject->discode, "class='text-3'");?>
      </td>
    </tr> 
    <tr>
      <th class='rowhead'><?php echo $lang->project->partnumber;?></th>
      <td>
      <span style="position:relative">
	  <?php echo html::input('partnumber', $copyproject->partnumber, "class='text-3'");?>
      <div id="first_a">Loading...</div>
      </span>
      &nbsp;<font class='question' title='如果产品名不存在可以直接输入产品名称即可但必须是标准的part no.&#10 I have remove the limit that Part Number must exists in ERP.But Part Number must be confirme'>?</font>&nbsp;<a href="index.php?m=project&f=parttips"  id="fuckyou" class="cboxElement">Part NUM does not exist.</a></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;">Example:SY7063QMC &nbsp; <!--Part Number must exist in ERP -->.
      </td>
    </tr>  
    <tr>
      <th class='rowhead'><?php echo "RFQ Type";?></th>
      <td><?php echo html::select('rfqtype', array(''=>'Please Select...','normal'=>'Normal','sample'=>'Sample','die'=>'Die Stock'),'', "class='text-2 ' ");?>&nbsp;&nbsp;<font class='question' title='Idle Stock ,呆料的意思'>?</font></td>
    </tr> 
    <tr>
      <th class='rowhead'><?php echo $lang->project->end_customer;?></th>
      <td>
       <span style="position:relative">
	  <?php echo html::input('end_custmp', $copyproject->end_customer, "class='text-5' style='width:150px;'");?><font style="color:red;">(←fuzzy search)</font>
      <div id="first_end">sdfsdf</div>
      </span>     
	  &nbsp;&nbsp;&nbsp;&nbsp;
	  <?php echo html::select('end_customer',$endcustomer ,$copyproject->end_customer, "class='text-3'");?>
      &nbsp;&nbsp;<font style='color:red;font-weight:bold;font-size:14px;' title='同步最新终端客户信息及代理商信息'><?php common::printLink('shipment', 'updatedisandend', "", "Synchronize data from ERP","hiddenwin");?></font> <a target='blank' href = "index.php?m=admin&f=index&type=allcus" title='所有终端客户信息查询'>All End Customer</a>&nbsp;&nbsp;<span style="color:red"><a href="index.php?m=project&f=customtips"  id="customernoexist" class="cboxElement">End Customer/Distributor does not exist. <span style="font-weight:bold">click here</span></a></span>&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
    </tr>     
    <tr>
      <th class='rowhead'><?php echo $lang->project->distributor;?></th>
      <td>
	  <?php echo html::select('distributor', $distributor,$copyproject->distributor, "class='text-3'");?>   
        
      </td>
    </tr>
    <tr>
      <th class='rowhead'><?php echo $lang->project->valid_period;?></th>
      <td><?php
	  if($copyproject->validperiod)
	  {
		  $vaildvalue = $copyproject->validperiod;
	  }
	  else
	  {
		  $vaildvalue = "-1";
	   }
	  echo html::input('validperiod', $vaildvalue, "class='text-2'");?>
     &nbsp;<font style="color:#F00">Enter an integer value(-1:never expir;30 means 30 days)</font>
      </td>
    </tr>    
    <tr>
      <th class='rowhead'><?php echo $lang->project->price_cus;?></th>
      <td><?php echo html::input('price_cus', $copyproject->price_cus, "class='text-2'");?>  $
      </td>
    </tr>     
     <tr>
      <th class='rowhead'><?php echo $lang->project->price_dis;?></th>
      <td><?php echo html::input('price_dis', $copyproject->price_dis, "class='text-2' ");?> $</td>
    </tr>
     <tr>
      <th class='rowhead'><?php echo $lang->project->usage;?></th>
      <td><?php echo html::input('usage', $copyproject->usage, "class='text-2' ");?> Unit(K)</td>
    </tr>    
     <tr>
      <th class='rowhead'><?php echo $lang->project->commission;?></th>
      <td><?php echo html::input('commission', $copyproject->commission, "class='text-2' ");?> % &nbsp;&nbsp;<font class='question' title='(end customer price - distributor price) / end customer price or distributor price'>?</font></td>
    </tr>    
     <tr>
      <th class='rowhead'><?php echo $lang->project->reason;?></th>
      <td><?php echo html::textarea('reason', $copyproject->reason, "rows='6' class='area-1'");?></td>
    </tr>
    
  
    
     <tr>
      <th class='rowhead' style="width:200px;"><?php echo $lang->project->purpose;?></th>
      <td><?php echo html::input('purpose', $copyproject->purpose, "class='text-3'");?>
      </td>
    </tr>      
    <tr>
      <th class='rowhead'><?php echo $lang->project->date;?></th>
      <td><?php echo html::input('date', date('Y-m-d'), "class='text-2 date' ");?></td>
    </tr>   


    
<!--    <tr>
      <th class='rowhead'>< ?php echo $lang->project->oldrfq;?></th>
      <td>< ?php echo html::input('date', $project->oldrfq, "class='text-2' ");?></td>
    </tr> -->
 
          
    <tr style="display:none;">
      <th class='rowhead'><?php echo $lang->project->teamname;?></th>
      <td><?php echo html::input('team', 'team'.rand(1,1000), "class='text-3'");?></td>
    </tr>  
 
    <tr style="display:none;">
      <th class='rowhead'><?php echo $lang->project->acl;?></th>
      <td><?php echo nl2br(html::radio('acl', $lang->project->aclList, $acl, "onclick='setWhite(this.value);'"));?></td>
    </tr>  
    <tr id='whitelistBox' style="display:none;">
      <th class='rowhead'><?php echo $lang->project->whitelist;?></th>
      <td><?php echo html::checkbox('whitelist', $groups, '1,8');?></td>
    </tr>  
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton() . html::resetButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.html.php';?>
