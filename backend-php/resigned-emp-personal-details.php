<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-07-09
 * Time: 10:05 AM
 */
include "../Connection/connection.php";

//$status= $_GET['status'];

//	$connection=mysqli_connect('localhost','root','1702408-Hansani','bpes');

$q="select * from employee,team,bank where employee.Emp_ID=bank.Emp_ID and employee.Team_No=team.Team_No AND Current_status='Resigned'";
if($connection){
    $result=mysqli_query($connection,$q);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

        echo json_encode($rowData);
    }
}



mysqli_close($connection);