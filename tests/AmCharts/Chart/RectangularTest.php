<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class RectangularTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Rectangular
     */
    protected $chart;

    public function setUp()
    {
        $this->chart = $this->getMockForAbstractClass('AmCharts\Chart\Rectangular');
    }

    public function testSetCursor()
    {
        $this->assertInstanceOf('AmCharts\Chart\Cursor', $this->chart->cursor());
    }

    public function testSetMargins()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Margin', $this->chart->margin());
    }

    public function testSetScrollbar()
    {
        $this->assertInstanceOf('AmCharts\Chart\Scrollbar', $this->chart->scrollbar());
    }
}