<?php
/**
 * @category   AmCharts
 * @package    Chart
 */
namespace AmCharts\Chart\Axis;

use AmCharts\Chart\Setting,
    AmCharts\Exception;

/**
 * @category   AmCharts
 * @package    Chart
 */
abstract class AbstractAxis
{    
    /**
     * @var Setting\Alpha 
     */
    protected $axisAlpha;
    
    /**
     * @var Setting\Alpha 
     */
    protected $gridAlpha;
    
    /**
     * @var integer 
     */
    protected $labelRotation;
    
    /**
     * Sets axis alpha
     * 
     * @param integer $alpha 
     * @return AbstractAxis
     */
    public function setAxisAlpha($alpha)
    {
        $this->axisAlpha = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns axis alpha
     * 
     * @return integer 
     */
    public function getAxisAlpha()
    {
        return $this->axisAlpha->getOpacity();
    }
    
    /**
     * Sets grid alpha
     * 
     * @param integer $alpha 
     * @return AbstractAxis
     */
    public function setGridAlpha($alpha)
    {
        $this->gridAlpha = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns grid alpha
     * 
     * @return integer 
     */
    public function getGridAlpha()
    {
        return $this->gridAlpha->getOpacity();
    }
    
    /**
     * Sets label rotation
     * 
     * @param integer $angle
     * @return \AmCharts\Chart\Axis\AbstractAxis 
     */
    public function setLabelRotation($angle)
    {
        if (!is_int($angle)) {
            throw new Exception\InvalidArgumentException("The label rotation value must be an integer.");
        }
        
        if (!($angle > -360 && $angle < 360)) {
            throw new Exception\UnexpectedValueException("'$angle' is not a valid angle.");
        }
        
        $this->labelRotation = (int) $angle;
        
        return $this;
    }
    
    /**
     * Returns label rotation
     * 
     * @return AbstractAxis 
     */
    public function getLabelRotation()
    {
        return $this->labelRotation;
    }
    
    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array(
            'labelRotation' => $this->labelRotation
        );
        
        if (isset($this->axisAlpha)) {
            $options['axisAlpha'] = $this->axisAlpha->getValue();
        }
        
        if (isset($this->gridAlpha)) {
            $options['gridAlpha'] = $this->gridAlpha->getValue();
        }
        
        return $options;
    }
}