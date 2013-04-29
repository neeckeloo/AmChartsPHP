<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class RendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Renderer
     */
    protected $renderer;

    public function setUp()
    {
        $this->renderer = $this->getMockForAbstractClass('AmCharts\Chart\Renderer');
    }

    public function testRender()
    {
        $chart = $this->getMockForAbstractClass('AmCharts\Chart\AbstractChart');
        $this->renderer->setChart($chart);
        
        $this->assertTrue(is_string($this->renderer->render()));
    }
}