<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-03-04
 * Time: 5:19 PM
 */
session_start();
if($_SESSION['logged']!=true){
    echo "<script>window.location.replace('index.php');</script>";
}
include "Connection/connection.php";


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>B. P. E. S</title>

    <!--Table-->
<!--    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">-->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!--End Table-->

    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
    <link href="assets/libs/jquery-steps/steps.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>



    <![endif]-->


</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="hr-home.php">
                    <!-- Logo icon -->
                    <b class="logo-icon p-l-10">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />

                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" />

                        </span>
                    <!-- Logo icon -->
                    <!-- <b class="logo-icon"> -->
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                    <!-- </b> -->
                    <!--End Logo icon -->
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    <!-- ============================================================== -->


                </ul>
                <label style="color: whitesmoke;font-size: 18px;font-family:'Times New Roman';float: left;padding: 10px">Welcome! <?php echo $_SESSION['Name']; ?></label>
                <a href="index.php" aria-expanded="false" data-toggle="tooltip" title="Log Out" style="padding: 10px"><i class="fas fa-power-off" style="color: red;font-size: 20px"></i></a>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hr-home.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-card-details"></i><span class="hide-menu">Employee Personal Details</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="hr-current-emp-personal-details.php" class="sidebar-link"><i class="mdi mdi-account-card-details"></i><span class="hide-menu"> Current Employees </span></a></li>
                            <li class="sidebar-item"><a href="hr-resigned-emp-personal-details.php" class="sidebar-link"><i class="fas fa-user-times"></i><span class="hide-menu"> Resigned Employees </span></a></li>
                            <!--                            <li class="sidebar-item"><a href="hr-remove-emp.php" class="sidebar-link"><i class="mdi mdi-account-remove"></i><span class="hide-menu"> Remove an Employee </span></a></li>-->
                        </ul>
                    </li>
<!--                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hr-emp-personal-details.php" aria-expanded="false"><i class="mdi mdi-account-card-details"></i><span class="hide-menu">Employee Personal Details</span></a></li>-->
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hr-emp-attendance-details.php" aria-expanded="false"><i class="fas fa-list"></i><span class="hide-menu">Employee Attendance Details</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hr-emp-salary-details.php?name" aria-expanded="false"><i class="fas fa-dollar-sign"></i><span class="hide-menu">Employee Salary Details</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Manage Employee </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="hr-register-emp.php" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> Register an Employee </span></a></li>
                            <li class="sidebar-item"><a href="hr-modify-emp.php" class="sidebar-link"><i class="mdi mdi-account-edit"></i><span class="hide-menu"> Modify an Employee </span></a></li>
<!--                            <li class="sidebar-item"><a href="hr-remove-emp.php" class="sidebar-link"><i class="mdi mdi-account-remove"></i><span class="hide-menu"> Remove an Employee </span></a></li>-->
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hr-generate-salary-sheet.php" aria-expanded="false"><i class="fas fa-dollar-sign"></i><span class="hide-menu">Generate Final Salary Sheet</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file-chart"></i><span class="hide-menu">Reports </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file-chart"></i><span class="hide-menu">Attendance Reports</span></a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item"><a href="hr-worked-days-report.php" class="sidebar-link"><i class="mdi mdi-file-document"></i><span class="hide-menu">Worked Days</span></a></li>
                                    <li class="sidebar-item"><a href="hr-leaves-report.php" class="sidebar-link"><i class="mdi mdi-file"></i><span class="hide-menu">Leave Days</span></a></li>
                                    <li class="sidebar-item"><a href="hr-short-leaves-report.php" class="sidebar-link"><i class="mdi mdi-file-document"></i><span class="hide-menu">Short Leave Days</span></a></li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hr-NOT-DOT-report.php" aria-expanded="false"><i class="mdi mdi-file-chart"></i><span class="hide-menu">NOT and DOT Reports</span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hr-gift-details.php" aria-expanded="false"><i class="mdi mdi-gift"></i><span class="hide-menu">Children Gift Details</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="index.php" class="sidebar-link"><i class="mdi mdi-logout"></i><span class="hide-menu">Log Out</span></a></li>
                            <li class="sidebar-item"><a href="hr-password-change.php" class="sidebar-link"><i class="mdi mdi-key"></i><span class="hide-menu">Change Password </span></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->


