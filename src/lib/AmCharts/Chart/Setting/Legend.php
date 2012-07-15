<?php
/**
 * @category   AmCharts
 */
namespace AmCharts\Chart\Setting;

/**
 * @category   AmCharts
 */
class Legend
{    
    /**
     * @var Text 
     */
    protected $text;
    
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
     * @return Legend
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
     * Sets and returns text object
     *
     * @param array $params
     * @return Text
     */
    public function text($params = array())
    {        
        if (!isset($this->text)) {
            $this->text = new Text();
        }
        
        $this->text->setParams($params);

        return $this->text;
    }
    
    /**
     * Returns legend as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $params = array();
        
        if (isset($this->text)) {
            $params = $params + $this->text->toArray();
        }
        
        return $params;
    }
}