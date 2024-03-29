@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Wali Kelas')
@section('main')
    @include('dashboard.main')
    <form action="{{ route('walas.update', $walas->id) }}" method="post">
        @csrf
        @method('PUT') <!-- Menambahkan metode PUT untuk update -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- Edit Guru --}}
                        <div class="form-group">
                            <label for="kdguru">Nama Guru</label>
                            <div class="input-group">
                                <input type="hidden" name="kdguru" id="kdguru"
                                    value="{{ old('kdguru', $walas->kdguru) }}">
                                <input type="text" class="form-control @error('nama_guru') is-invalid @enderror"
                                    placeholder="Nama Guru" id="nama_guru" name="nama_guru"
                                    aria-label="Nama Guru"
                                    value="{{ old('nama_guru', $walas->fguru->nama_guru) }}"
                                    aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropGuru">
                                    Cari Data Guru
                                </a>
                            </div>
                        </div>

                        {{-- Edit Kelas --}}
                        <div class="form-group">
                            <label for="kdkelas">Kelas</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkelas" id="kdkelas"
                                    value="{{ old('kdkelas', $walas->kdkelas) }}">
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                    placeholder="Kelas" id="kelas" name="kelas"
                                    aria-label="Kelas"
                                    value="{{ old('kelas', $walas->fkelas->kelas) }}"
                                    aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropKelas">
                                    Cari Data Guru
                                </a>
                            </div>
                        </div>

                        {{-- Edit Kompetensi --}}
                        <div class="form-group">
                            <label for="kdkompetensi">Kompetensi Keahlian</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkompetensi" id="kdkompetensi"
                                    value="{{ old('kdkompetensi', $walas->kdkompetensi) }}">
                                <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror"
                                    placeholder="Kompetensi Keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian"
                                    aria-label="Kompetensi Keahlian"
                                    value="{{ old('kompetensi_keahlian', $walas->fkompetensi->kompetensi_keahlian) }}"
                                    aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Cari Kompetensi Keahlian
                                </a>
                            </div>
                        </div>

                        {{-- Edit Tahun Ajaran --}}
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran"
                                placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $walas->tahun_ajaran) }}">
                            @error('tahun_ajaran')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('walas.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Guru -->
        <div class="modal fade" id="staticBackdropGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropGuru" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropGuru">Pencarian Guru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="cariguru">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Guru</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $key => $g)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td id="kdguru{{ $key + 1 }}">{{ $g->nama_guru }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                                onclick="pilihguru('{{ $g->id }}', '{{ $g->nama_guru }}')">
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

        <!-- Modal Kelas -->
        <div class="modal fade" id="staticBackdropKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropKelas" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropKelas">Pencarian Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="carikelas">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kelas</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $key => $kel)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td id="kdkelas{{ $key + 1 }}">{{ $kel->kelas }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                                onclick="pilihkelas('{{ $kel->id }}', '{{ $kel->kelas }}')">
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

        <!-- Modal Kompetensi -->
        <div class="modal fade" id="staticBackdropKompetensi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropKompetensi" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropKompetensi">Pencarian Kompetensi Keahlian</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="carikompetensi">
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
                                                onclick="pilihkompetensi('{{ $k->id }}', '{{ $k->kompetensi_keahlian }}')">
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

            $('#cariguru').DataTable({
                "responsive": true,
            });

            function pilihguru(id, nama_guru) {
                document.getElementById('kdguru').value = id;
                document.getElementById('nama_guru').value = nama_guru;
                $('#staticBackdropGuru').modal('hide');
            }

            $('#carikelas').DataTable({
                "responsive": true,
            });

            function pilihkelas(id, kelas) {
                document.getElementById('kdkelas').value = id;
                document.getElementById('kelas').value = kelas;
                $('#staticBackdropKelas').modal('hide');
            }

            $('#carikompetensi').DataTable({
                "responsive": true,
            });

            function pilihkompetensi(id, kompetensi_keahlian) {
                document.getElementById('kdkompetensi').value = id;
                document.getElementById('kompetensi_keahlian').value = kompetensi_keahlian;
                $('#staticBackdropKompetensi').modal('hide');
            }
        </script>
    @endpush
@stop


