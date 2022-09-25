<?php
include "../Connection/connection.php";
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$month = isset($_GET['month']) ? $_GET['month'] : "";
$year = isset($_GET['year']) ? $_GET['year'] : "";
$status='Employed';


$rows = array();
if ($id AND $name AND $month AND $year) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where  e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND e.Name LIKE "%' . $name . '%" AND s.month = "' . $month . '" AND s.year = "' . $year . '" ORDER BY year ASC,e.Emp_ID ASC ';
} else if ( $month AND $year AND $id) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND s.month = "' . $month . '" AND s.year = "' . $year . '" ORDER BY year ASC,e.Emp_ID ASC  ';
} else if ( $month AND $year AND $name) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND s.month = "' . $month . '" AND s.year = "' . $year . '" ORDER BY year ASC,e.Emp_ID ASC  ';
} else if ( $year AND $month) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND s.month = "' . $month . '" AND s.year = "' . $year . '" ORDER BY year ASC,e.Emp_ID ASC  ';
} else if ( $year AND $id) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND s.year = "' . $year . '" ORDER BY year ASC,e.Emp_ID ASC  ';
} else if ( $year AND $name) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND s.year = "' . $year . '" ORDER BY year ASC,e.Emp_ID ASC  ';
}else if ( $month AND $id) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND s.month = "' . $month . '" ORDER BY year ASC,e.Emp_ID ASC  ';
} else if ( $month AND $name) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " AND s.month = "' . $month . '" ORDER BY year ASC,e.Emp_ID ASC  ';
}else if ($id) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID= "' . $id . ' " ORDER BY year ASC,e.Emp_ID ASC  ';
}else if ($name) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND e.Name LIKE "%' . $name . '%" ORDER BY year ASC,e.Emp_ID ASC ';
}else if ($year) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND s.year = "' . $year . '" ORDER BY year ASC,e.Emp_ID ASC ';
}else if ($month) {
    $sql = 'SELECT e.Emp_ID,e.Name,s.Year,s.Month,s.Worked_days,s.Worked_sundays,s.Worked_pubHolidays,s.BRAllowance,s.tot_for_EPFETF,s.EPF_12,s.ETF_3,s.Other_llowance,s.NOT_pay,s.DOT_pay,s.Net_salary,s.EPF_8,s.tot_salary From employee as e INNER JOIN salary as s ON e.Emp_ID=s.Emp_ID where e.Current_status="'.$status.'" AND s.month = "' . $month . '"  ORDER BY year ASC,e.Emp_ID ASC ';
} else {
    header('Content-Type: application/json');
    echo "<script>alert('Not found');</script>";
    echo json_encode($rows);
    return;
}

$result = mysqli_query($connection, $sql);
while ($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

header('Content-Type: application/json');
echo json_encode($rows);