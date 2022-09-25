<?php
include "../my-class/Gift_Details.php";
include "../Connection/connection.php";

$final_list= array();

$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$status='Employed';


$rows = array();
if ($id && $name) {
    $sql = 'SELECT e.Emp_ID, e.Name, c.DOB FROM employee AS e INNER JOIN child AS c ON e.Emp_ID = c.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID="' . $id . '" AND e.Name LIKE "%' . $name . '%" ORDER BY e.Emp_ID';
} else if ($id) {
    $sql = 'SELECT e.Emp_ID, e.Name, c.DOB FROM employee AS e INNER JOIN child AS c ON e.Emp_ID = c.Emp_ID where e.Current_status="'.$status.'" AND e.Emp_ID="' . $id . '" ORDER BY e.Emp_ID';
}else if ($name) {
    $sql = 'SELECT e.Emp_ID, e.Name, c.DOB FROM employee AS e INNER JOIN child AS c ON e.Emp_ID = c.Emp_ID where e.Current_status="'.$status.'" AND e.Name LIKE "%' . $name . '%" ORDER BY e.Emp_ID';
} else {
    header('Content-Type: application/json');
    echo json_encode($rows);
    return;
}

$result = mysqli_query($connection, $sql);
//while ($r = mysqli_fetch_assoc($result)) {
//    $rows[] = $r;
//}

if($result){
    $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC); // Database data array

    for ($row=0 ; $row<count($rowData); $row++){
        $dob=$rowData[$row]['DOB'];

        $giftObj=new Gift_Details();
        $gift_list=$giftObj->getGiftDetails($dob);  // Gift details array


        if(!empty($gift_list)){
            //Merge gift details and database data array and then push into a new array
            array_push($final_list,array_merge_recursive($rowData[$row],$gift_list));
        }
    }
    //Json Encode the final array list
    $rows=$final_list;
}

header('Content-Type: application/json');
echo json_encode($rows);