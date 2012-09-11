<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting\Margin;
use AmCharts\Chart\Setting\Text;

class Legend
{
    /**
     * Margins
     *
     * @var Margin
     */
    protected $margin;
    
    /**
     * @var Text 
     */
    protected $text;
    
    /**
     * Constructor
     * 
     * @param array $params 
     */
    public function __construct($params = array())
    {
        $this->setParams($params);
    }
    
    /**
     * Sets legend parameters
     * 
     * @param array $params
     * @return Legend
     */
    public function setParams(array $params = array())
    {
        foreach ($params as $name => $value) {
            $method = 'set' . ucfirst($name);
            if (!method_exists($this, $method)) {
                continue;
            }
            
            call_user_func_array(array($this, $method), array($value));
        }
        
        return $this;
    }

    /**
     * Sets and returns chart margins
     *
     * @param array $margin
     * @return Margin
     */
    public function margin($margin = null)
    {
        if (!isset($this->margin)) {
            $this->margin = new Margin();
        }

        if (null !== $margin) {
            $this->margin->setValues($margin);
        }

        return $this->margin;
    }
        
    /**
     * Sets and returns text object
     *
     * @param array $params
     * @return Text
     */
    public function text($params = array())
    {        
        if (!isset($this->text)) {
            $this->text = new Text();
        }
        
        $this->text->setParams($params);

        return $this->text;
    }
    
    /**
     * Returns legend as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $params = array();

        if (isset($this->margin)) {
            $params += $this->margin->toArray();
        }
        if (isset($this->text)) {
            $params += $this->text->toArray();
        }
        
        return $params;
    }
}