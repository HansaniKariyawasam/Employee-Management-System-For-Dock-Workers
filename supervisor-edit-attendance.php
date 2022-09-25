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
if(isset($_GET['empID']) && !empty($_GET['empDate'])) {
    $empID = $_GET['empID'];
    $empDate = $_GET['empDate'];
    $attendance = $attendanceObj->displyaRecordById($empID,$empDate);
}

// Update employee  Record
if(isset($_POST['update'])) {
    $attendanceObj->updateRecord($_POST);
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
                                <li class="breadcrumb-item active" aria-current="page">Edit Attendance Details</li>
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

                        <form id="emp-modify-form" class="form-horizontal" action="supervisor-edit-attendance.php" method="post">
                            <div class="card-body">
<!--                                <h4 class="card-title">Edit Attendance Details</h4>-->
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
                                    <label for="txtDate" class="col-sm-3 text-right control-label col-form-label">Remark</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="remark" id="txtRemark" value="<?php echo $attendance['Remark'];?>" class="form-control" placeholder="Remark" readonly>
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
                                        // var date=document.getElementById('txtDate').value;
                                        var remark=document.getElementById('txtRemark').value;

                                        var mor="07:15:00";
                                        var eve="17:00:00";
                                        var noon="13:00:00";
                                        var hrs=0;

                                        //To check the date is a saturday or sunday
                                        if(remark==='Holiday'){
                                            if(checkIn<mor){
                                                checkIn='07:00:00';
                                                if(checkOut>noon){
                                                    DOT=((parseInt(checkOut)-parseInt(checkIn))-1);
                                                }else{
                                                    DOT=parseInt(checkOut)-parseInt(checkIn);
                                                }
                                            }else{ // if checkIn time greater than 07.15 am
                                                if(checkOut>noon){
                                                    DOT=((parseInt(checkOut)-parseInt(checkIn))-1);
                                                }else{
                                                    DOT=parseInt(checkOut)-parseInt(checkIn);
                                                }
                                            }
                                        }else if(remark==='Sunday'){
                                            if(checkIn<mor){ // check the checkIn time is less than 7.15 am
                                                checkIn="07:00:00";
                                                if(checkOut>noon){
                                                    NOT=((parseInt(checkOut)-parseInt(checkIn))-1); //deduct the lunch hour
                                                }else{
                                                    NOT=parseInt(checkOut)-parseInt(checkIn);
                                                }
                                            }else{
                                                if(checkOut>noon){
                                                    NOT=((parseInt(checkOut)-parseInt(checkIn))-1);
                                                }else{
                                                    NOT=parseInt(checkOut)-parseInt(checkIn);
                                                }
                                            }
                                        }else if(remark==='Saturday'){
                                            if(checkIn<mor){
                                                checkIn="07:00:00";

                                                if(checkOut>noon){
                                                    NOT=(1+(parseInt(checkOut)-parseInt(noon))); // when checkIn time is less than 07.15 am, always give only 7-8 only one hour as NOT
                                                }else{
                                                    NOT=1;
                                                }
                                            }else{
                                                if(checkOut>noon){
                                                    NOT=parseInt(checkOut)-parseInt(noon); // there is No morning OT, only after 13.00 pm
                                                }
                                            }
                                        }else{
                                            if("08:15:00"<checkIn){ // these types of attendance are always short leaves. It can be SL01 or SL02 or half day
                                                console.log(checkIn);
                                                if(checkOut<="17:00:00"){
                                                    if(checkOut>noon){
                                                        hrs=(parseInt(checkOut)-parseInt(checkIn))-1;
                                                        if(1<=hrs && hrs<=3){
                                                            remark= 'SL01';
                                                        }else if(hrs===4){
                                                            remark= 'Halfday';
                                                        }else{
                                                            remark= 'SL02';
                                                        }
                                                    }else{
                                                        hrs=(parseInt(checkOut)-parseInt(checkIn));
                                                        if(1<=hrs && hrs<=3){
                                                            remark= 'SL01';
                                                        }else if(hrs===4){
                                                            remark= 'Halfday';
                                                        }else{
                                                            remark= 'SL02';
                                                        }
                                                    }
                                                }else if (checkOut>"17:00:00"){
                                                    console.log(checkOut);
                                                    hrs=(parseInt(checkOut)-parseInt(checkIn))-1;
                                                    console.log(hrs);
                                                    if(1<=hrs && hrs<=3){
                                                        remark= 'SL01';
                                                    }else if(hrs===4){
                                                        remark= 'Halfday';
                                                    }else{
                                                        remark= 'SL02';
                                                    }
                                                    NOT=(parseInt(checkOut)-parseInt(eve));
                                                }
                                            }else if (checkIn<"07:15:00"){
                                                checkIn="08:00:00";
                                                if(checkOut<"17:00:00"){ // these types of attendance are always short leaves
                                                    if(checkOut>noon){
                                                        hrs=(parseInt(checkOut)-parseInt(checkIn))-1;
                                                        if(1<=hrs && hrs<=3){
                                                            remark= 'SL01';
                                                        }else if(hrs===4){
                                                            remark= 'Halfday';
                                                        }else{
                                                            remark= 'SL02';
                                                        }
                                                    }else{
                                                        hrs=(parseInt(checkOut)-parseInt(checkIn));
                                                        if(1<=hrs && hrs<=3){
                                                            remark= 'SL01';
                                                        }else if(hrs===4){
                                                            remark= 'Halfday';
                                                        }else{
                                                            remark= 'SL02';
                                                        }
                                                    }
                                                    NOT=1;
                                                }else if (checkOut>"17:00:00"){ // these are not short leaves
                                                    remark='Weekday';
                                                    NOT=(1+(parseInt(checkOut)-parseInt(eve)));
                                                }
                                            }else{
                                                if(checkOut<"17:00:00"){ // these types of attendance are always short leaves
                                                    if(checkOut>noon){
                                                        hrs=(parseInt(checkOut)-parseInt(checkIn))-1;
                                                        if(1<=hrs && hrs<=3){
                                                            remark= 'SL01';
                                                        }else if(hrs===4){
                                                            remark= 'Halfday';
                                                        }else{
                                                            remark= 'SL01';
                                                        }
                                                    }else{
                                                        hrs=(parseInt(checkOut)-parseInt(checkIn));
                                                        if(1<=hrs && hrs<=3){
                                                            remark= 'SL01';
                                                        }else if(hrs===4){
                                                            remark= 'Halfday';
                                                        }else{
                                                            remark= 'SL01';
                                                        }
                                                    }
                                                }else if (checkOut>"17:00:00"){ // these are not short leaves
                                                    remark='Weekday';
                                                    NOT=(parseInt(checkOut)-parseInt(eve));
                                                }
                                            }
                                        }



                                        //Set the Normal OT
                                        document.getElementById('txtNOT').value=NOT;
                                        //Set the Double OT
                                        document.getElementById('txtDOT').value=DOT;
                                        //Set the remark details
                                        document.getElementById('txtRemark').value=remark;

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
                                    <button type="submit" name="update" value="Update" class="btn btn-primary" id="btnSave" style="float:right;" >Save Changes</button>
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