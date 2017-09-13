<?php

namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Calculator;
use src\Commands;


class CalculatorTest extends TestCase {
    public function testSumCommand() {
        $calc = new Calculator();
        $calc->addCommand('+', new Commands\SumCommand());

        $result = $calc->setValue(5)->compute('+', 5)->getResult();
        $this->assertEquals(10, $result);
    }

    public function testSubCommand() {
        $calc = new Calculator();
        $calc->addCommand('-', new Commands\SubCommand());

        $result = $calc->setValue(5)->compute('-', 5)->getResult();
        $this->assertEquals(0, $result);
    }

    public function testMultCommand() {
        $calc = new Calculator();
        $calc->addCommand('*', new Commands\MultCommand());

        $result = $calc->setValue(5)->compute('*', 5)->getResult();
        $this->assertEquals(25, $result);
    }

    public function testDivCommand() {
        $calc = new Calculator();
        $calc->addCommand('/', new Commands\DivCommand());

        $result = $calc->setValue(25)->compute('/', 5)->getResult();
        $this->assertEquals(5, $result);
    }

    public function testUndoMethod() {
        $calc = new Calculator();
        $calc->addCommand('+', new Commands\SumCommand());

        $result = $calc->setValue(5)->compute('+', 5)->getResult();
        $this->assertEquals(10, $result);

        $result = $calc->undo()->getResult();
        $this->assertEquals(5, $result);
    }

    public function testComputeException() {
        $calc = new Calculator();
        $calc->addCommand('*', new Commands\MultCommand());

        $this->expectException(\InvalidArgumentException::class);
        $calc->setValue(5)->compute(null, 5)->getResult();
    }

    public function testAddCommandException() {
        $calc = new Calculator();

        $this->expectException(\InvalidArgumentException::class);
        $calc->addCommand(null, new Commands\MultCommand());
        $calc->setValue(5)->compute('*', 5)->getResult();
    }

    public function testSumException() {
        $calc = new Calculator();
        $calc->addCommand('+', new Commands\SumCommand());

        $this->expectException(\InvalidArgumentException::class);
        $calc->setValue(5)->compute('+')->getResult();
    }

    public function testSubException() {
        $calc = new Calculator();
        $calc->addCommand('-', new Commands\SubCommand());

        $this->expectException(\InvalidArgumentException::class);
        $calc->setValue(5)->compute('-')->getResult();
    }

    public function testMultException() {
        $calc = new Calculator();
        $calc->addCommand('*', new Commands\MultCommand());

        $this->expectException(\InvalidArgumentException::class);
        $calc->setValue(5)->compute('*')->getResult();
    }

    public function testDivException() {
        $calc = new Calculator();
        $calc->addCommand('/', new Commands\DivCommand());

        $this->expectException(\InvalidArgumentException::class);
        $calc->setValue(5)->compute('/')->getResult();
    }

}