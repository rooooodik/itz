<?php

class ConsoleParamTest extends PHPUnit_Framework_TestCase
{
    public function testGetParam()
    {
        $value = 'paramValue';
        $_SERVER['argv'][1] = $value;;
        $this->assertEquals(\itz\ConsoleParams::getParam(1), $value);
    }

}
