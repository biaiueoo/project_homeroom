@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Edit Siswa')
@section('main')
@include('dashboard.main')
<form action="{{ route('siswa.update', $siswa->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form fields for editing data -->

                    <!-- NIS -->
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" placeholder="NIS" name="nis" value="{{ $siswa->nis }}">
                        @error('nis')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap" value="{{ $siswa->nama_lengkap }}">
                        @error('nama_lengkap')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <div class="input-group">
                            <input type="hidden" name="kdkelas" id="kdkelas" value="{{ $siswa['kdkelas'] }}">
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" placeholder="Kelas" id="kelas" name="kelas" aria-label="Kelas" value="{{ old('kelas', $siswa['kelas']) }}" aria-describedby="cari" readonly>
                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropKelas">
                                Cari Kelas
                            </a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kdkompetensi">Kompetensi Keahlian</label>
                        <div class="input-group">
                            <input type="hidden" name="kdkompetensi" id="kdkompetensi" value="{{ $siswa['kdkompetensi'] }}">
                            <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" placeholder="Kompetensi Keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian" aria-label="Kompetensi Keahlian" value="{{ old('kompetensi_keahlian', $siswa['kompetensi_keahlian']) }}" aria-describedby="cari" readonly>
                        </div>
                    </div>


                    <!-- Tempat Lahir -->
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}">
                        @error('tempat_lahir')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Tempat Lahir" name="tanggal_lahir" value="{{ $siswa->tanggal_lahir }}">
                        @error('tanggal_lahir')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat">{{ $siswa->alamat }}</textarea>
                        @error('alamat')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Agama -->
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <select class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama">
                            <option value="Islam" {{ $siswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Katolik" {{ $siswa->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Protestan" {{ $siswa->agama == 'Protestan' ? 'selected' : '' }}>Protestan
                            </option>
                            <option value="Buddha" {{ $siswa->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Hindu" {{ $siswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Lainnya" {{ $siswa->agama == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('agama')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Kewarganegaraan -->
                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>
                        <select class="form-control @error('kewarganegaraan') is-invalid @enderror" id="kewarganegaraan" name="kewarganegaraan">
                            <option value="WNI" {{ $siswa->kewarganegaraan == 'WNI' ? 'selected' : '' }}>WNI
                            </option>
                            <option value="WNA" {{ $siswa->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA
                            </option>
                        </select>
                        @error('kewarganegaraan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="No HP" name="no_hp" value="{{ $siswa->no_hp }}">
                        @error('no_hp')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label></label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ $siswa->email }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NISN -->
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="NISN" name="nisn" value="{{ $siswa->nisn }}">
                        @error('nisn')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tahun Masuk -->
                    <div class="form-group">
                        <label for="tahun_masuk">Tahun Masuk</label>
                        <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" id="tahun_masuk" placeholder="Tahun Masuk" name="tahun_masuk" value="{{ $siswa->tahun_masuk }}">
                        @error('tahun_masuk')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat Ortu -->
                    <div class="form-group">
                        <label for="alamat_ortu">Alamat Ortu</label>
                        <textarea class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu" placeholder="Alamat Ortu">{{ $siswa->alamat_ortu }}</textarea>
                        @error('alamat_ortu')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No Ortu -->
                    <div class="form-group">
                        <label for="no_ortu">No Ortu</label>
                        <input type="text" class="form-control @error('no_ortu') is-invalid @enderror" id="no_ortu" placeholder="No Ortu" name="no_ortu" value="{{ $siswa->no_ortu }}">
                        @error('no_ortu')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama Sekolah Asal -->
                    <div class="form-group">
                        <label for="nama_sekolah_asal">Nama Sekolah Asal</label>
                        <input type="text" class="form-control @error('nama_sekolah_asal') is-invalid @enderror" id="nama_sekolah_asal" placeholder="Nama Sekolah Asal" name="nama_sekolah_asal" value="{{ $siswa->nama_sekolah_asal }}">
                        @error('nama_sekolah_asal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat Sekolah -->
                    <div class="form-group">
                        <label for="alamat_sekolah">Alamat Sekolah</label>
                        <textarea class="form-control @error('alamat_sekolah') is-invalid @enderror" id="alamat_sekolah" name="alamat_sekolah" placeholder="Alamat Sekolah">{{ $siswa->alamat_sekolah }}</textarea>
                        @error('alamat_sekolah')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tahun Lulus -->
                    <div class="form-group">
                        <label for="tahun_lulus">Tahun Lulus</label>
                        <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" placeholder="Tahun Lulus" name="tahun_lulus" value="{{ $siswa->tahun_lulus }}">
                        @error('tahun_lulus')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Riwayat Penyakit -->
                    <div class="form-group">
                        <label for="riwayat_penyakit">Riwayat Penyakit</label>
                        <input type="text" class="form-control @error('riwayat_penyakit') is-invalid @enderror" id="riwayat_penyakit" placeholder="Riwayat Penyakit" name="riwayat_penyakit" value="{{ $siswa->riwayat_penyakit }}">
                        @error('riwayat_penyakit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alergi -->
                    <div class="form-group">
                        <label for="alergi">Alergi</label>
                        <input type="text" class="form-control @error('alergi') is-invalid @enderror" id="alergi" placeholder="Alergi" name="alergi" value="{{ $siswa->alergi }}">
                        @error('alergi')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Prestasi Akademik -->
                    <div class="form-group">
                        <label for="prestasi_akademik">Prestasi Akademik</label>
                        <input type="text" class="form-control @error('prestasi_akademik') is-invalid @enderror" id="prestasi_akademik" placeholder="Prestasi Akademik" name="prestasi_akademik" value="{{ $siswa->prestasi_akademik }}">
                        @error('prestasi_akademik')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Prestasi Non Akademik -->
                    <div class="form-group">
                        <label for="prestasi_non_akademik">Prestasi Non Akademik</label>
                        <input type="text" class="form-control @error('prestasi_non_akademik') is-invalid @enderror" id="prestasi_non_akademik" placeholder="Prestasi Non Akademik" name="prestasi_non_akademik" value="{{ $siswa->prestasi_non_akademik }}">
                        @error('prestasi_non_akademik')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ekstrakurikuler -->
                    <div class="form-group">
                        <label for="ekstrakurikuler">Ekstrakurikuler</label>
                        <input type="text" class="form-control @error('ekstrakurikuler') is-invalid @enderror" id="ekstrakurikuler" placeholder="Ekstrakurikuler" name="ekstrakurikuler" value="{{ $siswa->ekstrakurikuler }}">
                        @error('ekstrakurikuler')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Biografi -->
                    <div class="form-group">
                        <label for="biografi">Biografi</label>
                        <textarea class="form-control @error('biografi') is-invalid @enderror" id="biografi" name="biografi" placeholder="Biografi">{{ $siswa->biografi }}</textarea>
                        @error('biografi')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-default">Batal</a>
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
    <!-- End Modal for Kode Kelas -->
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