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

    /**
     * 釣り銭計算
     * Greedt Algorithm
     * 欲張りアルゴリズム
     *
     * @param array  $moneyBox   お金ボクス
     * @param string $needChange 必要な釣り銭数
     *
     * @return array $returnChange 釣り銭構成
     */
    public function greedyChange(array &$moneyBox, $needChange)
    {
        if (empty($moneyBox) || $this->calcTotalMoney($moneyBox) < $needChange) {
            return array();
        }
  
        $returnChange = array();
        while ($needChange > 0) {
            // 1000
            if ($needChange >= self::M_1000 && $moneyBox[self::M_1000] > 0) {
                $needChange -= self::M_1000;
                $returnChange[] = self::M_1000;
                $moneyBox[self::M_1000] -= 1;
            }
            // 500
            if ($needChange >= self::M_500 && $moneyBox[self::M_500] > 0) {
                $needChange -= self::M_500;
                $returnChange[] = self::M_500;
                $moneyBox[self::M_500] -= 1;
            }
            // 100
            else if ($needChange >= self::M_100 && $moneyBox[self::M_100] > 0) {
                $needChange -= self::M_100;
                $returnChange[] = self::M_100;
                $moneyBox[self::M_100] -= 1;
            }
            // 50
            else if ($needChange >= self::M_50 && $moneyBox[self::M_50] > 0) {
                $needChange -= self::M_50;
                $returnChange[] = self::M_50;
                $moneyBox[self::M_50] -= 1;
            }
            // 10
            else if ($needChange >= self::M_10 && $moneyBox[self::M_10] > 0) {
                $needChange -= self::M_10;
                $returnChange[] = self::M_10;
                $moneyBox[self::M_10] -= 1;
            }
            // 5
            else if ($needChange >= self::M_5 && $moneyBox[self::M_5] > 0) {
                $needChange -= self::M_5;
                $returnChange[] = self::M_5;
                $moneyBox[self::M_5] -= 1;
            }
            // 1
            else if ($needChange >= self::M_1 && $moneyBox[self::M_1] > 0) {
                $needChange -= self::M_1;
                $returnChange[] = self::M_1;
                $moneyBox[self::M_1] -= 1;
            }
        }
        
        return $returnChange;
    } 

    /**
     * お金ボクス総計
     */
    protected function calcTotalMoney(array $moneyBox)
    {
        $totalMoney = 0;
        foreach ($moneyBox as $money => $num) {
            $totalMoney += $money * $num;
        }

        return $totalMoney;
    } 

}
