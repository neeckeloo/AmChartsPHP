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
     * The gap in pixels between two columns of the same category.
     * 
     * @var integer 
     */
    protected $columnSpacing;
    
    /**
     * Relative width of columns. Value range is 0 - 1.
     * 
     * @var float 
     */
    protected $columnWidth;
        
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
     * Sets column spacing
     * 
     * @param integer $spacing
     * @return Serial 
     */
    public function setColumnSpacing($spacing)
    {
        $this->columnSpacing = (int) $spacing;

        return $this;
    }
    
    /**
     * Returns column spacing
     * 
     * @return integer 
     */
    public function getColumnSpacing()
    {
        return $this->columnSpacing;
    }
    
    /**
     * Sets column width
     * 
     * @param float $width
     * @return Serial 
     */
    public function setColumnWidth($width)
    {
        if (!is_int($width)) {
            throw new Exception\InvalidArgumentException("Column width must be between 0 and 1.");
        }
        
        $this->columnWidth = (float) $width;
       
        return $this;
    }
    
    /**
     * Returns column width
     * 
     * @return float 
     */
    public function getColumnWidth()
    {
        return $this->columnWidth;
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
            'categoryField' => $this->categoryField,
            'columnSpacing' => $this->columnSpacing,
            'columnWidth'   => $this->columnWidth
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