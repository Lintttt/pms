<?php
error_reporting(0);
$rootdir = dirname(dirname(__FILE__));
require_once($rootdir."/phpScript/db/init.php");
set_time_limit(0);
$invoices = $db->getRows("select distinct(invoiceNum) as invoiceNum from zt_contractamount");
foreach ($invoices as $v) {
    updateInvoicePeriod(strval($v['invoiceNum']),$db);
}
$db->query("update zt_contractamount set `payPeriod`=NULL,`unpayPeriod`=NULL where `status` in('0','2','3','4','5')");
$db->query("update zt_contractamount set `unpayPeriod`=NULL where `payPeriod` IS NOT NULL");
$db->close();

function updateInvoicePeriod($invoiceNum = '',$db) {
    $invoices = $db->getRows("select * from zt_contractamount where `invoiceNum`=$invoiceNum and `invoiceType` not in('内部发票') and `status` not in('0', '2', '3', '4', '5')");
    if (empty($invoices))
        return false;
    foreach ($invoices as $v) {
        $invoiceDate = $v['invoiceDate'];
        $invoiceTotal = $v['invoiceTotal'];
        $paymentTotal = $paymentTotal + $v['paymentAmount'];
        $paymentDates[$v['id']] = $v['paymentDate'];
    }
    $lastPaymentDay = max($paymentDates);
    $lastToTime = strtotime($lastPaymentDay);
    $invoiceToTime = strtotime($invoiceDate);
    $period = array();
    if ($paymentTotal < $invoiceTotal) {
        if ($lastPaymentDay != '0000-00-00' && !empty($lastPaymentDay)) {
            $unpayPeriod = (date('Y') - date('Y', $lastToTime)) * 12 + date('m') - date('m', $lastToTime) - (date('d') < date('d', $lastToTime) ? '1' : '0');
        } else {
            $unpayPeriod = (date('Y') - date('Y', $invoiceToTime)) * 12 + date('m') - date('m', $invoiceToTime) - (date('d') < date('d', $invoiceToTime) ? '1' : '0');
        }
        $period['unpayPeriod'] = $unpayPeriod;
    } else {
        if ($lastPaymentDay != '0000-00-00' && !empty($lastPaymentDay)) {
            $payPeriod = (date('Y', $lastToTime) - date('Y', $invoiceToTime)) * 12 + date('m', $lastToTime) - date('m', $invoiceToTime) - (date('d', $lastToTime) < date('d', $invoiceToTime) ? '1' : '0');
        }
        $period['payPeriod'] = $payPeriod;
    }
    $result = $db->autoExecute('zt_contractamount', $period,'update'," `invoiceNum`='$invoiceNum' ");
    if ($result) {
        print("<font color='green'>发票号码：$invoiceNum 更新成功！</font> 未回款周期：$unpayPeriod 回款周期：$payPeriod <br/>");
    } else {
        print("<font color='red'>发票号码：$invoiceNum 更新失败！</font> 未回款周期：$unpayPeriod 回款周期：$payPeriod <br/>");
    }
    return $result;
}
?>