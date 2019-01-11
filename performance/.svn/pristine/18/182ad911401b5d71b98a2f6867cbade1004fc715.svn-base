<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datatable.fix.html.php';?>
<?php js::set('browseType', $browseType);?>
<div id='featurebar'>
  <ul class='nav'>


   <!-- <li id='bysearchTab'><a href='javascript:;'><i class='icon-search icon'></i> < ?php echo $lang->product->searchStory;?></a></li>-->
  </ul>
  <div class='actions'>

    <div class='btn-group'>
    <?php 
  
    if(commonModel::isTutorialMode() )
    {
        $wizardParams = helper::safe64Encode("productID=$productID&branch=$branch&moduleID=$moduleID");
        //echo html::a($this->createLink('tutorial', 'wizard', "module=story&method=create&params=$wizardParams"), "<i class='icon-plus'></i> {$lang->story->create}",'', "class='btn create-story-btn'");
    }
    else
    {
        common::printIcon('story', 'create', "productID=$productID&branch=$branch&moduleID=$moduleID", 'btn', 'button', 'plus', '', 'create-story-btn');
    }
    ?>
    </div>
  </div>
  <div id='querybox' class='<?php if($browseType =='bysearch') echo 'show';?>'></div>
</div>

<div class='main'>
  <form method='post' id='productStoryForm'>
    <?php
    $datatableId  = $this->moduleName . ucfirst($this->methodName);
    $useDatatable = (isset($this->config->datatable->$datatableId->mode) and $this->config->datatable->$datatableId->mode == 'datatable');
    //$file2Include = $useDatatable ? dirname(__FILE__) . '/datatabledata.html.php' : dirname(__FILE__) . '/browsedata.html.php';
	$file2Include =  dirname(__FILE__) . '/browsedata.html.php';
    $vars         = "productID=$productID&branch=$branch&browseType=$browseType&param=$param&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";
    include $file2Include;
    ?>
      <tfoot>
      <tr>
        <td colspan='<?php echo count($fieldvalue2)+5; ?>'>
          <div class='table-actions clearfix'>
            <?php if(count($stories)):?>
            <?php //echo html::selectButton();?>
            <?php
            //$canBatchEdit  = common::hasPriv('story', 'batchEdit');
            //$disabled   = $canBatchEdit ? '' : "disabled='disabled'";
            //$actionLink = $this->createLink('story', 'batchEdit', "productID=$productID&projectID=0&branch=$branch");
            ?>

            <?php endif; ?>
            <div class='text'></div>
          </div>
          <?php $pager->show();?>
        </td>
      </tr>
      </tfoot>
    </table>
  </form>
</div>
<script language='javascript'>
$('#module<?php echo $moduleID;?>').addClass('active');
$('#<?php echo ($browseType == 'bymodule' and $this->session->storyBrowseType == 'bysearch') ? 'all' : $this->session->storyBrowseType;?>Tab').addClass('active');
<?php if($browseType == 'bysearch'):?>
$shortcut = $('#QUERY<?php echo (int)$param;?>Tab');
if($shortcut.size() > 0)
{
    $shortcut.addClass('active');
    $('#bysearchTab').removeClass('active');
    $('#querybox').removeClass('show');
}
<?php endif;?>
<?php if(isset($this->config->product->homepage) and $this->config->product->homepage != 'browse'):?>
$('#modulemenu .nav li.right:last').after("<li class='right'><a style='font-size:12px' href='javascript:setHomepage(\"product\", \"browse\")'><i class='icon icon-cog'></i><?php echo $lang->homepage?></a></li>")
<?php endif;?>
</script>
<?php include '../../common/view/footer.html.php';?>
