<?php
include "../Connection/connection.php";
include '../my-class/Bank.php';
//include '../my-class/Branch.php';

extract($_POST);

$name=$_POST['emp_name'];
$nic=$_POST['nic'];
$tel_no=$_POST['tel_no'];
$address=$_POST['address'];
$basic_salary=$_POST['basic_salary'];
$bank=$_POST['bank'];
$branch=$_POST['branch'];
$acc_no=$_POST['acc_no'];
$team=$_POST['team'];
$marital_status=$_POST['marital_status'];
$n=$_POST['n'];
if(isset($_POST['count'])){
    $count=(int)$_POST['count'];
}

//echo $marital_status;

//Create Bank Object
$bankObj=new Bank();
//Create Branch Object
//$branchObj=new Branch();
//Get the Bank Code
$bankCode=$bankObj->getBankCode($bank);
//Get the Branch Code
$branchCode=$bankObj->getBranchCode($bank,$branch);

if ($connection){
    $query_team="SELECT Team_No FROM Team WHERE Team_Name='$team'";

    $result=mysqli_query($connection,$query_team);
    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC);

        $team_no= $rowData[0]['Team_No'];

        $password=md5($nic);

        $query_user="INSERT INTO User VALUES ('$nic','$name','$password','Employee','Employed')";
        $result=mysqli_query($connection,$query_user);

        if($result){
            $query_employee="INSERT INTO employee (Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) VALUES ('$team_no','$name','$nic','$tel_no','$marital_status','$basic_salary','$address',' ','Employed')";

            $result=mysqli_query($connection,$query_employee);
            $emp_ID=$connection->insert_id;
//            echo $branchCode;
            $query_bank="INSERT INTO bank VALUES ('$acc_no','$emp_ID','$bank','$bankCode','$branch','$branchCode')";

            $result=mysqli_query($connection,$query_bank);


            if($result){
                if(isset($_POST['count'])){
                    if(isset($_POST['dob'.$count])) {
                        for ($i = 0; $i <= $count; $i++) {
                            $dob = ($_POST['dob' . $count--]);
                            $query_child = "INSERT INTO Child (Emp_ID,DOB) VALUES('$emp_ID','$dob')";

                            $result = mysqli_query($connection, $query_child);

                        }
                        if ($result) {
                            echo "<script>alert('Employee has been successfully registered');</script>";
                            echo "<script>window.location.replace('../hr-current-emp-personal-details.php')</script>";
                        } else {
                            echo "child error";
                        }
                    }
                }
                echo "<script>alert('Employee has been successfully registered');</script>";
                echo "<script>window.location.replace('../hr-current-emp-personal-details.php')</script>";

            }else{
//                echo mysqli_error($connection);
//                echo $bankCode;
                echo "<script>alert('Something went wrong. Please check again!');</script>";
                echo "<script>window.location.replace('../hr-register-emp.php')</script>";
            }

        }else{
            echo "<script>alert('This user has been already registered');</script>";
            echo "<script>window.location.replace('../hr-register-emp.php?name=')</script>";

        }
    }

}

