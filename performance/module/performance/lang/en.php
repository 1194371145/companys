<?php
$lang->performance->common      = "Performance";
$lang->performance->index       = "Index";
$lang->performance->browse      = "Browse";
$lang->performance->dynamic     = "Dynamic";
$lang->performance->view        = "Info";
$lang->performance->edit        = "Edit";
$lang->performance->batchEdit   = "Batch Edit";
$lang->performance->create      = "Create";
$lang->performance->delete      = "Delete";
$lang->performance->deleted     = "Deleted";
$lang->performance->close       = "Close";
$lang->performance->select      = "select {$lang->performanceCommon}";
$lang->performance->mine        = 'I charge : ';
$lang->performance->other       = 'Other : ';
$lang->performance->closed      = 'Closed';
$lang->performance->updateOrder = 'Order';
$lang->performance->all         = "All {$lang->performanceCommon}";
$lang->performance->circle         = "Cycle";
$lang->performance->staffcode         = "Staff Code";
$lang->performance->review         = "Review";
$lang->performance->superviserreview         = "Superviser Review";
$lang->performance->close         = "Close Performance";
$lang->performance->import         = "Import single excel";
$lang->performance->batchdownload         = "Batch download";
$lang->performance->download         = "Download";
$lang->performance->ajaxgetjoindate = "AjaxGetJoinDate";
$lang->performance->export         = "Export List";
$lang->performance->close         = "Close";
$lang->performance->subordinates = "Subordinates";
$lang->performance->see = "View";

$lang->performance->plans    = 'Plans';
$lang->performance->releases = 'Releases';
$lang->performance->docs     = 'Documents';
$lang->performance->doc      = 'Doc';
$lang->performance->project  = "{$lang->projectCommon}s";

$lang->performance->confirmDelete   = " Are you sure to delete this category ?";

$lang->performance->errorNoperformance = "No {$lang->performanceCommon} in system yet.";
$lang->performance->accessDenied   = "Access to this {$lang->performanceCommon} denined.";

$lang->performance->name      = 'Name';
$lang->performance->code      = 'Code';
$lang->performance->order     = 'Order';
$lang->performance->type      = "Type";
$lang->performance->status    = 'Status';
$lang->performance->desc      = 'Desc';
$lang->performance->acl       = 'Access limitation';
$lang->performance->whitelist = 'Whitelist';
$lang->performance->branch    = '%s';









/*
 * view
 */
$lang->performance->Employee="Employee";
$lang->performance->Department="Department";
$lang->performance->Position="Position";
$lang->performance->Join_Date="Join Date";
$lang->performance->Reviewer="Reviewer";
$lang->performance->Review_Cycle="Review Cycle";
$lang->performance->Total_Score="Total Score";
$lang->performance->Categories="Categories";
$lang->performance->content="Job Performance Evaluation （70%）(Compare with the targets after last Review)";
$lang->performance->Weight="Weight";
$lang->performance->reviewbymyself="Work Summary by Employee";
$lang->performance->reviewbysuper="Actual results (goals completed as established) by Reviewer";
$lang->performance->score="Employee self assessment  （1-100）";
$lang->performance->scorebysuper="Score by Reviewer       （1-100）";
$lang->performance->worktotal="Subtotal Score (Weight*Score)";
$lang->performance->ability="Employee's Strength Evaluation      (30%)";
$lang->performance->Comments="Comments";
$lang->performance->statement="Employee's Statement";
$lang->performance->Summary="Reviewer's Summary";
$lang->performance->review_strenght="Employee's strength";
$lang->performance->review_improve="Identify improvements and development";
$lang->performance->objective="Goals for Next review Cycle";
$lang->performance->objectives="Specific Goals and Objectives";
$lang->performance->autographmyself="Emplyee Signature & Date";
$lang->performance->autographsuper="Reviewer Signature & Date";
$lang->performance->autographcfo="Director's Approval and Signature";
$lang->performance->performance="Employee Performance Review Form";
$lang->performance->type="Type";

/*
 * Prompt language
 */
$lang->performance->notempty ="Please make sure that the data is not empty!";
$lang->performance->fieldtype="Pay attention to the field type of the weight!";
$lang->performance->position="The types of employees can not be empty";
$lang->performance->repetition="Data duplication, please pay attention to check!";

$lang->performance->radios = array(""=>"",'staff'=>"Staff",'manager'=>"Manager" , "DE"=>"DE" , "DeManager"=>"DE Manager");
$lang->performance->abilitys = array("Strictly follow QA rules to avoid quality problems and repetitive mistakes",
                                     "Team spirit, getting along with co-workers. Resolving confilict in a positive and constructive manner.",
                                     "Effective Communication with superiors and subordinates. ",
                                     "Creativity, can do altitude, and willing to take up challenge.",
                                     "Have discinpline, and in full compliance with company employee code of conduct. Actively paticipate company activities. Demostrate proud ownership of company.",
                                     "Managers: Lead the team to get work done effectively and efficiently.",
                                     "Managers: Demonstrate leadship in team building, can recruit effectively, & mentor and train new employees.");
$lang->performance->abilitysstaff = array("Strictly follow QA rules to avoid quality problems and repetitive mistakes",
                                     "Team spirit, getting along with co-workers. Resolving confilict in a positive and constructive manner.",
                                     "Effective Communication with superiors and subordinates. ",
                                     "Creativity, can do altitude, and willing to take up challenge.",
                                     "Have discinpline, and in full compliance with company employee code of conduct. Actively paticipate company activities. Demostrate proud ownership of company.");

$lang->performance->deability = array("Strictly follow QA rules to avoid quality problems and repetitive mistakes",
                                      "Team spirit, getting along with co-workers. Resolving confilict in a positive and constructive manner.",
                                      "Effective Communication with superiors and subordinates.",
                                      "Creativity, can do altitude, and willing to take up challenge.",
                                      "Have discinpline, and in full compliance with company employee code of conduct. Actively paticipate company activities. Demostrate proud ownership of company.",
                                      "the time of attending other DE's project review > 10 hours (manaers > 20hr); give >2 hours training to other colleagues (managers > 4 hr)  ignore this if engineer work less than 1 year
(give an average of 80 point)",
                                      "Managers: Lead the team to get work done effectively and efficiently.", 
                                      "Managers: Demonstrate leadship in team building, can recruit effectively, & mentor and train new employees."
                                       );
                                       
$lang->performance->deabilitystaff = array("Strictly follow QA rules to avoid quality problems and repetitive mistakes",
                                      "Team spirit, getting along with co-workers. Resolving confilict in a positive and constructive manner.",
                                      "Effective Communication with superiors and subordinates.",
                                      "Creativity, can do altitude, and willing to take up challenge.",
                                      "Have discinpline, and in full compliance with company employee code of conduct. Actively paticipate company activities. Demostrate proud ownership of company.",
                                      "the time of attending other DE's project review > 10 hours (manaers > 20hr); give >2 hours training to other colleagues (managers > 4 hr)  ignore this if engineer work less than 1 year
                                      (give an average of 80 point)");                                      

$lang->performance->weightstaff=array('0.1','0.25','0.25','0.2','0.2');
$lang->performance->weightmanager=array('0.15','0.1','0.1','0.1','0.15','0.2','0.2');

$lang->performance->destaff=array('0.1','0.15','0.15','0.20','0.15','0.25','');

$lang->performance->demanager=array('0.15','0.1','0.1','0.15','0.15','0.15','0.1','0.1');
$lang->performance->categorputstaff=array(1,2,3,4,5);
$lang->performance->category=array(1,2,3,4,5,6);
$lang->performance->categorypuj=array(1,2,3,4,5,6,7);
$lang->performance->decategory=array(1,2,3,4,5,6,7,8);


$lang->performance->abilityzg = array("严格执行工作QA流程，防止品质问题，避免重复性错误",
                                       "具备团队合作精神，能以大局为重，与同事良好配合,彼此体谅,不参与小团体。",
                                       "能有效与同事,上下级沟通，准确传递信息,不会因为沟通不畅影响或延缓工作。",
                                       "敢于创新，能主动面对问题，解决问题。",
                                       "纪律性强，自觉遵守公司各项制度，不无故迟到早退或旷工；积极参加公司各项活动，关心公司发展并积极提出合理化建议",
                                       "经理人员：能有效地领导团队制定完成工作计划。",
                                       "经理人员：能招聘优秀人才,并培养在职员工,使其在技术和职业上能有所成长。");
$lang->performance->deabilityz = array("严格执行工作QA流程，防止品质问题，避免重复性错误",
                                       "具备团队合作精神，能以大局为重，与同事良好配合,彼此体谅,不参与小团体。",
                                       "能有效与同事,上下级沟通，准确传递信息,不会因为沟通不畅影响或延缓工作。",
                                       "敢于创新，能主动面对问题，解决问题。",
                                       "纪律性强，自觉遵守公司各项制度，不无故迟到早退或旷工；积极参加公司各项活动，关心公司发展并积极提出合理化建议",
                                       "参与其他项目review时间大于10小时（经理人员〉20小时）；做traing时间大于2小时（经理〉4小时）",
                                       "经理人员：能有效地领导团队制定完成工作计划。",
                                       "经理人员：能招聘优秀人才,并培养在职员工,使其在技术和职业上能有所成长。");


$lang->performance->deabilitystaffz = array("严格执行工作QA流程，防止品质问题，避免重复性错误",
	                                       "具备团队合作精神，能以大局为重，与同事良好配合,彼此体谅,不参与小团体。",
	                                       "能有效与同事,上下级沟通，准确传递信息,不会因为沟通不畅影响或延缓工作。",
	                                       "敢于创新，能主动面对问题，解决问题。",
	                                       "纪律性强，自觉遵守公司各项制度，不无故迟到早退或旷工；积极参加公司各项活动，关心公司发展并积极提出合理化建议",
	                                       "参与其他项目review时间大于10小时（经理人员〉20小时）；做traing时间大于2小时（经理〉4小时）");
$lang->performance->deabilitysputstaff = array("严格执行工作QA流程，防止品质问题，避免重复性错误",
	                                       "具备团队合作精神，能以大局为重，与同事良好配合,彼此体谅,不参与小团体。",
	                                       "能有效与同事,上下级沟通，准确传递信息,不会因为沟通不畅影响或延缓工作。",
	                                       "敢于创新，能主动面对问题，解决问题。",
	                                       "纪律性强，自觉遵守公司各项制度，不无故迟到早退或旷工；积极参加公司各项活动，关心公司发展并积极提出合理化建议");
























