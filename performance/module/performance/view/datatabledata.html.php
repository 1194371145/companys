
<?php
include '../../common/view/datatable.html.php';
$setting = $this->datatable->getSetting('product');
$widths  = $this->datatable->setFixedFieldWidth($setting);
extract($widths);
?>
    <table class='table table-condensed table-hover table-striped tablesorter table-fixed datatable' id='storyList' data-checkable='true' data-fixed-left-width='<?php echo $leftWidth?>' data-fixed-right-width='<?php echo $rightWidth?>' data-custom-menu='true' data-checkbox-name='storyIDList[]'>
      <thead>
        <tr><?php foreach($setting as $key => $value) $this->datatable->printHead($value, $orderBy, $vars);?></tr>
      </thead>
      <tbody>
        <?php foreach($stories as $story):?>
        <tr class='text-center' data-id='<?php echo $story->id?>'>
          <?php foreach($setting as $key => $value) $this->story->printCell($value, $story, $users, $branches, $storyStages, $modulePairs);?>
        </tr>
        <?php endforeach;?>
      </tbody>
