<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider\Reader;

class AbstractReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractReader
     */
    protected $reader;
    
    public function setUp()
    {
        $class = 'AmCharts\Chart\DataProvider\Reader\AbstractReader';
        $this->reader = $this->getMockForAbstractClass(
            $class, array(), '', true, true, true, array('fromString')
        );

        $this->reader->expects($this->any())
            ->method('fromString')
            ->will($this->returnArgument(0));
    }

    public function testFromFile()
    {
        $data = $this->reader->fromFile(__DIR__ . '/_files/data.xml');
        $this->assertStringStartsWith('<root>', $data);
    }

    /**
     * @expectedException AmCharts\Chart\Exception\RuntimeException
     */
    public function testFromFileWithWrongFile()
    {
        $this->reader->fromFile('foo.xml');
    }
}