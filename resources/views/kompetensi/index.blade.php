@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Kompetensi Keahlian')
@section('main')
    @include('dashboard.main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('kompetensi.create') }}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <form action="{{ route('kompetensi-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="custom-file-input" id="customFile">
                            </div>
                        </div>
                        <button class="btn btn-primary">Import Kompetensi Keahlian</button>
                    </form>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kompetensi as $key => $komp)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$komp->kompetensi_keahlian}}</td>

                                    {{-- <td>
                                        @if ($komp->kompetensi_keahlian)
                                            @php
                                                $extension = pathinfo($komp->kompetensi_keahlian, PATHINFO_EXTENSION);
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                            @endphp

                                            @if (in_array($extension, $imageExtensions))
                                                <img src="{{ asset('uploads/' . $komp->kompetensi_keahlian) }}"
                                                    alt="File Image" style="max-width: 100px; max-height: 100px;">
                                            @else
                                                <a href="{{ asset('uploads/' . $komp->kompetensi_keahlian) }}"
                                                    target="_blank">
                                                    {{ $komp->kompetensi_keahlian }}
                                                </a>
                                            @endif
                                        @endif
                                    </td> --}}
                                    
                                    <td>
                                        <a href="{{ route('kompetensi.edit', $komp) }}" class="btn btn-primary btn-xs">
                                            Edit
                                        </a>
                                        <a href="{{ route('kompetensi.destroy', $komp) }}"
                                            onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                            Delete
                                        </a>
                                        <a href="{{ route('kompetensi.store') }}" class="btn btn-primary mb-2">
                                            UNGGAH
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
