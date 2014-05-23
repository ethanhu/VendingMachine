<?php

require_once dirname(__FILE__) . '/Money.php';

class VendingMachine
{
    private $money;
    private $moneyBox = array();

    function __construct()
    {
        $this->money = new Money();
    }

    public function insert($moneyNum) 
    {
        if ($this->money->isValid($moneyNum)) {
            array_push($this->moneyBox, $moneyNum); 
        } else {
            $this->refund($moneyNum);
        }
    } 

    public function total() 
    {
        return array_sum($this->moneyBox);    
    } 

    public function refund($moneyNum = null) 
    {
        print "\nお金払い戻し：\n";
        if (!is_null($moneyNum)) {
            print "refund $moneyNum \n";
            return $moneyNum;
        }

        // refund all
        $total = $this->total(); 
        while($moneyNum = array_pop($this->moneyBox)) {
            print "refund $moneyNum \n";
        }
        return $total;
    } 
}
