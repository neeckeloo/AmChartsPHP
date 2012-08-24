<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Graph;

class Bullet
{
    const NONE = 'none';
    const ROUND = 'round';
    const SQUARE = 'square';
    const TRIANGLE_UP = 'triangleUp';
    const TRIANGLE_DOWN = 'triangleDown';
    const BUBBLE = 'bubble';
    const CUSTOM = 'custom';

    /**
     * @var string 
     */
    protected $type;
    
    /**
     * Sets type
     * 
     * @param string $field
     * @return Bullet
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
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array();
        
        $properties = get_object_vars($this);
        foreach ($properties as $key => $value) {
            if (!$value) {
                continue;
            }

            if ($key == 'type') {
                $key = 'bullet';
            }

            $options[$key] = $value;
        }
        
        return $options;
    }
}