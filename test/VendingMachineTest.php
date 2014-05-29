<?php

require_once dirname(__FILE__) . '/../lib/VendingMachine.php';
require_once dirname(__FILE__) . '/../lib/Money.php';

class VendingMachineTest extends PHPUnit_Framework_TestCase
{
    protected $model;
    protected function setUp()
    {
        $this->model = new VendingMachine();
    }

    public function test_指定なお金を１つずつ投入と払い戻しできる()
    {
        $money_10 = Money::M_10;
        $result = $this->model->insert($money_10);
        $this->assertTrue($result, '10円を投入できる');
        $this->assertEquals(10, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(10, $this->model->refund(), '10円を払い戻しできる');
        $this->assertEquals(0,  $this->model->refund(), '２回目払い戻し操作して、何もを払い戻しない');

        $money_50 = Money::M_50;
        $result = $this->model->insert($money_50);
        $this->assertTrue($result, '50円を投入できる');
        $this->assertEquals(50, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(50, $this->model->refund(), '50円を払い戻しできる');

        $money_100 = Money::M_100;
        $result = $this->model->insert($money_100);
        $this->assertTrue($result, '100円を投入できる');
        $this->assertEquals(100, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(100, $this->model->refund(), '100円を払い戻しできる');

        $money_500 = Money::M_500;
        $result = $this->model->insert($money_500);
        $this->assertTrue($result, '500円を投入できる');
        $this->assertEquals(500, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(500, $this->model->refund(), '500円を払い戻しできる');

        $money_1000 = Money::M_1000;
        $result = $this->model->insert($money_1000);
        $this->assertTrue($result, '1000円を投入できる');
        $this->assertEquals(1000, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(1000, $this->model->refund(), '1000円を払い戻しできる');
    }

    public function test_指定なお金を複数回投入とと払い戻しできる()
    {
        $money_10 = Money::M_10;
        $money_50 = Money::M_50;
        $result1 = $this->model->insert($money_10);
        $result2 = $this->model->insert($money_50);
        $this->assertTrue(($result1 && $result2), '複数回お金を投入できる');
        $this->assertEquals(60, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(60, $this->model->refund(), '10円と50円を一緒に払い戻しできる');

        $money_100 = Money::M_100;
        $money_500 = Money::M_500;
        $money_1000 = Money::M_1000;
        $result1 = $this->model->insert($money_100);
        $result2 = $this->model->insert($money_500);
        $result3 = $this->model->insert($money_1000);
        $this->assertTrue(($result1 && $result2 && $result3), '複数回お金を投入できる');
        $this->assertEquals(1600, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(1600, $this->model->refund(), '100円と500円と1000円を一緒に払い戻しできる');
    }

    public function test_想定外なお金を投入した後自動払い戻し()
    {
        $money_1 = 1;
        $result = $this->model->insert($money_1);
        $this->assertFalse($result,  '想定外な1円を投入できない');
        $this->assertEquals(0, $this->model->total(),  '想定外な投入お金を総計しない');

        $money_5 = 5;
        $result = $this->model->insert($money_5);
        $this->assertFalse($result,  '想定外な5円を投入できない');
        $this->assertEquals(0, $this->model->total(),  '想定外な投入お金を総計しない');

        $money_10000 = 10000;
        $result = $this->model->insert($money_10000);
        $this->assertFalse($result,  '想定外な10000円を投入できない');
        $this->assertEquals(0, $this->model->total(),  '想定外な投入お金を総計しない');
    }


}
