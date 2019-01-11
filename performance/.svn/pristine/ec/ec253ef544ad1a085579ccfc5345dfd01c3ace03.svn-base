<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	  <form method='post' target='_blank' style="overflow: hidden;">
	  	<!-- <input type="hidden" name=""> -->
	  <h3>题目:<?php echo html::input('title',$res->title,"class='tds'  style='width:200px;'");?></h3><br>
   <?php if($type=="select"):?> 
   	(A)<?php echo html::input('answersA',$arr[0],"class='tds'  style='width:200px;'");?><br>
	  	(B)<?php echo html::input('answersB',$arr[1],"class='tds'  style='width:200px;'");?><br>(C)<?php echo html::input('answersC',$arr[2],"class='tds'  style='width:200px;'");?><br>(D)<?php echo html::input('answersD',$arr[3],"class='tds'  style='width:200px;'");?>
   	<?php else: ?> 
   		<?php endif; ?>
   		<div><?php echo html::submitButton("保存").html::resetButton("重填");?></div>
   		</form>
</body>