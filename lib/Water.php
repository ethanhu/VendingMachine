<?php

require_once dirname(__FILE__) . '/Item.php';

class Water extends Item
{
    protected $name = 'Water';
    protected $price = 100;

    function __construct() 
    {
        parent::__construct($this->name, $this->price);
    }
}
