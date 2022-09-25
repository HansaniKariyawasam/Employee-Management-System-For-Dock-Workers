<?php
/**
 * Created by IntelliJ IDEA.
if(isset($_GET['name'])){
$name=$_GET['name'];
}* User: Hansani
 * Date: 2021-03-04
 * Time: 5:18 PM
 */

include 'hr-header.php';
//if(isset($_GET['name'])){
//    $name=$_GET['name'];
//}
?>

    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Salary Sheet of the <?php echo date('F');?></h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-left" for="date" style="padding: 5px;color: red;font-size: 15px"><b>- Please save the salary details at the end of the month -</b></p>
                            <div class="table-responsive">
                                <table id="tblSalary-hr" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Worked Days</th>
                                        <th>Worked Sundays</th>
                                        <th>Worked Public Holidays</th>
                                        <th>BRA Allowance/Rs.</th>
                                        <th>Total for EPF & ETF/Rs.</th>
                                        <th>EPF 12%</th>
                                        <th>ETF 3%</th>
                                        <th>Other Allowances/Rs.</th>
                                        <th>NOT Pay/Rs.</th>
                                        <th>DOT Pay/Rs.</th>
                                        <th>Net Salary/Rs.</th>
                                        <th>EPF 8%/Rs.</th>
                                        <th>Short Leave Deduction/Rs.</th>
                                        <th>Total Salary/Rs.</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                                <script src="dist/js/jquery-3.2.1.min.js"></script>
                                <script>
                                    $(function () {
                                        var httpRqst=new XMLHttpRequest();

                                        httpRqst.onreadystatechange=function () {

                                            if(httpRqst.readyState === 4 && httpRqst.status===200){
                                                var jsonString=JSON.parse(httpRqst.responseText);
                                                console.log(jsonString);
                                                for(var data in jsonString) {
                                                    $('#tblSalary-hr tbody').append('<tr>' +
                                                        '<td>'+jsonString[data]['Emp_ID']+'</td>' +
                                                        '<td>'+jsonString[data]['Name']+'</td>' +
                                                        '<td>'+jsonString[data]['Month']+'</td>' +
                                                        '<td>'+jsonString[data]['worked_days']+'</td>' +
                                                        '<td>'+jsonString[data]['worked_sundays']+'</td>' +
                                                        '<td>'+jsonString[data]['worked_holidays']+'</td>' +
                                                        '<td>'+jsonString[data]['BRAAllowance']+'</td>' +
                                                        '<td>'+jsonString[data]['tot_for_EPFETF']+'</td>' +
                                                        '<td>'+jsonString[data]['EPF_12']+'</td>' +
                                                        '<td>'+jsonString[data]['ETF_3']+'</td>' +
                                                        '<td>'+jsonString[data]['other_allowance']+'</td>' +
                                                        '<td>'+jsonString[data]['NOT_pay']+'</td>' +
                                                        '<td>'+jsonString[data]['DOT_pay']+'</td>' +
                                                        '<td>'+jsonString[data]['net_salary']+'</td>' +
                                                        '<td>'+jsonString[data]['EPF_8']+'</td>' +
                                                        '<td>'+jsonString[data]['SL_deduction']+'</td>' +
                                                        '<td>'+jsonString[data]['tot_salary']+'</td>' +
                                                        '</tr>')
                                                }
                                            }

                                        };

                                        httpRqst.open('GET','backend-php/salary-calculation.php',true);

                                        httpRqst.send();
                                    });
                                </script>
                            </div>
                            <div class="border-top" id="divCalculate">
                                <div class="card-body" style="float:right;">
                                    <form id="salaryCalculate" action="backend-php/salary-calculation.php" method="post">
                                        <button type="submit" name="calculate" value="Calculate" class="btn btn-primary" id="btnCalculate" style="float:right;">Save Salary Details</button>
                                    </form>

                                </div>
                            </div>

                            <script>
                                window.onload=function (ev) { // when window is loading the following things are going to happen
                                    document.getElementById("btnCalculate").disabled = true;
                                    var date = new Date();
                                    // console.log(date);
                                    var lastDay = new Date(date.getFullYear(), date.getMonth() +1, 1);  // Fri Jul 31 2021 15:55:50 GMT+0530 (India Standard Time)
                                    date=date.toISOString().substring(0,10); // above value convert into this way 2021-07-
                                    lastDay=lastDay.toISOString().substring(0,10);
                                    // console.log(date);
                                    // console.log(lastDay);
                                    if(date===lastDay){ // Check the current date is last day of the month
                                        // alert("Today is the end  of the Month. Please save the employees' salary details");
                                        // At the end of the month button will be enabled to save the salary details
                                        document.getElementById("btnCalculate").disabled = false;
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

<?php include "footer.php"?>