<?php
/**
 * AmChartsPHP
 *
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart\DataProvider\Reader;

class Csv extends AbstractReader
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

        $items = array();

        $i = 0;
        $lines = preg_split('/[\r\n|\n\r|\n|\r]/', $string);
        foreach ($lines as $line) {
            if ($line) {
                $fields = explode(';', $line);
                if ($i == 0) {
                    $keys = $fields;
                } else {
                    $items[] = array_combine($keys, $fields);
                }
                $i++;
            }
        }

        return $items;
    }
}