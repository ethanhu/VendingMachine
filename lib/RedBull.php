<?php

require_once dirname(__FILE__) . '/Item.php';

class RedBull extends Item
{
    protected $name = 'RedBull';
    protected $price = 200;

    function __construct() 
    {
        parent::__construct($this->name, $this->price);
    }
}
