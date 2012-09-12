<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class BorderTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var AmCharts\Chart\Setting\Border
     */
    protected $border;
    
    public function setUp()
    {
        $this->border = new Border(array(
            'color' => '#ffffff',
        ));
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
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->border->color());
        
        $this->border->color(new Color($color));
        $this->assertInstanceOf('AmCharts\Chart\Setting\Color', $this->border->color());
    }

    public function testSetThickness()
    {
        $thickness = 2;
        $this->border->setThickness($thickness);
        $this->assertEquals($thickness, $this->border->getThickness());
    }

    public function testSetParams()
    {
        $params = array(
            'color' => '#ff0000',
            'alpha' => 20,
            'thickness' => 5,
        );
        $this->border->setParams($params);

        $this->assertEquals($params['color'], $this->border->color()->toString());
        $this->assertEquals($params['alpha'], $this->border->getAlpha());
        $this->assertEquals($params['thickness'], $this->border->getThickness());

        $values = $this->border->toArray();
        $this->assertEquals($params['color'], $values['borderColor']);
        $this->assertEquals($params['alpha'] / 100, $values['borderAlpha']);
        $this->assertEquals($params['thickness'], $values['borderThickness']);
    }
    
    public function testToArray()
    {
        $this->assertCount(1, $this->border->toArray());
    }
}