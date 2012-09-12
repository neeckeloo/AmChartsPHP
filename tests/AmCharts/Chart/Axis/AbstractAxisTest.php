<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
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
    
    public function testSetAxisColor()
    {
        $this->axis->setAxisColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->axis->getAxisColor());
    }
    
    public function testSetAxisThickness()
    {
        $this->axis->setAxisThickness(30);
        $this->assertEquals(30, $this->axis->getAxisThickness());
    }
    
    public function testSetDashLength()
    {
        $this->axis->setDashLength(30);
        $this->assertEquals(30, $this->axis->getDashLength());
    }
    
    public function testSetFillAlpha()
    {
        $this->axis->setFillAlpha(30);
        $this->assertEquals(30, $this->axis->getFillAlpha());
    }
    
    public function testSetFillColor()
    {
        $this->axis->setFillColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->axis->getFillColor());
    }
    
    public function testSetGridAlpha()
    {
        $this->axis->setGridAlpha(30);
        $this->assertEquals(30, $this->axis->getGridAlpha());
    }
    
    public function testSetGridColor()
    {
        $this->axis->setGridColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->axis->getGridColor());
    }
    
    public function testSetGridThickness()
    {
        $this->axis->setGridThickness(30);
        $this->assertEquals(30, $this->axis->getGridThickness());
    }
    
    public function testSetLabelRotation()
    {
        $this->axis->setLabelRotation(30);
        $this->assertEquals(30, $this->axis->getLabelRotation());
    }
    
    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException 
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
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException 
     */
    public function testSetLabelRotationWithWrongValue($angle)
    {
        $this->axis->setLabelRotation($angle);
    }
    
    public function testSetTickLength()
    {
        $this->axis->setTickLength(30);
        $this->assertEquals(30, $this->axis->getTickLength());
    }
    
    public function testToArray()
    {
        $this->assertCount(0, $this->axis->toArray());
    }
}