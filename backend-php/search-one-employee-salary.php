<?php
session_start();

include "../Connection/connection.php";
$monthVal = isset($_GET['from']) ? $_GET['from'] : "";


$name=$_SESSION['Name'];


$rows = array();
if ($monthVal) {
    $sql = 'SELECT Year,Month,Worked_days,Worked_sundays,Worked_pubHolidays,BRAllowance,tot_for_EPFETF,EPF_12,ETF_3,Other_llowance,NOT_pay,DOT_pay,Net_salary,EPF_8,tot_salary FROM bpes.salary s,employee e where s.Emp_ID=e.Emp_ID AND e.name="'.$name.'" AND Month="' . $monthVal . '"';
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