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
    
    public function testToArray()
    {
        $this->assertTrue(is_array($this->scrollbar->toArray()));
    }
}