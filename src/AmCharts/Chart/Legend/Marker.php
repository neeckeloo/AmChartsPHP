<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Legend;

use AmCharts\Chart\Setting\Border;
use AmCharts\Chart\Setting\Color;
use AmCharts\Chart\Exception;

class Marker
{
    const SQUARE = 'square';
    const CIRCLE = 'circle';
    const LINE = 'line';
    const DASHED_LINE = 'dashedLine';
    const TRIANGLE_UP = 'triangleUp';
    const TRIANGLE_DOWN = 'triangleDown';
    const BUBBLE = 'bubble';
    const NONE = 'none';

    /**
     * @var Border
     */
    protected $border;

    /**
     * The color of the disabled marker
     *
     * @var Color
     */
    protected $disabledColor;

    /**
     * Space between legend marker and legend text, in pixels.
     *
     * @var integer
     */
    protected $labelGap;

    /**
     * Size of the legend marker.
     *
     * @var integer
     */
    protected $size;

    /**
     * Shape of the legend marker.
     *
     * @var string
     */
    protected $type;

    /**
     * Valid types of legend marker
     *
     * @var array
     */
    protected $validTypes = array(
        self::BUBBLE, self::CIRCLE, self::DASHED_LINE, self::LINE, self::NONE,
        self::SQUARE, self::TRIANGLE_DOWN, self::TRIANGLE_UP
    );


    /**
     * Sets and returns border
     *
     * @param null|array $border
     * @return Border
     */
    public function border($border = null)
    {
        if (!isset($this->border)) {
            $this->border = new Border();
        }

        if (null !== $border) {
            $this->border->setParams($border);
        }

        return $this->border;
    }

    /**
     * Sets and returns disabled color
     *
     * @param null|string|array|Color $color
     * @return Color
     */
    public function disabledColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->disabledColor = $color;
            } else {
                $this->disabledColor = new Color($color);
            }
        }

        return $this->disabledColor;
    }

    /**
     * Sets label gap
     *
     * @param integer $labelGap
     * @return Marker
     */
    public function setLabelGap($labelGap)
    {
        $this->labelGap = (integer) $labelGap;

        return $this;
    }

    /**
     * Returns label gap
     *
     * @return integer
     */
    public function getLabelGap()
    {
        return $this->labelGap;
    }

    /**
     * Sets size
     *
     * @param integer $size
     * @return Marker
     */
    public function setSize($size)
    {
        $this->size = (integer) $size;

        return $this;
    }

    /**
     * Returns size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets type
     *
     * @param string $type
     * @return Marker
     */
    public function setType($type)
    {
        if (!in_array($type, $this->validTypes)) {
            throw new Exception\InvalidArgumentException(sprintf(
            	'The marker type "%s" is not valid.',
            	$type
            ));
        }

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
     * Returns legend as array
     *
     * @return array
     */
    public function toArray()
    {
        $params = array();

        $excludedKeys = array('validTypes');

        $fields = array_keys(get_object_vars($this));
        foreach ($fields as $field) {
            if (!isset($this->{$field}) || in_array($field, $excludedKeys)) {
                continue;
            }

            if ($this->{$field} instanceof Border) {
                $params += $this->{$field}->toArray();
            } elseif ($this->{$field} instanceof Color) {
                $params[$field] = $this->{$field}->toString();
            } else {
                $params[$field] = $this->{$field};
            }
        }

        foreach ($params as $key => $value) {
            $name = 'marker' . ucfirst($key);
            $params[$name] = $value;
            unset($params[$key]);
        }

        return $params;
    }
}