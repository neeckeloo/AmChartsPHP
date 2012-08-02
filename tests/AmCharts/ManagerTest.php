<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AmCharts\Manager 
     */
    protected $manager;
    
    public function setUp()
    {
        $this->manager = Manager::getInstance();
        $this->manager->setJsIncluded(false)
            ->setLoadJQuery(false);
    }
    
    public function testSetJQueryPath()
    {
        $path = './js/jquery.js';
        $this->manager->setJQueryPath($path);
        $this->assertEquals($path, $this->manager->getJQueryPath());
    }
    
    public function testSetAmChartsPath()
    {
        $path = './js/amcharts.js';
        $this->manager->setAmChartsPath($path);
        $this->assertEquals($path, $this->manager->getAmChartsPath());
    }
    
    public function testSetImagesPath()
    {
        $path = './images';
        $this->manager->setImagesPath($path);
        $this->assertEquals($path, $this->manager->getImagesPath());
    }
    
    public function testSetLoadJQuery()
    {
        $this->assertEquals(false, $this->manager->isLoadingJQuery());
        
        $bool = true;
        $this->manager->setLoadJQuery($bool);
        $this->assertEquals($bool, $this->manager->isLoadingJQuery());
        
        $bool = false;
        $this->manager->setLoadJQuery($bool);
        $this->assertEquals($bool, $this->manager->isLoadingJQuery());
    }
    
    public function testSetJsIncluded()
    {
        $this->assertEquals(false, $this->manager->hasIncludedJs());
        
        $bool = true;
        $this->manager->setJsIncluded($bool);
        $this->assertEquals($bool, $this->manager->hasIncludedJs());
        
        $bool = false;
        $this->manager->setJsIncluded($bool);
        $this->assertEquals($bool, $this->manager->hasIncludedJs());
    }
}