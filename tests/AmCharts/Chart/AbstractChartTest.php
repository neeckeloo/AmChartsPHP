<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Manager;

class AbstractChartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AmCharts\Chart\AbstractChart
     */
    protected $chart;
    
    public function setUp()
    {
        $this->chart = $this->getMockForAbstractClass('AmCharts\Chart\AbstractChart');
    }

    public function testSetId()
    {
        $this->assertContains('chart_', $this->chart->getId());

        $this->chart->setId('foo');
        $this->assertEquals('foo', $this->chart->getId());
    }

    public function testSetAttribsToConstructor()
    {
        $chart = new TestAsset\ChartWithAttribs(null, array('foo' => 123));
        $this->assertEquals(123, $chart->getFoo());
    }
    
    public function testGetType()
    {
        $this->assertNull($this->chart->getType());
    }
    
    public function testSetTitle()
    {
        $title = 'foo';
        $this->chart->setTitle($title);
        $this->assertEquals($title, $this->chart->getTitle());
    }
    
    public function setWidthAndHeightProvider()
    {
        return array(
            array(10, '10px'),
            array('10px', '10px'),
            array('10%', '10%'),
        );
    }
    
    /**
     * @dataProvider setWidthAndHeightProvider
     */
    public function testSetWidth($provided, $expected)
    {
        $this->chart->setWidth($provided);
        $this->assertEquals($expected, $this->chart->getWidth());
    }
    
    /**
     * @dataProvider setWidthAndHeightProvider
     */
    public function testSetHeight($provided, $expected)
    {
        $this->chart->setHeight($provided);
        $this->assertEquals($expected, $this->chart->getHeight());
    }
    
    public function setWidthAndHeightWithInvalidParamProvider()
    {
        return array(
            array('foo')
        );
    }
    
    /**
     * @dataProvider setWidthAndHeightWithInvalidParamProvider
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetWidthWithInvalidParam($provided)
    {
        $this->chart->setWidth($provided);
    }
    
    /**
     * @dataProvider setWidthAndHeightWithInvalidParamProvider
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetHeightWithInvalidParam($provided)
    {
        $this->chart->setHeight($provided);
    }
    
    public function testSetDataProvider()
    {
        $data = array(
            'foo' => 1,
            'bar' => 2,
            'baz' => 3
        );        
        $this->chart->setDataProvider($data);
        
        $dataProvider = $this->chart->getDataProvider();
        $this->assertInstanceOf(
            'AmCharts\Chart\DataProvider',
            $dataProvider
        );
        $this->assertCount(3, $dataProvider->toArray());
    }
    
    public function testSetText()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Text', $this->chart->text());
    }
    
    public function testSetLegend()
    {
        $this->assertInstanceOf('AmCharts\Chart\Legend', $this->chart->legend());
    }
    
    public function testSetNumberFormatter()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Formatter\Number', $this->chart->numberFormatter());
    }
    
    public function testSetPercentFormatter()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Formatter\Percent', $this->chart->percentFormatter());
    }

    public function testSetRenderer()
    {
        $this->chart->setRenderer(new Renderer);
        $this->assertInstanceOf('AmCharts\Chart\Renderer\RendererInterface', $this->chart->getRenderer());
    }
    
    public function testRender()
    {
        Manager::getInstance()->setLoadJQuery(true);
        
        $output = $this->chart->render();
        $this->assertNotEquals(false, strpos($output, 'script'));
    }

    public function testClone()
    {
        $id = $this->chart->getId();

        $chart = clone $this->chart;

        $this->assertEquals($id, $this->chart->getId());
        $this->assertNotEquals($id, $chart->getId());
    }
}