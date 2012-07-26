<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class CoordinateTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Coordinate
     */
    protected $chart;
    
    public function setUp()
    {
        $this->chart = $this->getMockForAbstractClass('AmCharts\Chart\Coordinate');
    }
    
    public function testSetSequencedAnimation()
    {        
        $this->chart->setSequencedAnimation(false);
        $this->assertFalse($this->chart->isSequencedAnimation());
    }
    
    public function testSetStartAlpha()
    {
        $this->assertEquals(100, $this->chart->getStartAlpha());
        
        $alpha = 20;
        $this->chart->setStartAlpha($alpha);
        $this->assertEquals($alpha, $this->chart->getStartAlpha());
    }
    
    public function testSetStartDuration()
    {
        $duration = 20;
        $this->chart->setStartDuration($duration);
        $this->assertEquals($duration, $this->chart->getStartDuration());
    }
    
    public function testGetValueAxis()
    {
        $valueAxis = $this->chart->valueAxis();
        $this->assertInstanceOf('AmCharts\Chart\Axis\Value', $valueAxis);
    }
}