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
            padding: 5px;
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
            font-weight: bold;
            /* Increased margin for spacing */
        }

        .content {
            margin-top: 30px;
            margin-left: 20px;
        }

        .paragraf {
            text-align: justify;
            margin-bottom: 5px;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-item strong {
            display: inline-block;
            width: 150px;
            font-weight: normal;
        }

        .tgl-surat {
            font-size: 12px;
            text-align: right;
            margin-right: 0;
            padding: 10px;
        }

        .signature table {
            border: none;
            /* Menghapus border pada tabel */
        }

        .signature th,
        .signature td {
            border: none;
            width: 30px;
            text-align: center;
            padding: 10px;
            /* Atur alignment teks sesuai kebutuhan */
        }

        .mengetahui {
            padding: 10px;
            text-align: center;
        }

        .sp {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            margin-left: 0;
            padding: 0;

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
                    <center>PERJANJIAN SISWA</center>
                </strong>
            </td>
            <!-- Baris pertama di kolom kanan -->
            <td class="right-column">Kode Dok</td>
            <td class="right-column">DF.KS.ID</td>
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

    <h2 class="judul">SURAT PERJANJIAN SISWA</h2>
    <div class="sp">SP : 1 / 2 / 3 </div>
    <div class="content">
        <div class="paragraf">
            Yang bertanda tangan dibawah ini :
        </div>
        <div class="detail-item">
            <strong>Nama</strong>: .................................................................................................................................................................................
        </div>
        <div class="detail-item">
            <strong>NIS</strong>: .................................................................................................................................................................................
        </div>
        <div class="detail-item">
            <strong>Kelas/Kompetensi Keahlian</strong>: .................................................................................................................................................................................
        </div>
        <div class="detail-item">
            <strong>Alamat</strong>: .................................................................................................................................................................................
        </div>
        <div class="detail-item">
            <strong></strong> .................................................................................................................................................................................
        </div>
        <div class="detail-item">
            <strong>Kasus</strong>: .................................................................................................................................................................................
        </div>
        <div class="detail-item">
            <strong>Pelanggaran yang dilakukan</strong>: .................................................................................................................................................................................
        </div>
        <div class="paragraf">
            Pada hari ini .......... Tanggal ........ Bulan ................. Tahun .......... di hadapan Wali Kelas, Pembina Siswa/Pembina OSIS/BP/BK,
            <br>Waka Kesiswaan dan orang tua siswa berjanji:
        </div>
        <div class="paragraf">
            1. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            2. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            3. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            4. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            5. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            6. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            7. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            8. ...............................................................................................................................................................................................................................
        </div>
        <div class="paragraf">
            9. ...............................................................................................................................................................................................................................
        </div>
    </div>

    <div class="tgl-surat">CIBINONG, {{ date('d/m/Y') }}</div>

    <div class="signature">
        <table class="signature">
            <tr>
                <td>
                    Orang Tua Siswa,<br><br><br>
                </td>
                <td>
                    Siswa,<br><br><br>
                </td>
            </tr>
            <tr>
                <td>(................................)</td>
                <td>(................................)</td>
            </tr>
        </table>
    </div>

    <div class="signature">
        <table class="signature">
            <tr>
                <td>
                    BP/BK/Pembina Siswa,<br><br><br>
                </td>
                <td>
                    Wali Kelas,<br><br><br>
                </td>
            </tr>
            <tr>
                <td>(................................)</td>
                <td>(................................)</td>
            </tr>
        </table>
    </div>
    <div class="signature">
        <table class="signature">
            <tr>
                <td>
                    Wakasek Bid. Kesiswaan,<br><br><br><br>
                </td>
            </tr>
            <tr>
                <td><b>Iyan Tardiana, S.Pd.</b><br>
                    NIP 197306122005011009</td>
            </tr>
        </table>
    </div>

</body>

</html>