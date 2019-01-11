<?php 
include '../../common/view/header.html.php'; 
include '../../common/view/kindeditor.html.php';
include '../../common/view/datepicker.html.php';
?>
<?php js::set('over',$data->over); ?>
<?php js::set('legal',$data->legalapprove); ?>
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

</style>
<!-- html -->
<form action="" method='post' target='hiddenwin' enctype="multipart/form-data">
	<!-- 查看附件按钮 -->
	<div class="dropdown" style='float:right;margin-top:20px;margin-right:80px;'> <!-- 下拉area -->
	  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    查看所有合约附件
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style='width:100%;'>
	  	<?php foreach ($filearr1 as $k => $v) { ?>
	     <li><?php echo html::a($this->inLink('viewfile',"fileid=$v->id"),"第".($k+1)."版 (".$v->realname.")",'_blank','') ?></li>
	  	<?php } ?>
	  	<?php if (!empty($filearr2)) { ?>
	    <li role="separator" class="divider"></li>
	    <?php foreach ($filearr2 as $key => $value) { ?>
	    <li><?php echo html::a($this->inLink('viewfile',"fileid=$value->id"),"法务修订".($key+1)."版 (".$value->realname.")",'_blank','');
	    ?></li>
	    <?php } ?>
	    <?php } ?>
	    <?php if (!empty($filearr3)) { ?>
	     <li role="separator" class="divider"></li>
	     <?php foreach ($filearr3 as $key => $value) { ?>
	     <li><?php echo html::a($this->inLink('viewfile',"fileid=$value->id"),"会审人修订".($key+1)."版 (".$value->realname.")",'_blank','');
	     ?></li>
	     <?php } ?>
	     <?php } ?>
	    <?php if (!empty($data->legalapprove)) { ?>
	    <li role="separator" class="divider"></li>
	 	<li><?php echo html::a($this->inLink('viewfile',"fileid=".$fileHis->id),"最终版 (".$fileHis->realname.")",'_blank','');
	    ?></li>
	    <?php } ?>
	  </ul>
	</div> <!-- 下拉area END -->
<div id='main'>
	<div id='upfile' style='float:right;margin-top:20px;'>
		<label for="file">Filename:合约附件</label>
		<input type="file" name="myFile" id="editselfile"  />
		<p class="help-block">请选择要上传的合约附件.</p>
	</div>
	<div id='contract_top'>
		<div id='top_left'>
		<img src="/data/image/silergy.jpg" alt="" width="100">
		</div>
		<div id='top_right'>
			<span style='font-size:32px;'><?php echo $this->lang->contract->title[$data->areaid]; ?></span>
			<h2><b style="font-size:25px;"><?php echo $this->lang->contract->titleFrom; ?></b></h2>
		</div>
	</div>
	<div id='contract_title'>
		<div id='title_left' style='height:50px;'>
			<div id='title_left_p' style="float:left;margin-top:5px;">
					&nbsp;合约管理编号:<br/>&nbsp;Contract Control No.:			
			</div>
			<div id='title_left_pp' style="float:left;margin-top:15px;margin-left:20px;">
				<b><?php echo $data->control;?></b>
			</div>
		</div>
		<div id='title_right' style='line-height:50px;margin-right:0px;'>
			<span>Date:<u><?php echo substr($data->createdate,0,4);?></u>/<u><?php echo substr($data->createdate,5,2);?></u>/<u><?php echo substr($data->createdate,8,2);?></u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo substr($data->createdate,0,4).'年'.substr($data->createdate,5,2).'月'.substr($data->createdate,8,2).'日';?>
			</span>
		</div>
	</div>
	<table style='border:2px solid #000;overflow:hidden;margin-top:5px;' border-collapse="collapse" align="center" class="table table-bordered">
		<tr>
			<th width='110'>申请部门<br/>Application Dept.</th>
			<td><?php echo html::select('contract_dept',$this->config->contract->dept,$data->dept,"style='' class='form-control' autocomplete='off'"); ?></td>
			<th>部门主管<br />Dept. Manager</th>
			<td><?php echo html::select('contract_manager',$this->config->contract->select[$data->dept],$data->manager,"style='' class='form-control' autocomplete='off'"); ?></td>
			<th>合约对象<br/>Contract Party</th>
			<td><input type="text" name='contract_party' value='<?php echo $data->party;?>' class='form-control'></td>
		</tr>
		<tr>
			<th>合约名称<br/>Contract Title</th>
			<td colspan="3"><input type="text" name='contract_title' value='<?php echo $data->title;?>' class='form-control'></td>

			<th>文件页数<br/>Number of Pages</th>
			<td><input type="text" name='contract_number'  value='<?php echo $data->pager;?>' class='form-control'></td>
		</tr>
		<tr>
			<th rowspan="4">合同内容及会审部门<br/>Contract Content & Review Dept</th>
			<td colspan='5'>由【法务单位】审核合同内容并排定以下相关部门会审顺序 (于括号内以1,2,3...列示) : Legal Service Dept. recommends the following departments to review and comment (review order shown as 1,2,3...etc. in the parenthesis below)　</td>
		</tr>			
		<tr>
			<td>合同起迄时间<br/>Time Periods</td>
			<td>合约对象<br/>Contract Object</td>
			<td>主要内容摘要<br/>Main Content</td>
			<td>限制条款<br/>Restrictive Clause</td>
			<td>重要与否<br/>Important</td>
		</tr>
		<tr>
			<td><b>生效时间 :</b><input type="text" name="" value="<?php echo $data->startime;?>" class='form-control form-date' disabled/><br/> <b>过期时间 :</b><input type="text" name="" value="<?php echo $data->endtime;?>" class='form-control form-date' disabled/></td>
			<td>
				<label><input type="radio" value="" disabled <?php if($data->object == 'group') echo ' checked';?>/>
				集团(group): </label><br/>
				<label><input type="radio" value="" disabled <?php if($data->object == 'company') echo ' checked';?>/>
				个别公司(company): </label>
			</td>
			<td><textarea id="" cols="25" rows="5" disabled  class='form-control'><?php echo $data->maincontent;?></textarea></td>
			<td><textarea id="" cols="25" rows="5" disabled  class='form-control'><?php echo $data->clause;?></textarea></textarea></td>
			<td><label><input type="radio" value="" disabled <?php if($data->close == 'Y') echo ' checked';?>/>
			是 (Y) </label><br/>
				<label><input type="radio" value="" disabled <?php if($data->close == 'N') echo ' checked';?>/>
				否 (N) </label>
			</td>
		</tr>
		<tr>
			<td colspan="4" style='height:120px;'>
				<table width="100%" style='border:0px solid #000' class='table' id='editselfcontent'>
					<tr>
						<td><input type="checkbox" value='Finance' <?php if($stat['Finance']) echo ' checked=checked';?>> Finance <?php 
						if ($stat['Finance']) {
						echo html::select('a[1]',$select['Finance'],$stat['Financemanager']," class='form-control' autocomplete='off' ");
						} else {
						echo html::select('a[1]',$select['Finance'],'',"style='display:none;' class='form-control' autocomplete='off' ;");
						}
						?></td>
						<td><input type="checkbox" value='HR' <?php if($stat['HR']) echo ' checked=checked';?>> HR <?php 
						if ($stat['HR']) {

						echo html::select('a[2]',$select['HR'],$stat['HRmanager'],"style='display:;' class='form-control' autocomplete='off'");

						} else {
						echo html::select('a[2]',$select['HR'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" value='IT' <?php if($stat['IT']) echo ' checked=checked';?>> IT <?php 
						if ($stat['IT']) {

						echo html::select('a[3]',$select['IT'],$stat['ITmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[3]',$select['IT'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" value='System' <?php if($stat['System']) echo ' checked=checked';?>> AE <?php 
						if ($stat['System']) {

						echo html::select('a[4]',$select['System'],$stat['Systemmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[4]',$select['System'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox" value='Sales' <?php if($stat['Sales']) echo ' checked=checked';?>> Sales <?php 
						if ($stat['Sales']) {

						echo html::select('a[5]',$select['Sales'],$stat['Salesmanager'],"style='display:;' class='form-control' autocomplete='off'"); 
						} else {
						echo html::select('a[5]',$select['Sales'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" value='FAE' <?php if($stat['FAE']) echo ' checked=checked';?>> FAE <?php 
						if ($stat['FAE']) {

						echo html::select('a[6]',$select['FAE'],$stat['FAEmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[6]',$select['FAE'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} ?></td>
						<td><input type="checkbox" value='QA' <?php if($stat['QA']) echo ' checked=checked';?>> QA <?php 
						if ($stat['QA']) {

						echo html::select('a[7]',$select['QA'],$stat['QAmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[7]',$select['QA'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" value='IC' <?php if($stat['IC']) echo ' checked=checked';?>> IC Design <?php 
						if ($stat['IC']) {

						echo html::select('a[8]',$select['IC'],$stat['ICmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[8]',$select['IC'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox" value='Layout' <?php if($stat['Layout']) echo ' checked=checked';?>> Layout/CAD <?php 
						if ($stat['Layout']) {

						echo html::select('a[9]',$select['Layout'],$stat['Layoutmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[9]',$select['Layout'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" value='TEchology' <?php if($stat['TEchology']) echo ' checked=checked';?>> Technology <?php 
						if ($stat['TEchology']) {

						echo html::select('a[10]',$select['TEchology'],$stat['TEchologymanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[10]',$select['TEchology'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox"  value='Packing' <?php if($stat['Packing']) echo ' checked=checked';?>> Packaging <?php 
						if ($stat['Packing']) {

						echo html::select('a[11]',$select['Packing'],$stat['Packingmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[11]',$select['Packing'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" value='Audit' <?php if($stat['Audit']) echo ' checked=checked';?>> Audit <?php 
						if ($stat['Audit']) {

						echo html::select('a[12]',$select['Audit'],$stat['Auditmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[12]',$select['Audit'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox"  value='Marketing' <?php if($stat['Marketing']) echo ' checked=checked';?>> Marketing <?php 
						if ($stat['Marketing']) {

						echo html::select('a[13]',$select['Marketing'],$stat['Marketingmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[13]',$select['Marketing'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox"  value='Foundry' <?php if($stat['Foundry']) echo ' checked=checked';?>> Foundry <?php 
						if ($stat['Foundry']) {

						echo html::select('a[14]',$select['Foundry'],$stat['Foundrymanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[14]',$select['Foundry'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox"  value='IP' <?php if($stat['IP']) echo ' checked=checked';?>> IP <?php 
						if ($stat['IP']) {

						echo html::select('a[15]',$select['IP'],$stat['IPmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[15]',$select['IP'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox"  value='Construction' <?php if($stat['Construction']) echo ' checked=checked';?>> Construction <?php 
						if ($stat['Construction']) {

						echo html::select('a[16]',$select['Construction'],$stat['Constructionmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[16]',$select['Construction'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox"  value='Public' <?php if($stat['Public']) echo ' checked=checked';?>> Public Relations <?php 
						if ($stat['Public']) {

						echo html::select('a[17]',$select['Public'],$stat['Publicmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[17]',$select['Public'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
						<td><input type="checkbox"  value='Test' <?php if($stat['Test']) echo ' checked=checked';?>> Test <?php 
						if ($stat['Test']) {

						echo html::select('a[18]',$select['Test'],$stat['Testmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[18]',$select['Test'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
						<td><input type="checkbox"  value='Operation' <?php if($stat['Operation']) echo ' checked=checked';?>> Operation <?php 
						if ($stat['Operation']) {

						echo html::select('a[19]',$select['Operation'],$stat['Operationmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

						} else {
						echo html::select('a[19]',$select['Operation'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
						<td><input type="checkbox"  value='LG' <?php if($stat['LG']) echo ' checked=checked';?>> Legal <?php
						if ($stat['LG']) {
						echo html::select('a[20]',$select['LG'],$stat['LGmanager'],"style='display:;' class='form-control' autocomplete='off'"); 
						} else {
						echo html::select('a[20]',$select['LG'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
					</tr>
				</table>
			</td>
			<td rowspan="2">
				共计 <b class='huishensum'><?php echo $data->sum;?></b>&nbsp;会审部门<br/>Total: <b class='huishensum'><?php echo $data->sum;?></b>&nbsp;Dept.<br/><br/><b>法务 : </b><input type="text" name="contract_legal" value="<?php echo $data->legalapprove; ?>" class="form-control" disabled><br /><b>Legal Service :</b><textarea name="" id="" cols="20" rows="5" class="form-control" disabled><?php echo $data->legalservice; ?></textarea>
			</td>
		</tr>
		<tr id='table_type'>
			<th>合约类型<br/>Contract Type</th>
			<td colspan="4">
				<table class='table' width="100%" style='border:0px solid #000' id='editselftable'>
					<tr>
						<td><input type="checkbox" name='contract_type[1]' value='SA' <?php if(strpos($data->type,'SA') !== false) echo ' checked'; ?>> 销售(Sales)</td>
						<td><input type="checkbox" name='contract_type[2]' value='PU' <?php if(strpos($data->type,'PU') !== false) echo ' checked';?>> 采购(Purchase)</td>
						<td><input type="checkbox" name='contract_type[3]' value='PA' <?php if(strpos($data->type,'PA') !== false) echo ' checked';?>> 专利(Patent)</td>
						<td><input type="checkbox" name='contract_type[4]' value='RD' <?php if(strpos($data->type,'RD') !== false) echo ' checked';?>> 研发(R&D)</td>
					</tr>
					<tr>
						<td><input type="checkbox" name='contract_type[5]' value='OU' <?php if(strpos($data->type,'OU') !== false) echo ' checked';?>> 委外(Outsource)</td>
						<td><input type="checkbox" name='contract_type[6]' value='SH' <?php if(strpos($data->type,'SH') !== false) echo ' checked';?>> 股权(Stock)</td>
						<td><input type="checkbox" name='contract_type[7]' value='LO' <?php if(strpos($data->type,'LO') !== false) echo ' checked';?>> 融资(Finance)</td>
						<td><input type="checkbox" name='contract_type[8]' value='LE' <?php if(strpos($data->type,'LE') !== false) echo ' checked';?>> 租凭(Lease)</td>
					</tr>
					<tr>
						<td><input type="checkbox" name='contract_type[9]' value='GR' <?php if(strpos($data->type,'GR') !== false) echo ' checked';?>> 集团(Group)</td>
						<td><input type="checkbox" name='contract_type[10]' value='FI' <?php if(strpos($data->type,'FI') !== false) echo ' checked';?>> 固资(Fixed assets)</td>
						<td><input type="checkbox" name='contract_type[11]' value='OT' <?php if(strpos($data->type,'OT') !== false) echo ' checked';?>> 其他(Others)</td>
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
	<table class='table table-bordered' width='100%' style='border:2px solid #000;overflow:hidden;margin-top:-2px;' border-collapse="collapse" align="center" id='editselfhuishen'>
		<tr>
			<th>顺序<br/>order</th>
			<td colspan="2">意 见 说 明 / 签 章<br/>Comments/Signature</td>
			<th>顺序<br/>order</th>
			<td colspan="2">意 见 说 明 / 签 章<br/>Comments/Signature</td>
		</tr>
		<?php for ($i=1; $i <= 5 ; $i++) { ?>
		<tr>
			<th><?php echo $i;if($comments[$i-1]->approvedept){echo ' ('.$comments[$i-1]->approvedept.')';}?></th>
			<td colspan='2'>
				<label><input name="" type="radio" value="1" <?php if($comments[$i-1]->approve == '1') echo ' checked';?>/> 同意</label>
				<label><input name="" type="radio" value="2" <?php if($comments[$i-1]->approve == '2') echo ' checked';?>/> 需改进</label>
				<label><input name="" type="radio" value="3" <?php if($comments[$i-1]->approve == '3') echo ' checked';?>/> 拒绝</label>
				<textarea name="" id="" rows="3" style="width:65%;"><?php echo $comments[$i-1]->comments;?></textarea>
			</td>
			<th><?php echo $i + 5;if($comments[$i+4]->approvedept){echo ' ('.$comments[$i+4]->approvedept.')';}?></th>
			<td colspan='2'>
				<label><input name="" type="radio" value="1" <?php if($comments[$i+4]->approve == '1') echo ' checked';?>/> 同意</label>
				<label><input name="" type="radio" value="2" <?php if($comments[$i+4]->approve == '2') echo ' checked';?>/> 需改进</label>
				<label><input name="" type="radio" value="3" <?php if($comments[$i+4]->approve == '3') echo ' checked';?>/> 拒绝</label>
				<textarea name="" id="" rows="3" style="width:65%;"><?php echo $comments[$i+4]->comments;?></textarea>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th colspan='1'>备注说明<br/>Remark</th>
			<td colspan='5'>
				<textarea name="contractself_remark" id="contractself_remark" cols="20" rows="3" class='form-control' style="resize:none;"><?php echo $data->remark; ?></textarea>
			</td>
		</tr>
		<tr>
			<th colspan="6">备注: 申请部门->法务部门 (审核合同并排定会审顺序) ->各会审部门->申请部门 (详阅会审意见并协商修改) ->法务部门 (确定最终合同文本) ->行政人事部门 (用印申请及存查合约会审单正本) -> 文档归档.<br/>Process: Application Dept.->Legal Service Dept.(arrange review order)->Each Review Dept.(provide comments and seal)->Application Dept.(complete signing with contract party)->Legal Service Dept.(Determine the final text of the contract)->HR Dept.(final review and application for seal)->Audit(file)</th>
		</tr>
	</table>
	<p>ICS-H-10-02-02-A2</p>
	<table width='100%'>
		<tbody>
			<tr><td colspan="6" align="center"><?php echo html::submitButton()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::resetButton()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::BackButton();?></td></tr>
		</tbody>
	</table>
	<input type="hidden" name='editselfid' id='editselfid' value='<?php echo $data->id; ?>'>
	<input type="hidden" name='editfileid' id='editfileid' value='<?php echo $data->fileid; ?>'>
</div>
	
</form>

<!-- js -->
<script>
	$(function(){
		$('#editselfhuishen').find("input,textarea").attr("disabled", "disabled");        // 会审table 

		$('#editselftable').find("input,textarea,select").attr("disabled", "disabled");   // 会审table
		$('#editselfcontent').find("input,textarea,select").attr("disabled", "disabled"); // 会审table
		$('#contractself_remark').removeAttr("disabled");   // 移除备注的disabled属性

		// 禁用掉除了file之外的input
		if (over == 1) 
		{
		$('#main').find("input,textarea,select").attr("disabled","disabled");
		// $('#editselfile').removeAttr("disabled");
		// $('#editselfid').removeAttr("disabled");
		}
		// 如果 over 显示为1 证明此合约已完成 禁用修改
		// if (over == 1 && legal.length > 0) 
		// {
		// $('#main').find("input,textarea,select").attr("disabled","disabled");
		// }
		// console.log(legal.length);editselfile


		// 部门 对应主管
		$('#contract_dept').on('change',function(){
			var dept = $('#contract_dept').val();
	        var depts = document.getElementById("contract_manager")   //获取二级
			$.ajax({
				url:"<?php echo $this->inLink('ajaxgetdept'); ?>",
				type:'post',
				dataType:'JSON',
				data:{'dept':dept},
				success:function (res){
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
<?php include '../../common/view/action.html.php';?>
<?php include '../../common/view/footer.html.php';?>
