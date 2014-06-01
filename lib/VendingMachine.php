<?php

require_once dirname(__FILE__) . '/Money.php';
require_once dirname(__FILE__) . '/Money.php';

class VendingMachine
{
    private $money;
    private $moneyBox = array();
    private $insertMoneyBox = array();
    private $itemBox = array();
    private $purchaseAmount = 0;

    function __construct()
    {
        $this->money = new Money();
    }

    /**
     * お金投入
     */
    public function insert($moneyType) 
    {
        if ($this->money->isValidVendingMachineMoneyType($moneyType)) {
            array_push($this->insertMoneyBox, $moneyType); 
            print "$moneyType円を投入した、投入金額総計: " . $this->total() . "\n";
            return true;
        } 
        // 想定外なお金は、投入金額加算せず、そのまま釣り銭としてを出力する
        else {
            $this->_changeOutput($moneyType);
            return false;
        }
    } 

    /**
     * 投入お金総計
     */
    public function total() 
    {
        return array_sum($this->insertMoneyBox);
    } 

    /**
     * 払い戻し操作
     */
    public function refund() 
    {
        print "\n\n払い戻し操作： \n";
        return $this->_change();
    }

    /**
     * 商品格納する
     */
    public function addItem($item)
    {
        $name = $item->getName();
        // 格納した商品再格納の場合、格納数字だけを増やす
        if (array_key_exists($name, $this->itemBox)) {
            $this->itemBox[$name]->store($item->getStockNum());
        } else {
            $this->itemBox[$name] = $item;
        }
    }

    /**
     * 商品取得する
     */
    public function getItem($name)
    {
        return $this->itemBox[$name];
    }

    /**
     * 商品購入
     */
    public function purchase($name)
    {
        if (!$this->canPurchase($name)) {
            return false;
        }

        if ($this->itemBox[$name]->purchase($this->total() - $this->purchaseAmount)) {
            $this->purchaseAmount += $this->itemBox[$name]->getPrice(); 
            print "$name 商品購入成功! \n";
            return true;
        }

        return false; 
    }

    /**
     * 商品購入できるチェク
     */
    public function canPurchase($name) 
    {
        if (!array_key_exists($name, $this->itemBox)) {
            return false;
        }

        if ($this->itemBox[$name]->canPurchase($this->total() - $this->purchaseAmount)) {
            print "$name 購入できる";
            return true;
        } else {
            print "$name 購入できず";
            return false;
        }
    } 

    /**
     * 売り上げ金額
     */
    public function getSaleAmount($name = null)
    {
        if (!is_null($name)) {
            return $this->itemBox[$name]->getSaleAmount();
        } 

        // 全商品の売り上げ
        $saleAmount = 0;
        foreach ($this->itemBox as $item) {
            $saleAmount += $item->getSaleAmount();
        }

        return $saleAmount;
    }

    /**
     * 釣り銭を計算する
     */
    private function _change()
    {
        if ($this->purchaseAmount === 0) {
            $changeMoney = $this->insertMoneyBox;
        } else {
            $changeMoney = $this->total() - $this->purchaseAmount;
        }

        $this->_changeOutput($changeMoney);
        $this->insertMoneyBox = array();
        $this->purchaseAmount = 0;

        return is_array($changeMoney) 
               ? array_sum($changeMoney)
               : $changeMoney;
    }

    /**
     * 釣り銭を出力する
     */
    private function _changeOutput($changeMoney) 
    {
        if (is_array($changeMoney)) {
            print " - 釣り銭出力：\n";
            while($moneyType = array_pop($changeMoney)) {
                print "  -- 釣り銭：$moneyType \n";
            }
        }
        # あつかえないお金もしくは購入した釣り銭を出力する
        else {
            print "  -- 釣り銭：$changeMoney \n";
        }
    }

}
