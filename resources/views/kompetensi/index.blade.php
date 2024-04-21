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
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <a href="{{ route('kompetensi.create') }}" class="btn btn-primary">Tambah</a>

                        <!-- Tombol untuk memunculkan formulir import -->
                        <button id="showImportForm" class="btn btn-primary mb-2">Import kompotensi</button>

                        <!-- Formulir untuk unggah file (awalnya tersembunyi) -->
                        <form action="{{ route('kompetensi-import') }}" method="POST" enctype="multipart/form-data" id="importForm" style="display: none;">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Pilih file Excel</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Import kompotensi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tombol Export Excel dan Download PDF -->
                    <div>
                        <a href="{{ route('export.kompetensi') }}" class="btn btn-info mr-2">Export Excel File</a>
                    </div>
                </div>
            </div>

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
                        <a href="{{ asset('uploads/' . $komp->kompetensi_keahlian) }}" target="_blank">
                            {{ $komp->kompetensi_keahlian }}
                        </a>
                        @endif
                        @endif
                        </td> --}}

                        <td>
                            <a href="{{ route('kompetensi.edit', $komp) }}" class="btn btn-primary btn-xs">
                                Edit
                            </a>
                            <a href="{{ route('kompetensi.destroy', $komp) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#showImportForm').click(function() {
            $('#importForm').toggle(); // Menampilkan/menyembunyikan formulir import
        });

        // Reset formulir saat ditutup (misalnya, setelah unggah selesai)
        $('#importForm').submit(function() {
            $(this).hide(); // Sembunyikan formulir setelah submit
        });

        // Mengatur label custom file saat file dipilih
        $('#customFile').change(function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>