<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-06-27
 * Time: 1:12 PM
 */


class Gift_Details{
    private $giftArray;
    private $blank_bk;
    private $draw_bk;
    private $pastel_box;
    private $sngl_80;
    private $sngl_120;
    private $sngl_160;
    private $sngl_200;
    private $sngl_CR120;
    private $pencil;
    private $eraser;
    private $foot_ruler;
    private $blue_pen;
    private $geometry_box;

//INSERT INTO Gift VALUES('A','Nursery',2,1,1,0,0,0,0,0,0,0,0,0,0);
//INSERT INTO Gift VALUES('B','Grade 1 2',3,2,1,3,0,0,0,0,4,0,0,0,0);
//INSERT INTO Gift VALUES('C','Grade 3 4',0,2,1,3,3,0,0,0,4,0,0,0,0);
//INSERT INTO Gift VALUES('D','Grade 5',0,0,1,3,3,0,0,0,4,1,1,3,0);
//INSERT INTO Gift VALUES('E','Grade 6 7 8',0,0,0,3,4,0,2,2,3,1,1,4,1);
//INSERT INTO Gift VALUES('F','Grade 9 10 11',0,0,0,2,2,2,2,2,3,1,1,5,1);
//INSERT INTO Gift VALUES('G','Grade 12 13',3,2,1,3,0,2,2,3,4,1,1,5,0);


    public function getGiftDetails($dob){
        $current_year=new DateTime();
        $birth_year=new DateTime($dob);
        $diff=$current_year->diff($birth_year);
        $age=$diff->y;


        if($age==4 || $age==5){
            return $this->giftArray=array("Blank_Book"=>2,"Draw_Book"=>1,"Pastel_Box"=>1,"Single_80"=>0,"Single_120"=>0,"Single_160"=>0,"Single_200"=>0,"Single_CR120"=>0,"Pensil"=>2,"Eraser"=>1,"Foot_ruler"=>0,"Geometry_box"=>0);
        }elseif ($age==6 || $age==7){
            return $this->giftArray=array("Blank_Book"=>3,"Draw_Book"=>2,"Pastel_Box"=>1,"Single_80"=>3,"Single_120"=>0,"Single_160"=>0,"Single_200"=>0,"Single_CR120"=>0,"Pensil"=>4,"Eraser"=>1,"Foot_ruler"=>0,"Geometry_box"=>0);
        }elseif ($age==8 || $age==9){
            return $this->giftArray=array("Blank_Book"=>0,"Draw_Book"=>2,"Pastel_Box"=>1,"Single_80"=>3,"Single_120"=>3,"Single_160"=>0,"Single_200"=>0,"Single_CR120"=>0,"Pensil"=>4,"Eraser"=>1,"Foot_ruler"=>0,"Geometry_box"=>0);
        }elseif ($age==10){
            return $this->giftArray=array("Blank_Book"=>0,"Draw_Book"=>0,"Pastel_Box"=>1,"Single_80"=>3,"Single_120"=>3,"Single_160"=>0,"Single_200"=>0,"Single_CR120"=>0,"Pensil"=>4,"Eraser"=>1,"Foot_ruler"=>1,"Geometry_box"=>0);
        }elseif (11<=$age && $age<=13){
            return $this->giftArray=array("Blank_Book"=>0,"Draw_Book"=>0,"Pastel_Box"=>0,"Single_80"=>3,"Single_120"=>4,"Single_160"=>0,"Single_200"=>2,"Single_CR120"=>2,"Pensil"=>3,"Eraser"=>1,"Foot_ruler"=>1,"Geometry_box"=>1);
        }elseif (14<=$age && $age<=16){
            return $this->giftArray=array("Blank_Book"=>0,"Draw_Book"=>0,"Pastel_Box"=>0,"Single_80"=>2,"Single_120"=>3,"Single_160"=>2,"Single_200"=>2,"Single_CR120"=>2,"Pensil"=>3,"Eraser"=>1,"Foot_ruler"=>1,"Geometry_box"=>1);
        }elseif ($age==17 || $age==18){
            return $this->giftArray=array("Blank_Book"=>0,"Draw_Book"=>0,"Pastel_Box"=>0,"Single_80"=>3,"Single_120"=>2,"Single_160"=>2,"Single_200"=>2,"Single_CR120"=>3,"Pensil"=>2,"Eraser"=>1,"Foot_ruler"=>1,"Geometry_box"=>0);
        }else{
            return null;
        }

    }
}