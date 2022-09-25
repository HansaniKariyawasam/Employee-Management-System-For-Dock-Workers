<?php
include "../Connection/connection.php";

// Delete record from table
if(isset($_GET['Date'])) {
    $date = $_GET['Date'];

    $query = "DELETE FROM holiday WHERE Date = '$date'";

    $result=mysqli_query($connection,$query);

    if ($result) {
//        echo "<script>confirm('Are you sure, you want to remove this Holiday?');</script>";
        echo "<script>window.location.replace('../supervisor-home.php');</script>";
        return true;
    }else{
        return false;
    }
}