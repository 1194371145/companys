<?php
 die();
?>
20190110 17:36:55: /company/performance/www/index.php?m=prorelease&f=index
  SELECT * FROM `zt_company` ORDER BY `id`  LIMIT 1 
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:37:03: /company/performance/www/index.php
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:37:04: /company/performance/www/index.php?m=user&f=login&referer=L2NvbXBhbnkvcGVyZm9ybWFuY2Uvd3d3L2luZGV4LnBocA==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:37:08: /company/performance/www/index.php?m=user&f=login&referer=L2NvbXBhbnkvcGVyZm9ybWFuY2Uvd3d3L2luZGV4LnBocA==
  SELECT * FROM `zt_config` WHERE owner IN ('system','') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT locked FROM `zt_user` WHERE account  = 'admin'
  SELECT * FROM `zt_user` WHERE ( account  = 'admin' OR realname  = 'admin') AND  deleted  = '0'
  UPDATE `zt_user` SET  visits = visits + 1, `ip` = '127.0.0.1', `last` = '1547113026' WHERE account  = 'admin'
  UPDATE `zt_user` SET  `fails` = '0', `locked` = '0000-00-00 00:00:00' WHERE account  = 'admin'
  SELECT t1.acl FROM `zt_group` AS t1  LEFT JOIN `zt_usergroup` AS t2  ON t1.id=t2.group  WHERE t2.account  = 'admin'
  SELECT module, method FROM `zt_usergroup` AS t1  LEFT JOIN `zt_grouppriv` AS t2  ON t1.group = t2.group  WHERE t1.account  = 'admin'
  SELECT `group` FROM `zt_usergroup` WHERE `account` = 'admin' 
  INSERT INTO `zt_action` SET `objectType` = 'user',`objectID` = '1',`actor` = 'admin',`action` = 'login',`date` = '2019-01-10 17:37:08',`comment` = '',`extra` = '',`product` = ',0,',`project` = '0'

20190110 17:37:09: /company/performance/www/index.php
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:37:10: /company/performance/www/index.php?m=my&f=index
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:37:11: /company/performance/www/index.php?m=my&f=dynamic
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2019-01-10' AND  date  < '2019-01-11' AND  actor  = 'admin' AND  (1)  ORDER BY `date` desc,`id` desc 
  SELECT COUNT(*) AS recTotal FROM `zt_action` WHERE 1  AND  date  > '2019-01-10' AND  date  < '2019-01-11' AND  actor  = 'admin' AND  (1)  
  SELECT * FROM `zt_action` WHERE 1  AND  date  > '2019-01-10' AND  date  < '2019-01-11' AND  actor  = 'admin' AND  (1)  ORDER BY `date` desc,`id` desc 
  SELECT commiter, account, realname FROM `zt_user` WHERE commiter  != ''
  SELECT id, account AS name FROM `zt_user` WHERE id IN ('1')

20190110 17:37:15: /company/performance/www/index.php?m=item&f=index
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:37:16: /company/performance/www/index.php?m=item&f=browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,mark FROM zt_itemrecord WHERE user_id  = '1'
  SELECT id,title,`option`,answers,score FROM zt_item WHERE type  = '1' ORDER BY `quetionID` 
  SELECT id,title,`option`,score FROM zt_item WHERE type  = '2' ORDER BY `quetionID` 

20190110 17:47:18: /company/performance/www/index.php?m=misc&f=ping&t=html
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:54:01: /company/performance/www/index.php?m=company&f=index
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:54:02: /company/performance/www/index.php?m=company&f=browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20190110 17:54:03: /company/performance/www/index.php?m=company&f=index
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 

20190110 17:54:04: /company/performance/www/index.php?m=company&f=browse
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM `zt_dept` WHERE `id` = '0' 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT COUNT(*) AS recTotal FROM `zt_user` WHERE deleted  = '0' 
  SELECT * FROM `zt_user` WHERE deleted  = '0' ORDER BY `id` 
  SELECT id, title FROM `zt_userquery` WHERE account  = 'admin' AND  module  = 'user' ORDER BY `id` asc 
  SELECT * FROM `zt_dept` ORDER BY `grade` desc,`order` 

20190110 17:54:05: /company/performance/www/index.php?m=company&f=setItem
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item WHERE type  = '1' ORDER BY `quetionID` 
  SELECT * FROM zt_item WHERE type  = '2' ORDER BY `quetionID` 
  SELECT * FROM `zt_company` WHERE `id` = '1' 

20190110 17:56:52: /company/performance/www/index.php?m=company&f=createitem&type=selt
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item ORDER BY `quetionID` desc 

20190110 17:56:58: /company/performance/www/index.php?m=company&f=createitem&type=selt
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item ORDER BY `quetionID` desc 

20190110 17:57:00: /company/performance/www/index.php?m=company&f=createitem&type=judge
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item ORDER BY `quetionID` desc 

20190110 17:57:02: /company/performance/www/index.php?m=company&f=createitem&type=judge
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item ORDER BY `quetionID` desc 

20190110 17:57:05: /company/performance/www/index.php?m=company&f=createitem&type=selt
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item ORDER BY `quetionID` desc 

20190110 18:02:06: /company/performance/www/index.php?m=company&f=createitem&type=selt
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT * FROM zt_usergroup WHERE account  = 'admin' AND  `group`  = '19'
  SELECT * FROM zt_item ORDER BY `quetionID` desc 

