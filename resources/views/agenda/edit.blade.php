@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Agenda Kegiatan')
@section('main')
@include('dashboard.main')
<form action="{{ route('agenda.update', $agenda) }}" method="post">
    @csrf
    @method('PUT') <!-- Menambahkan metode PUT untuk update -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <div class="input-group">
                            <input type="hidden" name="kdkelas" id="kdkelas" value="{{ old('kdkelas', $agenda->kdkelas) }}">
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" placeholder="Kelas" id="kelas" name="kelas" aria-label="Kelas" value="{{ old('kelas', $agenda->fkelas->kelas) }}" aria-describedby="cari" readonly> <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropKelas">
                                Cari Kelas
                            </a>
                        </div>
                    </div>


                    {{-- Edit Kompetensi --}}

                    <div class="form-group">
                        <label for="kdkompetensi">Kompetensi Keahlian</label>
                        <div class="input-group">
                            <input type="hidden" name="kdkompetensi" id="kdkompetensi" value="{{ old('kdkompetensi', $agenda->kdkompetensi) }}">
                            <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" placeholder="Kompetensi Keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian" aria-label="Kompetensi Keahlian" value="{{ old('kompetensi_keahlian', $agenda->fkompetensi->kompetensi_keahlian) }}" aria-describedby="cari" readonly>
                        </div>
                    </div>

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

                    {{-- Edit Tahun Ajaran --}}
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $agenda->tahun_ajaran) }}">
                        @error('tahun_ajaran')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
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

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tempat Lahir" name="tanggal" value="{{ $agenda->tanggal }}">
                        @error('tanggal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit nama_kegiatan --}}
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" placeholder="Tahun Ajaran" name="nama_kegiatan" value="{{ old('nama_kegiatan', $agenda->nama_kegiatan) }}">
                        @error('nama_kegiatan')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit waktu --}}
                    <div class="form-group">
                        <label for="waktu">Waktu </label>
                        <input type="text" class="form-control @error('waktu') is-invalid @enderror" id="waktu" placeholder="Tahun Ajaran" name="waktu" value="{{ old('waktu', $agenda->waktu) }}">
                        @error('waktu')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit keterangan --}}
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Tahun Ajaran" name="keterangan" value="{{ old('keterangan', $agenda->keterangan) }}">
                        @error('keterangan')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>




                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('agenda.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelKelas" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabelKelas">Pencarian Kode Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="exampleKelas">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $key => $kelasItem)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td id="kdkelas{{ $key + 1 }}">{{ $kelasItem->kelas }}</td>
                                <td id="kdkelas{{ $key + 1 }}">
                                    {{ $kelasItem->fkompetensi->kompetensi_keahlian }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilihKelas('{{ $kelasItem->id }}', '{{ $kelasItem->kelas }}', '{{ $kelasItem->fkompetensi->kompetensi_keahlian }}')">
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
</form>

<script>
    $('#exampleKelas').DataTable({
        "responsive": true,
    });

    function pilihKelas(id, kelas, kompetensi_keahlian) {
        document.getElementById('kdkelas').value = id;
        document.getElementById('kelas').value = kelas;
        document.getElementById('kdkompetensi').value = id; // Change this line according to your data structure
        document.getElementById('kompetensi_keahlian').value =
            kompetensi_keahlian; // Change this line according to your data structure
        $('#staticBackdropKelas').modal('hide');
    }
</script>
@stop