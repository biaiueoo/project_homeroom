@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Jadwal')
@section('main')
    @include('dashboard.main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('jadwal.create') }}" class="btn 
btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Guru</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Mata Pelajaran</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Jam</th>
                                <th>Hari</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $key => $j)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $j->fguru->nama_guru }}</td>
                                    <td>{{ $j->fkelas->kelas }}</td>
                                    <td>{{ $j->fkompetensi->kompetensi_keahlian }}</td>
                                    <td>{{ $j->fmapel->mata_pelajaran }}</td>
                                    <td>{{ $j->tahun_ajaran }}</td>
                                    <td>{{ $j->semester }}</td>
                                    <td>{{ $j->jam }}</td>
                                    <td>{{ $j->hari }}</td>
                                    <td>
                                        <a href="{{ route('jadwal.edit', $j) }}" class="btn btn-primary btn-xs">
                                            Edit
                                        </a>
                                        <a href="{{ route('jadwal.destroy', $j) }}"
                                            onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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