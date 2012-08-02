<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use AmCharts\Chart,
    AmCharts\Graph,
    AmCharts\Manager as ChartManager;

$manager = ChartManager::getInstance();
$manager->setAmChartsPath('./amcharts.js')
    ->setImagesPath('./images/');

$serial = new Chart\Serial();
        
$dataProvider = Chart\DataProvider\Factory::fromFile(__DIR__ . '/data.xml');
$serial->setDataProvider($dataProvider);

$serial->setCategoryField('country')
    ->setStartDuration(1);

$serial->categoryAxis()
    ->setGridPosition('start')
    ->setLabelRotation(90);

$graph = new Graph\Column();
$graph->fields()
    ->setValueField('visits');

$graph->setFillAlphas(80)
    ->setLineAlpha(0)
    ->setBalloonText('[[category]]: [[value]]');
$serial->addGraph($graph);

echo $serial->render();