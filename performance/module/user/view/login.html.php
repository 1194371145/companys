<?php
/**
 * The html template file of login method of user module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: login.html.php 5084 2013-07-10 01:31:38Z wyd621@gmail.com $
 */
include '../../common/view/header.lite.html.php';
if(empty($config->notMd5Pwd))js::import($jsRoot . 'md5.js');
?>
<div id='container'>
  <div id='login-panel'>
    <div class='panel-head'>
      <h4 style="font-size:15px;"><?php printf($lang->welcome, $app->company->name);?></h4>

    </div>
    <div class="panel-content" id="login-form">
      <form method='post' target='hiddenwin' class='form-condensed'>
        <table class='table table-form'>
          <tr>
            <th><?php echo $lang->user->account;?></th>
            <td><input class='form-control' type='text' name='account' style="color:#CCC;" value="Enter your name or staff code..." id='account' onfocus="loginfocus()" onblur="loginblus()" /></td>
          </tr>
          <tr>
            <th><?php echo $lang->user->password;?></th>
            <td><input class='form-control' type='password' name='password' /></td>
          </tr>
          <tr>
            <th></th>
            <td id="keeplogin"><?php echo html::checkBox('keepLogin', $lang->user->keepLogin, $keepLogin);?></td>
          </tr>
          <tr>
            <th></th>
            <td>
            <?php 
            echo html::submitButton($lang->login);
            if($app->company->guest) echo '&nbsp; ' . html::linkButton($lang->user->asGuest, $this->createLink($config->default->module));
            echo '&nbsp; ' . html::hidden('referer', $referer);
            
            ?>
            </td>
          </tr>
        </table>
      </form>
    </div>

    <?php if(isset($demoUsers)):?>  
    <div id='demoUsers' class="panel-foot">
      <span><?php echo $lang->user->loginWithDemoUser; ?></span>
      <?php
      $sign = $config->requestType == 'GET' ? '&' : '?';
      if(isset($demoUsers['productManager'])) echo html::a(inlink('login') . $sign . "account=productManager&password=123456", $demoUsers['productManager'], 'hiddenwin');
      if(isset($demoUsers['projectManager'])) echo html::a(inlink('login') . $sign . "account=projectManager&password=123456", $demoUsers['projectManager'], 'hiddenwin');
      if(isset($demoUsers['testManager']))    echo html::a(inlink('login') . $sign . "account=testManager&password=123456",    $demoUsers['testManager'],    'hiddenwin');
      if(isset($demoUsers['dev1']))           echo html::a(inlink('login') . $sign . "account=dev1&password=123456",           $demoUsers['dev1'],           'hiddenwin');
      if(isset($demoUsers['tester1']))        echo html::a(inlink('login') . $sign . "account=tester1&password=123456",        $demoUsers['tester1'],        'hiddenwin');
      ?>  
    </div>  
    <?php endif;?>
  </div>

</div>
<script language='Javascript'>


		                     function loginblus()
							 {
											      
											      var account = $("#account").val();
												  
											      if(account.length < 1)
												  {
													  $("#account").val("Enter your name or staff code...");
												  }
											      
							}
		                    function loginfocus()
							{
								
											      var account = $("#account").val();
												  $("#account").css('color','#141414');
											      if(account == "Enter your name or staff code...")
												  {
													  $("#account").val("");
												  }
											  
							}
		   
</script>
<?php include '../../common/view/footer.lite.html.php';?>
