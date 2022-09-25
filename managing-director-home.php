<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-03-03
 * Time: 10:43 PM
 */
include 'md-header.php';
include "Connection/connection.php";

?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Managing Director Home</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
<!--                                    <li class="breadcrumb-item"><a href="#">Home</a></li>-->
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
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
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card">
                            <div class="bg-success p-10 text-white text-center">
                                <i class="fa fa-user m-b-5 font-16 font-weight-bold"></i>
                                <small class=" font-weight-bold">Total Employees</small>
                                <?php
                                $employeeQuery="SELECT COUNT(Emp_ID) AS 'Total_employee' FROM employee";
                                $resultEmployee=mysqli_query($connection,$employeeQuery);
                                if($resultEmployee){
                                    $rowEmp = mysqli_fetch_assoc($resultEmployee);

                                    ?>
                                    <h5 class="m-b-0 m-t-5 font-weight-bold font-weight-bold"><?php echo $rowEmp['Total_employee']; ?></h5>
                                    <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card">
                            <div class="bg-warning p-10 text-white text-center">
                                <i class="mdi mdi-account-multiple m-b-5 font-16 font-weight-bold"></i>
                                <small class=" font-weight-bold">Total Children</small>
                                <?php
                                $childQuery="SELECT COUNT(Number) AS 'Total_child' FROM child";
                                $resultChild=mysqli_query($connection,$childQuery);
                                if($resultChild){
                                    $rowChild = mysqli_fetch_assoc($resultChild);
                                    ?>
                                    <h5 class="m-b-0 m-t-5 font-weight-bold font-weight-bold"><?php echo $rowChild['Total_child']; ?></h5>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-5">
                        <div class="card">
                            <div class="bg-info p-10 text-white text-center">
                                <i class="fa fa-user m-b-5 font-16 font-weight-bold"></i>
                                <small class="font-weight-bold">Resigned Employees</small>
                                <?php
                                $employeeQuery="SELECT COUNT(Emp_ID) AS 'Total_resigned' FROM employee WHERE Current_status='Resigned'";
                                $resultResigned=mysqli_query($connection,$employeeQuery);
                                if($resultResigned){
                                    $rowResigned = mysqli_fetch_assoc($resultResigned);
                                    ?>
                                    <h5 class="m-b-0 m-t-5 font-weight-bold font-weight-bold"><?php echo $rowResigned['Total_resigned']; ?></h5>
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

<?php include "footer.php" ?>