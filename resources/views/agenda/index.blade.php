@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Agenda Kegiatan')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('agenda.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>

                <a href="{{ route('agenda.pdf') }}" class="btn btn-secondary mb-2">
                    Download PDF
                </a>
                <div class="table-responsive">

                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <tr>
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Hari</th>
                            <th>Tanggal</th>
                            <th>Nama Kegiatan</th>
                            <th>Waktu</th>
                            <th>Dokumentasi</th>
                            <th>Keterangan</th>

                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda as $key => $a)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $a->fkelas->kelas }}</td>
                                <td>{{ $a->fkompetensi->kompetensi_keahlian }}</td>
                                <td>{{ $a->semester }}</td>
                                <td>{{ $a->tahun_ajaran }}</td>
                                <td>{{ $a->hari }}</td>
                                <td>{{ $a->tanggal }}</td>
                                <td>{{ $a->nama_kegiatan }}</td>
                                <td>{{ $a->waktu }}</td>
                                <td>
                                    @if ($a->dokumentasi)
                                        <img src="{{ asset("storage/{$a->dokumentasi}") }}" alt="Dokumentasi tidak tampil" class="img-thumbnail" width="200">
                                    @else
                                        <span>Tidak ada dokumentasi</span>
                                    @endif
                                </td>
                                
                                <td>{{ $a->keterangan }}</td>

                                <td>
                                    <a href="{{ route('agenda.edit', $a) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('agenda.destroy', $a) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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