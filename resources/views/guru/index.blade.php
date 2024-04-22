@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Guru')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <a href="{{ route('guru.create') }}" class="btn btn-primary">Tambah</a>

                        <!-- Tombol untuk memunculkan formulir import -->
                        <button id="showImportForm" class="btn btn-primary mb-2">Import Guru</button>

                        <!-- Formulir untuk unggah file (awalnya tersembunyi) -->
                        <form action="{{ route('guru-import') }}" method="POST" enctype="multipart/form-data" id="importForm" style="display: none;">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Pilih file Excel</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Import guru</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tombol Export Excel dan Download PDF -->
                    <div>
                        <a href="{{ route('export.guru') }}" class="btn btn-info mr-2">Export Excel File</a>
                        <a href="{{ route('guru.pdf') }}" class="btn btn-secondary">Download PDF</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered 
table-stripped" id="example2">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>No Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Agama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guru as $key => $g)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$g->nip}}</td>
                            <td>{{$g->nama_guru}}</td>
                            <td>{{$g->notelp}}</td>
                            <td>
                                @if($g->jk == 'L')
                                Laki-laki
                                @else
                                Perempuan
                                @endif
                            </td>
                            <td>{{$g->alamat}}</td>
                            <td>@switch($g->agama)
                                @case('Islam')
                                Islam
                                @break
                                @case('Hindu')
                                Hindu
                                @break
                                @case('Buddha')
                                Budha
                                @break
                                @case('Katolik')
                                Katolik
                                @break
                                @case('Protestan')
                                Protestan
                                @break
                                @default
                                Lainnya
                                @endswitch</td>
                            <td>{{$g->tempat_lahir}}</td>
                            <td>{{$g->tanggal_lahir}}</td>
                            <td>
                                <a href="{{route('guru.edit', $g)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{ route('guru.destroy', $g) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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