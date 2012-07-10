<?php
/**
 * @category   AmCharts
 */
namespace AmCharts;

/**
 * @category   AmCharts
 */
class Manager
{
    /**
     * @var string
     */
    protected $jQueryPath = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js';

    /**
     * @var string
     */
    protected $amChartsPath = 'amcharts.js';

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
     * @var AmCharts\Manager
     */
    protected static $instance = null;

    /**
     * Constructor
     *
     * @return void
     */
    protected function __construct()
    {
        
    }

    /**
     * Singleton instance
     *
     * @return AmCharts\Manager
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    /**
     * Set jQuery path
     * 
     * @param string $path
     * @return AmCharts\Manager
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
     * @return AmCharts\Manager
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
     * Set true if jQuery library must be loaded
     * 
     * @param boolean $load
     * @return AmCharts\Manager
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
     * @return AmCharts\Manager
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