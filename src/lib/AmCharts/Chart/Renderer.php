<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Manager;

class Renderer
{
    /**
     * Returns the HTML code to insert on the page
     *
     * @param AbstractChart $chart
     * @param array $params
     * @param array $attributes
     * @return	string
     */
    public function render(AbstractChart $chart, $params = array(), $attributes = array())
    {
        $code = '';
        
        $manager = Manager::getInstance();

        if (!$manager->hasIncludedJs()) {
            $code .= $this->renderScriptTag($manager->getAmChartsPath()) . "\n";
            
            if ($manager->isLoadingJQuery()) {
                $code .= $this->renderScriptTag($manager->getJQueryPath()) . "\n";
            }
            
            $manager->setJsIncluded(true);
        }
        
        $chartId = $chart->getId();
        
        $instructions = $chartId . ' = new AmCharts.Am' . ucfirst($chart->getType()) . 'Chart();' . "\n";        
        $instructions .= $this->formatScriptVarProperties($chartId, $params);
        
        if (isset($attributes['legend'])) {
            $instructions .= 'var legend = new AmCharts.AmLegend();' . "\n";
            $instructions .= $this->formatScriptVarProperties('legend', $attributes['legend']->toArray());
            $instructions .= $chartId . '.addLegend(legend)' . "\n";
        }
        
        if (isset($attributes['valueAxis'])) {
            $instructions .= 'var valueAxis = new AmCharts.ValueAxis();' . "\n";
            $instructions .= $this->formatScriptVarProperties('valueAxis', $attributes['valueAxis']->toArray());
            $instructions .= $chartId . '.addValueAxis(valueAxis)' . "\n";
        }
        
        if (isset($attributes['cursor'])) {
            $instructions .= 'var chartCursor = new AmCharts.ChartCursor();' . "\n";
            $instructions .= $this->formatScriptVarProperties('chartCursor', $attributes['cursor']->toArray());
            $instructions .= $chartId . '.addChartCursor(chartCursor)' . "\n";
        }
        
        if (isset($attributes['graphs']) && count($attributes['graphs']) > 0) {
            foreach ($attributes['graphs'] as $key => $graph) {
                $graphId = 'graph' . $key;
                $instructions .= 'var ' . $graphId . ' = new AmCharts.AmGraph();' . "\n";
                $instructions .= $this->formatScriptVarProperties($graphId, $graph->toArray());
                $instructions .= $chartId . '.addGraph(' . $graphId . ');' . "\n";
            }
        }
        
        $tpl = '<script type="text/javascript">' . "\n"
            . 'var %1$s;' . "\n"
            . 'AmCharts.ready(function () {' . "\n"
            . '%2$s'
            . '%1$s.write("%1$s");' . "\n"
            . '});' . "\n"
            . '</script>' . "\n"
            . '<div id="%1$s" style="width:%3$s;height:%4$s;"></div>';
        $code .= sprintf($tpl, $chartId, $instructions, $chart->getWidth(), $chart->getHeight());

        return $code;
    }
    
    /**
     * Format object properties of script
     * 
     * @param string $var
     * @param array $params
     * @return string 
     */
    protected function formatScriptVarProperties($var, array $params)
    {
        $output = '';
        $tpl = '%s.%s = %s;' . "\n";
                
        foreach ($params as $name => $value) {
            if (is_null($value)) {
                continue;
            }
            
            if (is_array($value)) {
                array_walk($value, function (&$val, $key) {
                    if (!is_numeric($val)) {
                        $val = "'" . $val . "'";
                    }
                });
                $value = '[' . implode(',', $value) . ']';
            } elseif (is_bool($value)) {
                $value = true === $value ? 'true' : 'false';
            } elseif (!is_numeric($value) && $name != 'dataProvider') {
                $value = "'" . $value . "'";
            }
            
            $output .= sprintf($tpl, $var, $name, $value);
        }
        
        return $output;
    }
    
    /**
     * Render script tag
     * 
     * @param string $source
     * @return string 
     */
    protected function renderScriptTag($source)
    {        
        return sprintf('<script type="text/javascript" src="%s"></script>', $source);
    }
}