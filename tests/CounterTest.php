<?php

class CounterTest extends PHPUnit_Framework_TestCase
{
    public function testGetMaxRepeatableValues()
    {
        $dp = $this->getMockBuilder('itz\file\IDataProvider')
            ->setMethods(['getData'])->getMock();
        $dp->expects($this->any())
            ->method('getData')
            ->will($this->returnValue([
                'a',
                'f',
                'a',
                'a',
                'b',
                'b',
                'd',
                'b',
                'c'
            ]));
        $counter = new \itz\Counter($dp);
        $this->assertEquals(
            $counter->getMaxRepeatableValues(2),
            [
                'a' => 3,
                'b' => 3,
            ]
        );
    }
}
