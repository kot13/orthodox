<?php

use Orthodox\Rules\NumberRule;

class RulesTest extends PHPUnit_Framework_TestCase
{
    public function testNumberule()
    {
        $numberRule = new NumberRule();

        $this->assertFalse(
            $numberRule->run('one', [], [])
        );

        $this->assertTrue(
            $numberRule->run(1, [], [])
        );
    }
}