<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting;
use AmCharts\Chart\Exception;

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
     * Title of the group slice.
     *
     * @var string
     */
    protected $groupedTitle;
    
    /**
     * @var integer 
     */
    protected $groupPercent;
    
    /**
     * Inner radius of the pie, in pixels or percents.
     * 
     * @var integer 
     */
    protected $innerRadius;
    
    /**
     * The distance between the label and the slice, in pixels.
     * 
     * You can use negative valeus to put the label on the slice.
     * 
     * @var integer 
     */
    protected $labelRadius;
    
    /**
     * @var string 
     */
    protected $labelText = '[[title]]: [[percents]]%';

    /**
     * Chart margins
     *
     * @var Setting\Margin
     */
    protected $margin;
    
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
     * Pull out duration, in seconds.
     *
     * @var integer
     */
    protected $pullOutDuration;

    /**
     * Pull out effect. Possible are "elastic" and "bounce".
     *
     * @var string
     */
    protected $pullOutEffect;

    /**
     * Pull out radius, in pixels or percents.
     *
     * @var string|integer
     */
    protected $pullOutRadius;
    
    /**
     * Specifies whether the animation should de sequenced or all objects should appear at once.
     * 
     * @var boolean 
     */
    protected $sequencedAnimation;
    
    /**
     * Initial opacity of all slices.
     * 
     * If you set startDuration to a value higher than 0, slices will fade in from startAlpha.
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
     * @var array
     */
    protected $colors = array(
        '#FF0F00', '#FF6600', '#FF9E01', '#FCD202', '#F8FF01', '#B0DE09',
        '#04D215', '#0D8ECF', '#0D52D1', '#2A0CD0', '#8A0CCF', '#CD0D74',
        '#754DEB', '#DDDDDD', '#999999', '#333333', '#000000', '#57032A',
        '#CA9726', '#990000', '#4B0C25'
    );
    
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
     * @return Pie
     */
    public function set3D($angle, $depth)
    {
        if (!is_int($angle)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'The angle value must be an integer; Received %s.',
                $angle
            ));
        }
        
        if (!($angle > -360 && $angle < 360)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'The angle must be between -360 and 360; Received %s.',
                $angle
            ));
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
     * Sets title of the group slice.
     *
     * @param string $title
     * @return Pie
     */
    public function setGroupedTitle($title)
    {
        $this->groupedTitle = (string) $title;
        
        return $this;
    }

    /**
     * Returns title of the group slice.
     *
     * @return string
     */
    public function getGroupedTitle()
    {
        return $this->groupedTitle;
    }
    
    /**
     * Sets group percent
     * 
     * If there is more than one slice whose percentage of the pie is less than this number,
     * those slices will be grouped together into one slice.
     * This is the "other" slice. It will always be the last slice in a pie.
     * 
     * @param integer $percent
     * @return Pie
     */
    public function setGroupPercent($percent)
    {
        $this->groupPercent = (integer) $percent;
        
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
     * Sets inner radius
     * 
     * @param integer $radius
     * @return Pie
     */
    public function setInnerRadius($radius)
    {
        if (is_numeric($radius)) {
            $radius .= 'px';
        } elseif (!preg_match('/([\d].*)(px|\%)/', $radius)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected integer or value suffixed by pixel or percent unit; Received %s.',
                $radius
            ));
        }

        $this->innerRadius = (int) $radius;
        
        return $this;
    }
    
    /**
     * Returns inner radius
     * 
     * @return integer 
     */
    public function getInnerRadius()
    {
        return $this->innerRadius;
    }
    
    /**
     * Sets label radius
     * 
     * @param integer $radius
     * @return Pie
     */
    public function setLabelRadius($radius)
    {
        $this->labelRadius = (int) $radius;
        
        return $this;
    }
    
    /**
     * Returns inner radius
     * 
     * @return integer 
     */
    public function getLabelRadius()
    {
        return $this->labelRadius;
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
     * @param null|string|array|Color $color
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
            throw new Exception\InvalidArgumentException(sprintf(
                'The thickness value must be positive; Received %s.',
                $thickness
            ));
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
     * @param null|string|array|Setting\Color $color
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
            throw new Exception\InvalidArgumentException(sprintf(
                'The pie brightness step value must be between -255 and 255; Received %s.',
                $step
            ));
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
     * Sets pull out duration
     * 
     * @param integer $duration
     * @return Pie
     */
    public function setPullOutDuration($duration)
    {
        $this->pullOutDuration = (int) $duration;

        return $this;
    }

    /**
     * Returns pull out duration
     *
     * @return integer
     */
    public function getPullOutDuration()
    {
        return $this->pullOutDuration;
    }

    /**
     * Sets pull out effect
     *
     * @param integer $start
     * @return Coordinate
     */
    public function setPullOutEffect($effect)
    {
        if ($effect != Setting\Effect::ELASTIC && $effect != Setting\Effect::BOUNCE) {
            throw new Exception\InvalidArgumentException(sprintf(
                'The pull out effect provided is not valid; Received %s.',
                $effect
            ));
        }

        $this->pullOutEffect = (string) $effect;

        return $this;
    }

    /**
     * Returns pull out effect
     *
     * @return integer
     */
    public function getPullOutEffect()
    {
        return $this->pullOutEffect;
    }

    /**
     * Sets pull out radius radius
     *
     * @param integer $radius
     * @return Pie
     */
    public function setPullOutRadius($radius)
    {
        if (is_numeric($radius)) {
            $radius .= 'px';
        } elseif (!preg_match('/([\d].*)(px|\%)/', $radius)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected integer or value suffixed by pixel or percent unit; Received %s.',
                $radius
            ));
        }

        $this->pullOutRadius = (int) $radius;

        return $this;
    }

    /**
     * Returns pull out radius
     *
     * @return integer
     */
    public function getPullOutRadius()
    {
        return $this->pullOutRadius;
    }
    
    /**
     * Sets true if animation is sequenced
     * 
     * @param boolean $sequenced
     * @return Pie 
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
     * @return Pie
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
     * @return Pie
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
     * @return Pie
     */
    public function setStartEffect($effect)
    {
        if ($effect != Setting\Effect::ELASTIC && $effect != Setting\Effect::BOUNCE) {
            throw new Exception\InvalidArgumentException(sprintf(
                'The start effect provided is not valid; Received %s.',
                $effect
            ));
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
     * @return Pie
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
     * Returns params
     * 
     * @return array 
     */
    public function getParams()
    {
        $params = parent::getParams();
        
        $paramKeys = array(
            'titleField', 'valueField', 'angle', 'depth3D', 'balloonText', 'groupedTitle', 'groupPercent',
            'innerRadius', 'labelRadius', 'labelText', 'outlineColor', 'outlineThickness', 'pieBaseColor',
            'pieBrightnessStep', 'pullOutDuration', 'pullOutEffect', 'pullOutRadius', 'sequencedAnimation',
            'startDuration', 'startEffect', 'urlTarget',
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

        if (isset($this->margin)) {
            $params += $this->margin->toArray();
        }
        
        return $params;
    }
}