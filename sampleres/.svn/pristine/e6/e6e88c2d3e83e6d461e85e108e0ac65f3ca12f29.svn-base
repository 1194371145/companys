<?php include '../../common/view/header.html.php';?>

<div class='container mw-500px'>
 <div id='titlebar'>
    <div class='heading'><i class='icon-key'></i> <?php echo $lang->sample->importbasicdata;?></div>
  </div>
  <form class='form-condensed' method='post' target=''  enctype='multipart/form-data'>
    <table align='center' class='table table-form w-p100'> 
      <tr>
        <th class='rowhead w-80px'><?php echo $lang->sample->file;?></th>
        <td><?php echo html::file('file',"class='form-control chosen'")?></td>
		<?php
		if(in_array(1,$this->app->user->groups))
		{
			echo "<td>".html::select('region',array("HZ"=>"HZ","TW"=>"TW"),"HZ","class='form-control'")."</td>";
			echo "<td>".html::select('openby',$openbys,"","class='form-control'")."</td>";
		}
		?>
        <td><?php echo html::submitButton('', '', 'btn-primary');?></td>
      </tr>  
    </table>
  </form>  
</div>
<?php include '../../common/view/footer.html.php';?>