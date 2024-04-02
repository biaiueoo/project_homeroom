<!-- resources/views/dashboard/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Presentase Sosial</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Grafik Presentase Sosial</h1>

    <canvas id="myChart"></canvas>

    <script>
        // Ambil data dari controller
        var data = @json($data);

        // Menyiapkan label dan data untuk grafik
        var labels = data.map(item => item.pekerjaan_ortu);
        var jumlahOrangTua = data.map(item => item.total);

        // Membuat diagram grafis dengan Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
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
    </script>
</body>
</html>
