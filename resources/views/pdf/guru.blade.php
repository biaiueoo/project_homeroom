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
    <h2 class="judul">DAFTAR GURU</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Guru</th>
                <th>No Telepon</th>
                <th>Jenis Kelamin</th>

            </tr>
        </thead>
        <tbody>
            @php $counter = 1 @endphp
            @foreach ($guru as $g)
            <tr>
                <td class="a">{{ $counter }}</td>
                <td class="b">{{ $g->nip }}</td>
                <td class="c">{{ $g->nama_guru }}</td>
                <td class="d">{{ $g->notelp }}</td>
                <td class="d"> @if($g->jk == 'L')
                                    Laki-laki
                                    @else
                                    Perempuan
                                    @endif</td>
            </tr>
            @php $counter++ @endphp
            @endforeach

            <!-- Tambahkan baris tambahan sesuai kebutuhan -->
        </tbody>
    </table>
</body>

</html>