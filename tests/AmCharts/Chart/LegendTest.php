<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class LegendTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Legend
     */
    protected $legend;
    
    public function setUp()
    {
        $this->legend = new Legend();
    }
    
    public function testSetParams()
    {
        $this->legend->setParams(array(
            'text' => array('foo' => 123),
            'foo' => 123
        ));
        $this->assertInstanceOf('AmCharts\Chart\Setting\Text', $this->legend->text());
    }

    public function testSetBorder()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Border', $this->legend->border());
    }

    public function testSetMargin()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Margin', $this->legend->margin());
    }
    
    public function testSetText()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Text', $this->legend->text());
    }

    public function testSetLabelText()
    {
        $this->assertCount(0, $this->legend->toArray());

        $this->legend->setLabelText('[[title]]');
        $this->assertEquals('[[title]]', $this->legend->getLabelText());
        $this->assertCount(1, $this->legend->toArray());
    }

    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetLabelTextThatNotContainsTitleTag()
    {
        $this->legend->setLabelText('foo');
    }

    public function testSetValueText()
    {
        $this->assertCount(0, $this->legend->toArray());
        
        $this->legend->setValueText('[[value]]');
        $this->assertEquals('[[value]]', $this->legend->getValueText());
        $this->assertCount(1, $this->legend->toArray());
    }

    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetValueTextThatNotContainsTags()
    {
        $this->legend->setValueText('foo');
    }

    public function testSetValueTextEnabled()
    {
        $params = $this->legend->toArray();
        $this->assertArrayNotHasKey('valueText', $params);

        $tag = '[[value]]';
        $this->legend->setValueText($tag);
        
        $this->assertTrue($this->legend->getValueTextEnabled());

        $params = $this->legend->toArray();
        $this->assertEquals($tag, $params['valueText']);

        $this->legend->setValueTextEnabled(false);
        $this->assertFalse($this->legend->getValueTextEnabled());

        $params = $this->legend->toArray();
        $this->assertArrayHasKey('valueText', $params);
        $this->assertEquals('', $params['valueText']);
    }
    
    public function testToArray()
    {
        $this->assertCount(0, $this->legend->toArray());
    }
}