<?php
include "hr-header.php";
?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Gift Details</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="hr-home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gift Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <p class="text-left" for="date" style="padding: 5px">- Search by ID or Name -</p>


                            <div id="divSearch" class="form-group row">
                                <label class="col-md-1 text-right control-label col-form-label" for="id">ID</label>
                                <input type="text" class="col-md-3 form-control" name="id" id="id">



                                <label class="col-md-1 text-right control-label col-form-label" for="name">Name</label>
                                <input type="text" class="col-md-3 form-control" name="name" id="name">


                                <button id="btnSearch2"  type="submit" name="search" class="btn btn-info" style="margin-left: 20px;">Search</button>

                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table id="tbl_hrGift" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Date of Birth</th>
                                        <th>Blank Book</th>
                                        <th>Drawing Book</th>
                                        <th>Pastel Box</th>
                                        <th>Single Rule 80pg</th>
                                        <th>Single Rule 120pg</th>
                                        <th>Single Rule 160pg</th>
                                        <th>Single Rule 200pg</th>
                                        <th>Single Rule CR 120pg</th>
                                        <th>Pencil</th>
                                        <th>Eraser</th>
                                        <th>Foot Ruler</th>
                                        <th>Geometry Box</th>
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
                                                console.log(httpRqst.responseText);
                                                var jsonString=JSON.parse(httpRqst.responseText);
                                                console.log(jsonString);
                                                for(var data in jsonString) {
                                                    $('#tbl_hrGift tbody').append('<tr>' +
                                                        '<td>'+jsonString[data]['Emp_ID']+'</td>' +
                                                        '<td>'+jsonString[data]['Name']+'</td>' +
                                                        '<td>'+jsonString[data]['DOB']+'</td>' +
                                                        '<td>'+jsonString[data]['Blank_Book']+'</td>' +
                                                        '<td>'+jsonString[data]['Draw_Book']+'</td>' +
                                                        '<td>'+jsonString[data]['Pastel_Box']+'</td>' +
                                                        '<td>'+jsonString[data]['Single_80']+'</td>' +
                                                        '<td>'+jsonString[data]['Single_120']+'</td>' +
                                                        '<td>'+jsonString[data]['Single_160']+'</td>' +
                                                        '<td>'+jsonString[data]['Single_200']+'</td>' +
                                                        '<td>'+jsonString[data]['Single_CR120']+'</td>' +
                                                        '<td>'+jsonString[data]['Pensil']+'</td>' +
                                                        '<td>'+jsonString[data]['Eraser']+'</td>' +
                                                        '<td>'+jsonString[data]['Foot_ruler']+'</td>' +
                                                        '<td>'+jsonString[data]['Geometry_box']+'</td>' +
                                                        '</tr>')
                                                }
                                            }

                                        };

                                        httpRqst.open('GET','backend-php/view-gift-details.php',true);

                                        httpRqst.send();
                                    });
                                </script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script>
                                    $('#btnSearch2').click(function() {
                                        $.ajax({
                                            url: "/myProjects/Payroll Management System/backend-php/search-gift-details.php?id=" + $('#id').val() + "&name=" + $('#name').val(),
                                            type: "get",
                                            beforeSend: function() {
                                                $('#tbl_hrGift tbody').empty();
                                                console.log($('#id').val());
                                                console.log($('#name').val());
                                            },
                                            success: function(result) {
                                                console.log(result);
                                                if(result.length===0){
                                                    alert('Not Found');
                                                }else{
                                                    for (var i = 0; i < result.length; i++) {
                                                        var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].DOB + '</td><td>' + result[i].Blank_Book + '</td><td>' + result[i].Draw_Book + '</td><td>' + result[i].Pastel_Box + '</td><td>' + result[i].Single_80 + '</td><td>' + result[i].Single_120 + '</td><td>' + result[i].Single_160 + '</td><td>' + result[i].Single_200 + '</td><td>' + result[i].Single_CR120 + '</td><td>' + result[i].Pensil + '</td><td>' + result[i].Eraser + '</td><td>' + result[i].Foot_ruler + '</td><td>' + result[i].Geometry_box + '</td></tr>');
                                                        $('#tbl_hrGift').append(row);
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
                            <div>
                                <form method="post" action="employee-home.php">
                                    <div style="padding: 50px">
                                        <button name="pdf" id="btnDownload"  type="submit" class="btn btn-info" style="margin-left: 20px;float:right;"><a target="_blank" href="pdf-generators/gift-details-summary.php" style="color: white;" onmouseover="this.style.color='white'">Download Gift Report</a></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
        </div>

    </div>
<?php include "footer.php"?>