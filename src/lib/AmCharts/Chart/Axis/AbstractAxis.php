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
     * @var Setting\Color 
     */
    protected $axisColor;
    
    /**
     * @var integer 
     */
    protected $axisThickness = 1;
    
    /**
     * @var integer 
     */
    protected $dashLength = 0;
    
    /**
     * @var Setting\Alpha 
     */
    protected $fillAlpha;
    
    /**
     * @var Setting\Color 
     */
    protected $fillColor;
    
    /**
     * @var Setting\Alpha 
     */
    protected $gridAlpha;
    
    /**
     * @var Setting\Color 
     */
    protected $gridColor;
    
    /**
     * @var integer 
     */
    protected $gridThickness = 1;
    
    /**
     * @var integer 
     */
    protected $labelRotation;
    
    /**
     * Length of the tick marks.
     * 
     * @var integer 
     */
    protected $tickLength = 5;
    
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
     * Sets axis color
     *
     * @param string|array|Color $color
     * @return AbstractAxis
     */
    public function setAxisColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->axisColor = $color;
            } else {
                $this->axisColor = new Setting\Color($color);
            }
        }

        return $this;
    }
    
    /**
     * Returns axis color
     * 
     * @return string 
     */
    public function getAxisColor()
    {
        return $this->axisColor;
    }
    
    /**
     * Sets axis thickness
     * 
     * @param integer $thickness 
     * @return AbstractAxis
     */
    public function setAxisThickness($thickness)
    {
        if ($thickness < 0) {
            throw new Exception\InvalidArgumentException('The thickness value must be positive.');
        }
        
        $this->axisThickness = (int) $thickness;
        
        return $this;
    }
    
    /**
     * Returns axis thickness
     * 
     * @return integer 
     */
    public function getAxisThickness()
    {
        return $this->axisThickness;
    }
    
    /**
     * Sets dash length
     * 
     * @param integer $length 
     * @return AbstractAxis
     */
    public function setDashLength($length)
    {
        $length = (int) $length;
        
        if ($length < 0) {
            throw new Exception\InvalidArgumentException('The dash length value must be positive.');
        }
        
        $this->dashLength = $length;
        
        return $this;
    }
    
    /**
     * Returns dash length
     * 
     * @return integer 
     */
    public function getDashLength()
    {
        return $this->dashLength;
    }
    
    /**
     * Sets fill alpha
     * 
     * @param integer $alpha 
     * @return AbstractAxis
     */
    public function setFillAlpha($alpha)
    {
        $this->fillAlpha = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns fill alpha
     * 
     * @return integer 
     */
    public function getFillAlpha()
    {
        return $this->fillAlpha->getOpacity();
    }
    
    /**
     * Sets fill color
     *
     * @param string|array|Color $color
     * @return AbstractAxis
     */
    public function setFillColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->fillColor = $color;
            } else {
                $this->fillColor = new Setting\Color($color);
            }
        }

        return $this;
    }
    
    /**
     * Returns fill color
     * 
     * @return string 
     */
    public function getFillColor()
    {
        return $this->fillColor;
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
     * Sets grid color
     *
     * @param string|array|Color $color
     * @return AbstractAxis
     */
    public function setGridColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->gridColor = $color;
            } else {
                $this->gridColor = new Setting\Color($color);
            }
        }

        return $this;
    }
    
    /**
     * Returns grid color
     * 
     * @return string 
     */
    public function getGridColor()
    {
        return $this->gridColor;
    }
    
    /**
     * Sets grid thickness
     * 
     * @param integer $thickness 
     * @return AbstractAxis
     */
    public function setGridThickness($thickness)
    {
        if ($thickness < 0) {
            throw new Exception\InvalidArgumentException('The thickness value must be positive.');
        }
        
        $this->gridThickness = (int) $thickness;
        
        return $this;
    }
    
    /**
     * Returns grid thickness
     * 
     * @return integer 
     */
    public function getGridThickness()
    {
        return $this->gridThickness;
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
     * Sets tick length
     * 
     * @param integer $length 
     * @return AbstractAxis
     */
    public function setTickLength($length)
    {
        $length = (int) $length;
        
        if ($length < 0) {
            throw new Exception\InvalidArgumentException('The tick length value must be positive.');
        }
        
        $this->tickLength = $length;
        
        return $this;
    }
    
    /**
     * Returns tick length
     * 
     * @return integer 
     */
    public function getTickLength()
    {
        return $this->tickLength;
    }
    
    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array(
            'labelRotation' => $this->labelRotation,
            'axisThickness' => $this->axisThickness,
            'gridThickness' => $this->gridThickness,
            'dashLength'    => $this->dashLength,
            'tickLength'    => $this->tickLength
        );
        
        if (isset($this->axisAlpha)) {
            $options['axisAlpha'] = $this->axisAlpha->getValue();
        }
        
        if (isset($this->axisColor)) {
            $options['axisColor'] = $this->axisColor;
        }
        
        if (isset($this->fillAlpha)) {
            $options['fillAlpha'] = $this->fillAlpha->getValue();
        }
        
        if (isset($this->fillColor)) {
            $options['fillColor'] = $this->fillColor;
        }
        
        if (isset($this->gridAlpha)) {
            $options['gridAlpha'] = $this->gridAlpha->getValue();
        }
        
        if (isset($this->gridColor)) {
            $options['gridColor'] = $this->gridColor;
        }
        
        return $options;
    }
}