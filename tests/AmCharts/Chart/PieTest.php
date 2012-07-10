<?php

namespace AmCharts\Chart;

class PieTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var AmCharts\Chart\Pie
     */
    protected $chart;
    
    public function setUp()
    {
        $this->chart = new Pie;
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
    
    public function testSetGroupPercent()
    {
        $this->chart->setGroupPercent(123);
        $this->assertEquals(123, $this->chart->getGroupPercent());
    }
    
    public function testSetLabelText()
    {
        $this->chart->setLabelText('foo');
        $this->assertEquals('foo', $this->chart->getLabelText());
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
     * @expectedException \AmCharts\Exception\InvalidArgumentException
     */
    public function testSetPieBrightnessStepWithWrongParam($brightness)
    {
        $this->chart->setPieBrightnessStep($brightness);
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