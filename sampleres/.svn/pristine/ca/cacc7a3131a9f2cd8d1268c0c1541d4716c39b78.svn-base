<?php
// $config->sampleapp->lang = 'en';
$config->sampleapp->defaultWorkhours = 7;
$config->sampleapp->orderBy          = 'id,`order`, status';

global $lang, $app;
$app->loadLang('task');
$config->sampleapp->create->requiredFields = 'rfqcode,date,partnumber,end_customer,end_custmp,distributor,price_cus,price_dis,usage,commission,fae,rfqtype';
$config->sampleapp->create->requiredFieldsnocomm = 'rfqcode,date,partnumber,end_customer,end_custmp,distributor,price_cus,price_dis,usage,fae';
$config->sampleapp->edit->requiredFields   = 'rfqcode,date,partnumber,end_customer,distributor,price_cus,price_dis,usage,commission,fae';
$config->sampleapp->edit->requiredFieldsnocomm   = 'rfqcode,date,partnumber,end_customer,distributor,price_cus,price_dis,usage,fae';
$config->sampleapp->createnote->requiredFields = 'updatedate,note';
$config->sampleapp->createout->requiredFields = 'rtype,person,partn,revtype,distributor,qty,tocompany,toperson,tomobile,toaddress';

$config->sampleapp->editor->create = array('id' => 'reason', 'tools' => 'simpleTools');
$config->sampleapp->editor->edit   = array('id' => 'reason', 'tools' => 'simpleTools');
//$config->sampleapp->editor->createout   = array('id' => 'remark', 'tools' => 'simpleTools');

$config->sampleapp=new stdClass();
$config->sampleapp->search['module']                       = 'sampleapp';
$config->sampleapp->search['fields']['id']                 = 'ID';
$config->sampleapp->search['fields']['status']             = 'Status';
$config->sampleapp->search['fields']['rfqcode']            = 'RFQ#';
$config->sampleapp->search['fields']['partnumber']         = 'Part Number';
$config->sampleapp->search['fields']['end_customer']       = 'End Customer Code';
$config->sampleapp->search['fields']['end_cus_code']       = 'end customer name';
$config->sampleapp->search['fields']['distributor']        = 'Distributor Code';
$config->sampleapp->search['fields']['discode']            = 'distributor name';
$config->sampleapp->search['fields']['price_dis']          = 'Distributor price';
$config->sampleapp->search['fields']['price_cus']          = 'Customer price';
$config->sampleapp->search['fields']['commission']         = 'commission';
$config->sampleapp->search['fields']['openby']             = 'Request By';
$config->sampleapp->search['fields']['date']               = 'Begin Date';
$config->sampleapp->search['fields']['region']             = 'region';
$config->sampleapp->search['fields']['proline']            = 'Proline';
$config->sampleapp->search['fields']['validperiod']        = 'Valid Date';



$config->sampleapp->search['params']['sampleapp_name']       = array('operator' => '=',       'control' => 'select', 'values' => '');
$config->sampleapp->search['params']['region']       = array('operator' => '=',       'control' => 'select', 'values' => array('southchina'=>'Southchina','northchina'=>'Northchina','strategy'=>'Strategy','taiwan'=>'Taiwan','korea'=>'Korea','us'=>'USA','europe'=>'Europe','japan'=>'Japan','india'=>'India','asean'=>'Southeast Asia','telecom'=>'Telecom'));
//$config->sampleapp->search['params']['status']          = array('operator' => '=', 'control' => 'select',  'values' => array('approved'=>"Approved",'pending'=>"Pending",'reject'=>"Reject",'cancel'=>"Cancel"));

$config->mobile = new stdclass();
$config->mobile->todoBar  = array('today', 'yesterday', 'thisWeek', 'lastWeek', 'all');
$config->mobile->search   = array("="=>'=','like'=>"include",'>'=>'>',"<"=>"<","<="=>"<=",">="=>">=");
$config->sampleapp->mobile->search['fields']['id']               = 'ID';
$config->sampleapp->mobile->search['fields']['status']           = 'Status';
$config->sampleapp->mobile->search['fields']['rfqcode']          = 'RFQ#';
$config->sampleapp->mobile->search['fields']['partnumber']       = 'Part.';
$config->sampleapp->mobile->search['fields']['end_customer']     = 'End Code.';
$config->sampleapp->mobile->search['fields']['distributor']      = 'DisCode';
$config->sampleapp->mobile->search['fields']['price_dis']        = 'Dis.pri.';
$config->sampleapp->mobile->search['fields']['price_cus']        = 'EndCode';
$config->sampleapp->mobile->search['fields']['commission']       = 'commis.';
$config->sampleapp->mobile->search['fields']['openby']           = 'Req By';
$config->sampleapp->mobile->search['fields']['date']             = 'Begin Date';

$config->sampleapp->costdown = "C000723,C000014,C000573,C000775,C000551,C000229,C000642";

//样品申请申请页面搜索功能配置文件
$config->sampleapp->sample->search['module']="sampleapp";
$config->sampleapp->sample->search['fields']['id']='ID';
$config->sampleapp->sample->search['fields']['person']='Name';
$config->sampleapp->sample->search['fields']['rdate']='RequestDate';
$config->sampleapp->sample->search['fields']['partn']='Partnumber';
$config->sampleapp->sample->search['fields']['endname']='Endname';
$config->sampleapp->sample->search['fields']['distributor']='Disname';
$config->sampleapp->sample->search['fields']['shipDate']='ShipDate';
$config->sampleapp->sample->search['fields']['shiporder']='Shiporder';
$config->sampleapp->sample->search['fields']['revtype']='Mode of Payment';
$config->sampleapp->sample->search['fields']['close']="Status";
$config->sampleapp->sample->search['fields']['approve']='Need to approve';
$config->sampleapp->sample->search['fields']['areamanager']='FAE Director approve';
$config->sampleapp->sample->search['fields']['salesmanager']='CSR Manager approve';



$config->sampleapp->sample->search['params']['id']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->sample->search['params']['person']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->sample->search['params']['rdate']=array('operator' => '>=', 'control' => 'input',  'values' => '','class'=>'date');
$config->sampleapp->sample->search['params']['partn']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->sample->search['params']['endname']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->sample->search['params']['distributor']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->sample->search['params']['shipDate']=array('operator' => '>=', 'control' => 'input',  'values' => '','class'=>'date');
$config->sampleapp->sample->search['params']['shiporder']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->sample->search['params']['revtype']=array('operator' => '=', 'control' => 'select',  'values' => array("不需付费"=>"Free","需要付费"=>"Pay"));
$config->sampleapp->sample->search['params']['close']=array('operator' => '=', 'control' => 'select',  'values' => array("wait"=>"NOT Shiped","done"=>"Shiped"));
$config->sampleapp->sample->search['params']['approve']=array('operator' => '=', 'control' => 'select',  'values' => array('1'=>'Free request quantity exceed limit','3'=>'P3 release date exceed 3 year'));
$config->sampleapp->sample->search['params']['areamanager']=array('operator' => '=', 'control' => 'select', 'values' => array('1'=>'Rejected by FAE Director','2'=>'Agreed by FAE Director'));
$config->sampleapp->sample->search['params']['salesmanager']=array('operator' => '=', 'control' => 'select', 'values' => array('1'=>'Rejected by CSR Manager','2'=>'Agreed by CSR Manager'));


//样品demo申请申请页面搜索功能配置文件
$config->sampleapp->demo->search['module']="sampleapp";
$config->sampleapp->demo->search['fields']['id']='ID';
$config->sampleapp->demo->search['fields']['ae']='AE';
$config->sampleapp->demo->search['fields']['proline']='产线';
$config->sampleapp->demo->search['fields']['person']='Name';
$config->sampleapp->demo->search['fields']['rdate']='RequestDate';
$config->sampleapp->demo->search['fields']['partn']='Partnumber';
$config->sampleapp->demo->search['fields']['endname']='Endname';
$config->sampleapp->demo->search['fields']['distributor']='Disname';
$config->sampleapp->demo->search['fields']['shipDate']='ShipDate';
$config->sampleapp->demo->search['fields']['shiporder']='Shiporder';
$config->sampleapp->demo->search['fields']['revtype']='Mode of Payment';
$config->sampleapp->demo->search['fields']['close']="Status";


$config->sampleapp->demo->search['params']['id']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['ae']=array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['proline']=array('operator' => 'include', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['person']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['rdate']=array('operator' => '>=', 'control' => 'input',  'values' => '','class'=>'date');
$config->sampleapp->demo->search['params']['partn']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['endname']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['distributor']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['shipDate']=array('operator' => '>=', 'control' => 'input',  'values' => '','class'=>'date');
$config->sampleapp->demo->search['params']['shiporder']=array('operator' => '=', 'control' => 'input',  'values' => '');
$config->sampleapp->demo->search['params']['revtype']=array('operator' => '=', 'control' => 'select',  'values' => array("不需付费"=>"Free","需要付费"=>"Pay"));
$config->sampleapp->demo->search['params']['close']=array('operator' => '=', 'control' => 'select',  'values' => array("wait"=>"NOT Shiped","done"=>"Shiped"));





