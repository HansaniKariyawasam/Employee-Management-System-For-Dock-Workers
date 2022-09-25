<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-07-24
 * Time: 3:06 PM
 */

include "../Connection/connection.php";

$currenYear=date('Y'); // year in 4 digit Ex:2021
$currentMonth=date('M'); // short name of month
$currentMonthName=date('F'); // full name of month

$year=date('y'); //A two digit representation of a year Ex: 21
$month=strtoupper(date('m'))  ; //A numeric representation of a month
$day=date('d'); //The day of the month

$reference="SAL".$currentMonth."".$currenYear;
$date=$year."".$month."".$day;

$finalArray=array();
$array=array();
$array['Reference']=$reference;
$array['Date']=$date;

if($connection){
    $query="SELECT Bank_code, Branch_code,Acc_no,Name,tot_salary,Month FROM Bank b, Employee e, Salary s WHERE Month='$currentMonthName' AND Year='$currenYear' AND  e.Emp_ID=b.Emp_ID AND e.Emp_ID=s.Emp_ID";

    $result=mysqli_query($connection,$query);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

        for ($row=0 ; $row<count($rowData); $row++){
            if(!empty($rowData)){
                array_push($finalArray,array_merge_recursive($rowData[$row],$array));
            }
        }
    }
    echo json_encode($finalArray);
}
mysqli_close($connection);