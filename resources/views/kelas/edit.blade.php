@extends('adminlte::page')
@section('title', 'Edit Kelas')
@section('content_header')
    <h1 class="m-0 text-dark">Edit Kelas</h1>
@stop
@section('content')
    <form action="{{ route('kelas.update', $kelas->id) }}" method="post">
        @csrf
        @method('PUT') <!-- Menambahkan metode PUT untuk update -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                placeholder="Kelas" name="kelas" value="{{ old('kelas', $kelas->kelas) }}">
                            @error('kelas')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kdkompetensi">Kompetensi Keahlian</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkompetensi" id="kdkompetensi"
                                    value="{{ old('kdkompetensi', $kelas->kdkompetensi) }}">
                                <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror"
                                    placeholder="Kompetensi Keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian"
                                    aria-label="Kompetensi Keahlian"
                                    value="{{ old('kompetensi_keahlian', $kelas->fkompetensi->kompetensi_keahlian) }}"
                                    aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Cari Kompetensi Keahlian
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kelas.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                            <a href="#" class="btn btn-primary btn-xs"
                                                onclick="pilih('{{ $k->id }}', '{{ $k->kompetensi_keahlian }}')">
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
    </form>

    @push('js')
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
    @endpush
@stop