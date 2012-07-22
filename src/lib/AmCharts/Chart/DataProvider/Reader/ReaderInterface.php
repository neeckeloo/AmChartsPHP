<?php
/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
namespace AmCharts\Chart\DataProvider\Reader;

/**
 * @category   AmCharts
 * @package    Chart
 * @subpackage DataProvider
 */
interface ReaderInterface
{   
    public function fromFile($filename);
    
    public function fromString($string);
}