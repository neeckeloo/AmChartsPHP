<?php
/**
 * @category   AmCharts
 * @package    Chart
 */
namespace AmCharts\Chart\Axis;

/**
 * @category   AmCharts
 * @package    Chart
 */
class Category extends AbstractAxis
{    
    /**
     * @var string 
     */
    protected $gridPosition;
    
    /**
     * Sets grid position
     * 
     * @param type $position
     * @return \AmCharts\Chart\Axis\Category 
     */
    public function setGridPosition($position)
    {
        if ($position == 'start' || $position == 'middle') {
            $this->gridPosition = (string) $position;
        }
        
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