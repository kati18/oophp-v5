<?php

namespace Kati18\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class Dice.
 */
class DiceTest extends TestCase
{
    private $die;

    /**
    * Creates an instance/object of class Dice, no arguments.
    * Runs before every test method in the class.
    */
    protected function setUp(): void
    {
        $this->die = new Dice();
    }

    /**
    * Tears down/clears the instance/object of class Dice after
    * each method in the class has run. The object can then be collected
    * by the garbage collector.
    */
    protected function tearDown(): void
    {
        unset($this->die);
    }

    public function testGetLastRollFaceDice(): void
    {
        $res = $this->die->rollDice();
        $exp = $this->die->getLastRollFaceDice();
        $this->assertEquals($res, $exp);
    }

    public function testGetInitRollFaceDice(): void
    {
        $res = $this->die->getInitRollFaceDice(4, 4);
        $notExp = 4;
        $this->assertNotEquals($res, $notExp);
    }
}
