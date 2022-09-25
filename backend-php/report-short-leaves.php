<?php
include "../Connection/connection.php";

$year=$_POST['val'];
$id=$_POST['id'];

if($connection) {
    $Jan = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-01-01') and CONCAT('$year','-01-31')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Feb = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-02-01') and CONCAT('$year','-02-28')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Mar = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-03-01') and CONCAT('$year','-03-31')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Apr = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-04-01') and CONCAT('$year','-04-30')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $May = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-05-01') and CONCAT('$year','-05-31')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Jun = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-06-01') and CONCAT('$year','-06-30')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Jul = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-07-01') and CONCAT('$year','-07-31')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Aug = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-08-01') and CONCAT('$year','-08-31')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Sep = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-09-01') and CONCAT('$year','-09-30')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Oct = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date)between CONCAT('$year','-10-01') and CONCAT('$year','-10-31')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Nov = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-11-01') and CONCAT('$year','-11-30')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");
    $Dec = mysqli_query($connection, "SELECT COUNT(Date) as 'SL' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-12-01') and CONCAT('$year','-12-31')) AND e.Emp_ID='$id' AND a.Remark IN ('SL01','Halfday','SL02')");


    $Jan = mysqli_fetch_all($Jan);
    $Feb = mysqli_fetch_all($Feb);
    $Mar = mysqli_fetch_all($Mar);
    $Apr = mysqli_fetch_all($Apr);
    $May = mysqli_fetch_all($May);
    $Jun = mysqli_fetch_all($Jun);
    $Jul = mysqli_fetch_all($Jul);
    $Aug = mysqli_fetch_all($Aug);
    $Sep = mysqli_fetch_all($Sep);
    $Oct = mysqli_fetch_all($Oct);
    $Nov = mysqli_fetch_all($Nov);
    $Dec = mysqli_fetch_all($Dec);

    echo json_encode([$Jan, $Feb, $Mar, $Apr, $May, $Jun, $Jul, $Aug, $Sep, $Oct, $Nov, $Dec]);
}