<?php

namespace AmCharts\Chart\DataProvider;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Factory
     */
    protected $object;
    
    public function setUp()
    {
        $this->object = new Factory;
    }
    
    public function testGetReaderManager()
    {
        $this->assertInstanceOf(
            'AmCharts\Chart\DataProvider\ReaderManager',
            $this->object->getReaderManager()
        );
    }
}