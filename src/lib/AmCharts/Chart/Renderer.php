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
     * @var AbstractChart
     */
    protected $chart;

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
        $this->chart = $chart;

        $code = '';
        
        $manager = Manager::getInstance();
        
        $imagesPath = $manager->getImagesPath();
        if ($imagesPath) {
            $params['pathToImages'] = $imagesPath;
        }

        if (!$manager->hasIncludedJs()) {
            $code .= $this->renderScriptTag(null, array('src' => $manager->getAmChartsPath())) . "\n";
            
            if ($manager->isLoadingJQuery()) {
                $code .= $this->renderScriptTag(null, array('src' => $manager->getJQueryPath())) . "\n";
            }
            
            $manager->setJsIncluded(true);
        }
        
        $tpl = $this->renderScriptTag(
                'var %1$s;' . "\n"
                . 'AmCharts.ready(function () {' . "\n"
                . '%2$s'
                . '%1$s.write("%1$s");' . "\n"
                . '});'
            )
            . "\n"
            . '<div id="%1$s" style="width:%3$s;height:%4$s;"></div>';
        
        $code .= sprintf(
            $tpl,
            $this->chart->getId(),
            $this->getInstructions($params, $attributes),
            $chart->getWidth(),
            $chart->getHeight()
        );

        return $code;
    }

    /**
     * Returns instructions
     *
     * @param array $params
     * @param array $attributes
     * @return string
     */
    protected function getInstructions($params, $attributes)
    {
        $instructions = sprintf(
            '%s = new AmCharts.Am%sChart();',
            $this->chart->getId(),
            ucfirst($this->chart->getType())
        ) . "\n";
        $instructions .= $this->formatVarProperties($this->chart->getId(), $params);

        $objects = array(
            array('legend', 'AmLegend'),
            array('valueAxis', 'ValueAxis'),
            array('cursor', 'ChartCursor'),
            array('scrollbar', 'ChartScrollbar'),
        );
        foreach ($objects as $object) {
            if (isset($attributes[$object[0]])) {
                $instructions .= $this->formatObjectAdding(
                    $object[0], $object[1], $attributes[$object[0]]->toArray()
                );
            }
        }

        $formatters = array('numberFormatter', 'percentFormatter');
        foreach ($formatters as $formatter) {
            if (isset($attributes[$formatter])) {
                $instructions .= sprintf(
                    '%s.%s = %s;',
                    $this->chart->getId(),
                    $formatter,
                    json_encode($attributes[$formatter]->toArray())
                );
            }
        }
        
        if (isset($attributes['graphs']) && is_array($attributes['graphs'])) {
            foreach ($attributes['graphs'] as $key => $graph) {
                $graphId = 'graph' . $key;
                $instructions .= $this->formatObjectAdding($graphId, 'AmGraph', $graph->toArray());
            }
        }

        return $instructions;
    }

    /**
     * Format object adding
     *
     * @param string $variable
     * @param string $object
     * @param array $properties
     * @return string
     */
    protected function formatObjectAdding($variable, $object, $properties = array())
    {
        $method = 'add';
        if (strpos($object, 'Am') === 0) {
            $method .= substr($object, 2);
        }
        else {
            $method .= $object;
        }

        $code = '';
        $code .= sprintf('var %s = new AmCharts.%s();', $variable, $object) . "\n";
        $code .= $this->formatVarProperties($variable, $properties);
        $code .= sprintf('%s.%s(%s);', $this->chart->getId(), $method, $variable) . "\n";

        return $code;
    }
    
    /**
     * Format object properties of script
     * 
     * @param string $var
     * @param array $params
     * @return string 
     */
    protected function formatVarProperties($var, array $params)
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
    protected function renderScriptTag($content, $attribs = array())
    {
        $attribs['type'] = 'text/javascript';

        $attrString = '';
        foreach ($attribs as $key => $value) {
            $attrString .= sprintf(' %s="%s"', $key, $value);
        }

        $html = '<script' . $attrString . '>';
        if ($content) {
            $html .= PHP_EOL . $content . PHP_EOL;
        }
        $html .= '</script>';

        return $html;
    }
}