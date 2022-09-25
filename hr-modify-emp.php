<?php
include "hr-header.php";
include "my-class/Employee.php";

$employeeObj = new Employee();
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
<!--                --><?php
//                if (isset($_GET['msg1']) == "insert") {
//                    echo "<div class='alert alert-success alert-dismissible'>
//              <button type='button' class='close' data-dismiss='alert'>&times;</button>
//              Your Registration added successfully
//            </div>";
//                }
//                if (isset($_GET['msg2']) == "update") {
//                    echo "<div class='alert alert-success alert-dismissible'>
//              <button type='button' class='close' data-dismiss='alert'>&times;</button>
//              Your Registration updated successfully
//            </div>";
//                }
//                if (isset($_GET['msg3']) == "delete") {
//                    echo "<div class='alert alert-success alert-dismissible'>
//              <button type='button' class='close' data-dismiss='alert'>&times;</button>
//              Record deleted successfully
//            </div>";
//                }
//                ?>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <form>
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
                            <div class="table-responsive" >
                                <table class="table" id="tblEmpPersonal-hr">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Employee ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Current Status</th>
                                        <th scope="col">NIC</th>
                                        <th scope="col">Basic Salary</th>
                                        <th scope="col">Permanent Address</th>
                                        <th scope="col">Temporary Address</th>
                                        <th scope="col">Telephone No</th>
                                        <th scope="col">Account No</th>
                                        <th scope="col">Bank Name</th>
                                        <th scope="col">Branch</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="customtable">
                                        <?php
                                        $employees = $employeeObj->displayData();
                                        foreach ($employees as $emp) { ?>
                                            <tr>
                                                <td><?php echo $emp['Emp_ID'] ?></td>
                                                <td><?php echo $emp['Name'] ?></td>
                                                <td><?php echo $emp['Current_status'] ?></td>
                                                <td><?php echo $emp['NIC'] ?></td>
                                                <td><?php echo $emp['Basic_Salary'] ?></td>
                                                <td><?php echo $emp['Permanent_address'] ?></td>
                                                <td><?php echo $emp['Temporary_address'] ?></td>
                                                <td><?php echo $emp['Tel_No'] ?></td>
                                                <td><?php echo $emp['Acc_No'] ?></td>
                                                <td><?php echo $emp['Bank_name'] ?></td>
                                                <td><?php echo $emp['Branch_name'] ?></td>
                                                <td>
                                                    <a href="hr-edit-emp-personal-info.php?editId=<?php echo $emp['Emp_ID'] ?>" id="editEmployee" style="cursor: pointer;color: darkblue;font-size: 20px" data-toggle="tooltip" title="Edit">
                                                        <i class="mdi mdi-account-edit"></i>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script>

                                    $('#btnSearch2').click(function() {

                                        $.ajax({
                                            url: "/myProjects/Payroll Management System/backend-php/search-emp-personal-details.php?id=" + $('#id').val() + "&name=" + $('#name').val(),
                                            type: "get",
                                            beforeSend: function() {
                                                $('#tblEmpPersonal-hr tbody').empty();
                                            },
                                            success: function(result) {
                                                if(result.length===0){
                                                    alert('Not Found');
                                                }else{
                                                    for (var i = 0; i < result.length; i++) {
                                                        var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].Current_status + '</td><td>' + result[i].NIC + '</td><td>' + result[i].Basic_Salary + '</td><td>' + result[i].Permanent_address + '</td><td>' + result[i].Temporary_address + '</td><td>' + result[i].Tel_No + '</td><td>' + result[i].Acc_No + '</td><td>' + result[i].Bank_name + '</td><td>' + result[i].Branch_name + '</td><td><a href="hr-edit-emp-personal-info.php?editId='+result[i].Emp_ID+'"  id="editEmployee" style="cursor: pointer;color: darkblue;font-size: 20px" data-toggle="tooltip" title="Edit"><i class="mdi mdi-account-edit"></i></td></tr>');
                                                        $('#tblEmpPersonal-hr').append(row);
                                                    }
                                                }

                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                alert('Error: ' + textStatus + ' - ' + errorThrown);
                                            }

                                        });
                                        return false;
                                    });
                                    $("#id").keydown(function (e) {

                                        // console.log(e.keyCode);
                                        // Allow: delete,backspace,tab, escape, enter
                                        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,32]) !== -1 ||
                                            // Allow: Ctrl/cmd+A
                                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                                            // Allow: Ctrl/cmd+C
                                            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                                            // Allow: Ctrl/cmd+X
                                            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                                            // Allow: home, end, left, right
                                            (e.keyCode >= 35 && e.keyCode <= 39)) {
                                            // let it happen, don't do anything
                                            return;
                                        }
                                        // Ensure that it is a number and stop the keypress
                                        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                            e.preventDefault();
                                        }
                                    });
                                </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">

                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
            </div>


        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
<?php include "footer.php"?>