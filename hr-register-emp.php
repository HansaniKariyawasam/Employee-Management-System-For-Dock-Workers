<?php
include "hr-header.php";
include "my-class/Employee.php";

$employeeObj = new Employee();

if(isset($_GET['name'])){
    $name=$_GET['name'];
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<div id="main-wrapper">
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Register an Employee</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="hr-home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Register an Employee</li>
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
            <div class="card">
                <div class="card-body wizard-content" id="wizard">
                    <h6 class="card-subtitle"></h6>
                    <form id="emp-register-form" action="backend-php/hr-register-emp.php" method="POST" class="m-t-40">
                        <div>
                            <h3>Personal Details</h3>
                            <section>
                                <input type="hidden" name="n" value="<?php echo $name; ?>">
                                <label for="txtEmp_name">Employee Name *</label>
                                <input id="txtEmp_name" name="emp_name" type="text" placeholder="Employee Name" class="required form-control">
                                <label for="txtNIC">NIC *</label>
                                <input id="txtNIC" name="nic" type="text" placeholder="NIC Ex: 961301450V or 199613001450" class="required form-control" maxlength="12">
                                <label for="txtTel_no">Telephone Number *</label>
                                <input id="txtTel_no" name="tel_no" type="text" placeholder="0788954612" class="required form-control" maxlength="10">
                                <label for="txtAddress">Address</label>
                                <input id="txtAddress" name="address" type="text" placeholder="Enter Address" class=" form-control" value="">
                                <label for="txtBasic_salary">Basic Salary Amount *</label>
                                <input id="txtBasic_salary" name="basic_salary" type="text" placeholder="25000" class="required form-control">
                                <p>(*) Mandatory</p>
                            </section>
                            <h3>Account Details</h3>
                            <section>
                                <label for="bank">Bank Name *</label>
                                <select name="bank" id="bank_name" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                    <option value="">Select</option>
                                    <option value="BOC">Bank of Ceylon</option>
                                    <option value="Commercial">Commercial Bank</option>
                                    <option value="DFCC">DFCC Bank</option>
                                    <option value="HNB">Hatton National Bank</option>
                                    <option value="NSB">National Savings Bank</option>
                                    <option value="Peoples">People's Bank</option>
                                    <option value="Sampath">Sampath Bank</option>
                                </select>
                                <label for="branch">Branch name *</label>
                                <select name="branch" id="branch_name" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                    <option value="">Select</option>
                                    <option value="Aluthgama">Aluthgama</option>
                                    <option value="Ambalangoda">Ambalangoda</option>
                                    <option value="Awissawella">Awissawella</option>
                                    <option value="Bandaragama">Bandaragama</option>
                                    <option value="Beliatta">Beliatta</option>
                                    <option value="Dehiwala">Dehiwala</option>
                                    <option value="Elpitiya">Elpitiya</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Hambanthota">Hambanthota</option>
                                    <option value="Horana">Horana</option>
                                    <option value="Kadawatha">Kadawatha</option>
                                    <option value="Kegalle">Kegalle</option>
                                    <option value="Matara">Matara</option>
                                    <option value="Panadura">Panadura</option>
                                    <option value="Ranthnapura">Ranthnapura</option>
                                </select>
                                <label for="txtAcc_no">Account No *</label>
                                <input id="acc_no" name="acc_no" type="text" class="required form-control">
                                <p>(*) Mandatory</p>
                            </section>
                            <h3>Other Details</h3>
                            <section>
                                <label for="name">Team *</label>
                                <select id="team_no" name="team_no" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                    <option value="">Select</option>
                                    <?php
                                    $teams = $employeeObj->viewTeam();
                                    foreach ($teams as $team) { ?>

                                        <option value="<?php echo $team['Team_No'] ?>"><?php echo $team['Team_Name'] ?> </option>

                                    <?php } ?>
                                </select>
                                <!--                                <label for="txtEng_name">Engineer Name</label>-->
                                <!--                                <input id="txtEng_name" name="eng_name" type="text" class="required form-control" disabled>-->
                                <label for="marital_status">Marital Status *</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="married" name="marital_status" value="Marrried" required>
                                    <label class="custom-control-label" for="married">Married</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="unmarried" name="marital_status" value="Unmarried" required>
                                    <label class="custom-control-label" for="unmarried">Unmarried</label>
                                </div>
                                <hr>
                                <div id="divMarital_details">
                                    <div id="divChildren_chckbx" class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="no_children" name="no_children" value="No Children">
                                        <label class="custom-control-label" for="no_children">Having Children</label>
                                    </div>
                                    <hr>
                                    <div id="divChildren">
                                        <div class="form-group row">
                                            <label class="col-md-2 text-right control-label col-form-label" for="child_dob">Child Date of Birth</label>
                                            <div class="col-sm-5">
                                                <input type="date" class="form-control" id="child_dob" name="child_dob" max="{{ now()->toDateString('Y-m-d') }}">
                                            </div>
                                            <button style="margin: 5px;padding: 2px;width: 50px" type="button" class="btn btn-primary" id="btnAdd">Add</button>
                                            <button style="margin: 5px;padding: 2px" type="button" class="btn btn-primary" id="btnRemove">Remove All</button>
                                        </div>

                                        <div class="col-md-9">
                                            <span>List of Children</span>

                                            <table id="tblChildren" class="table">

                                                <thead>
                                                <tr>
                                                    <th class="center aligned">No</th>
                                                    <th>Child Date of Birth</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </section>
                            <h3>Summary</h3>
                            <section>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="txtEmp_name_sum"><b>Name</b> </label>
                                        <input id="txtEmp_name_sum" name="emp_name" type="text" class=" form-control" readonly>
                                        <label for="txtNIC_sum"><b>NIC</b></label>
                                        <input id="txtNIC_sum" name="nic" type="text" class=" form-control" readonly>
                                        <label for="txtTel_no_sum"><b>Telephone Number</b></label>
                                        <input id="txtTel_no_sum" name="tel_no" type="text" class=" form-control" readonly>
                                        <label for="txtAddress_sum"><b>Address</b></label>
                                        <input id="txtAddress_sum" name="address" type="text" class=" form-control" readonly>
                                        <label for="txtBasic_salary_sum"><b>Basic Salary Amount</b></label>
                                        <input id="txtBasic_salary_sum" name="basic_salary" type="text" class="required form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="txtBank_sum"><b>Bank Name</b></label>
                                        <input id="txtBank_sum" name="bank_name" type="text" class="required form-control" readonly>
                                        <label for="txtBranch_sum"><b>Branch Name</b></label>
                                        <input id="txtBranch_sum" name="branch_name" type="text" class="required form-control" readonly>
                                        <label for="txtAcc_no_sum"><b>Account No</b></label>
                                        <input id="txtAcc_no_sum" name="acc_no" type="text" class="required form-control" readonly>
                                        <label for="txtTeam_sum"><b>Team</b></label>
                                        <input id="txtTeam_sum" name="team" type="text" class="required form-control" readonly>
                                        <label for="txtMarital_status_sum"><b>Marital Status</b></label>
                                        <input id="txtMarital_status_sum" name="marital_status_sum" type="text" class="required form-control" readonly>
                                    </div>

                                    <div class="col-md-12">

                                        <span><b>List of Children</b></span>
                                        <table id="tblChildren_sum" class="table">
                                            <thead>
                                            <tr>
                                                <th class="center aligned">No</th>
                                                <th>Child Date of Birth</th>
                                            </tr>
                                            </thead>
                                            <tbody id="child">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required">
                                <label for="acceptTerms">I agree with the Terms and Conditions.</label>

                            </section>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="dist/js/custom.min.js"></script>
<!-- this page js -->
<script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
<script src="assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
<!--<script src="assets/libs/jquery/dist/jquery-3.2.1.min.js"></script>-->
<script src="dist/js/my/hr-manager.js"></script>

<!-- this page js -->
<script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
<script src="assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>

<script>
    // Basic Example with form
    var form = $("#emp-register-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {

            var maritalStatus = $("input[name='marital_status']:checked").val();
            var team = $("#team_no option:selected").text();

            var count=1;
            $('#tblChildren tbody tr').each(function() {

                var birthDays = $(this).find(".birth").val();
                $("#tblChildren_sum > tbody").append('<tr><td>'+count+'</td><td>'+ birthDays +'</td></tr>');
                count++;

            });


            $('#txtEmp_name_sum').val($('#txtEmp_name').val());
            $('#txtNIC_sum').val($('#txtNIC').val());
            $('#txtTel_no_sum').val($('#txtTel_no').val());
            $('#txtAddress_sum').val($('#txtAddress').val());
            $('#txtBasic_salary_sum').val($('#txtBasic_salary').val());
            $('#txtBank_sum').val($('#bank_name').val());
            $('#txtBranch_sum').val($('#branch_name').val());
            $('#txtAcc_no_sum').val($('#acc_no').val());
            $('#txtTeam_sum').val(team);
            $('#txtMarital_status_sum').val(maritalStatus);
            form.validate().settings.ignore = ":disabled,:hidden";

            if (currentIndex === 2) { //if last step

                //remove default #finish button
                $('#wizard').find('a[href="#finish"]').remove();
                $('#wizard .actions li:last-child').css('display','block')
                //append a submit type button
                $('#wizard .actions li:last-child').append('<input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">');
            }

            return form.valid();


        },


        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {

        }

    });


    $('#btnAdd').click(function (){

        var dob = $('#child_dob').val();
        var count = $('#tblChildren tr').length;

        if($('#tblChildren tr').length==0){
            // count=1;
        }

        if(dob!==''){
            $("#tblChildren > tbody").append('<tr><td>'+(count)+'</td><td><input type="text" class="birth" id="dob'+count+'" name="dob'+count+'" value="'+ dob +'" style="border: transparent;border-color: transparent;background-color: transparent;" readonly><input type="hidden" id="count" name="count" value="'+count+'" "></td></tr>');
            $('#child_dob').val('');
            $('#divChildren').append('<input type="hidden" name="count" value="'+count+'">');
        }

        // $('#tblChildren tr:last').after('<tr><td>'+count+'</td><td><input type="text" id="dob'+count+'" name="dob[]" value="'+ dob +'"></td></tr>');

    });

    $('#btnRemove').click(function (){

        $("#tblChildren tr").remove();
        $("#tblChildren_sum tr").remove();
    });

    // $("#team_no").change(function () {
    //
    //     var team_no = this.value;
    //
    //     $.ajax({
    //         url: "http://localhost/myProjects/Payroll%20Management%20System/my-class/Employee.php/view_eng/",
    //         type: "POST",
    //         dataType: "HTML",
    //         async: false,
    //         data: {team_no: team_no},
    //         success: function (data) {
    //
    //         }
    //     });
    //
    // });


</script>