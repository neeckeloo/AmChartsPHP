<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Exception;

class Cursor
{
    const POSITION_START = 'start';
    const POSITION_MIDDLE = 'middle';
    const POSITION_MOUSE = 'mouse';
    
    /**
     * Specifies if bullet for each graph will follow the cursor.
     * 
     * @var boolean 
     */
    protected $bulletsEnabled;
    
    /**
     * Size of bullets, following the cursor.
     * 
     * @var integer 
     */
    protected $bulletSize;
    
    /**
     * Opacity of the category balloon.
     * 
     * @var Setting\Alpha 
     */
    protected $categoryBalloonAlpha;
    
    /**
     * Color of the category balloon. cursorColor is used if not set.
     * 
     * @var Setting\Color 
     */
    protected $categoryBalloonColor;
    
    /**
     * Category balloon date format (used only if category axis parses dates).
     * Check this page to see what strings you can use for date formatting.
     * 
     * Default : MMM DD, YYYY
     * 
     * @var string 
     */
    protected $categoryBalloonDateFormat;
    
    /**
     * Specifies whether category balloon is enabled.
     * 
     * @var boolean 
     */
    protected $categoryBalloonEnabled;
    
    /**
     * Opacity of the cursor line.
     * 
     * @var Setting\Alpha 
     */
    protected $cursorAlpha;
    
    /**
     * Color of the cursor line.
     * 
     * @var Setting\Color 
     */
    protected $cursorColor;
    
    /**
     * Specifies where the cursor line should be placed.
     * On the beginning of the period (day, hour, etc) or in the middle.
     * If you want the cursor to follow mouse and not to glue to the nearest data point, set "mouse" here.
     * 
     * Possible values are: "start", "middle", "mouse".
     * 
     * @var string 
     */
    protected $cursorPosition;
    
    /**
     * If this is set to true, only one balloon at a time will be displayed.
     * 
     * @var boolean 
     */
    protected $oneBalloonOnly;
    
    /**
     * If this is set to true, the user will be able to pan the chart (serial only) instead of zooming.
     * 
     * @var boolean 
     */
    protected $pan;
    
    /**
     * @var Setting\Text
     */
    protected $text;
    
    /**
     * Specifies whether value balloons are enabled.
     * 
     * @var boolean 
     */
    protected $valueBalloonsEnabled;
    
    /**
     * Specifies if the user can zoom-in the chart.
     * If pan is set to true, zoomable is switched to false automatically.
     * 
     * @var boolean 
     */
    protected $zoomable;
    
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
     * Sets true if bullets are enabled
     * 
     * @param boolean $enabled
     * @return Cursor 
     */
    public function setBulletsEnabled($enabled = true)
    {
        $this->bulletsEnabled = (bool) $enabled;
        
        return $this;
    }
    
    /**
     * Returns true if bullets are enabled
     * 
     * @return boolean 
     */
    public function isBulletsEnabled()
    {
        return $this->bulletsEnabled;
    }
    
    /**
     * Sets bullet size
     * 
     * @param integer $size
     * @return Cursor 
     */
    public function setBulletSize($size)
    {
        $this->bulletSize = (int) $size;
        
        return $this;
    }
    
    /**
     * Returns bullet size
     * 
     * @return integer 
     */
    public function getBulletSize()
    {
        return $this->bulletSize;
    }
    
    /**
     * Sets category balloon alpha
     * 
     * @param integer $alpha 
     * @return Cursor
     */
    public function setCategoryBalloonAlpha($alpha)
    {
        $this->categoryBalloonAlpha = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns category balloon alpha
     * 
     * @return integer 
     */
    public function getCategoryBalloonAlpha()
    {
        return $this->categoryBalloonAlpha->getOpacity();
    }
    
    /**
     * Sets category balloon color
     *
     * @param null|string|array|Setting\Color $color
     * @return Cursor
     */
    public function setCategoryBalloonColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->categoryBalloonColor = $color;
            } else {
                $this->categoryBalloonColor = new Setting\Color($color);
            }
        }

        return $this;
    }
    
    /**
     * Returns category balloon color
     * 
     * @return string 
     */
    public function getCategoryBalloonColor()
    {
        return $this->categoryBalloonColor;
    }
    
    /**
     * Sets category balloon date format
     * 
     * @param string $size
     * @return Cursor 
     */
    public function setCategoryBalloonDateFormat($size)
    {
        $this->categoryBalloonDateFormat = (string) $size;
        
        return $this;
    }
    
    /**
     * Returns category balloon date format
     * 
     * @return string 
     */
    public function getCategoryBalloonDateFormat()
    {
        return $this->categoryBalloonDateFormat;
    }
    
    /**
     * Sets true if category balloon is enabled
     * 
     * @param boolean $enabled
     * @return Cursor 
     */
    public function setCategoryBalloonEnabled($enabled = true)
    {
        $this->categoryBalloonEnabled = (bool) $enabled;
        
        return $this;
    }
    
    /**
     * Returns true if category balloon are enabled
     * 
     * @return boolean 
     */
    public function isCategoryBalloonEnabled()
    {
        return $this->categoryBalloonEnabled;
    }
        
    /**
     * Sets and returns text object
     *
     * @param array $params
     * @return Setting\Text
     */
    public function text($params = array())
    {        
        if (!isset($this->text)) {
            $this->text = new Setting\Text();
        }
        
        $this->text->setParams($params);

        return $this->text;
    }
    
    /**
     * Sets cursor alpha
     * 
     * @param integer $alpha 
     * @return Cursor
     */
    public function setCursorAlpha($alpha)
    {
        $this->cursorAlpha = new Setting\Alpha($alpha);
        
        return $this;
    }
    
    /**
     * Returns cursor alpha
     * 
     * @return integer 
     */
    public function getCursorAlpha()
    {
        return $this->cursorAlpha->getOpacity();
    }
    
    /**
     * Sets cursor color
     *
     * @param null|string|array|Setting\Color $color
     * @return Cursor
     */
    public function setCursorColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->cursorColor = $color;
            } else {
                $this->cursorColor = new Setting\Color($color);
            }
        }

        return $this;
    }
    
    /**
     * Returns cursor color
     * 
     * @return string 
     */
    public function getCursorColor()
    {
        return $this->cursorColor;
    }
    
    /**
     * Sets cursor position
     * 
     * @param string $position
     * @return Cursor 
     */
    public function setCursorPosition($position)
    {
        if (
            $position != self::POSITION_START
            && $position != self::POSITION_MIDDLE
            && $position != self::POSITION_MOUSE
        ) {
            throw new Exception\InvalidArgumentException('The cursor position provided is invalid.');
        }
        
        $this->cursorPosition = (string) $position;
        
        return $this;
    }
    
    /**
     * Returns cursor position
     * 
     * @return string 
     */
    public function getCursorPosition()
    {
        return $this->cursorPosition;
    }
    
    /**
     * Sets true if has one balloon only
     * 
     * @param boolean $value
     * @return Cursor 
     */
    public function setOneBalloonOnly($value = false)
    {
        $this->oneBalloonOnly = (bool) $value;
        
        return $this;
    }
    
    /**
     * Returns true if has one balloon only
     * 
     * @return boolean 
     */
    public function hasOneBalloonOnly()
    {
        return $this->oneBalloonOnly;
    }
    
    /**
     * Sets true if pan is enabled
     * 
     * @param boolean $enabled
     * @return Cursor 
     */
    public function setPanEnabled($enabled = true)
    {
        $this->pan = (bool) $enabled;
        
        return $this;
    }
    
    /**
     * Returns true if pan is enabled
     * 
     * @return boolean 
     */
    public function isPanEnabled()
    {
        return $this->pan;
    }
    
    /**
     * Sets true if value balloon is enabled
     * 
     * @param boolean $enabled
     * @return Cursor 
     */
    public function setValueBalloonEnabled($enabled = true)
    {
        $this->valueBalloonsEnabled = (bool) $enabled;
        
        return $this;
    }
    
    /**
     * Returns true if value balloon is enabled
     * 
     * @return boolean 
     */
    public function isValueBalloonEnabled()
    {
        return $this->valueBalloonsEnabled;
    }
    
    /**
     * Sets true if chart is zoomable
     * 
     * @param boolean $enabled
     * @return Cursor 
     */
    public function setZoomable($enabled = true)
    {
        $this->zoomable = (bool) $enabled;
        
        return $this;
    }
    
    /**
     * Returns true if chart is zoomable
     * 
     * @return boolean 
     */
    public function isZoomable()
    {
        return $this->zoomable;
    }
    
    /**
     * Sets cursor parameters
     * 
     * @param array $params
     * @return Cursor
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
     * Returns object properties as array
     * 
     * @return array 
     */
    public function toArray()
    {
        $options = array();
        
        $fields = array_keys(get_object_vars($this));
        foreach ($fields as $field) {
            if (isset($this->{$field})) {
                if ($this->{$field} instanceof Setting\Alpha) {
                    $options[$field] = $this->{$field}->getValue();
                } elseif ($this->{$field} instanceof Setting\Text) {
                    $color = $this->{$field}->getColor();
                    if ($color) {
                        $options['color'] = $color->toString();
                    }
                } else {
                    $options[$field] = $this->{$field};
                }
            }
        }
        
        return $options;
    }
}