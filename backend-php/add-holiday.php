<?php
include "../Connection/connection.php";

extract($_POST);

if ($connection){
    $query="INSERT INTO holiday VALUES('$date','$holiday')";

    $result=mysqli_query($connection,$query);

    if($result){
        echo "<script>window.location.replace('../supervisor-home.php')</script>";
    }
}