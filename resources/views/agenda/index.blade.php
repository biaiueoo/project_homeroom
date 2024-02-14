@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Agenda')
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
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                               
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Keterangan</th>
                                <th>Hasil</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agenda as $key => $a)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $a->fkelas->kelas }}</td>
                                    <td>{{ $a->fkompetensi->kompetensi_keahlian }}</td>
                                    <td>{{ $a->hari }}</td>
                                    <td>{{ $a->tanggal }}</td>
                                    <td>{{ $a->waktu }}</td>
                                    
                                    <td>{{ $a->semester }}</td>
                                    <td>{{ $a->tahun_ajaran }}</td>
                                    <td>{{ $a->keterangan }}</td>
                                    <td>
                                    <img src="{{ asset("storage/{$bt->hasil}") }}" alt="{{ $bt->hasil }} tidak tampil" class="img-thumbnail" width="200">
                                </td>
                                    <td>
                                        <a href="{{ route('agenda.edit', $a) }}" class="btn btn-primary btn-xs">
                                            Edit
                                        </a>
                                        <a href="{{ route('agenda.destroy', $a) }}"
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