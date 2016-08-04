<?php

namespace Fgunix\DataInterpolation\Test;

use PHPUnit\Framework\TestCase;
use Fgunix\DataInterpolation\DataInterpolation;

class DataInterpolationTest extends TestCase
{
    protected $dataInterpolation;

    protected function setup()
    {
        $this->dataInterpolation = new DataInterpolation;
    }

    public function testSetEntries() {

        $d = $this->dataInterpolation;
        $d->setEntries($this->getData());

        $this->assertNotEmpty( $d->getEntries() );
        $this->assertInstanceOf( \DateTime::class, $d->getEntries()[0]['date']);
        $this->assertArrayHasKey(3, $d->getEntries());
    }

    public function testGetResult()
    {
        $d = $this->dataInterpolation;
        $d->setThreshold(20);
        $d->setEntries($this->getData());
        $result = $d->getResult();

        $this->assertTrue( $result !== false );
        $this->assertNotEmpty( $result );
        $this->assertEquals( $result, $this->getExpectedResult() );
        $this->assertArrayHasKey('2010-10-01 00:00:00', $result);
        $this->assertCount(5, $result);
    }

    public function testCreateFactory()
    {
        $f = DataInterpolation::create()->setEntries($this->getData())->setThreshold(20);
        $result = $f->getResult();

        $this->assertNotEmpty( $f->getEntries() );
        $this->assertSame( 20, $f->getThreshold() );
        $this->assertEquals( $result, $this->getExpectedResult() );
    }

    function testIsDataInterpolationClass()
    {
        $obj = $this->dataInterpolation;
        $this->assertInstanceOf( 'Fgunix\DataInterpolation\DataInterpolation', $obj );
    }

    protected function getData()
    {
        $data = array(
            "2010-05-01 12:20:08" => 858,
            "2010-06-05 16:30:54" => 1009,
            "2010-07-04 08:11:20" => 1156,
            "2010-08-02 14:06:20" => 1293,
            "2010-08-31 13:50:00" => 1345,
            "2010-10-03 17:34:20" => 1512
        );
        return $data;
    }

    protected function getExpectedResult()
    {
        $result = array(
            '2010-06-01 00:00:00' => '988.87422566161',
            '2010-07-01 00:00:00' => '1138.858493165',
            '2010-08-01 00:00:00' => '1285.562562824',
            '2010-09-01 00:00:00' => '1345.7598757496',
            '2010-10-01 00:00:00' => '1498.2384995078'
        );
        return $result;
    }

    protected function tearDown()
    {
        unset( $this->dataInterpolation );
    }
}
