<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Graph;

class AbstractGraphTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AmCharts\Graph\AbstractGraph
     */
    protected $graph;

    public function setUp()
    {
        $class = 'AmCharts\Graph\AbstractGraph';
        $this->graph = $this->getMockForAbstractClass($class);
    }

    public function testSetType()
    {
        $this->graph->setType('Foo');
        $this->assertEquals('Foo', $this->graph->getType());
    }

    public function testSetId()
    {
        $id = $this->graph->getId();
        $this->assertEquals(11, strlen($id));
        $this->assertStringStartsWith('graph', $id);

        $this->graph->setId('foo');
        $this->assertEquals('foo', $this->graph->getId());
    }

    public function testSetTitle()
    {
        $this->graph->setTitle('Foo');
        $this->assertEquals('Foo', $this->graph->getTitle());
    }

    public function testGetFields()
    {
        $this->assertInstanceOf('AmCharts\Graph\Fields', $this->graph->fields());
    }

    public function testSetBalloonText()
    {
        $this->graph->setBalloonText('Foo');
        $this->assertEquals('Foo', $this->graph->getBalloonText());
    }

    public function testSetFillAlphas()
    {
        $this->graph->setFillAlphas(50);
        $this->assertEquals(50, $this->graph->getFillAlphas());
    }

    public function testSetFillColors()
    {
        $this->graph->setFillColors(array('#ff0000', '#00ff00', '#0000ff'));

        $fillColors = $this->graph->getFillColors();
        $this->assertCount(3, $fillColors);
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $fillColors[0]);

        $this->graph->setFillColors('#ff0000');
        $fillColors = $this->graph->getFillColors();
        $this->assertCount(1, $fillColors);
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $fillColors[0]);
    }

    public function testSetLineAlpha()
    {
        $this->graph->setLineAlpha(50);
        $this->assertEquals(50, $this->graph->getLineAlpha());
    }

    public function testLineColor()
    {
        $color = $this->graph->getLineColor();
        $this->assertNull($color);

        $this->graph->setLineColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->graph->getLineColor());
    }

    public function testSetLineThickness()
    {
        $thickness = 20;
        $this->graph->setLineThickness($thickness);
        $this->assertEquals($thickness, $this->graph->getLineThickness());
    }

    public function testToArray()
    {
        $options = $this->graph->toArray();
        $this->assertCount(1, $options);
    }

    public function testClone()
    {
        $id = $this->graph->getId();

        $graph = clone $this->graph;

        $this->assertEquals($id, $this->graph->getId());
        $this->assertNotEquals($id, $graph->getId());
    }
}