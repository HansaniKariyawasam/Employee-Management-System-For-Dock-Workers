<?php
include "supervisor-header.php";
echo "Supervisor Home";

?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Add Holiday Details of <?php echo date('Y');?> Year</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="supervisor-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Holiday Details of <?php echo date('Y');?></li>
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

                        <form id="formHoliday" enctype="application/x-www-form-urlencoded" method="post" action="backend-php/add-holiday.php">
                            <p class="text-left" for="date" style="padding: 5px">- Enter the holiday details of <?php echo date('F');?> -</p>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label" for="team">Select the Mercantile Holiday</label>
                                <input type="date" name="date" class="col-md-3 form-control" id="holidayDate" required>

                                <select name="holiday" id="holiday" class="col-md-3 form-control" required style="margin-left: 2%">
                                    <option value="">Select</option>
                                    <option value="Christmas Day">Christmas Day</option>
                                    <option value="Christmas Eve">Christmas Eve</option>
                                    <option value="Government Special Holiday">Government Special Holiday</option>
                                    <option value="Holy Prophet's Birthdayy">Holy Prophet's Birthday</option>
                                    <option value="May Day">May Day</option>
                                    <option value="National Day">National Day</option>
                                    <option value="Poya Day">Poya Day</option>
                                    <option value="Day After Poya Day">Day After Poya Day</option>
                                    <option value="Sinhala & Tamil New Year">Sinhala & Tamil New Year</option>
                                    <option value="Sinhala & Tamil New Year Eve">Sinhala & Tamil New Year Eve</option>
                                </select>
                                <button id="btnHoliday"  type="button" name="holiday" class="btn btn-info" style="margin-left: 30px">Enter the Holiday</button>
                            </div>

                            <hr>
                            <div class="table-responsive">
                                <table id="tblHoliday-sup" class="table table-striped table-bordered" style="width: 90%;margin-left:auto;margin-right:auto;">
                                    <thead>
                                    <tr>
                                        <th class="col" style="width: 15%">Date</th>
                                        <th class="col">Remark</th>
                                        <th class="col-sm-1">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>



                                    </tbody>
                                </table>
                                <script src="dist/js/jquery-3.2.1.min.js"></script>
                                <script>
                                    var holiday_array;

                                    $(function () {
                                        var httpRqst=new XMLHttpRequest();

                                        httpRqst.onreadystatechange=function () {

                                            if(httpRqst.readyState === 4 && httpRqst.status===200){
                                                var jsonString=JSON.parse(httpRqst.responseText);
                                                console.log(jsonString);
                                                holiday_array=jsonString;

                                                for(var data in jsonString) {

                                                    var href="backend-php/remove-holiday.php?Date="+jsonString[data]['Date'];
                                                    $('#tblHoliday-sup tbody').append('<tr>' +
                                                        '<td>'+jsonString[data]['Date']+'</td>' +
                                                        '<td>'+jsonString[data]['Remark']+'</td>' +
                                                        '<td>' +
                                                            '<a id="removeHoliday" style="cursor: pointer;color: darkred;font-size: 20px" data-toggle="tooltip" title="Remove" href="' + href + '">' +
                                                                '<i class="mdi mdi-account-remove"></i>' +
                                                            '</a>' +
                                                        '</td>'+
                                                        '</tr>')
                                                }
                                            }


                                        };

                                        httpRqst.open('GET','backend-php/view-holiday-details.php',true);

                                        httpRqst.send();
                                    });

                                    $('#btnHoliday').click(function () {
                                        var date=document.getElementById('holidayDate').value;
                                        var holiday=document.getElementById('holiday').value;
                                        var year=new Date(date).getFullYear();

                                        var currentYear=new Date().getFullYear();
                                        // console.log(currentYear);
                                        // console.log(year);
                                        if(date!=="" && holiday!==""){
                                            if(year===currentYear){
                                                for(var d in holiday_array){

                                                    var val=false;

                                                    if(date===holiday_array[d]['Date']){
                                                        val=true
                                                        break;
                                                    }
                                                }

                                                if(val){
                                                    console.log("True");
                                                    console.log(holiday_array[d]['Date']);
                                                    console.log(date);
                                                    alert("This day already assign as a Holiday. Please check again!");
                                                    var date=document.getElementById('holidayDate').value="";
                                                    var holiday=document.getElementById('holiday').value="";
                                                }else{
                                                    console.log("False");
                                                    console.log(holiday_array[d]['Date']);
                                                    $('#formHoliday').submit();
                                                }

                                            }else{
                                                alert('Select '+currentYear+' dates only');
                                            }
                                        }
                                    });
                                    window.onload=function (ev) { // when window is loading the following things are going to happen
                                        var date = new Date();
                                        // console.log(date);
                                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);  // Fri Jul 31 2021 15:55:50 GMT+0530 (India Standard Time)
                                        date=date.toISOString().substring(0,10); // above value convert into this way 2021-07-31
                                        if(date==='2021-07-24'){ // Check the current date is last day of the month
                                            alert("Today is the end  of the Month. Please upload the employees' attendance details");
                                            window.location.replace('supervisor-add-attendance.php');
                                        }
                                    }
                                </script>
                            </div>
                        </form>
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
