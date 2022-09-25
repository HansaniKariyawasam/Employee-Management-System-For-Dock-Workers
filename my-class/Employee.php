<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-04-27
 * Time: 12:37 AM
 */
//include "Branch.php";
include "Bank.php";

class Employee{
    public  $con;
    private $servername = "localhost";
    private $username   = "root";
    private $password   = "1702408-Hansani";
    private $database   = "bpes";


    // Database Connection

    public function __construct(){

        $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
        if(mysqli_connect_error()) {

            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());

        }else{

            return $this->con;
        }
    }

    // Insert employee data into customer table

    public function insertData($post){

        $emp_name = $this->con->real_escape_string($_POST['emp_name']);
        $nic = $this->con->real_escape_string($_POST['nic']);
        $address = $this->con->real_escape_string($_POST['address']);
        $tel_no = $this->con->real_escape_string($_POST['tel_no']);
        $salary = $this->con->real_escape_string($_POST['basic_salary']);
        $bank_name = $this->con->real_escape_string($_POST['bank_name']);
        $branch_name = $this->con->real_escape_string($_POST['branch_name']);
        $acc_no = $this->con->real_escape_string($_POST['acc_no']);
        $team_no = $this->con->real_escape_string($_POST['team_no']);
        $marital_status = $this->con->real_escape_string($_POST['marital_status']);
        // $children = $this->con->real_escape_string($_POST['dob']);


        $query="INSERT INTO employee(Name,Tel_No,Basic_Salary,Team_No,Marital_Status,Address) values('$emp_name','$tel_no','$salary','$team_no','$marital_status','$address')";
        $sql = $this->con->query($query);

        if ($sql==true) {
            $emp_id = $this->con->insert_id;

            $query1="INSERT INTO bank(Acc_No,Emp_ID,Bank_name,Branch_name) values('$acc_no','$emp_id','$bank_name','$branch_name')";
            $sql1 = $this->con->query($query1);

            for($i=0; $i<sizeof($_POST['dob']);$i++){

                $birthDate= $_POST['dob'][$i];

                $query2="INSERT INTO child(Emp_ID,Category,Grade,DOB,Age) values('$emp_id','A','Grade','$birthDate','0')";
                $sql2 = $this->con->query($query2);

            }
            if($sql1==true){

                echo "<script>window.location.href='employee_view.php?msg1=insert';</script>";
            }else{
                echo "Registration failed try again!";
            }

        }else{
            echo "Registration failed try again!";
        }
    }
//public function insertData($post){
//
////            $branchObj=new Branch();
//            $bankObj=new Bank();
//
//            $name = $this->con->real_escape_string($_POST['emp_name']);
//            $nic = $this->con->real_escape_string($_POST['nic']);
//            $address = $this->con->real_escape_string($_POST['address']);
//            $tel_no = $this->con->real_escape_string($_POST['tel_no']);
//            $basic_salary = $this->con->real_escape_string($_POST['basic_salary']);
//            $bank = $this->con->real_escape_string($_POST['bank_name']);
//            $bank_code=$bankObj->getBankCode($bank);
//            $branch = $this->con->real_escape_string($_POST['branch_name']);
//            $branch_code=$bankObj->getBranchCode($bank,$branch);
//            $acc_no = $this->con->real_escape_string($_POST['acc_no']);
//            $team = $this->con->real_escape_string($_POST['team_no']);
//            $marital_status = $this->con->real_escape_string($_POST['marital_status']);
//            //$DOB = $this->con->real_escape_string($_POST['dob']);
//
//
//            $query="INSERT INTO employee(Team_No,Name,Nic,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) values('$team','$name','$nic','$tel_no','$marital_status','$basic_salary','$address','','Employed')";
//            $sql = $this->con->query($query);
//
//            if ($sql==true) {
//                $emp_id = $this->con->insert_id;
//
//                $query1="INSERT INTO bank values('$acc_no','$emp_id','$bank','$bank_code','$branch','$branch_code')";
//                $sql1 = $this->con->query($query1);
//
//                for($i=0; $i<sizeof($_POST['dob']);$i++){
//
//                    $DOB= $_POST['dob'][$i];
//
//                    $query2="INSERT INTO child(Emp_ID,DOB) values('$emp_id','$DOB')";
//                    $sql2 = $this->con->query($query2);
//
//                }
//                if($sql1==true){
//                    echo "<script>alert('The employee has been successfully registered');</script>";
////                    echo "<script>window.location.href='';</script>";
//                }else{
//                    echo "Registration failed try again!";
//                }
//
//            }else{
//                echo "Registration failed try again!";
//            }
//        }

    // Fetch employee records for show listing

    public function displayData(){

        $query = "SELECT * FROM employee INNER JOIN bank ON employee.Emp_ID=bank.Emp_ID ORDER BY employee.Emp_ID";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }else{
            echo "No found records";
        }
    }

    public function viewTeam(){

        $query = "SELECT * FROM team";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }else{
            echo "No found records";
        }
    }

    public function view_eng(){

        $id=$_POST['team_no'];

        $query = "SELECT Engineer_name FROM team WHERE Team_No='$id'";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo json_encode($row);
        }else{
            echo "Record not found";
        }
    }


    // Fetch single data for edit from employee table

    public function displyaRecordById($id){

        $query = "SELECT * FROM employee INNER JOIN bank ON employee.Emp_ID=bank.Emp_ID WHERE employee.Emp_ID = '$id'";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }else{
            echo "Record not found";
        }
    }

    // Update employee data into employee table

    public function updateRecord($postData){

        $tel_no = $this->con->real_escape_string($_POST['tel_no']);
        $salary = $this->con->real_escape_string($_POST['basic_salary']);
        $bank_name = $this->con->real_escape_string($_POST['bank_name']);
        $branch_name = $this->con->real_escape_string($_POST['branch_name']);

        $bankObject= new Bank();
        $bank_code=$bankObject->getBankCode($bank_name);
        $branch_code=$bankObject->getBranchCode($bank_name,$branch_name);

        $acc_no = $this->con->real_escape_string($_POST['acc_no']);
        $id = $this->con->real_escape_string($_POST['id']);
        $current_status = $this->con->real_escape_string($_POST['current_status']);
        $NIC = $this->con->real_escape_string($_POST['NIC']);
        $temporary_address = $this->con->real_escape_string($_POST['Temporary_address']);

        if (!empty($id) && !empty($postData)) {

            $query = "UPDATE employee,bank SET employee.Tel_No = '$tel_no',employee.Current_status='$current_status',employee.Temporary_address='$temporary_address', employee.Basic_Salary = '$salary',bank.Acc_no= '$acc_no',bank.Branch_name='$branch_name',bank.Branch_code='$branch_code', bank.Bank_name='$bank_name',bank.Bank_code='$bank_code' WHERE employee.Emp_ID = '$id' AND bank.Emp_ID='$id'";




            $sql = $this->con->query($query);

            if ($sql===true) {

                if($current_status=='Resigned'){
                    $user_query = "UPDATE user SET Status='$current_status' WHERE Username='$NIC'";
                    $r = $this->con->query($user_query);
                    if($r==true){
                        echo "<script>alert('Employee has been successfully updated');</script>";
                        echo "<script>window.location.replace('../Payroll Management System/hr-modify-emp.php');</script>";
                    }
                }else{
                    $user_query = "UPDATE user SET Status='$current_status' WHERE Username='$NIC'";
                    $r = $this->con->query($user_query);
                    if($r==true){
                        echo "<script>alert('Employee has been successfully updated');</script>";
                        echo "<script>window.location.replace('../Payroll Management System/hr-modify-emp.php');</script>";
                    }
                }

                return true;
            }else{
                return false;
            }

//            ?>
<!--            <script>-->
<!--                if (confirm("Do you want to update this employee?")) {-->
<!--                    --><?php
//                    $sql = $this->con->query($query);
//
//                    if ($sql===true) {
//                        ?>
//                        alert('Employee has been successfully updated');
//                        window.location.replace('../Payroll Management System/hr-modify-emp.php');
//                    <?php
//                        return true;
//                    }else{
//                        return false;
//                    }
//                    ?>
//                }else{
//                    window.location.replace('../Payroll Management System/hr-modify-emp.php');
//                }
//            </script>
//            <?php
        }

    }

    // Delete employee data from employee table

    public function deleteRecord($id){

        $query = "DELETE FROM employee WHERE Emp_ID = '$id'";
        $sql = $this->con->query($query);

        if ($sql==true) {
            echo "<script>window.location.replace('../Payroll Management System/hr-remove-emp.php');</script>";
            return true;
        }else{
            return false;
        }
    }
}