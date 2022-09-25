<?php
include "../Connection/connection.php";

//	$connection=mysqli_connect('localhost','root','1702408-Hansani','bpes');
$currentDate=date('Y-m-d');

//$q="SELECT * FROM suspend_attendance,employee WHERE employee.Emp_ID=suspend_attendance.Emp_ID AND MONTH(Date)=MONTH('$currentDate')  AND Current_status='Employed'";
$q="SELECT * FROM suspend_attendance,employee WHERE employee.Emp_ID=suspend_attendance.Emp_ID AND Current_status='Employed'";
if($connection){
    $result=mysqli_query($connection,$q);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

        echo json_encode($rowData);
    }
}


mysqli_close($connection);