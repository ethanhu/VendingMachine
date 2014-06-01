<?php

class Item
{
    protected $name;
    protected $price;
    protected $stockNum = 0;
    protected $saleAmount = 0;

    function __construct($name, $price) 
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStockNum()
    {
        return $this->stockNum;
    }

    public function getSaleAmount()
    {
        return $this->saleAmount;
    }

    public function store($num)
    {
        if (is_int($num) && $num >= 1) {
            $this->stockNum += $num;
        }
    }

    public function inStock()
    {
        return ($this->stockNum >= 1);
    }

    public function canPurchase($insertMoney)
    {
        if (!$this->inStock()) {
            return false;
        }

        if ($insertMoney < $this->getPrice()) {
            return false;
        }

        return true;
    }

    public function purchase($insertMoney) 
    {
        if (!$this->canPurchase($insertMoney)) {
            return false;
        }

        $this->stockNum -= 1;
        $this->saleAmount += $this->getPrice();

        return true;
    }

}
