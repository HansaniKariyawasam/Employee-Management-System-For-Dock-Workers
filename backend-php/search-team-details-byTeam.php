<?php
include "../Connection/connection.php";
$teamVal = isset($_GET['team']) ? $_GET['team'] : "";



$rows = array();
if ($teamVal) {
    $sql = 'SELECT e.Emp_ID,e.Name , t.Team_Name,t.Engineer_name,t.eng_telephone,t.eng_email from employee as e  INNER JOIN team as t ON e.Team_No=t.Team_NO where t.Team_Name="' . $teamVal . '"';
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