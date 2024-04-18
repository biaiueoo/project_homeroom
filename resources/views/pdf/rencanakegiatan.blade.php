<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rencana Kegiatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #008DDA;
            color: white;
        }

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
            background-color: greenyellow; /* Warna latar belakang merah */
            color: white; /* Warna teks putih untuk kontras */
        }
      
    </style>
</head>

<body>
<h2 class="judul"> RENCANA KEGIATAN WALI KELAS</h2>
 
    <table border="1">
    <thead>
        <tr>
        <th rowspan="2">No.</th>    
        <th rowspan="2">Uraian Kegiatan</th>
            <th colspan="20">Pelaksanaan Kegiatan Minggu ke</th>
            <th rowspan="2">Bukti Fisik</th>
            
        </tr>
        <tr>
            @for ($week = 1; $week <= 20; $week++)
                <th>{{ $week }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
    @php $counter = 1 @endphp
        @foreach ($rencanaKegiatan as $item)
            <tr>
            <td>{{ $counter }}</td>
                <td>{{ $item->fkegiatan->nama }}</td>
                @for ($week = 1; $week <= 20; $week++)
                <td class="{{ in_array($week, explode(',', $item->minggu_ke)) ? 'red-column' : '' }}">
                        <!-- Tampilkan data sel atau kosongkan sel -->
                    </td>
                @endfor
                <td>{{ $item->fbukti->bukti }}</td>
               
            </tr>
            @php $counter++ @endphp
        @endforeach
    </tbody>
    

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


</html>