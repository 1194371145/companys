<?php 
global $lang, $app;

$config->crossexams->crosslist->search['module']                       = 'cross';   
$config->crossexams->crosslist->search['field']['id']                  = "ID";
$config->crossexams->crosslist->search['field']['sid']                = "SID";
$config->crossexams->crosslist->search['field']['manager']                = "Manager";
$config->crossexams->crosslist->search['field']['Item']      = "Item";
$config->crossexams->crosslist->search['field']['professionality']      = "Professionality";
$config->crossexams->crosslist->search['field']['cooperation']      = "Co-operation";
$config->crossexams->crosslist->search['field']['execution']      = "Execution";

$config->crossexams->crosslist->search['field']['responsibility']      = "Responsibility";
$config->crossexams->crosslist->search['field']['integrity']           = "Integrity";
$config->crossexams->crosslist->search['field']['circletime']          = "Circletime";


$config->crossexams->crosslist->search['params']['id']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['sid']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['manager']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['item']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['professionality']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['cooperation']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['execution']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['responsibility']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['integrity']     = array('operator'=>'=','control'=>'input','values'=>'');
$config->crossexams->crosslist->search['params']['circletime']     = array('operator'=>'=','control'=>'input','values'=>'');


?>