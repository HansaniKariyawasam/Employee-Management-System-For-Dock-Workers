<?php
include "Connection/connection.php";
include "md-header.php";
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">EPF and ETF Summary - <input type="text" id="year" disabled style="outline: none;background-color: transparent;border: none;"></h4>

                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">EPF and ETF Summary</li>
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
                        <div class="form-group row justify-content-between">
                            <div>
                                <button style="float: left" href="#" onclick="pre();" class="btn btn-success" id="btnPre"><i class="fa fa-angle-left"></i>Previous Year</button>
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

                            window.onload = function (ev) {
                                renderChart();
                            }
                            function pre() {
                                year--;
                                document.getElementById('year').value=year;
                                renderChart();
                                document.getElementById('btnNext').disabled=false;
                            }
                            function next() {
                                year++;
                                document.getElementById('year').value=year;
                                renderChart();
                                if(year==(new Date()).getFullYear()){
                                    document.getElementById('btnNext').disabled=true;
                                }
                            }
                            function renderChart() {
                                $.ajax({
                                    method: "POST",
                                    url: "backend-php/report-liability.php",
                                    data: {val:year}
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
                                            axisY: {
                                                title: "EPF 20%/Rupees",
                                                titleFontColor: "#4F81BC",
                                                lineColor: "#4F81BC",
                                                labelFontColor: "#4F81BC",
                                                tickColor: "#4F81BC",
                                                includeZero: true
                                                // suffix: "%"
                                            },
                                            axisY2: {
                                                title: "ETF 8%/Rupees",
                                                titleFontColor: "#28c08a",
                                                lineColor: "#28c08a",
                                                labelFontColor: "#28c08a",
                                                tickColor: "#28c08a",
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
                                                name: "EPF 12% + EPF 8%",
                                                showInLegend: true,
                                                yValueFormatString: "#, ##0.00#",
                                                dataPoints: [
                                                    {y: val[0][0][0] == null ? 0 : parseInt(val[0][0][0]),label: "January"},
                                                    {y: val[1][0][0] == null ? 0 : parseInt(val[1][0][0]),label: "February"},
                                                    {y: val[2][0][0] == null ? 0 : parseInt(val[2][0][0]),label: "March"},
                                                    {y: val[3][0][0] == null ? 0 : parseInt(val[3][0][0]),label: "April"},
                                                    {y: val[4][0][0] == null ? 0 : parseInt(val[4][0][0]), label: "May"},
                                                    {y: val[5][0][0] == null ? 0 : parseInt(val[5][0][0]), label: "June"},
                                                    {y: val[6][0][0] == null ? 0 : parseInt(val[6][0][0]), label: "July"},
                                                    {y: val[7][0][0] == null ? 0 : parseInt(val[7][0][0]), label: "August"},
                                                    {y: val[8][0][0] == null ? 0 : parseInt(val[8][0][0]), label: "September"},
                                                    {y: val[9][0][0] == null ? 0 : parseInt(val[9][0][0]), label: "October"},
                                                    {y: val[10][0][0] == null ? 0 : parseInt(val[10][0][0]), label: "November"},
                                                    {y: val[11][0][0] == null ? 0 : parseInt(val[11][0][0]), label: "December"}
                                                ]
                                            },
                                                {
                                                    type: "column",
                                                    name: "ETF 3%",
                                                    axisYType: "secondary",
                                                    showInLegend: true,
                                                    yValueFormatString: "#,##0.00#",
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

<?php include "footer.php";?>
