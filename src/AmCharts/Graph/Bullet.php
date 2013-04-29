<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Graph;

use AmCharts\Graph\Exception;

class Bullet
{
    const NONE = 'none';
    const ROUND = 'round';
    const SQUARE = 'square';
    const TRIANGLE_UP = 'triangleUp';
    const TRIANGLE_DOWN = 'triangleDown';
    const BUBBLE = 'bubble';
    const CUSTOM = 'custom';

    /**
     * @var string
     */
    protected $type;

    /**
     * Valid bullet types
     *
     * @var array
     */
    protected $validTypes = array(
    	self::NONE, self::ROUND, self::SQUARE, self::TRIANGLE_DOWN,
    	self::TRIANGLE_UP, self::BUBBLE, self::CUSTOM
    );

    /**
     * Bullet size
     *
     * @var integer
     */
    protected $size;

    /**
     * Sets type
     *
     * @param string $type
     * @return Bullet
     */
    public function setType($type)
    {
        if (!in_array($type, $this->validTypes)) {
            throw new Exception\InvalidArgumentException(sprintf(
            	'The bullet type "%s" is not valid.',
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
     * Sets size
     *
     * @param integer $size
     * @return Bullet
     */
    public function setSize($size)
    {
        $this->size = (int) $size;

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
     * Returns object properties as array
     *
     * @return array
     */
    public function toArray()
    {
        $options = array();

        $excludedKeys = array('validTypes');

        $properties = get_object_vars($this);
        foreach ($properties as $key => $value) {
            if (!$value || in_array($key, $excludedKeys)) {
                continue;
            }

            $options['bullet' . ucfirst($key)] = $value;
        }

        return $options;
    }
}