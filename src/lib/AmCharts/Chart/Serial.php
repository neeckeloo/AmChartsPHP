<?php
/**
 * @category   AmCharts
 * @package    Chart
 */
namespace AmCharts\Chart;

/**
 * @category   AmCharts
 * @package    Chart
 */
class Serial extends Rectangular
{
    /**
     * @var string 
     */
    protected $type = 'serial';
    
    /**
     * Axis\Category
     */
    protected $categoryAxis;
    
    /**
     * @var string 
     */
    protected $categoryField;
        
    /**
     * Sets and returns category axis
     *
     * @return Serial
     */
    public function categoryAxis()
    {
        if (!isset($this->categoryAxis)) {
            $this->categoryAxis = new Axis\Category();
        }

        return $this->categoryAxis;
    }
    
    /**
     * Sets category field
     * 
     * @param string $field
     * @return Serial
     */
    public function setCategoryField($field)
    {
        $this->categoryField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns category field
     * 
     * @return string 
     */
    public function getCategoryField()
    {
        return $this->categoryField;
    }  
    
    /**
     * Returns params
     * 
     * @return array 
     */
    protected function getParams()
    {
        $params = parent::getParams();
        
        $params = $params + array(
            'categoryField' => $this->categoryField
        );
        
        if (isset($this->categoryAxis)) {
            $options = $this->categoryAxis->toArray();
            foreach ($options as $key => $value) {
                $params[$key] = $value;
            }
        }
        
        return $params;
    }
}