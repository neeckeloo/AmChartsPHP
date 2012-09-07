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

    public function testSetAutoMargins()
    {
        $this->assertTrue($this->chart->getAutoMargins());

        $this->chart->setAutoMargins(false);
        $this->assertFalse($this->chart->getAutoMargins());

        $this->chart->setAutoMargins(true);
        $this->assertTrue($this->chart->getAutoMargins());
    }

    public function testSetMarginSide()
    {
        $this->chart->setMarginTop(10);
        $this->assertEquals(10, $this->chart->getMarginTop());
        
        $this->chart->setMarginBottom(10);
        $this->assertEquals(10, $this->chart->getMarginBottom());

        $this->chart->setMarginLeft(10);
        $this->assertEquals(10, $this->chart->getMarginLeft());

        $this->chart->setMarginRight(10);
        $this->assertEquals(10, $this->chart->getMarginRight());
    }

    public function testSetMargin()
    {
        $this->chart->setMargin(array(10, 10, 10, 10));

        $this->assertEquals(10, $this->chart->getMarginTop());
        $this->assertEquals(10, $this->chart->getMarginBottom());
        $this->assertEquals(10, $this->chart->getMarginLeft());
        $this->assertEquals(10, $this->chart->getMarginRight());

        $this->assertFalse($this->chart->getAutoMargins());
    }

    /**
     * @expectedException AmCharts\Exception\InvalidArgumentException
     */
    public function testSetMarginWithNotArrayValue()
    {
        $this->chart->setMargin('foo');
    }

    public function setMarginWithArrayDoesNotHaveFourValuesProvider()
    {
        return array(
            array(array(10, 10, 10)),
            array(array(10, 10, 10, 10, 10)),
        );
    }

    /**
     * @expectedException AmCharts\Exception\InvalidArgumentException
     * @dataProvider setMarginWithArrayDoesNotHaveFourValuesProvider
     */
    public function testSetMarginWithArrayDoesNotHaveFourValues($values)
    {
        $this->chart->setMargin($values);
    }
}