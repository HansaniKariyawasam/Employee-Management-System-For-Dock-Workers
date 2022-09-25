<?php
include "../Connection/connection.php";

$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$status='Employed';

$rows = array();
if ($id AND $name) {
    $sql = 'SELECT e.Emp_ID,e.Name , t.Team_Name,t.Engineer_name,t.eng_telephone,t.eng_email from employee as e  INNER JOIN team as t ON e.Team_No=t.Team_NO WHERE e.Current_status="'.$status.'" AND e.Emp_ID="' . $id . '" AND e.Name LIKE "%' . $name . '%"';
}else if ($id) {
    $sql = 'SELECT e.Emp_ID,e.Name , t.Team_Name,t.Engineer_name,t.eng_telephone,t.eng_email from employee as e  INNER JOIN team as t ON e.Team_No=t.Team_NO WHERE e.Current_status="'.$status.'" AND e.Emp_ID="' . $id . '"';
} else if ($name) {
    $sql = 'SELECT e.Emp_ID,e.Name , t.Team_Name,t.Engineer_name,t.eng_telephone,t.eng_email from employee as e  INNER JOIN team as t ON e.Team_No=t.Team_NO WHERE e.Current_status="'.$status.'" AND e.Name LIKE "%' . $name . '%"';
} else {
    header('Content-Type:application/json');
    echo json_encode($rows);
    return;
}
$result = mysqli_query($connection, $sql);
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

header('Content-Type: application/json');
echo json_encode($rows);