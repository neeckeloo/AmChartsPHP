<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider\Reader;

class Xml extends AbstractReader
{
    /**
     * Returns data from string
     *
     * @param  string $string
     * @return array
     */
    public function fromString($string)
    {
        if (empty($string)) {
            return array();
        }
        
        $xml = new \SimpleXMLElement($string);
        
        $data = (array) $xml;
        $items = reset($data);
                
        array_walk($items, function(&$item) { 
            $item = (array) $item;
        });
        
        return $items;
    }
}