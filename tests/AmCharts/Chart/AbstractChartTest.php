<?php

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
        $class = 'AmCharts\Chart\AbstractChart';
        $this->chart = $this->getMockForAbstractClass($class);
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
        $this->assertCount(3, $dataProvider->getData());
    }
    
    public function testSetText()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Text', $this->chart->text());
    }
    
    public function testSetLegend()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Legend', $this->chart->legend());
    }
    
    public function testSetNumberFormatter()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Formatter\Number', $this->chart->numberFormatter());
    }
    
    public function testSetPercentFormatter()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Formatter\Percent', $this->chart->percentFormatter());
    }
    
    public function testRender()
    {
        Manager::getInstance()->setLoadJQuery(true);
        
        $output = $this->chart->render();
        $this->assertNotEquals(false, strpos($output, 'script'));
    }
}