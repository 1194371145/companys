<?php
/* Module order. */
$lang->moduleOrder[0]   = 'index';
$lang->moduleOrder[5]   = 'my';
$lang->moduleOrder[10]  = 'todo';

$lang->moduleOrder[15]  = 'performance';
$lang->moduleOrder[20]  = 'story';
$lang->moduleOrder[25]  = 'performanceplan';
$lang->moduleOrder[30]  = 'release';

$lang->moduleOrder[35]  = 'project';
$lang->moduleOrder[40]  = 'task';
$lang->moduleOrder[45]  = 'build';

$lang->moduleOrder[70]  = 'doc';
$lang->moduleOrder[75]  = 'report';

$lang->moduleOrder[80]  = 'company';
$lang->moduleOrder[85]  = 'dept';
$lang->moduleOrder[90]  = 'group';
$lang->moduleOrder[95]  = 'user';

$lang->moduleOrder[100] = 'admin';
$lang->moduleOrder[105] = 'extension';
$lang->moduleOrder[110] = 'custom';
$lang->moduleOrder[115] = 'editor';
$lang->moduleOrder[120] = 'convert';
$lang->moduleOrder[125] = 'action';

$lang->moduleOrder[130] = 'mail';
$lang->moduleOrder[135] = 'svn';
$lang->moduleOrder[140] = 'git';
$lang->moduleOrder[145] = 'search';
$lang->moduleOrder[150] = 'tree';
$lang->moduleOrder[155] = 'api';
$lang->moduleOrder[160] = 'file';
$lang->moduleOrder[165] = 'misc';
$lang->moduleOrder[170] = 'backup';
$lang->moduleOrder[175] = 'cron';
$lang->moduleOrder[180] = 'dev';

$lang->resource = new stdclass();

/* Index module. */
$lang->resource->index = new stdclass();
$lang->resource->index->index = 'index';

$lang->index->methodOrder[0] = 'index';

/* misc 防超时. */
$lang->resource->misc = new stdclass();
$lang->resource->misc->ping          = 'ping';


/* My module. */
$lang->resource->my = new stdclass();
$lang->resource->my->index          = 'index';
$lang->resource->my->profile        = 'profile';
$lang->resource->my->dynamic        = 'dynamic';
$lang->resource->my->editProfile    = 'editProfile';
$lang->resource->my->changePassword = 'changePassword';


$lang->my->methodOrder[0]  = 'index';
$lang->my->methodOrder[30] = 'story';
$lang->my->methodOrder[40] = 'profile';
$lang->my->methodOrder[45] = 'dynamic';
$lang->my->methodOrder[50] = 'editProfile';
$lang->my->methodOrder[55] = 'changePassword';




$lang->todo->methodOrder[5]  = 'create';
$lang->todo->methodOrder[10] = 'batchCreate';
$lang->todo->methodOrder[15] = 'edit';
$lang->todo->methodOrder[20] = 'view';
$lang->todo->methodOrder[25] = 'delete';
$lang->todo->methodOrder[30] = 'export';
$lang->todo->methodOrder[35] = 'finish';
$lang->todo->methodOrder[40] = 'import2Today';

/* performance. */
$lang->resource->performance = new stdclass();
$lang->resource->performance->index       = 'index';
$lang->resource->performance->import      = 'import';
$lang->resource->performance->batchdownload      = 'batchdownload';
$lang->resource->performance->create      = 'create';
$lang->resource->performance->review        = 'review';
$lang->resource->performance->superviserreview        = 'superviserreview';
$lang->resource->performance->close        = 'close';
$lang->resource->performance->delete      = 'delete';
$lang->resource->performance->download      = 'download';
$lang->resource->performance->all         = 'all';
$lang->resource->performance->export      = 'export';
$lang->resource->performance->ajaxgetjoindate = 'ajaxgetjoindate';
$lang->resource->performance->subordinates = 'subordinates';
$lang->resource->performance->see = 'see';
$lang->resource->performance->edititem = "edititem";

$lang->performance->methodOrder[0]  = 'index';
$lang->performance->methodOrder[5]  = 'browse';
$lang->performance->methodOrder[15] = 'review';
$lang->performance->methodOrder[35] = 'delete';
$lang->performance->methodOrder[70] = 'all';


/*train*/
$lang->resource->train = new stdclass();
$lang->resource->train->index="index";
$lang->resource->train->trainlist="trainlist";
$lang->resource->train->createtrain="createtrain";
$lang->resource->train->createcontent="createcontent";
$lang->resource->train->edit="edit";
$lang->resource->train->editcontent="editcontent";
$lang->resource->train->trainreply="trainreply";
$lang->resource->train->delete="delete";
$lang->resource->train->commentlist="commentlist";
$lang->resource->train->edittoptitle="edittoptitle";
$lang->resource->train->deltoptitle="deltoptitle";
$lang->resource->train->deletereply="deletereply";


/* crossexams*/
$lang->resource->crossexams->import="import";
$lang->resource->crossexams->export="export";

/* Build. */
$lang->resource->build = new stdclass();
$lang->resource->build->create           = 'create';
$lang->resource->build->edit             = 'edit';
$lang->resource->build->delete           = 'delete';
$lang->resource->build->view             = 'view';
$lang->resource->build->linkStory        = 'linkStory';
$lang->resource->build->unlinkStory      = 'unlinkStory';
$lang->resource->build->batchUnlinkStory = 'batchUnlinkStory';
$lang->resource->build->linkBug          = 'linkBug';
$lang->resource->build->unlinkBug        = 'unlinkBug';
$lang->resource->build->batchUnlinkBug   = 'batchUnlinkBug';

$lang->build->methodOrder[5]  = 'create';
$lang->build->methodOrder[10] = 'edit';
$lang->build->methodOrder[15] = 'delete';
$lang->build->methodOrder[20] = 'view';
$lang->build->methodOrder[25] = 'linkStory';
$lang->build->methodOrder[30] = 'unlinkStory';
$lang->build->methodOrder[35] = 'batchUnlinkStory';
$lang->build->methodOrder[40] = 'linkBug';
$lang->build->methodOrder[45] = 'unlinkBug';
$lang->build->methodOrder[50] = 'batchUnlinkBug';

/* QA. */
$lang->resource->qa = new stdclass();
$lang->resource->qa->index = 'index';

$lang->qa->methodOrder[0] = 'index';

/* Doc. */
$lang->resource->doc = new stdclass();
$lang->resource->doc->index     = 'index';
$lang->resource->doc->browse    = 'browse';
$lang->resource->doc->createLib = 'createLib';
$lang->resource->doc->editLib   = 'editLib';
$lang->resource->doc->deleteLib = 'deleteLib';
$lang->resource->doc->create    = 'create';
$lang->resource->doc->view      = 'view';
$lang->resource->doc->edit      = 'edit';
$lang->resource->doc->delete    = 'delete';

$lang->doc->methodOrder[0]  = 'index';
$lang->doc->methodOrder[5]  = 'browse';
$lang->doc->methodOrder[10] = 'createLib';
$lang->doc->methodOrder[15] = 'editLib';
$lang->doc->methodOrder[20] = 'deleteLib';
$lang->doc->methodOrder[25] = 'create';
$lang->doc->methodOrder[30] = 'view';
$lang->doc->methodOrder[35] = 'edit';
$lang->doc->methodOrder[40] = 'delete';

/* mail. */
$lang->resource->mail = new stdclass();
$lang->resource->mail->index  = 'index';
$lang->resource->mail->detect = 'detect';
$lang->resource->mail->edit   = 'edit';
$lang->resource->mail->save   = 'save';
$lang->resource->mail->test   = 'test';
$lang->resource->mail->reset  = 'reset';
$lang->resource->mail->browse = 'browse';
$lang->resource->mail->delete = 'delete';


$lang->mail->methodOrder[5]  = 'index';
$lang->mail->methodOrder[10] = 'detect';
$lang->mail->methodOrder[15] = 'edit';
$lang->mail->methodOrder[20] = 'save';
$lang->mail->methodOrder[25] = 'test';
$lang->mail->methodOrder[30] = 'reset';
$lang->mail->methodOrder[35] = 'browse';
$lang->mail->methodOrder[40] = 'delete';


/* Subversion. */
$lang->resource->svn = new stdclass();
$lang->resource->svn->diff    = 'diff';
$lang->resource->svn->cat     = 'cat';
$lang->resource->svn->apiSync = 'apiSync';

$lang->svn->methodOrder[5]  = 'diff';
$lang->svn->methodOrder[10] = 'cat';
$lang->svn->methodOrder[15] = 'apiSync';

/* Git. */
$lang->resource->git = new stdclass();
$lang->resource->git->diff    = 'diff';
$lang->resource->git->cat     = 'cat';
$lang->resource->git->apiSync = 'apiSync';

$lang->git->methodOrder[5]  = 'diff';
$lang->git->methodOrder[10] = 'cat';
$lang->git->methodOrder[15] = 'apiSync';

/* Company. */
$lang->resource->company = new stdclass();
$lang->resource->company->index  = 'index';
$lang->resource->company->browse = 'browse';
$lang->resource->company->edit   = 'edit';
$lang->resource->company->view   = 'view';
$lang->resource->company->dynamic= 'dynamic';
$lang->resource->company->tree= 'tree';
$lang->resource->company->setItem= 'setItem';
$lang->resource->company->uitemRecord = "uitemRecord";
$lang->resource->company->showsetitem = "showsetitem";
$lang->resource->company->createitem = "createitem";
$lang->resource->company->showsetitem = "showsetitem";
$lang->resource->company->itemexec = "itemexec";
$lang->resource->company->itemexec = "itemexec";
$lang->resource->company->edititem = "edititem";


$lang->company->methodOrder[0]  = 'index';
$lang->company->methodOrder[5]  = 'browse';
$lang->company->methodOrder[15] = 'edit';
$lang->company->methodOrder[25] = 'dynamic';
$lang->company->methodOrder[30] = 'tree';
$lang->company->methodOrder[35] = 'setItem';

/* Company. */
$lang->resource->item = new stdclass();
// $lang->resource->item->index  = 'index';
$lang->resource->item->browse = 'browse';
$lang->resource->item->useditem   = 'useditem';



/* Group. */
$lang->resource->group = new stdclass();
$lang->resource->group->browse       = 'browse';
$lang->resource->group->create       = 'create';
$lang->resource->group->edit         = 'edit';
$lang->resource->group->copy         = 'copy';
$lang->resource->group->delete       = 'delete';
$lang->resource->group->manageView   = 'manageView';
$lang->resource->group->managePriv   = 'managePriv';
$lang->resource->group->manageMember = 'manageMember';

$lang->group->methodOrder[5]  = 'browse';
$lang->group->methodOrder[10] = 'create';
$lang->group->methodOrder[15] = 'edit';
$lang->group->methodOrder[20] = 'copy';
$lang->group->methodOrder[25] = 'delete';
$lang->group->methodOrder[30] = 'managePriv';
$lang->group->methodOrder[35] = 'manageMember';

/* User. */
$lang->resource->user = new stdclass();
$lang->resource->user->create         = 'create';
$lang->resource->user->view           = 'view';
$lang->resource->user->edit           = 'edit';
$lang->resource->user->unlock         = 'unlock';
$lang->resource->user->delete         = 'delete';
$lang->resource->user->dynamic        = 'dynamic';
$lang->resource->user->profile        = 'profile';


$lang->user->methodOrder[5]  = 'create';
$lang->user->methodOrder[10] = 'view';
$lang->user->methodOrder[15] = 'edit';
$lang->user->methodOrder[20] = 'unlock';
$lang->user->methodOrder[25] = 'delete';
$lang->user->methodOrder[45] = 'project';
$lang->user->methodOrder[50] = 'dynamic';
$lang->user->methodOrder[55] = 'profile';





/* Search. */
$lang->resource->search = new stdclass();
$lang->resource->search->buildForm    = 'buildForm';
$lang->resource->search->buildQuery   = 'buildQuery';
$lang->resource->search->saveQuery    = 'saveQuery';
$lang->resource->search->deleteQuery  = 'deleteQuery';
$lang->resource->search->select       = 'select';

$lang->search->methodOrder[5]  = 'buildForm';
$lang->search->methodOrder[10] = 'buildQuery';
$lang->search->methodOrder[15] = 'saveQuery';
$lang->search->methodOrder[20] = 'deleteQuery';
$lang->search->methodOrder[25] = 'select';





/* Editor. */
$lang->resource->editor = new stdclass();
$lang->resource->editor->index   = 'index';
$lang->resource->editor->extend  = 'extend';
$lang->resource->editor->edit    = 'edit';
$lang->resource->editor->newPage = 'newPage';
$lang->resource->editor->save    = 'save';
$lang->resource->editor->delete  = 'delete';

$lang->editor->methodOrder[5]  = 'index';
$lang->editor->methodOrder[10] = 'extend';
$lang->editor->methodOrder[15] = 'edit';
$lang->editor->methodOrder[20] = 'newPage';
$lang->editor->methodOrder[25] = 'save';
$lang->editor->methodOrder[30] = 'delete';



/* Crossexams. */
$lang->resource->crossexams = new stdclass();
$lang->resource->crossexams->import = 'import';
$lang->resource->crossexams->crosslist = 'crosslist';
$lang->resource->crossexams->grades = 'grades';
$lang->resource->crossexams->edit = 'edit';
$lang->resource->crossexams->export = 'export';
$lang->resource->crossexams->delete = 'delete';

$lang->crossexams->methodOrder[5]  = 'import';
$lang->crossexams->methodOrder[10] = 'crosslist';
$lang->crossexams->methodOrder[15] = 'grades';
$lang->crossexams->methodOrder[20] = 'edit';
$lang->crossexams->methodOrder[25] = 'export';


/* Contract */
$lang->resource->contract = new stdclass();
$lang->resource->contract->index  = 'index';
$lang->resource->contract->contractdoc   = 'contractdoc';
$lang->resource->contract->contractlist  = 'contractlist';
$lang->resource->contract->editself      = 'editself';
$lang->resource->contract->editfawu      = 'editfawu';
$lang->resource->contract->edithuishen   = 'edithuishen';
$lang->resource->contract->delete        = 'delete';
$lang->resource->contract->viewfile      = 'viewfile';
$lang->resource->contract->contractdoclist      = 'contractdoclist';
$lang->resource->contract->contractpdf      = 'contractpdf';
$lang->resource->contract->ajaxgetdept      = 'ajaxgetdept';
$lang->resource->contract->changeamil      = 'changeamil';
$lang->resource->contract->contractTime      = 'contractTime';

$lang->crossexams->methodOrder[5]  = 'index';
$lang->crossexams->methodOrder[10] = 'contractdoc';
$lang->crossexams->methodOrder[15] = 'contractlist';
$lang->crossexams->methodOrder[20] = 'editself';
$lang->crossexams->methodOrder[25] = 'editfawu';
$lang->crossexams->methodOrder[30] = 'edithuishen';
$lang->crossexams->methodOrder[35] = 'delete';
$lang->crossexams->methodOrder[40] = 'viewfile';



$lang->resource->survey = new stdclass();
$lang->resource->survey->surveylist  = 'surveylist';
$lang->resource->survey->createsurvey   = 'createsurvey';
$lang->resource->survey->thumbup   = 'thumbup';
$lang->resource->survey->export   = 'export';

$lang->survey->methodOrder[5]  = 'surveylist';
$lang->survey->methodOrder[10] = 'createsurvey';
$lang->survey->methodOrder[15] = 'thumbup';
