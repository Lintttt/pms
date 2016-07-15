<?php

error_reporting(0);
$rootdir = dirname(dirname(__FILE__));
require_once($rootdir . "/phpScript/db/init.php");
set_time_limit(0);
$expresses = $db->getRows("select pj_id,expressNum,sendDate,getDate from zt_express");
foreach ($expresses as $v) {
    require("get_end_workday.php");
    $end_date = get_end_workday($v['sendDate'], '2', $db);
    if(strtotime($end_date)<strtotime(date('Y-m-d')) && $v['getDate']=='0000-00-00'){
        //发送邮件通知
        $project = $db->getRow("select pj_number,saleman from zt_geproject where `project_id`='".$v['pj_id']."'");
        $salerEmail = $db->getRow("select email,realname from zt_user where `id`='".$project['saleman']."'");
        require('sendmail.php');
        sendMail(array($salerEmail['email']=>$salerEmail['realname'],'support@genedenovo.com'=>'项目管理','lab@genedenovo.com'=>'实验室'), "项目{$project['pj_number']}样品快递未到达已超过2天", "您好，项目{$project['pj_number']}的样品快递已经超过2天仍未到达，麻烦请及时跟进下具体情况");        
    }else{
    }
}
?>