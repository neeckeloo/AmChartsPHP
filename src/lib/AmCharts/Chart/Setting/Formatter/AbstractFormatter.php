<?php
/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage Setting
 */
namespace AmCharts\Chart\Setting\Formatter;

/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage Setting
 */
class AbstractFormatter
{   
    /**
     * @var integer 
     */
    protected $precision = 0;
    
    /**
     * @var string 
     */
    protected $decimalSeparator = '.';
    
    /**
     * @var string 
     */
    protected $thousandsSeparator = ',';
    
    /**
     * Constructor
     * 
     * @param array $params 
     */
    public function __construct($params = array())
    {
        $this->setParams($params);
    }
    
    /**
     * Sets legend parameters
     * 
     * @param array $params
     * @return AbstractFormatter
     */
    public function setParams(array $params = array())
    {
        foreach ($params as $name => $value) {
            $method = 'set' . ucfirst($name);
            if (!method_exists($this, $method)) {
                continue;
            }
            
            call_user_func_array(array($this, $method), array($value));
        }
        
        return $this;
    }
    
    /**
     * Sets precision
     * 
     * @param string $precision
     * @return AbstractFormatter 
     */
    public function setPrecision($precision)
    {
        $this->precision = (integer) $precision;
    }
    
    /**
     * Returns precision
     * 
     * @return string 
     */
    public function getPrecision()
    {
        return $this->precision;
    }
    
    /**
     * Sets decimal separator
     * 
     * @param string $separator
     * @return AbstractFormatter 
     */
    public function setDecimalSeparator($separator)
    {
        $this->decimalSeparator = (string) $separator;
        
        return $this;
    }
    
    /**
     * Returns decimal separator
     * 
     * @return string 
     */
    public function getDecimalSeparator()
    {
        return $this->decimalSeparator;
    }
    
    /**
     * Sets thousands separator
     * 
     * @param string $separator
     * @return AbstractFormatter 
     */
    public function setThousandsSeparator($separator)
    {
        $this->thousandsSeparator = (string) $separator;
        
        return $this;
    }
    
    /**
     * Returns thousands separator
     * 
     * @return string 
     */
    public function getThousandsSeparator()
    {
        return $this->thousandsSeparator;
    }
    
    /**
     * Returns formatter as array
     * 
     * @return array 
     */
    public function toArray()
    {
        return array(
            'precision' => $this->precision,
            'decimalSeparator' => $this->decimalSeparator,
            'thousandsSeparator' => $this->thousandsSeparator
        );
    }
}