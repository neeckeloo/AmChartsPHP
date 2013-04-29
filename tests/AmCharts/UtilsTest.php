<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateRandomKey()
    {
        $this->assertEquals(5, strlen(Utils::generateRandomKey()));
        $this->assertEquals(15, strlen(Utils::generateRandomKey(15)));
    }
}