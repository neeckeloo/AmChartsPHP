<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Exception;

abstract class Rectangular extends Coordinate
{
    /**
     * Specifies if margins of a chart should be calculated automatically so that labels of axes would fit.
     * The chart will adjust only margins with axes. Other margins will use values set with margin properties.
     *
     * @var boolean
     */
    protected $autoMargins = true;

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
     * Number of pixels between the container's top border and plot area.
     * This space can be used for top axis' values.
     * If autoMargin is true and top side has axis, this property is ignored.
     * 
     * @var integer 
     */
    protected $marginTop;
    
    /**
     * Number of pixels between the container's bottom border and plot area.
     * This space can be used for bottom axis' values.
     * If autoMargin is true and bottom side has axis, this property is ignored.
     * 
     * @var integer 
     */
    protected $marginBottom;
    
    /**
     * Number of pixels between the container's left border and plot area.
     * This space can be used for left axis' values.
     * If autoMargin is true and left side has axis, this property is ignored.
     * 
     * @var integer 
     */
    protected $marginLeft;
    
    /**
     * Number of pixels between the container's right border and plot area.
     * This space can be used for Right axis' values.
     * If autoMargin is true and right side has axis, this property is ignored.
     * 
     * @var integer 
     */
    protected $marginRight;

    /**
     * Sets auto margins
     *
     * @param boolean $auto
     * @return Rectangular
     */
    public function setAutoMargins($auto = true)
    {
        $this->autoMargins = (bool) $auto;

        return $this;
    }

    /**
     * Returns auto margins
     *
     * @return boolean
     */
    public function getAutoMargins()
    {
        return $this->autoMargins;
    }
    
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
            throw new Exception\InvalidArgumentException("'$angle' is not a valid angle.");
        }
        
        $this->angle = (integer) $angle;
        $this->depth3D = (integer) $depth;
        
        return $this;
    }
    
    /**
     * Sets margin top
     * 
     * @param integer $margin
     * @return Rectangular 
     */
    public function setMarginTop($margin)
    {
        $this->marginTop = (int) $margin;
        
        return $this;
    }
    
    /**
     * Returns margin top
     * 
     * @return integer 
     */
    public function getMarginTop()
    {
        return $this->marginTop;
    }
    
    /**
     * Sets margin bottom
     * 
     * @param integer $margin
     * @return Rectangular 
     */
    public function setMarginBottom($margin)
    {
        $this->marginBottom = (int) $margin;
        
        return $this;
    }
    
    /**
     * Returns margin bottom
     * 
     * @return integer 
     */
    public function getMarginBottom()
    {
        return $this->marginBottom;
    }
    
    /**
     * Sets margin left
     * 
     * @param integer $margin
     * @return Rectangular 
     */
    public function setMarginLeft($margin)
    {
        $this->marginLeft = (int) $margin;
        
        return $this;
    }
    
    /**
     * Returns margin left
     * 
     * @return integer 
     */
    public function getMarginLeft()
    {
        return $this->marginLeft;
    }
    
    /**
     * Sets margin right
     * 
     * @param integer $margin
     * @return Rectangular 
     */
    public function setMarginRight($margin)
    {
        $this->marginRight = (int) $margin;
        
        return $this;
    }
    
    /**
     * Returns margin right
     * 
     * @return integer 
     */
    public function getMarginRight()
    {
        return $this->marginRight;
    }
    
    /**
     * Sets margin
     * 
     * @param array $margin
     * @return Rectangular 
     */
    public function setMargin($margin)
    {
        if (!is_array($margin)) {
            throw new Exception\InvalidArgumentException(
                'The margin parameter must be an array.'
            );
        }
        if (count($margin) != 4) {
            throw new Exception\InvalidArgumentException(
                'The margin parameter must contains top, bottom, left and right margin.'
            );
        }
        
        $this->setMarginTop($margin[0])
            ->setMarginBottom($margin[1])
            ->setMarginLeft($margin[2])
            ->setMarginRight($margin[3]);

        $this->setAutoMargins(false);
        
        return $this;
    }
    
    /**
     * Returns params
     * 
     * @return array 
     */
    protected function getParams()
    {
        $params = parent::getParams();
        
        $paramKeys = array(
            'angle', 'depth3D', 'marginTop', 'marginBottom', 'marginLeft',
            'marginRight', 'autoMargins',
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