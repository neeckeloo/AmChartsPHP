<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Renderer;

use AmCharts\Chart\AbstractChart;

interface RendererInterface
{
    /**
     * Sets chart instance
     *
     * @param AbstractChart $chart
     * @return AbstractRenderer
     */
    public function setChart(AbstractChart $chart);

    /**
     * @return void
     */
    public function render();
}