<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
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
            'AmCharts\Chart\DataProvider\ReaderPluginManager',
            $this->object->getReaderPluginManager()
        );
    }
}