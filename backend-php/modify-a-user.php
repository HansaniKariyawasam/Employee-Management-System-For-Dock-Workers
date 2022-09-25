<?php
include "../Connection/connection.php";

$Name = $_POST['Name'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$confirm_Password = $_POST['confirm_Password'];

// Edit record from table
if(isset($_POST['update'])) {
    if($Password==$confirm_Password){
        $password=md5($Password);

        $query = " UPDATE User SET Password='$password' WHERE Username='$Username'";
        $result = mysqli_query($connection,$query);

        if($result){
            echo "<script>alert('User has been Successfully updated');</script>";
            echo "<script>window.location.replace('../admin-modify-user.php');</script>";
        }
    }else{
        echo "<script>alert('Password does not match. Please Check it again!');</script>";
        echo "<script>window.location.replace('../admin-modify-user.php');</script>";
    }
}

