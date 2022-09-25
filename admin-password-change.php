<?php
include "admin-header.php";
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Change your Password</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal m-t-20" action="backend-php/change-password.php" method="post">
                                <div class="row p-b-30">
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <label for="username" class="col-sm-2 text-right control-label col-form-label">Username</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" id="username" name="Username" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label for="current_Password" class="col-sm-2 text-right control-label col-form-label">Current Password</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-pencil"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg" placeholder="Current Password" name="current_Password" id="current_Password" aria-label="current_Password" aria-describedby="basic-addon1" required>
                                        </div>
                                        <!-- email -->
                                        <div class="input-group mb-3">
                                            <label for="new_Password" class="col-sm-2 text-right control-label col-form-label">New Password</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-danger text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg" placeholder="New Password" name="new_Password" id="new_Password" aria-label="new_Password" aria-describedby="basic-addon1" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <label for="confirm_Password" class="col-sm-2 text-right control-label col-form-label">Confirm Password</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-warning text-white" id="basic-addon3"><i class="ti-pencil"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name="confirm_Password" id="confirm_Password" aria-label="confirm_Password" aria-describedby="basic-addon1" required>
                                        </div>

                                    </div>
                                </div>
                                <div class="row border-top border-secondary">
                                    <div class="col-12" style="float:right;">
                                        <div class="form-group" style="float:right;">
                                            <div class="p-t-20" style="float:right;">
                                                <button class="btn btn-block btn-lg btn-info" type="submit" style="float:right;">Change Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"?>
