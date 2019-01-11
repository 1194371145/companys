
<?php include '../../common/view/header.html.php';?>
<div class='container mw-600px'>
  <div id='titlebar'>
    <div class='heading'><?php echo html::icon($lang->icons['user']);?> <?php echo $lang->my->profile;?></div>
    <div class='actions'>
      <?php echo html::a($this->createLink('my', 'editprofile'), $lang->user->editProfile, '', "class='btn btn-primary'");?>
    </div>
  </div>
  <table class='table table-borderless table-data'>
    <tr>
      <th class='rowhead w-100px'><?php echo $lang->user->dept;?></th>
      <td>
      <?php
      if(empty($deptPath))
      {
          echo "/";
      }
      else
      {
          foreach($deptPath as $key => $dept)
          {
              if($dept->name) echo $dept->name;
              if(isset($deptPath[$key + 1])) echo $lang->arrow;
          }
      }
      ?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->user->account;?></th>
      <td><?php echo $user->account;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->realname;?></th>
      <td><?php echo $user->realname;?></td>
    </tr>

    <tr>
      <th><?php echo $lang->user->email;?></th>
      <td><?php echo $user->email;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->join;?></th>
      <td><?php echo $user->join;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->visits;?></th>
      <td><?php echo $user->visits;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->ip;?></th>
      <td><?php echo $user->ip;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->last;?></th>
      <td><?php echo $user->last;?></td>
    </tr>

   
  </table>
</div>
<?php include '../../common/view/footer.html.php';?>
