<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class MarginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Margin
     */
    protected $margin;
    
    public function setUp()
    {
        $this->margin = new Margin();
    }

    public function testSetAutoMargins()
    {
        $this->margin->setAuto(false);
        $this->assertFalse($this->margin->isAuto());

        $this->margin->setAuto(true);
        $this->assertTrue($this->margin->isAuto());
    }

    public function testSetMarginSide()
    {
        $this->margin->setTop(10);
        $this->assertEquals(10, $this->margin->getTop());

        $this->margin->setBottom(10);
        $this->assertEquals(10, $this->margin->getBottom());

        $this->margin->setLeft(10);
        $this->assertEquals(10, $this->margin->getLeft());

        $this->margin->setRight(10);
        $this->assertEquals(10, $this->margin->getRight());
    }

    public function testSetMargin()
    {
        $this->margin->setValues(array(10, 10, 10, 10));

        $this->assertEquals(10, $this->margin->getTop());
        $this->assertEquals(10, $this->margin->getBottom());
        $this->assertEquals(10, $this->margin->getLeft());
        $this->assertEquals(10, $this->margin->getRight());

        $this->assertFalse($this->margin->isAuto());
    }

    /**
     * @expectedException AmCharts\Chart\Setting\Exception\InvalidArgumentException
     */
    public function testSetMarginWithNotArrayValue()
    {
        $this->margin->setValues('foo');
    }

    public function setMarginWithArrayDoesNotHaveFourValuesProvider()
    {
        return array(
            array(array(10, 10, 10)),
            array(array(10, 10, 10, 10, 10)),
        );
    }

    /**
     * @expectedException AmCharts\Chart\Setting\Exception\InvalidArgumentException
     * @dataProvider setMarginWithArrayDoesNotHaveFourValuesProvider
     */
    public function testSetMarginWithArrayDoesNotHaveFourValues($values)
    {
        $this->margin->setValues($values);
    }
    
    public function testToArray()
    {
        $this->assertCount(0, $this->margin->toArray());
    }
}