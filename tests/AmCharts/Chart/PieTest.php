<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\Setting;

class PieTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Pie
     */
    protected $chart;
    
    public function setUp()
    {
        $this->chart = new Pie;
    }

    public function testGetType()
    {
        $this->assertEquals('pie', $this->chart->getType());
    }
    
    public function testSetTitleField()
    {
        $this->chart->setTitleField('foo');
        $this->assertEquals('foo', $this->chart->getTitleField());
    }
    
    public function testSetValueField()
    {
        $this->chart->setValueField('foo');
        $this->assertEquals('foo', $this->chart->getValueField());
    }
    
    public function testSetBalloonText()
    {
        $this->chart->setBalloonText('foo');
        $this->assertEquals('foo', $this->chart->getBalloonText());
    }

    public function testSetGroupedTitle()
    {
        $this->chart->setGroupedTitle('foo');
        $this->assertEquals('foo', $this->chart->getGroupedTitle());
    }

    public function testSetGroupPercent()
    {
        $this->chart->setGroupPercent(123);
        $this->assertEquals(123, $this->chart->getGroupPercent());
    }

    public function setInnerRadiusProvider()
    {
        return array(
            array(10, '10px'),
            array('10px', '10px'),
            array('10%', '10%'),
        );
    }

    /**
     * @dataProvider setInnerRadiusProvider
     */
    public function testSetInnerRadius($provided, $expected)
    {
        $this->chart->setWidth($provided);
        $this->assertEquals($expected, $this->chart->getWidth());
    }

    public function setInnerRadiusWithInvalidParamProvider()
    {
        return array(
            array('foo')
        );
    }

    /**
     * @dataProvider setInnerRadiusWithInvalidParamProvider
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetInnerRadiusWithInvalidParam($provided)
    {
        $this->chart->setInnerRadius($provided);
    }
    
    public function testSetLabelRadius()
    {
        $radius = 50;
        $this->chart->setLabelRadius($radius);
        $this->assertEquals($radius, $this->chart->getLabelRadius());
    }
    
    public function testSetLabelText()
    {
        $this->chart->setLabelText('foo');
        $this->assertEquals('foo', $this->chart->getLabelText());
    }

    public function testSetMargins()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Margin', $this->chart->margin());
    }
    
    public function testSetOutlineAlpha()
    {
        $alpha = 20;
        $this->chart->setOutlineAlpha($alpha);
        $this->assertEquals($alpha, $this->chart->getOutlineAlpha());
    }
    
    public function testOutlineColor()
    {
        $color = $this->chart->getOutlineColor();
        $this->assertNull($color);
        
        $this->chart->setOutlineColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->chart->getOutlineColor());
    }
    
    public function testSetOutlineThickness()
    {
        $thickness = 20;
        $this->chart->setOutlineThickness($thickness);
        $this->assertEquals($thickness, $this->chart->getOutlineThickness());
    }
    
    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException 
     */
    public function testSetOutlineThicknessWithNegativeParam()
    {
        $this->chart->setOutlineThickness(-10);
    }
    
    public function testPieBaseColor()
    {
        $color = $this->chart->pieBaseColor();
        $this->assertNull($color);
        
        $color = $this->chart->pieBaseColor('#ff0000');
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $color);
    }
    
    public function setPieBrightnessStepProvider()
    {
        return array(
            array(-255, 255, 123)
        );
    }
    
    /**
     * @dataProvider setPieBrightnessStepProvider
     */
    public function testSetPieBrightnessStep($brightness)
    {
        $this->chart->setPieBrightnessStep($brightness);
        $this->assertEquals($brightness, $this->chart->getPieBrightnessStep());   
    }
    
    public function setPieBrightnessStepProviderWithWrongParam()
    {
        return array(
            array(-265, 265, 1001)
        );
    }
    
    /**
     * @dataProvider setPieBrightnessStepProviderWithWrongParam
     * @expectedException \AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetPieBrightnessStepWithWrongParam($brightness)
    {
        $this->chart->setPieBrightnessStep($brightness);
    }

    public function testSetPullOutDuration()
    {
        $duration = 20;
        $this->chart->setPullOutDuration($duration);
        $this->assertEquals($duration, $this->chart->getPullOutDuration());
    }

    public function testSetPullOutEffect()
    {
        $effect = Setting\Effect::ELASTIC;
        $this->chart->setPullOutEffect($effect);
        $this->assertEquals($effect, $this->chart->getPullOutEffect());
    }

    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetPullOutEffectWithInvalidParam()
    {
        $this->chart->setPullOutEffect('foo');
    }

    public function setPullOutRadiusProvider()
    {
        return array(
            array(10, '10px'),
            array('10px', '10px'),
            array('10%', '10%'),
        );
    }

    /**
     * @dataProvider setPullOutRadiusProvider
     */
    public function testSetPullOutRadius($provided, $expected)
    {
        $this->chart->setWidth($provided);
        $this->assertEquals($expected, $this->chart->getWidth());
    }

    public function setPullOutRadiusWithInvalidParamProvider()
    {
        return array(
            array('foo')
        );
    }

    /**
     * @dataProvider setPullOutRadiusWithInvalidParamProvider
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetPullOutRadiusWithInvalidParam($provided)
    {
        $this->chart->setPullOutRadius($provided);
    }
    
    public function testSetSequencedAnimation()
    {        
        $this->chart->setSequencedAnimation(false);
        $this->assertFalse($this->chart->isSequencedAnimation());
    }
    
    public function testSetStartAlpha()
    {
        $this->assertEquals(100, $this->chart->getStartAlpha());
        
        $alpha = 20;
        $this->chart->setStartAlpha($alpha);
        $this->assertEquals($alpha, $this->chart->getStartAlpha());
    }
    
    public function testSetStartDuration()
    {
        $duration = 20;
        $this->chart->setStartDuration($duration);
        $this->assertEquals($duration, $this->chart->getStartDuration());
    }
    
    public function testSetStartEffect()
    {
        $effect = Setting\Effect::ELASTIC;
        $this->chart->setStartEffect($effect);
        $this->assertEquals($effect, $this->chart->getStartEffect());
    }
    
    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException 
     */
    public function testSetStartEffectWithInvalidParam()
    {
        $this->chart->setStartEffect('foo');
    }
    
    public function testSetUrlTarget()
    {
        $url = 'foo';
        $this->chart->setUrlTarget($url);
        $this->assertEquals($url, $this->chart->getUrlTarget());
    }
    
    public function testRender()
    {
        $this->chart->setDataProvider(array(
            array(
                'name'  => 'Foo',
                'value' => 1
            ),
            array(
                'name'  => 'Bar',
                'value' => 2
            ),
            array(
                'name'  => 'Baz',
                'value' => 3
            )
        ));
        $this->chart->setTitleField('name')
            ->setValueField('value')
            ->setGroupPercent(5);
        
        $this->chart->legend()->text(array('align' => 'center'));
        
        $output = $this->chart->render();
        $this->assertNotEquals(false, strpbrk($output, 'write'));
    }
}