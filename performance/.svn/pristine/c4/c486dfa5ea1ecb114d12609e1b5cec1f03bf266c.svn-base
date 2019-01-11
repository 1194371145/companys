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
<tr><th style="text-align:center;"><font size="5">矽力杰股份有限公司(Silergy Corp. )</font></th></tr>
<tr><th style="text-align:center;"><font size="3">内部控制制度测试-题目卷</font></th></tr>
</table>
<table style="width:90%;border:none;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><th style="text-align:left;margin-right:20%">部门:</th><th style="text-align:right;padding-right:20%">卷别:(免填)</th></tr>
<tr><th style="text-align:left;margin-right:20%">姓名:</th><th style="text-align:right;padding-right:20%">年度 / Year:<?php echo date("Y.m");?></th></tr>
</table>
<table style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><td >&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="3">请如实、完整地填写试题，我们将以专业的态度对您的试题严格保密。感谢您的支持和配合。 
        </font></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="2">Please fill this secret completely. Your real thoughts and suggetions are key to Silergy's development and progress.  HR Dept. guarantee that no information will be revealed. Thank you for your cooperation.
</font></td></tr>
</table>
<br/>
<!-- 开始答题 -->

<table id="item" style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse" >
	<h1></h1>

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