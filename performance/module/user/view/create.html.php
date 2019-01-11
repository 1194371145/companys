
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php if(!empty($config->safe->mode)) $lang->user->placeholder->password1 = $lang->user->placeholder->passwordStrength[$config->safe->mode]?>
<?php js::set('holders', $lang->user->placeholder);?>
<?php js::set('roleGroup', $roleGroup);?>
<div class='container mw-700px'>
  <div id='titlebar'>
    <div class='heading'>
      <span class='prefix'><?php echo html::icon($lang->icons['user']);?></span>
      <strong><small class='text-muted'><?php echo html::icon($lang->icons['create']);?></small> <?php echo $lang->user->create;?></strong>
    </div>
  </div>
  <form class='form-condensed mw-700px' method='post' target='hiddenwin' id='dataform'>
    <table align='center' class='table table-form'> 
      <tr>
        <th class='w-120px'><?php echo $lang->user->dept;?></th>
        <td class='w-p50'><?php echo html::select('dept', $depts, $deptID, "class='form-control chosen'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->user->account;?></th>
        <td><?php echo html::input('account', '', "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->user->realname;?></th>
        <td><?php echo html::input('realname', '', "class='form-control' autocomplete='off'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->user->password;?></th>
        <td>
          <input type='password' style="display:none"> <!-- for disable autocomplete all browser -->
          <span class='input-group'>
            <?php echo html::password('password1', '', "class='form-control' autocomplete='off' onmouseup='checkPassword(this.value)' onkeyup='checkPassword(this.value)'");?>
            <span class='input-group-addon' id='passwordStrength'></span>
          </span>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->user->password2;?></th>
        <td><?php echo html::password('password2', '', "class='form-control' autocomplete='off'");?></td>
      </tr>



      <tr>
        <th><?php echo $lang->user->join;?></th>
        <td><?php echo html::input('join', '', "class='form-control form-date'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->user->gender;?></th>
        <td><?php echo html::radio('gender', (array)$lang->user->genderList, 'm');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->user->verifyPassword;?></th>
        <td>
          <div class="required required-wrapper"></div>
          <?php echo html::password('verifyPassword', '', "class='form-control disabled-ie-placeholder' autocomplete='off' placeholder='{$lang->user->placeholder->verify}'");?>
        </td>
      </tr>

      <tr><th></th><td><?php echo html::submitButton() . html::backButton();?></td></tr>
    </table>
  </form>
</div>
<?php js::set('passwordStrengthList', $lang->user->passwordStrengthList)?>
<?php include '../../common/view/footer.html.php';?>
