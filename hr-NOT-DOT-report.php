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
                    <h4 class="page-title">Employee Normal OT & Double OT Details - <input type="text" id="year" disabled style="outline: none;background-color: transparent;border: none;"> </h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Normal OT</li>
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
                                        url: "backend-php/report-nOT-dOT.php",
                                        data: {val:year,id:id}
                                    })
                                        .done(function (result) {
                                            var val=JSON.parse(result);
                                            console.log(val[1][0][0]);

                                            var chart = new CanvasJS.Chart("chartContainer", {
                                                animationEnabled: true,
                                                theme: "light2", // "light1", "light2", "dark1", "dark2"
                                                title: {
                                                    // text: "Employee worked Normal Over Time "+year
                                                },
                                                axisY: {
                                                    title: "Normal OT/hrs",
                                                    titleFontColor: "#bc6eb6",
                                                    lineColor: "#bc6eb6",
                                                    labelFontColor: "#bc6eb6",
                                                    tickColor: "#bc6eb6",
                                                    includeZero: true
                                                },
                                                axisY2: {
                                                    title: "Double OT/hrs",
                                                    titleFontColor: "#c0af3a",
                                                    lineColor: "#c0af3a",
                                                    labelFontColor: "#c0af3a",
                                                    tickColor: "#c0af3a",
                                                    includeZero: true
                                                },
                                                axisX: {
                                                    title: "Months"
                                                },
                                                toolTip: {
                                                    shared: true
                                                },
                                                data: [{
                                                    type: "column",
                                                    name: "NOT",
                                                    color:"#bc6eb6",
                                                    showInLegend: true,
                                                    // yValueFormatString: "#,##0#\"",
                                                    dataPoints: [
                                                        { y: val[0][0][0]==null?0:parseInt(val[0][0][0]), label: "January" },
                                                        { y: val[1][0][0]==null?0:parseInt(val[1][0][0]),  label: "February" },
                                                        { y: val[2][0][0]==null?0:parseInt(val[2][0][0]),  label: "March" },
                                                        { y: val[3][0][0]==null?0:parseInt(val[3][0][0]),  label: "April" },
                                                        { y: val[4][0][0]==null?0:parseInt(val[4][0][0]),  label: "May" },
                                                        { y: val[5][0][0]==null?0:parseInt(val[5][0][0]), label: "June" },
                                                        { y: val[6][0][0]==null?0:parseInt(val[6][0][0]),  label: "July" },
                                                        { y: val[7][0][0]==null?0:parseInt(val[7][0][0]),  label: "August" },
                                                        { y: val[8][0][0]==null?0:parseInt(val[8][0][0]),  label: "September" },
                                                        { y: val[9][0][0]==null?0:parseInt(val[9][0][0]),  label: "October" },
                                                        { y: val[10][0][0]==null?0:parseInt(val[10][0][0]),  label: "November" },
                                                        { y: val[11][0][0]==null?0:parseInt(val[11][0][0]),  label: "December" }
                                                    ]
                                                },{
                                                    type: "column",
                                                    name: "DOT",
                                                    color: "#c0af3a",
                                                    axisYType: "secondary",
                                                    showInLegend: true,
                                                    dataPoints: [
                                                        {y: val[0][0][1] == null ? 0 : parseInt(val[0][0][1]),label: "January"},
                                                        {y: val[1][0][1] == null ? 0 : parseInt(val[1][0][1]),label: "February"},
                                                        {y: val[2][0][1] == null ? 0 : parseInt(val[2][0][1]),label: "March"},
                                                        {y: val[3][0][1] == null ? 0 : parseInt(val[3][0][1]),label: "April"},
                                                        {y: val[4][0][1] == null ? 0 : parseInt(val[4][0][1]), label: "May"},
                                                        {y: val[5][0][1] == null ? 0 : parseInt(val[5][0][1]), label: "June"},
                                                        {y: val[6][0][1] == null ? 0 : parseInt(val[6][0][1]), label: "July"},
                                                        {y: val[7][0][1] == null ? 0 : parseInt(val[7][0][1]), label: "August"},
                                                        {y: val[8][0][1] == null ? 0 : parseInt(val[8][0][1]), label: "September"},
                                                        {y: val[9][0][1] == null ? 0 : parseInt(val[9][0][1]), label: "October"},
                                                        {y: val[10][0][1] == null ? 0 : parseInt(val[10][0][1]), label: "November"},
                                                        {y: val[11][0][1] == null ? 0 : parseInt(val[11][0][1]), label: "December"}
                                                    ]
                                                }
                                                ]
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