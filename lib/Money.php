<?php

class Money
{
    const M_10   = 10;
    const M_50   = 50;
    const M_100  = 100;
    const M_500  = 500;
    const M_1000 = 1000;

    private $moneyTypes;

    function __construct()
    {
        $this->moneyTypes = array (
            self::M_10,
            self::M_50,
            self::M_100,
            self::M_500,
            self::M_1000,
        );
    }

    public function isValid($moneyNum)
    {
        return in_array($moneyNum, $this->moneyTypes);
    }

}
