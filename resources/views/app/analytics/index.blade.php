@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        .fluidMedia {
            position: relative;
            padding-bottom: 56.25%; /* proportion value to aspect ratio 16:9 (9 / 16 = 0.5625 or 56.25%) */
            padding-top: 30px;
            height: 100vh;
            overflow: visible;
        }

        .fluidMedia iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 991px) {
            .graphical-report__export{
                display:none !important;
            }
        }

        .graphical-report__export {
            height: 25px !important;
            width: 75px !important;
            margin-right: 95px !important;
            padding-top: 2px !important;
            padding-left: 5px !important;
        }

        #chart, #chart-lg, #chart-sm, rect {
            background: #f9f9f9;
        }

        #chart, #chart-lg, #chart-sm {
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eee;
        }
    </style>

    @if($view == "default")
        <script src="//cdn.jsdelivr.net/d3js/3.5.17/d3.min.js" charset="utf-8"></script>
        <script src="//cdn.jsdelivr.net/npm/taucharts@1/build/production/tauCharts.min.js"
                type="text/javascript"></script>
        <link rel="stylesheet" type="text/css"
              href="//cdn.jsdelivr.net/npm/taucharts@1/build/production/tauCharts.min.css">
    @endif
@endsection

@section('content')
    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;">Analytics</h5>
            </div>
            <div class="col-md-12" style="margin-bottom:40px;">
                @if($view == "mixpanel")
                    <div class="fluidMedia">
                        <iframe src="/app/analytics/{{$view}}" frameborder="0" style="min-height:100%;">
                        </iframe>
                    </div>
                @endif
                @if($view == "default")
                    <div id="chart" style="height:500px;min-height:calc(100vh - 180px);"></div>
                    <script>
                        var datasource = [
                            <?php
                            $count = 1;
                            foreach ($analytics as $eventType => $collection) {
                                foreach ($collection as $date => $events) {
                                    //foreach($events as $event){
                                    $newDate = \Carbon\Carbon::createFromFormat('m-d-Y', $date)->toDateTimeString();//->format("Y-m-d");
                                    echo "{type:'$eventType', date: '$date', count:" . count($events) . "},";
                                    //}
                                }
                            } ?>
                        ];
                        var chart = new tauCharts.Chart({
                            data: datasource,
                            type: 'line',
                            x: 'date',
                            y: 'count',
                            size: 'count',
                            color: 'type',
                            dimensions: {
                                count: {type: 'measure'},
                                date: {
                                    type: 'measure',
                                    scale: 'time'
                                },
                            },
                            plugins: [
                                tauCharts.api.plugins.get('tooltip')(),
                                tauCharts.api.plugins.get('legend')(),
                                tauCharts.api.plugins.get('quick-filter')(),
                                tauCharts.api.plugins.get('floating-axes')(),
                                tauCharts.api.plugins.get('trendline')(),
                                tauCharts.api.plugins.get('exportTo')({
                                    cssPaths: ['https://cdn.jsdelivr.net/taucharts/latest/tauCharts.min.css']
                                }),
                            ],
                            guide: {
                                interpolate: 'smooth-keep-extremum'
                            }
                        });
                        chart.renderTo('#chart');
                        document.querySelector('#save').addEventListener('click', function (e) {
                         chart.fire('exportTo', 'png');
                         e.preventDefault();
                         });
                    </script>
                @endif
            </div>
        </div>
    </main>

@endsection