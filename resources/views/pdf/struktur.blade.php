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

        .signature {
            clear: both;
            margin-top: 20px;
            text-align: left;
            font-family: Calibri, sans-serif;
            font-size: 12px;
        }

        .signature-2 {
            clear: both;
            margin-top: -100px;
            margin-left: 1400px;
            text-align: left;
            font-family: Calibri, sans-serif;
            font-size: 12px;
        }

        .signature p {
            margin: 0;
        }

        .signature-2 p {
            margin: 0;
        }

        .red-column {
            background-color: greenyellow;
            /* Warna latar belakang merah */
            color: white;
            /* Warna teks putih untuk kontras */
        }
    </style>
</head>

<body>
    <h2 class="judul">STRUKTUR ORGANISASI KELAS</h2>


    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($struktur as $a)
            <tr>
                <td class="a">{{ $a->nama }}</td>
                <td class="b">{{ $a->jabatan}}</td>

            </tr>

            @endforeach

            <!-- Tambahkan baris tambahan sesuai kebutuhan -->
        </tbody>
    </table>

    <div class="signature">
        <p>Mengetahui,</p>
        <p>Waka. Bidang Akademik</p>
        <br>
        <br>
        <br>
        <p>...............................................</p>
        <p>NIP. .......................................</p>
    </div>

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