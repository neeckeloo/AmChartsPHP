<?php

namespace AmCharts\Chart\Setting;

class LegendTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Legend
     */
    protected $legend;
    
    public function setUp()
    {
        $this->legend = new Legend();
    }
    
    public function testSetParams()
    {
        $this->legend->setParams(array(
            'text' => array('foo' => 123),
            'foo' => 123
        ));
        $this->assertInstanceOf('AmCharts\Chart\Setting\Text', $this->legend->text());
    }
    
    public function testSetText()
    {
        $this->assertInstanceOf('AmCharts\Chart\Setting\Text', $this->legend->text());
    }
    
    public function testToArray()
    {
        $this->assertCount(0, $this->legend->toArray());
    }
}