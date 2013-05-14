<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts;

class Manager
{
    /**
     * @var string
     */
    protected $jQueryPath = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js';

    /**
     * @var string
     */
    protected $amChartsPath = 'http://www.amcharts.com/lib/amcharts.js';
    
    /**
     * @var string 
     */
    protected $imagesPath = 'http://www.amcharts.com/lib/images/';

    /**
     * @var boolean
     */
    protected $loadJQuery = false;

    /**
     * @var boolean
     */
    private $jsIncluded = false;

    /**
     * Singleton instance
     *
     * @var null|Manager
     */
    protected static $instance = null;

    /**
     * Constructor
     */
    protected function __construct()
    {
        
    }

    /**
     * Singleton instance
     *
     * @return Manager
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return void
     */
    public static function resetInstance()
    {
        self::$instance = null;
    }
    
    /**
     * Set jQuery path
     * 
     * @param string $path
     * @return Manager
     */
    public function setJQueryPath($path)
    {
        $this->jQueryPath = (string) $path;
        
        return $this;
    }
    
    /**
     * Returns jQuery path
     * 
     * @return string 
     */
    public function getJQueryPath()
    {
        return $this->jQueryPath;
    }
    
    /**
     * Set AmCharts Path
     * 
     * @param string $path
     * @return Manager
     */
    public function setAmChartsPath($path)
    {
        $this->amChartsPath = (string) $path;
        
        return $this;
    }
    
    /**
     * Returns AmCharts path
     * 
     * @return string
     */
    public function getAmChartsPath()
    {
        return $this->amChartsPath;
    }
    
    /**
     * Set images path
     * 
     * @param string $path
     * @return Manager
     */
    public function setImagesPath($path)
    {
        $this->imagesPath = (string) $path;
        
        return $this;
    }
    
    /**
     * Returns images path
     * 
     * @return string
     */
    public function getImagesPath()
    {
        return $this->imagesPath;
    }
    
    /**
     * Set true if jQuery library must be loaded
     * 
     * @param boolean $load
     * @return Manager
     */
    public function setLoadJQuery($load = false)
    {
        $this->loadJQuery = (bool) $load;
        
        return $this;
    }
    
    /**
     * Returns true if jQuery library must be loaded
     * 
     * @return boolean
     */
    public function isLoadingJQuery()
    {        
        return $this->loadJQuery;
    }
    
    /**
     * Set true if javascript library must be loaded
     * 
     * @param boolean $include
     * @return Manager
     */
    public function setJsIncluded($include = false)
    {
        $this->jsIncluded = (bool) $include;
        
        return $this;
    }
    
    /**
     * Returns true if javascript library must be loaded
     * 
     * @return boolean
     */
    public function hasIncludedJs()
    {        
        return $this->jsIncluded;
    }

    /**
     * Enforce singleton; disallow cloning
     *
     * @return void
     */
    private function __clone()
    {
        
    }
}