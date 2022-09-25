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
                <h4 class="page-title">Modify Attendance Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="supervisor-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Modify Attendance Details</li>
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
                    <p class="text-left" for="date">- Search by one Date or Date Range -</p>
                    <form id="formAttendance" enctype="application/x-www-form-urlencoded" method="post" action="#">
                        <div class="form-group row">
                            <label class="col-1 text-right control-label col-form-label" for="dateFrom">From</label>
                            <input type="date" class="form-control col-2" id="dateFrom" name="dateFrom">

                            <label class="col-1 text-right control-label col-form-label" for="dateTo">To</label>
                            <input type="date" class="form-control col-2" id="dateTo" name="dateTo">


<!--                            <button id="btnSearch1"  type="submit" name="search" class="btn btn-info" style="margin-left: 20px">Search</button>-->
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
                    <!--                            <div class="card-body">-->
                    <!--                                <h5 class="card-title m-b-0">Static Table With Checkboxes</h5>-->
                    <!--                            </div>-->
                    <div class="table-responsive" >
                        <table class="table" id="tblModifyAttendace-sup">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Employee ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Remark</th>
                                <th scope="col">Check In Time</th>
                                <th scope="col">Check Out Time</th>
                                <th scope="col">Normal OT/hrs</th>
                                <th scope="col">Double OT/hrs</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">

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
                                            $('#tblModifyAttendace-sup tbody').append('<tr>' +
                                                '<td>'+jsonString[data]['Emp_ID']+'</td>' +
                                                '<td>'+jsonString[data]['Name']+'</td>' +
                                                '<td>'+jsonString[data]['Date']+'</td>' +
                                                '<td>'+jsonString[data]['Remark']+'</td>' +
                                                '<td>'+jsonString[data]['checkIn_Time']+'</td>' +
                                                '<td>'+jsonString[data]['checkOut_Time']+'</td>' +
                                                '<td>'+jsonString[data]['Normal_OT']+'</td>' +
                                                '<td>'+jsonString[data]['Double_OT']+'</td>' +
                                                '<td>' +
                                                    '<a id="editEmployee" style="cursor: pointer;color: darkblue;font-size: 20px" data-toggle="tooltip" title="Edit" href="supervisor-edit-attendance.php?empID='+jsonString[data]['Emp_ID']+'&empDate='+jsonString[data]['Date']+'">\n' +
                                                        '<i class="mdi mdi-account-edit"></i>\n' +
                                                    '</a>' +
                                                '</td>' +
                                                '</tr>')
                                        }
                                    }

                                };

                                httpRqst.open('GET','backend-php/current-month-attendance-details.php',true);

                                httpRqst.send();
                            });
                        </script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script>



                            $('#btnSearch2').click(function() {
                                $.ajax({
                                    url: "/myProjects/Payroll Management System/backend-php/search-current-month-attendance.php?id=" + $('#id').val() + "&name=" + $('#name').val() + "&from=" + $('#dateFrom').val() + "&to=" + $('#dateTo').val(),
                                    type: "get",
                                    beforeSend: function() {
                                        $('#tblModifyAttendace-sup tbody').empty();
                                    },
                                    success: function(result) {
                                        if(result.length===0){
                                            alert('Not Found');
                                        }else{
                                            for (var i = 0; i < result.length; i++) {
                                                var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].Date + '</td><td>'+result[i].Remark+'</td><td>' + result[i].checkIn_Time + '</td><td>' + result[i].checkOut_Time + '</td><td>' + result[i].Normal_OT + '</td><td>' + result[i].Double_OT + '</td><td><a id="editEmployee" style="cursor: pointer;color: darkblue;font-size: 20px" data-toggle="tooltip" title="Edit" href="supervisor-edit-attendance.php?empID='+result[i].Emp_ID+'&empDate='+result[i].Date+'"> <i class="mdi mdi-account-edit"></i></a></td></tr>');
                                                $('#tblModifyAttendace-sup').append(row);
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
<!--                    <div class="border-top">-->
<!--                        <div class="card-body">-->
<!--                            <button type="submit" class="btn btn-info" style="width: 10%">Edit</button>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<?php include "footer.php"?>
