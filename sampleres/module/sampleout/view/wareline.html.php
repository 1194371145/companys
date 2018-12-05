<?php include "../../common/view/header.html.php";?>
<?php
css::import($defaultTheme . 'autocomplete.css');
js::import($jsRoot . 'jquery/autocomplete/autocomplete.min.js');
?>
<style type="text/css">
th{width:180px;}
.table1{width:600px;margin-top:245px;font-size:25px;}
.anniu{display:block;background-color:#1A4F85;padding:13px;border:none;color:white;font-size:10px;margin:-1px 0px -1px 5px;}
</style>
    <table align='center' class='table1'> 
      <tr>
        <th align="right">选择产品型号:</th>
		<td><?php echo html::input("part","","style='width:100%;' onchange=ggetwareline();");?></td>
        <td align="left"><?php echo html::a($this->createLink("sampleout","partnum"),'维护', '', "id = 'apartnum' class='anniu' onclick='getwareline();'");?></td>
      </tr>
	  <tr>
	      <td colspan="3" align="left" id="partnum"></td>
	  </tr>
    </table>
<script type="text/javascript">
	var autoList = "<?php echo join(',', $allpart);?>".split(',');
	$(function(){
    $("#part").autocomplete(autoList,{multiple: false,mustMatch: true});
    });
	function ggetwareline()
	{
		setTimeout("getwareline()","500");
	}
	function getwareline()
	{
		var wareline=$("#part").val();
		$.ajax({
		 url:"<?php echo $this->createLink("sampleout","ajaxpartnum");?>",
		 type:"post",
		 data:"part="+wareline,
		 dataType:'json',
		 success:function(e){
				$("#partnum").html("<b style='color;'>样品 <b style='color:red;'>"+wareline+"</b> 库存警戒线值:<b style='color:red;'>"+ e.re +"</b></b>");
		 }
		});
		$("#apartnum").attr("href","<?php echo $this->createLink('sampleout','partnum');?>"+"&partnum="+wareline);
	}
</script>
<?php include "../../common/view/footer.html.php";?>