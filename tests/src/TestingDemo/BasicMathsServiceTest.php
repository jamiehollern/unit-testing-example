<?php

namespace TestingDemo\Tests;

use PHPUnit\Framework\TestCase;
use TestingDemo\BasicMathsService;

class BasicMathsServiceTest extends TestCase
{

    private $object;

    public function setUp()
    {
        parent::setUp();
        $this->object = new BasicMathsService();
    }

    /**
     * @test
     */
    public function testAddNumbers()
    {
        $actual = $this->object->addNumbers(2, 2);
        $expected = 4;
        $this->assertEquals($expected, $actual);
    }

    public function testSubtractNumbers()
    {
        $actual = $this->object->subtractNumbers(5, 1);
        $expected = 4;
        $this->assertEquals($expected, $actual);
    }


}
