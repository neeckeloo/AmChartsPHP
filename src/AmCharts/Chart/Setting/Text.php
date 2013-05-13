<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

use AmCharts\Chart\Setting\Exception;

class Text
{    
    const ALIGN_LEFT = 'left';
    const ALIGN_CENTER = 'center';
    const ALIGN_RIGHT = 'right';
    
    /**
     * @var string 
     */
    protected $value;
    
    /**
     * @var string 
     */
    protected $fontFamily;
    
    /**
     * @var integer 
     */
    protected $fontSize;
    
    /**
     * @var Color 
     */
    protected $color;
    
    /**
     * @var string 
     */
    protected $align;
    
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
     * Sets text parameters
     * 
     * @param array $params
     * @return Font
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
     * Sets value
     * 
     * @param string $value
     * @return Font 
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
    }
    
    /**
     * Returns value
     * 
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Sets family
     * 
     * @param string $family
     * @return Font 
     */
    public function setFontFamily($family = 'Arial')
    {
        $this->fontFamily = (string) $family;
    }
    
    /**
     * Returns font family
     * 
     * @return string 
     */
    public function getFontFamily()
    {
        return $this->fontFamily;
    }
    
    /**
     * Sets font size
     * 
     * @param integer $size
     * @return Font 
     */
    public function setFontSize($size = 11)
    {
        $this->fontSize = (int) $size;
        
        return $this;
    }
    
    /**
     * Returns font size
     * 
     * @return integer 
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }
        
    /**
     * Sets text color
     *
     * @param string|array|Color $color
     * @return Font
     */
    public function setColor($color = '#000000')
    {
        if ($color instanceof Color) {
            $this->color = $color;
        } else {
            $this->color = new Color($color);
        }
        
        return $this;
    }
    
    /**
     * Returns text color
     * 
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }
    
    /**
     * Sets alignement
     * 
     * @param string $align
     * @return Text 
     */
    public function setAlign($align = self::ALIGN_LEFT)
    {
        if (
            $align != self::ALIGN_LEFT
            && $align != self::ALIGN_CENTER
            && $align != self::ALIGN_RIGHT
        ) {
            throw new Exception\InvalidArgumentException('The alignement provided is invalid.');
        }
        
        $this->align = (string) $align;
        
        return $this;
    }
    
    /**
     * Returns alignement
     * 
     * @return string 
     */
    public function getAlign()
    {
        return $this->align;
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
                if ($field == 'value') {
                    $options['text'] = $this->{$field};
                } else {
                    $options[$field] = $this->{$field};
                }
            }
        }
        
        return $options;
    }
}