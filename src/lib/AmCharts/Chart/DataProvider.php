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
        $this->setData($data);
    }

    /**
     * Sets data
     *
     * @param array $data
     * @return DataProvider
     */
    public function setData(array $data)
    {
        $this->data = (array) $data;

        return $this;
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