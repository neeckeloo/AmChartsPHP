<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class Background
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
     * Constructor
     *
     * @param array $params
     */
    public function __construct($params = array())
    {
        $this->setParams($params);
    }

    /**
     * Sets background parameters
     *
     * @param array $params
     * @return Background
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
     * @return Background
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
     * Sets and returns background color
     *
     * @param null|string|array|Color $color
     * @return Background
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
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array();
        
        if (isset($this->alpha)) {
            $options['backgroundAlpha'] = $this->alpha->getValue();
        }
        if (isset($this->color)) {
            $options['backgroundColor'] = $this->color->toString();
        }
        
        return $options;
    }
}