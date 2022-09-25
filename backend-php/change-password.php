<?php
include "../Connection/connection.php";

session_start();
extract($_POST);

$designation=$_SESSION['Designation'];

if($connection){
    $usernameQuery="SELECT * FROM User WHERE Username='$Username'";

    $result=mysqli_query($connection,$usernameQuery);
    $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);



    if(!empty($rowData)){

        $checkPassQuery="SELECT * FROM User WHERE Password='$current_Password'";
        $result=mysqli_query($connection,$checkPassQuery);
        $rowPassword=mysqli_fetch_all($result,MYSQLI_ASSOC);
        if(!empty($rowPassword)){
            if($new_Password===$confirm_Password){
                $new_Password=md5($new_Password);
                $passwordQuery="UPDATE User SET Password='$new_Password' WHERE Username='$Username'";
                $result=mysqli_query($connection,$passwordQuery);
                if($result){
                    echo "<script>alert('Your password has been successfully updated');</script>";
                    if ($designation == "HR") {
                        echo "<script>window.location.replace('../hr-password-change.php')</script>";

                    } elseif ($designation == "MD") {
                        echo "<script>window.location.replace('../md-password-change.php')</script>";

                    } elseif ($designation == "Employee") {
                        echo "<script>window.location.replace('../employee-password-change.php')</script>";

                    } elseif ($designation == "Supervisor") {
                        echo "<script>window.location.replace('../supervisor-password-change.php')</script>";
                    }


                }else{
                    echo mysqli_error($connection);
                }
            }else{
                echo "<script>alert('Password does not match. Please check again!');</script>";
                if ($designation == "HR") {
                    echo "<script>window.location.replace('../hr-password-change.php')</script>";

                } elseif ($designation == "MD") {
                    echo "<script>window.location.replace('../md-password-change.php')</script>";

                } elseif ($designation == "Employee") {
                    echo "<script>window.location.replace('../employee-password-change.php')</script>";

                } elseif ($designation == "Supervisor") {
                    echo "<script>window.location.replace('../supervisor-password-change.php')</script>";
                }
            }
        }else{
            echo "<script>alert('The Current Password is wrong. Please check again!');</script>";
            if ($designation == "HR") {
                echo "<script>window.location.replace('../hr-password-change.php')</script>";

            } elseif ($designation == "MD") {
                echo "<script>window.location.replace('../md-password-change.php')</script>";

            } elseif ($designation == "Employee") {
                echo "<script>window.location.replace('../employee-password-change.php')</script>";

            } elseif ($designation == "Supervisor") {
                echo "<script>window.location.replace('../supervisor-password-change.php')</script>";
            }
        }



    }else{
        echo "<script>alert('Your username is incorrect. Please check again!');</script>";
        if ($designation == "HR") {
            echo "<script>window.location.replace('../hr-password-change.php')</script>";

        } elseif ($designation == "MD") {
            echo "<script>window.location.replace('../md-password-change.php')</script>";

        } elseif ($designation == "Employee") {
            echo "<script>window.location.replace('../employee-password-change.php')</script>";

        } elseif ($designation == "Supervisor") {
            echo "<script>window.location.replace('../supervisor-password-change.php')</script>";
        }
    }
}