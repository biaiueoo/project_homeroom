<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: legal;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }

        .logo {
            width: 20%;
            /* Lebar kolom kiri */
        }

        .dinas {
            width: 70%;
            /* Lebar kolom kiri */
        }

        .jenis {
            width: 40%;
            /* Lebar kolom kiri */
        }

        .right-column {
            width: 60%;
            /* Lebar kolom kanan */
        }

        /* Menggabungkan sel untuk baris pertama di kolom kiri */
        .merge-cell {
            vertical-align: top;
            /* Penyusunan teks di atas */
        }

        .judul {
            font-size: 14px;
            text-align: center;
            padding: 6px;
            font-weight: bold;
            margin-bottom: 5;
        }

        .content {
            margin-top: 30px;
            margin-left: 20px;
        }

        .detail-item {
            margin-bottom: 10px;
            text-indent: -10px;
        }

        .detail-item strong {
            display: inline-block;
            width: 150px;
        }

        .detail-item::before {
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        .tgl-surat {
            font-size: 12px;
            text-align: right;
            padding: 40px;
        }

        .signature table {
            border: none;
            /* Menghapus border pada tabel */
        }

        .signature th,
        .signature td {
            border: none;
            /* Menghapus border pada sel tabel */
            padding: 6px;
            /* Atur padding sesuai kebutuhan */
            text-align: center;
            /* Atur alignment teks sesuai kebutuhan */
        }

        .mengetahui {
            padding: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <!-- Kolom kiri (6 baris ke bawah) -->
            <td class="logo" rowspan="4">
            </td>
            <td class="dinas" rowspan="4" alig>
                <center><strong>PEMERINTAH PROVINSI</strong><br>
                    <strong>JAWA BARAT</strong><br>
                    <strong>DINAS PENDIDIKAN</strong><br>
                    <strong>SMK NEGERI 1 CIBINONG</strong><br>
                </center>
            </td>
            <td class="jenis" rowspan="4">
                <strong>
                    <center>HOME VISIT</center>
                </strong>
            </td>
            <!-- Baris pertama di kolom kanan -->
            <td class="right-column">Kode Dok</td>
            <td class="right-column">CON.TOH.KODE</td>
        </tr>
        <tr>
            <!-- Baris kedua di kolom kanan -->
            <td class="right-column">Revisi</td>
            <td class="right-column">-</td>
        </tr>
        <tr>
            <!-- Baris ketiga di kolom kanan -->
            <td class="right-column">Tanggal terbit</td>
            <td class="right-column">{{ date('d/m/Y') }}</td> <!-- Menampilkan tanggal saat ini -->
        </tr>
        <tr>
            <!-- Baris keempat di kolom kanan -->
            <td class="right-column">Halaman</td>
            <td class="right-column">1 dari 1</td>
        </tr>
    </table>

    <h2 class="judul">KUNJUNGAN RUMAH (HOME VISIT)</h2>
    <div class="content">
        <div class="detail-item">
            <strong>NAMA</strong>: {{ $kunjunganRumah->fkasus->fsiswa->nama_lengkap }}
        </div>
        <div class="detail-item">
            <strong>NIS</strong>: {{ $kunjunganRumah->fkasus->fsiswa->nis }}
        </div>
        <div class="detail-item">
            <strong>KELAS</strong>: {{ $kunjunganRumah->fkasus->fsiswa->fkelas->kelas }}
        </div>
        <div class="detail-item">
            <strong>PROGRAM KEAHLIAN</strong>: {{ $kunjunganRumah->fkasus->fsiswa->fkompetensi->kompetensi_keahlian }}
        </div>
        <div class="detail-item">
            <strong>ALAMAT</strong>: {{ $kunjunganRumah->fkasus->fsiswa->alamat }}
        </div>
        <div class="detail-item">
            <strong>WAKTU KUNJUNGAN</strong>: {{ $kunjunganRumah->tanggal }}
        </div>
    </div>

    <div class="tgl-surat">CIBINONG, {{ $kunjunganRumah->tanggal }}</div>

    <div class="signature">
        <table class="signature">
            <tr>
                <td>
                    WALI KELAS<br><br><br><br><br>
                </td>
                <td>
                    ORANG TUA SISWA<br><br><br><br><br>
                </td>
            </tr>
            <tr>
                <td>(................................)</td>
                <td>(................................)</td>
            </tr>
        </table>
    </div>

    <div class="mengetahui">MENGETAHUI,</div>

    <div class="signature">
        <table class="signature">
            <tr>
                <td>
                    BP/BK<br><br><br><br><br>
                </td>
                <td>
                    WAKASEK BID KESISWAAN,<br><br><br><br><br>
                </td>
            </tr>
            <tr>
                <td>(................................)</td>
                <td>(................................)</td>
            </tr>
        </table>
    </div>

</body>

</html>