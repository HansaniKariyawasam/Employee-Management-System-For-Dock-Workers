<?php

class Attendance{
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

    // Update attendance data into attendance table

    public function updateRecord($postData){

        $empID = $this->con->real_escape_string($_POST['id']);
        $checkIn = $this->con->real_escape_string($_POST['checkIn']);
        $checkOut = $this->con->real_escape_string($_POST['checkOut']);
        $date = $this->con->real_escape_string($_POST['date']);
        $remark=$this->con->real_escape_string($_POST['remark']);
        $NOT = $this->con->real_escape_string($_POST['NOT']);
        $DOT = $this->con->real_escape_string($_POST['DOT']);

        if (!empty($empID) && !empty($date) && !empty($postData)) {

            $query = "UPDATE attendance SET checkIn_Time = '$checkIn', checkOut_Time = '$checkOut',Normal_OT= '$NOT',Double_OT='$DOT',Remark='$remark' WHERE Emp_ID = '$empID' AND Date='$date'";

            $sql = $this->con->query($query);


            if (mysqli_query($this->con,$query)) {
                echo "<script>alert('Successfully updated');</script>";
                echo "<script>window.location.replace('../Payroll Management System/supervisor-modify-attendance.php');</script>";
                return true;
            }else{
                echo "<script>alert('Something went wrong. Please check again!');</script>";
                return false;
            }
        }else{
            echo "Empty";
        }

    }

    // Fetch single data for edit from employee table

    public function displyaRecordById($id,$date){

        $query = "SELECT * FROM employee INNER JOIN attendance ON employee.Emp_ID=attendance.Emp_ID WHERE employee.Emp_ID = '$id' AND attendance.date='$date'";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }else{
            echo "Record not found";
        }
    }

//    public function displyaSuspendRecordById($id,$date){
//
//        $query = "SELECT * FROM employee INNER JOIN suspend_attendance ON employee.Emp_ID=suspend_attendance.Emp_ID WHERE employee.Emp_ID = '$id' AND suspend_attendance.date='$date'";
//        $result = $this->con->query($query);
//
//        if ($result->num_rows > 0) {
//            $row = $result->fetch_assoc();
//            return $row;
//        }else{
//            echo "Record not found";
//        }
//    }
}