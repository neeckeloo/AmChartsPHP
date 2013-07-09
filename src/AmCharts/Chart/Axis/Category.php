<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Axis;

use AmCharts\Chart\Exception;

class Category extends AbstractAxis
{
    const POSITION_START = 'start';

    const POSITION_MIDDLE = 'middle';

    /**
     * @var string
     */
    protected $gridPosition;

    /**
     * Sets grid position
     *
     * @param string $position
     * @return Category
     */
    public function setGridPosition($position)
    {
        if ($position != self::POSITION_START && $position != self::POSITION_MIDDLE) {
            throw new Exception\InvalidArgumentException('The grid position provided is not valid.');
        }

        $this->gridPosition = (string) $position;

        return $this;
    }

    /**
     * Returns grid position
     *
     * @return string
     */
    public function getGridPosition()
    {
        return $this->gridPosition;
    }

    /**
     * Returns object properties as array
     *
     * @return array
     */
    public function toArray()
    {
        $options = parent::toArray();

        if ($options) {
            $keys = array_keys($options);
            array_walk($keys, function (&$value) {
                $value = 'categoryAxis.' . $value;
            });
            $options = array_combine($keys, array_values($options));
        }

        return $options;
    }
}