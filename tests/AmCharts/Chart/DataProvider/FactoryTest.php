<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFromUrl()
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

        $response = new \Zend\Http\Response();
        $response->setContent($data);

        $response->getHeaders()->addHeaderLine('Content-Type: text/xml');

        $client = $this->getMock('Zend\Http\Client', array('send'));

        $client->expects($this->once())
            ->method('send')
            ->will($this->returnValue($response));

        Factory::setHttpClient($client);

        $url = 'http://www.domain.com';
        $dataProvider = Factory::fromUrl($url);

        $this->assertInstanceOf('AmCharts\Chart\DataProvider', $dataProvider);

        $data = $dataProvider->toArray();
        $this->assertCount(3, $data);
    }
    
    public function testGetReaderManager()
    {
        $this->assertInstanceOf(
            'AmCharts\Chart\DataProvider\ReaderPluginManager',
            Factory::getReaderPluginManager()
        );
    }
}