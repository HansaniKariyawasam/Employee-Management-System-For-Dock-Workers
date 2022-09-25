<?php
include "../Connection/connection.php";
session_start();

$lastMonth = Date("Y-m-d", strtotime("first day of previous month"));
$currentYear=date('Y');

$name = $_SESSION['Name'];
$rows = array();

if($connection){
    $query_empID = "SELECT Emp_ID FROM employee WHERE Name='$name'";

    $result=mysqli_query($connection,$query_empID);

    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC); // Database data array

            $emp_ID=$rowData[0]['Emp_ID'];

//            $query_attendance="select a.Emp_ID,Basic_salary,
//                                sum(Normal_OT) as 'NOT',
//                                sum(Double_OT) as 'DOT',
//                                COUNT(IF(Remark='SL01',1,NULL)) 'SL01' ,
//                                COUNT(IF(Remark='Halfday',1,NULL)) 'Halfday',
//                                COUNT(IF(Remark='SL02',1,NULL)) 'SL02'
//                                from attendance a,employee e
//                                where Month(date)=Month('$lastMonth') AND
//                                a.Emp_ID=e.Emp_ID AND e.Name='$name'
//                                GROUP BY e.Emp_ID";
//
//            $result_att=mysqli_query($connection,$query_attendance);
//            $query_salary="SELECT Worked_days,worked_weekdays_saturdays,Worked_sundays,Worked_pubHolidays,BRAllowance,tot_for_EPFETF,EPF_12,ETF_3,Other_llowance,DOT_pay,NOT_pay,Net_salary,EPF_8,SL_deduction,tot_salary FROM salary WHERE salary.Year=YEAR(CURDATE()) AND salary.Month=MONTHNAME('$lastMonth') AND Emp_ID=$emp_ID";
//            $result_salary=mysqli_query($connection,$query_salary);
//
//            $r1=mysqli_fetch_all($result_att,MYSQLI_ASSOC);
//            $r2=mysqli_fetch_all($result_salary,MYSQLI_ASSOC);
//
//            array_push($rows,array_merge_recursive($r1[0],$r2[0]));

        $query_payslip="SELECT * FROM ( select a.Emp_ID,Basic_salary,
                        sum(Normal_OT) as 'NOT',
                        sum(Double_OT) as 'DOT',
                        COUNT(IF(Remark='SL01',1,NULL)) 'SL01' ,
                        COUNT(IF(Remark='Halfday',1,NULL)) 'Halfday',
                        COUNT(IF(Remark='SL02',1,NULL)) 'SL02'
                        from attendance a,employee e
                        where Month(date)=Month('$lastMonth' ) AND YEAR(date)=YEAR('$lastMonth') AND
                        a.Emp_ID=e.Emp_ID AND e.Name='$name' GROUP BY e.Emp_ID) AS A
                        JOIN ( SELECT * FROM salary WHERE salary.Year=YEAR('$lastMonth') AND salary.Month=MONTHNAME('$lastMonth') AND Emp_ID='$emp_ID') AS B
                        ON A.Emp_ID=B.Emp_ID";

        $result_payslip=mysqli_query($connection,$query_payslip);
//        $rowData=mysqli_fetch_all($result_payslip,MYSQLI_ASSOC);
//
//        echo json_encode($rows);

        while ($r = mysqli_fetch_assoc($result_payslip)) {
            $rows[] = $r;

        }
        echo json_encode($rows);
//        if(mysqli_num_rows($result_payslip)>0){
//            $data=mysqli_fetch_all($result_payslip,MYSQLI_ASSOC);
//
//            $rows=$data;
//
//            while ($r = mysqli_fetch_assoc($result)) {
//                $rows[] = $r;
//            }
//
//            echo json_encode($rows);
//        }
    }
}