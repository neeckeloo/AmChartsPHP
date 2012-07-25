<?php
/**
 * @category   AmCharts
 * @package    Chart
 */
namespace AmCharts\Chart;

use AmCharts\Manager,
    AmCharts\Chart\Setting,
    AmCharts\Exception;

/**
 * Base class for amChart PHP-Library
 * 
 * @category   AmCharts
 * @package    Chart
 */
abstract class AbstractChart
{
    /**
     * @var string
     */
    private $id;
    
    /**
     * @var string 
     */
    protected $type;

    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var integer|string
     */
    protected $width = '100%';
    
    /**
     * @var integer|string
     */
    protected $height = '400px';
    
    /**
     * @var Setting\Text 
     */
    protected $text;
    
    /**
     * @var array
     */
    protected $colors = array();

    /**
     * @var array
     */
    protected $labels = array();
    
    /**
     * @var Setting\Legend 
     */
    protected $legend;
    
    /**
     * @var Setting\Formatter\AbstractFormatter 
     */
    protected $numberFormatter;
    
    /**
     * @var Setting\Formatter\AbstractFormatter 
     */
    protected $percentFormatter;
    
    /**
     * @var DataProvider
     */
    protected $dataProvider;

    /**
     * Constructor can only be called from derived class because AmChart
     * is abstract.
     *
     * @param string $id
     */
    public function __construct($id = null)
    {
        if (null !== $id) {
            $this->id = (string) $id;
        } else {
            $this->id = 'chart_' . substr(md5(uniqid() . microtime()), 3, 5);
        }
        
        $this->init();
    }
    
    /**
     * Initialize chart 
     */
    public function init()
    {
        
    }

    /**
     * Sets title
     * 
     * @param string $title 
     * @return AbstractChart
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Sets width
     * 
     * @param string $width 
     * @return AbstractChart
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Sets height
     * 
     * @param string $height 
     * @return AbstractChart
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
        
    /**
     * Sets and returns text object
     *
     * @param array $params
     * @return Setting\Text
     */
    public function text($params = array())
    {
        if (!isset($this->text)) {
            $this->text = new Setting\Text();
        }
        
        $this->text->setParams($params);

        return $this->text;
    }
    
    /**
     * Sets colors
     * 
     * @param array $colors
     * @return AbstractChart
     */
    public function setColors(array $colors)
    {
        $this->colors = array();
        foreach ($colors as $color) {
            $this->addColor($color);
        }
        
        return $this;
    }
    
    /**
     * Add color
     * 
     * @param string|array|Setting\Color $color
     * @return AbstractChart 
     */
    public function addColor($color)
    {
        if ($color instanceof Setting\Color) {
            $this->colors[] = $color;
        } else {
            $this->colors[] = new Setting\Color($color);
        }
        
        return $this;
    }

    /**
     * Add label
     * 
     * @param string|Setting\Label $label
     * @param array $params
     * @return AbstractChart
     */
    public function addLabel($label, $params = array())
    {
        if ($label instanceof Setting\Label) {
            $this->labels[] = $label;
        } else {
            $this->labels[] = new Setting\Label($label, $params);
        }

        return $this;
    }
    
    /**
     * Sets and returns legend
     * 
     * @param array $params
     * @return Setting\Legend 
     */
    public function legend($params = array())
    {
        if (!isset($this->legend)) {
            $this->legend = new Setting\Legend();
        }
        
        $this->legend->setParams($params);

        return $this->legend;
    }
        
    /**
     * Sets and returns number formatter
     *
     * @param array $params
     * @return Setting\Formatter\Number
     */
    public function numberFormatter($params = array())
    {
        if (!isset($this->numberFormatter)) {
            $this->numberFormatter = new Setting\Formatter\Number();
        }
        
        $this->numberFormatter->setParams($params);

        return $this->numberFormatter;
    }
        
    /**
     * Sets and returns percent formatter
     *
     * @param array $params
     * @return Setting\Formatter\Percent
     */
    public function percentFormatter($params = array())
    {
        if (!isset($this->percentFormatter)) {
            $this->percentFormatter = new Setting\Formatter\Percent();
        }
        
        $this->percentFormatter->setParams($params);

        return $this->percentFormatter;
    }

    /**
     * Sets data provider
     * 
     * @param array|DataProvider $provider 
     * @return AbstractChart
     */
    public function setDataProvider($provider)
    {
        if (is_array($provider)) {
            $provider = new DataProvider($provider);
        }
        else if (!($provider instanceof DataProvider)) {
            throw new Exception\InvalidArgumentException(
                'Data provider must be an instance of '
                . 'AmCharts\Chart\DataProvider.'
            );
        }
        
        $this->dataProvider = $provider;

        return $this;
    }
    
    /**
     * Returns data provider
     * 
     * @return array 
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }
    
    /**
     * Returns params
     * 
     * @return array 
     */
    protected function getParams()
    {
        $params = array();
        
        $dataProvider = $this->getDataProvider();
        if (null !== $dataProvider) {
            $params['dataProvider'] = json_encode($dataProvider->getData());
        }
        
        return $params;
    }

    /**
     * Returns the HTML Code to insert on the page
     *
     * @return	string
     */
    public function render()
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
        
        $instructions = $this->id . ' = new AmCharts.Am' . ucfirst($this->type) . 'Chart();' . "\n";        
        $instructions .= $this->formatScriptVarProperties($this->id, $this->getParams());
        
        if (isset($this->legend)) {
            $instructions .= 'legend = new AmCharts.AmLegend();' . "\n";
            $instructions .= $this->formatScriptVarProperties('legend', $this->legend->toArray());
            $instructions .= $this->id . '.addLegend(legend)' . "\n";
        }
        
        if (isset($this->valueAxis)) {
            $instructions .= 'valueAxis = new AmCharts.ValueAxis();' . "\n";
            $instructions .= $this->formatScriptVarProperties('valueAxis', $this->valueAxis->toArray());
            $instructions .= $this->id . '.addValueAxis(valueAxis)' . "\n";
        }
        
        if (isset($this->graphs) && count($this->graphs) > 0) {
            foreach ($this->graphs as $key => $graph) {
                $id = 'graph' . $key;
                $instructions .= $id . ' = new AmCharts.AmGraph();' . "\n";
                $instructions .= $this->formatScriptVarProperties($id, $graph->toArray());
                $instructions .= $this->id . '.addGraph(' . $id . ')' . "\n";
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
        $code .= sprintf($tpl, $this->id, $instructions, $this->width, $this->height);

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