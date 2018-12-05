<?php
 die();
?>
20181204 14:34:06: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET  WHERE `device` IN () 

20181204 14:35:27: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET  WHERE `device` IN () 

20181204 14:35:50: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET  WHERE `device` IN () 

20181204 14:36:20: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET `proline` = CASE `device` 
WHEN 'SY6712ABC' THEN 'motor driver' 
WHEN 'SY6702DFC' THEN 'motor driver' 
WHEN 'SY6280AAC' THEN 'power/protection switch' 
WHEN 'SY6280AAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6811PDC' THEN 'power/protection switch' 
WHEN 'SY6813PEC' THEN 'power/protection switch' 
WHEN 'SY6283DRC' THEN 'power/protection switch' 
WHEN 'SY6283ADRC' THEN 'power/protection switch' 
WHEN 'SY6288AAAC' THEN 'power/protection switch' 
WHEN 'SY6882BDFC' THEN 'power/protection switch' 
WHEN 'SY6340BAAC' THEN 'hv dcdc' 
WHEN 'SY6288C20AAC' THEN 'power/protection switch' 
END,`ae` = CASE `device` 
WHEN 'SY6712ABC' THEN 'Chane' 
WHEN 'SY6702DFC' THEN 'Eric' 
WHEN 'SY6280AAC' THEN 'Robinson' 
WHEN 'SY6280AAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6811PDC' THEN 'Robinson' 
WHEN 'SY6813PEC' THEN 'Robinson' 
WHEN 'SY6283DRC' THEN 'Robinson' 
WHEN 'SY6283ADRC' THEN 'Robinson' 
WHEN 'SY6288AAAC' THEN 'Robinson' 
WHEN 'SY6882BDFC' THEN 'Robinson' 
WHEN 'SY6340BAAC' THEN 'Jack' 
WHEN 'SY6288C20AAC' THEN 'Robinson' 
END,`device` = CASE `device` 
WHEN 'SY6712ABC' THEN 'SY6712ABC' 
WHEN 'SY6702DFC' THEN 'SY6702DFC' 
WHEN 'SY6280AAC' THEN 'SY6280AAC' 
WHEN 'SY6280AAAC' THEN 'SY6280AAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6811PDC' THEN 'SY6811PDC' 
WHEN 'SY6813PEC' THEN 'SY6813PEC' 
WHEN 'SY6283DRC' THEN 'SY6283DRC' 
WHEN 'SY6283ADRC' THEN 'SY6283ADRC' 
WHEN 'SY6288AAAC' THEN 'SY6288AAAC' 
WHEN 'SY6882BDFC' THEN 'SY6882BDFC' 
WHEN 'SY6340BAAC' THEN 'SY6340BAAC' 
WHEN 'SY6288C20AAC' THEN 'SY6288C20AAC' 
END WHERE `device` IN ('SY6712ABC','SY6702DFC','SY6280AAC','SY6280AAAC','SY6288DAAC','SY6288DAAC','SY6811PDC','SY6813PEC','SY6283DRC','SY6283ADRC','SY6288AAAC','SY6882BDFC','SY6340BAAC','SY6288C20AAC') 
  UPDATE `zt_mp` SET `proline` = CASE `device` 
WHEN 'SY6712ABC' THEN 'motor driver' 
WHEN 'SY6702DFC' THEN 'motor driver' 
WHEN 'SY6280AAC' THEN 'power/protection switch' 
WHEN 'SY6280AAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6811PDC' THEN 'power/protection switch' 
WHEN 'SY6813PEC' THEN 'power/protection switch' 
WHEN 'SY6283DRC' THEN 'power/protection switch' 
WHEN 'SY6283ADRC' THEN 'power/protection switch' 
WHEN 'SY6288AAAC' THEN 'power/protection switch' 
WHEN 'SY6882BDFC' THEN 'power/protection switch' 
WHEN 'SY6340BAAC' THEN 'hv dcdc' 
WHEN 'SY6288C20AAC' THEN 'power/protection switch' 
END,`ae` = CASE `device` 
WHEN 'SY6712ABC' THEN 'Chane' 
WHEN 'SY6702DFC' THEN 'Eric' 
WHEN 'SY6280AAC' THEN 'Robinson' 
WHEN 'SY6280AAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6811PDC' THEN 'Robinson' 
WHEN 'SY6813PEC' THEN 'Robinson' 
WHEN 'SY6283DRC' THEN 'Robinson' 
WHEN 'SY6283ADRC' THEN 'Robinson' 
WHEN 'SY6288AAAC' THEN 'Robinson' 
WHEN 'SY6882BDFC' THEN 'Robinson' 
WHEN 'SY6340BAAC' THEN 'Jack' 
WHEN 'SY6288C20AAC' THEN 'Robinson' 
END,`device` = CASE `device` 
WHEN 'SY6712ABC' THEN 'SY6712ABC' 
WHEN 'SY6702DFC' THEN 'SY6702DFC' 
WHEN 'SY6280AAC' THEN 'SY6280AAC' 
WHEN 'SY6280AAAC' THEN 'SY6280AAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6811PDC' THEN 'SY6811PDC' 
WHEN 'SY6813PEC' THEN 'SY6813PEC' 
WHEN 'SY6283DRC' THEN 'SY6283DRC' 
WHEN 'SY6283ADRC' THEN 'SY6283ADRC' 
WHEN 'SY6288AAAC' THEN 'SY6288AAAC' 
WHEN 'SY6882BDFC' THEN 'SY6882BDFC' 
WHEN 'SY6340BAAC' THEN 'SY6340BAAC' 
WHEN 'SY6288C20AAC' THEN 'SY6288C20AAC' 
END WHERE `device` IN ('SY6712ABC','SY6702DFC','SY6280AAC','SY6280AAAC','SY6288DAAC','SY6288DAAC','SY6811PDC','SY6813PEC','SY6283DRC','SY6283ADRC','SY6288AAAC','SY6882BDFC','SY6340BAAC','SY6288C20AAC') 

20181204 14:36:52: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET `proline` = CASE `device` 
WHEN 'SY6712ABC' THEN 'motor driver' 
WHEN 'SY6702DFC' THEN 'motor driver' 
WHEN 'SY6280AAC' THEN 'power/protection switch' 
WHEN 'SY6280AAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6811PDC' THEN 'power/protection switch' 
WHEN 'SY6813PEC' THEN 'power/protection switch' 
WHEN 'SY6283DRC' THEN 'power/protection switch' 
WHEN 'SY6283ADRC' THEN 'power/protection switch' 
WHEN 'SY6288AAAC' THEN 'power/protection switch' 
WHEN 'SY6882BDFC' THEN 'power/protection switch' 
WHEN 'SY6340BAAC' THEN 'hv dcdc' 
WHEN 'SY6288C20AAC' THEN 'power/protection switch' 
END,`ae` = CASE `device` 
WHEN 'SY6712ABC' THEN 'Chane' 
WHEN 'SY6702DFC' THEN 'Eric' 
WHEN 'SY6280AAC' THEN 'Robinson' 
WHEN 'SY6280AAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6811PDC' THEN 'Robinson' 
WHEN 'SY6813PEC' THEN 'Robinson' 
WHEN 'SY6283DRC' THEN 'Robinson' 
WHEN 'SY6283ADRC' THEN 'Robinson' 
WHEN 'SY6288AAAC' THEN 'Robinson' 
WHEN 'SY6882BDFC' THEN 'Robinson' 
WHEN 'SY6340BAAC' THEN 'Jack' 
WHEN 'SY6288C20AAC' THEN 'Robinson' 
END,`device` = CASE `device` 
WHEN 'SY6712ABC' THEN 'SY6712ABC' 
WHEN 'SY6702DFC' THEN 'SY6702DFC' 
WHEN 'SY6280AAC' THEN 'SY6280AAC' 
WHEN 'SY6280AAAC' THEN 'SY6280AAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6811PDC' THEN 'SY6811PDC' 
WHEN 'SY6813PEC' THEN 'SY6813PEC' 
WHEN 'SY6283DRC' THEN 'SY6283DRC' 
WHEN 'SY6283ADRC' THEN 'SY6283ADRC' 
WHEN 'SY6288AAAC' THEN 'SY6288AAAC' 
WHEN 'SY6882BDFC' THEN 'SY6882BDFC' 
WHEN 'SY6340BAAC' THEN 'SY6340BAAC' 
WHEN 'SY6288C20AAC' THEN 'SY6288C20AAC' 
END WHERE `device` IN ('SY6712ABC','SY6702DFC','SY6280AAC','SY6280AAAC','SY6288DAAC','SY6288DAAC','SY6811PDC','SY6813PEC','SY6283DRC','SY6283ADRC','SY6288AAAC','SY6882BDFC','SY6340BAAC','SY6288C20AAC') 

20181204 14:38:29: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET `proline` = CASE `device` 
WHEN 'SY6702DFC' THEN 'motor driver' 
WHEN 'SY6280AAC' THEN 'power/protection switch' 
WHEN 'SY6280AAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6811PDC' THEN 'power/protection switch' 
WHEN 'SY6813PEC' THEN 'power/protection switch' 
WHEN 'SY6283DRC' THEN 'power/protection switch' 
WHEN 'SY6283ADRC' THEN 'power/protection switch' 
WHEN 'SY6288AAAC' THEN 'power/protection switch' 
WHEN 'SY6882BDFC' THEN 'power/protection switch' 
WHEN 'SY6340BAAC' THEN 'hv dcdc' 
WHEN 'SY6288C20AAC' THEN 'power/protection switch' 
END,`ae` = CASE `device` 
WHEN 'SY6702DFC' THEN 'Eric' 
WHEN 'SY6280AAC' THEN 'Robinson' 
WHEN 'SY6280AAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6811PDC' THEN 'Robinson' 
WHEN 'SY6813PEC' THEN 'Robinson' 
WHEN 'SY6283DRC' THEN 'Robinson' 
WHEN 'SY6283ADRC' THEN 'Robinson' 
WHEN 'SY6288AAAC' THEN 'Robinson' 
WHEN 'SY6882BDFC' THEN 'Robinson' 
WHEN 'SY6340BAAC' THEN 'Jack' 
WHEN 'SY6288C20AAC' THEN 'Robinson' 
END,`device` = CASE `device` 
WHEN 'SY6702DFC' THEN 'SY6702DFC' 
WHEN 'SY6280AAC' THEN 'SY6280AAC' 
WHEN 'SY6280AAAC' THEN 'SY6280AAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6811PDC' THEN 'SY6811PDC' 
WHEN 'SY6813PEC' THEN 'SY6813PEC' 
WHEN 'SY6283DRC' THEN 'SY6283DRC' 
WHEN 'SY6283ADRC' THEN 'SY6283ADRC' 
WHEN 'SY6288AAAC' THEN 'SY6288AAAC' 
WHEN 'SY6882BDFC' THEN 'SY6882BDFC' 
WHEN 'SY6340BAAC' THEN 'SY6340BAAC' 
WHEN 'SY6288C20AAC' THEN 'SY6288C20AAC' 
END WHERE `device` IN ('SY6702DFC','SY6280AAC','SY6280AAAC','SY6288DAAC','SY6288DAAC','SY6811PDC','SY6813PEC','SY6283DRC','SY6283ADRC','SY6288AAAC','SY6882BDFC','SY6340BAAC','SY6288C20AAC') 

20181204 14:39:48: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET `proline` = CASE `device` 
WHEN 'SY6702DFC' THEN 'motor driver' 
WHEN 'SY6280AAC' THEN 'power/protection switch' 
WHEN 'SY6280AAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6811PDC' THEN 'power/protection switch' 
WHEN 'SY6813PEC' THEN 'power/protection switch' 
WHEN 'SY6283DRC' THEN 'power/protection switch' 
WHEN 'SY6283ADRC' THEN 'power/protection switch' 
WHEN 'SY6288AAAC' THEN 'power/protection switch' 
WHEN 'SY6882BDFC' THEN 'power/protection switch' 
WHEN 'SY6340BAAC' THEN 'hv dcdc' 
WHEN 'SY6288C20AAC' THEN 'power/protection switch' 
END,`ae` = CASE `device` 
WHEN 'SY6702DFC' THEN 'Eric' 
WHEN 'SY6280AAC' THEN 'Robinson' 
WHEN 'SY6280AAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6811PDC' THEN 'Robinson' 
WHEN 'SY6813PEC' THEN 'Robinson' 
WHEN 'SY6283DRC' THEN 'Robinson' 
WHEN 'SY6283ADRC' THEN 'Robinson' 
WHEN 'SY6288AAAC' THEN 'Robinson' 
WHEN 'SY6882BDFC' THEN 'Robinson' 
WHEN 'SY6340BAAC' THEN 'Jack' 
WHEN 'SY6288C20AAC' THEN 'Robinson' 
END,`device` = CASE `device` 
WHEN 'SY6702DFC' THEN 'SY6702DFC' 
WHEN 'SY6280AAC' THEN 'SY6280AAC' 
WHEN 'SY6280AAAC' THEN 'SY6280AAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6811PDC' THEN 'SY6811PDC' 
WHEN 'SY6813PEC' THEN 'SY6813PEC' 
WHEN 'SY6283DRC' THEN 'SY6283DRC' 
WHEN 'SY6283ADRC' THEN 'SY6283ADRC' 
WHEN 'SY6288AAAC' THEN 'SY6288AAAC' 
WHEN 'SY6882BDFC' THEN 'SY6882BDFC' 
WHEN 'SY6340BAAC' THEN 'SY6340BAAC' 
WHEN 'SY6288C20AAC' THEN 'SY6288C20AAC' 
END WHERE `device` IN ('SY6702DFC','SY6280AAC','SY6280AAAC','SY6288DAAC','SY6288DAAC','SY6811PDC','SY6813PEC','SY6283DRC','SY6283ADRC','SY6288AAAC','SY6882BDFC','SY6340BAAC','SY6288C20AAC') 

20181204 14:43:54: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET `proline` = CASE `device` 
WHEN 'SY6702DFC' THEN 'motor driver' 
WHEN 'SY6280AAC' THEN 'power/protection switch' 
WHEN 'SY6280AAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6288DAAC' THEN 'power/protection switch' 
WHEN 'SY6811PDC' THEN 'power/protection switch' 
WHEN 'SY6813PEC' THEN 'power/protection switch' 
WHEN 'SY6283DRC' THEN 'power/protection switch' 
WHEN 'SY6283ADRC' THEN 'power/protection switch' 
WHEN 'SY6288AAAC' THEN 'power/protection switch' 
WHEN 'SY6882BDFC' THEN 'power/protection switch' 
WHEN 'SY6340BAAC' THEN 'hv dcdc' 
WHEN 'SY6288C20AAC' THEN 'power/protection switch' 
END,`ae` = CASE `device` 
WHEN 'SY6702DFC' THEN 'Eric' 
WHEN 'SY6280AAC' THEN 'Robinson' 
WHEN 'SY6280AAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6288DAAC' THEN 'Robinson' 
WHEN 'SY6811PDC' THEN 'Robinson' 
WHEN 'SY6813PEC' THEN 'Robinson' 
WHEN 'SY6283DRC' THEN 'Robinson' 
WHEN 'SY6283ADRC' THEN 'Robinson' 
WHEN 'SY6288AAAC' THEN 'Robinson' 
WHEN 'SY6882BDFC' THEN 'Robinson' 
WHEN 'SY6340BAAC' THEN 'Jack' 
WHEN 'SY6288C20AAC' THEN 'Robinson' 
END,`device` = CASE `device` 
WHEN 'SY6702DFC' THEN 'SY6702DFC' 
WHEN 'SY6280AAC' THEN 'SY6280AAC' 
WHEN 'SY6280AAAC' THEN 'SY6280AAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6288DAAC' THEN 'SY6288DAAC' 
WHEN 'SY6811PDC' THEN 'SY6811PDC' 
WHEN 'SY6813PEC' THEN 'SY6813PEC' 
WHEN 'SY6283DRC' THEN 'SY6283DRC' 
WHEN 'SY6283ADRC' THEN 'SY6283ADRC' 
WHEN 'SY6288AAAC' THEN 'SY6288AAAC' 
WHEN 'SY6882BDFC' THEN 'SY6882BDFC' 
WHEN 'SY6340BAAC' THEN 'SY6340BAAC' 
WHEN 'SY6288C20AAC' THEN 'SY6288C20AAC' 
END WHERE `device` IN ('SY6702DFC','SY6280AAC','SY6280AAAC','SY6288DAAC','SY6288DAAC','SY6811PDC','SY6813PEC','SY6283DRC','SY6283ADRC','SY6288AAAC','SY6882BDFC','SY6340BAAC','SY6288C20AAC') 

20181204 14:44:16: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET  WHERE `device` IN () 

20181204 14:45:21: /company/sample/www/index.php?m=admin&f=sqjmp
  SELECT * FROM `zt_config` WHERE owner IN ('system','admin') ORDER BY `id` 
  SELECT * FROM `zt_lang` ORDER BY `lang`,`id` 
  SELECT id,device,proline,ae FROM zt_mp WHERE proline  = '' OR ae  = ''
  UPDATE `zt_mp` SET  WHERE `device` IN () 

