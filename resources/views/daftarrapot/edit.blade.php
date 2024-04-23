@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Daftar Rapot')
@section('main')
@include('dashboard.main')
<form action="{{ route('daftarrapot.update', $daftarrapot) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- Input Siswa --}}
                    <div class="form-group">
                        <label for="kdsiswa">Nama Siswa</label>
                        <div class="input-group">
                            <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('nama_lengkap', $daftarrapot->fsiswa->nama_lengkap) }}">
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Nama Lengkap" id="nama_lengkap" name="nama_lengkap" aria-label="nama_lengkap" value="{{ old('nama_lengkap', $daftarrapot->fsiswa->nama_lengkap) }}" aria-describedby="cari" readonly>
                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropKelas">
                                Cari Siswa
                            </a>


                        </div>
                        <!-- @error('nama_lengkap') <span class="invalid-feedback">{{ $message }}</span> @enderror -->
                    </div>

                    <div class="form-group">
                        <label for="nama_ayah">Nama Orang tua</label>
                        <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Nama Orang tua" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $daftarrapot->fsiswa->nama_ayah) }}" readonly>
                        @error('nama_ayah') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tempat Lahir" name="tanggal" value="{{ $daftarrapot->tanggal }}">
                        @error('tanggal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-control">
                            @foreach($semester as $s)
                            <option value="{{ $s->keterangan }}" {{ old('semester', $daftarrapot->semester) == $s->keterangan ? 'selected' : '' }}>
                                {{ $s->keterangan }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ $daftarrapot->tahun_ajaran ?? old('tahun_ajaran') }}">
                        @error('tahun_ajaran') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('daftarrapot.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="staticBackdropKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelKelas" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabelKelas">Pencarian Kode Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered table-stripped" id="siswa">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Nama Orang tua</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td id="kdsiswa{{ $key + 1 }}">{{ $item->nama_lengkap }}</td>
                            <td id="kdsiswa{{ $key + 1 }}">
                                {{ $item->nama_ayah }}
                            </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-xs" onclick="pilihsiswa('{{ $item->id }}', '{{ $item->nama_lengkap }}', '{{ $item->nama_ayah}}')">
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
<!-- End Modal for Kode Kelas -->

</form>


<script>
    $('#siswa').DataTable({
        "responsive": true,
    });

    function pilihsiswa(id, nama_lengkap, nama_ayah) {
        document.getElementById('kdsiswa').value = id;
        document.getElementById('nama_lengkap').value = nama_lengkap;
        document.getElementById('nama_ayah').value = nama_ayah;
        $('#staticBackdropKelas').modal('hide');
    }
</script>

@stop