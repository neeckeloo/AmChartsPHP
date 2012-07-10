<?php
namespace AmCharts\Graph;

use AmCharts\Chart\Setting;

abstract class AbstractGraph
{
    /**
     * @var string 
     */
    protected $type;
    
    /**
     * @var string 
     */
    protected $title;
    
    /**
     * @var Fields
     */
    protected $fields;
    
    /**
     * Opacity of fill. Plural form is used to keep the same property names as our Flex charts'.
     * Flex charts can accept array of numbers to generate gradients.
     * Although you can set array here, only first value of this array will be used.
     * 
     * @var Setting\Alpha 
     */
    protected $fillAlphas;
    
    /**
     * Fill color. Will use lineColor if not set.
     * 
     * @var array 
     */
    protected $fillColors;
    
    /**
     * Sets type
     * 
     * @param string $type
     * @return AbstractGraph
     */
    public function setType($type)
    {
        $this->type = (string) $type;
        
        return $this;
    }
    
    /**
     * Returns type
     * 
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Sets title
     * 
     * @param string $title
     * @return AbstractGraph
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;
        
        return $this;
    }
    
    /**
     * Returns title
     * 
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
        
    /**
     * Sets and returns fields
     *
     * @param array $fields
     * @return Fields
     */
    public function fields($fields = array())
    {
        if (!isset($this->fields)) {
            $this->fields = new Fields();
        }
        
        $this->fields->setFields($fields);

        return $this->fields;
    }
    
    /**
     * Sets fill alphas
     * 
     * @param integer $alpha
     * @return AbstractGraph
     */
    public function setFillAlphas($alpha)
    {
        $this->fillAlphas = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns fill alphas
     * 
     * @return integer 
     */
    public function getFillAlphas()
    {
        return $this->fillAlphas->getOpacity();
    }
    
    /**
     * Sets fill colors
     * 
     * @param array|string|Setting\Color $colors
     * @return AbstractGraph 
     */
    public function setFillColors($colors)
    {
        if (!is_array($colors)) {
            $colors = array($colors);
            $this->setFillColors($colors);
        }
        
        $this->fillColors = array();
        foreach ($colors as $color) {
            if (!($color instanceof Setting\Color)) {
                $color = new Setting\Color($color);
            }
            
            $this->fillColors[] = $color;
        }
        
        return $this;
    }
    
    /**
     * Returns fill colors
     * 
     * @return integer 
     */
    public function getFillColors()
    {
        return $this->fillColors;
    }
    
    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array(
            'type'       => $this->type,
            'fillColors' => $this->fillColors
        );
        
        $options = $options + $this->fields()->toArray();
        
        if (isset($this->fillAlphas)) {
            $options['fillAlphas'] = $this->fillAlphas->getValue();
        }
        
        return $options;
    }
}