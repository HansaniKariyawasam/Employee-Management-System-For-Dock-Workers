<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-04-25
 * Time: 11:14 PM
 */
include "employee-header.php";
if($connection){
        $name=$_SESSION['Name'];
        $q="SELECT * FROM salary s,employee e WHERE e.Name='$name' AND s.Emp_ID=e.Emp_ID";

        $result=mysqli_query($connection,$q);
        if(mysqli_num_rows($result)>0){
            $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);
        }
}
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">My Salary Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="employee-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Salary Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" enctype="application/x-www-form-urlencoded" id="formSalarySearch">
                            <div class="form-group row">
                                <label class="col-md-2 text-right control-label col-form-label" for="month">Select a Month</label>
                                <select class="select2 form-control custom-select col-2" id="month">
                                    <option value="">Select</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>

                                </select>

                                <button id="btnSearchSalary"  type="submit" name="search" class="btn btn-info" style="margin-left: 30px">Search</button>
                            </div>
                        </form>
                        <div class="form-group row">

                        </div>
                        <div class="table-responsive">
                            <table id="tblEmpSalary" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Worked Days</th>
                                    <th>Worked Sundays</th>
                                    <th>Worked Public Holidays</th>
                                    <th>BRA Allowance/Rs</th>
                                    <th>Total for EPF & ETF/Rs</th>
                                    <th>EPF 12%/Rs</th>
                                    <th>ETF 3%/Rs</th>
                                    <th>Other Allowances/Rs</th>
                                    <th>NOT Pay/Rs</th>
                                    <th>DOT Pay/Rs</th>
                                    <th>Net Salary/Rs</th>
                                    <th>EPF 8%/Rs</th>
                                    <th>Short Leave Deduction/Rs</th>
                                    <th>Total Salary/Rs</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($rowData as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Year'] ?></td>
                                        <td><?php echo $row['Month'] ?></td>
                                        <td><?php echo $row['Worked_days'] ?></td>
                                        <td><?php echo $row['Worked_sundays'] ?></td>
                                        <td><?php echo $row['Worked_pubHolidays'] ?></td>
                                        <td><?php echo $row['BRAllowance'] ?></td>
                                        <td><?php echo $row['tot_for_EPFETF'] ?></td>
                                        <td><?php echo $row['EPF_12'] ?></td>
                                        <td><?php echo $row['ETF_3'] ?></td>
                                        <td><?php echo $row['Other_llowance'] ?></td>
                                        <td><?php echo $row['NOT_pay'] ?></td>
                                        <td><?php echo $row['DOT_pay'] ?></td>
                                        <td><?php echo $row['Net_salary'] ?></td>
                                        <td><?php echo $row['EPF_8'] ?></td>
                                        <td><?php echo $row['SL_deduction'] ?></td>
                                        <td><?php echo $row['tot_salary'] ?></td>

                                    </tr>
                        <?php   } ?>

                                </tbody>
                            </table>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                            <script>
                                $('#btnSearchSalary').click(function() {
console.log($('#month').val());
                                    $.ajax({
                                        url: "/myProjects/Payroll Management System/backend-php/search-one-employee-salary.php?from=" + $('#month').val(),
                                        type: "get",
                                        beforeSend: function() {
                                            $('#tblEmpSalary tbody').empty();
                                        },
                                        success: function(result) {
                                            if(result.length===0){
                                                alert('Not Found');
                                            }else{
                                                for (var i = 0; i < result.length; i++) {
                                                    var row = $('<tr><td>' + result[i].Year + '</td><td>' + result[i].Month + '</td><td>' + result[i].Worked_days + '</td><td>' + result[i].Worked_sundays + '</td><td>' + result[i].Worked_pubHolidays + '</td><td>' + result[i].BRAllowance + '</td><td>' + result[i].tot_for_EPFETF + '</td><td>' + result[i].EPF_12 + '</td><td>' + result[i].ETF_3 + '</td><td>' + result[i].Other_llowance + '</td><td>' + result[i].NOT_pay + '</td><td>' + result[i].DOT_pay + '</td><td>' + result[i].Net_salary + '</td><td>' + result[i].EPF_8 + '</td><td>' + result[i].tot_salary + '</td></tr>');
                                                    $('#tblEmpSalary').append(row);
                                                }
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
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>

</div>
<?php include "footer.php"?>
