<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class RadarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Radar
     */
    protected $chart;

    public function setUp()
    {
        $this->chart = new Radar;
    }

    public function testGetType()
    {
        $this->assertEquals('radar', $this->chart->getType());
    }
}