<?php
global $lang;
$config->sampleout->out=new stdClass();
$config->sampleout->out->search['module']="sampleout";
$config->sampleout->out->search['fields']['id']='ID';
$config->sampleout->out->search['fields']['mid']="主数据ID";
$config->sampleout->out->search['fields']['person']="申请人";
$config->sampleout->out->search['fields']['rf']="RF";
$config->sampleout->out->search['fields']['rdate']="申请时间";
$config->sampleout->out->search['fields']['createdate']="记录创建日期";
$config->sampleout->out->search['fields']['rtype']="申请类型";
$config->sampleout->out->search['fields']['partn']="Partnumber";
$config->sampleout->out->search['fields']['package']="Package";
$config->sampleout->out->search['fields']['endname']="客户";
$config->sampleout->out->search['fields']['distributor']="代理商";
$config->sampleout->out->search['fields']['projectname']='项目名称';
$config->sampleout->out->search['fields']['qty']="申请数量";
$config->sampleout->out->search['fields']['aqty']="发货数量";
$config->sampleout->out->search['fields']['price']="价格";
$config->sampleout->out->search['fields']['rev']="金额";
$config->sampleout->out->search['fields']['shipdate']="发货日期";
$config->sampleout->out->search['fields']['shiporder']="快递号";
$config->sampleout->out->search['fields']['type']="主数据类型";
$config->sampleout->out->search['fields']['close']="申请状态";
$config->sampleout->out->search['fields']['area']="区域";
$config->sampleout->out->search['fields']['revtype']="是否付费";
$config->sampleout->out->search['fields']['stage']="Stage";
$config->sampleout->out->search['fields']['openby']="创建者";
$config->sampleout->out->search['fields']['remark']="备注";
$config->sampleout->out->search['fields']['pay']="付费状态";
$config->sampleout->out->search['params']['id']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['mid']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['person']=array('operator' => 'include',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['rf']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['rdate']=array('operator' => 'include',  'control' => 'input',  'values' => '','class'=>'date');
$config->sampleout->out->search['params']['createdate']=array('operator' => 'include',  'control' => 'input',  'values' => '','class'=>'date');
$config->sampleout->out->search['params']['rtype']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['partn']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['package']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['endname']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['distributor']=array('operator' => 'include',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['projectname']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['qty']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['aqty']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['price']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['rev']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['shipdate']=array('operator' => 'include',  'control' => 'input',  'values' => '','class'=>'date');
$config->sampleout->out->search['params']['shiporder']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['type']=array('operator' => '=',  'control' => 'select',  'values' => $lang->sampleout->type);
$config->sampleout->out->search['params']['close']=array('operator' => '=',  'control' => 'select',  'values' => $lang->sampleout->close);
$config->sampleout->out->search['params']['area']=array('operator' => '=',  'control' => 'select',  'values' => $lang->sampleout->area);
$config->sampleout->out->search['params']['revtype']=array('operator' => '=',  'control' => 'select',  'values' => $lang->sampleout->revtype);
$config->sampleout->out->search['params']['stage']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['openby']=array('operator' => '=',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['remark']=array('operator' => 'include',  'control' => 'input',  'values' => '');
$config->sampleout->out->search['params']['pay']=array('operator' => '=',  'control' => 'select',  'values' => array("wait"=>'未付','done'=>'付清'));

$config->sampleout->editor = new stdclass();
//$config->sampleout->editor->vieweditout   = array('id' => 'remark', 'tools' => 'simpleTools');
//$config->sampleout->editor->createout   = array('id' => 'remark', 'tools' => 'simpleTools');
$config->sampleout->createout=new stdClass();
$config->sampleout->vieweditout->requiredFields="partn";
$config->sampleout->createout->requiredFields="partn,aqty,qty";

?>