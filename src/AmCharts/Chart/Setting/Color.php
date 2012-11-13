<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\Setting;

use AmCharts\Chart\Setting\Exception;

class Color
{
    /**
     * @var array 
     */
    protected $rgb = array();
    
    /**
     * Constructor
     * 
     * @param string|array $color 
     */
    public function __construct($color)
    {
        if ($this->isRgb($color)) {
            $this->rgb = $color;
        } elseif ($this->isHex($color)) {
            $this->rgb = $this->hexToDec($color);
        } else {
            throw new Exception\InvalidArgumentException("The color provided is invalid.");
        }
    }
    
    /**
     * Returns true if is rgb color
     * 
     * @param array $color
     * @return boolean 
     */
    protected function isRgb($color)
    {
        if (count($color) != 3) {
            return false;
        }
        
        foreach ($color as $dec) {
            if (!($dec >= 0 && $dec <= 255)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Returns true if is hex color
     * 
     * @param string $color
     * @return boolean 
     */
    protected function isHex($color)
    {
        if (!is_string($color)) {
            return false;
        }
        
        if (preg_match('/^#(?:(?:[a-fA-F\d]{3}){1,2})$/', $color)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Convert hex to dec color
     * 
     * @param string $hex
     * @return array 
     */
    protected function hexToDec($hex)
    {
        $hex = preg_replace("/[^0-9A-Fa-f]/", '', $hex);
        
        $rgb = array();
        if (strlen($hex) == 6) {
            $dec = hexdec($hex);
            $rgb[] = 0xFF & ($dec >> 0x10);
            $rgb[] = 0xFF & ($dec >> 0x8);
            $rgb[] = 0xFF & $dec;
        } elseif (strlen($hex) == 3) {
            $rgb[] = hexdec(str_repeat(substr($hex, 0, 1), 2));
            $rgb[] = hexdec(str_repeat(substr($hex, 1, 1), 2));
            $rgb[] = hexdec(str_repeat(substr($hex, 2, 1), 2));
        }
        
        return $rgb;
    }
    
    public function toString()
    {
        return $this->__toString();
    }
    
    public function __toString()
    {
        $color = array();
        
        foreach ($this->rgb as $dec) {
            $hex = dechex($dec);
            $hex = str_pad($hex, 2, '0', STR_PAD_LEFT);
            $color[] = $hex;
        }
        
        return '#' . implode('', $color);
    }
}