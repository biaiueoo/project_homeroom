@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Absensi Chart</div>
                <div class="card-body">
                    <canvas id="absensiChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var absensiChartCanvas = document.getElementById("absensiChart").getContext('2d');

    var absensiChartData = {
        labels: @json($absensi->pluck('status')),
        datasets: [{
            label: 'Jumlah',
            data: @json($absensi->pluck('total')),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1

            
        }]
    };

    var absensiChartOptions = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    var absensiChart = new Chart(absensiChartCanvas, {
        type: 'bar',
        data: absensiChartData,
        options: absensiChartOptions
    });
</script>
@endsection
