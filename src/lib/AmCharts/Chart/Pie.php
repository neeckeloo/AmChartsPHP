<?php
/**
 * @category   AmCharts
 * @package    Chart
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting,
    AmCharts\Exception;

/**
 * @category   AmCharts
 * @package    Chart
 */
class Pie extends AbstractChart
{
    /**
     * @var string 
     */
    protected $type = 'pie';
    
    /**
     * @var string 
     */
    protected $titleField;
    
    /**
     * @var string 
     */
    protected $valueField;
    
    /**
     * The angle of the 3D part of plot area.
     * This creates a 3D effect (if the "depth3D" is > 0).
     * 
     * @var integer 
     */
    protected $angle;
    
    /**
     * @var string 
     */
    protected $balloonText = '[[title]]: [[percents]]% ([[value]])\n[[description]]'; 
    
    /**
     * The depth of the 3D part of plot area.
     * This creates a 3D effect (if the "angle" is > 0).
     * 
     * @var integer 
     */
    protected $depth3D;
    
    /**
     * @var integer 
     */
    protected $groupPercent;
    
    /**
     * @var string 
     */
    protected $labelText = '[[title]]: [[percents]]%';
    
    /**
     * @var Setting\Alpha 
     */
    protected $outlineAlpha;
    
    /**
     * @var Setting\Color 
     */
    protected $outlineColor;
    
    /**
     * @var integer 
     */
    protected $outlineThickness;
    
    /**
     * @var Setting\Color 
     */
    protected $pieBaseColor;
    
    /**
     * Sets Lightness increase of each subsequent slice.
     * This is only useful if pieBaseColor is set.
     * Use negative values for darker colors. Value range is from -255 to 255.
     * 
     * @var integer 
     */
    protected $pieBrightnessStep = 30;
    
    /**
     * @var array
     */
    protected $colors = array(
        '#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01', '#B0DE09',
        '#04D215', '#0D8ECF', '#0D52D1', '#2A0CD0', '#8A0CCF', '#CD0D74',
        '#754DEB', '#DDDDDD', '#999999', '#333333', '#000000', '#57032A',
        '#CA9726', '#990000', '#4B0C25'
    );
    
    /**
     * Sets title field
     * 
     * @param string $field
     * @return Pie
     */
    public function setTitleField($field)
    {
        $this->titleField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns title field
     * 
     * @return string 
     */
    public function getTitleField()
    {
        return $this->titleField;
    }
    
    /**
     * Sets value field
     * 
     * @param string $field
     * @return Pie
     */
    public function setValueField($field)
    {
        $this->valueField = (string) $field;
        
        return $this;
    }
    
    /**
     * Returns value field
     * 
     * @return string 
     */
    public function getValueField()
    {
        return $this->valueField;
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
     * Sets balloon text
     * 
     * @param string $text
     * @return Pie
     */
    public function setBalloonText($text)
    {
        $this->balloonText = (string) $text;
        
        return $this;
    }
    
    /**
     * Returns balloon text
     * 
     * @return string 
     */
    public function getBalloonText()
    {
        return $this->balloonText;
    }
    
    /**
     * Sets group percent
     * 
     * If there is more than one slice whose percentage of the pie is less than this number,
     * those slices will be grouped together into one slice.
     * This is the "other" slice. It will always be the last slice in a pie.
     * 
     * @param integer $value
     * @return Pie
     */
    public function setGroupPercent($value)
    {
        $this->groupPercent = (integer) $value;
        
        return $this;
    }
    
    /**
     * Returns group percent
     * 
     * @return integer 
     */
    public function getGroupPercent()
    {
        return $this->groupPercent;
    }
    
    /**
     * Sets label text
     * 
     * @param string $text
     * @return Pie
     */
    public function setLabelText($text)
    {
        $this->labelText = (string) $text;
        
        return $this;
    }
    
    /**
     * Returns label text
     * 
     * @return string 
     */
    public function getLabelText()
    {
        return $this->labelText;
    }
    
    /**
     * Sets outline alpha
     * 
     * @param integer $alpha 
     * @return AbstractAxis
     */
    public function setOutlineAlpha($alpha)
    {
        $this->outlineAlpha = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns outline alpha
     * 
     * @return integer 
     */
    public function getOutlineAlpha()
    {
        return $this->outlineAlpha->getOpacity();
    }
    
    /**
     * Sets outline color
     *
     * @param string|array|Color $color
     * @return AbstractAxis
     */
    public function setOutlineColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->outlineColor = $color;
            } else {
                $this->outlineColor = new Setting\Color($color);
            }
        }

        return $this;
    }
    
    /**
     * Returns outline color
     * 
     * @return string 
     */
    public function getOutlineColor()
    {
        return $this->outlineColor;
    }
    
    /**
     * Sets outline thickness
     * 
     * @param integer $thickness 
     * @return AbstractAxis
     */
    public function setOutlineThickness($thickness)
    {
        if ($thickness < 0) {
            throw new Exception\InvalidArgumentException('The thickness value must be positive.');
        }
        
        $this->outlineThickness = (int) $thickness;
        
        return $this;
    }
    
    /**
     * Returns outline thickness
     * 
     * @return integer 
     */
    public function getOutlineThickness()
    {
        return $this->outlineThickness;
    }
        
    /**
     * Sets and returns pie base color
     *
     * @param string|array|Setting\Color $color
     * @return Pie
     */
    public function pieBaseColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->pieBaseColor = $color;
            } else {
                $this->pieBaseColor = new Setting\Color($color);
            }
        }

        return $this->pieBaseColor;
    }
    
    /**
     * Sets pie brightness step
     * 
     * @param integer $step
     * @return Pie 
     */
    public function setPieBrightnessStep($step)
    {
        if (!($step >= -255 && $step <= 255)) {
            throw new Exception\InvalidArgumentException('The pie brightness step value must be between -255 and 255.');
        }
        
        $this->pieBrightnessStep = (int) $step;
        
        return $this;
    }
    
    /**
     * Returns pie brightness step
     * 
     * @return integer 
     */
    public function getPieBrightnessStep()
    {
        return $this->pieBrightnessStep;
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
            'titleField'        => $this->titleField,
            'valueField'        => $this->valueField,
            'angle'             => $this->angle,
            'depth3D'           => $this->depth3D,
            'balloonText'       => $this->balloonText,
            'groupPercent'      => $this->groupPercent,
            'labelText'         => $this->labelText,
            'outlineAlpha'      => $this->outlineAlpha->getValue(),
            'outlineColor'      => $this->outlineColor,
            'outlineThickness'  => $this->outlineThickness,
            'pieBaseColor'      => $this->pieBaseColor,
            'pieBrightnessStep' => $this->pieBrightnessStep
        );
        
        return $params;
    }
}