<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-03-20
 * Time: 6:44 PM
 */
include "../Connection/connection.php";
include('../assets/libs/simpleXLSX/SimpleXLSX.php');

//          Track the upload file

$currentDirectory = getcwd();
$uploadDirectory = "\\uploads\\";

$errors = []; // Store errors here

$fileExtensionsAllowed = ['xlsx']; // These will be the only file extensions allowed

$fileName = $_FILES['the_file']['name'];
$fileSize = $_FILES['the_file']['size'];
$fileTmpName  = $_FILES['the_file']['tmp_name'];
$fileType = $_FILES['the_file']['type'];
$tmp = explode('.', $fileName);
$fileExtension = strtolower(end($tmp));
//$fileExtension = strtolower(end(explode('.',$fileName)));

$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

$isSuspend=false;

if (isset($_POST['submit'])) {
//echo "Enter";
    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        $errors[] = "This file extension is not allowed. Please upload a Excel file";
    }



    if ($fileSize > 4000000) {
        $errors[] = "File exceeds maximum size (4MB)";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload && $connection) {
//            echo '<script type="text/javascript">alert("The file has been successfully uploaded ")</script>';


//          Read the Excel sheet

            if ($xlsx = SimpleXLSX::parse($uploadPath)) {

                // define array to store data
                $user_data = array();

                // get excel cell data as array
                $excel_data = $xlsx->rows();

                // remove header line from array
                array_shift($excel_data);

                // loop excel row one by one
                foreach ( $excel_data as $rows => $columns ) {

                    /*
                       columns[0] = Emp_ID
                       columns[1] = Name
                       columns[2] = Date/Time
                       columns[3] = Status
                   */

                    // set Emp_ID as array key
                    $user_data[$columns[0]]['name']=$columns[1];
                    //seperate the date
                    $user_data[$columns[0]]['date']=date("Y-m-d",strtotime($columns[2]));

                    // check status (in or out)
                    if($columns[3] == 'C/In') {

                        // check ['in'] key is set or not
                        if(isset($user_data[$columns[0]]['in'])) {
                            //get current in time string as unix timestamp
                            $current_in_time = strtotime($user_data[$columns[0]]['in']);


                            // check current in time greater than current row timestamp
                            if($current_in_time > strtotime($columns[2])) {
//                        $user_data[$columns[0]]['in']=$columns[2];
                                $user_data[$columns[0]]['in']=date("H:i:s",strtotime($columns[2]));
                            }

                        }
                        else{
                            // here set ['in'] firstly
//                    $user_data[$columns[0]]['in']=$columns[2];
                            $user_data[$columns[0]]['in']=date("H:i:s",strtotime($columns[2]));
                        }
                    }
                    else {
                        if(isset($user_data[$columns[0]]['out'])) {
                            $current_out_time = strtotime($user_data[$columns[0]]['out']);

                            if($current_out_time > strtotime($columns[2])) {
//                        $user_data[$columns[0]]['out']=$columns[2];
                                $user_data[$columns[0]]['out']=date("H:i:s",strtotime($columns[2]));
                            }

                        }
                        else{
//                    $user_data[$columns[0]]['out']=$columns[2];
                            $user_data[$columns[0]]['out']=date("H:i:s",strtotime($columns[2]));
                        }

                    }

                    // Check the day is a Saturday or Sunday or Holiday
                    $weekend=date('w',strtotime($columns[2]));  // Take the attendance date as number(Monday=1,tuesday=2,...,saturday=6, sunday=0)
                    $day = $user_data[$columns[0]]['date']; // Take attendance date

                }



                $mor = "07:15:00";
                $eve = "17:00:00";
                $noon = "13:00:00";




                foreach ($user_data as $key => $value){
                    $day_status="Weekday";
                    $NOT=0;
                    $DOT=0;

                    $checkIn=$value['in'];
                    $checkOut=$value['out'];
                    $date=$value['date']; // Take attendance date

                    $weekend=date('w',strtotime($date));  // Take the attendance date as number(Monday=1,tuesday=2,...,saturday=6, sunday=0)

                    // Get the holidays from the database
                    $holidayQuery="SELECT date FROM holiday WHERE date='$date'";
                    $result=mysqli_query($connection,$holidayQuery);

                    $no=0;


                    if(mysqli_num_rows($result)>0){// check the attendance date is in the database
                        $day_status="Holiday"; // if it is a holiday, all working hours consider as DOT
                        if($checkIn<$mor){ // If checkIn time is less than 07.15 am, then they pay only after 7.00 am hours
                            $checkIn="07:00:00";
                            if($checkOut>$noon){ // checking the checkOut time is greater than 12.00pm
                                $DOT=(int)(((int)$checkOut-(int)$checkIn)-1); // if his checkOut time greater than 13.00 pm, the lunch hour should be reduced

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }else{
                                $DOT=(int)((int)$checkOut-(int)$checkIn);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }
                        }else{ // if checkIn time greater than 07.15 am
                            if($checkOut>$noon){
                                $DOT=(int)(((int)$checkOut-(int)$checkIn)-1);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }else{
                                $DOT=(int)((int)$checkOut-(int)$checkIn);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }
                        }

                    }elseif($weekend==0){// check whether it is a sunday
                        $day_status="Sunday"; // if it is a sunday, all working hours consider as NOT
                        if($checkIn<$mor){ // check the checkIn time is less than 7.15 am
                            $checkIn="07:00:00";
                            if($checkOut>$noon){
                                $NOT=(int)(((int)$checkOut-(int)$checkIn)-1); //deduct the lunch hour

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }else{
                                $NOT=(int)((int)$checkOut-(int)$checkIn);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }
                        }else{
                            if($checkOut>$noon){
                                $NOT=(int)(((int)$checkOut-(int)$checkIn)-1);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }else{
                                $NOT=(int)((int)$checkOut-(int)$checkIn);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }
                        }

                    }elseif ($weekend==6){// check whether it is a saturday
                        $day_status="Saturday"; // if it is saturday, before 8.00 am and after 13.00 pm hours consider as NOT
                        if($checkIn<$mor){
                            $checkIn="07:00:00";

                            if($checkOut>$noon){
                                $NOT=(1+(int)((int)$checkOut-(int)$noon)); // when checkIn time is less than 07.15 am, always give only 7-8 only one hour as NOT

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }else{
                                $NOT=(int)((int)$mor-(int)$checkIn);
                                $DOT=0;

                                $date=$user_data[$key]['date'];
                                $empID=$key;

                                $attendanceQuery="INSERT INTO suspend_attendance VALUES('$date','$empID','$checkIn','$checkOut','$NOT','$DOT','$day_status')";
                                $result_att=mysqli_query($connection,$attendanceQuery);
                                if($result_att){
                                    echo "true1";
                                    unset($user_data[$key]); // If it is false, that means his working hour less than 5. Less than 5 hours isn't given any payment. Also this day is not consider as worked day
                                }



                            }
                        }else{
                            if($checkOut>$noon){
//                                echo "true";
                                $NOT=(int)((int)$checkOut-(int)$noon); // there is No morning OT, only after 13.00 pm

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }else{
                                $date=$user_data[$key]['date'];
                                $empID=$key;

                                $attendanceQuery="INSERT INTO suspend_attendance VALUES('$date','$empID','$checkIn','$checkOut','0','0','$day_status')";
                                $result_att=mysqli_query($connection,$attendanceQuery);
                                if($result_att){
                                    echo "true2";
                                    unset($user_data[$key]); // If it is false, that means his working hour less than 5. Less than 5 hours isn't given any payment. Also this day is not consider as worked day
                                }
                            }
                        }

                    }else{
                        if("08:15:00"<$checkIn){ // these types of attendance are always short leaves. It can be SL01 or SL02 or half day
                            if($checkOut<="17:00:00"){
                                if($checkOut>$noon){
                                    $no=((int)$checkOut-(int)$checkIn)-1;
                                    $day_status=shortLeaveStatus($no);

                                    $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                                }else{
                                    $no=((int)$checkOut-(int)$checkIn);
                                    $day_status=shortLeaveStatus($no);

                                    $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                                }
                            }elseif ($checkOut>"17:00:00"){
                                $no=(int)((int)$eve-(int)$checkIn)-1;
                                $day_status=shortLeaveStatus($no);
                                $NOT=(int)((int)$checkOut-(int)$eve);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }
                        }elseif ($checkIn<"07:15:00"){
                            $checkIn="08:00:00";
                            if($checkOut<"17:00:00"){ // these types of attendance are always short leaves
                                if($checkOut>$noon){
                                    $no=(int)((int)$checkOut-(int)$checkIn)-1;
                                    $day_status=shortLeaveStatus($no);

                                    $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                                }else{
                                    $no=(int)((int)$checkOut-(int)$checkIn);
                                    $day_status=shortLeaveStatus($no);

                                    $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                                }
                                $NOT=1;

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }elseif ($checkOut>"17:00:00"){ // these are not short leaves
//                                $no=($eve-$checkIn)-1;
//                                $day_status=shortLeaveStatus($no);
                                $NOT=1+((int)$checkOut-(int)$eve);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }
                        }else{
                            if($checkOut<"17:00:00"){ // these types of attendance are always short leaves
                                if($checkOut>$noon){
                                    $no=(int)((int)$checkOut-(int)$checkIn)-1;
//                                    echo $no;
                                    $day_status=shortLeaveStatus($no);

                                    $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                                }else{
                                    $no=(int)((int)$checkOut-(int)$checkIn);
//                                    echo $no;
                                    $day_status=shortLeaveStatus($no);

                                    $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                    $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                                }
                            }elseif ($checkOut>"17:00:00"){ // these are not short leaves
                                $NOT=(int)((int)$checkOut-(int)$eve);

                                $user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                                $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array
                            }
                        }

                    }

                    //$user_data[$key]['DOT']=$DOT; // assign the DOT info into the relavent employee row in the final user_data array
                    //$user_data[$key]['NOT']=$NOT;  // assign the NOT info into the relavent employee row in the final user_data array
                    // $user_data[$key]['status']=$day_status; // assign the day status info into the relavent employee row in the final user_data array

                }


                if(!empty($user_data)){
                    foreach ($user_data as $key=>$data){
                        $date=$data['date'];
                        $empID=$key;
                        $checkIn_time=$data['in'];
                        $checkOut_time=$data['out'];
                        $normal_OT=$data['NOT'];
                        $double_OT=$data['DOT'];
                        $remark=$data['status'];

                        $month=date('m',strtotime($date));
                        $currentMonth=date('m');
                        $monthName=date('F',mktime(null,null,null,$currentMonth));


                        if($month===$currentMonth){
                            $attendanceQuery="INSERT INTO attendance VALUES('$date','$empID','$checkIn_time','$checkOut_time','$normal_OT','$double_OT','$remark')";
                            $result_att=mysqli_query($connection,$attendanceQuery);
                            if($result_att){
//                                print_r($data);
                                echo '<script type="text/javascript">alert("The file has been successfully uploaded ")</script>';
                                echo "<script>window.location.replace('../supervisor-modify-attendance.php')</script>";
                            }else{
//                                print_r($data);
                                echo "<script type='text/javascript'>alert('Duplicate entry of the same attendance. Please Check Again!')</script>";
                                echo "<script>window.location.replace('../supervisor-add-attendance.php')</script>";
//              	                return;
                            }

//                           echo $month;
//                            echo $monthName;
//                            echo $currentMonth;

                        }else{

                            echo "<script type='text/javascript'>alert('Please input the current month attendance details only')</script>";
                            echo "<script>window.location.replace('../supervisor-add-attendance.php')</script>";
                        }


                    }
                }


//                echo '<pre>';
//                print_r($user_data);
//                echo '</pre>';


            } else {
                echo SimpleXLSX::parseError();
            }
        } else {
            echo '<script type="text/javascript">alert("An error occurred. Please contact the administrator")</script>';
            echo "<script>window.location.replace('../supervisor-add-attendance.php')</script>";
        }
    } else {
        foreach ($errors as $error) {
            echo '<script type="text/javascript">alert("' . $error . '")</script>';
            echo "<script>window.location.replace('../supervisor-add-attendance.php')</script>";
        }
    }

}

function shortLeaveStatus($hrs){
    if($hrs===4){
        return "Halfday";
    }elseif (1<=$hrs && $hrs<=3){
        return "SL01";
    }elseif (5<=$hrs && $hrs<=8){
        return "SL02";
    }else{
        return "Weekday";
    }
}






?>