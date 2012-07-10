<?php
/**
 * @category   AmCharts
 * @package    Chart
 */
namespace AmCharts\Chart\Axis;

use AmCharts\Exception;

/**
 * @category   AmCharts
 * @package    Chart
 */
class Category extends AbstractAxis
{    
    const POSITION_START = 'start';
    
    const POSITION_MIDDLE = 'middle';
    
    /**
     * @var string 
     */
    protected $gridPosition;
    
    /**
     * Sets grid position
     * 
     * @param type $position
     * @return Category 
     */
    public function setGridPosition($position)
    {
        if ($position != self::POSITION_START && $position != self::POSITION_MIDDLE) {
            throw new Exception\InvalidArgumentException('The grid position provided is not valid.');
        }
        
        $this->gridPosition = (string) $position;
        
        return $this;
    }
    
    /**
     * Returns grid position
     * 
     * @return string 
     */
    public function getGridPosition()
    {
        return $this->gridPosition;
    }
    
    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = parent::toArray() + array(
            'gridPosition' => $this->gridPosition
        );
        
        $keys = array_keys($options);
        array_walk($keys, function (&$value, $key) {
            $value = 'categoryAxis.' . $value;
        });
        $options = array_combine($keys, array_values($options));
        
        return $options;
    }
}