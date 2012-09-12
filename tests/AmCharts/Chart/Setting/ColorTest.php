<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

class ColorTest extends \PHPUnit_Framework_TestCase
{    
    public function colorProvider()
    {
        return array(
            array('#ffffff', '#ffffff'),
            array('#000000', '#000000'),
            array('#ff0000', '#ff0000'),
            array(array(255, 255, 255), '#ffffff'),
            array(array(0, 0, 0), '#000000'),
            array(array(255, 0, 0), '#ff0000')
        );
    }

    /**
     * @dataProvider colorProvider
     */
    public function testColor($color, $hex)
    {
        $color = new Color($color);
        $this->assertEquals($hex, $color->toString());
    }
    
    public function wrongColorProvider()
    {
        return array(
            array('ffffff'),
            array(array(258, 0, 345))
        );
    }

    /**
     * @dataProvider wrongColorProvider
     * @expectedException \AmCharts\Chart\Setting\Exception\InvalidArgumentException
     */
    public function testWrongColor($color)
    {
        $color = new Color($color);
    }
}