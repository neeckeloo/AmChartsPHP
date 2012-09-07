<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class XYTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var XY
     */
    protected $chart;

    public function setUp()
    {
        $this->chart = new XY;
    }

    public function testGetType()
    {
        $this->assertEquals('xy', $this->chart->getType());
    }
}