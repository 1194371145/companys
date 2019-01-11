
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<div class='container mw-800px'>
  <div id='titlebar'>
    <div class='heading'>
      <span class='prefix' title='USER'><?php echo html::icon($lang->icons['user']);?> <strong><?php echo $user->id;?></strong></span>
      <strong><?php if(!common::printLink('user', 'view', "account=$user->account", $user->realname)) echo $user->realname;?> (<small><?php echo $user->account;?></small>)</strong>
      <small class='text-muted'> <?php echo $lang->user->edit;?> <?php echo html::icon($lang->icons['edit']);?></small>
    </div>
  </div>
  <form class='form-condensed' method='post' target='hiddenwin' id='dataform'>
    <table align='center' class='table table-form'>
      <caption class='text-left text-muted'><?php echo $lang->user->basicInfo;?></caption>
      <tr>
        <th class='w-90px'><?php echo $lang->user->realname;?></th>
        <td class='w-p40'><?php echo $user->realname;?></td><td>Manager:</td><td><?php echo html::radio('manager', array('Y'=>'Yes','N'=>'No'), $user->manager);?></td>
      </tr>
      <tr>
        <th>Superviser</th>
        <td colspan='3'><?php echo html::select('supersid', $superarr, $user->supersid, 'size=1  class="form-control chosen"');?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td colspan='3'><?php echo html::input('email',$user->email, 'class="form-control"');?></td>
      </tr>      
      <tr>
        <th><?php echo $lang->user->join;?></th>
        <td><?php echo html::input('join', $user->join, "class='form-control form-date'");?></td>
        <th><?php echo $lang->user->gender;?></th>
        <td><?php echo html::radio('gender', (array)$lang->user->genderList, $user->gender);?></td>
      </tr>
    </table>
    <table align='center' class='table table-form'>
      <caption class='text-left text-muted'><?php echo $lang->user->accountInfo;?></caption>
      <tr>
        <th class='w-90px'><?php echo $lang->user->account;?></th>
        <td class='w-p40'><?php echo html::input('account', $user->account, "class='form-control' autocomplete='off'");?></td>
        <th class='w-90px'></th>
        <td>

        </td>
      </tr>
      <tr>
        <th><?php echo $lang->user->password;?></th>
        <td>
          <input type='password' style="display:none"> <!-- Disable input password by browser automatically. -->
          <span class='input-group'>
            <?php echo html::password('password1', '', "class='form-control disabled-ie-placeholder' autocomplete='off' onmouseup='checkPassword(this.value)' onkeyup='checkPassword(this.value)' placeholder='" . (!empty($config->safe->mode) ? $lang->user->placeholder->passwordStrength[$config->safe->mode] : '') . "'");?>
            <span class='input-group-addon' id='passwordStrength'></span>
          </span>
        </td>
        <th><?php echo $lang->user->password2;?></th>
        <td><?php echo html::password('password2', '', "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th></th>
        <td></td>
      </tr>
    </table>
    
    <table align='center' class='table table-form'>
      <caption class='text-left text-muted'><?php echo $lang->user->verify;?></caption>
      <tr>
        <th class='w-120px'><?php echo $lang->user->verifyPassword;?></th>
        <td>
          <div class="required required-wrapper"></div>
          <?php echo html::password('verifyPassword', '', "class='form-control disabled-ie-placeholder' autocomplete='off' placeholder='{$lang->user->placeholder->verify}'");?>
        </td>
      </tr>
      <tr><td colspan='2' class='text-center'><?php echo html::submitButton() . html::backButton();?></td></tr>
    </table>
  </form>
</div>
<?php js::set('passwordStrengthList', $lang->user->passwordStrengthList)?>
<?php include '../../common/view/footer.html.php';?>
