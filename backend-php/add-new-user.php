<?php

    include "../Connection/connection.php";

    $Name = $_POST['Name'];
    $Username = $_POST['Username'];
    $Designation = $_POST['Designation'];
    $Password = $_POST['Password'];
    $confirm_Password = $_POST['confirm_Password'];

    if($connection){
        if(!empty($Name) && !empty($Username) && !empty($Designation) && !empty($Password) && !empty($confirm_Password)){
            if($Password==$confirm_Password){
                $password=md5($Password);

                $query = " INSERT INTO user VALUES('$Username','$Name','$password','$Designation','Employed')";
                $result = mysqli_query($connection,$query);

                if($result){
                    echo "<script>alert('User has been Successfully added');</script>";
                    echo "<script>window.location.replace('../admin-add-a-new-user.php');</script>";
                }
            }else{
                echo "<script>alert('Password does not match. Please Check it again!');</script>";
                echo "<script>window.location.replace('../admin-add-a-new-user.php');</script>";
            }
        }
    }else{
        echo "connection is failed";
    }
    mysqli_close($connection);
?>