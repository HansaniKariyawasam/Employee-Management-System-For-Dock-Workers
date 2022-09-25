<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-04-26
 * Time: 9:39 PM
 */
include "hr-header.php";
include "my-class/Employee.php";

$employeeObj = new Employee();

// Edit employee record
if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $employee = $employeeObj->displyaRecordById($editId);
}

// Update employee  Record
if(isset($_POST['update'])) {
    $employeeObj->updateRecord($_POST);
}
?>
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <div id="main-wrapper">
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Modify an Employee</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="hr-home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Modify an Employee</li>
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
                            <form id="emp-modify-form" class="form-horizontal" action="hr-edit-emp-personal-info.php" method="post">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Personal Info</h4>
                                    <div class="form-group row">
                                        <label for="empID" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="empID" class="form-control" value="<?php echo $employee['Emp_ID']; ?>" placeholder="Employee ID" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Employee Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" class="form-control" value="<?php echo $employee['Name']; ?>" placeholder="Employee Name" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bank_name" class="col-sm-3 text-right control-label col-form-label">Current Status</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control custom-select" name="current_status" style="width: 100%; height:36px;">
                                                <option>Select</option>
                                                <option value="Employed" <?php if($employee['Current_status']=="Employed") echo 'selected="selected"'; ?>>Employed</option>
                                                <option value="Resigned"<?php if($employee['Current_status']=="Resigned") echo 'selected="selected"'; ?>>Resigned</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="basic_salary" class="col-sm-3 text-right control-label col-form-label">NIC</label>
                                        <div class="col-sm-9">
                                            <input type="text"  name="NIC" value="<?php echo $employee['NIC']; ?>" class="form-control" id="nic" placeholder="NIC" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="basic_salary" class="col-sm-3 text-right control-label col-form-label">Basic Salary</label>
                                        <div class="col-sm-9">
                                            <input type="text" onkeypress="val()" name="basic_salary" value="<?php echo $employee['Basic_Salary']; ?>" class="form-control" id="basic_salary" placeholder="Basic Salary">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 text-right control-label col-form-label">Permanent Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $employee['Permanent_address']; ?>" id="Permanent_address" placeholder="Permanent Address" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 text-right control-label col-form-label">Temporary Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="Temporary_address" value="<?php echo $employee['Temporary_address']; ?>" id="Temporary_address" placeholder="Temporary Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tel_no" class="col-sm-3 text-right control-label col-form-label">Telephone Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" onkeypress="val()" name="tel_no" maxlength="10" value="<?php echo $employee['Tel_No']; ?>" class="form-control" id="tel_no" placeholder="Telephone Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bank_name" class="col-sm-3 text-right control-label col-form-label">Bank Name</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control custom-select" name="bank_name" style="width: 100%; height:36px;">
                                                <option>Select</option>
                                                <option value="BOC" <?php if($employee['Bank_name']=="BOC") echo 'selected="selected"'; ?>>Bank of Ceylon</option>
                                                <option value="Commercial"<?php if($employee['Bank_name']=="Commercial") echo 'selected="selected"'; ?>>Commercial Bank</option>
                                                <option value="DFCC"<?php if($employee['Bank_name']=="DFCC") echo 'selected="selected"'; ?>>DFCC Bank</option>
                                                <option value="HNB"<?php if($employee['Bank_name']=="HNB") echo 'selected="selected"'; ?>>Hatton National Bank</option>
                                                <option value="NDB"<?php if($employee['Bank_name']=="NDB") echo 'selected="selected"'; ?>>National Development Bank</option>
                                                <option value="NSB"<?php if($employee['Bank_name']=="NSB") echo 'selected="selected"'; ?>>National Savings Bank</option>
                                                <option value="Peoples"<?php if($employee['Bank_name']=="Peoples") echo 'selected="selected"'; ?>>People's Bank</option>
                                                <option value="Sampath"<?php if($employee['Bank_name']=="Sampath") echo 'selected="selected"'; ?>>Sampath Bank</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="branch_name" class="col-sm-3 text-right control-label col-form-label">Branch Name</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control custom-select" name="branch_name" style="width: 100%; height:36px;">
                                                <option>Select</option>
                                                <option value="Aluthgama"<?php if($employee['Branch_name']=="Aluthgama") echo 'selected="selected"'; ?>>Aluthgama</option>
                                                <option value="Ambalangoda"<?php if($employee['Branch_name']=="Ambalangoda") echo 'selected="selected"'; ?>>Ambalangoda</option>
                                                <option value="Awissawella"<?php if($employee['Branch_name']=="Awissawella") echo 'selected="selected"'; ?>>Awissawella</option>
                                                <option value="Bandaragama"<?php if($employee['Branch_name']=="Bandaragama") echo 'selected="selected"'; ?>>Bandaragama</option>
                                                <option value="Beliatta"<?php if($employee['Branch_name']=="Beliatta") echo 'selected="selected"'; ?>>Beliatta</option>
                                                <option value="Dehiwala"<?php if($employee['Branch_name']=="Dehiwala") echo 'selected="selected"'; ?>>Dehiwala</option>
                                                <option value="Elpitiya"<?php if($employee['Branch_name']=="Elpitiya") echo 'selected="selected"'; ?>>Elpitiya</option>
                                                <option value="Galle"<?php if($employee['Branch_name']=="Galle") echo 'selected="selected"'; ?>>Galle</option>
                                                <option value="Hambanthota"<?php if($employee['Branch_name']=="Hambanthota") echo 'selected="selected"'; ?>>Hambanthota</option>
                                                <option value="Horana"<?php if($employee['Branch_name']=="Horana") echo 'selected="selected"'; ?>>Horana</option>
                                                <option value="Kadawatha"<?php if($employee['Branch_name']=="Kadawatha") echo 'selected="selected"'; ?>>Kadawatha</option>
                                                <option value="Kaluthara"<?php if($employee['Branch_name']=="Kaluthara") echo 'selected="selected"'; ?>>Kaluthara</option>
                                                <option value="Kegalle"<?php if($employee['Branch_name']=="Kegalle") echo 'selected="selected"'; ?>>Kegalle</option>
                                                <option value="Matara"<?php if($employee['Branch_name']=="Matara") echo 'selected="selected"'; ?>>Matara</option>
                                                <option value="Panadura"<?php if($employee['Branch_name']=="Panadura") echo 'selected="selected"'; ?>>Panadura</option>
                                                <option value="Rathnapura"<?php if($employee['Branch_name']=="Rathnapura") echo 'selected="selected"'; ?>>Rathnapura</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="acc_no" class="col-sm-3 text-right control-label col-form-label">Account No</label>
                                        <div class="col-sm-9">
                                            <input type="text" onkeypress="val()" name="acc_no" value="<?php echo $employee['Acc_No']; ?>"  class="form-control" id="acc_no" placeholder="Account No">
                                        </div>
                                    </div>
                                    <script>
                                        function val() {
                                            $("#tel_no,#acc_no,#basic_salary").keydown(function (e) {
                                                // Allow: backspace, delete, tab, escape, enter and .
                                                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                                    // Allow: Ctrl/cmd+A
                                                    (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                    // Allow: Ctrl/cmd+C
                                                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                    // Allow: Ctrl/cmd+4X
                                                    (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                    // Allow: home, end, left, right
                                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                                                    // let it happen, don't do anything
                                                    return;
                                                }
                                                // Ensure that it is a number and stop the keypress
                                                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || (e.keyCode>=219 && e.keyCode<=222) || e.keyCode==190 || e.keyCode==110 ) {
                                                    e.preventDefault();
                                                }
                                                if($(this).val().trim().length===10){
                                                    e.preventDefault();
                                                    return;
                                                }
                                            });
                                        }

                                    </script>

                                    <!--                            <div class="form-group row">-->
                                    <!--                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Message</label>-->
                                    <!--                                <div class="col-sm-9">-->
                                    <!--                                    <textarea class="form-control"></textarea>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                </div>
                                <div class="border-top">
                                    <div class="card-body" style="float:right;">
                                        <input type="hidden" name="id" value="<?php echo $employee['Emp_ID']; ?>">
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
    </div>

<?php include "footer.php"?>