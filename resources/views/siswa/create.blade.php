@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Siswa')
@section('main')
    @include('dashboard.main')
    <form action="{{ route('siswa.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis"
                                placeholder="NIS" name="nis" value="{{ old('nis') }}">
                            @error('nis')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}">
                            @error('nama_lengkap')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkelas" id="kdkelas" value="{{ old('kdkelas') }}">
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                    placeholder="Kelas" id="kelas" name="kelas" aria-label="Kelas"
                                    value="{{ old('kelas') }}" aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropKelas">
                                    Cari Kelas
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kdkompetensi">Kompetensi Keahlian</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkompetensi" id="kdkompetensi"
                                    value="{{ old('kdkompetensi') }}">
                                <input type="text"
                                    class="form-control @error('kompetensi_keahlian') is-invalid @enderror"
                                    placeholder="Kompetensi Keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian"
                                    aria-label="Kompetensi Keahlian" value="{{ old('kompetensi_keahlian') }}"
                                    aria-describedby="cari" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                id="nama_ayah" placeholder="Nama Ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
                            @error('nama_ayah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                id="nama_ibu" placeholder="Nama Ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
                            @error('nama_ibu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" placeholder="Tempat Lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                placeholder="Alamat">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-control @error('agama') is-invalid @enderror" id="agama"
                                name="agama">
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Protestan" {{ old('agama') == 'Protestan' ? 'selected' : '' }}>Protestan
                                </option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('agama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kewarganegaraan">Kewarganegaraan</label>
                            <select class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                id="kewarganegaraan" name="kewarganegaraan">
                                <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI
                                </option>
                                <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA
                                </option>
                            </select>
                            @error('kewarganegaraan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                id="no_hp" placeholder="No HP" name="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label></label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                id="nisn" placeholder="NISN" name="nisn" value="{{ old('nisn') }}">
                            @error('nisn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun_masuk">Tahun Masuk</label>
                            <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror"
                                id="tahun_masuk" placeholder="Tahun Masuk" name="tahun_masuk"
                                value="{{ old('tahun_masuk') }}">
                            @error('tahun_masuk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat_ortu">Alamat Ortu</label>
                            <textarea class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu"
                                placeholder="Alamat Ortu">{{ old('alamat_ortu') }}</textarea>
                            @error('alamat_ortu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_ortu">No Ortu</label>
                            <input type="text" class="form-control @error('no_ortu') is-invalid @enderror"
                                id="no_ortu" placeholder="No Ortu" name="no_ortu" value="{{ old('no_ortu') }}">
                            @error('no_ortu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_sekolah_asal">Nama Sekolah Asal</label>
                            <input type="text" class="form-control @error('nama_sekolah_asal') is-invalid @enderror"
                                id="nama_sekolah_asal" placeholder="Nama Sekolah Asal" name="nama_sekolah_asal"
                                value="{{ old('nama_sekolah_asal') }}">
                            @error('nama_sekolah_asal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat_sekolah">Alamat Sekolah</label>
                            <textarea class="form-control @error('alamat_sekolah') is-invalid @enderror" id="alamat_sekolah"
                                name="alamat_sekolah" placeholder="Alamat Sekolah">{{ old('alamat_sekolah') }}</textarea>
                            @error('alamat_sekolah')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror"
                                id="tahun_lulus" placeholder="Tahun Lulus" name="tahun_lulus"
                                value="{{ old('tahun_lulus') }}">
                            @error('tahun_lulus')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="riwayat_penyakit">Riwayat Penyakit</label>
                            <input type="text" class="form-control @error('riwayat_penyakit') is-invalid @enderror"
                                id="riwayat_penyakit" placeholder="Riwayat Penyakit" name="riwayat_penyakit"
                                value="{{ old('riwayat_penyakit') }}">
                            @error('riwayat_penyakit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alergi">Alergi</label>
                            <input type="text" class="form-control @error('alergi') is-invalid @enderror"
                                id="alergi" placeholder="Alergi" name="alergi" value="{{ old('alergi') }}">
                            @error('alergi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prestasi_akademik">Prestasi Akademik</label>
                            <input type="text" class="form-control @error('prestasi_akademik') is-invalid @enderror"
                                id="prestasi_akademik" placeholder="Prestasi Akademik" name="prestasi_akademik"
                                value="{{ old('prestasi_akademik') }}">
                            @error('prestasi_akademik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prestasi_non_akademik">Prestasi Non Akademik</label>
                            <input type="text"
                                class="form-control @error('prestasi_non_akademik') is-invalid @enderror"
                                id="prestasi_non_akademik" placeholder="Prestasi Non Akademik"
                                name="prestasi_non_akademik" value="{{ old('prestasi_non_akademik') }}">
                            @error('prestasi_non_akademik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ekstrakurikuler">Ekstrakurikuler</label>
                            <input type="text" class="form-control @error('ekstrakurikuler') is-invalid @enderror"
                                id="ekstrakurikuler" placeholder="Ekstrakurikuler" name="ekstrakurikuler"
                                value="{{ old('ekstrakurikuler') }}">
                            @error('ekstrakurikuler')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="biografi">Biografi</label>
                            <textarea class="form-control @error('biografi') is-invalid @enderror" id="biografi" name="biografi"
                                placeholder="Biografi">{{ old('biografi') }}</textarea>
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


        <!-- Modal for Kode Kelas -->
        <div class="modal fade" id="staticBackdropKelas" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabelKelas" aria-hidden="true">
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
                                            {{ $kelasItem->fkompetensi->kompetensi_keahlian }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                                onclick="pilihKelas('{{ $kelasItem->id }}', '{{ $kelasItem->kelas }}', '{{ $kelasItem->fkompetensi->kompetensi_keahlian }}')">
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
            // Automatically populate Kompetensi Keahlian based on the selected Kelas
            document.getElementById('kdkompetensi').value = id; // Change this line according to your data structure
            document.getElementById('kompetensi_keahlian').value =
            kompetensi_keahlian; // Change this line according to your data structure
            $('#staticBackdropKelas').modal('hide');
        }
    </script>

@stop
