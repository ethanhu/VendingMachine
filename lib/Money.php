<?php

class Money
{
    const M_1     = 1;
    const M_5     = 5;
    const M_10    = 10;
    const M_50    = 50;
    const M_100   = 100;
    const M_500   = 500;
    const M_1000  = 1000;
    const M_2000  = 2000;
    const M_5000  = 5000;
    const M_10000 = 10000;

    private $validVendingMachineMoneyTypes;

    function __construct()
    {
        $this->validVendingMachineMoneyTypes = array (
            self::M_10,
            self::M_50,
            self::M_100,
            self::M_500,
            self::M_1000,
        );
    }

    /**
     * 自動販売機の扱えるお金チェク
     */
    public function isValidVendingMachineMoneyType($moneyType)
    {
        return in_array($moneyType, $this->validVendingMachineMoneyTypes);
    }

}
