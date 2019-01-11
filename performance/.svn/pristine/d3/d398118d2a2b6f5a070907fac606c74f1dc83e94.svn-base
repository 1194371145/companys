<?php js::set('productID', $productID);?>
<?php js::set('module', $module);?>
<?php js::set('method', $method);?>
<?php js::set('extra', $extra);?>
<input type='text' class='form-control' id='search' value='' placeholder='<?php echo $this->app->loadLang('search')->search->common;?>'/>
<div id='searchResult' style="width:340px;">
  <div id='defaultMenu' class='search-list'>
    <ul>
    <?php
    $iCharges = 0;
    $others   = 0;
    $closeds  = 0;

    
    if($iCharges and $others) echo "<li class='heading'>{$lang->product->mine}</li>";
    foreach($circles as $product)
    {
		 $tmpname = $product->circle;
		 $tmpname = substr($tmpname,0,4)." ".substr($tmpname,4,1)."H ";
		 $tmpname .= " Performance Appraisal";
         if(strlen($product->circle) > 50) $tmpname = substr($product->circle,0,50)."...";
         echo "<li>" . html::a(sprintf($link, $product->circle), "<i class='icon-cube'></i> " . $tmpname, '', "class='mine text-important'"). "</li>";

    }
 
    ?>
    </ul>
 
    <div>
      <?php echo html::a($this->createLink('performance', 'all',array('CID'=>'all')), "<i class='icon-cubes mgr-5px'></i> " . $lang->performance->allPerformance)?>
      <?php if($closeds):?>
      <div class='pull-right actions'><a id='more' href='javascript:switchMore()'><?php echo $lang->product->closed;?> <i class='icon-angle-right'></i></a></div>
      <?php endif;?>
    </div>
  </div>
 
  <div id='moreMenu'>
    <ul>
    <?php
      foreach($circles as $product)
      {
        if($product->status == 'closed') echo "<li>" . html::a(sprintf($link, $product->id), "<i class='icon-cube'></i> " . $product->circle, '', "class='closed'"). "</li>";
      }
    ?>
    </ul>
  </div>
</div>
