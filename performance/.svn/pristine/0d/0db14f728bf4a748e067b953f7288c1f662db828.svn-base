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
     <script type="text/javascript">
            //  function sumbit_sure()
            // {$item = $('.js-valid').each(function(k,v){
            //         // console.log(k,v);
            //         $item_check = $(v).find('input:checked').val();
            //         $item_check_title = k+1
            //          if(!$item_check){
            //             alert($item_check_title+'你还没有填写');
            //             // return false;
            //             die();
            //             // onclick = "reutrn sumbit_sure()";


                        
            //             //die;
            //          }
            //     });

            //       true;   // $('form').submit();
            // }
        </script>
<form name="form1" method='post' onsubmit="return sumbit_sure()" target="hiddenwin">
    <!-- hiddenwin      _blank-->
<div style="width:100%;border:none;  "text-align="center" >
<table style="width:90%;border:none;overflow:hidden;margin-top:-1px;" align="center" border-collapse="collapse" >
<!--<tr><td><div id="timer" style="color:#2828FF"></div></td></tr>-->
<tr><th style="text-align:center;"><font size="5">矽力杰股份有限公司(Silergy Corp. )</font></th></tr>
<tr><th style="text-align:center;"><font size="3">内部控制制度测试-题目卷</font></th></tr>
</table>
<table style="width:90%;border:none;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><th style="text-align:left;margin-right:20%">部门:<?php echo $this->app->user->dept; ?></th><th style="text-align:right;padding-right:20%">卷别:(免填)</th></tr>
<tr><th style="text-align:left;margin-right:20%">姓名:<?php echo $this->app->user->account; ?></th><th style="text-align:right;padding-right:20%">年度 / Year:<?php echo date("Y.m");?></th></tr>
</table>
<table style="width:90%;border:1px solid #000;overflow:hidden;margin-left:5%;margin-top:-1px" align="center" border-collapse="collapse">
<tr><td >&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="3">请如实、完整地填写试题，我们将以专业的态度对您的试题严格保密。感谢您的支持和配合。 
        </font></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="red" size="2">Please fill this secret completely. Your real thoughts and suggetions are key to Silergy's development and progress.  HR Dept. guarantee that no information will be revealed. Thank you for your cooperation.
</font></td></tr>
</table>
<br/>
<!-- 开始答题 -->
<p>
<h3>选择题（每题5分，共20题,含单选及"*"多选题）</h3><br>
            <ol>
                <?php $chengji=0;?><!-- 初始化答题成绩 -->
               <?php foreach($selitem as $key=>$user):?>
                
                <?php if(strstr($user->option,',')):?>      <!-- 多选题 -->
                    <li class="js-valid">
                    <span style="color: red;font-weight:bold">*</span>&nbsp;&nbsp;<?php echo $user->title;?><br>
                    <input type="checkbox" name="record<?php echo $user->id;?>[]" value="A">（A）<?php echo $user->answerA;?><br>
                    <input type="checkbox" name="record<?php echo $user->id;?>[]"" value="B">（B）<?php echo $user->answerB;?><br>
                    <input type="checkbox" name="record<?php echo $user->id;?>[]"" value="C">（C）<?php echo $user->answerC;?><br>
                    <input type="checkbox" name="record<?php echo $user->id;?>[]"" value="D">（D）<?php echo $user->answerD;?><br>
                </li>
                <?php else: ?>      <!-- 单选题 -->
                   <li class="js-valid">
                    <?php echo $user->title;?><br>
                    <input type="radio" name="record<?php echo $user->id;?>"" value="A">（A）<?php echo $user->answerA;?><br>
                    <input type="radio" name="record<?php echo $user->id;?>"" value="B">（B）<?php echo $user->answerB;?><br>
                    <input type="radio" name="record<?php echo $user->id;?>"" value="C">（C）<?php echo $user->answerC;?><br>
                    <input type="radio" name="record<?php echo $user->id;?>"" value="D">（D）<?php echo $user->answerD;?><br>
                </li>
                <?php endif; ?>
                
                <?php endforeach;?>
            </ol>
        </p>
        <p>
            <h4>判断题（每空10分，共20分）</h4><br>
            <ol>
                <?php foreach($choitem as $choi):?>
                <li class="js-valid">
                    <?php echo $choi->title;?>
                    <input type="radio" name="select<?php echo $choi->id;?>" value="5">&radic;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="select<?php echo $choi->id;?>"value="6">X
                    <br>
                </li>
                <?php endforeach; ?>
            </ol>
        </p>

<table style="width:90%;border:none;overflow:hidden;margin-left:5%;margin-top:-1px" text-align="center" border-collapse="collapse" >
<tr><td align="center"><?php echo html::submitButton("Submit");?></td></tr>
</table>
</div>
    <input type="hidden" name="account" value="<?php echo $this->app->user->account; ?>"> 
    <input type="hidden" name="user_id" value="<?php echo $this->app->user->id; ?>"> 
</form>
<?php include "../../common/view/footer.html.php" ;?>