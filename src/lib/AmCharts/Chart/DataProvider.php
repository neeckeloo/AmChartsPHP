<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class DataProvider
{    
    /**
     * @var array 
     */
    protected $data;
    
    /**
     * Constructor
     * 
     * @param array $data 
     */
    public function __construct(array $data)
    {
        $this->data = (array) $data;
    }
    
    /**
     * Returns data
     * 
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }
}