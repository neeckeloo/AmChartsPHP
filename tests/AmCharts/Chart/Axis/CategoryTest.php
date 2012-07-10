<?php

namespace AmCharts\Chart\Axis;

class CategoryTest extends \PHPUnit_Framework_TestCase
{   
    /**
     * @var Value
     */
    protected $axis;
    
    public function setUp()
    {
        $this->axis = new Category;
    }
    
    public function testSetGridPosition()
    {
        $this->axis->setGridPosition(Category::POSITION_MIDDLE);
        $this->assertEquals(Category::POSITION_MIDDLE, $this->axis->getGridPosition());
    }
    
    /**
     * @expectedException AmCharts\Exception\InvalidArgumentException
     */
    public function testSetGridPositionWithWrongValue()
    {
        $this->axis->setGridPosition('foo');
    }
    
    public function testToArray()
    {
        $this->assertCount(2, $this->axis->toArray());
    } 
}