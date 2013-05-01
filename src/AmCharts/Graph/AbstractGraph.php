<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Graph;

use AmCharts\Chart\Setting;
use AmCharts\Graph\Exception;
use AmCharts\Utils;

abstract class AbstractGraph implements GraphInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var Bullet
     */
    protected $bullet;

    /**
     * @var Fields
     */
    protected $fields;

    /**
     * @var string
     */
    protected $balloonText = '[[value]]';

    /**
     * Opacity of fill. Plural form is used to keep the same property names as our Flex charts'.
     * Flex charts can accept array of numbers to generate gradients.
     * Although you can set array here, only first value of this array will be used.
     *
     * @var Setting\Alpha
     */
    protected $fillAlphas;

    /**
     * Fill color. Will use lineColor if not set.
     *
     * @var array
     */
    protected $fillColors;

    /**
     * @var Setting\Alpha
     */
    protected $lineAlpha;

    /**
     * @var Setting\Color
     */
    protected $lineColor;

    /**
     * @var integer
     */
    protected $lineThickness;

    /**
     * Sets type
     *
     * @param string $type
     * @return AbstractGraph
     */
    public function setType($type)
    {
        $this->type = (string) $type;

        return $this;
    }

    /**
     * Returns type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets id
     *
     * @param string $id
     * @return AbstractGraph
     */
    public function setId($id)
    {
        $this->id = (string) $id;

        return $this;
    }

    /**
     * Returns id
     * 
     * @return string
     */
    public function getId()
    {
        if (!isset($this->id)) {
            $this->generateId();
        }

        return $this->id;
    }

    /**
     * Generate id
     */
    protected function generateId()
    {
        $id = 'graph_' . Utils::generateRandomKey();
        $this->setId($id);
    }

    /**
     * Sets title
     *
     * @param string $title
     * @return AbstractGraph
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;

        return $this;
    }

    /**
     * Returns title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets and returns bullet
     *
     * @return Bullet
     */
    public function bullet()
    {
        if (!isset($this->bullet)) {
            $this->bullet = new Bullet();
        }

        return $this->bullet;
    }

    /**
     * Sets and returns fields
     *
     * @param array $fields
     * @return Fields
     */
    public function fields($fields = array())
    {
        if (!isset($this->fields)) {
            $this->fields = new Fields();
        }

        $this->fields->setFields($fields);

        return $this->fields;
    }

    /**
     * Sets balloon text
     *
     * @param string $text
     * @return AbstractGraph
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
     * Sets fill alphas
     *
     * @param integer $alpha
     * @return AbstractGraph
     */
    public function setFillAlphas($alpha)
    {
        $this->fillAlphas = new Setting\Alpha($alpha);

        return $this;
    }

    /**
     * Returns fill alphas
     *
     * @return integer
     */
    public function getFillAlphas()
    {
        return $this->fillAlphas->getOpacity();
    }

    /**
     * Sets fill colors
     *
     * @param array|string|Setting\Color $colors
     * @return AbstractGraph
     */
    public function setFillColors($colors)
    {
        if (!is_array($colors)) {
            $colors = array($colors);
            $this->setFillColors($colors);
        }

        $this->fillColors = array();
        foreach ($colors as $color) {
            if (!($color instanceof Setting\Color)) {
                $color = new Setting\Color($color);
            }

            $this->fillColors[] = $color;
        }

        return $this;
    }

    /**
     * Returns fill colors
     *
     * @return integer
     */
    public function getFillColors()
    {
        return $this->fillColors;
    }

    /**
     * Sets line alpha
     *
     * @param integer $alpha
     * @return AbstractGraph
     */
    public function setLineAlpha($alpha)
    {
        $this->lineAlpha = new Setting\Alpha($alpha);

        return $this;
    }

    /**
     * Returns line alpha
     *
     * @return integer
     */
    public function getLineAlpha()
    {
        return $this->lineAlpha->getOpacity();
    }

    /**
     * Sets line color
     *
     * @param null|string|array|Color $color
     * @return AbstractGraph
     */
    public function setLineColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->lineColor = $color;
            } else {
                $this->lineColor = new Setting\Color($color);
            }
        }

        return $this;
    }

    /**
     * Returns line color
     *
     * @return string
     */
    public function getLineColor()
    {
        return $this->lineColor;
    }

    /**
     * Sets line thickness
     *
     * @param integer $thickness
     * @return AbstractGraph
     */
    public function setLineThickness($thickness)
    {
        if ($thickness < 0) {
            throw new Exception\InvalidArgumentException('The thickness value must be positive.');
        }

        $this->lineThickness = (int) $thickness;

        return $this;
    }

    /**
     * Returns line thickness
     *
     * @return integer
     */
    public function getLineThickness()
    {
        return $this->lineThickness;
    }

    /**
     * Returns object properties as array
     *
     * @return array
     */
    public function toArray()
    {
        $options = array();

        $properties = array_keys(get_object_vars($this));
        foreach ($properties as $name) {
            if (isset($this->{$name})) {
                if ($this->{$name} instanceof Setting\Alpha) {
                    $options[$name] = $this->{$name}->getValue();
                } elseif (!is_object($this->{$name})) {
                    $options[$name] = $this->{$name};
                }
            }
        }

        $options += $this->fields()->toArray();

        $bulletOptions = $this->bullet()->toArray();
        if (isset($bulletOptions['bulletType'])) {
            $bulletOptions['bullet'] = $bulletOptions['bulletType'];
            unset($bulletOptions['bulletType']);
        }
        $options += $bulletOptions;

        return $options;
    }

    public function __clone()
    {
        $this->generateId();
    }
}