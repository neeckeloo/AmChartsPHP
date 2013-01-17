<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

use AmCharts\Chart\Setting\Exception;

class Alpha
{
    /**
     * @var integer 
     */
    protected $opacity;
    
    /**
     * Constructor
     * 
     * @param integer $opacity 
     */
    public function __construct($opacity)
    {
        $this->setOpacity($opacity);
    }
    
    /**
     * Sets opacity
     * 
     * @param integer $opacity
     * @return Alpha
     */
    public function setOpacity($opacity)
    {
        if (!is_int($opacity)) {
            throw new Exception\InvalidArgumentException('Opacity value must be an integer.');
        }
        
        if (!($opacity >= 0 && $opacity <= 100)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '"%s" is not between 0 and 100.',
                $opacity
            ));
        }
        
        $this->opacity = (int) $opacity;
        
        return $this;
    }
    
    /**
     * Returns opacity
     * 
     * @return integer 
     */
    public function getOpacity()
    {
        return $this->opacity;
    }
    
    /**
     * Returns alpha value
     * 
     * @return float 
     */
    public function getValue()
    {
        return round($this->opacity / 100, 1);
    }
}