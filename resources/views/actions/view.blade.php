@extends('layouts.app')
@section('content')
<div class="ui grid row">
    <div class="two wide column"></div>
    <div class="twelve wide column card ui">
        <div class="content">
            <div class="header">{{ $action->name }}</div>
            <div class="meta">{{ $action->description }}</div>
            <div class="content">
                <canvas id="graph" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var ctx = document.getElementById("graph");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data:  {
            labels: [
            @foreach ($logs as $log)
            '{{ $log->created_at }}',
            @endforeach
            ],
            datasets: [{
                label: 'Temperatura',
                data: [
                @foreach ($logs as $log)
                '{{ $log->temperature }}',
                @endforeach
                ],
                borderColor: [
                '#4594f2',
                ],
                borderWidth: 3
            }]},
            options: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: false   // minimum value won't be 0.
                    }
                }]
        
            }
        });
    </script>
    @endsection
    