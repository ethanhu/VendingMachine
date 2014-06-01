<?php

require_once dirname(__FILE__) . '/Item.php';

class Coke extends Item
{
    protected $name = 'Coke';
    protected $price = 120;

    function __construct() 
    {
        parent::__construct($this->name, $this->price);
    }
}
