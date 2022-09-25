<?php
include "supervisor-header.php";
include "my-class/Attendance.php";

$attendanceObj=new Attendance();


if(isset($_POST['update'])) {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
//    die();
}



// Edit employee record
if(isset($_GET['empID']) && !empty($_GET['empID'])) {
    $empID = $_GET['empID'];
    $empDate = $_GET['empDate'];
    $attendance = $attendanceObj->displyaSuspendRecordById($empID,$empDate);
}


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

                        <form id="emp-modify-form" class="form-horizontal" action="backend-php/supervisor-update-suspend-attendance.php" method="post">
                            <div class="card-body">
                                <h4 class="card-title">Edit Attendance Details</h4>
                                <div class="form-group row">
                                    <label for="txtEmpID" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="txtEmpID" name="empID" class="form-control" value="<?php echo $attendance['Emp_ID'];?>" placeholder="Employee ID" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtName" class="col-sm-3 text-right control-label col-form-label">Employee Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="txtName" value="<?php echo $attendance['Name'];?>" class="form-control" placeholder="Employee Name" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDate" class="col-sm-3 text-right control-label col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date" id="txtDate" value="<?php echo $attendance['Date'];?>" class="form-control" placeholder="Date" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDate" class="col-sm-3 text-right control-label col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="remark" id="txtDate" value="<?php echo $attendance['Remark'];?>" class="form-control" placeholder="Date" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtCheckIn" class="col-sm-3 text-right control-label col-form-label">Check In Time</label>
                                    <div class="col-sm-9">
                                        <input type="time" name="checkIn" value="<?php echo $attendance['checkIn_Time'];?>" class="form-control" id="txtCheckIn" placeholder="Check In Time" step="any" onchange="generateOT()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtCheckOut" class="col-sm-3 text-right control-label col-form-label">Check Out Time</label>
                                    <div class="col-sm-9">
                                        <input  type="time" name="checkOut" value="<?php echo $attendance['checkOut_Time'];?>" class="form-control" id="txtCheckOut" placeholder="Check Out Time" step="any" onchange="generateOT()">
                                    </div>
                                </div>
                                <script>
                                    function generateOT() {
                                        var NOT=0;
                                        var DOT=0;

                                        var checkIn=document.getElementById('txtCheckIn').value;
                                        var checkOut=document.getElementById('txtCheckOut').value;
                                        var date=document.getElementById('txtDate').value;

                                        var mor="08:00:00";
                                        var eve="17:00:00";
                                        var noon="13:00:00";

                                        //To check the date is a saturday or sunday
                                        var isWeekend=new Date(date);

                                        if(isWeekend.getDate()==6){ // Saturday
                                            if(checkOut>noon){
                                                NOT=parseInt(checkOut)-parseInt(noon);
                                            }
                                        }else if(isWeekend.getDate()==0){ // Sunday
                                            NOT=(parseInt(checkOut)-parseInt(checkIn))-1;
                                        }else{
                                            if(checkIn<mor || checkOut>eve){ //Weekday
                                                NOT=(parseInt(mor)-parseInt(checkIn))+(parseInt(checkOut)-parseInt(eve));
                                            }
                                        }

                                        //Set the Normal OT
                                        document.getElementById('txtNOT').value=NOT;

                                    }
                                </script>
                                <div class="form-group row">
                                    <label for="txtNOT" class="col-sm-3 text-right control-label col-form-label">Normal OT</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="NOT" value="<?php echo $attendance['Normal_OT'];?>" class="form-control" id="txtNOT" placeholder="Normal OT" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txtDOT" class="col-sm-3 text-right control-label col-form-label">Double OT</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="DOT" value="<?php echo $attendance['Double_OT'];?>" class="form-control" id="txtDOT" placeholder="Double OT" readonly>
                                    </div>
                                </div>
                            </div>

                            <!--                            <input name="hi" type="text" value="Hello">-->
                            <div class="border-top">
                                <div class="card-body" style="float:right;">
                                    <input type="hidden" name="id" value="<?php echo $attendance['Emp_ID']?>">
                                    <button type="submit" name="update" value="Update" class="btn btn-primary" id="btnSave" style="float:right;">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

<?php include "footer.php"?>