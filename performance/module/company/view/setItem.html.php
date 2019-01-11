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
<div class='container mw-800px'>
  <div id='titlebar'>
     <div class='heading'><?php echo html::icon($lang->icons['company']);?>
         <?php
                    echo html::a($this->createLink('company', 'uitemRecord', ""), "答题记录" ,"","style='color:#00BB00'");?>
     </div>
    <div class='actions'>
      <?php common::printLink('company', 'createitem', 'type=selt', "+选择题", '', 'id="editCompany" class="btn btn-primary iframe" data-width="580"');?>
       <?php common::printLink('company', 'createitem', 'type=judge', "+判断题", '', 'id="editCompany" class="btn btn-primary iframe" data-width="580"');?>
    </div>
  </div>
  <table class='table table-borderless table-data'> 
     <tr><td style="color: blue" colspan='3' class='text-center'><b>选择题</b></td></tr>
    <tr style="float: left">
      <td class='w-100px'>题号</td>
      <th class='w-100px'>题目</th>
      <th align="left" class='w-400px'>正确答案</th>
      <th class='w-100px'>操作</th>
    </tr>  
<?php foreach($selectres as $key=>$v):?>
      <tr style="float: left">
      <td class='w-50px'><?php echo $v->quetionID; ?></td>
      <td class='w-400px'><?php echo mb_substr($v->title,0,30);?>..</td>
      <td style="text-align: right;" class='w-100px'><?php echo $v->option; ?></td>
      <td style="text-align: right;" class='w-200px'><?php common::printLink('company', 'itemexec', "id=$v->id&type=select", "查看", '', 'id="editCompany" class="btn btn-primary iframe" data-width="580"');?>
        <?php common::printLink('company', 'edititem', "id=$v->id&type=select", "编辑", '', 'id="editCompany" class="btn btn-primary iframe" data-width="580"');?>
      </td>
    </tr>
    <?php endforeach;?>
    <tr><td colspan='3' class='text-center'></td></tr>
    <tr><td style="color: blue" colspan='3' class='text-center'><b>填空题</b></td></tr>
    <tr style="float: left">
      <td class='w-100px'>题号</td>
      <th class='w-100px'>题目</th>
      <th align="left" class='w-400px'>正确答案</th>
      <th class='w-100px'>操作</th>
    </tr>  
    <?php foreach($panduanres as $key=>$vv):?>
      <tr style="float: left">
      <td class='w-50px'><?php echo $vv->quetionID; ?></td>
      <td class='w-400px'><?php echo mb_substr($vv->title,0,30);?>..</td>
      <td style="text-align: right;" class='w-100px'><?php 
      if($vv->option==5){
        echo '&radic;';
      }elseif ($vv->option==6) {
        echo 'X';
      }
       $vv->option; ?></td>
      <td style="text-align: right;" class='w-200px'><?php common::printLink('company', 'itemexec', "id=$vv->id&type=panduan", "查看", '', 'id="editCompany" class="btn btn-primary iframe" data-width="580"');?>
        <?php common::printLink('company', 'edititem', "id=$vv->id&type=panduan", "编辑", '', 'id="editCompany" class="btn btn-primary iframe" data-width="580"');?>
      </td>
    </tr>
    <?php endforeach;?>

  </table>
</div>
<script lanugage='javascript'>$('#dept<?php echo $deptID;?>').addClass('active');</script>
<?php include '../../common/view/footer.html.php';?>
