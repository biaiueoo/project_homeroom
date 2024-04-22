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
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Dua kolom dengan lebar yang sama */
        gap: 30px; /* Jarak antar widget */
        margin-top: 20px;
    }

    .widget {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<div class="widget-container">
    <div class="widget">
        <h2>Grafik Presentase Sosial</h2>
        <canvas id="chartPresentaseSosial" style="width: 100%;"></canvas>
    </div>

    <div class="widget">
        <h2>Grafik Status Kasus</h2>
        <canvas id="chartStatusKasus" style="width: 100%;"></canvas>
    </div>
</div>

<div class="widget-container">
    <div class="widget">
        <h2>Data Struktur Organisasi</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataStrukturOrganisasi as $struktur)
                <tr>
                    <td>{{ $struktur->nama }}</td>
                    <td>{{ $struktur->jabatan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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