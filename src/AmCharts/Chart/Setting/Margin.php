<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

use AmCharts\Chart\Setting\Exception;

class Margin
{
    /**
     * @var boolean 
     */
    protected $autoMargins;

    /**
     * @var integer
     */
    protected $marginTop;

    /**
     * @var integer
     */
    protected $marginBottom;

    /**
     * @var integer
     */
    protected $marginLeft;

    /**
     * @var integer
     */
    protected $marginRight;

    /**
     * Constructor
     *
     * @param null|array $margin
     */
    public function __construct($margin = null)
    {
        if (null !== $margin) {
            $this->setValues($margin);
        }
    }

    /**
     * Sets auto margins
     *
     * @param boolean $auto
     * @return Margin
     */
    public function setAuto($auto = true)
    {
        $this->autoMargins = (bool) $auto;

        return $this;
    }

    /**
     * Returns true if margins are automaticaly calculated
     *
     * @return boolean
     */
    public function isAuto()
    {
        return $this->autoMargins;
    }

    /**
     * Sets margin
     *
     * @param array $margin
     * @return Margin
     */
    public function setValues($margin)
    {
        if (!is_array($margin)) {
            throw new Exception\InvalidArgumentException(
                'The margin parameter must be an array.'
            );
        }
        if (count($margin) != 4) {
            throw new Exception\InvalidArgumentException(
                'The margin parameter must contains top, bottom, left and right margin.'
            );
        }

        $this->setTop($margin[0])
            ->setBottom($margin[1])
            ->setLeft($margin[2])
            ->setRight($margin[3]);

        $this->setAuto(false);

        return $this;
    }

    /**
     * Sets margin top
     *
     * @param integer $margin
     * @return Margin
     */
    public function setTop($margin)
    {
        $this->marginTop = (int) $margin;

        return $this;
    }

    /**
     * Returns margin top
     *
     * @return integer
     */
    public function getTop()
    {
        return $this->marginTop;
    }

    /**
     * Sets margin bottom
     *
     * @param integer $margin
     * @return Margin
     */
    public function setBottom($margin)
    {
        $this->marginBottom = (int) $margin;

        return $this;
    }

    /**
     * Returns margin bottom
     *
     * @return integer
     */
    public function getBottom()
    {
        return $this->marginBottom;
    }

    /**
     * Sets margin left
     *
     * @param integer $margin
     * @return Margin
     */
    public function setLeft($margin)
    {
        $this->marginLeft = (int) $margin;

        return $this;
    }

    /**
     * Returns margin left
     *
     * @return integer
     */
    public function getLeft()
    {
        return $this->marginLeft;
    }

    /**
     * Sets margin right
     *
     * @param integer $margin
     * @return Margin
     */
    public function setRight($margin)
    {
        $this->marginRight = (int) $margin;

        return $this;
    }

    /**
     * Returns margin right
     *
     * @return integer
     */
    public function getRight()
    {
        return $this->marginRight;
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
                $options[$field] = $this->{$field};
            }
        }

        return $options;
    }
}