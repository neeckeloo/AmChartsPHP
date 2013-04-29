<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\DataProvider\DataProviderInterface;

class DataProvider implements DataProviderInterface
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
    public function __construct($data)
    {
        $this->setFromArray($data);
    }

    /**
     * Sets data from array
     *
     * @param array $data
     * @return DataProvider
     */
    public function setFromArray(array $data)
    {
        $this->data = $data;
    }

    /**
     * Returns data
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}