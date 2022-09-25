<?php
include "../Connection/connection.php";
include "../my-class/Gift_Details.php";
require('../assets/libs/fpdf/fpdf.php');



$rows = array();

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
//                array_push($final_list,array_merge_recursive($rowData[$row],$gift_list));
                if(empty($final_list)){
                    $final_list['Blank_Book']=0;
                    $final_list['Draw_Book']=0;
                    $final_list['Pastel_Box']=0;
                    $final_list['Single_80']=0;
                    $final_list['Single_120']=0;
                    $final_list['Single_160']=0;
                    $final_list['Single_200']=0;
                    $final_list['Single_CR120']=0;
                    $final_list['Pensil']=0;
                    $final_list['Eraser']=0;
                    $final_list['Foot_ruler']=0;
                    $final_list['Geometry_box']=0;
                }
                $final_list['Blank_Book']+=(int)$gift_list['Blank_Book'];
                $final_list['Draw_Book']+=$gift_list['Draw_Book'];
                $final_list['Pastel_Box']+=$gift_list['Pastel_Box'];
                $final_list['Single_80']+=$gift_list['Single_80'];
                $final_list['Single_120']+=$gift_list['Single_120'];
                $final_list['Single_160']+=$gift_list['Single_160'];
                $final_list['Single_200']+=$gift_list['Single_200'];
                $final_list['Single_CR120']+=$gift_list['Single_CR120'];
                $final_list['Pensil']+=$gift_list['Pensil'];
                $final_list['Eraser']+=$gift_list['Eraser'];
                $final_list['Foot_ruler']+=$gift_list['Foot_ruler'];
                $final_list['Geometry_box']+=$gift_list['Geometry_box'];




            }
        }
//        echo json_encode($final_list);
    }
}

$pdf = new FPDF();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 12);
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);



/* --- Cell --- */
$pdf->SetXY(6, 4);
$pdf->Cell(199, 283, '', 1, 1, 'L', false);
/* --- Text --- */
$pdf->SetFontSize(20);
$pdf->Text(70, 12, 'Summary of Gift Details');

/* --- Text --- */
$pdf->SetFontSize(14);
$pdf->Text(30, 40, 'Row Labels');
$pdf->SetFontSize(14);
$pdf->Text(130, 40,'Sum of Total Qty' );
/* --- Line --- */
$pdf->Line(10, 45, 195, 45);
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 53, 'Blank Book 80 pg');
$pdf->SetFontSize(12);
$pdf->Text(145, 53,$final_list['Blank_Book'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 63, 'Drawing Book 40 pg');
$pdf->SetFontSize(12);
$pdf->Text(145, 63,$final_list['Draw_Book'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 73, 'Pastel Box 12pcs');
$pdf->SetFontSize(12);
$pdf->Text(145, 73,$final_list['Pastel_Box'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 83, 'Single Rule 80 pg');
$pdf->SetFontSize(12);
$pdf->Text(145, 83,$final_list['Single_80'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 93, 'Single Rule 120 pg');
$pdf->SetFontSize(12);
$pdf->Text(145, 93,$final_list['Single_120'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 103, 'Single Rule 160 pg');
$pdf->SetFontSize(12);
$pdf->Text(145, 103,$final_list['Single_160'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 113, 'Single Rule 200 pg');
$pdf->SetFontSize(12);
$pdf->Text(145, 113,$final_list['Single_200'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 123, 'Single RUle CR 120 pg');
$pdf->SetFontSize(12);
$pdf->Text(145, 123,$final_list['Single_CR120'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 133, 'Pencil');
$pdf->SetFontSize(12);
$pdf->Text(145, 133,$final_list['Pensil'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 143, 'Eraser');
$pdf->SetFontSize(12);
$pdf->Text(145, 143,$final_list['Eraser'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 153, 'Foot Ruler');
$pdf->SetFontSize(12);
$pdf->Text(145, 153,$final_list['Foot_ruler'] );
/* --- Text --- */
$pdf->SetFontSize(12);
$pdf->Text(30, 163, 'Geometry Box');
$pdf->SetFontSize(12);
$pdf->Text(145, 163,$final_list['Geometry_box'] );
$pdf->SetTitle('B P E S');




$pdf->Output('Report of Gift Details.pdf','I');