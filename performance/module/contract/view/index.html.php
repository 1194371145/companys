<?php 
include '../../common/view/header.html.php'; 
include '../../common/view/kindeditor.html.php';
include '../../common/view/datepicker.html.php';
?>
<!-- css -->
<style>
	#main{width:70%;margin:0 auto;border:0px solid #000;}
	#top_left{float:left;width:250px;}
	#top_right{float:left;}
	#contract_top::before,#contract_top::after{
		content: "";
		display:table;
	}
	#contract_top::after{clear:both;}
	#title_left{float:left;border:2px solid black;width:300px;}
	#title_right{float:right;}
	#contract_title{height:50px;}
	#contract_title::before,#contract_title::after{
		content: "";
		display:table;
	}
	#contract_title::after{clear:both;}
	#colmd3 td .row .col-md-3{padding: 6px 19px;}

</style>
<!-- html -->
<form action="" method='post' target='hiddenwin' enctype="multipart/form-data" name="MyContractForm">
	<div class="dropdown"  style='float:left;margin-top:10px;margin-left: 20px;'> <!-- 下拉area -->
	  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    选择区域 (默认不选为杭州)
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style='width:100%;'>
	    <li><?php echo html::a($this->inLink('index','area=1'),'Corp (CP)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=2'),'杭州 (HZ)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=3'),'南京 (NJ)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=4'),'Samoa(SM)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=5'),'西安 (XA)','','') ?></li>
	    <!--<li>--><?php //echo html::a($this->inLink('index','area=6'),'工程 (GC)','','') ?><!--</li>-->
	    <li><?php echo html::a($this->inLink('index','area=7'),'上海 (SH)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=8'),'成都 (CD)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=9'),'美国 (US)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=10'),'台湾 (TW)','','') ?></li>
	    <li><?php echo html::a($this->inLink('index','area=11'),'韩国 (KR)','','') ?></li>
	    <!--<li>--><?php //echo html::a($this->inLink('index','area=12'),'英沃 (YW)','','') ?><!--</li>-->
          <li><?php echo html::a($this->inLink('index','area=13'),'香港 (HK)','','') ?></li>
          <li><?php echo html::a($this->inLink('index','area=14'),'日本 (JA)','','') ?></li>
          <li><?php echo html::a($this->inLink('index','area=15'),'印度 (IN)','','') ?></li>

          <li role="separator" class="divider"></li>
	    <li><a href="#">Other link</a></li>
	  </ul>
	</div> <!-- 下拉area END -->
<div id='main'>
	<div id='shenqingfile' style='float:right;margin-top:20px;'>
		<label for="selffile">Filename:合约附件</label>
		<input type="file" name="myfile" id="selffile" />
		<p class="help-block">请选择要上传的合约附件.</p>
	</div> <!-- file END -->
	<div id='contract_top'>
		<div id='top_left'>
		<img src="/data/image/silergy.jpg" alt="" width="100">
		</div>
		<div id='top_right'>
			<span style='font-size:32px;'><?php echo $companytitle; ?></span>
			<h2><b style="font-size:25px;"><?php echo $this->lang->contract->titleFrom; ?></b></h2>
		</div>
	</div>
	<div id='contract_title'>
		<div id='title_left' style='height:50px;'>
			<div id='title_left_p' style="float:left;margin-top:5px;">
					&nbsp;合约管理编号:<br/>&nbsp;Contract Control No.:			
			</div>
			<div id='title_left_pp' style="float:left;margin-top:15px;margin-left:20px;">
				<b><input type="text" value="<?php echo $control; ?>" style='width:100px;border:0;' name='contract_control'></b>
			</div>
		</div>
		<div id='title_right' style='line-height:50px;margin-right:0px;'>
			<span>Date:<u><?php echo date('Y');?></u>/<u><?php echo date('m');?></u>/<u><?php echo date('d');?></u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('Y').'年'.date('m').'月'.date('d').'日';?></span>
		</div>
	</div>
	<table style='border:2px solid #000;overflow:hidden;margin-top:5px;' border-collapse="collapse" align="center" class="table table-bordered">
		<tr>
			<th width='110'>申请部门<br/>Application Dept.</th>
			<!-- <td><input type="text" name='contract_dept' class='form-control'></td> -->
			<td><?php echo html::select('contract_dept',$this->config->contract->dept,'',"style='' class='form-control' autocomplete='off'"); ?></td>
			<th>部门主管<br />Dept. Manager</th>
			<!-- <td><input type="text" name='contract_manager' class='form-control'></td> -->
			<td><?php echo html::select('contract_manager','','',"style='' class='form-control' autocomplete='off'"); ?></td>
			<th>合约对象<br/>Contract Party</th>
			<td><input type="text" name='contract_party' class='form-control'></td>
		</tr>
		<tr>
			<th>合约名称<br/>Contract Title</th>
			<td colspan="3"><input type="text" name='contract_title' class='form-control'></td>
			<!--<th>对方公司<br/>Party B</th>-->
			<!--<td><input type="text" name='contract_otherparty' class='form-control'></td>-->
			<th>文件页数<br/>Number of Pages</th>
			<td><input type="text" name='contract_number' class='form-control'></td>
		</tr>
		<tr>
			<th rowspan="4">合同内容及会审部门<br/>Contract Content & Review Dept</th>
			<td colspan='5'>由【法务单位】审核合同内容并排定以下相关部门会审顺序 (于括号内以1,2,3...列示) : Legal Service Dept. recommends the following departments to review and comment (review order shown as 1,2,3...etc. in the parenthesis below)　</td>
		</tr>			
		<tr>
			<td>合同起迄时间<br/>Time Periods</td>
			<td>合约对象<br/>Contract Obiect</td>
			<td>主要内容摘要<br/>Main Content</td>
			<td>限制条款<br/>Restrictive Clause</td>
			<td>重要与否<br/>Important</td>
		</tr>
		<tr>
			<td><b>生效时间 :</b><input type="text" name="" class='form-control form-date' disabled/><br/> <b>过期时间 :</b><input type="text" name="" class='form-control form-date' disabled/></td>
			<td>
				<label><input  disabled type="radio" value="Y"/> 集团(group): </label><br/>
				<label><input  disabled type="radio" value="N"/> 个别公司<br/>(company): </label>
			</td>
			<td><textarea  disabled rows="5" class='form-control'></textarea></td>
			<td><textarea  disabled rows="5" class='form-control'></textarea></td>
			<td><label><input  disabled type="radio" value="Y"/> 是 (Y) </label><br/>
				<label><input  disabled type="radio" value="N"/> 否 (N) </label>
			</td>
		</tr>
		<tr id='colmd3'>
			<td colspan="4" style='height:120px;'>
					<div class='row'>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Finance 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;HR 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;IT 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;AE 
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Sales 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;FAE 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;QA 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;IC 
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Layout/CAD 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Technology 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Packaging 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Audit 
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Marketing
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Foundry 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;IP 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Construction 
						</div>
					</div>
					<div class='row'>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Public Relations
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Test
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Operation 
						</div>
						<div class='col-md-3'>
							<input type="checkbox" disabled> &nbsp;Legal
						</div>
					</div>
			</td>
			<td rowspan="2">
				<b>共计 __ 会审部门</b><br/><b>Total: ___ Dept.</b><br/><br/>
			</td>
		</tr>
		<tr id='table_type'>
			<th>合约类型<br/>Contract Type</th>
			<td colspan="4">
			<table class='table' width="100%" style='border:0px solid #000'>
				<tr>
					<td><input type="checkbox" name='' value='' disabled> 销售 (Sales)</td>
					<td><input type="checkbox" name='' value='' disabled> 采购 (Purchase)</td>
					<td><input type="checkbox" name='' value='' disabled> 专利 (Patent)</td>
					<td><input type="checkbox" name='' value='' disabled> 研发 (R&D)</td>
				</tr>
				<tr>
					<td><input type="checkbox" name='' value='' disabled> 委外 (Outsource)</td>
					<td><input type="checkbox" name='' value='' disabled> 股权 (Stock)</td>
					<td><input type="checkbox" name='' value='' disabled> 融资 (Finance)</td>
					<td><input type="checkbox" name='' value='' disabled> 租凭 (Lease)</td>
				</tr>
				<tr>
					<td><input type="checkbox" name='' value='' disabled> 集团 (Group)</td>
					<td><input type="checkbox" name='' value='' disabled> 固资 (Fixed assets)</td>
					<td><input type="checkbox" name='' value='' disabled> 其他 (Others)</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<th colspan="6">
				* 经排定之会审部门请依会审顺序, 于以下字段表示意见并签章. * Each review department please provides your comments and seal in the boxes below as the review order shown above.
			</th>
		</tr>
	</table>
	<table class='table table-bordered' width='100%' style='border:2px solid #000;overflow:hidden;margin-top:-2px;border-top: 0;' border-collapse="collapse" align="center" >
		<tr>
			<th>顺序<br/>order</th>
			<td colspan="2">意 见 说 明 / 签 章<br/>Comments/Signature</td>
			<th>顺序<br/>order</th>
			<td colspan="2">意 见 说 明 / 签 章<br/>Comments/Signature</td>
		</tr>
		<?php for ($i=1; $i <=5 ; $i++) { ?>
			<tr>
				<th style='text-align:center;'><?php echo $i; ?></th>
				<td colspan='2'>
					<label><input name="" type="radio" value="1" disabled /> 同意</label>
					<label><input name="" type="radio" value="2" disabled/> 需改进</label>
					<label><input name="" type="radio" value="3" disabled/> 拒绝</label>
					<textarea name="" id="" cols="35" rows="2" disabled></textarea>
				</td>
				<th style='text-align:center;'><?php echo $i + 5; ?></th>
				<td colspan='2'>
					<label><input name="" type="radio" value="1" disabled/> 同意</label>
					<label><input name="" type="radio" value="2" disabled/> 需改进</label>
					<label><input name="" type="radio" value="3" disabled/> 拒绝</label>
					<textarea name="" id="" cols="35" rows="2" disabled>
					</textarea></td>
			</tr>
		<?php } ?>
		<tr>
			<th colspan='1'>备注说明<br/>Remark</th>
			<td colspan='5'>
				<textarea name="contract_remark" id="" cols="20" rows="2" class='form-control' style="resize:none;"></textarea>
			</td>
		</tr>
		<tr>
			<th colspan="6">备注: 申请部门->法务部门 (审核合同并排定会审顺序) ->各会审部门->申请部门 (详阅会审意见并协商修改) ->法务部门 (确定最终合同文本) ->行政人事部门 (用印申请及存查合约会审单正本) -> 文档归档.<br/>Process: Application Dept.->Legal Service Dept.(arrange review order)->Each Review Dept.(provide comments and seal)->Application Dept.(complete signing with contract party)->Legal Service Dept.(Determine the final text of the contract)->HR Dept.(final review and application for seal)->Audit(file)</th>
		</tr>
		<input type="hidden" name="contract_area" value="<?php echo $area; ?>">
	</table>
	<p><b>ICS-H-10-02-02-A2</b></p>
	<table width='100%'>
		<tbody>
			<tr><td colspan="6" align="center"><?php echo "<input type='button' class='btn btn-primary' id='mysubmitbut' value='Save'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::resetButton();?></td></tr>
		</tbody>
	</table>
</div>
	
</form>

<!-- js -->
<script>
	$(function(){
		$('.show_select').on('click',function(){
			var sta = $(this).attr('checked');
			if (sta == 'checked') 
			{
				$(this).next().attr('style','');
			} else {
				$(this).next().attr('style','display:none;');
			}
		});


		// 提示
		$('#mysubmitbut').on('click',function(){
			// console.log($('#contract_top #top_right').find('span').html());
			var title = $('#contract_top #top_right').find('span').html();

			if (confirm('您申请的公司为 '+ title + ' 确定要申请吗?')) 
			{
				document.MyContractForm.action="<?php echo $this->createLink('contract','index');?>";
				document.MyContractForm.submit();
			} else {
				window.location.reload(); // 重载页面并刷新
			}
		});


		// 部门 对应主管
		$('#contract_dept').on('change',function(){
			var dept = $('#contract_dept').val();
	        var depts = document.getElementById("contract_manager")   //获取二级
	        // console.log(dept,depts);
			$.ajax({
				url:"<?php echo $this->inLink('ajaxgetdept'); ?>",
				type:'post',
				dataType:'JSON',
				data:{'dept':dept},
				success:function (res){
					// console.log(res);
	              var deptlength = depts.options.length;
	              if(deptlength >0){               //去除二级的<optioin>的属性值
	                for( var j=0;j<deptlength;j++){
	                depts.options.remove(0)
	                }
	              }
	              var tt = []; // 将json数据转为数组
	              for (var i in res) {
	                  tt[i] = res[i];
	              }

	              for(var j in tt){                         //创建二级的<option>
	              	addoption(j,tt[j])
	              }
	            },
	            error:function(){
	            	console.log('fail');
	            }
			});


			// 自定义添加option函数
			function addoption(value,text){
		      var opt = document.createElement("option")
		      opt.value = value
		      opt.text = text
		      depts.options.add(opt)
		    }
		});





	});

	

</script>

<?php include '../../common/view/footer.html.php';?>
