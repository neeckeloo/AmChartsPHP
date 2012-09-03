<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Graph;

class BulletTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Bullet
     */
    protected $bullet;

    public function setUp()
    {
        $this->bullet = new Bullet();
    }

    public function testSetType()
    {
        $this->bullet->setType(Bullet::ROUND);
        $this->assertEquals(Bullet::ROUND, $this->bullet->getType());
    }

    public function testToArray()
    {
    	$this->assertTrue(is_array($this->bullet->toArray()));
    }
}