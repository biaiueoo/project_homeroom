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
            margin-bottom: 0;
        }

        .tp {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            text-align: center;
            margin-top: 0;
        }

        .kp {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 0;
        }

        .k {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            margin-top: 2px;
        }

        .day-table {
            float: left;
            width: 30%;
            margin-right: 20px;
        }

        .day-table-2 {
            float: left;
            margin-top: 260px;
            margin-left: 2px;
            width: 30%;
            clear: left;
            /* Menggunakan clear: left untuk memastikan .day-table-2 muncul di bawah semua elemen sebelumnya */
        }

        .day-table-3 {
            float: left;
            margin-top: 260px;
            margin-left: 237px;
            width: 30%;
            clear: left;
            /* Menggunakan clear: left untuk memastikan .day-table-2 muncul di bawah semua elemen sebelumnya */
        }



        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 2px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
            border: 2px solid black;
            font-size: 12px;
        }

        th {
            background-color: #008DDA;
            color: white;
            font-size: 11px;
            padding: 5px;
        }



        /* th.double-column,
        td.double-column {
            width: 50%;
        } */

        th.spacer,
        td.spacer {
            display: none;
        }

        td:last-child {
            border-right: none;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr:first-child td,
        tbody tr td:first-child {
            border: 2px solid black;
            padding: 5px;
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
            margin-left: 500px;
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
    </style>
</head>

<body>
    <!-- Data judul, tahun ajaran, kompetensi keahlian, dan kelas -->
    <h2 class="judul">JADWAL KEGIATAN PIKET KELAS</h2>
    <p class="tp">TAHUN PELAJARAN {{ $jadwalpiket[0]->tahun_ajaran }}</p>
    <p class="kp">Kompetensi Keahlian : {{ $jadwalpiket[0]->fsiswa->fkompetensi->kompetensi_keahlian }}</p>
    <p class="k">Kelas : {{ $jadwalpiket[0]->fsiswa->fkelas->kelas }}</p>

    <!-- Tabel untuk setiap hari -->
    <div class="day-table">
        <!-- <h3 class="judul">Senin</h3> -->
        <table>
            <thead>
                <tr>
                    <th class="double-column">NO</th>
                    <th class="double-column">SENIN</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1 @endphp
                @foreach ($jadwalpiket as $jp)
                @if ($jp->hari === 'Senin')
                <tr>
                    <td>{{ $counter }}</td>
                    <td>{{ $jp->fsiswa->nama_lengkap }}</td>
                </tr>
                @php $counter++ @endphp
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="day-table">
        <!-- <h3 class="judul">Selasa</h3> -->
        <table>
            <thead>
                <tr>
                    <th class="double-column">NO</th>
                    <th class="double-column">SELASA</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1 @endphp
                @foreach ($jadwalpiket as $jp)
                @if ($jp->hari === 'Selasa')
                <tr>
                    <td>{{ $counter }}</td>
                    <td>{{ $jp->fsiswa->nama_lengkap }}</td>
                </tr>
                @php $counter++ @endphp
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="day-table">
        <!-- <h3 class="judul">Rabu</h3> -->
        <table>
            <thead>
                <tr>
                    <th class="double-column">NO</th>
                    <th class="double-column">RABU</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1 @endphp
                @foreach ($jadwalpiket as $key => $jp)
                @if ($jp->hari === 'Rabu')
                <tr>
                    <td>{{ $counter }}</td>

                    <td>{{ $jp->fsiswa->nama_lengkap }}</td>
                </tr>
                @php $counter++ @endphp
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="day-table-2">
        <!-- <h3 class="judul">Rabu</h3> -->
        <table>
            <thead>
                <tr>
                    <th class="double-column">NO</th>
                    <th class="double-column">KAMIS</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1 @endphp
                @foreach ($jadwalpiket as $key => $jp)
                @if ($jp->hari === 'Kamis')
                <tr>
                    <td>{{ $counter }}</td>

                    <td>{{ $jp->fsiswa->nama_lengkap }}</td>
                </tr>
                @php $counter++ @endphp
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="day-table-3">

        <table>
            <thead>
                <tr>
                    <th class="double-column">NO</th>
                    <th class="double-column">JUMAT</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1 @endphp
                @foreach ($jadwalpiket as $key => $jp)
                @if ($jp->hari === 'Jumat')
                <tr>
                    <td>{{ $counter }}</td>

                    <td>{{ $jp->fsiswa->nama_lengkap }}</td>
                </tr>
                @php $counter++ @endphp
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

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
        <p>Cibinong,.............20....</p>
        <p>Wali Kelas</p>
        <br>
        <br>
        <br>
        <p>...............................................</p>
        <p>NIP. .......................................</p>
    </div>


</body>

</html>