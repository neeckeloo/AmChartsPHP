<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class AlphaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Alpha
     */
    protected $alpha;
    
    public function setUp()
    {
        $this->alpha = new Alpha(50);
    }
    
    public function testSetOpacity()
    {
        $this->assertEquals(50, $this->alpha->getOpacity());
        $this->assertEquals(0.5, $this->alpha->getValue());
        
        $opacity = 30;
        $this->alpha->setOpacity($opacity);
        $this->assertEquals($opacity, $this->alpha->getOpacity());
        $this->assertEquals(0.3, $this->alpha->getValue());
    }
    
    /**
     * @expectedException AmCharts\Chart\Setting\Exception\InvalidArgumentException 
     */
    public function testSetOpacityWithNotIntValue()
    {
        $this->alpha->setOpacity('foo');
    }
    
    public function setOpacityWithWrongValueProvider()
    {
        return array(
            array(-50), array(150)
        );
    }
    
    /**
     * @dataProvider setOpacityWithWrongValueProvider
     * @expectedException AmCharts\Chart\Setting\Exception\InvalidArgumentException 
     */
    public function testSetOpacityWithWrongValue($opacity)
    {
        $this->alpha->setOpacity($opacity);
    }
}