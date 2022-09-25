<?php
session_start();

include "../Connection/connection.php";
$post_at = isset($_GET['from']) ? $_GET['from'] : "";
$post_at_to_date = isset($_GET['to']) ? $_GET['to'] : "";
$name=$_SESSION['Name'];


$rows = array();
if ($post_at && $post_at_to_date) {
    $sql = 'SELECT Date,Remark, checkIn_Time ,checkOut_Time ,Normal_OT,Double_OT,Remark FROM  attendance a,employee e where a.Emp_ID=e.Emp_ID AND e.name="'.$name.'" AND date>="' . $post_at . '" AND date<="' . $post_at_to_date . '"';
}elseif ($post_at){
    $sql = 'SELECT Date, checkIn_Time ,checkOut_Time ,Normal_OT,Double_OT,Remark FROM  attendance a,employee e where a.Emp_ID=e.Emp_ID AND e.name="'.$name.'" AND date>="' . $post_at . '"';
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