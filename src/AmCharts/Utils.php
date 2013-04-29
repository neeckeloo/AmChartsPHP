<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts;

class Utils
{
    /**
     * Generate random key
     * 
     * @param integer $length
     * @return string
     */
    public static function generateRandomKey($length = 5)
    {
        $ranges = array(range('a', 'z'), range('A', 'Z'), range(1, 9));
        
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $rkey = array_rand($ranges);
            $vkey = array_rand($ranges[$rkey]);
            $key .= $ranges[$rkey][$vkey];
        }
        
        return $key;
    }
}