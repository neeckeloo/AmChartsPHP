<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Legend;

use AmCharts\Chart\Setting\Color;

class MarkerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Marker
     */
    protected $marker;

    public function setUp()
    {
        $this->marker = new Marker();
    }

    public function testSetBorder()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Border', $this->marker->border());
    }

    public function testSetDisabledColor()
    {
        $color = '#ff0000';

        $this->marker->disabledColor($color);
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->marker->disabledColor());

        $this->marker->disabledColor(new Color($color));
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->marker->disabledColor());
    }

    public function testSetLabelGap()
    {
        $labelGap = 2;
        $this->marker->setLabelGap($labelGap);
        $this->assertEquals($labelGap, $this->marker->getLabelGap());
    }

    public function testSetSize()
    {
        $size = 2;
        $this->marker->setSize($size);
        $this->assertEquals($size, $this->marker->getSize());
    }

    public function testSetType()
    {
        $type = Marker::BUBBLE;
        $this->marker->setType($type);
        $this->assertEquals($type, $this->marker->getType());
    }

    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetTypeWithInvalidValue()
    {
        $this->marker->setType('foo');
    }

    public function testToArray()
    {
        $this->marker->border()->setAlpha(20);

        $params = $this->marker->toArray();
        $this->assertCount(1, $params);
        $this->assertArrayHasKey('markerBorderAlpha', $params);
    }
}