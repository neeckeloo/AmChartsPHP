<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting\Alpha;
use AmCharts\Chart\Setting\Color;
use AmCharts\Chart\Setting\Background;
use AmCharts\Chart\Setting\Text;

class Scrollbar
{
    /**
     * @var Background
     */
    protected $background;

    /**
     * @var Alpha
     */
    protected $graphFillAlpha;

    /**
     * @var Color
     */
    protected $graphFillColor;

    /**
     * @var Alpha
     */
    protected $graphLineAlpha;

    /**
     * @var Color
     */
    protected $graphLineColor;

    /**
     * @var Alpha
     */
    protected $gridAlpha;

    /**
     * @var Color
     */
    protected $gridColor;

    /**
     * Number of grid lines
     * 
     * @var integer 
     */
    protected $gridCount;

    /**
     * Specifies whether scrollbar has a resize feature.
     * 
     * @var boolean 
     */
    protected $resizeEnabled = true;
    
    /**
     * Height of scrollbar
     * 
     * @var integer
     */
    protected $scrollbarHeight;
    
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
     * Sets and returns background
     *
     * @param array $background
     * @return Scrollbar
     */
    public function background($background = null)
    {
        if (!isset($this->background)) {
            $this->background = new Background();
        }

        if (null !== $background) {
            $this->background->setParams($background);
        }

        return $this->background;
    }

    /**
     * Sets fill alpha
     *
     * @param integer $alpha
     * @return Scrollbar
     */
    public function setFillAlpha($alpha)
    {
        $this->graphFillAlpha = new Alpha($alpha);

        return $this;
    }

    /**
     * Returns fill alpha
     *
     * @return integer
     */
    public function getFillAlpha()
    {
        return $this->graphFillAlpha->getOpacity();
    }

    /**
     * Sets fill color
     *
     * @param string|array|Color $color
     * @return Scrollbar
     */
    public function setFillColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->graphFillColor = $color;
            } else {
                $this->graphFillColor = new Color($color);
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
        return $this->graphFillColor;
    }

    /**
     * Sets grid alpha
     *
     * @param integer $alpha
     * @return Scrollbar
     */
    public function setGridAlpha($alpha)
    {
        $this->gridAlpha = new Alpha($alpha);

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
     * @return Scrollbar
     */
    public function setGridColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->gridColor = $color;
            } else {
                $this->gridColor = new Color($color);
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
     * Set grid count
     *
     * @param integer $count
     * @return Scrollbar
     */
    public function setGridCount($count)
    {
        $this->gridCount = (int) $count;
    }

    /**
     * Returns grid count
     *
     * @return integer
     */
    public function getGridCount()
    {
        return $this->gridCount;
    }

    /**
     * Sets line alpha
     *
     * @param integer $alpha
     * @return Scrollbar
     */
    public function setLineAlpha($alpha)
    {
        $this->lineAlpha = new Alpha($alpha);

        return $this;
    }

    /**
     * Returns line alpha
     *
     * @return integer
     */
    public function getLineAlpha()
    {
        return $this->lineAlpha->getOpacity();
    }

    /**
     * Sets line color
     *
     * @param string|array|Color $color
     * @return Scrollbar
     */
    public function setLineColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->lineColor = $color;
            } else {
                $this->lineColor = new Color($color);
            }
        }

        return $this;
    }

    /**
     * Returns line color
     *
     * @return string
     */
    public function getLineColor()
    {
        return $this->lineColor;
    }
    
    /**
     * Sets if scrollbar resize is enabled
     * 
     * @param boolean $enabled
     * @return Scrollbar 
     */
    public function setResizeEnabled($enabled = false)
    {
        $this->resizeEnabled = (bool) $enabled;
        
        return $this;
    }
    
    /**
     * Returns true if scrollbar resize is enabled
     * 
     * @return boolean
     */
    public function isResizeEnabled()
    {
        return $this->resizeEnabled;
    }

    /**
     * Sets height
     * 
     * @param string $height 
     * @return AbstractChart
     */
    public function setHeight($height)
    {        
        $this->scrollbarHeight = (integer) $height;

        return $this;
    }
    
    /**
     * Returns height
     * 
     * @return string
     */
    public function getHeight()
    {
        return $this->scrollbarHeight;
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
                if ($this->{$field} instanceof Alpha) {
                    $options[$field] = $this->{$field}->getValue();
                } elseif ($this->{$field} instanceof Text) {
                    $color = $this->{$field}->getColor();
                    if ($color) {
                        $options['color'] = $color->toString();
                    }
                } else {
                    $options[$field] = $this->{$field};
                }
            }
        }

        if (isset($this->background)) {
            $options += $this->background->toArray();
        }
        
        return $options;
    }
}