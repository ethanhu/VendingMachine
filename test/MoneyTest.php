<?php

require_once dirname(__FILE__) . '/../lib/Money.php';

class MoneyTest extends PHPUnit_Framework_TestCase
{
    protected $model;
    protected function setUp()
    {
        $this->model = new Money();
    }

    public function test_自動販売機有効な入金をチェクできる()
    {
        // 有効入金
        $money_10 = Money::M_10;
        $result = $this->model->isValidVendingMachineMoneyType($money_10);
        $this->assertTrue($result, '10円が有効な販売機入力金です');

        $money_50 = Money::M_50;
        $result = $this->model->isValidVendingMachineMoneyType($money_50);
        $this->assertTrue($result, '50円が有効な販売機入力金です');

        $money_100 = Money::M_100;
        $result = $this->model->isValidVendingMachineMoneyType($money_100);
        $this->assertTrue($result, '100円が有効な販売機入力金です');

        $money_500 = Money::M_500;
        $result = $this->model->isValidVendingMachineMoneyType($money_500);
        $this->assertTrue($result, '500円が有効な販売機入力金です');
        
        $money_1000 = Money::M_1000;
        $result = $this->model->isValidVendingMachineMoneyType($money_1000);
        $this->assertTrue($result, '1000円が有効な販売機入力金です');
    
        // 無効入金
        $money_1 = Money::M_1;
        $result = $this->model->isValidVendingMachineMoneyType($money_1);
        $this->assertFalse($result, '1円が無効な販売機入力金です');

        $money_5 = Money::M_5;
        $result = $this->model->isValidVendingMachineMoneyType($money_5);
        $this->assertFalse($result, '5円が無効な販売機入力金です');

        $money_2000 = Money::M_2000;
        $result = $this->model->isValidVendingMachineMoneyType($money_2000);
        $this->assertFalse($result, '2000円が無効な販売機入力金です');

        $money_5000 = Money::M_5000;
        $result = $this->model->isValidVendingMachineMoneyType($money_5000);
        $this->assertFalse($result, '5000円が無効な販売機入力金です');

        $money_10000 = Money::M_10000;
        $result = $this->model->isValidVendingMachineMoneyType($money_10000);
        $this->assertFalse($result, '10000円が無効な販売機入力金です');
    }

    public function test_釣り銭できる()
    {
        $moneyBox = array(
            Money::M_10   => 1000,
            Money::M_50   => 200,
            Money::M_100  => 100,
            Money::M_500  => 20,
            Money::M_1000 => 10,
        );

        // test 1
        $needChange = 660;
        $returnChange = $this->model->greedyChange($moneyBox, $needChange);
        $expected = array(
            Money::M_500, 
            Money::M_100, 
            Money::M_50, 
            Money::M_10,
        );
        $this->assertEquals($expected, $returnChange);

        // test 2
        $needChange = 480;
        $returnChange = $this->model->greedyChange($moneyBox, $needChange);
        $expected = array(
            Money::M_100, 
            Money::M_100, 
            Money::M_100, 
            Money::M_100, 
            Money::M_50, 
            Money::M_10,
            Money::M_10,
            Money::M_10,
        );
        $this->assertEquals($expected, $returnChange);

        // test 3
        $moneyBox = array(
            Money::M_10   => 1000,
            Money::M_50   => 0,
            Money::M_100  => 100,
            Money::M_500  => 0,
            Money::M_1000 => 0,
        );
        $needChange = 560;
        $returnChange = $this->model->greedyChange($moneyBox, $needChange);
        $expected = array(
            Money::M_100, 
            Money::M_100, 
            Money::M_100, 
            Money::M_100, 
            Money::M_100, 
            Money::M_10,
            Money::M_10,
            Money::M_10,
            Money::M_10,
            Money::M_10,
            Money::M_10,
        );
        $this->assertEquals($expected, $returnChange);
    }

}    
