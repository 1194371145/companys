<?php
 die();
?>
20190111 08:56:16: /company/performance/www/index.php?m=misc&f=ping&t=html
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190111 10:02:50: /company/performance/www/index.php?m=company&f=uitemRecord
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_user` WHERE ( account  = 'admin' OR realname  = 'admin') AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1547172169' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2019-01-11 10:02:50',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_itemrecord ORDER BY `id` desc 
  SELECT COUNT(*) AS recTotal FROM zt_itemrecord 
  SELECT * FROM zt_itemrecord ORDER BY `id` desc 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'device' ORDER BY `id` asc 
  SELECT * FROM `zt_company` WHERE `id` = '1' 

20190111 10:07:07: /company/performance/www/index.php?m=company&f=createitem&type=selt
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item ORDER BY `quetionID` desc 

20190111 10:12:57: /company/performance/www/index.php?m=misc&f=ping&t=html
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

