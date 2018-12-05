<?php
include "../../common/view/header.html.php";
include '../../common/view/treeview.html.php';
?>
<?php include '../../common/view/datepicker.html.php';?>
<style type="text/css">
*{padding:0px;margin:0px;}
#userList{margin-top:0px;font-size:10px;;text-align:center;}
#featurebar{margin-bottom:0px;}
#userList tbody tr td{font-size:10px;margin:0px;padding:0px;}
#userList tbody tr{font-size:10px;margin:0.5px;padding:0px;}
#userList tbody form tr td input{font-size:10px;margin:0px;padding:0px;}
#userList tbody form tr td{font-size:10px;margin:0px;padding:0px;}
#userList tbody form tr{font-size:10px;margin:0.5px;padding:0px;}
#userList tbody form{font-size:10px;margin:0px;padding:0px;}
.input{width:100%;height:26px;}
#anniu{background-color:#1A4F85;padding:1.5px;border:none;color:white;font-size:10px;margin:6px 0px 6px 0px;color:#fff!important;}
#anniu:visited,#anniu:hover,#anniu:link,#anniu:active{color:white;}
#anniu:visited{background-color:black;}
</style>
<script language='Javascript'>
var browseType = '<?php echo $browseType;?>';
</script>
<div id='featurebar'>
  <ul class='nav'>
    <li id='bysearchTab'><a href='#'><i class='icon-search icon'></i>&nbsp;搜索</a></li>
  </ul>
  <div class='actions'>
    <?php common::printLink('sampleout', 'exportout',"", "<font color='red'><b>导出数据</b></font>","hiddenwin");?>
  </div>
  <div id='querybox' class='<?php if($browseType == 'bysearch') echo 'show';?>'><?php echo $searchForm;?></div>
</div>
<div id="sampleiddiv" style="display:none;">
<form action="" method='post' target="_blank" name="myform">
	<table style="width:100%;">
		<tr>
			<td><input type='text' name='sampleid' id='sampleid' style="width:100%"/></td>
			<td style="width:80px"><input type='submit' value="批量出货" style="padding:0.8px;width:70px" onclick="batchuhuoofdemo()";/></td>
			<?php
			if (common::hasPriv('sampleout','batchPrint')) {
				echo "<td><input type='submit'  value='批量打印'' style='padding:0.8px;width:70px' onclick='batchOfPrint()';/></td>";
			}			
			?>
		</tr>
	</table>
</form>
</div>
<script type="text/javascript">
    function batchuhuoofdemo(){
      document.myform.action="<?php echo $this->createLink('sampleout','batchuhuoofdemo');?>";
      document.myform.submit();
   }
   function batchOfPrint(){
      document.myform.action= "<?php echo $this->createLink('sampleout','batchPrint');?>";
      document.myform.submit();
   }
 </script>
<table class="table table-condensed  table-striped tablesorter table-fixed" id='userList'>
<thead>
<tr><?php $vars="type=$type&param=$param&orderBy=%s&recTotal=$pager->recTotal&recPerPage=$pager->recPerPage&pageID=$pager->pageID";?>
<th style="width:20px;"></th>
<th style="width:40px;"><?php common::printOrderLink("id", $orderBy, $vars, "ID");?></th>
<th style="width:54px;"><?php common::printOrderLink("person", $orderBy, $vars, "申请人");?></th>
<th style="width:70px;"><?php common::printOrderLink("rdate", $orderBy, $vars, "申请时间");?></th>
<th style="width:98px;"><?php common::printOrderLink("remark", $orderBy, $vars, "Remark");?></th>
<th style="width:90px;"><?php common::printOrderLink("partn", $orderBy, $vars, "PartN");?></th>
<th style="width:90px;"><?php common::printOrderLink("endname", $orderBy, $vars, "End");?></th>
<th style="width:90px;"><?php common::printOrderLink("distributor", $orderBy, $vars, "Dis");?></th>
<th style="width:55px;"><?php common::printOrderLink("aqty", $orderBy, $vars, "发货量");?></th>
<th style="width:45px;"><?php common::printOrderLink("price", $orderBy, $vars, "Price");?></th>
<th style="width:45px;"><?php common::printOrderLink("rev", $orderBy, $vars, "Rev");?></th>
<th style="width:70px;"><?php common::printOrderLink("mailpay", $orderBy, $vars, "邮寄");?></th>
<th style="width:100px;"><?php common::printOrderLink("shiporder", $orderBy, $vars, "ShipOrder");?></th>
<th style="width:70px;"><?php common::printOrderLink("shipdate", $orderBy, $vars, "ShipDate");?></th>
<th style="width:50px;"><?php common::printOrderLink("area", $orderBy, $vars, "区域");?></th>
<th style="width:50px;"><?php common::printOrderLink("revtype", $orderBy, $vars, "费用");?></th>
<th style="width:180px;"><?php common::printOrderLink("mid", $orderBy, $vars, "主数据");?></th>
<th style="width:45px;"><?php common::printOrderLink("close", $orderBy, $vars, "状态");?></th>
<th>指派给</th>
<th style="width:190px;">操作</th>
</tr>
</thead>
<tbody>
<?php foreach($out as $v){?>
<?php if($v->close=='wait'){?>
		<form action="<?php echo $this->createLink("sampleout","editout");?>" method="post" enctype='multipart/form-data' target="hiddenwin" id="form<?php echo $v->id ?>">
		<tr>
		<td onclick='addsampleid("<?php echo $v->id;?>");'><?php if($v->approve==0 || $v->approve=='2'){?><input type='checkbox' value='<?php echo $v->id;?>' id="formid<?php echo $v->id?>" onclick='addsampleid("<?php echo $v->id;?>");' /><?php }?></td>
		<td><?php echo sprintf("%03d",$v->id);?></td>
		<td><input type='text' name='person' value="<?php echo $v->person;?>" class='input'/></td>
		<td><input type='text' name='rdate' value="<?php echo $v->rdate;?>" class='input form-date'/></td>
		<td><input type='text'  value="<?php echo $v->remark.' '.$v->tocompany.' '.$v->toperson.' '.$v->tomobile.' '.$v->toaddress;?>" class='input' title="<?php echo $v->remark.' '.$v->tocompany.' '.$v->toperson.' '.$v->tomobile.' '.$v->toaddress;?>"/></td>
		
		<td title="<?php echo $notpart[$v->partn];?>"><input type='text' name='partn' value="<?php echo $v->partn;?>" class='input' title="<?php echo $notpart[$v->partn];?>"/></td>
		<td><input type='text' name='endname' value="<?php echo $v->endname;?>" class='input'/></td>
		<td><input type='text' name='distributor' value="<?php echo $v->distributor;?>" class='input'/></td>
		<td><input type='text' name='aqty' value="<?php echo $v->aqty;?>" class='input'/></td>
		<td><input type='text' name='price' value="<?php echo $v->price;?>" class='input'/></td>
		<td><input type='text' name='rev' value="<?php echo $v->rev;?>" class='input'/></td>
		<td><?php echo html::select("mailpay",array('contract_sender'=>"寄付","receiver"=>"到付"),$v->mailpay,"class='input'")?></td>
		<td><input type='text' name='shiporder' value="<?php echo $v->shiporder;?>" class='input'/></td>
		<td>
			<input type='text' name='shipdate' value="<?php echo $v->shipdate;?>" class='input form-date'/>
			<input type='hidden' name='id' value="<?php echo $v->id;?>"/>
			<input type='hidden' name='stage' value="<?php echo $v->stage;?>"/>
			<input type='hidden' name='qty' value="<?php echo $v->qty;?>"/>
		</td>
		<td><?php echo html::select("area",$lang->sampleout->area,$v->area,"class='input'")?></td>
		<td><?php echo html::select("revtype",$lang->sampleout->revtype,$v->revtype,"class='input'")?></td>
		<td align="right" style="padding:0px;margin:0px;">
		<?php 
		if($v->type=='3'){$mid=0;}elseif($v->type=='2'){$mid=$v->mid."sample";}elseif($v->type=='1'){$mid=$v->mid."mp";}
		echo html::select("mid",$v->wait,$mid,"class = 'mid{$v->id} input'");
		?>
		</td>
		<td><?php echo $lang->sampleout->close[$v->close];?></td>
		<td><?php if(!in_array($this->app->user->account,array_keys($toassign))) echo html::select('toassign',$toassign,$v->toassign,"class='input'");?></td>
		<td align="justify" style="text-align:right;">
		 <!-- 判断打印权限 -->
		<?php if(($v->area == 'NC' or $v->area == 'SC') and $v->approve !== '1') {?>
		<?php 
		if (common::hasPriv("sampleout","batchPrint")) {
			echo html::a($this->createLink('sampleout','batchPrint',"id=$v->id"),'打印地址',"_blank","style='background-color:#1A4F85;color:white;padding:1.5px;border:none;font-size:10px;margin:6px 0px 6px 0px;float:left';");
		}	
		?>
		<?php }?>
		<?php if($v->approve==0 || $v->approve=='2'){?>
		<?php if((!$v->toassign and !in_array($this->app->user->account,array_keys($toassign))) or ($v->toassign and in_array($this->app->user->account,array_keys($toassign)))){?>
		<input type='submit' name='anniu' value='修改1' id='anniu'/>
		<?php echo html::a($this->createLink('sampleout','vieweditout',"id=$v->id"),'修改2',"","title='详细修改' id='anniu'");?>
		<input type='button' name='anniu' value='出货' onclick ='outku(<?php echo $v->id?>)' id='anniu'/>
		<?php }?>
		<?php 
		if($v->close!='done')
		{
			if(common::hasPriv("sampleout", "deleteout"))
			{
			 	echo html::a($this->createLink('sampleout','deleteout',"id={$v->id}"),"删除",'hiddenwin',"id=anniu");
			}
		}
		?>
		<?php }else{?>
		<input type='button' name='anniu' value='审核' onclick ='shenhe(<?php echo $v->id?>)' id='anniu'/>
		<?php }?>
		</td>
		</tr>
		</form>
<?php 	}else{ ?>
		<tr class='input'>
		<td></td>
		<td><?php echo sprintf("%03d",$v->id);?>
		<td><?php echo $v->person;?></td>
		<td><?php echo $v->rdate;?></td>
		<td title="<?php echo $v->remark.' '.$v->tocompany.' '.$v->toperson.' '.$v->tomobile.' '.$v->toaddress;?>"><?php echo $v->remark.' '.$v->tocompany.' '.$v->toperson.' '.$v->tomobile.' '.$v->toaddress;?></td>		
		<td><?php echo $v->partn;?></td>
		<td><?php echo $v->endname;?></td>
		<td><?php echo $v->distributor;?></td>
		<td><?php echo $v->aqty;?></td>
		<td><?php echo $v->price;?></td>
		<td><?php echo $v->rev;?></td>
		<td><?php echo $v->mailpay;?></td>
		<td><?php echo $v->shiporder;?></td>
		<td><?php echo $v->shipdate;?></td>
		<td><?php echo $v->area;?></td>
		<td><?php echo $v->revtype;?></td>
		<td>
		<?php 
				if($v->type=="1")
				{
					$no=$this->dao->select('no')->from('zt_mp')->where('id')->eq($v->mid)->fetch('no');
					echo html::a($this->createLink('mp','viewmp',"id=$v->mid"),$lang->sampleout->type[$v->type].$no);
				}
				elseif($v->type=='2')
				{
					$no=$this->dao->select('packagetype,date')->from('zt_sample')->where('id')->eq($v->mid)->fetch();
					echo html::a($this->createLink('sample','viewsample',"id=$v->mid"),substr($lang->sampleout->type[$v->type],0,2,'UTF-8').date("y/n/j",strtotime($no->date)).$no->packagetype);
				}
				elseif($v->type=='3')
				{
					echo html::a("",$lang->sampleout->type[$v->type]);
				}
		?>
		</td>
		<td><?php echo $lang->sampleout->close[$v->close];?></td>
		<td></td>
		<td align="justify" style="text-align:right;">
		<?php echo html::a($this->createLink('sampleout','viewout',"id=$v->id"),'详情',"","id='anniu'");?>
		</td>
		</tr>		
<?php } }?>
</tbody>
<tfoot>
<tr><td colspan='20'><?php echo $pager->show();?></td></tr>
</tfoot>
</table>
<script type="text/javascript">

function outku(e)
{
	var mid=$(".mid"+e).val();
	if(mid=='0')
	{	
		if(confirm('此条出库记录无关联主数据   是否继续'))
		{
			$("#form"+e).submit();
		}
	}
	else
	{
		$("#form"+e).submit();
	}	
}
function shenhe(e)
{
	if(confirm("你正在审核样品数量申请，继续码"))
	{
	$.ajax({
		url:"<?php echo $this->createLink('sampleout','shenhe');?>",
		data:"id="+e,
		type:"post",
		dataType:'text',
		success:function(o)
		{
			if(o=='1')
			{
				location.reload();
			}
			else
			{
				alert('审核失败！请联系管理员');
			}
		}
		});
	}
}
function addsampleid(e)
{
	var samplevalue=$("#sampleid").val();
	var formvalue=$("#formid"+e).val();
	if($("#formid"+e).attr("checked"))
	{
		if(samplevalue.indexOf(formvalue)==-1)
		{
		$("#sampleid").val(samplevalue+","+formvalue+",");	
		}
	}
	else
	{
		$("#sampleid").val(samplevalue.replace(","+formvalue+",",""));
	}
	var samplevalue1=$("#sampleid").val();
	if(!samplevalue1){$("#sampleiddiv").css("display","none");}else{$("#sampleiddiv").css("display","");}
}
</script>
<?php include "../../common/view/footer.html.php";?>