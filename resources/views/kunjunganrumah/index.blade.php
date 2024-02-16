@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Kunjungan Rumah')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('kunjunganrumah.create') }}" class="btn btn-primary mb-2">
                    Tambah
                </a>
                <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kasus</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Solusi</th>
                            <th>Tanggal</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>TTD</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kunjunganrumah as $key => $kr)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $kr->fkasus->kasus }}</td>
                            <td>{{ $kr->fkasus->fsiswa->nama_lengkap}}</td>
                            <td>{{ $kr->fkasus->fsiswa->fkelas->kelas}}</td>
                            <td>{{ $kr->fkasus->fsiswa->fkompetensi->kompetensi_keahlian}}</td>
                            <td>{{ $kr->solusi}}</td>
                            <td>{{ $kr->tanggal}}</td>
                            <td>{{ $kr->fkasus->semester }}</td>
                            <td>{{ $kr->fkasus->tahun_ajaran }}</td>
                            <td>
                                <img src="{{ asset('uploads/' . $komp->ttd) }}" alt="Gambar TTD" width="150">
                            </td>
                            <td>
                                <a href="{{ route('kunjunganrumah.edit', $kr) }}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{ route('kunjunganrumah.destroy', $kr) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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