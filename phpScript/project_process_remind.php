<?php

error_reporting(0);
$rootdir = dirname(dirname(__FILE__));
require_once($rootdir . "/phpScript/db/init.php");
set_time_limit(0);
$process = $db->getRows("select * from zt_projectprocess");
foreach ($process as $v) {
    if ($v['startTime'] && $v['needDays']) {
        if ($v['endTime']!=''&& $v['endTime']!='0000-00-00') {//仍未完成
            require("get_end_workday.php");
            $end_date = get_end_workday($v['startTime'], $v['needDays'], $db);
            if (strtotime($end_date) < strtotime(date('Y-m-d'))) {
                //发送邮件通知
                $project = $db->getRow("select pj_number,saleman from zt_geproject where `pj_number`='" . $v['pj_number'] . "'");
                $salerEmail = $db->getRow("select email,realname from zt_user where `id`='" . $project['saleman'] . "'");
                require('sendmail.php');
                $sendEmails = array($salerEmail['email'] => $salerEmail['realname'], 'support@genedenovo.com' => '项目管理', 'lab@genedenovo.com' => '实验室', 'pms@genedenovo.com' => '项目管理系统维护');
                $sendEmails = array('xjcai@genedenovo.com' => '蔡晓军');
                sendMail($sendEmails, "项目{$project['pj_number']}进度超期情况", "您好，项目{$project['pj_number']}{$v['schedule']}时间已超过预定时间{$v['needDays']}天，麻烦负责的同事抓紧处理项目相关事宜,谢谢");
            }
        }
    }
}
?>