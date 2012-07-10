<?php

namespace AmCharts\Chart\Setting;

class BorderTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var AmCharts\Chart\Setting\Border
     */
    protected $border;
    
    public function setUp()
    {
        $this->border = new Border('#ffffff');
    }
    
    public function testSetAlpha()
    {
        $alpha = 20;
        $this->border->setAlpha($alpha);
        $this->assertEquals($alpha, $this->border->getAlpha());
    }
    
    public function testSetColor()
    {
        $color = '#ff0000';
        $this->border->color($color);
        $this->assertEquals($color, $this->border->color()->toString());
    }
}