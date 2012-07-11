<?php

namespace AmCharts\Chart\Setting\Formatter;

class NumberTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Number
     */
    protected $formatter;
    
    public function setUp()
    {
        $this->formatter = new Number;
    }
    
    public function testGetPrecision()
    {
        $this->assertEquals(-1, $this->formatter->getPrecision());
    }
}