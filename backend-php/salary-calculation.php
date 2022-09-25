<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-07-22
 * Time: 6:13 PM
 */

include "../Connection/connection.php";
include "../my-class/Allowance.php";

extract($_POST);

$currentDate=date('Y-m-d');
$currentMonth=date('F');
$currentYear=date('Y');
$no_of_days=25; //one person work 25 days per month (labour rule)
$no_of_hours=200; // one person normally work 8 hrs per day and work 25 days per month. Then 25 x 8 = 200 (labour rule)
$salaryArray=array();

$allowanceObj=new Allowance();

if($connection){
    $searchQuery="SELECT a.Emp_ID,Name,Basic_salary,COUNT(date) AS 'Worked_days',SUM(Normal_OT) AS 'NOT',SUM(Double_OT) AS 'DOT', COUNT(IF(Remark='Sunday',1,NULL)) 'Worked_sunday',COUNT(IF(Remark='Holiday',1,NULL)) 'Worked_holiday',COUNT(IF(Remark!='Sunday' AND Remark!='Holiday',1,NULL)) 'Worked_day_sat',COUNT(IF(Remark='SL01',1,NULL)) 'SL01' ,COUNT(IF(Remark='Halfday',1,NULL)) 'Halfday',COUNT(IF(Remark='SL02',1,NULL)) 'SL02' FROM attendance a,employee e WHERE MONTH(date)=MONTH('$currentDate') AND a.Emp_ID=e.Emp_ID AND Year(date)='$currentYear' AND Current_status='Employed' GROUP BY emp_id ";

    $searchResult=mysqli_query($connection,$searchQuery);

    if(mysqli_num_rows($searchResult)>0){
        $rowData=mysqli_fetch_all($searchResult,MYSQLI_ASSOC);

        for ($row=0 ; $row<count($rowData); $row++){
            $basic_salary=$rowData[$row]['Basic_salary'];
            $day_rate=($basic_salary/$no_of_days);

            $days=$rowData[$row]['Worked_days'];
            $worked_day_sat=$rowData[$row]['Worked_day_sat'];
            $NOT=$rowData[$row]['NOT'];
            $DOT=$rowData[$row]['DOT'];
            $worked_sunday=$rowData[$row]['Worked_sunday'];
            $worked_holiday=$rowData[$row]['Worked_holiday'];
            $BRA=(float)($allowanceObj->getBRAAllowance($days));

            $tot_for_ETFEPF=(float)(($worked_day_sat*$day_rate)+($worked_sunday*1.5*$day_rate)+($worked_holiday*$day_rate)+$BRA);
            $EPF_12=(float)($tot_for_ETFEPF*0.12);
            $ETF_3=(float)($tot_for_ETFEPF*0.03);

            $NOT_pay=(float)((($basic_salary/$no_of_hours)*1.5)*$NOT);
            $DOT_pay=(float)((($basic_salary/$no_of_hours)*2)*$DOT);
            $other_allowance=(float)($allowanceObj->getOtherAllowance($days));

            $net_salary=(float)($tot_for_ETFEPF+$NOT_pay+$DOT_pay+$other_allowance);

            //Salary Deductions Calculation
            $EPF_8=(float)($tot_for_ETFEPF*0.08);
            $SL01=(float)(($day_rate*0.75)*$rowData[$row]['SL01']);
            $halfday=(float)(($day_rate*0.5)*$rowData[$row]['Halfday']);
            $SL02=(float)(($day_rate*0.25)*$rowData[$row]['SL02']);
            $SL_deduction=(float)($SL01+$halfday+$SL02);

            $tot_salary=(float)($net_salary-($EPF_8+$SL_deduction)); // The final salary of the employee

            $salaryArray[$row]['Emp_ID']=$rowData[$row]['Emp_ID'];
            $salaryArray[$row]['Name']=$rowData[$row]['Name'];
            $salaryArray[$row]['Month']=$currentMonth;
//            $salaryArray[$row]['Month']='March';
            $salaryArray[$row]['worked_days']=$days;
            $salaryArray[$row]['worked_day_sat']=$worked_day_sat;
            $salaryArray[$row]['worked_sundays']=$worked_sunday;
            $salaryArray[$row]['worked_holidays']=$worked_holiday;
            $salaryArray[$row]['BRAAllowance']=number_format($BRA,2,'.','');
            $salaryArray[$row]['tot_for_EPFETF']=number_format($tot_for_ETFEPF,2,'.','');
            $salaryArray[$row]['EPF_12']=number_format($EPF_12,2,'.','');
            $salaryArray[$row]['ETF_3']=number_format($ETF_3,2,'.','');
            $salaryArray[$row]['other_allowance']=number_format($other_allowance,2,'.','');
            $salaryArray[$row]['DOT_pay']=number_format($DOT_pay,2,'.','');
            $salaryArray[$row]['NOT_pay']=number_format($NOT_pay,2,'.','');
            $salaryArray[$row]['net_salary']=number_format($net_salary,2,'.','');
            $salaryArray[$row]['EPF_8']=number_format($EPF_8,2,'.','');
            $salaryArray[$row]['SL_deduction']=number_format($SL_deduction,2,'.','');
            $salaryArray[$row]['tot_salary']=number_format($tot_salary,2,'.','');




        }
    }
    if(isset($calculate)){
        for($r=0 ; $r<count($salaryArray);$r++){
            $Emp_ID=$salaryArray[$r]['Emp_ID'];
            $month=$salaryArray[$r]['Month'];
            $worked_days=$salaryArray[$r]['worked_days'];
            $worked_day_sat=$salaryArray[$r]['worked_day_sat'];
            $worked_sunday=$salaryArray[$r]['worked_sundays'];
            $worked_holiday=$salaryArray[$r]['worked_holidays'];
            $BRA=$salaryArray[$r]['BRAAllowance'];
            $tot_for_ETFEPF=$salaryArray[$r]['tot_for_EPFETF'];
            $EPF_12=$salaryArray[$r]['EPF_12'];
            $ETF_3=$salaryArray[$r]['ETF_3'];
            $other_allowance=$salaryArray[$r]['other_allowance'];
            $DOT_pay=$salaryArray[$r]['DOT_pay'];
            $NOT_pay=$salaryArray[$r]['NOT_pay'];
            $net_salary=$salaryArray[$r]['net_salary'];
            $EPF_8=$salaryArray[$r]['EPF_8'];
            $SL_deduction=$salaryArray[$r]['SL_deduction'];
            $tot_salary=$salaryArray[$r]['tot_salary'];


            $insertSalary="INSERT INTO salary VALUES($Emp_ID,$currentYear,'$month',$worked_days,$worked_day_sat,$worked_sunday,$worked_holiday,$BRA,$tot_for_ETFEPF,$EPF_12,$ETF_3,$other_allowance,$DOT_pay,$NOT_pay,$net_salary,$EPF_8,$SL_deduction,$tot_salary)";

            $insertResult=mysqli_query($connection,$insertSalary);

            if($insertResult){
//                echo mysqli_error($connection);
                echo "<script>alert('Successfully save the salary details')</script>";
                echo "<script>window.location.replace('../hr-emp-salary-details.php')</script>";
            }else{
//                echo $month;
                echo "<script>alert('The salary details has been already saved')</script>";
                echo "<script>window.location.replace('../hr-home.php')</script>";
//                echo mysqli_error($connection);
            }

        }

    }else{


            echo json_encode($salaryArray);
//         print_r($salaryArray);


    }




}