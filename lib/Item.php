<?php

class Item
{
    protected $name;
    protected $price;
    protected $stockNum = 0;

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

    public function store($num)
    {
        $this->stockNum += $num;
    }

    public function inStock()
    {
        return ($this->stockNum >= 1);
    }

}
