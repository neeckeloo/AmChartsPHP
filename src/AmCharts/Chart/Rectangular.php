<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Exception;

abstract class Rectangular extends Coordinate
{
    /**
     * Chart cursor
     * 
     * @var Cursor 
     */
    protected $cursor;
    
    /**
     * Chart scrollbar
     * 
     * @var Scrollbar 
     */
    protected $scrollbar;
    
    /**
     * The angle of the 3D part of plot area.
     * This creates a 3D effect (if the "depth3D" is > 0).
     * 
     * @var integer 
     */
    protected $angle;    
    
    /**
     * The depth of the 3D part of plot area.
     * This creates a 3D effect (if the "angle" is > 0).
     * 
     * @var integer 
     */
    protected $depth3D;

    /**
     * Chart margins
     *
     * @var Setting\Margin
     */
    protected $margin;
    
    /**
     * Sets and returns chart cursor 
     * 
     * @param array $params
     * @return Cursor 
     */
    public function cursor($params = array())
    {
        if (!isset($this->cursor)) {
            $this->cursor = new Cursor();
        }
        
        $this->cursor->setParams($params);

        return $this->cursor;
    }
    
    /**
     * Sets and returns chart scrollbar 
     * 
     * @param array $params
     * @return Scrollbar 
     */
    public function scrollbar($params = array())
    {
        if (!isset($this->scrollbar)) {
            $this->scrollbar = new Scrollbar();
        }
        
        $this->scrollbar->setParams($params);

        return $this->scrollbar;
    }
    
    /**
     * Sets 3D part of plot area
     * 
     * @param integer $angle
     * @param integer $depth
     * @return Rectangular 
     */
    public function set3D($angle, $depth)
    {
        if (!is_int($angle)) {
            throw new Exception\InvalidArgumentException("The angle value must be an integer.");
        }
        
        if (!($angle > -360 && $angle < 360)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '"%s" is not a valid angle.',
                $angle
            ));
        }
        
        $this->angle = (integer) $angle;
        $this->depth3D = (integer) $depth;
        
        return $this;
    }

    /**
     * Sets and returns chart margins
     *
     * @param null|array $margin
     * @return Setting\Margin
     */
    public function margin($margin = null)
    {
        if (!isset($this->margin)) {
            $this->margin = new Setting\Margin();
        }

        if (null !== $margin) {
            $this->margin->setValues($margin);
        }

        return $this->margin;
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
            'angle', 'depth3D',
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

        if (isset($this->cursor)) {
            $params += $this->cursor->toArray();
        }
        if (isset($this->margin)) {
            $params += $this->margin->toArray();
        }
        
        return $params;
    }
}