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
        $this->chart->margin()->setAuto(false);
        $this->assertFalse($this->chart->margin()->isAuto());

        $this->chart->margin()->setAuto(true);
        $this->assertTrue($this->chart->margin()->isAuto());
    }

    public function testSetMarginSide()
    {
        $this->chart->margin()->setTop(10);
        $this->assertEquals(10, $this->chart->margin()->getTop());
        
        $this->chart->margin()->setBottom(10);
        $this->assertEquals(10, $this->chart->margin()->getBottom());

        $this->chart->margin()->setLeft(10);
        $this->assertEquals(10, $this->chart->margin()->getLeft());

        $this->chart->margin()->setRight(10);
        $this->assertEquals(10, $this->chart->margin()->getRight());
    }

    public function testSetMargin()
    {
        $this->chart->margin()->setValues(array(10, 10, 10, 10));

        $this->assertEquals(10, $this->chart->margin()->getTop());
        $this->assertEquals(10, $this->chart->margin()->getBottom());
        $this->assertEquals(10, $this->chart->margin()->getLeft());
        $this->assertEquals(10, $this->chart->margin()->getRight());

        $this->assertFalse($this->chart->margin()->isAuto());
    }

    /**
     * @expectedException AmCharts\Exception\InvalidArgumentException
     */
    public function testSetMarginWithNotArrayValue()
    {
        $this->chart->margin()->setValues('foo');
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
        $this->chart->margin()->setValues($values);
    }
}