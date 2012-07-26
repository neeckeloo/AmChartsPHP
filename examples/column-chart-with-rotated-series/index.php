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
$manager->setAmChartsPath('./amcharts.js');

$serial = new Chart\Serial();
        
$dataProvider = Chart\DataProvider\Factory::fromFile(__DIR__ . '/data.xml');
$serial->setDataProvider($dataProvider);

$serial->setCategoryField('country')
    ->setStartDuration(1);

$serial->categoryAxis()
    ->setGridPosition('start')
    ->setLabelRotation(45)
    ->setGridAlpha(0)
    ->setFillAlpha(100)
    ->setFillColor('#FAFAFA');

$serial->valueAxis()
    ->setDashLength(5)
    ->setAxisAlpha(0)
    ->title()->setValue('Visitors from country');

$graph = new Graph\Column();
$graph->fields()
    ->setValueField('visits')
    ->setColorField('color');

$graph->setFillAlphas(100)
    ->setLineAlpha(0)
    ->setBalloonText('[[category]]: [[value]]');
$serial->addGraph($graph);

echo $serial->render();