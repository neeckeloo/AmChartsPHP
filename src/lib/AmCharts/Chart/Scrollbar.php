<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Exception;

class Scrollbar
{
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
     * Sets scrollbar parameters
     * 
     * @param array $params
     * @return Scrollbar
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
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array();
        
        $fields = array_keys(get_object_vars($this));
        foreach ($fields as $field) {
            if (isset($this->{$field})) {
                if ($this->{$field} instanceof Setting\Alpha) {
                    $options[$field] = $this->{$field}->getValue();
                } elseif ($this->{$field} instanceof Setting\Text) {
                    $color = $this->{$field}->getColor();
                    if ($color) {
                        $options['color'] = $color->toString();
                    }
                } else {
                    $options[$field] = $this->{$field};
                }
            }
        }
        
        return $options;
    }
}