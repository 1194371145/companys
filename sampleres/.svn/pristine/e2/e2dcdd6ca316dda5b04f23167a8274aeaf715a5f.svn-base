<?php
if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}
include 'header.lite.html.php';
include 'chosen.html.php';
//include 'validation.html.php';
?>
<?php if(empty($_GET['onlybody']) or $_GET['onlybody'] != 'yes'):?>
<header id='header'>
  <div id='topbar'>
    <div class='pull-right' id='topnav'><?php commonModel::printTopBar();?></div>
    <?php if ($app->getModuleName() == 'sampleapp'): ?>
    <h5 id='companyname'>
    <?php echo "『Silergy』:: Sample Management System";?>
    </h5>
    <?php else: ?>
    <h5 id='companyname'>
      <?php printf($lang->welcome, $app->company->name);?>
    </h5>
    <?php endif ?>

  </div>
  <nav id='mainmenu'>
    <?php commonModel::printMainmenu($this->moduleName); //commonModel::printSearchBox();?>
  </nav>
  <nav id="modulemenu">
    <?php commonModel::printModuleMenu($this->moduleName);?>
  </nav>
</header>

<div id='wrap'>
<?php endif;?>
  <div class='outer'>
