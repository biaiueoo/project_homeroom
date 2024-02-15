@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Kelas')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('kelas.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>
                <table class="table table-hover table-bordered 
table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Id Kelas</th>
                            <th>Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $key => $k)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $k->id }}</td>
                            <td>{{ $k->kelas }}</td>
                            <td>{{ $k->fkompetensi->kompetensi_keahlian }}</td>
                            <td>
                                <a href="{{ route('kelas.edit', $k) }}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{ route('kelas.destroy', $k) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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