<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class ScrollbarTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Scrollbar
     */
    protected $scrollbar;
    
    public function setUp()
    {
        $this->scrollbar = new Scrollbar;
    }

    public function testSetBackground()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Background', $this->scrollbar->background());
    }

    public function testSetGraph()
    {
        $class = 'AmCharts\Graph\AbstractGraph';
        $graph = $this->getMockForAbstractClass($class);

        $this->scrollbar->setGraph($graph);
        $this->assertInstanceOf($class, $this->scrollbar->getGraph());

        $params = $this->scrollbar->toArray();
        $this->assertArrayHasKey('graph', $params);
    }

    public function testSetGraphFillAlpha()
    {
        $this->scrollbar->setGraphFillAlpha(30);
        $this->assertEquals(30, $this->scrollbar->getGraphFillAlpha());
    }

    public function testSetGraphFillColor()
    {
        $this->scrollbar->setGraphFillColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->scrollbar->getGraphFillColor());
    }

    public function testSetGridAlpha()
    {
        $this->scrollbar->setGridAlpha(30);
        $this->assertEquals(30, $this->scrollbar->getGridAlpha());
    }

    public function testSetGridColor()
    {
        $this->scrollbar->setGridColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->scrollbar->getGridColor());
    }

    public function testSetGridCount()
    {
        $count = 5;
        $this->scrollbar->setGridCount($count);
        $this->assertEquals($count, $this->scrollbar->getGridCount());
    }

    public function testSetGraphLineAlpha()
    {
        $this->scrollbar->setGraphLineAlpha(30);
        $this->assertEquals(30, $this->scrollbar->getGraphLineAlpha());
    }

    public function testSetGraphLineColor()
    {
        $this->scrollbar->setGraphLineColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->scrollbar->getGraphLineColor());
    }
    
    public function testSetResizeEnabled()
    {        
        $this->scrollbar->setResizeEnabled(false);
        $this->assertFalse($this->scrollbar->isResizeEnabled());
    }

    public function testHeight()
    {        
        $this->scrollbar->setHeight(10);
        $this->assertEquals(10, $this->scrollbar->getHeight());
    }
    
    public function testToArray()
    {
        $this->assertTrue(is_array($this->scrollbar->toArray()));
    }
}