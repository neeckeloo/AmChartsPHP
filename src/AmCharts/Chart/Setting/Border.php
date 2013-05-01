<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class Border
{    
    /**
     * @var Color 
     */
    protected $color;
    
    /**
     * @var Alpha 
     */
    protected $alpha;

    /**
     * @var integer
     */
    protected $thickness;
    
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
     * Sets border parameters
     *
     * @param array $params
     * @return Border
     */
    public function setParams(array $params = array())
    {
        foreach ($params as $name => $value) {
            $method = 'set' . ucfirst($name);
            if ($name == 'color') {
                $method = $name;
            }

            if (!method_exists($this, $method)) {
                continue;
            }

            call_user_func_array(array($this, $method), array($value));
        }

        return $this;
    }
    
    /**
     * Sets alpha
     * 
     * @param integer $alpha 
     * @return Border
     */
    public function setAlpha($alpha)
    {
        $this->alpha = new Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns alpha
     * 
     * @return integer 
     */
    public function getAlpha()
    {
        return $this->alpha->getOpacity();
    }
        
    /**
     * Sets and returns border color
     *
     * @param null|string|array|Color $color
     * @return Color
     */
    public function color($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->color = $color;
            } else {
                $this->color = new Color($color);
            }
        }

        return $this->color;
    }

    /**
     * Sets border thickness
     *
     * @param integer $thickness
     * @return Border
     */
    public function setThickness($thickness)
    {
        if ($thickness < 0) {
            throw new Exception\InvalidArgumentException('The thickness value must be positive.');
        }

        $this->thickness = (int) $thickness;

        return $this;
    }

    /**
     * Returns border thickness
     *
     * @return integer
     */
    public function getThickness()
    {
        return $this->thickness;
    }
    
    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array();

        if (isset($this->alpha)) {
            $options['borderAlpha'] = $this->alpha->getValue();
        }
        if (isset($this->color)) {
            $options['borderColor'] = $this->color->toString();
        }
        if (isset($this->thickness)) {
            $options['borderThickness'] = $this->thickness;
        }
        
        return $options;
    }
}