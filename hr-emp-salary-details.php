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
                    <h4 class="page-title">Employee Salary Details</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="hr-home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Employee Salary Details</li>
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
                            <form action="#" method="post" enctype="application/x-www-form-urlencoded" id="formSalarySearch">
                                <div class="form-group row">
                                    <label class="col-md-1 text-right control-label col-form-label" for="year">Year</label>
                                    <input type="text" class="col-md-3 form-control" name="year" id="year" maxlength="4">
                                    <label class="col-md-2 text-right control-label col-form-label" for="month">Month</label>
                                        <select class="select2 form-control custom-select col-2" id="month">
                                            <option value="">Select</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>

                                        </select>

<!--                                    <button id="btnSearchSalary"  type="submit" name="search" class="btn btn-info" style="margin-left: 30px">Search</button>-->
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
                            <div class="form-group row">

                            </div>
                            <div class="table-responsive">
                                <table id="tblEmpSalary-hr" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Worked Days</th>
                                        <th>Worked Sundays</th>
                                        <th>Worked Public Holidays</th>
                                        <th>BRA Allowance</th>
                                        <th>Total for EPF & ETF</th>
                                        <th>EPF 12%</th>
                                        <th>ETF 3%</th>
                                        <th>Other Allowances</th>
                                        <th>NOT Pay</th>
                                        <th>DOT Pay</th>
                                        <th>Net Salary</th>
                                        <th>EPF 8%</th>
                                        <th>Total Salary</th>
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
                                                    $('#tblEmpSalary-hr tbody').append('<tr>' +
                                                        '<td>'+jsonString[data]['Emp_ID']+'</td>' +
                                                        '<td>'+jsonString[data]['Name']+'</td>' +
                                                        '<td>'+jsonString[data]['Year']+'</td>' +
                                                        '<td>'+jsonString[data]['Month']+'</td>' +
                                                        '<td>'+jsonString[data]['Worked_days']+'</td>' +
                                                        '<td>'+jsonString[data]['Worked_sundays']+'</td>' +
                                                        '<td>'+jsonString[data]['Worked_pubHolidays']+'</td>' +
                                                        '<td>'+jsonString[data]['BRAllowance']+'</td>' +
                                                        '<td>'+jsonString[data]['tot_for_EPFETF']+'</td>' +
                                                        '<td>'+jsonString[data]['EPF_12']+'</td>' +
                                                        '<td>'+jsonString[data]['ETF_3']+'</td>' +
                                                        '<td>'+jsonString[data]['Other_llowance']+'</td>' +
                                                        '<td>'+jsonString[data]['NOT_pay']+'</td>' +
                                                        '<td>'+jsonString[data]['DOT_pay']+'</td>' +
                                                        '<td>'+jsonString[data]['Net_salary']+'</td>' +
                                                        '<td>'+jsonString[data]['EPF_8']+'</td>' +
                                                        '<td>'+jsonString[data]['tot_salary']+'</td>' +
                                                        '</tr>')
                                                }
                                            }

                                        };

                                        httpRqst.open('GET','backend-php/emp-salary-details.php',true);

                                        httpRqst.send();
                                    });
                                </script>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script>



                                $('#btnSearch2').click(function() {

                                    $.ajax({
                                        url: "/myProjects/Payroll Management System/backend-php/search-emp-salary.php?id=" + $('#id').val() + "&name=" + $('#name').val()+"&month="+ $('#month').val()+"&year="+$('#year').val(),
                                        type: "get",
                                        beforeSend: function() {
                                            $('#tblEmpSalary-hr tbody').empty();
                                        },
                                        success: function(result) {
                                            if(result.length===0){
                                                alert('Not Found');
                                            }else{
                                                for (var i = 0; i < result.length; i++) {
                                                    var row = $('<tr><td>' + result[i].Emp_ID + '</td><td>' + result[i].Name + '</td><td>' + result[i].Year + '</td><td>' + result[i].Month + '</td><td>' + result[i].Worked_days + '</td><td>' + result[i].Worked_sundays + '</td><td>' + result[i].Worked_pubHolidays + '</td><td>' + result[i].BRAllowance + '</td><td>' + result[i].tot_for_EPFETF + '</td><td>' + result[i].EPF_12 + '</td><td>' + result[i].ETF_3 + '</td><td>' + result[i].Other_llowance + '</td><td>' + result[i].NOT_pay + '</td><td>' + result[i].DOT_pay + '</td><td>' + result[i].Net_salary + '</td><td>' + result[i].EPF_8 + '</td><td>' + result[i].tot_salary + '</td></tr>');
                                                    $('#tblEmpSalary-hr').append(row);
                                                }
                                            }

                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            alert('Error: ' + textStatus + ' - ' + errorThrown);
                                        }
                                    });
                                    return false;
                                });

                                $("#year,#id").keydown(function (e) {

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
<?php include "footer.php"?>