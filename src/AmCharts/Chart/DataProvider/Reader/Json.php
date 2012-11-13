<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider\Reader;

class Json extends AbstractReader
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

        return \Zend\Json\Json::decode(
            $string,
            \Zend\Json\Json::TYPE_ARRAY
        );
    }
}