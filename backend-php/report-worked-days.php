<?php
include "../Connection/connection.php";

$year=$_POST['val'];
$id=$_POST['id'];

if($connection) {
    $Jan = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-01-01') and CONCAT('$year','-01-31')) AND e.Emp_ID='$id' ");
    $Feb = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-02-01') and CONCAT('$year','-02-28')) AND e.Emp_ID='$id'");
    $Mar = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-03-01') and CONCAT('$year','-03-31')) AND e.Emp_ID='$id'");
    $Apr = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-04-01') and CONCAT('$year','-04-30')) AND e.Emp_ID='$id'");
    $May = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-05-01') and CONCAT('$year','-05-31')) AND e.Emp_ID='$id'");
    $Jun = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-06-01') and CONCAT('$year','-06-30')) AND e.Emp_ID='$id'");
    $Jul = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-07-01') and CONCAT('$year','-07-31')) AND e.Emp_ID='$id'");
    $Aug = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-08-01') and CONCAT('$year','-08-31')) AND e.Emp_ID='$id'");
    $Sep = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-09-01') and CONCAT('$year','-09-30')) AND e.Emp_ID='$id'");
    $Oct = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date)between CONCAT('$year','-10-01') and CONCAT('$year','-10-31')) AND e.Emp_ID='$id'");
    $Nov = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-11-01') and CONCAT('$year','-11-30')) AND e.Emp_ID='$id'");
    $Dec = mysqli_query($connection, "SELECT COUNT(Date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('$year','-12-01') and CONCAT('$year','-12-31')) AND e.Emp_ID='$id'");


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