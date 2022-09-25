<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-04-25
 * Time: 7:45 PM
 */
include "hr-header.php";
?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">PayMaster Sheet of <?php echo date('F');?> Month</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="hr-home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Generate Salary Sheet</li>
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
                            <p class="text-left" for="date" style="padding: 5px;color: red;font-size: 15px"><b>- You can generate this sheet at the end of the month after the salary save -</b></p>
<!--                            <form action="#" method="post" enctype="application/x-www-form-urlencoded" id="formGenerateSalary">-->
<!--                                <div class="form-group row">-->
<!--                                    <label class="col-md-2 text-right control-label col-form-label" for="month">Select a Month</label>-->
<!--                                    <select class="select2 form-control custom-select col-2" >-->
<!--                                        <option value="">Select</option>-->
<!--                                        --><?php
//                                        // Current month
//                                        echo '<option>' . date('F') . "</option>\n";
//                                        // Previous Month
//                                        echo '<option>' . date('F', strtotime("last month")) . "</option>\n";
//                                        ?>
<!--                                    </select>-->
<!---->
<!--                                    <button id="btnSearchSalary"  type="submit" name="search" class="btn btn-info" style="margin-left: 30px">Search</button>-->
<!--                                </div>-->
<!--                            </form>-->
                            <div class="table-responsive">
                                <table id="tblGenerateSalary-hr" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Trans ID</th>
                                        <th>Destination Bank</th>
                                        <th>Destination Branch</th>
                                        <th>Destination Account</th>
                                        <th>Destination Account Name</th>
                                        <th>TRN Code</th>
                                        <th>Return Code</th>
                                        <th>Cr/Dr Code</th>
                                        <th>Return Date</th>
                                        <th>Amount</th>
                                        <th>Currency Code</th>
                                        <th>Originating Bank</th>
                                        <th>Originating Branch</th>
                                        <th>Originating Account</th>
                                        <th>Originating Account Name</th>
                                        <th>Particulars</th>
                                        <th>Reference</th>
                                        <th>Value Date (YYMMDD)</th>
                                        <th>Security Field</th>
                                        <th>Filler</th>
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
                                                let total=0;
                                                var reference="";
                                                var date="";
                                                var particular="";
                                                console.log(jsonString);
                                                for(var data in jsonString) {
                                                    reference=jsonString[data]['Reference'];
                                                    date=jsonString[data]['Date'];
                                                    particular="BPES"+jsonString[data]['Reference'];
                                                    total+=parseFloat(jsonString[data]['tot_salary']);
                                                    $('#tblGenerateSalary-hr tbody').append('<tr>' +
                                                        '<td>0000</td>' +
                                                        '<td>'+jsonString[data]['Bank_code']+'</td>' +
                                                        '<td>'+jsonString[data]['Branch_code']+'</td>' +
                                                        '<td>'+jsonString[data]['Acc_no']+'</td>' +
                                                        '<td>'+jsonString[data]['Name']+'</td>' +
                                                        '<td>23</td>' +
                                                        '<td>00</td>' +
                                                        '<td>0</td>' +
                                                        '<td>000000</td>' +
                                                        '<td>'+jsonString[data]['tot_salary'].replace('.','')+'</td>' +
                                                        '<td>SLR</td>' +
                                                        '<td>7056</td>' +
                                                        '<td>1</td>' +
                                                        '<td>123456789</td>' +
                                                        '<td>BPES</td>' +
                                                        '<td>'+jsonString[data]['Name']+'</td>' +
                                                        '<td>'+jsonString[data]['Reference']+'</td>' +
                                                        '<td>'+jsonString[data]['Date']+'</td>' +
                                                        '<td> </td>' +
                                                        '<td>@</td>' +
                                                        '</tr>')
                                                }

                                                if(jsonString.length!=0){
                                                    $('#tblGenerateSalary-hr tbody').append('<tr>' +
                                                        '<td>0000</td>' +
                                                        '<td>7056</td>' +
                                                        '<td>1</td>' +
                                                        '<td>123456789</td>' +
                                                        '<td>BPES</td>' +
                                                        '<td>23</td>' +
                                                        '<td>00</td>' +
                                                        '<td>1</td>' +
                                                        '<td>000000</td>' +
                                                        '<td>'+total.toFixed(2).toString().replace('.','')+'</td>' +
                                                        '<td>SLR</td>' +
                                                        '<td>7056</td>' +
                                                        '<td>1</td>' +
                                                        '<td>123456789</td>' +
                                                        '<td>BPES</td>' +
                                                        '<td>'+particular+'</td>' +
                                                        '<td>'+reference+'</td>' +
                                                        '<td>'+date+'</td>' +
                                                        '<td> </td>' +
                                                        '<td>@</td>' +
                                                        '</tr>')
                                                }

                                            }

                                        };

                                        httpRqst.open('GET','backend-php/current-month-salary-details.php',true);

                                        httpRqst.send();
                                    });



                                    window.onload=function (ev) { // when window is loading the following things are going to happen
                                        document.getElementById("btnGenerate").disabled = true;
                                        var date = new Date();
                                        // console.log(date);
                                        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);  // Fri Jul 31 2021 15:55:50 GMT+0530 (India Standard Time)
                                        date=date.toISOString().substring(0,10); // above value convert into this way 2021-07-31
                                        if(date===date){ // Check the current date is last day of the month
                                            // alert("Today is the end  of the Month. Please save the employees' salary details");
                                            // At the end of the month button will be enabled to save the salary details
                                            document.getElementById("btnGenerate").disabled = false;
                                        }
                                    }


                                        function exportTableToExcel(tableID, filename = ''){
                                            var downloadLink;
                                            var dataType = 'application/vnd.ms-excel';
                                            var tableSelect = document.getElementById(tableID);
                                            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

                                            // Specify file name
                                            filename = filename?filename+'.xls':'excel_data.xls';

                                            // Create download link element
                                            downloadLink = document.createElement("a");

                                            document.body.appendChild(downloadLink);

                                            if(navigator.msSaveOrOpenBlob){
                                                var blob = new Blob(['\ufeff', tableHTML], {
                                                    type: dataType
                                                });
                                                navigator.msSaveOrOpenBlob( blob, filename);
                                            }else{
                                                // Create a link to the file
                                                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                                                // Setting the file name
                                                downloadLink.download = filename;

                                                //triggering the function
                                                downloadLink.click();
                                            }
                                        }

                                </script>
                            </div>
                            <div class="border-top">
                                <div class="card-body" style="float:right;">
                                    <button onclick="exportTableToExcel('tblGenerateSalary-hr','Paymaster')" type="button" class="btn btn-primary" id="btnGenerate" style="float:right;">Generate the PayMaster Sheet</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
        </div>

    </div>
<?php include "footer.php"?>