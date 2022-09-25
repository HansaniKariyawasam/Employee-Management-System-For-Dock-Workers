<?php
include "hr-header.php";
include "my-class/Employee.php";

$employeeObj = new Employee();

// Delete record from table
if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $employeeObj->deleteRecord($deleteId);
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
                        <h4 class="page-title">Remove an Employee</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="hr-home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Remove an Employee</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
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
                            <!--                            <div class="card-body">-->
                            <!--                                <h5 class="card-title m-b-0">Static Table With Checkboxes</h5>-->
                            <!--                            </div>-->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Employee ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Basic Salary</th>
                                        <th scope="col">Address</th>
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
                                                <td><?php echo $emp['Basic_Salary'] ?></td>
                                                <td><?php echo $emp['Address'] ?></td>
                                                <td><?php echo $emp['Tel_No'] ?></td>
                                                <td><?php echo $emp['Acc_No'] ?></td>
                                                <td><?php echo $emp['Bank_name'] ?></td>
                                                <td><?php echo $emp['Branch_name'] ?></td>
                                                <td>
                                                    <a id="removeEmployee" href="hr-remove-emp.php?deleteId=<?php echo $emp['Emp_ID'] ?>" onclick="return confirm('Are you sure you want to remove this employee?')" style="cursor: pointer;color: darkred;font-size: 20px" data-toggle="tooltip" title="Remove">
                                                        <i class="mdi mdi-account-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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