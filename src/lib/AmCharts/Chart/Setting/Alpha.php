<?php
/**
 * @category   AmCharts
 */
namespace AmCharts\Chart\Setting;

use AmCharts\Exception;

/**
 * @category   AmCharts
 */
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
            throw new Exception\InvalidArgumentException("Opacity value must be an integer.");
        }
        
        if (!($opacity >= 0 && $opacity <= 100)) {
            throw new Exception\InvalidArgumentException("'$opacity' is not between 0 and 100.");
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