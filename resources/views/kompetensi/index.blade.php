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
                    <a href="{{ route('kompetensi.create') }}" class="btn 
btn-primary mb-2">
                        Tambah
                    </a>
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
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
                                    <td>{{ $komp->kompetensi_keahlian }}</td>
                                    <td>
                                        <a href="{{ route('kompetensi.edit', $komp) }}" class="btn btn-primary btn-xs">
                                            Edit
                                        </a>
                                        <a href="{{ route('kompetensi.destroy', $komp) }}"
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
