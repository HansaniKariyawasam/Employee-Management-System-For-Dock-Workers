<?php
include "../Connection/connection.php";

// Delete record from table
if(isset($_GET['username']) && !empty($_GET['username'])) {
    $username = $_GET['username'];

    $query = "DELETE FROM user WHERE Username = '$username'";

    $result=mysqli_query($connection,$query);

    if ($result) {
//        echo "<script>confirm('Are you sure, you want to remove this user?');</script>";
        echo "<script>window.location.replace('../admin-remove-a-user.php');</script>";
        return true;
    }else{
        return false;
    }
}

