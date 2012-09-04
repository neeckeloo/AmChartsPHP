<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider\Reader;

class XmlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Xml
     */
    protected $reader;
    
    public function setUp()
    {
        $this->reader = new Xml;
    }
    
    public function testFromString()
    {
        $data = '<?xml version="1.0" encoding="UTF-8" ?>
<root>
    <item>
        <name>Foo</name>
        <value>1</value>
    </item>
    <item>
        <name>Bar</name>
        <value>2</value>
    </item>
    <item>
        <name>Baz</name>
        <value>3</value>
    </item>
</root>';
        
        $items = $this->reader->fromString($data);
        
        $this->assertCount(3, $items);
        
        $this->assertEquals('Foo', $items[0]['name']);
        $this->assertEquals(1, $items[0]['value']);
    }
}