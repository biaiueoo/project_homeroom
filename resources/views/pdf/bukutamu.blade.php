<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .judul {
            font-size: 12px;
            color: white;
            text-align: center;
            background-color: #008DDA;
            padding: 6px;
            font-family: Calibri, sans-serif;
            font-weight: bold;
            margin-bottom: 5;
        }

        .s {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin-left: 480px;
            margin-top: 20;
            margin-bottom: 0;
        }

        .tp {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin-left: 480px;
            margin-top: 2;
            margin-bottom: 0;
        }

        .kp {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin-top: 10px;
            margin-left: 40;
            margin-bottom: -100;
        }

        .k {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin-top: 10px;
            margin-left: 28;
            margin-bottom: -300;
            padding: 12;


        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            font-family: Calibri, sans-serif;
            font-size: 11px;
        }

        th {
            background-color: #008DDA;
            color: white;
            font-size: 11px;
            padding: 5px;
        }

        .a .b,
        .c,
        .d {
            padding: 8px;
            font-family: Calibri, sans-serif;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h2 class="judul">BUKU TAMU ORANG TUA/WALI PESERTA DIDIK</h2>

    <p class="kp">Kelas : {{ $bukutamu[0]->fsiswa->fkelas->kelas }} </p>
    <p class="k">Kompetensi : {{ $bukutamu[0]->fsiswa->fkompetensi->kompetensi_keahlian }}</p>

    <p class="s">Semester : {{ $bukutamu[0]->semester }}</p>
    <p class="tp">Tahun Pelajaran : {{ $bukutamu[0]->tahun_ajaran }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Peserta Didik</th>
                <th>Keperluan</th>
                <th>Dokumentasi</th>
                <th>Nama Orang Tua</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1 @endphp
            @foreach ($bukutamu as $b)
            <tr>
                <td class="a">{{ $counter }}</td>
                <td class="b">{{ $b->tanggal }}</td>
                <td class="c">{{ $b->fsiswa->nama_lengkap }}</td>
                <td class="d">{{ $b->keperluan }}</td>
                <td>
                    <!-- {{ $b->hasil }} -->
                    foto
                </td>

                <td>{{ $b->fsiswa->nama_ayah}}</td>
            </tr>
            @php $counter++ @endphp
            @endforeach

            <!-- Tambahkan baris tambahan sesuai kebutuhan -->
        </tbody>
    </table>
</body>

</html>