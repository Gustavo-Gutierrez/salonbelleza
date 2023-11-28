@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}
                <hr />
                    <h1>{{ $chart2->options['chart_title'] }}</h1>
                    {!! $chart2->renderHtml() !!}
                
                </div>

            </div>
        </div>
    </div>
    {!! $chart1->renderChartJsLibrary() !!}
    
{!! $chart1->renderJs() !!}
{!! $chart2->renderJs() !!}
</div>
@endsection

@section('content')

@endsection