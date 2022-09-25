<?php
include "../Connection/connection.php";

extract($_POST);

print_r($_POST);

if($connection){
    $deleteQuery="DELETE FROM suspend_attendance WHERE Emp_ID='$empID' AND Date='$date'";
    $result=mysqli_query($connection,$deleteQuery);

    if($deleteQuery){
        $insertQuery="INSERT INTO attendance VALUES('$date','$empID','$checkIn','$checkOut','$NOT','$DOT','$remark')";
        $result1=mysqli_query($connection,$insertQuery);

        if($result1){
//            echo "<script>alert('The attendance is successfully updated')</script>";
//            echo "<script>window.location.replace('../supervisor-modify-attendance.php')</script>";
            echo "Success";
        }
    }
}
mysqli_close($connection);