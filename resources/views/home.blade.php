@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Dashboard</h2>
                    </div>
                    <div class="panel-body">
                        Selamat Datang dimenu Administrasi
                        <hr>
                        <h4>Statistik Layanan</h4>
                        <canvas id="chartUjiriksa" width="600" height="290"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src= {{ asset('js/chart.min.js') }}></script>
<script>
    var year = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var hydro = {!! $hydros !!}
    var visual = {!! $visuals !!}
    var servicet = {!! $servicets !!}
    var servicea = {!! $serviceas !!}
    console.log(hydro);

    var data = {
        labels: year,
        datasets: [{
            label:'Hydrostatic',
            data: hydro,
            backgroundColor: "rgba(151,187,205,0.5)",
            borderColor: "rgba(151,187,205,0.5)",
            borderWidth: 2,
        },
        {
            label:'Visualstatic',
            data: visual,
            backgroundColor: "rgba(205, 152, 152, 0.5)",
            borderColor: "rgba(151,187,205,0.5)",
            borderWidth: 2,
        },
        {
            label:'Service Tabung',
            data: servicet,
            backgroundColor: "rgba(154, 205, 152, 0.5)",
            borderColor: "rgba(151,187,205,0.5)",
            borderWidth: 2,
        }
        ,{
            label:'Service Alat',
            data: servicea,
            backgroundColor: "rgba(197, 152, 205, 0.5)",
            borderColor: "rgba(151,187,205,0.5)",
            borderWidth: 2,
        }]
    };
    console.log(data);
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    stepSize: 25
                }
            }]
        }
    };

    var ctx = document.getElementById("chartUjiriksa").getContext("2d");

    var authorChart = new Chart(ctx, {
        type: 'line', 
        data: data,
        options: options
    });
</script>
@endsection
