
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-09-09
 * Time: 10:08 AM
 */

include "../Connection/connection.php";
require('../assets/libs/fpdf/fpdf.php');
include "../assets/libs/fpdf/font/helvetica.php";

session_start();

$lastMonth = Date("Y-m-d", strtotime("first day of previous month"));
$lastMonthName=date('F', strtotime('last month'));
$currentYear=date('Y');

$rows = array();

$name = $_SESSION['Name'];
$query_empID = "SELECT Emp_ID FROM employee WHERE Name='$name'";

$result=mysqli_query($connection,$query_empID);

if(mysqli_num_rows($result)>0) {
    $rowData = mysqli_fetch_all($result, MYSQLI_ASSOC); // Database data array

    $emp_ID = $rowData[0]['Emp_ID'];

    $query_payslip = "SELECT * FROM ( select a.Emp_ID,Basic_salary,
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

    $result_payslip = mysqli_query($connection, $query_payslip);
    while ($r = mysqli_fetch_assoc($result_payslip)) {
        $rows[] = $r;

    }
}

$day_rate=$rows[0]['Basic_salary']/25;

$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);



/* --- Cell --- */
$pdf->SetXY(6, 4);
$pdf->Cell(199, 283, '', 1, 1, 'L', false);
/* --- Text --- */
$pdf->SetFontSize(20);
$pdf->Text(84, 12, 'Pay Slip - '.$lastMonthName);
//$pdf->SetTextColor(255,21,28);
/* --- Line --- */
$pdf->Line(6, 24, 205, 24);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 30, 'Employee No :');
$pdf->SetFontSize(12);
$pdf->Text(45, 30,$rows[0]['Emp_ID'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 40, 'Name             :');
$pdf->SetFontSize(12);
$pdf->Text(45, 40, $_SESSION['Name']);
/* --- Line --- */
$pdf->Line(6, 46, 205, 46);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 52, 'Worked Days');
$pdf->SetFontSize(12);
$pdf->Text(45, 52, $rows[0]['Worked_days']);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 62, 'Leave Days');
$pdf->SetFontSize(12);
$pdf->Text(45, 62, (31-$rows[0]['Worked_days']));
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(107, 52, 'Basic Salary');
$pdf->SetFontSize(12);
$pdf->Text(150, 52, number_format($rows[0]['Basic_salary'],2));
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(107, 62, 'Day Rate');
$pdf->SetFontSize(12);
$pdf->Text(150, 62, number_format(($rows[0]['Basic_salary']/25), 2));

/* --- Cell --- */
$pdf->SetXY(6, 67);
$pdf->Cell(99.5, 100, '', 1, 1, 'L', false);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 75, 'Earnings');
$pdf->SetFontSize(12);
$pdf->Text(88, 75, 'Amount');
/* --- Line --- */
$pdf->Line(6, 80, 205, 80);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 87, 'Worked Weekdays & Saturdays');
$pdf->SetFontSize(12);
$pdf->Text(86, 87,number_format($rows[0]['worked_weekdays_saturdays']*$day_rate ,2));
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 94, 'Worked Sundays');
$pdf->SetFontSize(12);
$pdf->Text(88, 94,number_format($rows[0]['Worked_sundays']*$day_rate,2 ));
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 101, 'Worked Public Holidays');
$pdf->SetFontSize(12);
$pdf->Text(88, 101,number_format($rows[0]['Worked_pubHolidays']*$day_rate,2) );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 108, 'Budgetary Relief Allowance');
$pdf->SetFontSize(12);
$pdf->Text(88, 108,$rows[0]['BRAllowance'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 115, 'Total for EPF & ETF');
$pdf->SetFontSize(12);
$pdf->Text(87, 115,$rows[0]['tot_for_EPFETF'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 122, 'Normal OT Payment');
$pdf->SetFontSize(12);
$pdf->Text(87, 122,$rows[0]['NOT_pay'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 129, 'Double OT Payment');
$pdf->SetFontSize(12);
$pdf->Text(88, 129,$rows[0]['DOT_pay'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 136, 'Other Allowance');
$pdf->SetFontSize(12);
$pdf->Text(87, 136,$rows[0]['Other_llowance'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 159, 'Gross Salary');
$pdf->SetFontSize(12);
$pdf->Text(87, 159,$rows[0]['Net_salary'] );
/* --- Cell --- */
$pdf->SetXY(105, 67);
$pdf->Cell(100, 100, '', 1, 1, 'L', false);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(109, 75, 'Earnings');
$pdf->SetFontSize(12);
$pdf->Text(189, 75, 'Amount');

/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(113, 87, 'Short Leave 01');
$pdf->SetFontSize(12);
$pdf->Text(189, 87,number_format(($day_rate*0.75)*$rows[0]['SL01'] ,2));
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(113, 94, 'Half  Days');
$pdf->SetFontSize(12);
$pdf->Text(189, 94,number_format(($day_rate*0.5)*$rows[0]['Halfday'],2) );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(113, 101, 'Short Leave 02');
$pdf->SetFontSize(12);
$pdf->Text(189, 101,number_format(($day_rate*0.25)*$rows[0]['SL02'],2) );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(113, 108, 'EPF 8%(For Employee Contribution)');
$pdf->SetFontSize(12);
$pdf->Text(189, 108,$rows[0]['EPF_8'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(113, 159, 'Total Deductions');
$pdf->SetFontSize(12);
$pdf->Text(188, 159,number_format(($rows[0]['SL_deduction']+$rows[0]['EPF_8']),2) );
/* --- Line --- */
$pdf->Line(6, 149, 205, 149);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 179, 'EPF 12%');
$pdf->SetFontSize(12);
$pdf->Text(189, 179,$rows[0]['EPF_12'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 189, 'ETF 3%');
$pdf->SetFontSize(12);
$pdf->Text(189, 189,$rows[0]['ETF_3']);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(10, 199, 'Net Salary');
$pdf->SetFontSize(12);
$pdf->Text(187 , 199,$rows[0]['tot_salary'] );
$pdf->SetTitle('B P E S');





$pdf->Output('My Pay Slip.pdf','I');




?>