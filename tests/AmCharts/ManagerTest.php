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
     * @var Manager 
     */
    protected $manager;
    
    public function setUp()
    {
        Manager::resetInstance();
        $this->manager = Manager::getInstance();
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
        $this->assertFalse($this->manager->isLoadingJQuery());
        
        $this->manager->setLoadJQuery(true);
        $this->assertTrue($this->manager->isLoadingJQuery());
        
        $this->manager->setLoadJQuery(false);
        $this->assertFalse($this->manager->isLoadingJQuery());
    }
    
    public function testSetJsIncluded()
    {
        $this->assertFalse($this->manager->hasIncludedJs());
        
        $this->manager->setJsIncluded(true);
        $this->assertTrue($this->manager->hasIncludedJs());
        
        $this->manager->setJsIncluded(false);
        $this->assertFalse($this->manager->hasIncludedJs());
    }
}