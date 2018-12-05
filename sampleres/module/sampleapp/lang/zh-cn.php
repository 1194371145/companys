<?php
/**
 * The sampleapp module zh-cn file of ZenTaoMS.
 *
 * @copyright   Copyright 2009-2012 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     sampleapp
 * @version     $Id: zh-cn.php 2615 2012-02-22 07:20:56Z shiyangyangwork@yahoo.cn $
 * @link        http://www.zentao.net
 */
/* 字段列表。*/
$lang->sampleapp->common        = '项目视图';
$lang->sampleapp->id            = '项目编号';
$lang->sampleapp->company       = '所属公司';
$lang->sampleapp->iscat         = '作为目录';
$lang->sampleapp->type          = '项目类型';
$lang->sampleapp->parent        = '上级项目';
$lang->sampleapp->name          = '项目名称';
$lang->sampleapp->code          = '项目代号';
$lang->sampleapp->begin         = '项目开始日期';
$lang->sampleapp->end           = '结束日期';
$lang->sampleapp->days          = '可用工作日';
$lang->sampleapp->status        = '项目状态';
$lang->sampleapp->statge        = '所处阶段';
$lang->sampleapp->pri           = '优先级';
$lang->sampleapp->desc          = '项目描述';
$lang->sampleapp->goal          = '项目目标';
$lang->sampleapp->openedBy      = '由谁创建';
$lang->sampleapp->openedDate    = '创建日期';
$lang->sampleapp->closedBy      = '由谁关闭';
$lang->sampleapp->closedDate    = '关闭日期';
$lang->sampleapp->canceledBy    = '由谁取消';
$lang->sampleapp->canceledDate  = '取消日期';
$lang->sampleapp->PO            = '产品负责人';
$lang->sampleapp->PM            = '项目负责人';
$lang->sampleapp->QM            = '测试负责人';
$lang->sampleapp->RM            = '发布负责人';
$lang->sampleapp->acl           = '访问控制';
$lang->sampleapp->teamname      = '团队名称';
$lang->sampleapp->order         = '项目排序';
$lang->sampleapp->products      = '相关产品';
$lang->sampleapp->childsampleapps = '子项目';
$lang->sampleapp->whitelist     = '分组白名单';
$lang->sampleapp->totalEstimate = '总预计';
$lang->sampleapp->totalConsumed = '总消耗';
$lang->sampleapp->totalLeft     = '总剩余';
$lang->sampleapp->progess       = '进度';
$lang->sampleapp->viewBug       = '查看bug';
$lang->sampleapp->createTesttask= '提交测试';
$lang->sampleapp->noProduct     = '无产品项目';
$lang->sampleapp->select        = '--请选择项目--';

$lang->team->account    = '用户';
$lang->team->role       = '角色';
$lang->team->join       = '加盟日';
$lang->team->hours      = '可用工时/天';
$lang->team->days       = '可用工日';
$lang->team->totalHours = '总计';

/* 字段取值列表。*/
$lang->sampleapp->statusList['']      = '';
$lang->sampleapp->statusList['wait']  = '未开始';
$lang->sampleapp->statusList['doing'] = '进行中';
$lang->sampleapp->statusList['done']  = '已完成';

$lang->sampleapp->aclList['open']    = '默认设置(有项目视图权限，即可访问)';
$lang->sampleapp->aclList['private'] = '私有项目(只有项目团队成员才能访问)';
$lang->sampleapp->aclList['custom']  = '自定义白名单(团队成员和白名单的成员可以访问)';

/* 方法列表。*/
$lang->sampleapp->index           = "项目首页";
$lang->sampleapp->task            = '任务列表';
$lang->sampleapp->groupTask       = '分组浏览任务';
$lang->sampleapp->story           = '需求列表';
$lang->sampleapp->bug             = 'Bug列表';
$lang->sampleapp->dynamic         = '动态';
$lang->sampleapp->build           = 'Build列表';
$lang->sampleapp->testtask        = '测试申请';
$lang->sampleapp->burn            = '燃尽图';
$lang->sampleapp->computeBurn     = '更新燃尽图';
$lang->sampleapp->burnData        = '燃尽图数据';
$lang->sampleapp->team            = '团队成员';
$lang->sampleapp->doc             = '文档列表';
$lang->sampleapp->manageProducts  = '关联产品';
$lang->sampleapp->linkStory       = '关联需求';
$lang->sampleapp->view            = "基本信息";
$lang->sampleapp->create          = "添加项目";
$lang->sampleapp->delete          = "删除项目";
$lang->sampleapp->browse          = "浏览项目";
$lang->sampleapp->edit            = "编辑项目";
$lang->sampleapp->manageMembers   = '团队管理';
$lang->sampleapp->unlinkMember    = '移除成员';
$lang->sampleapp->unlinkStory     = '移除需求';
$lang->sampleapp->importTask      = '导入任务';
$lang->sampleapp->importBug       = '导入Bug';
$lang->sampleapp->ajaxGetProducts = '接口：获得项目产品列表';

// 我的权限方法
$lang->sampleapp->createout   = 'Sample的申请';
$lang->sampleapp->getsamplelist='Samplelist列表';
$lang->sampleapp->sampletmp='导出sample模版';
$lang->sampleapp->importout='Import Sample';
$lang->sampleapp->getsample='查看详情';
// $lang->sampleapp->deletesample='deletesample';
$lang->sampleapp->exportdatasample='sample数据的导出';
$lang->sampleapp->editdemo='编辑';
$lang->sampleapp->demolist='demolist列表';
$lang->sampleapp->exportdatademo='demo数据的导出';
$lang->sampleapp->exportprice='exportprice';
$lang->sampleapp->audit='审核';
$lang->sampleapp->getshipmentbypart='出货量';
$lang->sampleapp->getfcstbypart='fcst出货量';
$lang->sampleapp->ajaxgetpart='ajaxgetpart';
$lang->sampleapp->batchaudit='batchaudit';
$lang->sampleapp->mappingfrom="匹配产线";


/* 分组浏览。*/
$lang->sampleapp->allTasks             = '所有任务';
$lang->sampleapp->assignedToMe         = '指派给我';
$lang->sampleapp->finishedByMe         = '由我完成';
$lang->sampleapp->statusWait           = '未开始';
$lang->sampleapp->statusDoing          = '进行中';
$lang->sampleapp->statusUndone         = '未完成';
$lang->sampleapp->statusDone           = '已完成';
$lang->sampleapp->statusClosed         = '已关闭';
$lang->sampleapp->delayed              = '已延期';
$lang->sampleapp->groups['']           = '分组查看';
$lang->sampleapp->groups['story']      = '需求分组';
$lang->sampleapp->groups['status']     = '状态分组';
$lang->sampleapp->groups['pri']        = '优先级分组';
$lang->sampleapp->groups['openedby']   = '创建者分组';
$lang->sampleapp->groups['assignedTo'] = '指派给分组';
$lang->sampleapp->groups['finishedby'] = '完成者分组';
$lang->sampleapp->groups['closedby']   = '关闭者分组';
$lang->sampleapp->groups['estimate']   = '预计分组';
$lang->sampleapp->groups['consumed']   = '已消耗分组';
$lang->sampleapp->groups['left']       = '剩余分组';
$lang->sampleapp->groups['type']       = '类型分组';
$lang->sampleapp->groups['deadline']   = '截止分组';
$lang->sampleapp->listTaskNeedConfrim  = '需求变动';
$lang->sampleapp->byQuery              = '搜索';

/* 查询条件列表。*/
$lang->sampleapp->allsampleapp      = '所有项目';
$lang->sampleapp->aboveAllProduct = '以上所有产品';
$lang->sampleapp->aboveAllsampleapp = '以上所有项目';

/* 页面提示。*/
$lang->sampleapp->selectsampleapp   = "请选择项目";
$lang->sampleapp->beginAndEnd     = '起止时间';
$lang->sampleapp->lblStats        = '工时统计';
$lang->sampleapp->stats           = '可用工时<strong>%s</strong>工时<br />总共预计<strong>%s</strong>工时<br />已经消耗<strong>%s</strong>工时<br />预计剩余<strong>%s</strong>工时';
$lang->sampleapp->oneLineStats    = "项目<strong>%s</strong>, 代号为<strong>%s</strong>, 相关产品为<strong>%s</strong>，<strong>%s</strong>开始，<strong>%s</strong>结束，总预计<strong>%s</strong>工时，已消耗<strong>%s</strong>工时，预计剩余<strong>%s</strong>工时。";
$lang->sampleapp->taskSummary     = "本页共 <strong>%s</strong> 个任务，未开始<strong>%s</strong>，进行中<strong>%s</strong>，总预计<strong>%s</strong>工时，已消耗<strong>%s</strong>工时，剩余<strong>%s</strong>工时。";
$lang->sampleapp->memberHours     = "%s共有 <strong>%s</strong> 个可用工时，";
$lang->sampleapp->groupSummary    = "本组共 <strong>%s</strong> 个任务，未开始<strong>%s</strong>，进行中<strong>%s</strong>，总预计<strong>%s</strong>工时，已消耗<strong>%s</strong>工时，剩余<strong>%s</strong>工时。";
$lang->sampleapp->wbs             = "分解任务";
$lang->sampleapp->largeBurnChart  = '点击查看大图';
$lang->sampleapp->howToUpdateBurn = "<a href='%s' class='helplink'><i>如何更新?</i></a>";
$lang->sampleapp->whyNoStories    = "看起来没有需求可以关联。请检查下项目关联的产品中有没有需求，而且要确保它们已经审核通过。";
$lang->sampleapp->donesampleapps    = '已结束';
$lang->sampleapp->unDonesampleapps  = '未结束';

/* 交互提示。*/
$lang->sampleapp->confirmDelete         = '您确定删除项目[%s]吗？';
$lang->sampleapp->confirmUnlinkMember   = '您确定从该项目中移除该用户吗？';
$lang->sampleapp->confirmUnlinkStory    = '您确定从该项目中移除该需求吗？';
$lang->sampleapp->errorNoLinkedProducts = '该项目没有关联的产品，系统将转到产品关联页面';
$lang->sampleapp->accessDenied          = '您无权访问该项目！';
$lang->sampleapp->tips                  = '提示';
$lang->sampleapp->afterInfo             = '项目添加成功，您现在可以进行以下操作：';
$lang->sampleapp->setTeam               = '设置团队';
$lang->sampleapp->linkStory             = '关联需求';
$lang->sampleapp->createTask            = '添加任务';
$lang->sampleapp->goback                = '返回项目首页（5秒后将自动跳转）';

/* 统计。*/
$lang->sampleapp->charts->burn->graph->caption      = "燃尽图";
$lang->sampleapp->charts->burn->graph->xAxisName    = "日期";
$lang->sampleapp->charts->burn->graph->yAxisName    = "HOUR";
$lang->sampleapp->charts->burn->graph->baseFontSize = 12;
$lang->sampleapp->charts->burn->graph->formatNumber = 0;
$lang->sampleapp->charts->burn->graph->animation    = 0;
$lang->sampleapp->charts->burn->graph->rotateNames  = 1;
$lang->sampleapp->charts->burn->graph->showValues   = 0;


//特殊料号
$lang->sampleapp->chenwei = "frankie,nick,henry,davidtimm,lynn,michael";
$lang->sampleapp->sample->specialpart=array("SY13103-G1"=>"SY13103-G1","SY13103-G11"=>"SY13103-G11","SY3103-D11"=>"SY3103-D11","SY3103-D2"=>"SY3103-D2","SY3103-D21"=>"SY3103-D21","SY3103-E2"=>"SY3103-E2","SY3103-E21"=>"SY3103-E21","SY3103-B1"=>"SY3103-B1","SY13077-G1"=>"SY13077-G1","SY3077-B2"=>"SY3077-B2","SY3077-C2"=>"SY3077-C2","SY3077-J1"=>"SY3077-J1","SY3077-J11"=>"SY3077-J11","SY3077-J13"=>"SY3077-J13","SY13086-G2"=>"SY13086-G2","SY3086-M1"=>"SY3086-M1","SY3086-M2"=>"SY3086-M2","SY3055-B2"=>"SY3055-B2","SY3055-B2"=>"SY3055-B2","SY3058-A2"=>"SY3058-A2","SY3058-B2"=>"SY3058-B2","SY13087-G4"=>"SY13087-G4","SY13061-G1"=>"SY13061-G1","SY13080-G01"=>"SY13080-G01","SY13080-G02"=>"SY13080-G02","SY13110-G0"=>"SY13110-G0");


//编辑页面的select按钮
// $lang->sampleapp->shiporder = array('0'=>'','1'=>'快速出货');

// 限制3年审核的时间
$lang->sampleapp->date = date('Y').'-01-01';