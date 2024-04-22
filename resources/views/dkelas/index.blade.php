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
                <!-- <a href="{{route('dkelas.create')}}" class="btn 
btn-primary mb-2">
                    Tambah
                </a> -->
                <h4 class="card-title">{{ $kelas }}</h4>
                <table class="table table-hover table-bordered 
table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>NIS</th>
                        <th>Nama Siswa</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dkelas as $key => $dk)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$dk->fkelas->kelas}}</td>
                            <td>{{$dk->fsiswa->nis}}</td>
                            <td>{{$dk->fsiswa->nama_lengkap}}</td>
                            <td>
                                <a href="{{route('kelas.index')}}" class="btn btn-success btn-xs">
                                    Back
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