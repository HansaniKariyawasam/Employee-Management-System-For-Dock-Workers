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
    $q="SELECT * FROM attendance a,employee e WHERE e.Name='$name' AND a.Emp_ID=e.Emp_ID";

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
                <h4 class="page-title">My Attendance Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="employee-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Attendance Details</li>
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
                        <p class="text-left" for="date">Select a one Date or Date Range</p>
                        <form id="formAttendance" enctype="application/x-www-form-urlencoded" method="post">
                            <div class="form-group row">
                                <label class="col-1 text-right control-label col-form-label" for="dateFrom">From</label>
                                <input type="date" class="form-control col-2" id="dateFrom" name="dateFrom">

                                <label class="col-1 text-right control-label col-form-label" for="dateTo">To</label>
                                <input type="date" class="form-control col-2" id="dateTo" name="dateTo">

                                <button id="btnSearch"  type="submit" name="search" class="btn btn-info" style="margin-left: 20px">Search</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="tblEmpAttendance" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Remark</th>
                                        <th>Check In Time</th>
                                        <th>Check Out Time</th>
                                        <th>Normal OT/hrs</th>
                                        <th>Double OT/hrs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($rowData as $row) {?>
                                    <tr>
                                        <td><?php echo $row['Date'] ?></td>
                                        <td><?php echo $row['Remark'] ?></td>
                                        <td><?php echo $row['checkIn_Time'] ?></td>
                                        <td><?php echo $row['checkOut_Time'] ?></td>
                                        <td><?php echo $row['Normal_OT'] ?></td>
                                        <td><?php echo $row['Double_OT'] ?></td>

                                    </tr>
                                <?php   } ?>
                                </tbody>
                            </table>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                            <script>
                                $('#btnSearch').click(function() {

                                    $.ajax({
                                        url: "/myProjects/Payroll Management System/backend-php/search-one-employee-attendance.php?from=" + $('#dateFrom').val() + "&to=" + $('#dateTo').val(),
                                        type: "get",
                                        beforeSend: function() {
                                            $('#tblEmpAttendance tbody').empty();
                                        },
                                        success: function(result) {
                                            if(result.length===0){
                                                alert('Not Found');
                                            }else{
                                                for (var i = 0; i < result.length; i++) {
                                                    var row = $('<tr><td>' + result[i].Date + '</td><td>' + result[i].Remark + '</td><td>' + result[i].checkIn_Time + '</td><td>' + result[i].checkOut_Time + '</td><td>' + result[i].Normal_OT + '</td><td>' + result[i].Double_OT + '</td></tr>');
                                                    $('#tblEmpAttendance').append(row);
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
<!--<script src="dist/js/pages/chart/chart-page-init.js"></script>-->
<!--<script src="assets/extra-libs/DataTables/datatables.min.js"></script>-->
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<?php include "footer.php"?>
