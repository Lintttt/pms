<?php

error_reporting(0);
$rootdir = dirname(dirname(__FILE__));
require_once($rootdir . "/phpScript/db/init.php");
set_time_limit(0);
$extracts = $db->getRows("select pj_number,firstTrialTime,extractProgress,needTime from zt_projectextract");
foreach ($extracts as $v) {
    if ($v['firstTrialTime'] && $v['needTime']) {
        if (!in_array($v['extractProgress'], array('提取完成', '已送样', '样品检测中'))) {
            require("get_end_workday.php");
            $end_date = get_end_workday($v['firstTrialTime'], $v['needTime'], $db);
            if (strtotime($end_date) < strtotime(date('Y-m-d'))) {
                //发送邮件通知
                $project = $db->getRow("select pj_number,saleman from zt_geproject where `pj_number`='" . $v['pj_number'] . "'");
                $salerEmail = $db->getRow("select email,realname from zt_user where `id`='" . $project['saleman'] . "'");
                require('sendmail.php');
                $sendEmails = array($salerEmail['email'] => $salerEmail['realname'], 'support@genedenovo.com' => '项目管理', 'lab@genedenovo.com' => '实验室', 'pms@genedenovo.com' => '项目管理系统维护');
                $sendEmails = array('xjcai@genedenovo.com' => '蔡晓军');
                sendMail($sendEmails, "项目{$project['pj_number']}", "您好，项目{$project['pj_number']}抽提时间已超期，麻烦实验室的同事及时跟进下具体情况,谢谢");
            }
        }
    }
}
?>