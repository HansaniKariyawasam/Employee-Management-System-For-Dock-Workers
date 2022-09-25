<?php
include "../Connection/connection.php";

//	$connection=mysqli_connect('localhost','root','1702408-Hansani','bpes');
$current_year=date('Y-m-d');
$q="SELECT * FROM holiday WHERE YEAR(date) = YEAR('$current_year')";
if($connection){
    $result=mysqli_query($connection,$q);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

        echo json_encode($rowData);
    }
}


mysqli_close($connection);