<?php

namespace AmCharts\Chart\DataProvider;

class ReaderManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReaderManager
     */
    protected $object;
    
    public function setUp()
    {
        $this->object = new ReaderPluginManager;
    }
    
    public function testHasReader()
    {
        $this->assertTrue($this->object->has('xml'));
        $this->assertTrue($this->object->has('json'));
    }
    
    public function testGetReader()
    {
        $this->assertInstanceOf(
            'AmCharts\Chart\DataProvider\Reader\ReaderInterface',
            $this->object->get('xml')
        );
    }
}