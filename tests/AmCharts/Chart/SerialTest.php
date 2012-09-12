<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class SerialTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Serial
     */
    protected $chart;
    
    public function setUp()
    {
        $this->chart = new Serial;
    }

    public function testGetType()
    {
        $this->assertEquals('serial', $this->chart->getType());
    }
    
    public function testGetCategoryAxis()
    {
        $this->assertInstanceOf('AmCharts\Chart\Axis\Category', $this->chart->categoryAxis());
    }
    
    public function testSetCategoryField()
    {
        $value = 'foo';
        $this->chart->setCategoryField($value);
        $this->assertEquals($value, $this->chart->getCategoryField());
    }
    
    public function testSetColumnSpacing()
    {
        $spacing = 10;
        $this->chart->setColumnSpacing($spacing);
        $this->assertEquals($spacing, $this->chart->getColumnSpacing());
    }
    
    public function testSetColumnWidth()
    {
        $width = 0.6;
        $this->chart->setColumnWidth($width);
        $this->assertEquals($width, $this->chart->getColumnWidth());
    }
    
    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException 
     */
    public function testSetColumnWidthWithInvalidParam()
    {
        $width = 10;
        $this->chart->setColumnWidth($width);
        $this->assertEquals($width, $this->chart->getColumnWidth());
    }
}