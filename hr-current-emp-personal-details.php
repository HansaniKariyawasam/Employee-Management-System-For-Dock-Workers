<?php
include "hr-header.php";
?>
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Current Employee Personal Details</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="hr-home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Employee Personal Details</li>
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

                            <div class="table-responsive">
                                <table id="tblEmpPersonal-hr" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Current Status</th>
                                        <th>NIC</th>
                                        <th>Team Name</th>
                                        <th>Basic Salary</th>
                                        <th>Permanent Address</th>
                                        <th>Temporary Address</th>
                                        <th>Telephone No</th>
                                        <th>Account No</th>
                                        <th>Bank</th>
                                        <th>Branch</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <script src="dist/js/jquery-3.2.1.min.js"></script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script>
                                    $(function () {
                                        var httpRqst=new XMLHttpRequest();

                                        httpRqst.onreadystatechange=function () {

                                            if(httpRqst.readyState === 4 && httpRqst.status===200){
                                                var jsonString=JSON.parse(httpRqst.responseText);
                                                console.log(jsonString);
                                                for(var data in jsonString) {
                                                    $('#tblEmpPersonal-hr tbody').append('<tr>' +
                                                        '<td>'+jsonString[data]['Emp_ID']+'</td>' +
                                                        '<td>'+jsonString[data]['Name']+'</td>' +
                                                        '<td>'+jsonString[data]['Current_status']+'</td>' +
                                                        '<td>'+jsonString[data]['NIC']+'</td>' +
                                                        '<td>'+jsonString[data]['Team_Name']+'</td>' +
                                                        '<td>'+jsonString[data]['Basic_Salary']+'</td>' +
                                                        '<td>'+jsonString[data]['Permanent_address']+'</td>' +
                                                        '<td>'+jsonString[data]['Temporary_address']+'</td>' +
                                                        '<td>'+jsonString[data]['Tel_No']+'</td>' +
                                                        '<td>'+jsonString[data]['Acc_No']+'</td>' +
                                                        '<td>'+jsonString[data]['Bank_name']+'</td>' +
                                                        '<td>'+jsonString[data]['Branch_name']+'</td>' +
                                                        '</tr>')
                                                }
                                            }

                                        };

                                        httpRqst.open('GET','backend-php/current-emp-personal-details.php',true);

                                        httpRqst.send();
                                    });

                                    $('#btnSearch2').click(function() {

                                        $.ajax({
                                            url: "/myProjects/Payroll Management System/backend-php/search-emp-personal-details.php?status=Employed&id=" + $('#id').val() + "&name=" + $('#name').val(),
                                            type: "get",
                                            beforeSend: function() {
                                                $('#tblEmpPersonal-hr tbody').empty();
                                            },
                                            success: function(result) {
                                                console.log(result);
                                                if(result.length===0){
                                                    alert('Not Found');
                                                }else{
                                                    for (var i = 0; i < result.length; i++) {
                                                        console.log(result);
                                                        var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].Current_status + '</td><td>' + result[i].NIC + '</td><td>' + result[i].Team_Name + '</td><td>' + result[i].Basic_Salary + '</td><td>' + result[i].Permanent_address + '</td><td>' + result[i].Temporary_address + '</td><td>' + result[i].Tel_No + '</td><td>' + result[i].Acc_No + '</td><td>' + result[i].Bank_name + '</td><td>' + result[i].Branch_name + '</td></tr>');
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
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    ((((((<script src="dist/js/jquery-3.2.1.min.js"></script>)))))))))))
<?php include "footer.php"?>