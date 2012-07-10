<?php

namespace AmCharts\Chart\Setting;

class BackgroundTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Background
     */
    protected $background;
    
    public function setUp()
    {
        $this->background = new Background('#ffffff');
    }
    
    public function testSetAlpha()
    {
        $alpha = 20;
        $this->background->setAlpha($alpha);
        $this->assertEquals($alpha, $this->background->getAlpha());
    }
    
    public function testSetColor()
    {
        $color = '#ff0000';
        $this->background->color($color);
        $this->assertEquals($color, $this->background->color()->toString());
    }
    
    public function testToArray()
    {
        $alpha = 20;
        $this->background->setAlpha($alpha);
        
        $color = '#ff0000';
        $this->background->color($color);
        
        $options = $this->background->toArray();
        $this->assertCount(2, $options);
    }
}