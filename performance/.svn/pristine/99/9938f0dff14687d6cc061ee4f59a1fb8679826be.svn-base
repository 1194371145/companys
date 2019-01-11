<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>

<style>
.mustfill { background-color:#F2F2F2}
.tt{ width:100%; height:100px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.ts{ width:100%; height:100px; padding-top:10px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.tss{ width:100%; height:100%; padding-top:5px;  border-bottom:0px solid #000;border: none;outline: none;}
.te{width:100%;height:27px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.tp{ width:100%; height:27px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.tps{ width:50%; height:25px;border:none;outline: none;padding-left:5px;padding-right:1px;}
.input{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input1{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input2{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input3{ border: none;outline: none;width:80%; height:70%;padding-left:0px;}
.input4{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.input5{ border: none;outline: none;width:100%; height:100%;padding-left:5px;}
.input6{ border: none;outline: none;width:100%; height:100%;padding-left:0px;}
.textarea1{ border:none;outline: none;width:100%; height:100%;padding-left:0px;}
.textarea2{ border:none;outline: none;width:100%; height:100%; min-height:45px;padding-left:0px;}
.textarea3{ border:none;outline: none;width:100%; height:100%;padding-left:0px;}
.textarea4{ border:none;outline: none;width:100%; height:100%;padding-left:0px;}
table tr{border:1px solid ;}
table td{border:black solid 1px; padding-left:5px;}
table th{border:black solid 1px; padding-left:5px;}

</style>
<form method='post' target='hiddenwin'>
<div style="width:1300px;border:1px solid #000; margin:0 auto; "text-align="center" >
<table  style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;margin-top:-1px" align="center" border-collapse="collapse" >
<tr><td colspan="8" align="center"><font size="4"><?php echo $lang->performance->performance;?></font></td></tr>
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
<th ><?php echo $lang->performance->Total_Score;?></th><td colspan="3" id="fucktotal"><?php echo $score->total;?></td>
</tr>

</table>
<table  style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table id="job" style="width:1300px;border:1px solid #000;margin-left:-1px;overflow:hidden;" align="center">
<tr>
<th rowspan="2" style="width:100px"><?php echo $lang->performance->Categories;?></th>
<th rowspan="2" style="width:310px;"><?php echo $lang->performance->content;?></th>
<th colspan="8" style="padding-left:360px;"><?php echo "Performance Review Comparison ";?></th>
</tr>
<tr>
<th style="width:260px;"><?php echo $lang->performance->reviewbymyself;?></th>
<th  style="width:70px"><?php echo $lang->performance->Weight;?></th>
<th style="width:260px;"><?php echo $lang->performance->reviewbysuper;?></th>
<th style="width:100px"><?php echo $lang->performance->score;?></th>
<th style="width:100px"><?php echo $lang->performance->scorebysuper;?></th>
<th style="width:100px"><?php echo $lang->performance->worktotal;?></th>
</tr>
<?php foreach($get_item as $k=>$v){?>
<tr>
<td align="center"><?php echo $v->category;?></td>
<td><?php echo $v->goalitem;?></td>
<td><?php echo $v->reviewbymyself;?></td>
<td><?php //echo $v->weight*100;?>
<?php echo html::inputreview("itemweight[$v->category]",$v->weight*100,"class='input6 mustfill' style='width:40px;'",$get_master->status,$get_master->circlestatus);?>
%
</td>
<td><?php echo html::textareareview("reviewbysuper[$v->category]",$v->reviewbysuper,"class='textarea2 mustfill'",$get_master->status,$get_master->circlestatus);?> </td>
<td><?php echo $v->score;?></td>
<td><?php echo html::inputreview("scorebysuper[$v->category]",$v->scorebysuper,"class='input6 mustfill jobscore'",$get_master->status,$get_master->circlestatus);?></td>
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

<tr><td align="right" colspan="7"><?php echo "Job Performance Total Score:";?></td><td id="jobtotal"><?php echo $subtotal;?></td></tr>
</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table id="ability" style="width:1300px;border:1px solid #000;;margin-left:-1px;overflow:hidden;" align="center">
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
<td colspan="2"><?php echo $vt->item;?></td>
<td align="center"><?php echo $vt->weight*100;?>%</td>
<td>
<?php 
if($vt->category < 5 || $get_master->manager == 'Y' || $vt->weight > 0.01)
{
   echo html::textareareview("reviewitem[$vt->category]",$vt->reviewitem,"class='textarea2 mustfill'",$get_master->status,$get_master->circlestatus);
}
?></td>
<td><?php echo $vt->score;?></td>
<td><?php
if($vt->category <= $get_master->maxcate - 2 || $get_master->maxcate < 5 || $get_master->manager == 'Y' || $vt->weight > 0)
{
   echo html::inputreview("scorebysuperab[$vt->category]",$vt->scorebysuper,"class='input mustfill abscore'",$get_master->status,$get_master->circlestatus);
}
?></td>
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
<tr><td align="right" colspan="7"><?php echo "Employee's Strength Total Score:";?></td><td id="abtotal"><?php echo $subtotalt;?></td></tr>
</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;" align="center">
<tr><th style="width:100px;"><?php echo $lang->performance->statement;?></th><td colspan="7" ><?php echo $get_master->statement;?></td></tr>
<tr>
<th rowspan="2" ><?php echo $lang->performance->Summary;?></th>
<th style="width:195px;text-align:center;"><?php echo $lang->performance->review_strenght;?></th>
<td colspan="6"><?php echo html::textareareview("review_strength",$get_master->review_strength,"class='ts mustfill'",$get_master->status,$get_master->circlestatus);?></td>
</tr>
<tr>
<th style="width:195px; text-align:center;"><?php echo $lang->performance->review_improve;?></th>
<td colspan="6"><?php echo html::textareareview("review_improve",$get_master->review_improve,"class='ts mustfill'",$get_master->status,$get_master->circlestatus);?></td>
</tr>
</table> 
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;margin-top:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;margin-top:-1px;" align="center">
<tr>
<th colspan="8"><?php echo $lang->performance->objective."(From:　 ".date("m/d/Y",strtotime($get_master->nextperiodbegin))." To  ".date("m/d/Y",strtotime($get_master->nextperiodend)).")"?></th>
</tr>
<tr><th style="width:100px;"><?php echo $lang->performance->Categories;?></th><th colspan="6" width="1000px" style="padding-left:450px"><?php echo $lang->performance->objectives;?></th><th width="120px" style=" text-align:center;"><?php echo $lang->performance->Weight;?></th></tr>
<?php 

if(count($get_nextitem) > 0)
{

foreach($get_nextitem as $value)
{
	$maxc = $value->category + 3;	
	$ii = $value->category + 1;
?>
<tr>
<td align="center"><?php echo $value->category;?></td>
<td colspan="6"><?php echo html::textareareview("goalitem[$value->category]",$value->goalitem,"class='tss mustfill'",$get_master->status,$get_master->circlestatus);?></td>
<td><?php echo html::inputreview("weight[$value->category]",$value->weight*100,"class='input3 mustfill' style='width:80%;'",$get_master->status,$get_master->circlestatus);?>%</td>
</tr>
<?php
}
}
else
{
   $maxc = 8;
   $ii = 1;
}
	
for($i=$ii;$i<$maxc;$i++)
{
?>
<tr>
<td align="center"><?php echo $i; ?></td>
<td colspan="6"><?php  echo html::textareareview("goalitem[$i]",'',"class='tss mustfill'",$get_master->status,$get_master->circlestatus);?></td>
<td><?php echo html::inputreview("weight[$i]",'',"class='input3 mustfill'",$get_master->status,$get_master->circlestatus); ?>%</td>
</tr>
<?php 
}

?>
</table>
<table><tr style="border:2px solid #FCFCFC;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;margin-bottom:-1px;" align="center">
<th width="250"><?php echo $lang->performance->autographmyself;?></th><td colspan="3" width="441"><?php echo $get_master->staffsignature;?></td>
<th width="250"><?php echo $lang->performance->autographsuper;?></th><td colspan="3" width="390"><?php echo html::inputreview("supersignature",$get_master->supersignature,"class='input4 mustfill'",$get_master->status,$get_master->circlestatus);?> </td>
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
<?php include '../../common/view/action.html.php';?> 
<script>
	    $(".mustfill").focus().live('blur',function(){
														 //var tmptotal = $(this).parent().next().next().children(1).val()*$(this).val();	
														 var jobtotal = 0.00;
													     var txt = $('#job').find('.jobscore'); // 获取所有文本框
                                                         for (var i = 0; i < txt.length; i++)
														 {  
														    //var weight =txt.eq(i).parent().prev().prev().prev().children(0).val();
															//var weight = txt.eq(i).parent().prev().prev().prev().html().replace('%','');
															var weight = txt.eq(i).parent().prev().prev().prev().children(":input").val();
															var subt = txt.eq(i).val() * weight * 0.01;
															txt.eq(i).parent().next().html(subt.toFixed(2));
                                                            jobtotal += subt; 
                                                         }
														 $("#jobtotal").html(jobtotal.toFixed(2));
														 
														 var abtotal = 0.00;
													     var abtxt = $('#ability').find('.abscore'); // 获取所有文本框
                                                         for (var i = 0; i < abtxt.length; i++)
														 {
															var weight = abtxt.eq(i).parent().prev().prev().prev().html().replace('%','');
															var subt = abtxt.eq(i).val() * weight * 0.01;
															abtxt.eq(i).parent().next().html(subt.toFixed(2));
                                                            abtotal += subt; 
                                                         }
														 $("#abtotal").html(abtotal.toFixed(2));	
														 var total = abtotal*0.3 + jobtotal*0.7;
														 $("#fucktotal").html(total.toFixed(2));
														 
														 
													     });
</script>
<?php include '../../common/view/footer.html.php';?>