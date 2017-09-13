<?php

namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Calculator;
use src\Commands;


class CalculatorCommandsTest extends TestCase {

    public function testSumCommand() {
        $sum = new Commands\SumCommand();

        $result = $sum->execute(2, 2);
        $this->assertEquals(4, $result);
    }

    public function testSubCommand() {
        $sub = new Commands\SubCommand();

        $result = $sub->execute(5, 3);
        $this->assertEquals(2, $result);
    }

    public function testMultCommand() {
        $mult = new Commands\MultCommand();

        $result = $mult->execute(2, 4);
        $this->assertEquals(8, $result);
    }

    public function testDivCommand() {
        $div = new Commands\DivCommand();

        $result = $div->execute(6, 3);
        $this->assertEquals(2, $result);
    }

    public function testSumException() {
        $sum = new Commands\SumCommand();
        $this->expectException(\InvalidArgumentException::class);

        $result = $sum->execute(2);
        $this->assertEquals(4, $result);
    }

    public function testSubException() {
        $sub = new Commands\SubCommand();
        $this->expectException(\InvalidArgumentException::class);

        $result = $sub->execute(5);
        $this->assertEquals(2, $result);
    }

    public function testMultException() {
        $mult = new Commands\MultCommand();
        $this->expectException(\InvalidArgumentException::class);

        $result = $mult->execute(2);
        $this->assertEquals(8, $result);
    }

    public function testDivException() {
        $div = new Commands\DivCommand();
        $this->expectException(\InvalidArgumentException::class);

        $result = $div->execute(6);
        $this->assertEquals(2, $result);
    }
}