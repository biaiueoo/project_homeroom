@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Buku Tamu')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('bukutamu.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>
                 <!-- Tombol download PDF -->
                 <a href="{{ route('bukutamu.pdf') }}" class="btn btn-secondary mb-2">
                    Download PDF
                </a>
                <div class="table-responsive">

                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Keperluan</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Dokumentasi</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukutamu as $key => $bt)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $bt->fsiswa->nama_lengkap }}</td>
                                <td>{{ $bt->tanggal }}</td>
                                <td>{{ $bt->keperluan }}</td>
                                <td>{{ $bt->semester }}</td>
                                <td>{{ $bt->tahun_ajaran }}</td>

                                <td>
                                    <img src="{{ asset("storage/{$bt->hasil}") }}" alt="{{ $bt->hasil }} tidak tampil" class="img-thumbnail" width="200">
                                </td>
                                <td>
                                    <a href="{{ route('bukutamu.edit', $bt) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('bukutamu.destroy', $bt) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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