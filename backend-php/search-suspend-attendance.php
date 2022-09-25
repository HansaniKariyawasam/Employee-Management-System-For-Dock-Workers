<?php
include "../Connection/connection.php";

$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$from = isset($_GET['from']) ? $_GET['from'] : "";
$to = isset($_GET['to']) ? $_GET['to'] : "";
$status='Employed';

$rows = array();
if($from AND $to AND $id){
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where date>="' . $from . '" AND e.Name LIKE "%' . $name . '%"  AND date<="' . $to . '" AND e.Emp_ID="' . $id . '" AND e.Current_status="'.$status.'"';
}else if($from AND $to AND $id){
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where date>="' . $from . '" AND date<="' . $to . '" AND e.Emp_ID="' . $id . '" AND e.Current_status="'.$status.'"';
}else if ($from AND $to AND $name) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where date>="' . $from . '" AND date<="' . $to . '" AND e.Name LIKE "%' . $name . '%"  AND e.Current_status="'.$status.'"';
} else if ( $id AND $name) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where e.Emp_ID="' . $id . '" AND e.Name LIKE "%' . $name . '%"  AND e.Current_status="'.$status.'"';
}else if ( $from AND $to) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where date>="' . $from . '" AND date<="' . $to . '" AND e.Current_status="'.$status.'"';
} else if ($from) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where date="' . $from . '" AND e.Current_status="'.$status.'"';
} else if ($from AND $id) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where date="' . $from . '" AND e.Emp_ID="' . $id . '" AND e.Current_status="'.$status.'"';
} else if ($from AND $name) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where date="' . $from . '" AND e.Name LIKE "%' . $name . '%" AND e.Current_status="'.$status.'" ';
}else if ($id) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where e.Emp_ID="' . $id . '" AND e.Current_status="'.$status.'"';
} else if ($name) {
    $sql = 'SELECT e.Emp_ID, e.Name, a.Date,a.Remark, a.checkIn_Time ,a.checkOut_Time ,a.Normal_OT,a.Double_OT FROM employee AS e INNER JOIN suspend_attendance AS a ON e.Emp_ID = a.Emp_ID where e.Name LIKE "%' . $name . '%"  AND e.Current_status="'.$status.'"';
} else {
    header('Content-Type: application/json');
    echo json_encode($rows);
    return;
}
$result = mysqli_query($connection, $sql);
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

header('Content-Type: application/json');
echo json_encode($rows);