@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Jadwal')
@section('main')
@include('dashboard.main')
<form action="{{ route('jadwal.update', $jadwal->id) }}" method="post">
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
                            <input type="hidden" name="kdguru" id="kdguru" value="{{ old('kdguru', $jadwal->kdguru) }}">
                            <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" placeholder="Nama Guru" id="nama_guru" name="nama_guru" aria-label="Nama Guru" value="{{ old('nama_guru', $jadwal->fguru->nama_guru) }}" aria-describedby="cari" readonly>
                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropGuru">
                                Cari Data Guru
                            </a>
                        </div>
                    </div>

                                      {{-- Edit Mapel --}}
                    <div class="form-group">
                        <label for="kdmapel">Mata Pelajaran</label>
                        <div class="input-group">
                            <input type="hidden" name="kdmapel" id="kdmapel" value="{{ old('kdmapel', $jadwal->kdmapel) }}">
                            <input type="text" class="form-control @error('mata_pelajaran') is-invalid @enderror" placeholder="Mata Pelajaran" id="mata_pelajaran" name="mata_pelajaran" aria-label="Mata Pelajaran" value="{{ old('mata_pelajaran', $jadwal->fmapel->mata_pelajaran) }}" aria-describedby="cari" readonly>
                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropMapel">
                                Cari Mata Pelajaran
                            </a>
                        </div>
                    </div>

                    {{-- Edit Tahun Ajaran --}}
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $jadwal->tahun_ajaran) }}">
                        @error('tahun_ajaran')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit Semester --}}
                    {{-- <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                @foreach($semester as $semester)
                                    <option value="{{ $semester->keterangan }}">{{ $semester->keterangan }}</option>
                    @endforeach
                    </select>
                </div> --}}

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control">
                        @foreach($semester as $semester)
                        <option value="{{ $semester->keterangan }}" {{ old('semester', $dataEdit->semester) == $semester->keterangan ? 'selected' : '' }}>
                            {{ $semester->keterangan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="hari">hari</label>
                    <select name="hari" id="hari" class="form-control">
                        @foreach($hari as $hari)
                        <option value="{{ $hari->keterangan }}" {{ old('hari', $dataEdit->hari) == $hari->keterangan ? 'selected' : '' }}>
                            {{ $hari->keterangan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Edit Jam --}}
                <div class="form-group">
                    <label for="jam">Jam Pelajaran ke :</label>
                    <input type="text" class="form-control @error('jam') is-invalid @enderror" id="jam" placeholder="Tahun Ajaran" name="jam" value="{{ old('jam', $jadwal->jam) }}">
                    @error('jam')
                    <span class="text danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-default">Batal</a>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Guru -->
    <div class="modal fade" id="staticBackdropGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropGuru" aria-hidden="true">
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
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilihguru('{{ $g->id }}', '{{ $g->nama_guru }}')">
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
    <!-- Modal Mapel -->
    <div class="modal fade" id="staticBackdropMapel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropMapel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropMapel">Pencarian Mata Pelajaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="carimapel">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Mata Pelajaran</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mapel as $key => $m)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td id="kdmapel{{ $key + 1 }}">{{ $m->mata_pelajaran }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilihmapel('{{ $m->id }}', '{{ $m->mata_pelajaran }}')">
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


<script>
    $('#cariguru').DataTable({
        "responsive": true,
    });

    function pilihguru(id, nama_guru) {
        document.getElementById('kdguru').value = id;
        document.getElementById('nama_guru').value = nama_guru;
        $('#staticBackdropGuru').modal('hide');
    }

    $('#carimapel').DataTable({
        "responsive": true,
    });

    function pilihmapel(id, mata_pelajaran) {
        document.getElementById('kdmapel').value = id;
        document.getElementById('mata_pelajaran').value = mata_pelajaran;
        $('#staticBackdropMapel').modal('hide');
    }
</script>

@stop