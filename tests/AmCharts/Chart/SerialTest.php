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
    
    public function testGetCategoryAxis()
    {
        $this->assertInstanceOf('AmCharts\Chart\Axis\Category', $this->chart->categoryAxis());
    }
    
    public function testSetCategoryField()
    {
        $this->chart->setCategoryField('foo');
        $this->assertEquals('foo', $this->chart->getCategoryField());
    }
}