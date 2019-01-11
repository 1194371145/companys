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
	/*input{border:0;}*/

</style>
<!-- html -->
<form action="" method='post' target='hiddenwin'>
<div id='main'>
	<div id='contract_top'>
		<div id='top_left'>
		<img src="../www/data/image/silergy.jpg" alt="" width="100">
		</div>
		<div id='top_right'>
			<span style='font-size:35px;'>矽力杰半导体技术  (杭州)  有限公司</span>
			<h2><b style="font-size:28px;">合约会审单 (Contract Review Form)</b></h2>
		</div>
	</div>
	<div id='contract_title'>
		<div id='title_left' style='height:50px;'>
			<div id='title_left_p' style="float:left;margin-top:5px;">
					合约管理编号:<br/>Contract Control No.:			
			</div>
			<div id='title_left_pp' style="float:left;margin-top:15px;margin-left:20px;">
				<b>合约编号代码</b>
			</div>
		</div>
		<div id='title_right' style='line-height:50px;margin-right:50px;'>
			<span>Date:<u>2018</u>/<u>01</u>/<u>22</u> &nbsp;&nbsp;&nbsp;&nbsp;2018年1月18日</span>
		</div>
	</div>
	<table style='border:2px solid #000;overflow:hidden;margin-top:5px;' border-collapse="collapse" align="center" class="table table-bordered">
		<tr>
			<th width='110'>申请部门<br/>Application Dept.</th>
			<td><input type="text" name='contract_dept' value="<?php echo $data->dept;?>" <?php if ($sta1) echo 'disabled'; ?>></td>
			<th>部门主管<br />Dept. Manager</th>
			<td><input type="text" name='contract_manager' value="<?php echo $data->manager ?>" <?php if ($sta1) echo 'disabled'; ?>></td>
			<th>合约对象<br/>Contract Party</th>
			<td><input type="text" name='contract_party' value="<?php echo $data->party ?>" <?php if ($sta1) echo 'disabled'; ?>></td>
		</tr>
		<tr>
			<th>合约名称<br/>Contract Title</th>
			<td colspan="3"><input type="text" name='contract_title' style='width:90%' value="<?php echo $data->title ?>" <?php if ($sta1) echo 'disabled'; ?>></td>
			<th>文件页数<br/>Number of Pages</th>
			<td><input type="text" name='contract_number' value="<?php echo $data->pager ?>" <?php if ($sta1) echo 'disabled'; ?>></td>
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
			<td><textarea name="contract_timeperiods" id="" cols="30" rows="5" <?php if($sta2) echo 'disabled';?>><?php echo $data->timeperiods;?></textarea></td>
			<td>
				<label><input name="contract_object" type="radio" value="group" <?php if($sta2) echo 'disabled';if($data->object == 'group') echo ' checked';?>/>集团(group): </label><br/>
				<label><input name="contract_object" type="radio" value="company" <?php if($sta2) echo 'disabled';if($data->object == 'company') echo ' checked';?>/>个别公司(company): </label>
			</td>
			<td><textarea name="contract_maincontent" id="" cols="30" rows="5" <?php if($sta2) echo 'disabled';?>><?php echo $data->maincontent;?></textarea></td>
			<td><textarea name="contract_clause" id="" cols="30" rows="5" <?php if($sta2) echo 'disabled';?>><?php echo $data->clause;?></textarea></td>
			<td><label><input name="contract_close" type="radio" value="Y" <?php if($sta2) echo 'disabled';if($data->close == 'Y') echo ' checked';?>/>是 (Y) </label><br/>
				<label><input name="contract_close" type="radio" value="N" <?php if($sta2) echo 'disabled';if($data->close == 'N') echo ' checked';?>/>否 (N) </label>
			</td>
		</tr>
		<tr>
			<td colspan="4" style='height:120px;'>
				<table width="100%" style='border:0px solid #000' class='table' id='table_content'>
					<tr>
						<td><input type="checkbox" class='show_select' name='need_dept[1]' value='Finance' <?php if($sta2) echo 'disabled';if($stat['Finance']) echo ' checked=checked';?>>Finance <?php 
						if ($stat['Finance']) {
							if ($sta2) {
						echo html::select('a[1]',$select['Finance'],$stat['Financemanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
							} else {
						echo html::select('a[1]',$select['Finance'],$stat['Financemanager'],"style='display:;' class='form-control' autocomplete='off' "); 
							}
						} else {
						echo html::select('a[1]',$select['Finance'],'',"style='display:none;' class='form-control' autocomplete='off' ;");
						}
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[2]' value='HR' <?php if($sta2) echo 'disabled';if($stat['HR']) echo ' checked=checked';?>>HR <?php 
						if ($stat['HR']) {
							if ($sta2) {
						echo html::select('a[2]',$select['HR'],$stat['HRmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'");
							} else {
						echo html::select('a[2]',$select['HR'],$stat['HRmanager'],"style='display:;' class='form-control' autocomplete='off'");
							}
						} else {
						echo html::select('a[2]',$select['HR'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[3]' value='IT' <?php if($sta2) echo 'disabled';if($stat['IT']) echo ' checked=checked';?>>IT <?php 
						if ($stat['IT']) {
							if ($sta2) {
						echo html::select('a[3]',$select['IT'],$stat['ITmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
							} else {
						echo html::select('a[3]',$select['IT'],$stat['ITmanager'],"style='display:;' class='form-control' autocomplete='off'"); 
							}
						} else {
						echo html::select('a[3]',$select['IT'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[4]' value='System' <?php if($sta2) echo 'disabled';if($stat['System']) echo ' checked=checked';?>>System <?php 
						if ($stat['System']) {
							if($sta2) {
						echo html::select('a[4]',$select['System'],$stat['Systemmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
							} else {
						echo html::select('a[4]',$select['System'],$stat['Systemmanager'],"style='display:;' class='form-control' autocomplete='off'"); 
							}
						} else {
						echo html::select('a[4]',$select['System'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox" class='show_select' name='need_dept[5]' value='Sales' <?php if($sta2) echo 'disabled';if($stat['Sales']) echo ' checked=checked';?>>Sales <?php 
						if ($stat['Sales']) {
							if ($sta2) {
						echo html::select('a[5]',$select['Sales'],$stat['Salesmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
							} else {
						echo html::select('a[5]',$select['Sales'],$stat['Salesmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[5]',$select['Sales'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[6]' value='FAE' <?php if($sta2) echo 'disabled';if($stat['FAE']) echo ' checked=checked';?>>FAE <?php 
						if ($stat['FAE']) {
							if ($sta2) {
						echo html::select('a[6]',$select['FAE'],$stat['FAEmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
							} else {
						echo html::select('a[6]',$select['FAE'],$stat['FAEmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[6]',$select['FAE'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} ?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[7]' value='QA' <?php if($sta2) echo 'disabled';if($stat['QA']) echo ' checked=checked';?>>QA <?php 
						if ($stat['QA']) {
							if ($sta2) {
						echo html::select('a[7]',$select['QA'],$stat['QAmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'");
						
							} else {
						echo html::select('a[7]',$select['QA'],$stat['QAmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[7]',$select['QA'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[8]' value='IC' <?php if($sta2) echo 'disabled';if($stat['IC']) echo ' checked=checked';?>>IC Design <?php 
						if ($stat['IC']) {
							if ($sta2) {
						echo html::select('a[8]',$select['IC'],$stat['ICmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
							} else {
						echo html::select('a[8]',$select['IC'],$stat['ICmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[8]',$select['IC'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox" class='show_select' name='need_dept[9]' value='Layout' <?php if($sta2) echo 'disabled';if($stat['Layout']) echo ' checked=checked';?>>Layout/CAD <?php 
						if ($stat['Layout']) {
							if ($sta2) {
						echo html::select('a[9]',$select['Layout'],$stat['Layoutmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[9]',$select['Layout'],$stat['Layoutmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[9]',$select['Layout'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[10]' value='TEchology' <?php if($sta2) echo 'disabled';if($stat['TEchology']) echo ' checked=checked';?>>TEchology <?php 
						if ($stat['TEchology']) {
							if ($sta2) {
						echo html::select('a[10]',$select['TEchology'],$stat['TEchologymanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[10]',$select['TEchology'],$stat['TEchologymanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[10]',$select['TEchology'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[11]' value='Packing' <?php if($sta2) echo 'disabled';if($stat['Packing']) echo ' checked=checked';?>>Packing <?php 
						if ($stat['Packing']) {
							if ($sta2) {
						echo html::select('a[11]',$select['Packing'],$stat['Packingmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[11]',$select['Packing'],$stat['Packingmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[11]',$select['Packing'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[12]' value='Audit' <?php if($sta2) echo 'disabled';if($stat['Audit']) echo ' checked=checked';?>>Audit <?php 
						if ($stat['Audit']) {
							if ($sta2) {
						echo html::select('a[12]',$select['Audit'],$stat['Auditmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[12]',$select['Audit'],$stat['Auditmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[12]',$select['Audit'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox" class='show_select' name='need_dept[13]' value='Marketing' <?php if($sta2) echo 'disabled';if($stat['Marketing']) echo ' checked=checked';?>>Marketing <?php 
						if ($stat['Marketing']) {
							if ($sta2) {
						echo html::select('a[13]',$select['Marketing'],$stat['Marketingmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[13]',$select['Marketing'],$stat['Marketingmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[13]',$select['Marketing'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[14]' value='Foundry' <?php if($sta2) echo 'disabled';if($stat['Foundry']) echo ' checked=checked';?>>Foundry <?php 
						if ($stat['Foundry']) {
							if ($sta2) {
						echo html::select('a[14]',$select['Foundry'],$stat['Foundrymanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[14]',$select['Foundry'],$stat['Foundrymanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[14]',$select['Foundry'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[15]' value='IP' <?php if($sta2) echo 'disabled';if($stat['IP']) echo ' checked=checked';?>>IP <?php 
						if ($stat['IP']) {
							if ($sta2) {
						echo html::select('a[15]',$select['IP'],$stat['IPmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[15]',$select['IP'],$stat['IPmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[15]',$select['IP'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[16]' value='Construction' <?php if($sta2) echo 'disabled';if($stat['Construction']) echo ' checked=checked';?>>Construction <?php 
						if ($stat['Construction']) {
							if ($sta2) {
						echo html::select('a[16]',$select['Construction'],$stat['Constructionmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[16]',$select['Construction'],$stat['Constructionmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[16]',$select['Construction'],'',"style='display:none;' class='form-control' autocomplete='off'");
						} 
						?></td>
					</tr>
					<tr>
						<td><input type="checkbox" class='show_select' name='need_dept[17]' value='Public' <?php if($sta2) echo 'disabled';if($stat['Public']) echo ' checked=checked';?>>Public Relations <?php 
						if ($stat['Public']) {
							if ($sta2) {
						echo html::select('a[17]',$select['Public'],$stat['Publicmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[17]',$select['Public'],$stat['Publicmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[17]',$select['Public'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[18]' value='Test' <?php if($sta2) echo 'disabled';if($stat['Test']) echo ' checked=checked';?>>Test <?php 
						if ($stat['Test']) {
							if ($sta2) {
						echo html::select('a[18]',$select['Test'],$stat['Testmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[18]',$select['Test'],$stat['Testmanager'],"style='display:;' class='form-control' autocomplete='off'"); 
							}
						} else {
						echo html::select('a[18]',$select['Test'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[19]' value='Operation' <?php if($sta2) echo 'disabled';if($stat['Operation']) echo ' checked=checked';?>>Operation <?php 
						if ($stat['Operation']) {
							if ($sta2) {
						echo html::select('a[19]',$select['Operation'],$stat['Operationmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'"); 
						
							} else {
						echo html::select('a[19]',$select['Operation'],$stat['Operationmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[19]',$select['Operation'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
						<td><input type="checkbox" class='show_select' name='need_dept[20]' value='LG' <?php if($sta2) echo 'disabled';if($stat['LG']) echo ' checked=checked';?>>LG <?php 
						if ($stat['LG']) {
							if ($sta2) {
						echo html::select('a[20]',$select['LG'],$stat['LGmanager'],"style='display:;' class='form-control' autocomplete='off' disabled='disabled'");
							} else {
						echo html::select('a[20]',$select['LG'],$stat['LGmanager'],"style='display:;' class='form-control' autocomplete='off'"); 

							}
						} else {
						echo html::select('a[20]',$select['LG'],'',"style='display:none;' class='form-control' autocomplete='off'");
						}  
						?></td>
					</tr>
				</table>
			</td>
			<td rowspan="2">
				共计 <b class='huishensum'><?php echo $data->sum;?></b>&nbsp;会审部门<br/><br/>Total: <b class='huishensum'><?php echo $data->sum;?></b>&nbsp;Dept.<br/>
			</td>
		</tr>
		<tr id='table_type'>
			<th>合约类型<br/>Contract Type</th>
			<td colspan="4">
			<table class='table' width="100%" style='border:0px solid #000'>
				<tr>
					<td><input type="checkbox" name='contract_type[1]' value='sales' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Sales') !== false) echo ' checked'; ?>>销售(Sales)</td>
					<td><input type="checkbox" name='contract_type[2]' value='Purchase' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Purchase') !== false) echo ' checked';?>>采购(Purchase)</td>
					<td><input type="checkbox" name='contract_type[3]' value='Patent' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Patent') !== false) echo ' checked';?>>专利(Patent)</td>
					<td><input type="checkbox" name='contract_type[4]' value='Rd' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Rd') !== false) echo ' checked';?>>研发(R&D)</td>
				</tr>
				<tr>
					<td><input type="checkbox" name='contract_type[5]' value='Outsource' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Outsource') !== false) echo ' checked';?>>委外(Outsource)</td>
					<td><input type="checkbox" name='contract_type[6]' value='Stock' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Stock') !== false) echo ' checked';?>>股权(Stock)</td>
					<td><input type="checkbox" name='contract_type[7]' value='Finance' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Finance') !== false) echo ' checked';?>>融资(Finance)</td>
					<td><input type="checkbox" name='contract_type[8]' value='Lease' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Lease') !== false) echo ' checked';?>>租凭(Lease)</td>
				</tr>
				<tr>
					<td><input type="checkbox" name='contract_type[9]' value='Group' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Group') !== false) echo ' checked';?>>集团(Group)</td>
					<td><input type="checkbox" name='contract_type[10]' value='Fixed' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Fixed') !== false) echo ' checked';?>>固资(Fixed assets)</td>
					<td><input type="checkbox" name='contract_type[11]' value='Others' <?php if($sta2) echo 'disabled';if(strpos($data->type,'Others') !== false) echo ' checked';?>>其他(Others)</td>
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
	<table class='table table-bordered' width='100%' style='border:2px solid #000;overflow:hidden;margin-top:-2px;' border-collapse="collapse" align="center">
		<tr>
			<th>顺序<br/>order</th>
			<td colspan="2">意 见 说 明 / 签 章<br/>Comments/Signature</td>
			<th>顺序<br/>order</th>
			<td colspan="2">意 见 说 明 / 签 章<br/>Comments/Signature</td>
		</tr>
		<?php for ($i=1; $i <= 5 ; $i++) { ?>
			<tr>
				<th><?php echo $i;?></th>
				<td colspan='2'>
					<!-- <label><input name="manager_approve" type="radio" value="1"  <?php if($sta3 || $statu[$i] !== $this->app->user->account) echo 'disabled';if($comments[$i-1]->approve == '1') echo ' checked';?>/>同意</label>
					<label><input name="manager_approve" type="radio" value="2"  <?php if($sta3 || $statu[$i] !== $this->app->user->account) echo 'disabled';if($comments[$i-1]->approve == '2') echo ' checked';?>/>需改进</label>
					<label><input name="manager_approve" type="radio" value="3" <?php if($sta3 || $statu[$i] !== $this->app->user->account) echo 'disabled';if($comments[$i-1]->approve == '3') echo ' checked';?> />拒绝</label>
					<textarea name="comments" id="" cols="35" rows="2" <?php if($sta3 || $statu[$i] !== $this->app->user->account) echo 'disabled';?>><?php if(!empty($comments[$i-1]->comments)) echo $comments[$i-1]->comments;?></textarea> -->
					<label><input name="manager_approve" type="radio" value="1"  <?php if($sta3 || $statu[$i] !== 'S00773') echo 'disabled';if($comments[$i-1]->approve == '1') echo ' checked';?>/>同意</label>
					<label><input name="manager_approve" type="radio" value="2"  <?php if($sta3 || $statu[$i] !== 'S00773') echo 'disabled';if($comments[$i-1]->approve == '2') echo ' checked';?>/>需改进</label>
					<label><input name="manager_approve" type="radio" value="3" <?php if($sta3 || $statu[$i] !== 'S00773') echo 'disabled';if($comments[$i-1]->approve == '3') echo ' checked';?> />拒绝</label>
					<textarea name="comments" id="" cols="35" rows="2" <?php if($sta3 || $statu[$i] !== 'S00773') echo 'disabled';?>><?php if(!empty($comments[$i-1]->comments)) echo $comments[$i-1]->comments;?></textarea>
				</td>
				<th><?php echo $i + 5;?></th>
				<td colspan='2'>
					<label><input name="manager_approve" type="radio" value="1" <?php if($sta3 || $statu[$i+5] !== $this->app->user->account) echo 'disabled';if($comments[$i+4]->approvemanager == $this->app->user->account && $comments[$i+4]->approve == '1') echo ' checked';?> />同意</label>
					<label><input name="manager_approve" type="radio" value="2" <?php if($sta3 || $statu[$i+5] !== $this->app->user->account) echo 'disabled';if($comments[$i+4]->approvemanager == $this->app->user->account && $comments[$i+4]->approve == '2') echo ' checked';?> />需改进</label>
					<label><input name="manager_approve" type="radio" value="3" <?php if($sta3 || $statu[$i+5] !== $this->app->user->account) echo 'disabled';if($comments[$i+4]->approvemanager == $this->app->user->account && $comments[$i+4]->approve == '3') echo ' checked';?> />拒绝</label>
					<textarea name="comments" id="" cols="35" rows="2" <?php if($sta3 || $statu[$i+5] !== $this->app->user->account) echo 'disabled';?>><?php if($comments[$i+4]->approvemanager == $this->app->user->account && !empty($comments[$i+4]->comments)) echo $comments[$i+4]->comments;?></textarea></td>
			</tr>
		<?php } ?>
		<tr>
			<th colspan="6">备注: 申请部门->法务部门 (审核合同并排定会审顺序) ->各会审部门->申请部门 (详阅会审意见并协商修改) ->法务部门 (确定最终合同文本) ->行政人事部门 (用印申请及存查合约会审单正本) -> 文档归档.<br/>Process: Application Dept.->Legal Service Dept.(arrange review order)->Each Review Dept.(provide comments and seal)->Application Dept.(complete signing with contract party)->Legal Service Dept.(Determine the final text of the contract)->HR Dept.(final review and application for seal)->Audit(file)</th>
		</tr>
		<input type="hidden" name='myid' value="<?php echo $data->id; ?>">
		<input type="hidden" name='sum' value="" id="editsum">
	</table>
	<p>ICS-H-10-02-02-A2</p>
	<table width='100%'>
		<tbody>
			<tr><td colspan="6" align="center"><?php echo html::submitButton()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::resetButton()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::BackButton();?></td></tr>
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

			// console.log($('.show_select:checked').size());
			$('.huishensum').html($('.show_select:checked').size()); // 统计会审部门 总数
			$('#editsum').val($('.show_select:checked').size());


		});

	});

</script>

<?php include '../../common/view/action.html.php';?>

<?php include '../../common/view/footer.html.php';?>

