<?php

namespace AmCharts\Chart\Axis;

class AbstractAxisTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var AbstractAxis
     */
    protected $axis;
    
    public function setUp()
    {
        $class = 'AmCharts\Chart\Axis\AbstractAxis';
        $this->axis = $this->getMockForAbstractClass($class);
    }
    
    public function testSetAxisAlpha()
    {
        $this->axis->setAxisAlpha(30);
        $this->assertEquals(30, $this->axis->getAxisAlpha());
    }
    
    public function testSetGridAlpha()
    {
        $this->axis->setGridAlpha(30);
        $this->assertEquals(30, $this->axis->getGridAlpha());
    }
    
    public function testSetLabelRotation()
    {
        $this->axis->setLabelRotation(30);
        $this->assertEquals(30, $this->axis->getLabelRotation());
    }
    
    /**
     * @expectedException AmCharts\Exception\InvalidArgumentException 
     */
    public function testSetLabelRotationWithNotIntValue()
    {
        $this->axis->setLabelRotation('foo');
    }
    
    public function setLabelRotationWithWrongValueProvider()
    {
        return array(
            array(-370), array(390)
        );
    }
    
    /**
     * @dataProvider setLabelRotationWithWrongValueProvider
     * @expectedException AmCharts\Exception\UnexpectedValueException 
     */
    public function testSetLabelRotationWithWrongValue($angle)
    {
        $this->axis->setLabelRotation($angle);
    }
    
    public function testToArray()
    {
        $this->assertCount(1, $this->axis->toArray());
    }
}