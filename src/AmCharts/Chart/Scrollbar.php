<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting\Alpha;
use AmCharts\Chart\Setting\Color;
use AmCharts\Chart\Setting\Background;
use AmCharts\Chart\Setting\Text;
use AmCharts\Graph\AbstractGraph;
use AmCharts\Graph\GraphInterface;

class Scrollbar
{
    /**
     * @var Background
     */
    protected $background;

    /**
     * Graph will be displayed in the scrollbar
     *
     * @var AbstractGraph
     */
    protected $graph;

    /**
     * @var Alpha
     */
    protected $graphFillAlpha;

    /**
     * @var Color
     */
    protected $graphFillColor;

    /**
     * @var Alpha
     */
    protected $graphLineAlpha;

    /**
     * @var Color
     */
    protected $graphLineColor;

    /**
     * @var Alpha
     */
    protected $gridAlpha;

    /**
     * @var Color
     */
    protected $gridColor;

    /**
     * Number of grid lines
     *
     * @var integer
     */
    protected $gridCount;

    /**
     * Specifies whether scrollbar has a resize feature
     *
     * @var boolean
     */
    protected $resizeEnabled;

    /**
     * Height of scrollbar
     *
     * @var integer
     */
    protected $scrollbarHeight;

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
     * Sets and returns background
     *
     * @param null|array $background
     * @return Scrollbar
     */
    public function background($background = null)
    {
        if (!isset($this->background)) {
            $this->background = new Background();
        }

        if (null !== $background) {
            $this->background->setParams($background);
        }

        return $this->background;
    }

    /**
     * Sets graph
     *
     * @param AbstractGraph $graph
     * @return Scrollbar
     */
    public function setGraph(GraphInterface $graph)
    {
        $this->graph = $graph;

        return $this;
    }

    /**
     * Returns graph
     *
     * @return AbstractGraph
     */
    public function getGraph()
    {
        return $this->graph;
    }

    /**
     * Sets fill alpha
     *
     * @param integer $alpha
     * @return Scrollbar
     */
    public function setGraphFillAlpha($alpha)
    {
        $this->graphFillAlpha = new Alpha($alpha);

        return $this;
    }

    /**
     * Returns fill alpha
     *
     * @return integer
     */
    public function getGraphFillAlpha()
    {
        return $this->graphFillAlpha->getOpacity();
    }

    /**
     * Sets fill color
     *
     * @param null|string|array|Color $color
     * @return Scrollbar
     */
    public function setGraphFillColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->graphFillColor = $color;
            } else {
                $this->graphFillColor = new Color($color);
            }
        }

        return $this;
    }

    /**
     * Returns fill color
     *
     * @return string
     */
    public function getGraphFillColor()
    {
        return $this->graphFillColor;
    }

    /**
     * Sets line alpha
     *
     * @param integer $alpha
     * @return Scrollbar
     */
    public function setGraphLineAlpha($alpha)
    {
        $this->graphLineAlpha = new Alpha($alpha);

        return $this;
    }

    /**
     * Returns line alpha
     *
     * @return integer
     */
    public function getGraphLineAlpha()
    {
        return $this->graphLineAlpha->getOpacity();
    }

    /**
     * Sets line color
     *
     * @param null|string|array|Color $color
     * @return Scrollbar
     */
    public function setGraphLineColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->graphLineColor = $color;
            } else {
                $this->graphLineColor = new Color($color);
            }
        }

        return $this;
    }

    /**
     * Returns line color
     *
     * @return string
     */
    public function getGraphLineColor()
    {
        return $this->graphLineColor;
    }

    /**
     * Sets grid alpha
     *
     * @param integer $alpha
     * @return Scrollbar
     */
    public function setGridAlpha($alpha)
    {
        $this->gridAlpha = new Alpha($alpha);

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
     * @return Scrollbar
     */
    public function setGridColor($color = null)
    {
        if (null !== $color) {
            if ($color instanceof Color) {
                $this->gridColor = $color;
            } else {
                $this->gridColor = new Color($color);
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
     * Set grid count
     *
     * @param integer $count
     * @return Scrollbar
     */
    public function setGridCount($count)
    {
        $this->gridCount = (int) $count;
    }

    /**
     * Returns grid count
     *
     * @return integer
     */
    public function getGridCount()
    {
        return $this->gridCount;
    }

    /**
     * Sets if scrollbar resize is enabled
     *
     * @param boolean $enabled
     * @return Scrollbar
     */
    public function setResizeEnabled($enabled = false)
    {
        $this->resizeEnabled = (bool) $enabled;

        return $this;
    }

    /**
     * Returns true if scrollbar resize is enabled
     *
     * @return boolean
     */
    public function isResizeEnabled()
    {
        return $this->resizeEnabled;
    }

    /**
     * Sets height
     *
     * @param string $height
     * @return AbstractChart
     */
    public function setHeight($height)
    {
        $this->scrollbarHeight = (integer) $height;

        return $this;
    }

    /**
     * Returns height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->scrollbarHeight;
    }

    /**
     * Sets scrollbar parameters
     *
     * @param array $params
     * @return Scrollbar
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
                if ($this->{$field} instanceof Alpha) {
                    $options[$field] = $this->{$field}->getValue();
                } elseif ($this->{$field} instanceof Text) {
                    $color = $this->{$field}->getColor();
                    if ($color) {
                        $options['color'] = $color->toString();
                    }
                } elseif ($this->{$field} instanceof AbstractGraph) {
                    $options['graph'] = $this->{$field}->getId();
                } else {
                    $options[$field] = $this->{$field};
                }
            }
        }

        if (isset($this->background)) {
            $options += $this->background->toArray();
        }

        return $options;
    }
}