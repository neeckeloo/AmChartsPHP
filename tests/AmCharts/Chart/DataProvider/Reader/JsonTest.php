<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider\Reader;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Json
     */
    protected $reader;
    
    public function setUp()
    {
        $this->reader = new Json;
    }
    
    public function testFromString()
    {
        $data = '[{"name":"Foo","value":1},{"name":"Bar","value":2},{"name":"Baz","value":3}]';
        
        $items = $this->reader->fromString($data);
        
        $this->assertCount(3, $items);
        
        $this->assertEquals('Foo', $items[0]['name']);
        $this->assertEquals(1, $items[0]['value']);
    }
}