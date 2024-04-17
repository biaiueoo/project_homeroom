<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .judul {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .alamat {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .content {
            margin-top: 30px;
        }

        .detail-item {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="kop-surat">
        <div class="judul">Kantor Pendidikan XYZ</div>
        <div class="alamat">Jl. Pendidikan No. 123, Kota ABC</div>
        <div class="alamat">Telp: (0123) 456789 | Email: info@pendidikanxyz.com</div>
    </div>

    <div class="content">
        <div class="detail-item">
            <strong>No Surat:</strong> {{ $kunjunganRumah->id }}
        </div>
        <div class="detail-item">
            <strong>Tanggal:</strong> {{ $kunjunganRumah->tanggal }}
        </div>
        <div class="detail-item">
            <strong>Nama Peserta Didik:</strong> {{ $kunjunganRumah->fkasus->fsiswa->nama_lengkap }}
        </div>
        <div class="detail-item">
            <strong>Nama Orang Tua:</strong> {{ $kunjunganRumah->fkasus->orang_tua }}
        </div>
        <div class="detail-item">
            <strong>Kasus:</strong> {{ $kunjunganRumah->fkasus->kasus }}
        </div>
        <div class="detail-item">
            <strong>Solusi:</strong> {{ $kunjunganRumah->solusi }}
        </div>
        <div class="detail-item">
            <strong>Dokumentasi:</strong><br>
            <img src="{{ asset('uploads/' . $kunjunganRumah->dokumentasi) }}" alt="{{ $kunjunganRumah->dokumentasi }}" width="200">
        </div>
    </div>
</body>

</html>