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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kasus</th>
                                <th>Nama Siswa</th>
                                <th>Solusi</th>
                                <th>Tanggal</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Dokumentasi</th>
                                <th>Surat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjunganrumah as $key => $kr)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $kr->fkasus->kasus }}</td>
                                <td>{{ $kr->fkasus->fsiswa->nama_lengkap}}</td>
                                <td>{{ $kr->solusi}}</td>
                                <td>{{ $kr->tanggal}}</td>
                                <td>{{ $kr->fkasus->semester }}</td>
                                <td>{{ $kr->fkasus->tahun_ajaran }}</td>
                                <td>
                                    @if($kr->dokumentasi)
                                    <img src="{{ asset('uploads/' . $kr->dokumentasi) }}" alt="{{ $kr->dokumentasi }}" style="max-width: 100px;">
                                    @else
                                    <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td id="fileCell_{{ $kr->id }}">
                                    <!-- Menampilkan file yang sudah diunggah -->
                                    @if ($kr->surat)
                                    <a href="{{ asset("storage/{$kr->surat}") }}" target="_blank">Lihat File</a>
                                    @else
                                    <span id="fileStatus_{{ $kr->id }}">Belum ada file diunggah.</span>
                                    @endif
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