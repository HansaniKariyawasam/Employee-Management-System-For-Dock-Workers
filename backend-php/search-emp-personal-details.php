<?php
include "../Connection/connection.php";

$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$status=isset($_GET['status']) ? $_GET['status'] : "";

$rows = array();
if($status==""){
    if($id AND $name){
        $sql = 'SELECT * FROM employee e,bank b,team t WHERE e.Team_No=t.Team_No AND e.Emp_ID=b.Emp_ID  AND e.Emp_ID= "' . $id . ' " AND e.Name LIKE "%' . $name . '%"';
    }else if ($id) {
        $sql = 'SELECT * FROM employee e,bank b,team t WHERE e.Team_No=t.Team_No AND e.Emp_ID=b.Emp_ID AND e.Emp_ID= "' . $id . ' " ';
    } else if ($name) {
        $sql = 'SELECT * FROM employee e,bank b,team t WHERE e.Team_No=t.Team_No AND e.Emp_ID=b.Emp_ID AND e.Name LIKE "%' . $name . '%" ';
    } else {
        header('Content-Type: application/json');
        echo json_encode($rows);
        return;
    }
}else{
    if($id AND $name){
        $sql = 'SELECT * FROM employee e,bank b,team t WHERE e.Team_No=t.Team_No AND e.Emp_ID=b.Emp_ID  AND e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND e.Name LIKE "%' . $name . '%"';
    }else if ($id) {
        $sql = 'SELECT * FROM employee e,bank b,team t WHERE e.Team_No=t.Team_No AND e.Emp_ID=b.Emp_ID AND e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " ';
    } else if ($name) {
        $sql = 'SELECT * FROM employee e,bank b,team t WHERE e.Team_No=t.Team_No AND e.Emp_ID=b.Emp_ID AND  e.Current_status="'.$status.'" AND e.Name LIKE "%' . $name . '%" ';
    } else {
        header('Content-Type: application/json');
        echo json_encode($rows);
        return;
    }
}




$result = mysqli_query($connection, $sql);
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

header('Content-Type: application/json');
echo json_encode($rows);