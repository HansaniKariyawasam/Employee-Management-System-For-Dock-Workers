<?php
include "../Connection/connection.php";

$year=$_POST['val'];

if($connection) {
    $Jan = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3' FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='January' AND  s.Year='$year' ");
    $Feb = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='February' AND  s.Year='$year' ");
    $Mar = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='March' AND  s.Year='$year' ");
    $Apr = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='April' AND  s.Year='$year' ");
    $May = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='May' AND  s.Year='$year' ");
    $Jun = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='June' AND  s.Year='$year' ");
    $Jul = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='July' AND  s.Year='$year' ");
    $Aug = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='August' AND  s.Year='$year' ");
    $Sep = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='September' AND  s.Year='$year' ");
    $Oct = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='October' AND  s.Year='$year' ");
    $Nov = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='November' AND  s.Year='$year' ");
    $Dec = mysqli_query($connection, "SELECT (SUM(EPF_12)+SUM(EPF_8)) as 'EPF_12',SUM(ETF_3) as 'ETF_3'  FROM salary s, employee e WHERE s.Emp_ID=e.Emp_ID AND Month='December' AND  s.Year='$year' ");


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