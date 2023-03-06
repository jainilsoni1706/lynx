<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\Axis;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exportable extends ExportableModel
{
    public function generate(Request $request)
    {
        error_reporting(0);
        $data =                 [
            ['2011', 778618],
            ['2012', 566516],
            ['2013', 452549],
            ['2014', 378566],
            ['2015', 370669],
        ];
        $this->helper($request->chart_type, 'test-chart', $data, ['H8', 'N24'], 'per');
        exit;

        // if ($request->chart_type == 'pie') {

           
        //     $spreadsheet = new Spreadsheet();
        //     $worksheet = $spreadsheet->getActiveSheet();
        //     $worksheet->fromArray(
        //         [
        //             ['2011', 778618],
        //             ['2012', 566516],
        //             ['2013', 452549],
        //             ['2014', 378566],
        //             ['2015', 370669],
        //         ]
        //     );
            
        //     $xAxisTickValues = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$2:$A$6', null, 5), 
        //     ];
            
        //     $dataSeriesValues = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$2:$B$6', null, 5), 
        //     ];
            
        //     $series = new DataSeries(
        //         DataSeries::TYPE_PIECHART, // plotType
        //         null, // plotGrouping
        //         range(0, count($dataSeriesValues) - 1), // plotOrder
        //         [], // plotLabel
        //         $xAxisTickValues, // plotCategory
        //         $dataSeriesValues // plotValues
        //     );
            
        //     $layout = new Layout();
        //     $layout->setShowPercent(true);
        //     $plotArea = new PlotArea($layout, [$series]);
            
        //     $legend = new Legend(Legend::POSITION_RIGHT, null, false);
            
        //     $title = new Title('Test Pie');
            
        //     $chart = new Chart(
        //         'pie chart', // name
        //         $title, // title
        //         $legend, // legend
        //         $plotArea, // plotArea
        //         true, // plotVisibleOnly
        //         0, // displayBlanksAs
        //         null, // xAxisLabel
        //         null   // yAxisLabel
        //     );
            
        //     $chart->setTopLeftPosition('H8');
        //     $chart->setBottomRightPosition('N24');
            
        //     $worksheet->addChart($chart);
            
        //     $writer = new Xlsx($spreadsheet);
        //     $writer->setIncludeCharts(true);
        //     $writer->save(public_path("$request->chart_type.xlsx"));

        // } else if ($request->chart_type == 'doughnut') {


        //     $spreadsheet = new Spreadsheet();
        //     $worksheet = $spreadsheet->getActiveSheet();
        //     $worksheet->fromArray(
        //         [
        //             ['2011', 778618],
        //             ['2012', 566516],
        //             ['2013', 452549],
        //             ['2014', 378566],
        //             ['2015', 370669],
        //         ]
        //     );
            
        //     $xAxisTickValues = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$2:$A$6', null, 5), 
        //     ];
            
        //     $dataSeriesValues = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$2:$B$6', null, 5), 
        //     ];
            
        //     $series = new DataSeries(
        //         DataSeries::TYPE_DOUGHNUTCHART, // plotType
        //         null, // plotGrouping
        //         range(0, count($dataSeriesValues) - 1), // plotOrder
        //         [], // plotLabel
        //         $xAxisTickValues, // plotCategory
        //         $dataSeriesValues // plotValues
        //     );
            
        //     $layout = new Layout();
        //     $layout->setShowPercent(true);
        //     $plotArea = new PlotArea($layout, [$series]);
            
        //     $legend = new Legend(Legend::POSITION_RIGHT, null, false);
            
        //     $title = new Title('Test TYPE_DOUGHNUTCHART');
            
        //     $chart = new Chart(
        //         'TYPE_DOUGHNUTCHART chart', // name
        //         $title, // title
        //         $legend, // legend
        //         $plotArea, // plotArea
        //         true, // plotVisibleOnly
        //         0, // displayBlanksAs
        //         null, // xAxisLabel
        //         null   // yAxisLabel
        //     );
            
        //     $chart->setTopLeftPosition('H8');
        //     $chart->setBottomRightPosition('N24');
            
        //     $worksheet->addChart($chart);
            
        //     $writer = new Xlsx($spreadsheet);
        //     $writer->setIncludeCharts(true);
        //     $writer->save(public_path("$request->chart_type.xlsx"));

        // } else if ($request->chart_type == 'bar') {

        //     $spreadsheet = new Spreadsheet();
        //     $worksheet = $spreadsheet->getActiveSheet();
            
        //     $data = [
        //         ['jan', 100],
        //         ['feb', 200],
        //         ['mar', 300]
        //     ];
            
        //     $worksheet->fromArray($data);
            
        //     $categories = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$1:$A$3', null, 3),
        //     ];
            
        //     $values = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$1:$B$3', null, 3),
        //     ];
            
        //     $series = new DataSeries(
        //         DataSeries::TYPE_BARCHART,
        //         null,
        //         range(0, count($values) - 1),
        //         $categories,
        //         $values
        //     );
            
        //     $plotArea = new PlotArea(null, [$series]);
            
        //     $title = new Title('Bar Chart');
            
        //     $legend = new Legend(Legend::POSITION_RIGHT, null, false);
            
        //     $layout = new Layout();
        //     $layout->setShowVal(true);
            
        //     $chart = new Chart(
        //         'bar chart',
        //         $title,
        //         $legend,
        //         $plotArea,
        //         true,
        //         0,
        //         null,
        //         null
        //     );
            
        //     $chart->setTopLeftPosition('A5');
        //     $chart->setBottomRightPosition('K20');
            
        //     $worksheet->addChart($chart);
            
        //     $writer = new Xlsx($spreadsheet);
        //     $writer->setIncludeCharts(true);
        //     $writer->save(public_path("$request->chart_type.xlsx"));

        // } else if ($request->chart_type == 'line') {


        //     $spreadsheet = new Spreadsheet();
        //     $worksheet = $spreadsheet->getActiveSheet();

        //     $data = [
        //         ['1', 10],
        //         ['2', 20],
        //         ['3', 30],
        //         ['4', 40],
        //         ['5', 50],
        //         ['6', 60],
        //     ];

        //     $worksheet->fromArray($data);

        //     $xAxisTickValues = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$A$1:$A$6', null, 6)
        //     ];

        //     $dataSeriesValues = [
        //         new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$1:$B$6', null, 6)
        //     ];

        //     $series = new DataSeries(
        //         DataSeries::TYPE_LINECHART, 
        //         null,
        //         range(0, count($dataSeriesValues) - 1), 
        //         [], 
        //         $xAxisTickValues, 
        //         $dataSeriesValues 
        //     );

        //     $plotArea = new PlotArea(null, [$series]);

        //     $title = new Title('Line Chart');

        //     $legend = new Legend(Legend::POSITION_BOTTOM, null, false);

        //     $layout = new Layout();
        //     $layout->setShowVal(true);

        //     $chart = new Chart(
        //         'line chart',
        //         $title,
        //         $legend,
        //         $plotArea,
        //         true,
        //         0,
        //         // $xAxis,
        //         null
        //     );

        //     $chart->setTopLeftPosition('A5');
        //     $chart->setBottomRightPosition('K20');

        //     $worksheet->addChart($chart);

        //     $writer = new Xlsx($spreadsheet);
        //     $writer->setIncludeCharts(true);
        //     $writer->save(public_path("$request->chart_type.xlsx"));


        // } else {
        //     dd("Chart type is not defined...");
        // }
    }

    public function helper($chartType, $chartTitle, $chartData, $chartPosition = array(), $chartValueFormat = 'val') {

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet->fromArray($chartData);
        $isMD = false;

        if (count($chartData[0]) > 2) {
            $isMD = true;
        }

        $xAxisTickValues = [];

        $dataSeriesValues = [];

        if ($isMD) {

        } else {
            $xAxisTickValues = new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$1:$A$' . strval(count($chartData)) . '', null, count($chartData));
            $dataSeriesValues = new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$1:$B$'. strval(count($chartData)) . '', null, count($chartData));
        }
        
        if ($chartType == 'line') {
            $chartType = DataSeries::TYPE_LINECHART;
        } else if ($chartType == 'bar-v') {
            $chartType = DataSeries::TYPE_BARCHART;
        } else if ($chartType == 'bar-h') {
            $chartType = DataSeries::TYPE_BARCHART;
        } else if ($chartType == 'pie') {
            $chartType = DataSeries::TYPE_PIECHART;
        } else if ($chartType == 'doughnut') {
            $chartType = DataSeries::TYPE_DOUGHNUTCHART;
        }

        $series = new DataSeries(
            $chartType,
            null,
            range(0, count($dataSeriesValues) - 1),
            [],
            $xAxisTickValues,
            $dataSeriesValues
        );

        $layout = new Layout();

        if ($chartValueFormat == 'per') {
            $layout->setShowPercent(true);
        } else {
            $layout->setShowVal(true);
        }
        $plotArea = new PlotArea($layout, [$series]);
        $legend = new Legend(Legend::POSITION_BOTTOM, null, false);
        $title = new Title($chartTitle);
        $chart = new Chart(
            $chartTitle, 
            $title, 
            $legend, 
            $plotArea, 
            true, 
            0, 
            null, 
            null   
        );

        if (empty($chartPosition)) {
            $chartPosition = array('H8', 'N24');
        }
        
        $chart->setTopLeftPosition($chartPosition[0]);
        $chart->setBottomRightPosition($chartPosition[1]);
        
        $worksheet->addChart($chart);
        
        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);
        $writer->save(public_path("$chartType-$chartTitle.xlsx"));

    }
}
