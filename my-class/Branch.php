<?php
///**
// * Created by IntelliJ IDEA.
// * User: Hansani
// * Date: 2021-04-15
// * Time: 3:17 PM
// */
//
//class Branch{
//    private $aluthgama;
//    private $ambalangoda;
//    private $awissawella;
//    private $bandaragama;
//    private $beliatta;
//    private $dehiwala;
//    private $elpitiya;
//    private $galle;
//    private $hambanthota;
//    private $horana;
//    private $kadawatha;
//    private $kaluthara;
//    private $kegalle;
//    private $matara;
//    private $panadura;
//    private $ranthnapura;
//
//    public function getBranchCode($bank,$branch){
//        if($bank==="Commercial"){
//            return $this->getCOMBank($branch);
//        }elseif ($bank==="DFCC"){
//            return $this->getDFCCBank($branch);
//        }elseif ($bank==="HNB"){
//            return $this->getHNBMBank($branch);
//        }elseif ($bank==="NDB"){
//            return $this->getNDBBank($branch);
//        }elseif ($bank==="NSB"){
//            return $this->getNSBBank($branch);
//        }elseif ($bank==="Peoples"){
//            return $this->getPeoplesBank($branch);
//        }else{
//            return null;
//        }
//    }
//
//    private function getCOMBank($branch){
//        if($branch==="Aluthgama"){
//            return $this->aluthgama=40;
//        }elseif ($branch==="Ambalangoda"){
//            return $this->ambalangoda=97;
//        }elseif ($branch==="Awissawella"){
//            return $this->awissawella=70;
//        }elseif ($branch==="Bandaragama"){
//            return $this->bandaragama=84;
//        }elseif ($branch==="Beliatta"){
//            return $this->beliatta=181;
//        }elseif ($branch==="Dehiwala"){
//            return $this->dehiwala=58;
//        }elseif ($branch==="Elpitiya"){
//            return $this->elpitiya=103;
//        }elseif ($branch==="Galle"){
//            return $this->galle=27;
//        }elseif ($branch==="Hambanthota"){
//            return $this->hambanthota=166;
//        }elseif ($branch==="Horana"){
//            return $this->horana=76;
//        }elseif ($branch==="Kadawatha"){
//            return $this->kadawatha=67;
//        }elseif ($branch==="Kaluthara"){
//            return $this->kaluthara=36;
//        }elseif ($branch==="Kegalle"){
//            return $this->kegalle=21;
//        }elseif ($branch==="Matara"){
//            return $this->matara=7;
//        }elseif ($branch==="Panadura"){
//            return $this->panadura=41;
//        }elseif ($branch==="Ranthnapura"){
//            return $this->ranthnapura=49;
//        }else{
//            return null;
//        }
//    }
//
//    private function getDFCCBank($branch){
//        if($branch==="Aluthgama"){
//            return $this->aluthgama=40;//
//        }elseif ($branch==="Ambalangoda"){
//            return $this->ambalangoda=38;
//        }elseif ($branch==="Awissawella"){
//            return $this->awissawella=39;
//        }elseif ($branch==="Bandaragama"){
//            return $this->bandaragama=81;
//        }elseif ($branch==="Beliatta"){
//            return $this->beliatta=181;//
//        }elseif ($branch==="Dehiwala"){
//            return $this->dehiwala=58;//
//        }elseif ($branch==="Elpitiya"){
//            return $this->elpitiya=53;
//        }elseif ($branch==="Galle"){
//            return $this->galle=35;
//        }elseif ($branch==="Hambanthota"){
//            return $this->hambanthota=62;
//        }elseif ($branch==="Horana"){
//            return $this->horana=34;
//        }elseif ($branch==="Kadawatha"){
//            return $this->kadawatha=29;
//        }elseif ($branch==="Kaluthara"){
//            return $this->kaluthara=26;
//        }elseif ($branch==="Kegalle"){
//            return $this->kegalle=49;
//        }elseif ($branch==="Matara"){
//            return $this->matara=4;
//        }elseif ($branch==="Panadura"){
//            return $this->panadura=23;
//        }elseif ($branch==="Ranthnapura"){
//            return $this->ranthnapura=8;
//        }else{
//            return null;
//        }
//    }
//
//    private function getHNBMBank($branch){
//        if($branch==="Aluthgama"){
//            return $this->aluthgama=109;
//        }elseif ($branch==="Ambalangoda"){
//            return $this->ambalangoda=81;
//        }elseif ($branch==="Awissawella"){
//            return $this->awissawella=111;
//        }elseif ($branch==="Bandaragama"){
//            return $this->bandaragama=201;
//        }elseif ($branch==="Beliatta"){
//            return $this->beliatta=181;//
//        }elseif ($branch==="Dehiwala"){
//            return $this->dehiwala=93;
//        }elseif ($branch==="Elpitiya"){
//            return $this->elpitiya=107;
//        }elseif ($branch==="Galle"){
//            return $this->galle=13;
//        }elseif ($branch==="Hambanthota"){
//            return $this->hambanthota=68;
//        }elseif ($branch==="Horana"){
//            return $this->horana=52;
//        }elseif ($branch==="Kadawatha"){
//            return $this->kadawatha=84;
//        }elseif ($branch==="Kaluthara"){
//            return $this->kaluthara=34;
//        }elseif ($branch==="Kegalle"){
//            return $this->kegalle=41;
//        }elseif ($branch==="Matara"){
//            return $this->matara=42;
//        }elseif ($branch==="Panadura"){
//            return $this->panadura=69;
//        }elseif ($branch==="Ranthnapura"){
//            return $this->ranthnapura=30;
//        }else{
//            return null;
//        }
//    }
//
//    private function getNDBBank($branch){
//        if($branch==="Aluthgama"){
//            return $this->aluthgama=59;
//        }elseif ($branch==="Ambalangoda"){
//            return $this->ambalangoda=47;
//        }elseif ($branch==="Awissawella"){
//            return $this->awissawella=34;
//        }elseif ($branch==="Bandaragama"){
//            return $this->bandaragama=84;//
//        }elseif ($branch==="Beliatta"){
//            return $this->beliatta=181;//
//        }elseif ($branch==="Dehiwala"){
//            return $this->dehiwala=58;//
//        }elseif ($branch==="Elpitiya"){
//            return $this->elpitiya=67;
//        }elseif ($branch==="Galle"){
//            return $this->galle=21;
//        }elseif ($branch==="Hambanthota"){
//            return $this->hambanthota=57;
//        }elseif ($branch==="Horana"){
//            return $this->horana=27;
//        }elseif ($branch==="Kadawatha"){
//            return $this->kadawatha=26;
//        }elseif ($branch==="Kaluthara"){
//            return $this->kaluthara=16;
//        }elseif ($branch==="Kegalle"){
//            return $this->kegalle=17;
//        }elseif ($branch==="Matara"){
//            return $this->matara=6;
//        }elseif ($branch==="Panadura"){
//            return $this->panadura=35;
//        }elseif ($branch==="Ranthnapura"){
//            return $this->ranthnapura=13;
//        }else{
//            return null;
//        }
//    }
//
//    private function getNSBBank($branch){
//        if($branch==="Aluthgama"){
//            return $this->aluthgama=105;
//        }elseif ($branch==="Ambalangoda"){
//            return $this->ambalangoda=33;
//        }elseif ($branch==="Awissawella"){
//            return $this->awissawella=57;
//        }elseif ($branch==="Bandaragama"){
//            return $this->bandaragama=126;
//        }elseif ($branch==="Beliatta"){
//            return $this->beliatta=48;
//        }elseif ($branch==="Dehiwala"){
//            return $this->dehiwala=24;
//        }elseif ($branch==="Elpitiya"){
//            return $this->elpitiya=94;
//        }elseif ($branch==="Galle"){
//            return $this->galle=3;
//        }elseif ($branch==="Hambanthota"){
//            return $this->hambanthota=781;
//        }elseif ($branch==="Horana"){
//            return $this->horana=63;
//        }elseif ($branch==="Kadawatha"){
//            return $this->kadawatha=75;
//        }elseif ($branch==="Kaluthara"){
//            return $this->kaluthara=12;
//        }elseif ($branch==="Kegalle"){
//            return $this->kegalle=18;
//        }elseif ($branch==="Matara"){
//            return $this->matara=4;
//        }elseif ($branch==="Panadura"){
//            return $this->panadura=43;
//        }elseif ($branch==="Ranthnapura"){
//            return $this->ranthnapura=10;
//        }else{
//            return null;
//        }
//    }
//
//    private function getPeoplesBank($branch){
//        if($branch==="Aluthgama"){
//            return $this->aluthgama=84;
//        }elseif ($branch==="Ambalangoda"){
//            return $this->ambalangoda=35;
//        }elseif ($branch==="Awissawella"){
//            return $this->awissawella=70;
//        }elseif ($branch==="Bandaragama"){
//            return $this->bandaragama=29;
//        }elseif ($branch==="Beliatta"){
//            return $this->beliatta=244;
//        }elseif ($branch==="Dehiwala"){
//            return $this->dehiwala=19;
//        }elseif ($branch==="Elpitiya"){
//            return $this->elpitiya=73;
//        }elseif ($branch==="Galle"){
//            return $this->galle=13;
//        }elseif ($branch==="Hambanthota"){
//            return $this->hambanthota=7;
//        }elseif ($branch==="Horana"){
//            return $this->horana=41;
//        }elseif ($branch==="Kadawatha"){
//            return $this->kadawatha=273;
//        }elseif ($branch==="Kaluthara"){
//            return $this->kaluthara=39;
//        }elseif ($branch==="Kegalle"){
//            return $this->kegalle=27;
//        }elseif ($branch==="Matara"){
//            return $this->matara=32;
//        }elseif ($branch==="Panadura"){
//            return $this->panadura=148;
//        }elseif ($branch==="Ranthnapura"){
//            return $this->ranthnapura=88;
//        }else{
//            return null;
//        }
//    }
//
//    private function getSampathBank($branch){
//        if($branch==="Aluthgama"){
//            return $this->aluthgama=40;
//        }elseif ($branch==="Ambalangoda"){
//            return $this->ambalangoda=97;
//        }elseif ($branch==="Awissawella"){
//            return $this->awissawella=70;
//        }elseif ($branch==="Bandaragama"){
//            return $this->bandaragama=84;
//        }elseif ($branch==="Beliatta"){
//            return $this->beliatta=181;
//        }elseif ($branch==="Dehiwala"){
//            return $this->dehiwala=58;
//        }elseif ($branch==="Elpitiya"){
//            return $this->elpitiya=103;
//        }elseif ($branch==="Galle"){
//            return $this->galle=27;
//        }elseif ($branch==="Hambanthota"){
//            return $this->hambanthota=166;
//        }elseif ($branch==="Horana"){
//            return $this->horana=76;
//        }elseif ($branch==="Kadawatha"){
//            return $this->kadawatha=67;
//        }elseif ($branch==="Kaluthara"){
//            return $this->kaluthara=36;
//        }elseif ($branch==="Kegalle"){
//            return $this->kegalle=21;
//        }elseif ($branch==="Matara"){
//            return $this->matara=7;
//        }elseif ($branch==="Panadura"){
//            return $this->panadura=41;
//        }elseif ($branch==="Ranthnapura"){
//            return $this->ranthnapura=49;
//        }else{
//            return null;
//        }
//    }
//
//
//}