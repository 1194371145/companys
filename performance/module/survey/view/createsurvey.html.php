<?php include "../../common/view/header.html.php" ;?>
</script>
<style>
#item th{border:black solid 1px;}
#item td{border:black solid 1px;}
#item tr{height:50px;}
.tp{width:100%;height:100%}
.ipt{width:100%;height:47px;}
.sug{width:100%;height:270px;}
.fac{width:100%;height:200px;}
.welf{width:100%;height:390px;}
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
		#te{margin-top:-20px}	
</style>
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
<form method='post' target="hiddenwin" onsubmit="return sumbit_sure()">
<div style="width:100%;border:none;  "text-align="center" >
<table style="width:90%;border:none;overflow:hidden;margin-top:-1px;" align="center" border-collapse="collapse" >
<!--<tr><td><div id="timer" style="color:#2828FF"></div></td></tr>-->
<tr><th style="text-align:center;"><font size="5">员工满意度调查</font></th></tr>
<tr><th style="text-align:center;"><font size="3">Staff Satisfaction Survey</font></th></tr>
</table>
<table style="width:90%;border:none;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><th style="text-align:right;padding-right:20%">年度 / Year:<?php echo date("Y");?></th></tr>
</table>
<table style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><td >&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="3">本问卷调查采用网络匿名的方式。请如实、完整地填写，您的意见和建议对公司未来的发展至关重要，我们将以专业的态度对您的问卷严格保密。感谢您的支持和配合。 
        </font></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="2">Please fill this secret completely. Your real thoughts and suggetions are key to Silergy's development and progress.  HR Dept. guarantee that no information will be revealed. Thank you for your cooperation.
</font></td></tr>
</table>
<br/>
<table style="width:35%;height:180px;border:none;overflow:hidden;float:left;margin-left:12.5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><th colspan="4" style="text-align:center">矽力杰人显著特征</th></tr>
<tr><th colspan="4" style="text-align:center">Silergyer's Characteristics</th></tr>
<tr><th style="text-align:center;">年轻激情</th><th style="text-align:center;">Young and Enthusiastic </th><th style="text-align:center;">奋力进取</th><th style="text-align:center;">Positive and Ambitious</th></tr>
<tr><th style="text-align:center;">高效执行</th><th style="text-align:center;">Efficient and Performing</th><th style="text-align:center;">分享互助</th><th style="text-align:center;">Sharing and Helpful</th></tr>
<tr><th style="text-align:center;">正直坦诚</th><th style="text-align:center;">Honest and Decent</th><th style="text-align:center;">宽容感恩</th><th style="text-align:center;">Kind and Grateful</th></tr>
</table>
<table style="width:30%;height:160px;border:none;overflow:hidden;margin-right:12.5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><th style="text-align:center">矽力杰人的做事标准</th></tr>
<tr><th style="text-align:center">Norms for implementing</th></tr>
<tr><th style="text-align:center">专业创新，结果导向</th></tr>
<tr><th style="text-align:center">Professional and Creative<br/>Results Oriented</th></tr>
</table>
<table style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><th style="text-align:center;">您加入矽力杰几年了？</th></tr>
<tr><th style="text-align:center">How long have you been with Silergy?</th></tr>
<!--<tr style="border-top:black solid 1px;text-align:center"><th style="text-align:center">0-1年         1-3年          3-5年         5-10年</th></tr>
<tr><th style="text-align:center">Less than 1 year, 1-3years, 3-5 years, 5-10 years</th></tr>
--><tr><td id="test" style="text-align:center"><?php echo html::checkbox("silergyyears",$lang->survey->silergyyears,"","");?></td></tr>
<tr><th style="border-top:black solid 1px;text-align:center">您累计工作几年了？</th></tr>
<tr style="text-align:center"><th style="text-align:center">How long have you worked since your graduation?</th></tr>
<!--<tr style="border-top:black solid 1px;text-align:center"><th style="text-align:center">0-1年     1-5年              5-10年              10-15年                   15年以上</th></tr>
<tr><th style="text-align:center">Less than one year  1-5 years  5-10 years  1-15 years over 15 years</th></tr>
--><tr><td id="test2" style="text-align:center"><?php echo html::checkbox("workyears",$lang->survey->workyears,"","");?></td></tr>
</table>

<table id="item" style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse" >
<tr>
<th style="width:5%;text-align:center">题号<br/>NO.</th>
<th style="width:45%;text-align:center">项目<br/>Items</th>
<th style="width:28%;text-align:center">请根据您对于具体描述的赞同/满意程度，点评。<br/>五星为非常赞同/满意，一星为极不赞同/满意<br/>
Give your credit based on your judgements on the items <br/>5 stars - totally agree<br/>1 star - disagree fully</th>
<th style="width:22%;text-align:center">详情描述或意见与建议<br/>Detailed description or suggestions</th>
</tr>
<tr id="val1">
<td style="text-align:center;"><?php echo 1 ;?></td>
<td><?php echo $this->lang->survey->citems[1];?><br/><?php echo $this->lang->survey->eitems[1];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea1","","class='ipt'")?></td>
</tr>
<tr id="val2">
<td style="text-align:center;"><?php echo 2 ;?></td>
<td><?php echo $this->lang->survey->citems[2];?><br/><?php echo $this->lang->survey->eitems[2];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea2","","class='ipt'")?></td>
</tr>
<tr id="val3">
<td style="text-align:center;"><?php echo 3 ;?></td>
<td><?php echo $this->lang->survey->citems[3];?><br/><?php echo $this->lang->survey->eitems[3];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea3","","class='ipt'")?></td>
</tr>
<tr id="val4">
<td style="text-align:center;"><?php echo 4 ;?></td>
<td><?php echo $this->lang->survey->citems[4];?><br/><?php echo $this->lang->survey->eitems[4];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea4","","class='ipt'")?></td>
</tr>
<tr id="val5">
<td style="text-align:center;"><?php echo 5 ;?></td>
<td><?php echo $this->lang->survey->citems[5];?><br/><?php echo $this->lang->survey->eitems[5];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea5","","class='ipt'")?></td>
</tr>
<tr id="val6">
<td style="text-align:center;"><?php echo 6 ;?></td>
<td><?php echo $this->lang->survey->citems[6];?><br/><?php echo $this->lang->survey->eitems[6];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea6","","class='ipt'")?></td>
</tr>
<tr id="val7">
<td style="text-align:center;"><?php echo 7 ;?></td>
<td><?php echo $this->lang->survey->citems[7];?><br/><?php echo $this->lang->survey->eitems[7];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea7","","class='ipt'")?></td>
</tr>
<tr id="val8">
<td style="text-align:center;"><?php echo 8 ;?></td>
<td><?php echo $this->lang->survey->citems[8];?><br/><?php echo $this->lang->survey->eitems[8];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea8","","class='ipt'")?></td>
</tr>
<tr id="val9">
<td style="text-align:center;"><?php echo 9 ;?></td>
<td><?php echo $this->lang->survey->citems[9];?><br/><?php echo $this->lang->survey->eitems[9];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea9","","class='ipt'")?></td>
</tr>
<tr id="val10">
<td style="text-align:center;"><?php echo 10 ;?></td>
<td><?php echo $this->lang->survey->citems[10];?><br/><?php echo $this->lang->survey->eitems[10];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea10","","class='ipt'")?></td>
</tr>
<tr id="val11">
<td style="text-align:center;"><?php echo 11 ;?></td>
<td><?php echo $this->lang->survey->citems[11];?><br/><?php echo $this->lang->survey->eitems[11];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea11","","class='ipt'")?></td>
</tr>
<tr id="val12">
<td style="text-align:center;"><?php echo 12 ;?></td>
<td><?php echo $this->lang->survey->citems[12];?><br/><?php echo $this->lang->survey->eitems[12];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea12","","class='ipt'")?></td>
</tr>
<tr id="val13">
<td style="text-align:center;"><?php echo 13 ;?></td>
<td><?php echo $this->lang->survey->citems[13];?><br/><?php echo $this->lang->survey->eitems[13];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea13","","class='ipt'")?></td>
</tr>
<tr id="val14">
<td style="text-align:center;"><?php echo 14 ;?></td>
<td><?php echo $this->lang->survey->citems[14];?><br/><?php echo $this->lang->survey->eitems[14];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea14","","class='ipt'")?></td>
</tr>
<tr id="val15">
<td style="text-align:center;"><?php echo 15 ;?></td>
<td><?php echo $this->lang->survey->citems[15];?><br/><?php echo $this->lang->survey->eitems[15];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea15","","class='ipt'")?></td>
</tr>
<tr><th colspan="4" bgcolor="#C0C0C0">新员工入职培训中，如下内容，受训后，我受益匪浅<br/>I benefit greatly the following information in new employee training</th></tr>
<tr id="val16">
<td style="text-align:center;"><?php echo 16 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[16];?><br/><?php echo $this->lang->survey->eitems[16];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea16","","class='ipt'")?></td>
</tr>
<tr id="val17">
<td style="text-align:center;"><?php echo 17 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[17];?><br/><?php echo $this->lang->survey->eitems[17];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea17","","class='ipt'")?></td>
</tr>
<tr id="val18">
<td style="text-align:center;"><?php echo 18 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[18];?><br/><?php echo $this->lang->survey->eitems[18];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea18","","class='ipt'")?></td>
</tr>
<tr id="val19">
<td style="text-align:center;"><?php echo 19 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[19];?><br/><?php echo $this->lang->survey->eitems[19];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea19","","class='ipt'")?></td>
</tr>
<tr id="val20">
<td style="text-align:center;"><?php echo 20 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[20];?><br/><?php echo $this->lang->survey->eitems[20];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea20","","class='ipt'")?></td>
</tr>
<tr><th colspan="4" bgcolor="#C0C0C0">在职期间，如下培训，我很感兴趣，受训后，我也受益匪浅<br/>I am interested in the following training and also benefit much </th></tr>
<tr id="val21">
<td style="text-align:center;"><?php echo 21 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[21];?><br/><?php echo $this->lang->survey->eitems[21];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea121","","class='ipt'")?></td>
</tr>
<tr id="val22">
<td style="text-align:center;"><?php echo 22 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[22];?><br/><?php echo $this->lang->survey->eitems[22];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea122","","class='ipt'")?></td>
</tr>
<tr id="val23">
<td style="text-align:center;"><?php echo 23 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[23];?><br/><?php echo $this->lang->survey->eitems[23];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea123","","class='ipt'")?></td>
</tr>
<tr id="val24">
<td style="text-align:center;"><?php echo 24 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[24];?><br/><?php echo $this->lang->survey->eitems[24];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea124","","class='ipt'")?></td>
</tr>
<tr id="val25">
<td style="text-align:center;"><?php echo 25 ;?></td>
<td style="text-align:right"><?php echo $this->lang->survey->citems[25];?><br/><?php echo $this->lang->survey->eitems[25];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea125","","class='ipt'")?></td>
</tr>
<tr id="val26">
<td style="text-align:center;"><?php echo 26 ;?></td>
<td><?php echo $this->lang->survey->citems[26];?><br/><?php echo $this->lang->survey->eitems[26];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea126","","class='ipt'")?></td>
</tr>
<tr id="val27">
<td style="text-align:center;"><?php echo 27 ;?></td>
<td><?php echo $this->lang->survey->citems[27];?><br/><?php echo $this->lang->survey->eitems[27];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea127","","class='ipt'")?></td>
</tr>
<tr id="val28">
<td style="text-align:center;"><?php echo 28 ;?></td>
<td><?php echo $this->lang->survey->citems[28];?><br/><?php echo $this->lang->survey->eitems[28];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea128","","class='ipt'")?></td>
</tr>
<tr id="val29">
<td style="text-align:center;"><?php echo 29 ;?></td>
<td><?php echo $this->lang->survey->citems[29];?><br/><?php echo $this->lang->survey->eitems[29];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea129","","class='ipt'")?></td>
</tr>
<tr id="val30">
<td style="text-align:center;"><?php echo 30 ;?></td>
<td><?php echo $this->lang->survey->citems[30];?><br/><?php echo $this->lang->survey->eitems[30];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea130","","class='ipt'")?></td>
</tr>
<tr id="val31">
<td style="text-align:center;"><?php echo 31 ;?></td>
<td><?php echo $this->lang->survey->citems[31];?><br/><?php echo $this->lang->survey->eitems[31];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea131","","class='ipt'")?></td>
</tr>
<tr id="val32">
<td style="text-align:center;"><?php echo 32 ;?></td>
<td><?php echo $this->lang->survey->citems[32];?><br/><?php echo $this->lang->survey->eitems[32];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea132","","class='ipt'")?></td>
</tr>
<tr id="val33">
<td style="text-align:center;"><?php echo 33 ;?></td>
<td><?php echo $this->lang->survey->citems[33];?><br/><?php echo $this->lang->survey->eitems[33];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea133","","class='ipt'")?></td>
</tr>
<tr id="val34">
<td style="text-align:center;"><?php echo 34 ;?></td>
<td><?php echo $this->lang->survey->citems[34];?><br/><?php echo $this->lang->survey->eitems[34];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea134","","class='ipt'")?></td>
</tr>
<tr id="val35">
<td style="text-align:center;"><?php echo 35 ;?></td>
<td><?php echo $this->lang->survey->citems[35];?><br/><?php echo $this->lang->survey->eitems[35];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea135","","class='ipt'")?></td>
</tr>
<tr id="val36">
<td style="text-align:center;"><?php echo 36 ;?></td>
<td><?php echo $this->lang->survey->citems[36];?><br/><?php echo $this->lang->survey->eitems[36];?></td>
<td style="text-align:center;padding-left:10%;"><div></div></td>
<td><?php echo html::textarea("idea136","","class='ipt'")?></td>
</tr>
</table>

<table style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse" >
<tr><th  width="100%" height="86px" colspan='4' style="text-align:center">以下内容，可赞&nbsp;&nbsp;&nbsp;&nbsp;<img id="te" id="te" src="./data/image/b1.jpg" width="80px" height="40px">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可踩&nbsp;&nbsp;&nbsp;&nbsp;<img id="te" id="te" src="./data/image/b2.jpg" width="86px" height="43px">
<br/>FOR following items,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CREDIT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DISCREDIT
</th></tr>
<tr><th bgcolor="#ccc" width="100%" colspan='4'>办公场所、实验室环境<br/>environment of work and lab</th></tr>
<tr>
<td colspan='3' style="text-align:left;width:70%;border:1px solid black">
<div style="border:none;width:auto;height:auto;display: block;float:left">
<div>
<button type="button" id="button1" ><?php echo $this->lang->survey->csanitation[1];?><br/><?php echo $this->lang->survey->esanitation[1];?></button></div>
<br/>
<div id="t1" style="display:none;text-align:center;">
<label for="sex-man" class="radio_label checked " style="display :none">
<input type="radio" value="hh" checked="checked" id="sex-man" name="value1"/>
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="sex-female" class="radio_label">
<input type="radio" value="yes" id="sex-female" name="value1"/>
</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="sex-taijian" class="radio_label">
<input type="radio" value="no" id="sex-taijian" name="value1"/>
</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left">
<div>
<button type="button" id="button2" ><?php echo $this->lang->survey->csanitation[2];?><br/><?php echo $this->lang->survey->esanitation[2];?></button></div>
<br/>
<div id="t2" style="display:none;text-align:center">
<label for="sex-man2" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="sex-man2" name="value2" /> 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="sex-female2" class="radio_label">
<input type="radio" value="yes" id="sex-female2" name="value2"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="sex-taijian2" class="radio_label">
<input type="radio" value="no" id="sex-taijian2" name="value2"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left">
<div>
<button type="button" id="button3" ><?php echo $this->lang->survey->csanitation[3];?><br/><?php echo $this->lang->survey->esanitation[3];?></button></div>
<br/>
<div id="t3" style="display:none;text-align:center">
<label for="sex-man3" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="sex-man3" name="value3" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="sex-female3" class="radio_label">
<input type="radio" value="yes" id="sex-female3" name="value3"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="sex-taijian3" class="radio_label">
<input type="radio" value="no" id="sex-taijian3" name="value3"/>

</label>
</div>
</div>

<div style="border:none;width:40%;height:auto;display: block;float:left;clear:both">
<div>
<button type="button" id="button4" ><?php echo $this->lang->survey->csanitation[4];?><br/><?php echo $this->lang->survey->esanitation[4];?></button></div>
<br/>
<div id="t4" style="display:none;text-align:center">
<label for="sex-man4" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="sex-man4" name="value4" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="sex-female4" class="radio_label">
<input type="radio" value="yes" id="sex-female4" name="value4"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="sex-taijian4" class="radio_label">
<input type="radio" value="no" id="sex-taijian4" name="value4"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;">
<div>
<button type="button" id="button5" ><?php echo $this->lang->survey->csanitation[5];?><br/><?php echo $this->lang->survey->esanitation[5];?></button></div>
<br/>
<div id="t5" style="display:none;text-align:center">
<label for="sex-man5" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="sex-man5" name="value5" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="sex-female5" class="radio_label">
<input type="radio" value="yes" id="sex-female5" name="value5"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="sex-taijian5" class="radio_label">
<input type="radio" value="no" id="sex-taijian5" name="value5"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;">
<div>
<button type="button" id="button6" ><?php echo $this->lang->survey->csanitation[6];?><br/><?php echo $this->lang->survey->esanitation[6];?></button></div>
<br/>
<div id="t6" style="display:none;text-align:center">
<label for="sex-man6" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="sex-man6" name="value6" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="sex-female6" class="radio_label">
<input type="radio" value="yes" id="sex-female6" name="value6"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="sex-taijian6" class="radio_label">
<input type="radio" value="no" id="sex-taijian6" name="value6"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;clear:both">
<div>
<button type="button" id="button7" ><?php echo $this->lang->survey->csanitation[7];?><br/><?php echo $this->lang->survey->esanitation[7];?></button></div>
<br/>
<div id="t7" style="display:none;text-align:center">
<label for="sex-man7" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="sex-man7" name="value7" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="sex-female7" class="radio_label">
<input type="radio" value="yes" id="sex-female7" name="value7"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="sex-taijian7" class="radio_label">
<input type="radio" value="no" id="sex-taijian7" name="value7"/>

</label>
</div>
</div>
</td>
<td style="border:1px solid black"><?php echo html::textarea("suggest1","","class='sug'");?></td>
</tr>
<!-------------------------------------------------实验室设备---------------------------------------------------------->
<tr><th colspan="4" bgcolor="#ccc" width="100%"><?php echo "实验室内，仪器、设备、电子器件等";?><br/><?php echo "apparatus, devices and electronic components in lab";?></th></tr>
<tr>
<td colspan='3' style="text-align:left;width:70%;border:1px solid black">
<div style="border:none;width:25%;height:auto;display: block;float:left;text-align:center">
<div>
<button type="button" id="fac1" ><?php echo $this->lang->survey->cfacility[1];?><br/><?php echo $this->lang->survey->efacility[1];?></button></div>
<br/>
<div id="f1" style="display:none;text-align:center">
<label for="fac-man1" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man1" name="facility1" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female1" class="radio_label">
<input type="radio" value="yes" id="fac-female1" name="facility1"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian1" class="radio_label">
<input type="radio" value="no" id="fac-taijian1" name="facility1"/>

</label>
</div>
</div>

<div style="border:none;width:20%;height:auto;display: block;float:left;text-align:center">
<div>
<button type="button" id="fac2" ><?php echo $this->lang->survey->cfacility[2];?><br/><?php echo $this->lang->survey->efacility[2];?></button></div>
<br/>
<div id="f2" style="display:none;text-align:center">
<label for="fac-man2" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man2" name="facility2" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female2" class="radio_label">
<input type="radio" value="yes" id="fac-female2" name="facility2"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian2" class="radio_label">
<input type="radio" value="no" id="fac-taijian2" name="facility2"/>

</label>
</div>
</div>

<div style="border:none;width:20%;height:auto;display: block;float:left;text-align:center">
<div>
<button type="button" id="fac3" ><?php echo $this->lang->survey->cfacility[3];?><br/><?php echo $this->lang->survey->efacility[3];?></button></div>
<br/>
<div id="f3" style="display:none;text-align:center">
<label for="fac-man3" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man3" name="facility3" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female3" class="radio_label">
<input type="radio" value="yes" id="fac-female3" name="facility3"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian3" class="radio_label">
<input type="radio" value="no" id="fac-taijian3" name="facility3"/>

</label>
</div>
</div>

<div style="border:none;width:30%;height:auto;display: block;float:left;text-align:center">
<div>
<button type="button" id="fac4" ><?php echo $this->lang->survey->cfacility[4];?><br/><?php echo $this->lang->survey->efacility[4];?></button></div>
<br/>
<div id="f4" style="display:none;text-align:center">
<label for="fac-man4" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man4" name="facility4" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female4" class="radio_label">
<input type="radio" value="yes" id="fac-female4" name="facility4"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian4" class="radio_label">
<input type="radio" value="no" id="fac-taijian4" name="facility4"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;clear:both;text-align:center">
<div>
<button type="button" id="fac5" ><?php echo $this->lang->survey->cfacility[5];?><br/><?php echo $this->lang->survey->efacility[5];?></button></div>
<br/>
<div id="f5" style="display:none;text-align:center">
<label for="fac-man5" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man5" name="facility5" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female5" class="radio_label">
<input type="radio" value="yes" id="fac-female5" name="facility5"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian5" class="radio_label">
<input type="radio" value="no" id="fac-taijian5" name="facility5"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div>
<button type="button" id="fac6" ><?php echo $this->lang->survey->cfacility[6];?><br/><?php echo $this->lang->survey->efacility[6];?></button></div>
<br/>
<div id="f6" style="display:none;text-align:center">
<label for="fac-man1" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man6" name="facility6" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female6" class="radio_label">
<input type="radio" value="yes" id="fac-female6" name="facility6"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian6" class="radio_label">
<input type="radio" value="no" id="fac-taijian6" name="facility6"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div>
<button type="button" id="fac7" ><?php echo $this->lang->survey->cfacility[7];?><br/><?php echo $this->lang->survey->efacility[7];?></button></div>
<br/>
<div id="f7" style="display:none;text-align:center">
<label for="fac-man7" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man7" name="facility7" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female7" class="radio_label">
<input type="radio" value="yes" id="fac-female7" name="facility7"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian7" class="radio_label">
<input type="radio" value="no" id="fac-taijian7" name="facility7"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div>
<button type="button" id="fac8" ><?php echo $this->lang->survey->cfacility[8];?><br/><?php echo $this->lang->survey->efacility[8];?></button></div>
<br/>
<div id="f8" style="display:none;text-align:center">
<label for="fac-man1" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="fac-man8" name="facility8" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="fac-female8" class="radio_label">
<input type="radio" value="yes" id="fac-female8" name="facility8"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="fac-taijian8" class="radio_label">
<input type="radio" value="no" id="fac-taijian8" name="facility8"/>

</label>
</div>
</div>

</td>
<td style="border:1px solid black"><?php echo html::textarea("suggest2","","class=fac");?></td>
</tr>
<!-------------------------------------------------薪酬福利------------------------------------------------------------->
<tr><th colspan="4" bgcolor="#ccc" width="100%"><?php echo "薪酬/福利等";?><br/><?php echo "salary/benefits and welfare";?></th></tr>
<tr>
<td colspan="3">
<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel1" ><?php echo $this->lang->survey->cwelfare[1];?><br/><?php echo $this->lang->survey->ewelfare[1];?></button></div>
<div id="w1" style="display:none;text-align:center">
<label for="wel-man1" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man1" name="welfare1" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female1" class="radio_label">
<input type="radio" value="yes" id="wel-female1" name="welfare1"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian1" class="radio_label">
<input type="radio" value="no" id="wel-taijian1" name="welfare1"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel2" ><?php echo $this->lang->survey->cwelfare[2];?><br/><?php echo $this->lang->survey->ewelfare[2];?></button></div>
<div id="w2" style="display:none;text-align:center">
<label for="wel-man2" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man2" name="welfare2" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female2" class="radio_label">
<input type="radio" value="yes" id="wel-female2" name="welfare2"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian2" class="radio_label">
<input type="radio" value="no" id="wel-taijian2" name="welfare2"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel3" ><?php echo $this->lang->survey->cwelfare[3];?><br/><?php echo $this->lang->survey->ewelfare[3];?></button></div>
<div id="w3" style="display:none;text-align:center">
<label for="wel-man3" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man3" name="welfare3" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female3" class="radio_label">
<input type="radio" value="yes" id="wel-female3" name="welfare3"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian3" class="radio_label">
<input type="radio" value="no" id="wel-taijian3" name="welfare3"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel4" ><?php echo $this->lang->survey->cwelfare[4];?><br/><?php echo $this->lang->survey->ewelfare[4];?></button></div>
<div id="w4" style="display:none;text-align:center">
<label for="wel-man4" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man4" name="welfare4" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female4" class="radio_label">
<input type="radio" value="yes" id="wel-female4" name="welfare4"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian4" class="radio_label">
<input type="radio" value="no" id="wel-taijian4" name="welfare4"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel5" ><?php echo $this->lang->survey->cwelfare[5];?><br/><?php echo $this->lang->survey->ewelfare[5];?></button></div>
<div id="w5" style="display:none;text-align:center">
<label for="wel-man5" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man5" name="welfare5" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female5" class="radio_label">
<input type="radio" value="yes" id="wel-female5" name="welfare5"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian5" class="radio_label">
<input type="radio" value="no" id="wel-taijian5" name="welfare5"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center ;clear:both">
<div><button type="button" id="wel6" ><?php echo $this->lang->survey->cwelfare[6];?><br/><?php echo $this->lang->survey->ewelfare[6];?></button></div>
<div id="w6" style="display:none;text-align:center">
<label for="wel-man2" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man6" name="welfare6" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female6" class="radio_label">
<input type="radio" value="yes" id="wel-female6" name="welfare6"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian6" class="radio_label">
<input type="radio" value="no" id="wel-taijian6" name="welfare6"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel7" ><?php echo $this->lang->survey->cwelfare[7];?><br/><?php echo $this->lang->survey->ewelfare[7];?></button></div>
<div id="w7" style="display:none;text-align:center">
<label for="wel-man7" class="radio_label checked" style="display :none"> 
<input type="radio" value="hh" checked="checked" id="wel-man7" name="welfare7" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female7" class="radio_label">
<input type="radio" value="yes" id="wel-female7" name="welfare7"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian7" class="radio_label">
<input type="radio" value="no" id="wel-taijian7" name="welfare7"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center;clear:both">
<div><button type="button" id="wel8" ><?php echo $this->lang->survey->cwelfare[8];?><br/><?php echo $this->lang->survey->ewelfare[8];?></button></div>
<div id="w8" style="display:none;text-align:center">
<label for="wel-man8" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man8" name="welfare8" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female8" class="radio_label">
<input type="radio" value="yes" id="wel-female8" name="welfare8"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian8" class="radio_label">
<input type="radio" value="no" id="wel-taijian8" name="welfare8"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel9" ><?php echo $this->lang->survey->cwelfare[9];?><br/><?php echo $this->lang->survey->ewelfare[9];?></button></div>
<div id="w9" style="display:none;text-align:center">
<label for="wel-man9" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man9" name="welfare9" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female9" class="radio_label">
<input type="radio" value="yes" id="wel-female9" name="welfare9"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian9" class="radio_label">
<input type="radio" value="no" id="wel-taijian9" name="welfare9"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel10" ><?php echo $this->lang->survey->cwelfare[10];?><br/><?php echo $this->lang->survey->ewelfare[10];?></button></div>
<div id="w10" style="display:none;text-align:center">
<label for="wel-man10" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man10" name="welfare10" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female10" class="radio_label">
<input type="radio" value="yes" id="wel-female10" name="welfare10"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian10" class="radio_label">
<input type="radio" value="no" id="wel-taijian10" name="welfare10"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel11" ><?php echo $this->lang->survey->cwelfare[11];?><br/><?php echo $this->lang->survey->ewelfare[11];?></button></div>
<div id="w11" style="display:none;text-align:center">
<label for="wel-man11" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man11" name="welfare11" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female11" class="radio_label">
<input type="radio" value="yes" id="wel-female11" name="welfare11"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian11" class="radio_label">
<input type="radio" value="no" id="wel-taijian11" name="welfare11"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel12" ><?php echo $this->lang->survey->cwelfare[12];?><br/><?php echo $this->lang->survey->ewelfare[12];?></button></div>
<div id="w12" style="display:none;text-align:center">
<label for="wel-man12" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man12" name="welfare12" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female12" class="radio_label">
<input type="radio" value="yes" id="wel-female12" name="welfare12"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian12" class="radio_label">
<input type="radio" value="no" id="wel-taijian12" name="welfare12"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center;clear:both">
<div><button type="button" id="wel13" ><?php echo $this->lang->survey->cwelfare[13];?><br/><?php echo $this->lang->survey->ewelfare[13];?></button></div>
<div id="w13" style="display:none;text-align:center">
<label for="wel-man13" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man13" name="welfare13" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female13" class="radio_label">
<input type="radio" value="yes" id="wel-female13" name="welfare13"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian13" class="radio_label">
<input type="radio" value="no" id="wel-taijian13" name="welfare13"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel14" ><?php echo $this->lang->survey->cwelfare[14];?><br/><?php echo $this->lang->survey->ewelfare[14];?></button></div>
<div id="w14" style="display:none;text-align:center">
<label for="wel-man14" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man14" name="welfare14" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female14" class="radio_label">
<input type="radio" value="yes" id="wel-female14" name="welfare14"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian14" class="radio_label">
<input type="radio" value="no" id="wel-taijian14" name="welfare14"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel15" ><?php echo $this->lang->survey->cwelfare[15];?><br/><?php echo $this->lang->survey->ewelfare[15];?></button></div>
<div id="w15" style="display:none;text-align:center">
<label for="wel-man15" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man15" name="welfare15" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female15" class="radio_label">
<input type="radio" value="yes" id="wel-female15" name="welfare15"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian15" class="radio_label">
<input type="radio" value="no" id="wel-taijian15" name="welfare15"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel16" ><?php echo $this->lang->survey->cwelfare[16];?><br/><?php echo $this->lang->survey->ewelfare[16];?></button></div>
<div id="w16" style="display:none;text-align:center">
<label for="wel-man16" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man16" name="welfare16" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female16" class="radio_label">
<input type="radio" value="yes" id="wel-female16" name="welfare16"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian16" class="radio_label">
<input type="radio" value="no" id="wel-taijian16" name="welfare16"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center;clear:both">
<div><button type="button" id="wel17" ><?php echo $this->lang->survey->cwelfare[17];?><br/><?php echo $this->lang->survey->ewelfare[17];?></button></div>
<div id="w17" style="display:none;text-align:center">
<label for="wel-man17" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man17" name="welfare17" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female17" class="radio_label">
<input type="radio" value="yes" id="wel-female17" name="welfare17"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian17" class="radio_label">
<input type="radio" value="no" id="wel-taijian17" name="welfare17"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel18" ><?php echo $this->lang->survey->cwelfare[18];?><br/><?php echo $this->lang->survey->ewelfare[18];?></button></div>
<div id="w18" style="display:none;text-align:center">
<label for="wel-man18" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man18" name="welfare18" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female18" class="radio_label">
<input type="radio" value="yes" id="wel-female18" name="welfare18"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian18" class="radio_label">
<input type="radio" value="no" id="wel-taijian18" name="welfare18"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel19" ><?php echo $this->lang->survey->cwelfare[19];?><br/><?php echo $this->lang->survey->ewelfare[19];?></button></div>
<div id="w19" style="display:none;text-align:center">
<label for="wel-man19" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man19" name="welfare19" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female19" class="radio_label">
<input type="radio" value="yes" id="wel-female19" name="welfare19"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian19" class="radio_label">
<input type="radio" value="no" id="wel-taijian19" name="welfare19"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center;clear:both">
<div><button type="button" id="wel20" ><?php echo $this->lang->survey->cwelfare[20];?><br/><?php echo $this->lang->survey->ewelfare[20];?></button></div>
<div id="w20" style="display:none;text-align:center">
<label for="wel-man20" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man20" name="welfare20" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female20" class="radio_label">
<input type="radio" value="yes" id="wel-female20" name="welfare20"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian20" class="radio_label">
<input type="radio" value="no" id="wel-taijian20" name="welfare20"/>

</label>
</div>
</div>

<div style="border:none;width:auto;height:auto;display: block;float:left;text-align:center">
<div><button type="button" id="wel21" ><?php echo $this->lang->survey->cwelfare[21];?><br/><?php echo $this->lang->survey->ewelfare[21];?></button></div>
<div id="w21" style="display:none;text-align:center">
<label for="wel-man21" class="radio_label checked" style="display :none">
<input type="radio" value="hh" checked="checked" id="wel-man21" name="welfare21" />
 
</label>
<img id="te" src="./data/image/gao1.jpg" width="19px" height="19px">&nbsp;
<label for="wel-female21" class="radio_label">
<input type="radio" value="yes" id="wel-female21" name="welfare21"/>

</label>
<img id="te" src="./data/image/ku1.jpg" width="21px" height="20px">&nbsp;
<label for="wel-taijian21" class="radio_label">
<input type="radio" value="no" id="wel-taijian21" name="welfare21"/>

</label>
</div>
</div>
</td>
<td style="border:1px solid black"><?php echo html::textarea("suggest3","","class='welf'");?></td>
</tr>
<tr><th colspan="4" bgcolor="#ccc" width="100%"><?php echo "请您用几个词语，点评一下您心中的矽力杰。";?><br/><?php echo "Your comments on Silergy, using a few words ";?></th></tr>
<tr><td colspan="4" width="100%"><?php echo html::textarea("suggest4","","class='tp'");?></td></tr>
<tr><th colspan="4" bgcolor="#ccc" width="100%"><?php echo "上述问题未涉及的，您可在此处详尽阐述。";?><br/><?php echo "For more issues, please write down in details below.";?></th></tr>
<tr><td colspan="4" width="100%"><?php echo html::textarea("suggest5","","class='tp'");?></td></tr>
</table>
<table style="width:90%;border:none;overflow:hidden;margin-left:5%;margin-top:-1px" text-align="center" border-collapse="collapse" >
<tr><td align="center"><?php echo html::submitButton("Submit");?></td></tr>
</table>
</div>

</form>
<script type="text/javascript">
function sumbit_sure(){  
	var gnl=confirm("No more edition after submission.");  
	if (gnl==true){  
	return true;  
	}else{  
	return false;  
	}  
	} 
	//定义star图片的路径
	$.fn.raty.defaults.path = './js/lib/img/';

	$('#item tr td div').raty({ 
		cancel   : false, //关闭cancel
  		cancelOff: 'cancel-off-big.png',
  		cancelOn : 'cancel-on-big.png',
  		half     : false, //关闭半星
  		size     : 24,
  		hints    : ['差', '一般', '好', '非常好', '全五星'],
  		score    : 0,
  		starHalf : 'star-half-big.png',
  		starOff  : 'star-off-big.png',
  		starOn   : 'star-on-big.png'});
	for (var i = 0 ;i < 5 ;i++)
	{
		$('#val1 input:hidden:eq('+i+')').attr('name','val1'); //重命名input表单的name
		$('#val2 input:hidden:eq('+i+')').attr('name','val2'); 
		$('#val3 input:hidden:eq('+i+')').attr('name','val3'); 
		$('#val4 input:hidden:eq('+i+')').attr('name','val4'); 
		$('#val5 input:hidden:eq('+i+')').attr('name','val5'); 
		$('#val6 input:hidden:eq('+i+')').attr('name','val6'); 
		$('#val7 input:hidden:eq('+i+')').attr('name','val7'); 
		$('#val8 input:hidden:eq('+i+')').attr('name','val8'); 
		$('#val9 input:hidden:eq('+i+')').attr('name','val9'); 
		$('#val10 input:hidden:eq('+i+')').attr('name','val10'); 
		$('#val11 input:hidden:eq('+i+')').attr('name','val11'); 
		$('#val12 input:hidden:eq('+i+')').attr('name','val12'); 
		$('#val13 input:hidden:eq('+i+')').attr('name','val13'); 
		$('#val14 input:hidden:eq('+i+')').attr('name','val14'); 
		$('#val15 input:hidden:eq('+i+')').attr('name','val15'); 
		$('#val16 input:hidden:eq('+i+')').attr('name','val16'); 
		$('#val17 input:hidden:eq('+i+')').attr('name','val17'); 
		$('#val18 input:hidden:eq('+i+')').attr('name','val18'); 
		$('#val19 input:hidden:eq('+i+')').attr('name','val19'); 
		$('#val20 input:hidden:eq('+i+')').attr('name','val20'); 
		$('#val21 input:hidden:eq('+i+')').attr('name','val21'); 
		$('#val22 input:hidden:eq('+i+')').attr('name','val22'); 
		$('#val23 input:hidden:eq('+i+')').attr('name','val23'); 
		$('#val24 input:hidden:eq('+i+')').attr('name','val24'); 
		$('#val25 input:hidden:eq('+i+')').attr('name','val25'); 
		$('#val26 input:hidden:eq('+i+')').attr('name','val26'); 
		$('#val27 input:hidden:eq('+i+')').attr('name','val27'); 
		$('#val28 input:hidden:eq('+i+')').attr('name','val28'); 
		$('#val29 input:hidden:eq('+i+')').attr('name','val29'); 
		$('#val30 input:hidden:eq('+i+')').attr('name','val30'); 
		$('#val31 input:hidden:eq('+i+')').attr('name','val31'); 
		$('#val32 input:hidden:eq('+i+')').attr('name','val32'); 
		$('#val33 input:hidden:eq('+i+')').attr('name','val33'); 
		$('#val34 input:hidden:eq('+i+')').attr('name','val34'); 
		$('#val35 input:hidden:eq('+i+')').attr('name','val35'); 
		$('#val36 input:hidden:eq('+i+')').attr('name','val36');
		
	}
</script>
<?php include "../../common/view/footer.html.php" ;?>