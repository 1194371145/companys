<?php
/**
 * The sampleapp module zh-tw file of ZenTaoMS.
 *
 * @copyright   Copyright 2009-2012 青島易軟天創網絡科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     sampleapp
 * @version     $Id: zh-tw.php 2615 2012-02-22 07:20:56Z shiyangyangwork@yahoo.cn $
 * @link        http://www.zentao.net
 */
/* 欄位列表。*/
$lang->sampleapp->common        = '項目視圖';
$lang->sampleapp->id            = '項目編號';
$lang->sampleapp->company       = '所屬公司';
$lang->sampleapp->iscat         = '作為目錄';
$lang->sampleapp->type          = '項目類型';
$lang->sampleapp->parent        = '上級項目';
$lang->sampleapp->name          = '項目名稱';
$lang->sampleapp->code          = '項目代號';
$lang->sampleapp->begin         = '開始日期';
$lang->sampleapp->end           = '結束日期';
$lang->sampleapp->days          = '可用工作日';
$lang->sampleapp->status        = '項目狀態';
$lang->sampleapp->statge        = '所處階段';
$lang->sampleapp->pri           = '優先順序';
$lang->sampleapp->desc          = '項目描述';
$lang->sampleapp->goal          = '項目目標';
$lang->sampleapp->openedBy      = '由誰創建';
$lang->sampleapp->openedDate    = '創建日期';
$lang->sampleapp->closedBy      = '由誰關閉';
$lang->sampleapp->closedDate    = '關閉日期';
$lang->sampleapp->canceledBy    = '由誰取消';
$lang->sampleapp->canceledDate  = '取消日期';
$lang->sampleapp->PO            = '產品負責人';
$lang->sampleapp->PM            = '項目負責人';
$lang->sampleapp->QM            = '測試負責人';
$lang->sampleapp->RM            = '發佈負責人';
$lang->sampleapp->acl           = '訪問控制';
$lang->sampleapp->teamname      = '團隊名稱';
$lang->sampleapp->order         = '項目排序';
$lang->sampleapp->products      = '相關產品';
$lang->sampleapp->childsampleapps = '子項目';
$lang->sampleapp->whitelist     = '分組白名單';
$lang->sampleapp->totalEstimate = '總預計';
$lang->sampleapp->totalConsumed = '總消耗';
$lang->sampleapp->totalLeft     = '總剩餘';
$lang->sampleapp->progess       = '進度';
$lang->sampleapp->viewBug       = '查看bug';
$lang->sampleapp->createTesttask= '提交測試';
$lang->sampleapp->noProduct     = '無產品項目';
$lang->sampleapp->select        = '--請選擇項目--';

$lang->team->account    = '用戶';
$lang->team->role       = '角色';
$lang->team->join       = '加盟日';
$lang->team->hours      = '可用工時/天';
$lang->team->days       = '可用工日';
$lang->team->totalHours = '總計';

/* 欄位取值列表。*/
$lang->sampleapp->statusList['']      = '';
$lang->sampleapp->statusList['wait']  = '未開始';
$lang->sampleapp->statusList['doing'] = '進行中';
$lang->sampleapp->statusList['done']  = '已完成';

$lang->sampleapp->aclList['open']    = '預設設置(有項目視圖權限，即可訪問)';
$lang->sampleapp->aclList['private'] = '私有項目(只有項目團隊成員才能訪問)';
$lang->sampleapp->aclList['custom']  = '自定義白名單(團隊成員和白名單的成員可以訪問)';

/* 方法列表。*/
$lang->sampleapp->index           = "項目首頁";
$lang->sampleapp->task            = '任務列表';
$lang->sampleapp->groupTask       = '分組瀏覽任務';
$lang->sampleapp->story           = '需求列表';
$lang->sampleapp->bug             = 'Bug列表';
$lang->sampleapp->dynamic         = '動態';
$lang->sampleapp->build           = 'Build列表';
$lang->sampleapp->testtask        = '測試申請';
$lang->sampleapp->burn            = '燃盡圖';
$lang->sampleapp->computeBurn     = '更新燃盡圖';
$lang->sampleapp->burnData        = '燃盡圖數據';
$lang->sampleapp->team            = '團隊成員';
$lang->sampleapp->doc             = '文檔列表';
$lang->sampleapp->manageProducts  = '關聯產品';
$lang->sampleapp->linkStory       = '關聯需求';
$lang->sampleapp->view            = "基本信息";
$lang->sampleapp->create          = "添加項目";
$lang->sampleapp->delete          = "刪除項目";
$lang->sampleapp->browse          = "瀏覽項目";
$lang->sampleapp->edit            = "編輯項目";
$lang->sampleapp->manageMembers   = '團隊管理';
$lang->sampleapp->unlinkMember    = '移除成員';
$lang->sampleapp->unlinkStory     = '移除需求';
$lang->sampleapp->importTask      = '導入任務';
$lang->sampleapp->importBug       = '導入Bug';
$lang->sampleapp->ajaxGetProducts = '介面：獲得項目產品列表';

/* 分組瀏覽。*/
$lang->sampleapp->allTasks             = '所有任務';
$lang->sampleapp->assignedToMe         = '指派給我';
$lang->sampleapp->finishedByMe         = '由我完成';
$lang->sampleapp->statusWait           = '未開始';
$lang->sampleapp->statusDoing          = '進行中';
$lang->sampleapp->statusUndone         = '未完成';
$lang->sampleapp->statusDone           = '已完成';
$lang->sampleapp->statusClosed         = '已關閉';
$lang->sampleapp->delayed              = '已延期';
$lang->sampleapp->groups['']           = '分組查看';
$lang->sampleapp->groups['story']      = '需求分組';
$lang->sampleapp->groups['status']     = '狀態分組';
$lang->sampleapp->groups['pri']        = '優先順序分組';
$lang->sampleapp->groups['openedby']   = '創建者分組';
$lang->sampleapp->groups['assignedTo'] = '指派給分組';
$lang->sampleapp->groups['finishedby'] = '完成者分組';
$lang->sampleapp->groups['closedby']   = '關閉者分組';
$lang->sampleapp->groups['estimate']   = '預計分組';
$lang->sampleapp->groups['consumed']   = '已消耗分組';
$lang->sampleapp->groups['left']       = '剩餘分組';
$lang->sampleapp->groups['type']       = '類型分組';
$lang->sampleapp->groups['deadline']   = '截止分組';
$lang->sampleapp->listTaskNeedConfrim  = '需求變動';
$lang->sampleapp->byQuery              = '搜索';

/* 查詢條件列表。*/
$lang->sampleapp->allsampleapp      = '所有項目';
$lang->sampleapp->aboveAllProduct = '以上所有產品';
$lang->sampleapp->aboveAllsampleapp = '以上所有項目';

/* 頁面提示。*/
$lang->sampleapp->selectsampleapp   = "請選擇項目";
$lang->sampleapp->beginAndEnd     = '起止時間';
$lang->sampleapp->lblStats        = '工時統計';
$lang->sampleapp->stats           = '可用工時<strong>%s</strong>工時<br />總共預計<strong>%s</strong>工時<br />已經消耗<strong>%s</strong>工時<br />預計剩餘<strong>%s</strong>工時';
$lang->sampleapp->oneLineStats    = "項目<strong>%s</strong>, 代號為<strong>%s</strong>, 相關產品為<strong>%s</strong>，<strong>%s</strong>開始，<strong>%s</strong>結束，總預計<strong>%s</strong>工時，已消耗<strong>%s</strong>工時，預計剩餘<strong>%s</strong>工時。";
$lang->sampleapp->taskSummary     = "本頁共 <strong>%s</strong> 個任務，未開始<strong>%s</strong>，進行中<strong>%s</strong>，總預計<strong>%s</strong>工時，已消耗<strong>%s</strong>工時，剩餘<strong>%s</strong>工時。";
$lang->sampleapp->memberHours     = "%s共有 <strong>%s</strong> 個可用工時，";
$lang->sampleapp->groupSummary    = "本組共 <strong>%s</strong> 個任務，未開始<strong>%s</strong>，進行中<strong>%s</strong>，總預計<strong>%s</strong>工時，已消耗<strong>%s</strong>工時，剩餘<strong>%s</strong>工時。";
$lang->sampleapp->wbs             = "分解任務";
$lang->sampleapp->largeBurnChart  = '點擊查看大圖';
$lang->sampleapp->howToUpdateBurn = "<a href='%s' class='helplink'><i>如何更新?</i></a>";
$lang->sampleapp->whyNoStories    = "看起來沒有需求可以關聯。請檢查下項目關聯的產品中有沒有需求，而且要確保它們已經審核通過。";
$lang->sampleapp->donesampleapps    = '已結束';
$lang->sampleapp->unDonesampleapps  = '未結束';

/* 交互提示。*/
$lang->sampleapp->confirmDelete         = '您確定刪除項目[%s]嗎？';
$lang->sampleapp->confirmUnlinkMember   = '您確定從該項目中移除該用戶嗎？';
$lang->sampleapp->confirmUnlinkStory    = '您確定從該項目中移除該需求嗎？';
$lang->sampleapp->errorNoLinkedProducts = '該項目沒有關聯的產品，系統將轉到產品關聯頁面';
$lang->sampleapp->accessDenied          = '您無權訪問該項目！';
$lang->sampleapp->tips                  = '提示';
$lang->sampleapp->afterInfo             = '項目添加成功，您現在可以進行以下操作：';
$lang->sampleapp->setTeam               = '設置團隊';
$lang->sampleapp->linkStory             = '關聯需求';
$lang->sampleapp->createTask            = '添加任務';
$lang->sampleapp->goback                = '返回項目首頁（5秒後將自動跳轉）';

/* 統計。*/
$lang->sampleapp->charts->burn->graph->caption      = "燃盡圖";
$lang->sampleapp->charts->burn->graph->xAxisName    = "日期";
$lang->sampleapp->charts->burn->graph->yAxisName    = "HOUR";
$lang->sampleapp->charts->burn->graph->baseFontSize = 12;
$lang->sampleapp->charts->burn->graph->formatNumber = 0;
$lang->sampleapp->charts->burn->graph->animation    = 0;
$lang->sampleapp->charts->burn->graph->rotateNames  = 1;
$lang->sampleapp->charts->burn->graph->showValues   = 0;
