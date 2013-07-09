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
    ->setSequencedAnimation(true)
    ->setStartEffect(Chart\Pie::EFFECT_ELASTIC)
    ->setStartDuration(2)
    ->setInnerRadius(30)
    ->setLabelRadius(15)
    ->set3D(15, 10);

echo $pie->render();