<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Axis;

class ValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Value
     */
    protected $axis;

    public function setUp()
    {
        $this->axis = new Value;
    }

    public function testSetLabelsEnabled()
    {
        $this->axis->setLabelsEnabled(true);
        $this->assertTrue($this->axis->isLabelsEnabled());
    }

    public function testSetStackType()
    {
        $this->axis->setStackType('regular');
        $this->assertEquals('regular', $this->axis->getStackType());
    }

    public function testToArray()
    {
        $this->assertCount(0, $this->axis->toArray());
    }
}