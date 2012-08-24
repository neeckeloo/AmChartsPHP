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
     * @var Setting\Alpha
     */
    protected $gridAlpha;

    /**
     * @var Setting\Color
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
     * Sets grid alpha
     *
     * @param integer $alpha
     * @return Scrollbar
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
     * @return Scrollbar
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
        if (is_numeric($height)) {
            $height .= 'px';
        } elseif (!preg_match('/([\d].*)px/', $height)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected integer or value suffixed by pixel or percent unit; Received %s.',
                $height
            ));
        }
        
        $this->scrollbarHeight = (string) $height;

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