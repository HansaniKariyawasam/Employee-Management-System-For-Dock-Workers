<?php
include "admin-header.php"
?>
    <div id="main-wrapper">
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Remove a User</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Remove a User</li>
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
<!--                            <div class="card-body">-->
<!--                                <h5 class="card-title m-b-0">Static Table With Checkboxes</h5>-->
<!--                            </div>-->
                            <div class="table-responsive">
                                <table class="table" id="tblRemoveUser">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Name</th>
<!--					                    <th scope="col">Email Address</th>-->
                                        <th scope="col">Designation</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="customtable">
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
                                                    //Pass the Username of the user to backend php file of remove-a-user.php through the query string
                                                    var href="backend-php/remove-a-user.php?username="+jsonString[data]['Username'];

                                                    $('#tblRemoveUser tbody').append('<tr>' +
                                                        '<td>'+jsonString[data]['Username']+'</td>' +
                                                        '<td>'+jsonString[data]['Name']+'</td>' +
							                            // '<td>'+jsonString[data]['email']+'</td>' +
                                                        '<td>'+jsonString[data]['Designation']+'</td>' +
                                                        '<td>'+jsonString[data]['Status']+'</td>' +
                                                        '<td>' +
                                                            '<a id="removeEmployee" onclick="return confirmation();" style="cursor: pointer;color: darkred;font-size: 20px" data-toggle="tooltip" title="Remove" href="' + href + '">' +
                                                                '<i class="mdi mdi-account-remove"></i>' +
                                                            '</a>' +
                                                        '</td>'+
                                                        '</tr>')
                                                }
                                            }

                                        };

                                        httpRqst.open('GET','backend-php/view-user-details.php',true);

                                        httpRqst.send();
                                    });

                                    function confirmation() {
                                        return confirm('Are you sure, you want to remove this user?');
                                    }


                                </script>
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

<?php include "footer.php";

