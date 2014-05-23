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
        $this->model->insert($money_10);
        $this->assertEquals(10, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(10, $this->model->refund(), '10円を払い戻しできる');

        $money_50 = Money::M_50;
        $this->model->insert($money_50);
        $this->assertEquals(50, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(50, $this->model->refund(), '50円を払い戻しできる');

        $money_100 = Money::M_100;
        $this->model->insert($money_100);
        $this->assertEquals(100, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(100, $this->model->refund(), '100円を払い戻しできる');

        $money_500 = Money::M_500;
        $this->model->insert($money_500);
        $this->assertEquals(500, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(500, $this->model->refund(), '500円を払い戻しできる');

        $money_1000 = Money::M_1000;
        $this->model->insert($money_1000);
        $this->assertEquals(1000, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(1000, $this->model->refund(), '1000円を払い戻しできる');
    }
 
    public function test_指定なお金を複数回投入とと払い戻しできる()
    {
        $money_10 = Money::M_10;
        $money_50 = Money::M_50;
        $this->model->insert($money_10);
        $this->model->insert($money_50);
        $this->assertEquals(60, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(60, $this->model->refund(), '10円と50円を一緒に払い戻しできる');

        $money_100 = Money::M_100;
        $money_500 = Money::M_500;
        $money_1000 = Money::M_1000;
        $this->model->insert($money_100);
        $this->model->insert($money_500);
        $this->model->insert($money_1000);
        $this->assertEquals(1600, $this->model->total(),  '投入お金を総計できる');
        $this->assertEquals(1600, $this->model->refund(), '100円と500円と1000円を一緒に払い戻しできる');
    }

}
