<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

class CursorTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Cursor
     */
    protected $cursor;
    
    public function setUp()
    {
        $this->cursor = new Cursor;
    }
    
    public function testSetBulletsEnabled()
    {
        $this->cursor->setBulletsEnabled(true);
        $this->assertTrue($this->cursor->isBulletsEnabled());
        
        $this->cursor->setBulletsEnabled(false);
        $this->assertFalse($this->cursor->isBulletsEnabled());
    }
    
    public function testSetBulletSize()
    {
        $this->cursor->setBulletSize(8);
        $this->assertEquals(8, $this->cursor->getBulletSize());
    }
    
    public function testSetCategoryBalloonAlpha()
    {
        $alpha = 20;
        $this->cursor->setCategoryBalloonAlpha($alpha);
        $this->assertEquals($alpha, $this->cursor->getCategoryBalloonAlpha());
    }
    
    public function testSetCategoryBalloonColor()
    {
        $color = '#ff0000';
        
        $this->cursor->setCategoryBalloonColor($color);
        $this->assertInstanceOf('AmCharts\Chart\Setting\color', $this->cursor->getCategoryBalloonColor());
        
        $this->cursor->setCategoryBalloonColor(new Setting\Color($color));
        $this->assertInstanceOf('AmCharts\Chart\Setting\color', $this->cursor->getCategoryBalloonColor());
    }
    
    public function testSetCategoryBalloonDateFormat()
    {
        $dateFormat = 'MMM DD, YYYY';
        $this->cursor->setCategoryBalloonDateFormat($dateFormat);
        $this->assertEquals($dateFormat, $this->cursor->getCategoryBalloonDateFormat());
    }
    
    public function testSetCategoryBalloonEnabled()
    {
        $this->cursor->setCategoryBalloonEnabled(true);
        $this->assertTrue($this->cursor->isCategoryBalloonEnabled());
        
        $this->cursor->setCategoryBalloonEnabled(false);
        $this->assertFalse($this->cursor->isCategoryBalloonEnabled());
    }
    
    public function testSetColor()
    {
        $text = $this->cursor->text();
        $this->assertInstanceOf('AmCharts\Chart\Setting\Text', $text);
        
        $text->setColor('#ff0000');
        
        $color = $text->getColor();
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $color);
        $this->assertEquals('#ff0000', $color->toString());
    }
    
    public function testSetCursorAlpha()
    {
        $alpha = 20;
        $this->cursor->setCursorAlpha($alpha);
        $this->assertEquals($alpha, $this->cursor->getCursorAlpha());
    }
    
    public function testSetCursorColor()
    {
        $color = '#ff0000';
        
        $this->cursor->setCursorColor($color);
        $this->assertInstanceOf('AmCharts\Chart\Setting\color', $this->cursor->getCursorColor());
        
        $this->cursor->setCursorColor(new Setting\Color($color));
        $this->assertInstanceOf('AmCharts\Chart\Setting\color', $this->cursor->getCursorColor());
    }
    
    public function cursorPositionProvider()
    {
        return array(
            array(Cursor::POSITION_START),
            array(Cursor::POSITION_MIDDLE),
            array(Cursor::POSITION_MOUSE),
        );
    }
    
    /**
     * @dataProvider cursorPositionProvider
     */
    public function testSetCursorPosition($position)
    {
        $this->cursor->setCursorPosition($position);
        $this->assertEquals($position, $this->cursor->getCursorPosition());
    }
    
    /**
     * @expectedException AmCharts\Chart\Exception\InvalidArgumentException
     */
    public function testSetCursorPositionWithInvalidParam()
    {
        $this->cursor->setCursorPosition('foo');
    }
    
    public function testSetOneBalloonOnly()
    {
        $this->cursor->setOneBalloonOnly(true);
        $this->assertTrue($this->cursor->hasOneBalloonOnly());
        
        $this->cursor->setOneBalloonOnly(false);
        $this->assertFalse($this->cursor->hasOneBalloonOnly());
    }
    
    public function testSetPanEnabled()
    {
        $this->cursor->setPanEnabled(true);
        $this->assertTrue($this->cursor->isPanEnabled());
        
        $this->cursor->setPanEnabled(false);
        $this->assertFalse($this->cursor->isPanEnabled());
    }
    
    public function testSetValueBalloonEnabled()
    {
        $this->cursor->setValueBalloonEnabled(true);
        $this->assertTrue($this->cursor->isValueBalloonEnabled());
        
        $this->cursor->setValueBalloonEnabled(false);
        $this->assertFalse($this->cursor->isValueBalloonEnabled());
    }
    
    public function testSetZoomable()
    {
        $this->cursor->setZoomable(true);
        $this->assertTrue($this->cursor->isZoomable());
        
        $this->cursor->setZoomable(false);
        $this->assertFalse($this->cursor->isZoomable());
    }
}