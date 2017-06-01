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
                        <h4>Statistik Form Ujiriksa</h4>
                        <canvas id="chartUjiriksa" width="400" height="150"></canvas>
                        <h4>Statistik Data Customer</h4>
                        <canvas id="chartCust" width="400" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src= {{ asset('js/Chart.min.js') }}></script>
<script>
    var data = {
        labels: {!! json_encode($ujiriksa) !!},
        datasets: [{
            label:'Jumlah Tabung yang Diujikan',
            data: {!! json_encode($tabung) !!},
            backgroundColor: "rgba(151,187,205,0.5)",
            borderColor: "rgba(151,187,205,0.5)",
        }]
    };

    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    stepSize: 1
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
<script>
    var data = {
        labels: {!! json_encode($customers) !!},
        datasets: [{
            label:'Data Tabung Customer',
            data: {!! json_encode($tube) !!},
            backgroundColor: "rgba(151,187,205,0.5)",
            borderColor: "rgba(151,187,205,0.5)",
        }]
    };

    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    stepSize: 1
                }
            }]
        }
    };

    var ctx = document.getElementById("chartCust").getContext("2d");

    var authorChart = new Chart(ctx, {
        type: 'bar', 
        data: data,
        options: options
    });
</script>
@endsection
