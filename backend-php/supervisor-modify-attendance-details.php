<?php

include_once "../Connection/connection.php";
extract($_POST);

if (!empty($name) && !empty($NOT) && !empty($DOT) && !empty($date)) {
    echo $name;
    echo $NOT;
    echo $DOT;
    echo $date;

}else{
    echo "Empty";
}

//
//$date=$_POST['date'];
//$date = '';
//if( isset( $_POST['date'])) {
//    $date = $_POST['date'];
//}else{
//    $date="Not Set";
//}
//
//echo $name;
////echo $NOT;
////echo $DOT;
//echo $date;

//if($connection){
//    $query = "UPDATE attendance SET checkIn_Time = '$checkIn', checkOut_Time = '$checkOut',Normal_OT= '$NOT',Double_OT='$DOT' WHERE Emp_ID = '$id' AND Date='$date'";
//    $result = mysqli_query($connection,$query);
//
//    if($result){
////        echo "<script>alert('User has been Successfully modified');</script>";
////        echo "<script>window.location.replace('../supervisor-modify-attendance.php');</script>";
//    }else {
//        echo "<script>alert('Somrthing went wrong');</script>";
//        echo "<script>window.location.replace('../supervisor-modify-attendance.php');</script>";
//    }
//}else{
//    echo "connection is failed";
//}
//mysqli_close($connection);