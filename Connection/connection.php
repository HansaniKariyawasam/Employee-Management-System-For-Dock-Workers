<?php
$db_host="localhost";
$db_user="root";
$db_password="1702408-Hansani";
$db_database="bpes";

$connection=mysqli_connect($db_host,$db_user,$db_password,$db_database);

if(!$connection){
    die('Could not connect: ' . mysqli_connect_error());
}
