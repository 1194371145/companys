<?php
/**
 * The browse view file of product dept of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id: browse.html.php 5096 2013-07-11 07:02:43Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
?>
<?php 
include '../../common/view/header.html.php';
?>
<div class='container mw-300px'>
  <div id='titlebar'>
     <div class='heading'><?php echo html::icon($lang->icons['company']);?>
         <?php
                    echo html::a($this->createLink('company', 'uitemRecord', ""), "答题记录" ,"","style='color:#00BB00'");?>:<?php echo $itemfor->account; ?>
     </div>
    <div class='actions'>
      
    </div>
  </div>
  <table class='table table-borderless table-data'> 
    <tr style="float: left">
      <td class='w-100px'>题号</td>
      <th class='w-100px'>选项(红色错)</th>
    </tr>  
      <?php foreach($record as $key=>$v):?>
      <tr style="float: left">
      <td class='w-100px'><?php echo $key+1;?></td>
        <?php if($v['message']=="wrong"):?>  
      <th style="color: red" class='w-100px'>
          <?php else: ?> <th style="color: blue" class='w-100px'>  <?php endif; ?>
        <?php echo $v['array'];?></th>
    </tr>
    <?php endforeach;?>
    <tr><td colspan='3' class='text-center'></td></tr>
  </table>
</div>
<script lanugage='javascript'>$('#dept<?php echo $deptID;?>').addClass('active');</script>
<?php include '../../common/view/footer.html.php';?>
