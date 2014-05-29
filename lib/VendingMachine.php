<?php

require_once dirname(__FILE__) . '/Money.php';
require_once dirname(__FILE__) . '/Money.php';

class VendingMachine
{
    private $money;
    private $insertMoneyBox = array();
    private $itemBox = array();

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
            $this->total();
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
        $total = array_sum($this->insertMoneyBox);
        print "\n投入お金総計：$total \n";

        return $total; 
    } 

    /**
     * 払い戻し操作
     */
    public function refund() 
    {
        print "\n払い戻し操作： \n";
        $changeMoney = $this->insertMoneyBox;
        return $this->_change($changeMoney);
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
     * 釣り銭を計算する
     */
    private function _change()
    {
        $changeMoney = $this->insertMoneyBox;
        $this->insertMoneyBox = array();
        $this->_changeOutput($changeMoney);
        return array_sum($changeMoney);
    }

    /**
     * 釣り銭を出力する
     */
    private function _changeOutput($changeMoney) 
    {
        if (is_array($changeMoney)) {
            print "\n釣り銭出力：\n";
            while($moneyType = array_pop($changeMoney)) {
                print "-釣り銭：$moneyType \n";
            }
        }
        # あつかえないお金を出力する
        else {
            print "扱えないお金出力：$changeMoney \n";
        }
    }

}
