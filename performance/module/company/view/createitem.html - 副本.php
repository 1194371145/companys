<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method='post' target='hidden' style="overflow: hidden;">
		<!--_blank -->
		<table class='table table-condensed' >
			<tr><th>题号:</th><td ><?php echo html::input('quetionID',$questionId,"class='tds'  style='width:200px;'");?></td></tr>
		<tr><th>题目:</th><td ><?php echo html::input('title','',"class='tds' placeholder='请猜猜()里的答案'  style='width:400px;'");?>
	
		</td></tr>
		<?php if($itemtype==selt): ?>
			<tr><td style="width: 300px;">请勾选正确答案</td></tr>
		<tr><th>A:</th><td ><input type="checkbox" name="option[]" value="A" id="options0">
			<?php echo html::input('answerA','',"class='tds' placeholder='请插入A答案' style='width:200px;'");?>
			
		</td></tr>
		<tr><th>B:</th><td ><input type="checkbox" name="option[]" value="B" id="options0"><?php echo html::input('answerB','',"class='tds' placeholder='请插入B答案'  style='width:200px;'");?>
			
		</td></tr>
		<tr><th>C:</th><td ><input type="checkbox" name="option[]" value="C" id="options0"><?php echo html::input('answerC','',"class='tds' placeholder='请插入C答案'  style='width:200px;'");?>
			
		</td></tr>
		<tr><th>D:</th><td ><input type="checkbox" name="option[]" value="D" id="options0"><?php echo html::input('answerD','',"class='tds'  placeholder='请插入D答案' style='width:200px;'");?>
			
		</td></tr>
	<?php endif; ?>
			<?php if($itemtype==judge): ?>
	
		<tr><th>当前题是否正确:</th><td >
			<select name="option"><option value="5">&radic;</option>
  			<option value="6">X</option></select>
		</td></tr>
			<?php endif; ?>
		<tr><td colspan='9' align="center"><?php echo html::submitButton("保存").html::resetButton("重填");?></td></tr>
		</table>
	</form>
</body>