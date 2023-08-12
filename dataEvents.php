<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
include './condb.php'; 

$json_data= array();

$q ="SELECT * FROM tb_train where action <> 'TrainOut' ORDER by id";


$result = $conn->query($q);

while ($rs = $result->fetch_object()) {
    if ($rs->action == '') {
        $color = 'fc-event-primary';
    }

    if ($rs->action == 'plan' && ($rs->reg_end) < date("Y-m-d")) {
        $color = 'fc-event-success';
    } elseif ($rs->action == 'plan' && ($rs->reg_end) > date("Y-m-d")) {
        $color = 'fc-event-light fc-event-solid-success';
    }

    if ($rs->action == 'cop' && ($rs->reg_end) < date("Y-m-d")) {
        $color = 'fc-event-warning';
    } elseif ($rs->action == 'cop' && ($rs->reg_end) > date("Y-m-d")) {
        $color = 'fc-event-light fc-event-solid-warning';
    }

    if ($rs->action == 'intran' && ($rs->reg_end) < date("Y-m-d")) {
        $color = 'fc-event-primary';
    } elseif ($rs->action == 'intran' && ($rs->reg_end) > date("Y-m-d")) {
        $color = 'fc-event-light fc-event-solid-primary';
    }

//$start_date = date("Y-m-d", strtotime($rs->booking_start_date));
//$end_date = date("Y-m-d", strtotime($rs->booking_end_date)); 

    $json_data[] = [
                        'id' => $rs->id,
                        'title' => $rs->title,
                        'start' => $rs->start_date,
                        'end' => $rs->end_date,
                        'description' => $rs->title.' เวลา : '.substr($rs->start_date, 10, 6).' ถึง '.substr($rs->end_date, 10, 6),
                        'url' => '?menu=ShowTrain&id=' . $rs->id,
                        'className' => $color,
    ];
    
}
 $json = json_encode($json_data);
 echo $json;