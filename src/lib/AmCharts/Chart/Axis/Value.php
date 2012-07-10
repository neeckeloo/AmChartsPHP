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
class Value extends AbstractAxis
{   
    /**
     * Specifies whether axis displays category axis' labels and value axis' values.
     * 
     * @var boolean 
     */
    protected $labelsEnabled;
    
    /**
     * Sets true if labels are enabled
     * 
     * @param boolean $enabled
     * @return Value 
     */
    public function setLabelsEnabled($enabled = true)
    {
        $this->labelsEnabled = (bool) $enabled;
        
        return $this;
    }
    
    /**
     * Returns true if labels are enabled
     * 
     * @return boolean 
     */
    public function isLabelsEnabled()
    {
        return $this->labelsEnabled;
    }


    /**
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = parent::toArray() + array(
            'labelsEnabled' => $this->labelsEnabled
        );
        
        return $options;
    }
}