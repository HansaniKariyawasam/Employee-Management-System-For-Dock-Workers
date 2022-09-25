<?php
include "../Connection/connection.php";

//	$connection=mysqli_connect('localhost','root','1702408-Hansani','bpes');

    $q1="select * from salary,Employee where employee.Emp_ID=salary.Emp_ID AND Current_status='Employed' ORDER BY year ASC,employee.Emp_ID ASC ,Month ASC";
    if($connection){
        $result=mysqli_query($connection,$q1);
        if(mysqli_num_rows($result)>0){
            $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

            echo json_encode($rowData);
        }
    }


		mysqli_close($connection);
