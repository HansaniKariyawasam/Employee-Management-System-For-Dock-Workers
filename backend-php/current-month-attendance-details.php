<?php
include "../Connection/connection.php";

//	$connection=mysqli_connect('localhost','root','1702408-Hansani','bpes');
$currentDate=date('Y-m-d');
$currentYear=date('Y');

$q="SELECT * FROM employee,Attendance WHERE employee.Emp_ID=Attendance.Emp_ID AND MONTH(Date)=MONTH('$currentDate') AND YEAR(Date)='$currentYear' AND Current_status='Employed' ORDER BY Date ASC, employee.Emp_ID  ASC";
if($connection){
    $result=mysqli_query($connection,$q);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

        echo json_encode($rowData);
    }
}


mysqli_close($connection);