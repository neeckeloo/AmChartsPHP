<?php
/**
 * @category   AmCharts
 * @package    Chart
 */
namespace AmCharts\Chart;

use AmCharts\Exception;

/**
 * @category   AmCharts
 * @package    Chart
 */
abstract class Rectangular extends Coordinate
{
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
    public function setMargin(array $margin)
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
        
        $params = $params + array(
            'angle'         => $this->angle,
            'depth3D'       => $this->depth3D,
            'marginTop'     => $this->marginTop,
            'marginBottom'  => $this->marginBottom,
            'marginLeft'    => $this->marginLeft,
            'marginRight'   => $this->marginRight
        );
        
        return $params;
    }
}