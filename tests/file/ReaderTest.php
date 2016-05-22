<?php

class ReaderTest extends PHPUnit_Framework_TestCase
{
    protected $className = '\itz\file\Reader';

    public function testInstance()
    {
        $reader = $this->getInstance($this->getFilePath());
        $this->assertInstanceOf($this->className, $reader);

        $emptyFileName  = $this->getFilePath(false);
        $msg = '';
        try {
            $this->getInstance($emptyFileName);
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
        $this->assertEquals($msg, "File " . $emptyFileName . " not found");
    }

    public function testIsExists()
    {
        $method = $this->getAccessibleMethod('isExists');

        $realFileObj = $this->getInstance($this->getFilePath());
        $this->assertTrue($method->invoke($realFileObj));

        $emptyFileObj = $this->getEmptyFileObj();
        $this->assertFalse($method->invoke($emptyFileObj));
    }

    public function testGetData()
    {
        $method = $this->getAccessibleMethod('getData');

        $realFileObj = $this->getInstance($this->getFilePath());
        $resultArr = [];
        $res = $method->invoke($realFileObj);
        $this->assertTrue($res instanceof Generator);
        foreach($res as $string) {
            $resultArr[] = $string;
        }
        $this->assertEquals($resultArr, file($this->getFilePath()));

        $emptyFileObj = $this->getEmptyFileObj();
        $msg = '';
        try {
            foreach($method->invoke($emptyFileObj) as $string){
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
        }
        $this->assertEquals(
            $msg,
            'Could not open file'
        );
    }

    /**
     * @param $filepath
     * @return \itz\file\Reader
     */
    protected function getInstance($filepath)
    {
        return new \itz\file\Reader($filepath);
    }

    /**
     * @param bool|true $real
     * @return string
     */
    protected function getFilePath($real = true)
    {
        $file = __DIR__ . '/../rsc/a.txt';
        if (!$real) {
            $file = __DIR__ . '/../rsc/b.txt';
            return $file;
        }
        return $file;
    }

    /**
     * @return object
     */
    protected function getEmptyFileObj()
    {
        $emptyObjRf = new ReflectionClass($this->className);
        $emptyFileObj = $emptyObjRf->newInstanceWithoutConstructor();
        return $emptyFileObj;
    }

    /**
     * @return ReflectionMethod
     */
    protected function getAccessibleMethod($method)
    {
        $method = new ReflectionMethod(
            '\itz\file\Reader', $method
        );
        $method->setAccessible(true);
        return $method;
    }
}
