<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Exception;

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
        $width = (float) $width;
        
        if ($width < 0 || $width > 1) {
            throw new Exception\InvalidArgumentException("Column width must be between 0 and 1.");
        }
        
        $this->columnWidth = $width;
       
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
    public function getParams()
    {
        $params = parent::getParams();
        
        $params += array(
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