<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Axis;

use AmCharts\Chart\Setting;
use AmCharts\Chart\Exception;

abstract class AbstractAxis
{
    /**
     * @var Setting\Alpha
     */
    protected $axisAlpha;

    /**
     * @var Setting\Color
     */
    protected $axisColor;

    /**
     * @var integer
     */
    protected $axisThickness;

    /**
     * @var integer
     */
    protected $dashLength;

    /**
     * @var Setting\Alpha
     */
    protected $fillAlpha;

    /**
     * @var Setting\Color
     */
    protected $fillColor;

    /**
     * @var Setting\Alpha
     */
    protected $gridAlpha;

    /**
     * @var Setting\Color
     */
    protected $gridColor;

    /**
     * @var integer
     */
    protected $gridThickness;

    /**
     * @var integer
     */
    protected $labelRotation;

    /**
     * Length of the tick marks.
     *
     * @var integer
     */
    protected $tickLength;

    /**
     * @var Setting\Text
     */
    protected $title;

    /**
     * Sets axis alpha
     *
     * @param integer $alpha
     * @return AbstractAxis
     */
    public function setAxisAlpha($alpha)
    {
        $this->axisAlpha = new Setting\Alpha($alpha);

        return $this;
    }

    /**
     * Returns axis alpha
     *
     * @return integer
     */
    public function getAxisAlpha()
    {
        return $this->axisAlpha->getOpacity();
    }

    /**
     * Sets axis color
     *
     * @param null|string|array|Color $color
     * @return AbstractAxis
     */
    public function setAxisColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->axisColor = $color;
            } else {
                $this->axisColor = new Setting\Color($color);
            }
        }

        return $this;
    }

    /**
     * Returns axis color
     *
     * @return string
     */
    public function getAxisColor()
    {
        return $this->axisColor;
    }

    /**
     * Sets axis thickness
     *
     * @param integer $thickness
     * @return AbstractAxis
     */
    public function setAxisThickness($thickness)
    {
        if ($thickness < 0) {
            throw new Exception\InvalidArgumentException('The thickness value must be positive.');
        }

        $this->axisThickness = (int) $thickness;

        return $this;
    }

    /**
     * Returns axis thickness
     *
     * @return integer
     */
    public function getAxisThickness()
    {
        return $this->axisThickness;
    }

    /**
     * Sets dash length
     *
     * @param integer $length
     * @return AbstractAxis
     */
    public function setDashLength($length)
    {
        $length = (int) $length;

        if ($length < 0) {
            throw new Exception\InvalidArgumentException('The dash length value must be positive.');
        }

        $this->dashLength = $length;

        return $this;
    }

    /**
     * Returns dash length
     *
     * @return integer
     */
    public function getDashLength()
    {
        return $this->dashLength;
    }

    /**
     * Sets fill alpha
     *
     * @param integer $alpha
     * @return AbstractAxis
     */
    public function setFillAlpha($alpha)
    {
        $this->fillAlpha = new Setting\Alpha($alpha);

        return $this;
    }

    /**
     * Returns fill alpha
     *
     * @return integer
     */
    public function getFillAlpha()
    {
        return $this->fillAlpha->getOpacity();
    }

    /**
     * Sets fill color
     *
     * @param null|string|array|Color $color
     * @return AbstractAxis
     */
    public function setFillColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->fillColor = $color;
            } else {
                $this->fillColor = new Setting\Color($color);
            }
        }

        return $this;
    }

    /**
     * Returns fill color
     *
     * @return string
     */
    public function getFillColor()
    {
        return $this->fillColor;
    }

    /**
     * Sets grid alpha
     *
     * @param integer $alpha
     * @return AbstractAxis
     */
    public function setGridAlpha($alpha)
    {
        $this->gridAlpha = new Setting\Alpha($alpha);

        return $this;
    }

    /**
     * Returns grid alpha
     *
     * @return integer
     */
    public function getGridAlpha()
    {
        return $this->gridAlpha->getOpacity();
    }

    /**
     * Sets grid color
     *
     * @param null|string|array|Color $color
     * @return AbstractAxis
     */
    public function setGridColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Setting\Color) {
                $this->gridColor = $color;
            } else {
                $this->gridColor = new Setting\Color($color);
            }
        }

        return $this;
    }

    /**
     * Returns grid color
     *
     * @return string
     */
    public function getGridColor()
    {
        return $this->gridColor;
    }

    /**
     * Sets grid thickness
     *
     * @param integer $thickness
     * @return AbstractAxis
     */
    public function setGridThickness($thickness)
    {
        if ($thickness < 0) {
            throw new Exception\InvalidArgumentException('The thickness value must be positive.');
        }

        $this->gridThickness = (int) $thickness;

        return $this;
    }

    /**
     * Returns grid thickness
     *
     * @return integer
     */
    public function getGridThickness()
    {
        return $this->gridThickness;
    }

    /**
     * Sets label rotation
     *
     * @param integer $angle
     * @return AbstractAxis
     */
    public function setLabelRotation($angle)
    {
        if (!is_int($angle)) {
            throw new Exception\InvalidArgumentException("The label rotation value must be an integer.");
        }

        if (!($angle > -360 && $angle < 360)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '"%" is not a valid angle.',
                $angle
            ));
        }

        $this->labelRotation = (int) $angle;

        return $this;
    }

    /**
     * Returns label rotation
     *
     * @return AbstractAxis
     */
    public function getLabelRotation()
    {
        return $this->labelRotation;
    }

    /**
     * Sets tick length
     *
     * @param integer $length
     * @return AbstractAxis
     */
    public function setTickLength($length)
    {
        $length = (int) $length;

        if ($length < 0) {
            throw new Exception\InvalidArgumentException('The tick length value must be positive.');
        }

        $this->tickLength = $length;

        return $this;
    }

    /**
     * Returns tick length
     *
     * @return integer
     */
    public function getTickLength()
    {
        return $this->tickLength;
    }

    /**
     * Sets and returns text object
     *
     * @param array $params
     * @return Setting\Text
     */
    public function title($params = array())
    {
        if (!isset($this->title)) {
            $this->title = new Setting\Text();
        }

        $this->title->setParams($params);

        return $this->title;
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
                    $titleOptions = $this->{$field}->toArray();

                    $options = $options + array(
                        'title'         => $titleOptions['text'],
                        'titleColor'    => isset($titleOptions['color']) ? $titleOptions['color'] : null,
                        'titleFontSize' => isset($titleOptions['fontSize']) ? $titleOptions['fontSize'] : null,
                    );
                } else {
                    $options[$field] = $this->{$field};
                }
            }
        }

        return $options;
    }
}