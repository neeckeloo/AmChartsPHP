<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class DataProviderTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var DataProvider
     */
    protected $provider;
    
    public function setUp()
    {
        $this->provider = new DataProvider(array('foo' => 123, 'bar' => 456));
    }
    
    public function testGetData()
    {
        $this->assertTrue(is_array($this->provider->toArray()));
    }
}