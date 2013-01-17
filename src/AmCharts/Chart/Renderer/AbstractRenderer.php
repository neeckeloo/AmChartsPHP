<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Renderer;

use AmCharts\Chart\AbstractChart;

abstract class AbstractRenderer implements RendererInterface
{
    /**
     * @var AbstractChart
     */
    protected $chart;

    /**
     * Sets chart instance
     *
     * @param AbstractChart $chart
     * @return AbstractRenderer
     */
    public function setChart(AbstractChart $chart)
    {
        $this->chart = $chart;

        return $this;
    }
}