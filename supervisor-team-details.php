<?php
include "supervisor-header.php";
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Employee Attendance Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="supervisor-home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employee Team Details</li>
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
                        <form id="formTeam" enctype="application/x-www-form-urlencoded" method="post" action="#">
                            <div class="form-group row">
                                <label class="col-sm-2 text-right control-label col-form-label" for="team">Select a Team</label>
                                <select id="team" class="select2 form-control custom-select col-2" >
                                    <option value="">Select</option>
                                    <option value="RTG">RTG</option>
                                    <option value="QC">QC</option>
                                    <option value="HIPG">HIPG</option>
                                    <option value="ZCM">ZCM</option>
                                    <option value="SAGT">SAGT</option>

                                </select>
<!--                                <select id="team" name="team" class="select2 form-control custom-select col-2" style="width: 100%; height:36px;">-->
<!--                                    <option value="">Select</option>-->
<!--                                    <?php
//                                    //                                        $connection=mysqli_connect('localhost','root','1702408-Hansani','BPES');
//                                    $query="SELECT * FROM Team";
//                                    if($connection){
//                                        $result=mysqli_query($connection,$query);
//                                        if(mysqli_num_rows($result)>0){
//                                            $rowData=mysqli_fetch_array($result,MYSQLI_ASSOC);
//                                            echo "<option value='". $rowData['Team_No'] ."'>" .$rowData['Team_Name'] ."</option>"; // displaying data in 1st option value
//                                            while($data = mysqli_fetch_array($result,MYSQLI_ASSOC)){
//                                                echo "<option value='". $data['Team_No'] ."'>" .$data['Team_Name'] ."</option>";  // displaying data in option menu
//                                            }
////
//
//                                        }
//                                    }
//
//                                    ?>
<!--                                </select>-->
                                <button id="btnSearch"  type="submit" name="search" class="btn btn-info" style="margin-left: 30px">Search</button>
                            </div>

                            <hr>
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
                        <div class="table-responsive">
                            <table id="tblTeamDetails-sup" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Team</th>
                                    <th>Team Engineer Name</th>
                                    <th>Engineer Telephone No</th>
                                    <th>Engineer Email Address</th>
                                </tr>
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
                            <script src="dist/js/jquery-3.2.1.min.js"></script>
                            <script>
                                $(function () {
                                    var httpRqst=new XMLHttpRequest();

                                    httpRqst.onreadystatechange=function () {

                                        if(httpRqst.readyState === 4 && httpRqst.status===200){
                                            var jsonString=JSON.parse(httpRqst.responseText);
                                            console.log(jsonString);
                                            for(var data in jsonString) {
                                                $('#tblTeamDetails-sup tbody').append('<tr>' +
                                                    '<td>'+jsonString[data]['Emp_ID']+'</td>' +
                                                    '<td>'+jsonString[data]['Name']+'</td>' +
                                                    '<td>'+jsonString[data]['Team_Name']+'</td>' +
                                                    '<td>'+jsonString[data]['Engineer_name']+'</td>' +
                                                    '<td>'+jsonString[data]['eng_telephone']+'</td>' +
                                                    '<td>'+jsonString[data]['eng_email']+'</td>' +
                                                    '</tr>')
                                            }
                                        }

                                    };

                                    httpRqst.open('GET','backend-php/view-team-details.php',true);

                                    httpRqst.send();
                                });
                            </script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                            <script>
                                $('#btnSearch').click(function() {
                                    $('#id').val('');
                                    $('#name').val('');
                                    $.ajax({
                                        url: "/myProjects/Payroll Management System/backend-php/search-team-details-byTeam.php?team=" + $('#team').val(),
                                        type: "get",
                                        beforeSend: function() {
                                            $('#tblTeamDetails-sup tbody').empty();
                                        },
                                        success: function(result) {
                                            if(result.length===0){
                                                alert('Not Found');
                                            }else{
                                                for (var i = 0; i < result.length; i++) {
                                                    var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].Team_Name + '</td><td>' + result[i].Engineer_name + '</td><td>' + result[i].eng_telephone + '</td><td>' + result[i].eng_email + '</td></tr>');
                                                    $('#tblTeamDetails-sup').append(row);
                                                }
                                            }

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            alert('Error: ' + textStatus + ' - ' + errorThrown);
                                        }

                                    });
                                    return false;
                                });



                                $('#btnSearch2').click(function() {
                                    $('#team').val('');

                                    $.ajax({
                                        url: "/myProjects/Payroll Management System/backend-php/search-team-details-byID.php?id=" + $('#id').val() + "&name=" + $('#name').val(),
                                        type: "get",
                                        beforeSend: function() {
                                            $('#tblTeamDetails-sup tbody').empty();
                                        },
                                        success: function(result) {
                                            if(result.length===0){
                                                alert('Not Found');
                                            }else{
                                                for (var i = 0; i < result.length; i++) {
                                                    var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].Team_Name + '</td><td>' + result[i].Engineer_name + '</td><td>' + result[i].eng_telephone + '</td><td>' + result[i].eng_email + '</td></tr>');
                                                    $('#tblTeamDetails-sup').append(row);
                                                }
                                            }

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            alert('Error: ' + textStatus + ' - ' + errorThrown);
                                        }
                                    });
                                    return false;
                                });
                            </script>
                        </div>

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
<!--<script src="dist/js/pages/chart/chart-page-init.js"></script>-->
<!--<script src="assets/extra-libs/DataTables/datatables.min.js"></script>-->
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<?php include "footer.php"?>
