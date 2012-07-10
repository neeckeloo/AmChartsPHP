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
    
    public function testRender()
    {
        Manager::getInstance()->setLoadJQuery(true);
        
        $output = $this->chart->render();
        $this->assertNotEquals(false, strpos($output, 'script'));
    }
}