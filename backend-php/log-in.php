<?php

include "../Connection/connection.php";
session_start();
$Username=$_POST['Username'];
$password=$_POST['password'];

if($connection) {
    $Password=md5($password);
    $sql = "select Username,Designation,Name from User where Status='Employed' AND Username='" . $Username . "' and password='" . $Password . "' ";
    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Inavlid query" . mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($result);

//    print_r($row);

    $_SESSION['Designation'] = $row['Designation'];
    $_SESSION['Name']= $row['Name'];

    if ($row['Designation'] == "HR") {
        $_SESSION['logged']=true;
        header("Location: ../hr-home.php");
    } elseif ($row['Designation'] == "MD") {
        $_SESSION['logged']=true;
        header("Location: ../managing-director-home.php");

    } elseif ($row['Designation'] == "Employee") {
        $_SESSION['logged']=true;
        header("Location: ../employee-home.php");

    }  elseif ($row['Designation'] == "Admin") {
        $_SESSION['logged'] = true;
        header("Location: ../admin-modify-user.php");
    }elseif ($row['Designation'] == "Supervisor") {
        $_SESSION['logged']=true;
        header("Location: ../supervisor-home.php");

    } else {
//        header("Location: index.php?error=1");
        echo "<script>alert('Login error. Please check again!')</script>";
        echo "<script>window.location.replace('../index.php')</script>";

    }
}


$connection->close();

?>