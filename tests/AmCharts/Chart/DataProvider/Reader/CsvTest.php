<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider\Reader;

class CsvTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Csv
     */
    protected $reader;
    
    public function setUp()
    {
        $this->reader = new Csv;
    }
    
    public function testFromString()
    {
        $data = 'name;value' . "\n"
            . 'Foo;1' . "\n"
            . 'Bar;2' . "\n"
            . 'Baz;3' . "\n";
        
        $items = $this->reader->fromString($data);
        
        $this->assertCount(3, $items);
        
        $this->assertEquals('Foo', $items[0]['name']);
        $this->assertEquals(1, $items[0]['value']);
    }
}