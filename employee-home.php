<?php
include "employee-header.php";
?>
<style>
    table,
    th,
    td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">My Pay Slip of <?php echo date('F', strtotime('last month'));?> Month</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="employee-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pay Slip</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
<!--                            <p class="text-left" for="date" style="padding: 5px;color: red;font-size: 15px"><b>- Pay Slip of --><?php //echo date('F', strtotime('last month'));?><!-- <Month></Month>  -</b></p>-->


                            <div id="content">


                                <table style="width:100%" id="tblPaySlip">
                                    <tr style="background-color: #47b6c0">
                                        <th colspan="1" style="text-align: center;font-size: 15px"><img src="assets/images/logo.png"></th>
                                        <th colspan="9" style="font-size: 18px">BPES - Power Engineering Service <br> No 13/A,<br> Circular Road,<br> Colombo 02</th>
                                    </tr>
                                    <tr>
                                        <th colspan="10" style="text-align: center;color: #c04a4e;font-size: 19px"><?php echo date('F', strtotime('last month'));?></th>

                                    </tr>
                                    <tr>
<!--                                        <th colspan="1">Employee ID</th>-->
<!--                                        <td colspan="2">1</td>-->
                                        <th colspan="2">Name</th>
                                        <td colspan="8"><?php echo $_SESSION['Name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th  colspan="2" rowspan="2">Worked Days</th>
                                        <td  colspan="1" rowspan="2"></td>
                                        <th  colspan="2" rowspan="2">Leave Days</th>
                                        <td  colspan="1" rowspan="2"></td>
                                        <th  colspan="2">Assigned Basic</th>
                                        <td  colspan="2" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Day Rate (Your Basic / 25 days)</th>
                                        <td colspan="2" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" style="text-align: center">Earnings</th>
                                        <th colspan="2" style="text-align: center">Amount</th>
                                        <th colspan="3" style="text-align: center">Deductions</th>
                                        <th colspan="2" style="text-align: center">Amount</th>

                                    </tr>
                                    <tr>
                                        <th colspan="3">Worked Weekdays & Saturdays</th>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: right"></td>
                                        <th colspan="3">Short Leave Type 01(SL01)</th>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Worked Sundays</th>
                                        <td style="text-align: center"></td>
                                        <td  style="text-align: right"></td>
                                        <th colspan="3">Half Days</th>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Worked Public Holidays</th>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: right"></td>
                                        <th colspan="3">Short Leave Type 02(SL02)</th>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Budgetary Relief Allowance</th>
                                        <td colspan="2" style="text-align: right"></td>
                                        <th colspan="3">EPF 8%(For Employee Contribution)</th>
                                        <td colspan="2" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Total for EPF & ETF</th>
                                        <td colspan="2" style="text-align: right"></td>
                                        <th colspan="5" rowspan="4"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Normal OT Payment</th>
                                        <td colspan="2" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Double OT Payment</th>
                                        <td colspan="2" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Other Allowance (Attendance + Travelling)</th>
                                        <td colspan="2" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Gross Salary</th>
                                        <td colspan="2" style="text-align: right"></td>
                                        <th colspan="3">Total Deductions</th>
                                        <td colspan="2" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">EPF 12%</th>
                                        <td colspan="8" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">EPF 3%</th>
                                        <td colspan="8" style="text-align: right"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Net Salary</th>
                                        <td colspan="8" style="text-align: right"></td>
                                    </tr>



                                </table>
                            </div>
                            <div id="editor"></div>
                            <form method="post" action="employee-home.php">
                                <div style="padding: 50px">
                                    <button name="pdf" id="btnDownload"  type="submit" class="btn btn-info" style="margin-left: 20px;float:right;"><a target="_blank" href="pdf-generators/monthly-payslip.php" style="color: white;" onmouseover="this.style.color='white'">Download</a></button>
                                </div>
                            </form>




                            <script src="dist/js/jquery-3.2.1.min.js"></script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
                            <script>
                                // function savePDF() {
                                //     var doc = new jsPDF();
                                //     var specialElementHandlers = {
                                //         '#editor': function (element, renderer) {
                                //             return true;
                                //         }
                                //     };
                                //     doc.fromHTML($('#content').html(), 15, 15, {
                                //         'width': 700,
                                //         'elementHandlers': specialElementHandlers
                                //     });
                                //     doc.save('sample_file.pdf');
                                // }

                            </script>
                            <script>
                                $(function () {
                                    // document.getElementById('name').value='K D H C Kariyawasam';

                                    var myTable = document.getElementById('tblPaySlip');
                                    // myTable.rows[2].cells[1].innerHTML = '1';

                                    $.ajax({
                                        url: "/myProjects/Payroll Management System/backend-php/employee-payslip.php",
                                        type: "get",
                                        beforeSend: function() {
                                            // $('#tblEmpPersonal-hr tbody').empty();
                                        },
                                        success: function(result) {
                                            result=JSON.parse(result);
                                            // console.log(result);

                                            if(result.length!==0){
                                                myTable.rows[3].cells[1].innerHTML = result[0].Worked_days;
                                                myTable.rows[3].cells[3].innerHTML = (31-result[0].Worked_days);
                                                myTable.rows[3].cells[5].innerHTML = result[0].Basic_salary;

                                                myTable.rows[4].cells[1].innerHTML = (result[0].Basic_salary/25).toFixed(2);

                                                myTable.rows[6].cells[1].innerHTML = result[0].worked_weekdays_saturdays;
                                                myTable.rows[6].cells[2].innerHTML = (result[0].worked_weekdays_saturdays*(result[0].Basic_salary/25)).toFixed(2);
                                                myTable.rows[6].cells[4].innerHTML = result[0].SL01;
                                                myTable.rows[6].cells[5].innerHTML = (result[0].SL01*((result[0].Basic_salary/25)*0.75)).toFixed(2);

                                                myTable.rows[7].cells[1].innerHTML = result[0].Worked_sundays;
                                                myTable.rows[7].cells[2].innerHTML = (result[0].Worked_sundays*(result[0].Basic_salary/25)).toFixed(2);
                                                myTable.rows[7].cells[4].innerHTML = result[0].Halfday;
                                                myTable.rows[7].cells[5].innerHTML = (result[0].Halfday*((result[0].Basic_salary/25)*0.5)).toFixed(2);

                                                myTable.rows[8].cells[1].innerHTML = result[0].Worked_pubHolidays;
                                                myTable.rows[8].cells[2].innerHTML = (result[0].Worked_pubHolidays*(result[0].Basic_salary/25)).toFixed(2);
                                                myTable.rows[8].cells[4].innerHTML = result[0].SL02;
                                                myTable.rows[8].cells[5].innerHTML = (result[0].SL02*((result[0].Basic_salary/25)*0.25)).toFixed(2);

                                                myTable.rows[9].cells[1].innerHTML = result[0].BRAllowance;
                                                myTable.rows[9].cells[3].innerHTML = result[0].EPF_8;

                                                myTable.rows[10].cells[1].innerHTML = result[0].tot_for_EPFETF;

                                                myTable.rows[11].cells[1].innerHTML = result[0].NOT_pay;

                                                myTable.rows[12].cells[1].innerHTML = result[0].DOT_pay;

                                                myTable.rows[13].cells[1].innerHTML = result[0].Other_llowance;

                                                myTable.rows[14].cells[1].innerHTML = result[0].Net_salary;
                                                myTable.rows[14].cells[3].innerHTML = (parseFloat(result[0].SL_deduction)+parseFloat(result[0].EPF_8)).toFixed(2);

                                                myTable.rows[15].cells[1].innerHTML = result[0].EPF_12;

                                                myTable.rows[16].cells[1].innerHTML = result[0].ETF_3;

                                                myTable.rows[17].cells[1].innerHTML = result[0].tot_salary;
                                            }



                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            alert('Error: ' + textStatus + ' - ' + errorThrown);
                                        }

                                    });
                                    return false;
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"?>
