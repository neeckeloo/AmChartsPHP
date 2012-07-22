<?php
/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
namespace AmCharts\Chart;

/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
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