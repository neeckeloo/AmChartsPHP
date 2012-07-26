<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting\Formatter;

class PercentTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Number
     */
    protected $formatter;
    
    public function setUp()
    {
        $this->formatter = new Percent;
    }
    
    public function testGetPrecision()
    {
        $this->assertEquals(2, $this->formatter->getPrecision());
    }
}