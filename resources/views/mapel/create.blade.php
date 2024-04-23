@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Mata Pelajaran')
@section('main')
@include('dashboard.main')
<form action="{{route('mapel.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kdkompetensi">Kompetensi Keahlian</label>
                        <input type="hidden" name="kdkompetensi" id="kdkompetensi" value="{{ old('kdkompetensi') }}">
                        <div class="input-group">
                            <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" placeholder="kompetensi_keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian" aria-label="kompetensi_keahlian" value="{{ old('kompetensi_keahlian') }}" aria-describedby="cari" readonly>
                            <div class="input-group-append">
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Cari Kompetensi Keahlian
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('mapel.index')}}" class="btn btn-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal KOMPETENSI -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Kompetensi Keahlian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kompetensi as $key => $k)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td id="kdkompetensi{{ $key + 1 }}">{{ $k->kompetensi_keahlian }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilih('{{ $k->id }}', '{{ $k->kompetensi_keahlian }}')">
                                        Pilih
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
    <!-- End Modal -->
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function pilih(id, kompetensi_keahlian) {
            document.getElementById('kdkompetensi').value = id;
            document.getElementById('kompetensi_keahlian').value = kompetensi_keahlian;
            $('#staticBackdrop').modal('hide');
        }
    </script>

    @stop