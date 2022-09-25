<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hansani
 * Date: 2021-07-23
 * Time: 9:48 AM
 */

class Allowance{
    private $BRA=3500.00;
    private $attendance=5000.00;
    private $travelling=5000.00;

    public function getBRAAllowance($days){
        if($days>=25){
            return $this->BRA;
        }else{
            return (($this->BRA/25)*$days);
        }
    }

    public function getOtherAllowance($days){
        $total=0.0;
        if($days>=25){
            $this->attendance=5000.00;
        }elseif (23<$days AND $days<25){
            $this->attendance=3750.00;
        }elseif (21<$days AND $days<=23){
            $this->attendance=2500.00;
        }else{
            $this->attendance=0.00;
        }
        $total=($this->attendance+$this->travelling);
        return $total;
    }
}