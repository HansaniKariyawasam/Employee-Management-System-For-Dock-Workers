<?php
include "../Connection/connection.php";

//	$connection=mysqli_connect('localhost','root','1702408-Hansani','bpes');

$q="SELECT * FROM user WHERE Designation !='Employee' AND Designation !='Admin'";
if($connection){
    $result=mysqli_query($connection,$q);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

        echo json_encode($rowData);
    }
}


mysqli_close($connection);
