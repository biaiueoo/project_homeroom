<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .widget-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .widget {
            width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>Dashboard</h1>

    <div class="widget-container">
        <div class="widget">
            <h2>Grafik Presentase Sosial</h2>
            <canvas id="chartPresentaseSosial"></canvas>
        </div>

        <div class="widget">
            <h2>Grafik Status Kasus</h2>
            <canvas id="chartStatusKasus"></canvas>
        </div>
    </div>

    <script>
        // Ambil data dari controller untuk grafik presentase sosial
        var dataPresentase = @json($dataPresentase);

        // Menyiapkan label dan data untuk grafik presentase sosial
        var labelsPresentase = dataPresentase.map(item => item.pekerjaan_ortu);
        var jumlahOrangTua = dataPresentase.map(item => item.total);

        // Membuat diagram grafis dengan Chart.js untuk grafik presentase sosial
        var ctxPresentase = document.getElementById('chartPresentaseSosial').getContext('2d');
        var chartPresentase = new Chart(ctxPresentase, {
            type: 'bar',
            data: {
                labels: labelsPresentase,
                datasets: [{
                    label: 'Jumlah Orang Tua',
                    data: jumlahOrangTua,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Ambil data dari controller untuk grafik status kasus
        var dataStatusKasus = @json($dataStatusKasus);

        // Menyiapkan label dan data untuk grafik status kasus
        var labelsStatus = dataStatusKasus.map(item => item.status);
        var jumlahKasus = dataStatusKasus.map(item => item.total);

        // Membuat diagram grafis dengan Chart.js untuk grafik status kasus
        var ctxStatusKasus = document.getElementById('chartStatusKasus').getContext('2d');
        var chartStatusKasus = new Chart(ctxStatusKasus, {
            type: 'bar',
            data: {
                labels: labelsStatus,
                datasets: [{
                    label: 'Jumlah Kasus',
                    data: jumlahKasus,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>