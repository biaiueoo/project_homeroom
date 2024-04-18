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

        .signature-2 {
            clear: both;
            margin-top: 40px;
            margin-left: 500px;
            text-align: left;
            font-family: Calibri, sans-serif;
            font-size: 12px;
        }

        .signature-2 p {
            margin: 0;
        }
    </style>
</head>

<body>
    <h2 class="judul">AGENDA KEGIATAN WALI KELAS</h2>

    <p class="kp">Kelas : {{ $agenda[0]->fkelas->kelas }} </p>
    <p class="k">Kompetensi : {{ $agenda[0]->fkompetensi->kompetensi_keahlian }}</p>

    <p class="s">Semester : {{ $agenda[0]->semester }}</p>
    <p class="tp">Tahun Pelajaran : {{ $agenda[0]->tahun_ajaran }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Hari/Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Waktu Didik</th>
                <th>Dokumentasi</th>
                <th>Ket</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1 @endphp
            @foreach ($agenda as $a)
            <tr>
                <td class="a">{{ $counter }}</td>
                <td class="b">{{ $a->hari }}, {{ $a->tanggal}}</td>
                <td class="c">{{ $a->nama_kegiatan }}</td>
                <td class="d">{{ $a->waktu }}</td>
                <td class="d">
                    <!-- {{ $a->dokumentasi }} -->
                    dokumentasi
                </td>
                <td class="d">{{ $a->keterangan }}</td>
            </tr>
            @php $counter++ @endphp
            @endforeach

            <!-- Tambahkan baris tambahan sesuai kebutuhan -->
        </tbody>
    </table>

    <div class="signature-2">
        <p>Cibinong,.......,...............20....</p>
        <p>Wali Kelas</p>
        <br>
        <br>
        <br>
        <p>...............................................</p>
        <p>NIP. .......................................</p>
    </div>
</body>

</html>