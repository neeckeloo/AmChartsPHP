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
    
    public function testSetResizeEnabled()
    {
        $this->assertTrue($this->scrollbar->isResizeEnabled());
        
        $this->scrollbar->setResizeEnabled(false);
        $this->assertFalse($this->scrollbar->isResizeEnabled());
    }
    
    public function setHeightProvider()
    {
        return array(
            array(10, '10px'),
            array('10px', '10px'),
        );
    }
    
    /**
     * @dataProvider setHeightProvider
     */
    public function testHeight($provided, $expected)
    {        
        $this->scrollbar->setHeight($provided);
        $this->assertEquals($expected, $this->scrollbar->getHeight());
    }
    
    public function setHeightWithInvalidParamProvider()
    {
        return array(
            array('foo')
        );
    }
    
    /**
     * @dataProvider setHeightWithInvalidParamProvider
     * @expectedException AmCharts\Exception\InvalidArgumentException
     */
    public function testSetHeightWithInvalidParam($provided)
    {
        $this->scrollbar->setHeight($provided);
    }
    
    public function testToArray()
    {
        $this->assertTrue(is_array($this->scrollbar->toArray()));
    }
}