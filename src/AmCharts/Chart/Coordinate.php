<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Graph;
use AmCharts\Chart\Setting;
use AmCharts\Chart\Exception;

abstract class Coordinate extends AbstractChart
{
    /**
     * @var array
     */
    protected $colors = array(
        '#FF6600', '#FCD202', '#B0DE09', '#0D8ECF', '#2A0CD0', '#CD0D74',
        '#CC0000', '#00CC00', '#0000CC', '#DDDDDD', '#999999', '#333333', 
        '#990000'
    );
    
    /**
     * @var array 
     */
    protected $graphs = array();
    
    /**
     * Specifies whether the animation should de sequenced or all objects should appear at once.
     * 
     * @var boolean 
     */
    protected $sequencedAnimation;
    
    /**
     * The initial opacity of column/line.
     * 
     * If you set startDuration to a value higher than 0, the columns/lines will fade in from startAlpha.
     * 
     * @var Setting\Alpha 
     */
    protected $startAlpha;
    
    /**
     * Duration of the animation in seconds.
     * 
     * @var integer 
     */
    protected $startDuration;
    
    /**
     * Animation effect.
     * 
     * @var string 
     */
    protected $startEffect;
    
    /**
     * Target of url.
     * 
     * @var string 
     */
    protected $urlTarget;
    
    /**
     * Axis\Value
     */
    protected $valueAxis;
    
    /**
     * Constructor
     *
     * @param null|string $id
     */
    public function __construct($id = null)
    {
        parent::__construct($id);
        
        $this->startAlpha = new Setting\Alpha(100);
    }
    
    /**
     * Add graph
     * 
     * @param Graph\AbstractGraph $graph
     * @return Coordinate 
     */
    public function addGraph(Graph\AbstractGraph $graph)
    {
        $this->graphs[] = $graph;
        
        return $this;
    }
    
    /**
     * Sets true if animation is sequenced
     * 
     * @param boolean $sequenced
     * @return Coordinate 
     */
    public function setSequencedAnimation($sequenced = true)
    {
        $this->sequencedAnimation = (bool) $sequenced;
        
        return $this;
    }
    
    /**
     * Returns true if animation is sequenced
     * 
     * @return boolean 
     */
    public function isSequencedAnimation()
    {
        return $this->sequencedAnimation;
    }
    
    /**
     * Sets start alpha
     * 
     * @param integer $alpha
     * @return Coordinate
     */
    public function setStartAlpha($alpha)
    {
        $this->startAlpha = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns start alpha
     * 
     * @return integer 
     */
    public function getStartAlpha()
    {
        return $this->startAlpha->getOpacity();
    }
    
    /**
     * Sets start duration
     * 
     * @param integer $start
     * @return Coordinate
     */
    public function setStartDuration($duration)
    {
        $this->startDuration = (int) $duration;
        
        return $this;
    }
    
    /**
     * Returns start duration
     * 
     * @return integer 
     */
    public function getStartDuration()
    {
        return $this->startDuration;
    }
    
    /**
     * Sets start effect
     * 
     * @param integer $start
     * @return Coordinate
     */
    public function setStartEffect($effect)
    {
        if ($effect != Setting\Effect::ELASTIC && $effect != Setting\Effect::BOUNCE) {
            throw new Exception\InvalidArgumentException('The start effect provided is not valid.');
        }
        
        $this->startEffect = (string) $effect;
        
        return $this;
    }
    
    /**
     * Returns start effect
     * 
     * @return integer 
     */
    public function getStartEffect()
    {
        return $this->startEffect;
    }
    
    /**
     * Sets url target
     * 
     * @param string $target
     * @return Coordinate
     */
    public function setUrlTarget($target)
    {
        $this->urlTarget = (string) $target;
        
        return $this;
    }
    
    /**
     * Returns url target
     * 
     * @return string 
     */
    public function getUrlTarget()
    {
        return $this->urlTarget;
    }

    /**
     * Sets and returns value axis
     *
     * @return Axis\Value
     */
    public function valueAxis()
    {
        if (!isset($this->valueAxis)) {
            $this->valueAxis = new Axis\Value();
        }

        return $this->valueAxis;
    }
    
    /**
     * Returns params
     * 
     * @return array 
     */
    public function getParams()
    {
        $params = parent::getParams();
        
        $paramKeys = array(
            'colors', 'sequencedAnimation', 'startAlpha', 'startDuration', 'startEffect',
            'urlTarget'
        );
        foreach ($paramKeys as $key) {
            if (isset($this->{$key})) {
                if ($this->{$key} instanceof Setting\Alpha) {
                    $params[$key] = $this->{$key}->getValue();
                } else {
                    $params[$key] = $this->{$key};
                }
            }
        }
        
        return $params;
    }
}