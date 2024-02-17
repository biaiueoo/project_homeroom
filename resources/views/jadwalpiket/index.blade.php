@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Jadwal Piket')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('jadwalpiket.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>
                <table class="table table-hover table-bordered 
table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>tanggal</th>
                            <th>Hari</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwalpiket as $key => $jp)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $jp->fsiswa->nama_lengkap }}</td>
                            <td>{{ $jp->tahun_ajaran }}</td>
                            <td>{{ $jp->semester }}</td>
                            <td>{{ $jp->tanggal }}</td>
                            <td>{{ $jp->hari }}</td>
                            <td>
                                <a href="{{ route('jadwalpiket.edit', $jp) }}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{ route('jadwalpiket.destroy', $jp) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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