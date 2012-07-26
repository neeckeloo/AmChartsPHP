<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class LabelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Label
     */
    protected $label;
    
    public function setUp()
    {
        $this->label = new Label('foo');
    }
    
    public function testSetX()
    {
        $position = 5;
        $this->label->setX($position);
        $this->assertEquals($position, $this->label->getX());
    }
    
    public function testSetY()
    {
        $position = 5;
        $this->label->setY($position);
        $this->assertEquals($position, $this->label->getY());
    }
    
    public function testSetAlign()
    {
        $align = Text::ALIGN_CENTER;
        $this->label->text()->setAlign($align);
        $this->assertEquals($align, $this->label->text()->getAlign());
    }
    
    public function testSetSize()
    {
        $size = 12;
        $this->label->text()->setFontSize($size);
        $this->assertEquals($size, $this->label->text()->getFontSize());
    }
    
    public function testSetColor()
    {
        $color= '#ff0000';
        $this->label->text()->setColor($color);
        $this->assertEquals($color, $this->label->text()->getColor());
    }
    
    public function testSetText()
    {
        $text = 'foo';
        $this->label->text()->setValue($text);
        $this->assertEquals($text, $this->label->text()->getValue());
    }
    
    public function testSetParams()
    {
        $params = array(
            'align' => Text::ALIGN_CENTER,
            'fontSize' => 12,
            'color' => '#ff0000',
            'text' => 'foo',
            'foo' => 123
        );        
        $this->label->text()->setParams($params);        
        
        $this->assertEquals($params['align'], $this->label->text()->getAlign());
        $this->assertEquals($params['fontSize'], $this->label->text()->getFontSize());
        $this->assertEquals($params['color'], $this->label->text()->getColor());
        $this->assertEquals($params['text'], $this->label->text()->getValue());
        
        $values = $this->label->toArray();
        $this->assertEquals($params['align'], $values['align']);
        $this->assertEquals($params['fontSize'], $values['fontSize']);
        $this->assertEquals($params['color'], $values['color']);
        $this->assertEquals($params['text'], $values['text']);
    }
}