<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Axis;

class Value extends AbstractAxis
{
    /**
     * Specifies whether axis displays category axis labels and value axis values.
     *
     * @var boolean
     */
    protected $labelsEnabled;

    /**
     * Stacking mode of the axis. Possible values are: "none", "regular", "100%", "3d".
     *
     * @var string
     */
    protected $stackType;

    /**
     * Sets true if labels are enabled
     *
     * @param boolean $enabled
     * @return Value
     */
    public function setLabelsEnabled($enabled = true)
    {
        $this->labelsEnabled = (bool) $enabled;

        return $this;
    }

    /**
     * Returns true if labels are enabled
     *
     * @return boolean
     */
    public function isLabelsEnabled()
    {
        return $this->labelsEnabled;
    }

    /**
     * @param string $type
     * @return Value
     */
    public function setStackType($type)
    {
        $this->stackType = (string) $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getStackType()
    {
        return $this->stackType;
    }
}