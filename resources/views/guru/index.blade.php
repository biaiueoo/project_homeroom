@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Guru')
@section('main')
@include('dashboard.main') 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('guru.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>
                <a href="{{ route('guru.pdf') }}" class="btn btn-secondary mb-2">
                    Download PDF
                </a>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIP</th>
                                <th>Nama Guru</th>
                                <th>No Telepon</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guru as $key => $g)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$g->nip}}</td>
                                <td>{{$g->nama_guru}}</td>
                                <td>{{$g->notelp}}</td>
                                <td>
                                    @if($g->jk == 'L')
                                    Laki-laki
                                    @else
                                    Perempuan
                                    @endif
                                </td>
                                <td>{{$g->alamat}}</td>
                                <td>@switch($g->agama)
                                    @case('Islam')
                                    Islam
                                    @break
                                    @case('Hindu')
                                    Hindu
                                    @break
                                    @case('Buddha')
                                    Budha
                                    @break
                                    @case('Katolik')
                                    Katolik
                                    @break
                                    @case('Protestan')
                                    Protestan
                                    @break
                                    @default
                                    Lainnya
                                    @endswitch</td>
                                <td>{{$g->tempat_lahir}}</td>
                                <td>{{$g->tanggal_lahir}}</td>
                                <td>
                                    <a href="{{route('guru.edit', $g)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('guru.destroy', $g) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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