<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider;

use AmCharts\Chart\Exception;
use Zend\ServiceManager\AbstractPluginManager;

class ReaderPluginManager extends AbstractPluginManager
{   
    /**
     * Default set of readers
     *
     * @var array
     */
    protected $invokableClasses = array(
        'json' => 'AmCharts\Chart\DataProvider\Reader\Json',
        'xml'  => 'AmCharts\Chart\DataProvider\Reader\Xml',
        'csv'  => 'AmCharts\Chart\DataProvider\Reader\Csv',
    );
    
    /**
     * Validate the plugin
     * Checks that the reader loaded is an instance of Reader\ReaderInterface.
     * 
     * @param Reader\ReaderInterface $plugin
     * @return void
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Reader\ReaderInterface) {
            return;
        }
        
        throw new Exception\RuntimeException(sprintf(
            'Reader of type "%s" is invalid; must implement %s\Reader\ReaderInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));        
    }
}