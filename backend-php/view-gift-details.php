<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-07-10
 * Time: 11:02 AM
 */

include "../my-class/Gift_Details.php";
include "../Connection/connection.php";

$final_list= array();

if($connection){
    $query = "SELECT employee.Emp_ID,Name,DOB FROM employee INNER JOIN child ON employee.Emp_ID=child.Emp_ID ORDER BY employee.Emp_ID";

    $result=mysqli_query($connection,$query);

    if(mysqli_num_rows($result)>0){
        $rowData=mysqli_fetch_all($result,MYSQLI_ASSOC); // Database data array

//        echo $rowData[0]['Name'];

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
        echo json_encode($final_list);
    }
}





