<?php
/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
namespace AmCharts\Chart\DataProvider\Reader;

use AmCharts\Exception,
    XmlReader;

/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
class Xml extends AbstractReader
{    
    /**
     * Returns data from file.
     *
     * @param  string $filename
     * @return array
     * @throws Exception\RuntimeException
     */
    public function fromFile($filename)
    {
        if (!is_file($filename) || !is_readable($filename)) {
            throw new Exception\RuntimeException(sprintf(
                "File '%s' doesn't exist or not readable",
                $filename
            ));
        }
        
        $content = file_get_contents($filename);
        
        return $this->fromString($content);
    }

    /**
     * Returns data from string
     *
     * @param  string $string
     * @return array
     * @throws Exception\RuntimeException
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