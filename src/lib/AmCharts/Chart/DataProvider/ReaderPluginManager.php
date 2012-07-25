<?php
/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
namespace AmCharts\Chart\DataProvider;

use AmCharts\Exception;

/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
class ReaderManager
{   
    /**
     * Default set of readers
     *
     * @var array
     */
    protected $invokableClasses = array(
        'json' => 'AmCharts\Chart\DataProvider\Reader\Json',
        'xml'  => 'AmCharts\Chart\DataProvider\Reader\Xml',
    );
    
    /**
     * Reader instances
     * 
     * @var array 
     */
    protected $instances = array();
    
    /**
     * Sets invokable class
     * 
     * @param string $name
     * @param string $invokableClass 
     * @return ReaderManager
     */
    public function setInvokableClass($name, $invokableClass)
    {
        if (!$this->has($name)) {
            $this->invokableClasses[$name] = $invokableClass;
        }
        
        return $this;
    }
    
    /**
     * Canonicalize name
     * 
     * @param string $name
     * @return string 
     */
    protected function canonicalizeName($name)
    {
        return strtolower(str_replace(array('-', '_', ' ', '\\', '/'), '', $name));
    }
    
    /**
     * Returns true if reader plugin manager has reader
     * 
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {
        $name = $this->canonicalizeName($name);
        if (isset($this->invokableClasses[$name])) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Retreive a reader instance
     * 
     * @param string $name
     * @return Reader\ReaderInterface
     */
    public function get($name)
    {
        if (!$this->has($name) && class_exists($name)) {
            $this->setInvokableClass($name, $name);
        }
        
        $name = $this->canonicalizeName($name);
        
        $instance = null;
        
        if (isset($this->instances[$name])) {
            $instance = $this->instances[$name];
        }
        
        if (!$instance) {
            $instance = new $this->invokableClasses[$name]();
        }
        
        $this->validateReader($instance);        
        
        return $instance;
    }
    
    /**
     * Validate reader
     * Checks that the reader loaded is an instance of Reader\ReaderInterface.
     * 
     * @param Reader\ReaderInterface $reader
     * @return void
     */
    protected function validateReader($reader)
    {
        if ($reader instanceof Reader\ReaderInterface) {
            return;
        }
        
        throw new Exception\RuntimeException(sprintf(
            'Reader of type "%s" is invalid; must implement %s\Reader\ReaderInterface',
            (is_object($reader) ? get_class($reader) : gettype($reader)),
            __NAMESPACE__
        ));        
    }
}