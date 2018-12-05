<?php include '../../common/view/header.html.php';?>
<div class='container mw-500px'>
 <div id='titlebar'>
    <div class='heading'><i class='icon-key'></i> <?php echo $lang->sampleout->importout;?></div>
  </div>
  <form class='form-condensed' method='post' target='' enctype="multipart/form-data">
    <table align='center' class='table table-form w-p100'> 
      <tr>
        <th class='rowhead w-80px'><?php echo $lang->sampleout->file;?></th>
        <td><?php echo html::file('file',"class='form-control chosen'")?></td>
      </tr>
      <tr>
      <th class='rowhead w-80px'><?php echo $lang->sampleout->sarea;?></th>
       <td><?php echo html::select('area',array("NC"=>"NC","SC"=>"SC","KR"=>"KR","TW"=>"TW","US"=>"US"),"","class='form-control chosen'");?></td>
      </tr> 
      <tr>
      <th class='rowhead w-80px'></th>
        <td><?php echo html::submitButton('', '', 'btn-primary');?></td>
      </tr> 
    </table>
  </form>  
</div>
<?php include '../../common/view/footer.html.php';?>
