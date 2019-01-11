<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php
css::import($defaultTheme . 'style.css');

?>
<style type="text/css">
.demo{width:450px; margin:10px 20px;}
.select_side{float:left; width:200px}
#selectL,#selectR{width:180px; height:220px}
.select_opt{float:left; width:40px; height:100%; margin-top:36px;}
.select_opt p{width:26px; height:26px; margin-top:6px; background:url(theme/arr.gif) no-repeat; cursor:pointer; text-indent:-999em}
.select_opt p#toright{background-position:2px 0}
.select_opt p#toleft{background-position:2px -22px}
.sub_btn{clear:both; height:42px; line-height:42px; padding-top:10px; text-align:center}
</style>

<script type="text/javascript">
$(function(){
	//alert(select_option.val);
	//$("#search_id").
    var leftSel = $("#selectL");
	var rightSel = $("#selectR");
	$("#toright").bind("click",function(){		
		leftSel.find("option:selected").each(function(){
			$(this).remove().appendTo(rightSel);
		});
	});
	$("#toleft").bind("click",function(){		
		rightSel.find("option:selected").each(function(){
			$(this).remove().appendTo(leftSel);
		});
	});
	leftSel.dblclick(function(){
		$(this).find("option:selected").each(function(){
			$(this).remove().appendTo(rightSel);
		});
	});
	rightSel.dblclick(function(){
		$(this).find("option:selected").each(function(){
			$(this).remove().appendTo(leftSel);
		});
	});
	$("#sub").click(function(){
		var selVal = [];
		rightSel.find("option").each(function(){
			selVal.push(this.value);
		});
		selVals = selVal.join(",");
		//selVals = rightSel.val();
		if(selVals==""){
			alert("No selected items!");
		}else{
			alert(selVals);
		}
	});
});
</script>
<div class='container mw-1400px'>
  <div id='titlebar'>
    <div class='heading'>
      <span class='prefix'><?php echo html::icon($lang->icons['product']);?> <strong><?php echo $product->id;?></strong></span>
     
      <small class='text-muted'> <?php echo $lang->product->edit;?> <i class='icon icon-pencil'></i></small>
    </div>
  </div>
<form class='form-condensed' method='post' target='hiddenwin' id='dataform'>
<table  cellspacing="0" cellpadding="0" width="99%" align="center" border="0" class='table table-form'>
            <tr>
              <th class="bg_tr" style="width:250px;">Parent Product Category</td>
              <td class="bg_tr"><select name="f_id" id="classid" class="form-control">
                  <option value="0">-----Top Category-----</option>
                  <?php
            	   echo $category;
			     ?>
                </select>              </td>
            </tr>
            <tr>
              <th class="w-200px" style="width:250px; display:block;">Category Name</td>
              <td class="bg_tr"><input  name="name" type="text" class="form-control" id="name" value="<?php echo $classinfo->name;?>" size="80" /></td>
            </tr>
            <tr >
              <th  class="bg_tr">Category Name(Simple Chinese): </td>
              <td class="bg_tr" width="90%">
              <input  name="cnname" type="text" class="form-control" id="cnname" value="<?php echo $classinfo->cnname;?>" size="40" />
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             
              
              </td>
            </tr> 
			<tr>
              <th class="bg_tr">Category Name(Traditional Chinese): </td>
              <td class="bg_tr">
           	  <input  name="zhname" type="text" class="form-control" id="cnname" value="<?php echo $classinfo->zhname;?>" size="40" />		
			  </td>
            </tr>                       
			<tr>
              <th class="bg_tr">Overview: </td>
              <td class="bg_tr">
           	  <?php echo html::textarea('remark', htmlspecialchars($classinfo->remark), "rows='10' class='form-control'");?>		
			  </td>
            </tr>

<!--            <tr>
              <th class="bg_tr">Sort: </td>
              <td class="bg_tr"><input name="sort" type="text" class="form-control" id="sort" value="< ?php echo $row['sort'];?>" size="25" /></td>
            </tr>-->
           <tr>
              <th class="bg_tr">Show: </td>
              <td class="bg_tr"><?php echo html::select('show1',array('1'=>'YES','0'=>'NO'),$classinfo->show1)?></td>
          </tr>           
            <tr>
              <th class="bg_tr" style="width:120px;">Parameter: </td>
              <td class="bg_tr" width="90%">

<div class="demo">
     <div class="select_side">
     <p>All items</p>
     <select id="selectL" name="selectL" multiple="multiple" class="form-control">
     <?php echo $parameter ; ?>
     </select>
     </div>
     <div class="select_opt" >
        <p id="toright" title="Add">&gt;</p>
        <p id="toleft" title="Remove">&lt;</p>
     </div>
     <div class="select_side">
     <p>Selected</p>
     <select id="selectR" name="selectR[]" multiple="multiple" class="form-control">
     <?php echo $selectedparameter;?>
     </select>
     </div>
    
  </div>
</td>
</tr>
            <tr>
              <th colspan="2" class="bg_tr"><div align="center">
                  <input type="submit" name="button" id="button" value="Update" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="hidden" id="id" name="id" value="<?php echo $classinfo->id;?>" />
                  <input type="reset" name="button2" id="button2" value="Reset" />
              </div></td>
            </tr>
         
</table>
</form>
</div>
<?php include '../../common/view/footer.html.php';?>
