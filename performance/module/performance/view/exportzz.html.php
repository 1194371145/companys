<?php include '../../common/view/header.lite.html.php';?>

<form enctype='multipart/form-data' action="" method='post' id="import" >
<table width='100%' style="height:100px; width:500px;">
<tr>
<td align="center" width='70%'>&nbsp;&nbsp;<input type='file' name='file' style='height:30px;width:270px;'/></td>
<td align="center" width='30%'><?php echo html::submitButton("Import Excel");?></td>
</tr>

</table>
</form>