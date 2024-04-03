@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Presentase Ekonomi Sosial')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('presentase.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>
                 {{-- <!-- Tombol download PDF -->
                 <a href="{{ route('bukutamu.pdf') }}" class="btn btn-secondary mb-2">
                    Download PDF
                </a> --}}
                <div class="table-responsive">

                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Pekerjaan Orang Tua</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presentase as $key => $pt)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $pt->fsiswa->nama_lengkap }}</td>
                                <td>{{ $pt->pekerjaan_ortu }}</td>
                                <td>
                                    <a href="{{ route('presentase.edit', $pt) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('presentase.destroy', $pt) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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