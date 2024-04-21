@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Siswa')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Tombol Tambah -->
                    <div>
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah</a>

                        <!-- Tombol untuk memunculkan formulir import -->
                        <button id="showImportForm" class="btn btn-primary mb-2">Import Siswa</button>

                        <!-- Formulir untuk unggah file (awalnya tersembunyi) -->
                        <form action="{{ route('siswa-import') }}" method="POST" enctype="multipart/form-data" id="importForm" style="display: none;">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Pilih file Excel</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Import Siswa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tombol Export Excel dan Download PDF -->
                    <div>
                        <a href="{{ route('export.siswa') }}" class="btn btn-info mr-2">Export Excel File</a>
                        <a href="{{ route('siswa.pdf') }}" class="btn btn-secondary">Download PDF</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Tempat Lahir</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Kewarganegaraan</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th>NISN</th>
                                <th>Tahun Masuk</th>
                                <th>Alamat Orang Tua</th>
                                <th>No. Orang Tua</th>
                                <th>Nama Sekolah Asal</th>
                                <th>Alamat Sekolah</th>
                                <th>Tahun Lulus</th>
                                <th>Riwayat Penyakit</th>
                                <th>Alergi</th>
                                <th>Prestasi Akademik</th>
                                <th>Prestasi Non-Akademik</th>
                                <th>Ekstrakurikuler</th>
                                <th>Biografi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $key => $s)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $s->nis }}</td>
                                <td>{{ $s->nama_lengkap }}</td>
                                <td>{{ $s->fkelas->kelas }}</td>
                                <td>{{ $s->fkompetensi->kompetensi_keahlian }}</td>
                                <td>{{ $s->nama_ayah }}</td>
                                <td>{{ $s->nama_ibu }}</td>
                                <td>{{ $s->tempat_lahir }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td>{{ $s->agama }}</td>
                                <td>{{ $s->kewarganegaraan }}</td>
                                <td>{{ $s->no_hp }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->nisn }}</td>
                                <td>{{ $s->tahun_masuk }}</td>
                                <td>{{ $s->alamat_ortu }}</td>
                                <td>{{ $s->no_ortu }}</td>
                                <td>{{ $s->nama_sekolah_asal }}</td>
                                <td>{{ $s->alamat_sekolah }}</td>
                                <td>{{ $s->tahun_lulus }}</td>
                                <td>{{ $s->riwayat_penyakit }}</td>
                                <td>{{ $s->alergi }}</td>
                                <td>{{ $s->prestasi_akademik }}</td>
                                <td>{{ $s->prestasi_non_akademik }}</td>
                                <td>{{ $s->ekstrakurikuler }}</td>
                                <td>{{ $s->biografi }}</td>
                                <td>
                                    <a href="{{ route('siswa.edit', $s) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('siswa.destroy', $s) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@stop

<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script>
    $('#example2').DataTable({
        "responsive": true,
    });

    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#showImportForm').click(function() {
            $('#importForm').toggle(); // Menampilkan/menyembunyikan formulir import
        });

        // Reset formulir saat ditutup (misalnya, setelah unggah selesai)
        $('#importForm').submit(function() {
            $(this).hide(); // Sembunyikan formulir setelah submit
        });

        // Mengatur label custom file saat file dipilih
        $('#customFile').change(function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>