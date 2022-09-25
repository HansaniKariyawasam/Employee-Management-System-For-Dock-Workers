<?php
/**
 * Created by IntelliJ IDEA.
if(isset($_GET['name'])){
$name=$_GET['name'];
}* User: Hansani
 * Date: 2021-03-04
 * Time: 5:18 PM
 */

include "Connection/connection.php";
include 'hr-header.php';
//if(isset($_GET['name'])){
//    $name=$_GET['name'];
//}
?>

    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Worked Days Graph - <input type="text" id="year" disabled style="outline: none;background-color: transparent;border: none;"></h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Worked Days</li>
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
                            <div class="form-group row justify-content-between">
                                <div>
                                    <button style="float: left" href="#" onclick="pre();" class="btn btn-success" id="btnPre"><i class="fa fa-angle-left"></i>Previous Year</button>
                                </div>
                                <div class="form-group row col-6" style="position: center;">
                                    <select  id="Emp_ID" name="Emp_ID" class="select2 form-control custom-select col-md-5" style="float: none; height:36px;" required>
                                        <option value="">Select</option>
                                        <?php

                                        $query = "SELECT * FROM employee WHERE Current_status='Employed'";
                                        $result = mysqli_query($connection,$query);
                                        $data = array();

                                        if ($result->num_rows > 0) {

                                            while ($row = $result->fetch_assoc()) {
                                                $data[] = $row;
                                            }
                                        }
                                        $employees=$data;
                                        foreach ($employees as $employee) { ?>

                                            <option value="<?php echo $employee['Emp_ID'] ?>"><?php echo $employee['Name'] ?> </option>

                                        <?php } ?>
                                    </select>
                                    <button id="btnSearch1"  type="submit" name="search" class="btn btn-info" style="margin-left: 20px">Search</button>
                                </div>
                                <div>
                                    <button class="btn btn-success" onclick="next();" id="btnNext" style="float: right">Next Year<i class="fa fa-angle-right"></i></button>
                                </div>

                            </div>
                            <hr>

                            <div class="card-body" id="chartContainer" style="height: 400px; width: 100%;position: relative">



                            </div>
                            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                            <script>
                                // data =  {'action': clickBtnValue, 'from': fromDate, 'to' : toDate,  dataType: 'json'};


                                var year=(new Date()).getFullYear();
                                document.getElementById('year').value=year;
                                document.getElementById('btnNext').disabled=true;

                                $('#btnSearch1').click(function () {
                                    var id=$('#Emp_ID').val();

                                    renderChart(id);
                                });
                                window.onload = function (ev) {
                                    var id=$('#Emp_ID').val();
                                    renderChart(id);
                                }
                                function pre() {
                                    var id=$('#Emp_ID').val();
                                    year--;
                                    document.getElementById('year').value=year;
                                    renderChart(id);
                                    document.getElementById('btnNext').disabled=false;
                                }
                                function next() {
                                    var id=$('#Emp_ID').val();
                                    year++;
                                    document.getElementById('year').value=year;
                                    renderChart(id);
                                    if(year==(new Date()).getFullYear()){
                                        document.getElementById('btnNext').disabled=true;
                                    }
                                }
                                function renderChart(id) {
                                    $.ajax({
                                        method: "POST",
                                        url: "backend-php/report-worked-days.php",
                                        data: {val:year,id:id}
                                    })
                                        .done(function (result) {
                                            var val=JSON.parse(result);
                                            console.log(result);

                                            var chart = new CanvasJS.Chart("chartContainer", {
                                                animationEnabled: true,
                                                theme: "light2", // "light1", "light2", "dark1", "dark2"
                                                title: {
                                                    // text: "Employee worked Normal Over Time "+year
                                                },
                                                axisX: {
                                                    interval: 1,
                                                    intervalType: "month",
                                                    valueFormatString: "MMM"
                                                    // title: "Months"
                                                },

                                                axisY: {
                                                    title: "Worked Days",
                                                    // titleFontColor: "#4F81BC",
                                                    // lineColor: "#4F81BC",
                                                    // labelFontColor: "#4F81BC",
                                                    // tickColor: "#4F81BC",
                                                    includeZero: true,
                                                    valueFormatString: "#0"
                                                    // suffix: "%"
                                                },
                                                data: [{
                                                    type: "line",
                                                    markerSize: 12,
                                                    // name: "Worked Days",
                                                    xValueFormatString: "MMMM",
                                                    yValueFormatString: "###.#",
                                                    dataPoints: [
                                                        {x:new Date(2021, 0, 1),y: val[0][0][0] == null ? 0 : parseInt(val[0][0][0])},
                                                        {x:new Date(2021, 1, 1),y: val[1][0][0] == null ? 0 : parseInt(val[1][0][0])},
                                                        {x:new Date(2021, 2, 1),y: val[2][0][0] == null ? 0 : parseInt(val[2][0][0])},
                                                        {x:new Date(2021, 3, 1),y: val[3][0][0] == null ? 0 : parseInt(val[3][0][0])},
                                                        {x:new Date(2021, 4, 1),y: val[4][0][0] == null ? 0 : parseInt(val[4][0][0])},
                                                        {x:new Date(2021, 5, 1),y: val[5][0][0] == null ? 0 : parseInt(val[5][0][0])},
                                                        {x:new Date(2021, 6, 1),y: val[6][0][0] == null ? 0 : parseInt(val[6][0][0])},
                                                        {x:new Date(2021, 7, 1),y: val[7][0][0] == null ? 0 : parseInt(val[7][0][0])},
                                                        {x:new Date(2021, 8, 1),y: val[8][0][0] == null ? 0 : parseInt(val[8][0][0])},
                                                        {x:new Date(2021, 9, 1),y: val[9][0][0] == null ? 0 : parseInt(val[9][0][0])},
                                                        {x:new Date(2021, 10, 1),y: val[10][0][0] == null ? 0 : parseInt(val[10][0][0])},
                                                        {x:new Date(2021, 11, 1),y: val[11][0][0] == null ? 0 : parseInt(val[11][0][0])}
                                                    ]
                                                }]
                                            });
                                            chart.render();
                                        });
                                }

                            </script>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

<?php include "footer.php"?>