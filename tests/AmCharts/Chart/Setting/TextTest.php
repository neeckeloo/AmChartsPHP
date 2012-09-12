<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Text
     */
    protected $text;
    
    public function setUp()
    {
        $this->text = new Text();
    }
    
    public function testSetValue()
    {
        $value = 'foo';
        $this->text->setValue($value);
        $this->assertEquals($value, $this->text->getValue());
    }
    
    public function testSetFontFamily()
    {
        $family = 'foo';
        $this->text->setFontFamily($family);
        $this->assertEquals($family, $this->text->getFontFamily());
    }
    
    public function testSetFontSize()
    {
        $size = 11;
        $this->text->setFontSize($size);
        $this->assertEquals($size, $this->text->getFontSize());
    }
    
    public function testSetColor()
    {
        $this->text->setColor('#ff0000');
        
        $color = $this->text->getColor();
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $color);
        $this->assertEquals('#ff0000', $color->toString());
    }
    
    public function testSetAlign()
    {
        $align = Text::ALIGN_CENTER;
        $this->text->setAlign($align);
        $this->assertEquals($align, $this->text->getAlign());
    }
    
    /**
     * @expectedException AmCharts\Chart\Setting\Exception\InvalidArgumentException 
     */
    public function testSetAlignWithWrongAlign()
    {
        $this->text->setAlign('foo');
    }
    
    public function testToArray()
    {
        $this->assertCount(0, $this->text->toArray());
        
        $this->text->setAlign(Text::ALIGN_LEFT);
        $this->assertCount(1, $this->text->toArray());
        
        $this->text->setFontSize(12);
        $this->assertCount(2, $this->text->toArray());
    }
}