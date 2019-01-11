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
			/*
			input[type='radio'] {
				display:none;
			}*/
		#te{margin-top:-20px}	
</style>
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
<form method='post' target="_blank" onsubmit="return sumbit_sure()">
<div style="width:100%;border:none;  "text-align="center" >
<table style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><td >&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="3">你已经进行了答题,你的成绩:<?php echo $mark;?> 
        </font></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="2">You have completed the test, your score :<?php echo $mark;?>.
</font></td></tr>
</table>

</div>
    <input type="hidden" name="account" value="<?php echo $this->app->user->account; ?>"> 
    <input type="hidden" name="user_id" value="<?php echo $this->app->user->id; ?>"> 
</form>
<?php include "../../common/view/footer.html.php" ;?>