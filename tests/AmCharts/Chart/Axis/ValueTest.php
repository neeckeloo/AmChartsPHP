<?php

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
    
    public function testToArray()
    {
        $this->assertCount(6, $this->axis->toArray());
    } 
}