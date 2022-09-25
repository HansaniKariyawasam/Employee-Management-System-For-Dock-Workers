<?php
include "../Connection/connection.php";

//	$connection=mysqli_connect('localhost','root','1702408-Hansani','bpes');

$q="SELECT * FROM employee,team WHERE employee.Team_No=team.Team_No AND Current_status='Employed'";
if($connection){
    $result=mysqli_query($connection,$q);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);
//        echo date('Y-m-d', strtotime('last day of this month'));

        echo json_encode($rowData);
    }
}


mysqli_close($connection);