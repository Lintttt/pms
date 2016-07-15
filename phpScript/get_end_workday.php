<?php

function get_end_workday($start, $days, $db) {
    $end = date('Y-m-d', strtotime("+$days day", strtotime($start)));
    $holidays = $db->getRows("select * from zt_holiday where date>$start and date<=$end");
    if (count($holidays) >= 1) {
        $end_date = get_end_workday($end, count($holidays));
    } else {
        $end_date = $end;
    }
    return $end_date;
}

?>