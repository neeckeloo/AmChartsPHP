<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Graph;

class Fields
{
    /**
     * @var string 
     */
    protected $alphaField;
    
    /**
     * @var string 
     */
    protected $bulletField;
    
    /**
     * @var string 
     */
    protected $bulletSizeField;
    
    /**
     * @var string 
     */
    protected $colorField;
    
    /**
     * @var string 
     */
    protected $customBulletField;
    
    /**
     * @var string 
     */
    protected $descriptionField;
    
    /**
     * @var string 
     */
    protected $fillColorsField;
    
    /**
     * @var string 
     */
    protected $urlField;
    
    /**
     * @var string 
     */
    protected $valueField;
    
    /**
     * @var string 
     */
    protected $xField;
    
    /**
     * @var string 
     */
    protected $yField;
    
    /**
     * Constructor
     * 
     * @param array $fields
     */
    public function __construct($fields = array())
    {
        $this->setFields($fields);
    }
    
    /**
     * Sets fields
     * 
     * @param array $fields
     * @return Fields
     */
    public function setFields(array $fields = array())
    {
        $properties = get_object_vars($this);
        foreach ($fields as $key => $value) {
            if (array_key_exists($key, $properties)) {
                $method = 'set' . ucfirst($key);
                $this->{$method}($value);
            }
        }
        
        return $this;
    }
    
    /**
     * Sets alpha field
     * 
     * @param string $field
     * @return Fields
     */
    public function setAlphaField($field)
    {
        $this->alphaField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns alpha field
     * 
     * @return string 
     */
    public function getAlphaField()
    {
        return $this->alphaField;
    }
    
    /**
     * Sets bullet field
     * 
     * @param string $field
     * @return Fields
     */
    public function setBulletField($field)
    {
        $this->bulletField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns bullet field
     * 
     * @return string 
     */
    public function getBulletField()
    {
        return $this->bulletField;
    }
    
    /**
     * Sets bullet size field
     * 
     * @param string $field
     * @return Fields
     */
    public function setBulletSizeField($field)
    {
        $this->bulletSizeField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns bullet size field
     * 
     * @return string 
     */
    public function getBulletSizeField()
    {
        return $this->bulletSizeField;
    }
    
    /**
     * Sets color field
     * 
     * @param string $field
     * @return Fields
     */
    public function setColorField($field)
    {
        $this->colorField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns color field
     * 
     * @return string 
     */
    public function getColorField()
    {
        return $this->colorField;
    }
    
    /**
     * Sets custom bullet field
     * 
     * @param string $field
     * @return Fields
     */
    public function setCustomBulletField($field)
    {
        $this->customBulletField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns custom bullet field
     * 
     * @return string 
     */
    public function getCustomBulletField()
    {
        return $this->customBulletField;
    }
    
    /**
     * Sets description field
     * 
     * @param string $field
     * @return Fields
     */
    public function setDescriptionField($field)
    {
        $this->descriptionField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns description field
     * 
     * @return string 
     */
    public function getDescriptionField()
    {
        return $this->descriptionField;
    }
    
    /**
     * Sets fill colors field
     * 
     * @param string $field
     * @return Fields
     */
    public function setFillColorsField($field)
    {
        $this->fillColorsField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns fill colors field
     * 
     * @return string 
     */
    public function getFillColorsField()
    {
        return $this->fillColorsField;
    }
    
    /**
     * Sets url field
     * 
     * @param string $field
     * @return Fields
     */
    public function setUrlField($field)
    {
        $this->urlField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns url field
     * 
     * @return string 
     */
    public function getUrlField()
    {
        return $this->urlField;
    }
    
    /**
     * Sets value field
     * 
     * @param string $field
     * @return Fields
     */
    public function setValueField($field)
    {
        $this->valueField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns value field
     * 
     * @return string 
     */
    public function getValueField()
    {
        return $this->valueField;
    }
    
    /**
     * Sets x field
     * 
     * @param string $field
     * @return Fields
     */
    public function setXField($field)
    {
        $this->xField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns x field
     * 
     * @return string 
     */
    public function getXField()
    {
        return $this->xField;
    }
    
    /**
     * Sets y field
     * 
     * Only for XY charts
     * 
     * @param string $field
     * @return Fields
     */
    public function setYField($field)
    {
        $this->yField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns y field
     * 
     * Only for XY charts
     * 
     * @return string 
     */
    public function getYField()
    {
        return $this->yField;
    }
    
    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array();
        
        $properties = get_object_vars($this);
        foreach ($properties as $key => $value) {
            if (null !== $value) {
                $options[$key] = $value;
            }
        }
        
        return $options;
    }
}