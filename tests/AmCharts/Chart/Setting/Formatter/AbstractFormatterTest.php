<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting\Formatter;

class AbstractFormatterTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var AbstractFormatter
     */
    protected $formatter;
    
    public function setUp()
    {
        $class = 'AmCharts\Chart\Setting\Formatter\AbstractFormatter';
        $this->formatter = $this->getMockForAbstractClass($class);
    }
    
    public function testSetParams()
    {
        $this->formatter->setParams(array(
            'precision' => 2,
            'decimalSeparator' => ',',
            'foo' => 123
        ));
        $this->assertEquals(2, $this->formatter->getPrecision());
        $this->assertEquals(',', $this->formatter->getDecimalSeparator());
    }
    
    public function testSetPrecision()
    {
        $this->assertEquals(0, $this->formatter->getPrecision());
        
        $this->formatter->setPrecision(1);
        $this->assertEquals(1, $this->formatter->getPrecision());
    }
    
    public function testSetDecimalSeparator()
    {
        $this->assertEquals('.', $this->formatter->getDecimalSeparator());
        
        $this->formatter->setDecimalSeparator(',');
        $this->assertEquals(',', $this->formatter->getDecimalSeparator());
    }
    
    public function testSetThousandsSeparator()
    {
        $this->assertEquals(',', $this->formatter->getThousandsSeparator());
        
        $this->formatter->setThousandsSeparator(' ');
        $this->assertEquals(' ', $this->formatter->getThousandsSeparator());
    }
    
    public function testToArray()
    {
        $this->assertCount(3, $this->formatter->toArray());
    }
}