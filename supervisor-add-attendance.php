<?php
include "supervisor-header.php";
?>
<link href="dist/dropzone/css/dropzone.css" rel="stylesheet" type="text/css">
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Add Attendance Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="supervisor-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Attendance Details</li>
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
<!--                        <h5 class="card-title">-->
<!--                            UPLOAD THE ATTENDANCE EXCEL SHEET<br>-->
<!--                            <small>File type should be <b>.xlsx</b></small>-->
<!--                        </h5>-->
<!--                        <div class="body">-->
<!--                            <div class="col-md-9">-->
<!--                                <div class="custom-file">-->
<!--                                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>-->
<!--                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>-->
<!--                                    <div class="invalid-feedback">Example invalid custom file feedback</div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <p class="text-left" for="date" style="padding: 5px;color: red;font-size: 15px"><b>- You cannot upload attendance details of any previous or future months-</b></p>

                        <form action="backend-php/attendance-file-uploading.php" method="post" enctype="multipart/form-data" id="formUploading">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                <input type="file" name="the_file" class="drop-zone__input" id="fileUpload">
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button id="btnUpload" onclick="getPath()" type="submit" name="submit" class="btn btn-info" style="width: 20%">Save the attendance</button>
                                </div>
                            </div>
                        </form>
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
<script src="dist/dropzone/js/dropzone.js"></script>
<script src="dist/js/my/supervisor.js"></script>
<!--<script src="dist/js/pages/chart/chart-page-init.js"></script>-->
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<?php include "footer.php"?>

