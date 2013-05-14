<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Manager;

class RendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Renderer
     */
    protected $renderer;

    public function setUp()
    {
        Manager::resetInstance();
        $this->renderer = $this->getMockForAbstractClass('AmCharts\Chart\Renderer');
    }

    public function testRender()
    {
        $chart = $this->getMockForAbstractClass('AmCharts\Chart\AbstractChart');
        $this->renderer->setChart($chart);
        
        $this->assertTrue(is_string($this->renderer->render()));
    }

    public function testChangeJsIncludedAfterWhenRendering()
    {
        $manager = Manager::getInstance();
        $manager->setJsIncluded(true);

        $chart = $this->getMockForAbstractClass('AmCharts\Chart\AbstractChart');
        $this->renderer->setChart($chart);

        $output = $this->renderer->renderHtml();
        $this->assertRegExp('/<script(.*?)>(.*?)<\/script>/', $output);

        $this->assertFalse($manager->hasIncludedJs());
    }
}