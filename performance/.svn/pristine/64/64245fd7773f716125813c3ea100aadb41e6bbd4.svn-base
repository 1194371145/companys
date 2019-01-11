
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
js::set('deptID', $deptID);
js::set('confirmDelete', $lang->user->confirmDelete);
?>
<div id='titlebar'>
  <div class='heading'><?php echo html::icon($lang->icons['company']);?>  <?php
                    echo html::a($this->createLink('company', 'setItem', ""), "内控设置题目" ,"","style='color:#00BB00'");?></div>
</div>
<div id='querybox' class='show'><?php echo $searchForm?></div>
   <table class='table table-condensed  table-striped tablesorter table-datatable'>
        <tr>
          <th>ID</th>
            <th><?php echo $lang->company->name;?></th>
            <th>成绩</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        <?php foreach($list as $v){?>
            <tr>
              <td><?php echo $v->id;?></td>
                <td><?php echo $v->account;?></td>
                <td><?php echo $v->mark;?></td>
                <td><?php echo date("Y-m-d ",$v->create_at);?></td>
                <td>
                    <?php
                    echo html::a($this->createLink('company', 'showsetitem', "id=$v->id"), "查看" ,"","style='color:#00BB00'");
                    // echo html::a($this->createLink('calibration', 'deleteress', "id=$v->id"), "删除" ,"","style='color:#00008B'");
                    ?>
                </td>
            </tr>
        <?php }?>
    </table>
    <div class='text-right'><?php $pager->show();?></div>
<script lanugage='javascript'>$('#dept<?php echo $deptID;?>').addClass('active');</script>
<?php include '../../common/view/footer.html.php';?>
