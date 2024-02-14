@extends('adminlte::page')
@section('title', 'List Jadwal')
@section('content_header')
<h1 class="m-0 text-dark">Daftar Rapot </h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('daftarrapot.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>tanggal</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>TTD</th>
                                <th>keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarrapot as $key => $dr)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $dr->fsiswa->nama_lengkap }}</td>
                                <td>{{ $dr->tanggal }}</td>
                                <td>{{ $dr->semester }}</td>

                                <td>{{ $dr->tahun_ajaran }}</td>
                                <td>
                                    <div>
                                        @if (Str::endsWith($dr->original_file_name, ['.pdf', '.doc', '.docx']))
                                        <i class="fas fa-file-alt fa-2x"></i>
                                        <p>{{ $dr->original_file_name }}</p>
                                        @else
                                        <img src="{{ asset("storage/{$dr->bukti_ttd}") }}" alt="{{ $dr->original_file_name }} tidak tampil" class="img-thumbnail" style="max-width: 100px;">
                                        @endif


                                    </div>


                                </td>

                                <td>{{ $dr->keterangan }}</td>

                                <td>
                                    <a href="{{ route('daftarrapot.edit', $dr) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('daftarrapot.destroy', $dr) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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
@push('js')
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
@endpush