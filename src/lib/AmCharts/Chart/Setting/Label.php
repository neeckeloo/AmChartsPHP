<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class Label
{    
    /**
     * Horizontal position of the label
     * 
     * @var integer 
     */
    protected $x;
    
    /**
     * Vertical position of the label
     * 
     * @var integer 
     */
    protected $y;
    
    /**
     * @var string 
     */
    protected $text;
    
    /**
     * Constructor
     * 
     * @param array $params 
     */
    public function __construct($text, $params = array())
    {
        $this->text()->setValue($text);
        $this->setParams($params);
    }
    
    /**
     * Sets label parameters
     * 
     * @param array $params
     * @return Label
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
     * Sets the horizontal position of the label
     * 
     * @param integer $x
     * @return Label 
     */
    public function setX($x)
    {
        $this->x = (int) $x;
        
        return $this;
    }
    
    /**
     * Returns horizontal position of the label
     * 
     * @return string 
     */
    public function getX()
    {
        return $this->x;
    }
    
    /**
     * Sets the vertical position of the label
     * 
     * @param integer $y
     * @return Label 
     */
    public function setY($y)
    {
        $this->y = (int) $y;
        
        return $this;
    }
    
    /**
     * Returns vertical position of the label
     * 
     * @return string 
     */
    public function getY()
    {
        return $this->y;
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
     * Returns label as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $params = array(
            'x' => $this->x,
            'y' => $this->y
        );
        
        if (isset($this->text)) {
            $params = $params + $this->text->toArray();
        }
        
        return $params;
    }
}