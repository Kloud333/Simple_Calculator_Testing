<?php

namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Calculator;
use src\Commands;


class CalculatorMethodsUnitTest extends TestCase {

    public function testGetResultMethod() {
        $calc = new Calculator();

        $result = $calc->getResult();
        $this->assertEquals(0, $result);
    }


    public function testSetValueMethod() {
        $calc = new Calculator();

        $result = $calc->setValue(5)->getResult();
        $this->assertEquals(5, $result);
    }


    public function testResetMethod() {
        $calc = new Calculator();

        $result = $calc->setValue(5)->getResult();
        $this->assertEquals(5, $result);

        $calc = new Calculator();

        $result = $calc->getResult();

        $this->assertEquals(0, $result);

    }

    public function testAddCommandMethod() {
        $calc = new Calculator();

        $sumMock = $this->createMock(Commands\SumCommand::class);
        $sumMock->method('execute')->willReturn(10);

        $calc->addCommand('+', $sumMock);

        $result = $calc->getResult();

        $this->assertArrayHasKey('+', $this->getObjectAttribute($calc, 'commands'));
    }

    public function testComputeMethod() {
        $calc = new Calculator();

        $sumMock = $this->createMock(Commands\SumCommand::class);
        $sumMock->method('execute')->willReturn(10);

        $calc->addCommand('+', $sumMock);

        $result = $calc->setValue(5)->compute('+', 5)->getResult();
        $this->assertEquals(10, $result);
    }

    public function testUndoMethod() {
        $calc = new Calculator();

        $sumMock = $this->createMock(Commands\SumCommand::class);
        $sumMock->method('execute')->willReturn(10);

        $calc->addCommand('+', $sumMock);

        $result = $calc->setValue(5)->compute('+', 5)->getResult();
        $this->assertEquals(10, $result);

        $result = $calc->undo()->getResult();
        $this->assertEquals(5, $result);
    }

    public function testComputeException() {
        $calc = new Calculator();

        $sumMock = $this->createMock(Commands\SumCommand::class);
        $sumMock->method('execute')->willReturn(10);

        $calc->addCommand('+', $sumMock);

        $this->expectException(\InvalidArgumentException::class);
        $calc->setValue(5)->compute(null, 5)->getResult();
    }

    public function testAddCommandException() {
        $calc = new Calculator();

        $this->expectException(\InvalidArgumentException::class);

        $sumMock = $this->createMock(Commands\SumCommand::class);
        $sumMock->method('execute')->willReturn(10);

        $calc->addCommand(null, $sumMock);
        $calc->setValue(5)->compute('*', 5)->getResult();
    }

}