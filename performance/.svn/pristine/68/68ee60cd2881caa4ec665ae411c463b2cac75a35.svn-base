<?php 
include '../../common/view/header.html.php';
include '../../common/view/treeview.html.php';
include '../../common/view/tablesorter.html.php';
?>
<table class='cont-lt1'>
  <tr valign='top'>
    <td class='side'>
      <div class='box-title'><?php echo "模块维护";?></div>
      <div class='box-content'>
        <?php echo $subtree['classname'];?>
        <div class='a-right'>
         
        </div>
      </div>
    </td>
    <td class='divider'></td>
    <td>
      <table class='table-1 tablesorter'>
        <thead>
        <tr class='colhead'>
          <th class='w-id'><?php echo $lang->idAB;?></th>
          <th><?php echo $lang->user->realname;?></th>
          <th><?php echo $lang->user->account;?></th>
          <?php // echo $lang->user->nickname;?>
          <th><?php echo $lang->user->email;?></th>
          <th><?php echo $lang->user->gender;?></th>
          <th><?php echo $lang->user->phone;?></th>
          <th><?php echo $lang->user->join;?></th>
          <th><?php echo $lang->user->last;?></th>
          <th><?php echo $lang->user->visits;?></th>
          <th><?php echo $lang->actions;?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $user):?>
        <tr class='a-center'>
          <td><?php echo $user->id;?></td>
          <td><?php if(!common::printLink('user', 'view', "account=$user->account", $user->realname)) echo $user->realname;?></td>
          <td><?php echo $user->account;?></td>
          <?php // echo $user->nickname;?>
          <td><?php echo html::mailto($user->email);?></td>
          <td><?php echo $user->gender;?></td>
          <td><?php echo $user->phone;?></td>
          <td><?php echo $user->join;?></td>
          <td><?php echo date('Y-m-d', $user->last);?></td>
          <td><?php echo $user->visits;?></td>
          <td>
            <?php 
            common::printLink('user', 'edit',   "userID=$user->id&from=company", $lang->edit);
            common::printLink('user', 'delete', "userID=$user->id", $lang->delete, "hiddenwin");
            ?>
          </td>
        </tr>
        <?php endforeach;?>
        </tbody>
      </table>
    </td>
  </tr>
</table>
<script lanugage='Javascript'>$('#dept<?php echo $deptID;?>').addClass('active');</script>
<?php include '../../common/view/footer.html.php';?>
