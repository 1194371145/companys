<?php include '../../common/view/header.html.php';?>

<style>
.tt{ width:1000px; height:100px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.ts{ width:1170px; height:100px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.te{width:1050px;height:27px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.tp{ width:1000px; height:27px; border:2px; border-bottom:0px solid #000;border: none;outline: none;}
.tps{ width:370px; height:25px;border:none;outline: none;padding-left:5px;padding-right:1px;}
.input{ border: none;outline: none;width:168px; height:25px;padding-left:5px;}
table tr{border:1px solid ;}
table td{border:black solid 1px;}
table th{border:black solid 1px; padding-left:16.5px;padding-right:16.5px;}
</style>
<div style="width:1300px;border:1px solid #000; margin:0 150px 0 150px; "text-align="center" >
<table  style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;margin-top:-1px" align="center" border-collapse="collapse" >
<tr><td colspan="8" align="center"><font size="4"><?php echo $lang->performance->performance;?></font></td></tr>
<tr><td colspan="6"></td><th><?php echo "Date";?></th><td><?php echo html::input('adddate',date("Y-m-d"),"class='input'");?></td></tr>
<tr>
<th><?php echo $lang->performance->Employee;?></th><td ><?php echo html::input("","","class='input'");?></td>
<th><?php echo $lang->performance->Department;?></th><td ><?php echo html::input("","","class='input'");?></td>
<th><?php echo $lang->performance->Position;?></th><td ><?php echo html::input("","","class='input'");?></td>
<th width="120px"><?php echo $lang->performance->Join_Date;?></th><td ><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<th><?php echo $lang->performance->Reviewer;?></th><td ><?php echo html::input("","","class='input'");?></td>
<th><?php echo $lang->performance->Reviewer;?></th><td ><?php echo html::input("","","class='tps'");?></td>
<th><?php echo $lang->performance->Position;?></th><td colspan="3" ><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<th width="120px"><?php echo $lang->performance->Review_Cycle;?></th><td colspan="3"><?php echo html::input("","","class='tps'");?></td>
<th width="120px"><?php echo $lang->performance->Total_Score;?></th><td colspan="3"><?php echo html::input("","","class='tps'");?></td>
</tr>

</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<!--<table style="border:1px solid #000;overflow:hidden;margin-left:-2px;"><tr style="border:2px solid #FCFCFC;"><td colspan="8" height="5px"></td></tr></table>
-->
<table  style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center">
<tr>
<th rowspan="2" width="102px"><?php echo $lang->performance->Categories;?></th>
<th rowspan="2"><?php echo $lang->performance->content;?></th>
<th colspan="8" style="padding-left:360px;"><?php echo "Performance Review Comparison ";?></th>
</tr>
<tr>
<th><?php echo $lang->performance->reviewbymyself;?></th>
<th style="padding-left:50px;" width="80px"><?php echo $lang->performance->Weight;?></th>
<th ><?php echo $lang->performance->reviewbysuper;?></th>
<th><?php echo $lang->performance->score;?></th>
<th><?php echo $lang->performance->scorebysuper;?></th>
<th><?php echo $lang->performance->worktotal;?></th>
</tr>
<tr>
<td align="center"><?php echo "1";?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "2";?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "3";?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "4";?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "5";?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::textarea("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr><td align="right" colspan="7"><?php echo "Job Performance Total Score:";?></td><td><?php echo html::input("","","class='input'");?></td></tr>
</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center">
<tr>
<th><?php echo $lang->performance->Categories;?></th>
<th colspan="2"><?php echo $lang->performance->ability;?></th>
<th><?php echo $lang->performance->Weight;?></th>
<th style="padding-left:150px;" width="401"><?php echo $lang->performance->Comments;?></th>
<th style="padding-left:30px;" width="94"><?php echo $lang->performance->score;?></th>
<th style="padding-left:30px;" width="94"><?php echo $lang->performance->scorebysuper;?></th>
<th style="padding-left:30px;" width="94"><?php echo $lang->performance->worktotal;?></th>
</tr>
<tr>
<td align="center"><?php echo "1";?></td>
<td colspan="2"><?php echo "具备团队合作精神，能以大局为重，与同事良好配合,彼此体谅,不参与小团体。";?></td>
<td align="center"><?php echo "30%";?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "2";?></td>
<td colspan="2"><?php echo "能有效与同事,上下级沟通，准确传递信息,不会因为沟通不畅影响或延缓工作。";?></td>
<td align="center"><?php echo "30%";?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "3";?></td>
<td colspan="2"><?php echo "敢于创新，能主动面对问题，解决问题。";?></td>
<td align="center"><?php echo "20%";?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "4";?></td>
<td colspan="2"><?php echo "纪律性强，自觉遵守公司各项制度，不无故迟到早退或矿工；积极参加公司各项活动，关心公司发展并积极提出合理化建议。";?></td>
<td align="center"><?php echo "20%";?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "5";?></td>
<td colspan="2"><?php echo "经理人员：能有效地领导团队制定完成工作计划。";?></td>
<td align="center"><?php echo "30%";?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "6";?></td>
<td colspan="2"><?php echo "经理人员：能招聘优秀人才,并培养在职员工,使其在技术和职业上能有所成长。";?></td>
<td align="center"><?php echo "30%";?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr><td align="right" colspan="7"><?php echo "Employee's Strength Total Score:";?></td><td><?php echo html::input("","","class='input'");?></td></tr>
</table>
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;" align="center">
<tr><th><?php echo $lang->performance->statement;?></th><td colspan="7"><?php echo html::textarea("","","class=ts");?></td></tr>
<tr>
<th rowspan="2"><?php echo $lang->performance->Summary;?></th>
<th><?php echo $lang->performance->review_strenght;?></th>
<td colspan="6"><?php echo html::textarea("","","class=tt");?></td>
</tr>
<tr>
<th><?php echo $lang->performance->review_improve;?></th>
<td colspan="6"><?php echo html::textarea("","","class=tt");?></td>
</tr>
</table> 
<table style="width:1300px;border:1px solid #000;overflow:hidden;margin-left:-1px;margin-top:-1px;" align="center"><tr style="border:1px solid #000;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;margin-top:-1px;" align="center">
<tr>
<th colspan="8"><?php echo $lang->performance->objective."（From：　07/01/2017 To  12/31/2017)"?></th>
</tr>
<tr><th width="100px"><?php echo $lang->performance->Categories;?></th><th colspan="6" width="1119px" style="padding-left:450px"><?php echo $lang->performance->objectives;?></th><th width="80px" style="padding-left:50px;"><?php echo $lang->performance->Weight;?></th></tr>
<tr>
<td align="center"><?php echo "1";?></td>
<td colspan="6"><?php echo html::textarea("","","class='tp'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "2";?></td>
<td colspan="6"><?php echo html::textarea("","","class='tp'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "3";?></td>
<td colspan="6"><?php echo html::textarea("","","class='tp'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "4";?></td>
<td colspan="6"><?php echo html::textarea("","","class='tp'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
<tr>
<td align="center"><?php echo "5";?></td>
<td colspan="6"><?php echo html::textarea("","","class='tp'");?></td>
<td><?php echo html::input("","","class='input'");?></td>
</tr>
</table>
<table><tr style="border:2px solid #FCFCFC;"><td colspan="8" height="10px"></td></tr></table>
<table style="width:1300px;border:1px solid #000;margin-left:-1px;margin-bottom:-1px;" align="center">
<th><?php echo $lang->performance->autographmyself;?></th><td colspan="3"><?php echo html::input("","","class=input");?></td>
<th><?php echo $lang->performance->autographsuper;?></th><td colspan="3"><?php echo html::input("","","class=input");?></td>
</tr>
<tr><th><?php echo $lang->performance->autographcfo;?></th><td colspan="7"><?php echo html::input("","","class=input");?></td></tr>
</table>
</div>
 
 
 <?php include '../../common/view/footer.html.php';?>