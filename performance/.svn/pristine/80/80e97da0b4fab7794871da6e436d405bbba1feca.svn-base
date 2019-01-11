<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>

<style>
.mustfill { background-color:#F2F2F2}
.tt{ width:100%; height:100px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.ts{ width:100%; height:100px; padding-top:10px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.te{width:100%;height:27px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.tp{ width:100%; height:27px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.tps{ width:100%; height:25px;border:none;outline: none;padding-left:5px;padding-right:1px;}
.input{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input1{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input2{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input3{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input4{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input5{ border: none;outline: none;width:100%; height:100%;padding-left:5px;}
.textarea1{ border:none;outline: none;width:100%; height:100%;padding-left:0px;}
.textarea2{ border:none;outline: none;width:100%; height:100%; min-height:70px;padding-left:0px;}
.textarea3{ border:none;outline: none;width:100%; height:100%;padding-left:0px;}
.textarea4{ border:none;outline: none;width:100%; height:100%;padding-left:0px;}
table tr{border:1px solid ;}
table td{border:black solid 1px; padding-left:5px;}
table th{border:black solid 1px; padding-left:5px;}

</style>
<form method='post' target='hiddenwin'>
<div style="width:1300px;border:1px solid #000; margin:0 auto; "text-align="center" >
<table  style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;margin-top:-1px" align="center" border-collapse="collapse" >
<tr><td colspan="9" align="center"><font size="4"><?php echo $lang->performance->performance;?></font></td></tr>
<tr><td colspan="6"></td><th><?php echo "Date";?></th><td><?php echo date("Y-m-d");?></td></tr>
<tr>
<th style="width:90px;"><?php echo $lang->performance->Employee;?></th><td ><?php echo $get_user->realname;?></td>
<th width="130"><?php echo $lang->performance->Department;?></th><td ><?php echo $get_user->dept;?></td>
<th><?php echo $lang->performance->Position;?></th><td ><?php echo $get_user->position;?></td>
<th width="120px"><?php echo $lang->performance->Join_Date;?></th><td ><?php echo $get_user->join;?></td>
</tr>
<tr>
<th><?php echo $lang->performance->Reviewer;?></th><td ><?php echo $get_user->supervise;?></td>
<th><?php echo $lang->performance->Department;?></th><td ><?php echo $get_zgtitle->dept;?></td>
<th><?php echo $lang->performance->Position;?></th><td colspan="3" ><?php echo $get_zgtitle->position;?></td>
</tr>
<tr>
<th style="width:100px;"><?php echo $lang->performance->Review_Cycle;?></th><td colspan="3"><?php echo substr($get_master->zhouqi,0,4)." ".substr($get_master->zhouqi,4,1)."H";?></td>
<th ><?php echo $lang->performance->Total_Score;?></th><td colspan="3"><?php echo $score->total;?></td>
</tr>

</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table  style="width:1300px;border:1px solid #000;margin-left:-1px;overflow:hidden;" align="center">
<tr>
<th rowspan="2" style="width:100px"><?php echo $lang->performance->Categories;?></th>
<th rowspan="2" style="width:310px;"><?php echo $lang->performance->content;?></th>
<th colspan="8" style="padding-left:360px;"><?php echo "Performance Review Comparison ";?></th>
</tr>
<tr>
<th style="width:260px;"><?php echo $lang->performance->reviewbymyself;?></th>
<th  style="width:50px"><?php echo $lang->performance->Weight;?></th>
<th style="width:260px;"><?php echo $lang->performance->reviewbysuper;?></th>
<th style="width:100px"><?php echo $lang->performance->score;?></th>
<th style="width:100px"><?php echo $lang->performance->scorebysuper;?></th>
<th style="width:100px"><?php echo $lang->performance->worktotal;?></th>
</tr>
<?php foreach($get_item as $k=>$v){?>
<tr>
<td align="center"><?php echo $v->category;?></td>
<td><?php echo $v->goalitem;?></td>
<td><?php echo html::textareareview("reviewbymyself[$v->category]",$v->reviewbymyself,"class='textarea2 mustfill'",$get_master->status,$get_master->circlestatus);?></td>
<td><?php echo $v->weight*100;?>%</td>
<td><?php echo $v->reviewbysuper;?></td>
<td><?php echo html::inputreview("scoreitem[$v->category]",$v->score,"class='input3 mustfill'",$get_master->status,$get_master->circlestatus);?></td>
<td><?php echo $v->scorebysuper;?></td>
<td>
<?php 
$subscore = $v->weight * $v->scorebysuper;
if($subscore > 0)
{
echo $subscore;
$subtotal += $subscore;
}
?></td>
</tr>
<?php }?>
<?php 
$py = end($get_item);
$ty = $py->category + 1;
$ty2 = $ty + 1;
?>
<tr>
<td align="center"><?php echo $ty;?></td>
<td><?php echo html::textareareview("ad_goalitem[$ty]","","class='textarea1'",$get_master->status,$get_master->circlestatus);?></td>
<td><?php echo html::textareareview("ad_reviewbymyself[$ty]","","class='textarea2'",$get_master->status,$get_master->circlestatus);?></td>
<td>0%</td>
<td><?php ?></td>
<td><?php echo html::inputreview("ad_scoreitem[$ty]","","class='input3'",$get_master->status,$get_master->circlestatus);?></td>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"><?php echo $ty2;?></td>
<td><?php echo html::textareareview("ad_goalitem[$ty2]","","class='textarea1'",$get_master->status,$get_master->circlestatus,$get_master->circlestatus);?></td>
<td><?php echo html::textareareview("ad_reviewbymyself[$ty2]","","class='textarea2'",$get_master->status,$get_master->circlestatus);?></td>
<td>0%</td>
<td><?php ?></td>
<td><?php echo html::inputreview("ad_scoreitem[$ty2]","","class='input3'",$get_master->status,$get_master->circlestatus);?></td>
<td></td>
<td></td>
</tr>
<tr><td align="right" colspan="7"><?php echo "Job Performance Total Score:";?></td><td><?php echo $subtotal;?></td></tr>
</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;;margin-left:-1px;overflow:hidden;" align="center">
<tr>
<th style="width:100px;"><?php echo $lang->performance->Categories;?></th>
<th colspan="2" style="width:465px;"><?php echo $lang->performance->ability;?></th>
<th><?php echo $lang->performance->Weight;?></th>
<th style="width:380px;text-align:center;"><?php echo $lang->performance->Comments;?></th>
<th  style="width:100px"><?php echo $lang->performance->score;?></th>
<th  style="width:100px"><?php echo $lang->performance->scorebysuper;?></th>
<th  style="width:100px"><?php echo $lang->performance->worktotal;?></th>
</tr>
<?php foreach($get_ability as $kt=>$vt){?>
<tr>
<td align="center"><?php echo $vt->category;?></td>
<td colspan="2" id="tp<?php echo $vt->category;?>"><?php echo $vt->item;?></td>
<td align="center"><?php echo $vt->weight*100;?>%</td>
<td><?php echo $vt->reviewitem;?></td>
<td><?php
if($vt->category <= $get_master->maxcate - 2 || $vt->weight > 0)
{
echo html::inputreview("scoreability[$vt->category]",$vt->score,"class='input mustfill'",$get_master->status,$get_master->circlestatus);
}
?></td>
<td><?php echo $vt->scorebysuper;?></td>
<td width="100px">
<?php
$subscoret = $vt->weight * $vt->scorebysuper;
if($subscoret > 0)
{
echo $subscoret;
$subtotalt += $subscoret;
}

?>

</td>
</tr>
<?php }?>
<tr><td align="right" colspan="7"><?php echo "Employee's Strength Total Score:";?></td><td><?php echo $subtotalt;?></td></tr>
</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;" align="center">
<tr><th style="width:100px;"><?php echo $lang->performance->statement;?></th><td colspan="7" ><?php echo html::textareareview("statement",$get_master->statement,"class='ts mustfill'",$get_master->status,$get_master->circlestatus);?></td></tr>
<tr>
<th rowspan="2" ><?php echo $lang->performance->Summary;?></th>
<th style="width:195px;text-align:center;"><?php echo $lang->performance->review_strenght;?></th>
<td colspan="6"><?php echo $get_master->review_strength;?></td>
</tr>
<tr>
<th style="width:195px; text-align:center;"><?php echo $lang->performance->review_improve;?></th>
<td colspan="6"><?php echo $get_master->review_improve;?></td>
</tr>
</table> 
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;margin-top:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;margin-top:-1px;" align="center">
<tr>
<th colspan="8"><?php echo $lang->performance->objective."(From:　 ".date("m/d/Y",strtotime($get_master->nextperiodbegin))." To  ".date("m/d/Y",strtotime($get_master->nextperiodend)).")"?></th>
</tr>
<tr><th style="width:100px;"><?php echo $lang->performance->Categories;?></th><th colspan="6" width="1119px" style="padding-left:450px"><?php echo $lang->performance->objectives;?></th><th width="80px" style=" text-align:center;"><?php echo $lang->performance->Weight;?></th></tr>
<?php 
if(count($get_nextitem) > 0)
{
foreach($get_nextitem as $value)
{
if($value->itemfrom == "S")	
{
?>
<tr>
<td align="center"><?php echo $value->category;?></td>
<td colspan="6"><?php echo $value->goalitem;?></td>
<td><?php echo $value->weight*100 ;?>%</td>
</tr>
<?php
}
}
}
else
{
for($i=1;$i<6;$i++)
{
?>
<tr>
<td align="center"><?php echo $i; ?></td>
<td colspan="6"><?php ?></td>
<td></td>
</tr>
<?php 
}
}
?>
</table>
<table><tr style="border:2px solid #FCFCFC;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;margin-bottom:-1px;" align="center">
<th width="250"><?php echo $lang->performance->autographmyself;?></th><td colspan="3" width="441"><?php echo html::inputreview("staffsignature",$get_master->staffsignature,"class='input4 mustfill'",$get_master->status,$get_master->circlestatus);?></td>
<th width="250"><?php echo $lang->performance->autographsuper;?></th><td colspan="3" width="390"><?php echo $get_master->supersignature;?> </td>
</tr>
<tr><th><?php echo $lang->performance->autographcfo;?></th><td colspan="7"><?php ?></td></tr>
</table>
</div>
<br><br>
<?php
if($get_master->status != "close" && $get_master->circlestatus != "close")
{
?>
<table style="width:1300px;border:2px solid white;margin:0px 150px 0 150px;" align="center">
<tr><td colspan='8' align="center"><?php echo html::submitButton()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".html::resetButton();?></td></tr>
</table>
<?php
}
?>
</form>
<script>

$(document).ready(function(){
	var tpone = document.getElementById('tp1').innerHTML;
    var tptwo = document.getElementById('tp2').innerHTML;
    var tptwo3 = document.getElementById('tp3').innerHTML;
    var tptwo4 = document.getElementById('tp4').innerHTML;
    var tptwo5 = document.getElementById('tp5').innerHTML;
	  $("#tp1").mouseover(function(){
	    $("#tp1").attr("title", $(this).text('严格执行工作QA流程，防止品质问题，避免重复性错误')); 
	  });
	  $("#tp1").mouseout(function(){
	    $("#tp1").attr("title", $(this).text(tpone)); 
	  });

	   $("#tp2").mouseover(function(){
	    $("#tp2").attr("title", $(this).text('具备团队合作精神，能以大局为重，与同事良好配合,彼此体谅,不参与小团体。')); 
	  });
	  $("#tp2").mouseout(function(){
	    $("#tp2").attr("title", $(this).text(tptwo)); 
	  });
	  $("#tp3").mouseover(function(){
	  $("#tp3").attr("title", $(this).text('能有效与同事,上下级沟通，准确传递信息,不会因为沟通不畅影响或延缓工作。')); 
	  });
	  $("#tp3").mouseout(function(){
	  $("#tp3").attr("title", $(this).text(tptwo3)); 
	  });

	  $("#tp4").mouseover(function(){
	  $("#tp4").attr("title", $(this).text('敢于创新，能主动面对问题，解决问题。')); 
	  });
	  $("#tp4").mouseout(function(){
	  $("#tp4").attr("title", $(this).text(tptwo4)); 
	  });

	  $("#tp5").mouseover(function(){
	  $("#tp5").attr("title", $(this).text('纪律性强，自觉遵守公司各项制度，不无故迟到早退或旷工；积极参加公司各项活动，关心公司发展并积极提出合理化建议')); 
	  });
	  $("#tp5").mouseout(function(){
	  $("#tp5").attr("title", $(this).text(tptwo5)); 
	  });

});
</script>
<?php include '../../common/view/action.html.php';?> 
<?php include '../../common/view/footer.html.php';?>