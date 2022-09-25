<?php
include "supervisor-header.php";
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Employee Attendance Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="supervisor-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employee Attendance Details</li>
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

<!--                                <button id="btnSearch1"  type="submit" name="search" class="btn btn-info" style="margin-left: 20px">Search</button>-->
                            </div>
                            <hr>
                            <p class="text-left" for="date" style="padding: 5px">- Search by ID or Name -</p>


                            <div id="divSearch" class="form-group row">

                                <label class="col-md-1 text-right control-label col-form-label" for="id">ID</label>
                                <input type="text" class="col-md-3 form-control" name="id" id="id">



                                <label class="col-md-1 text-right control-label col-form-label" for="name">Name</label>
                                <input type="text" class="col-md-3 form-control" name="name" id="name">


                                <button id="btnSearch2"  type="submit" name="search" class="btn btn-info" style="margin-left: 20px;">Search</button>

                            </div>

                            <hr>
                        </form>
                        <div class="table-responsive">
                            <table id="tblEmpAttendance-sup" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th scope="col">Remark</th>
                                    <th>Check In Time</th>
                                    <th>Check Out Time</th>
                                    <th>Normal OT/hrs</th>
                                    <th>Double OT/hrs</th>
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
                                                $('#tblEmpAttendance-sup tbody').append('<tr>' +
                                                    '<td>'+jsonString[data]['Emp_ID']+'</td>' +
                                                    '<td>'+jsonString[data]['Name']+'</td>' +
                                                    '<td>'+jsonString[data]['Date']+'</td>' +
                                                    '<td>'+jsonString[data]['Remark']+'</td>' +
                                                    '<td>'+jsonString[data]['checkIn_Time']+'</td>' +
                                                    '<td>'+jsonString[data]['checkOut_Time']+'</td>' +
                                                    '<td>'+jsonString[data]['Normal_OT']+'</td>' +
                                                    '<td>'+jsonString[data]['Double_OT']+'</td>' +
                                                    '</tr>')
                                            }
                                        }

                                    };

                                    httpRqst.open('GET','backend-php/emp-attendance-details.php',true);

                                    httpRqst.send();
                                });
                            </script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                            <script>



                                $('#btnSearch2').click(function() {
                                    $.ajax({
                                        url: "/myProjects/Payroll Management System/backend-php/search-attendance-details.php?id=" + $('#id').val() + "&name=" + $('#name').val()+ "&from=" + $('#dateFrom').val() + "&to=" + $('#dateTo').val(),
                                        type: "get",
                                        beforeSend: function() {
                                            $('#tblEmpAttendance-sup tbody').empty();
                                        },
                                        success: function(result) {
                                            if(result.length===0){
                                                alert('Not Found');
                                            }else{
                                                for (var i = 0; i < result.length; i++) {
                                                    var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].Date + '</td><td>'+result[i].Remark+'</td><td>' + result[i].checkIn_Time + '</td><td>' + result[i].checkOut_Time + '</td><td>' + result[i].Normal_OT + '</td><td>' + result[i].Double_OT + '</td></tr>');
                                                    $('#tblEmpAttendance-sup').append(row);
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
