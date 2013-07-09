<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use AmCharts\Chart,
    AmCharts\Manager as ChartManager;

$manager = ChartManager::getInstance();
$manager->setAmChartsPath('./amcharts.js');

$pie = new Chart\Pie();
        
$dataProvider = Chart\DataProvider\Factory::fromFile(__DIR__ . '/data.xml');
$pie->setDataProvider($dataProvider);

$pie->setTitleField('country')
    ->setValueField('value')
    ->setOutlineColor('#ffffff')
    ->setOutlineAlpha(80)
    ->setOutlineThickness(2)
    ->set3D(30, 15);

echo $pie->render();