<?php include "../../common/view/header.html.php" ;?>
<style>
#ts{text-align:left}
#it th{border:black solid 1px;text-align:center;padding-left:10px}
#it td{border:black solid 1px;padding-left:10px}
#it tr{height:50px;}

.pt{width:100%;height:100%}
.radio_label{
				background: url(./data/image/qc.jpg);
				background-size:16px 40px;
                background-repeat: no-repeat;
				display: inline-block;
				line-height: 20px;
				height: 20px;
                width:40px;
				margin-right:5px;
                background-color:1px solid red;
			}
			
			.checked {
				background-position: 0  -20px;
			}
			
			input[type='radio'] {
				display:none;
			}
		img{margin-top:-20px}
</style>
<form method='post' target='hiddenwin'>
<div style="width:100%;border:none;  "text-align="center" >
<table  id="it" style="width:70%;border:1px solid black;overflow:hidden;margin-top:-1px" align="center" border-collapse="collapse">
<caption><font size="4">员工满意度调查问卷 - 杭州地区副卷</font></caption>
<tr><th>题号</th><th align="left">公司将预计19年搬进“矽力杰大楼”，对此想征求您作为杭州地区办公的员工的宝贵意见</th><th>选项<br/>以下说法您是否赞同</th><th>详细描述或意见与建议</th></tr>
<tr>
<td style = "text-align:center">1</td>
<td id="ts">新大楼，我上下班，路途用时更少</td>
<td>
<div id="p1" style="text-align:center;">
<label for="qw-n1" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n1" name="re1"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a1" class="radio_label">
<input type="radio" value="yes" id="qw-a1" name="re1"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s1" class="radio_label">
<input type="radio" value="no" id="qw-s1" name="re1"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx1","","class='pt'")?></td>
</tr>

<tr>
<td style = "text-align:center">2</td>
<td id="ts">新大楼，我上下班交通更便利</td>
<td>
<div id="p2" style="text-align:center;">
<label for="qw-n2" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n2" name="re2"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a2" class="radio_label">
<input type="radio" value="yes" id="qw-a2" name="re2"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s2" class="radio_label">
<input type="radio" value="no" id="qw-s2" name="re2"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx2","","class='pt'")?></td>
</tr>


<tr>
<td style = "text-align:center">3</td>
<td id="ts">新大楼，班车接送，我更需要</td>
<td>
<div id="p3" style="text-align:center;">
<label for="qw-n3" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n3" name="re3"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a3" class="radio_label">
<input type="radio" value="yes" id="qw-a3" name="re3"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s3" class="radio_label">
<input type="radio" value="no" id="qw-s3" name="re3"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx3","","class='pt'")?></td>
</tr>

<tr>
<td style = "text-align:center">4</td>
<td id="ts">新大楼，以“缩短午休时间” 来换取 “下班时间提早”，我更需要</td>
<td>
<div id="p4" style="text-align:center;">
<label for="qw-n4" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n4" name="re4"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a4" class="radio_label">
<input type="radio" value="yes" id="qw-a4" name="re4"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s4" class="radio_label">
<input type="radio" value="no" id="qw-s4" name="re4"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx4","","class='pt'")?></td>
</tr>

<tr>
<td style = "text-align:center">5</td>
<td id="ts">新大楼，茶水间、哺乳室等公共区域，我更需要</td>
<td>
<div id="p5" style="text-align:center;">
<label for="qw-n5" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n5" name="re5"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a5" class="radio_label">
<input type="radio" value="yes" id="qw-a5" name="re5"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s5" class="radio_label">
<input type="radio" value="no" id="qw-s5" name="re5"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx5","","class='pt'")?></td>
</tr>

<tr>
<td style = "text-align:center">6</td>
<td id="ts">新大楼，休闲运动、跑道、健身器材等公共区域设施，我更需要</td>
<td>
<div id="p6" style="text-align:center;">
<label for="qw-n6" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n6" name="re6"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a6" class="radio_label">
<input type="radio" value="yes" id="qw-a6" name="re6"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s6" class="radio_label">
<input type="radio" value="no" id="qw-s6" name="re6"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx6","","class='pt'")?></td>
</tr>

<tr>
<td style = "text-align:center">7</td>
<td id="ts">新大楼，食堂、超市、水果店、咖啡店、便利店等生活设施，我更需要</td>
<td>
<div id="p7" style="text-align:center;">
<label for="qw-n1" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n7" name="re7"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a7" class="radio_label">
<input type="radio" value="yes" id="qw-a7" name="re7"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s7" class="radio_label">
<input type="radio" value="no" id="qw-s7" name="re7"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx7","","class='pt'")?></td>
</tr>

<tr>
<td style = "text-align:center">8</td>
<td id="ts">新大楼，幼儿班、 小托班等家庭服务设施，我更需要</td>
<td>
<div id="p8" style="text-align:center;">
<label for="qw-n1" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="qw-n8" name="re8"/>
</label>
<img src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="qw-a8" class="radio_label">
<input type="radio" value="yes" id="qw-a8" name="re8"/>
</label>
<img src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="qw-s8" class="radio_label">
<input type="radio" value="no" id="qw-s8" name="re8"/>
</label>
</div>
</td>
<td><?php echo html::textarea("ttx8","","class='pt'")?></td>
</tr>
<tr><th colspan="4" bgcolor="#C0C0C0" style="text-align:left">对于食堂，您还有什么宝贵意见，您可在此处详尽阐述。</th></tr>
<tr><td colspan="4"><?php echo html::textarea("xinsuggest1","","class='pt'")?></td></tr>
<tr><th colspan="4" bgcolor="#C0C0C0" style="text-align:left">对于公司考勤时间设置，您还有什么宝贵意见，您可在此处详尽阐述。</th></tr>
<tr><td colspan="4"><?php echo html::textarea("xinsuggest2","","class='pt'")?></td></tr>
<tr><th colspan="4" bgcolor="#C0C0C0" style="text-align:left">上述问题未涉及的，您可在此处详尽阐述。</th></tr>
<tr><td colspan="4"><?php echo html::textarea("xinsuggest3","","class='pt'")?></td></tr>
</table>
</div>
<table style="width:90%;border:none;overflow:hidden;margin-left:5%;margin-top:-1px" text-align="center" border-collapse="collapse" >
<tr><td align="center"><?php echo html::submitButton("匿名提交").html::resetButton("返回");?></td></tr>
</table>
</form>
<script>
$(function(){
	$("input[type='radio']").click(function(){
	$("input[type='radio'][name='"+$(this).attr('name')+"']").parent().removeClass("checked");
	$(this).parent().addClass("checked");
	    });
	});  

//$(document).ready(function(){
//	  $("#button1").click(function(){
//	  $("#t1").toggle();
//      var button1 = $("input[name='value1']").val();//alert(button1);
//	  
//       
//	  });
//	});

</script>
<?php include "../../common/view/footer.html.php";?>