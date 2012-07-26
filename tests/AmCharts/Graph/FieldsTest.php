<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Graph;

class FieldsTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Fields
     */
    protected $fields;
    
    public function setUp()
    {
        $this->fields = new Fields();
    }
    
    public function testSetFields()
    {
        $this->fields->setFields(array('alphaField' => 'foo', 'valueField' => 'bar'));
        
        $this->assertEquals('foo', $this->fields->getAlphaField());
        $this->assertEquals('bar', $this->fields->getValueField());
        
        $this->assertNull($this->fields->getColorField());
    }
    
    public function setFieldProvider()
    {
        return array(
            array('alpha'), array('bullet'), array('bulletSize'), array('color'),
            array('customBullet'), array('description'), array('fillColors'), array('url'),
            array('value'), array('x'), array('y')
        );
    }
    
    /**
     * @dataProvider setFieldProvider
     */
    public function testSetField($field)
    {
        $setter = 'set' . ucfirst($field) . 'Field';
        $getter = 'get' . ucfirst($field) . 'Field';

        $this->fields->{$setter}('Foo');
        $this->assertEquals('Foo', $this->fields->{$getter}());

        $this->fields->{$setter}(123);
        $this->assertTrue(is_string($this->fields->{$getter}()));
    }
}