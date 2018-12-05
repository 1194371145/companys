<?php include "../../common/view/header.lite.html.php";?>
<div class='container mw-700px'>
 <div id='titlebar'>
    <div class='heading'><i class='icon-key'></i> <?php echo $lang->sampleout->partnum;?></div>
  </div>
  <form class='form-condensed' method='post' target='' enctype="multipart/form-data"> 
    <table align='center' class='table table-form w-p100'> 
      <tr>
        <th align="right"><?php echo $part->part;?></th>
        <td><?php echo html::input('num',$part->num,"style='width:100%;'")?></td>
        <td align="left"><?php echo html::submitButton('', '', 'btn-primary');?></td>
      </tr> 
    </table>
  </form>  
</div>
<?php include "../../common/view/action.html.php";?>
<?php include "../../common/view/footer.lite.html.php";?>