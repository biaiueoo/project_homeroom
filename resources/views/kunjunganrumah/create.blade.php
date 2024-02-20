@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Kunjungan Rumah')
@section('main')
@include('dashboard.main')
<form action="{{ route('kunjunganrumah.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="kasus">Kasus</label>
                        <input type="hidden" name="kdkasus" id="kdkasus" value="{{ old('kdkasus') }}">
                        <div class="input-group">
                            <input type="text" class="form-control @error('kasus') is-invalid @enderror" placeholder="kasus" id="kasus" name="kasus" aria-label="kasus" value="{{ old('kasus') }}" aria-describedby="cari" readonly>
                            <div class="input-group-append">
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Cari Kasus
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kdsiswa">Nama Siswa</label>
                        <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('kdsiswa') }}">
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Nama Siswa" name="nama_lengkap" value="{{ old('nama_lengkap') }}" readonly>
                        @error('nama_lengkap')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="hidden" name="kdkelas" id="kdkelas" value="{{ old('kdkelas') }}">
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" placeholder="Kelas" name="kelas" value="{{ old('kelas') }}" readonly>
                        @error('kelas')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                        <input type="hidden" name="kdkompetensi" id="kdkompetensi" value="{{ old('kdkompetensi') }}">
                        <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" id="kompetensi_keahlian" placeholder="Kompetensi Keahlian" name="kompetensi_keahlian" value="{{ old('kompetensi_keahlian') }}" readonly>
                        @error('kompetensi_keahlian')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="solusi">Solusi</label>
                        <input type="text" class="form-control @error('solusi') is-invalid @enderror" id="solusi" placeholder="Solusi" name="solusi" value="{{ old('solusi') }}">
                        @error('solusi')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="hidden" name="semester" id="hidden_semester" value="{{ old('semester') }}">
                        <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester_display" placeholder="Semester" name="semester" value="{{ old('semester') }}" readonly>
                        @error('semester')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="hidden" name="tahun_ajaran" id="hidden_tahun_ajaran" value="{{ old('tahun_ajaran') }}">
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran_display" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" readonly>
                        @error('tahun_ajaran')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Form untuk upload Surat -->
                    <div class="form-group">
                        <label for="surat">Upload Surat (pdf)</label>
                        <input type="file" class="form-control @error('surat') is-invalid @enderror" id="surat" name="surat">
                        @error('surat')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Form untuk upload Dokumentasi -->
                    <div class="form-group">
                        <label for="dokumentasi">Upload Dokumentasi (jpg, jpeg, png)</label>
                        <input type="file" class="form-control @error('dokumentasi') is-invalid @enderror" id="dokumentasi" name="dokumentasi">
                        @error('dokumentasi')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kunjunganrumah.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Kasus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kasus</th>
                                <th>Tanggal</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kasus as $key => $k)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td id="kdkasus{{ $key + 1 }}">{{ $k->kasus }}</td>
                                <td id="kdkasus{{ $key + 1 }}">{{ $k->tanggal }}</td>
                                <td id="kdkasus{{ $key + 1 }}">{{ $k->fsiswa->nama_lengkap }}</td>
                                <td id="kdkasus{{ $key + 1 }}">{{ $k->fsiswa->fkelas->kelas }}</td>
                                <td id="kdkasus{{ $key + 1 }}">{{ $k->fsiswa->fkompetensi->kompetensi_keahlian }}</td>
                                <td id="kdkasus{{ $key + 1 }}">{{ $k->semester }}</td>
                                <td id="kdkasus{{ $key + 1 }}">{{ $k->tahun_ajaran }}</td>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilih('{{ $k->id }}', '{{ $k->kasus }}', '{{ $k->fsiswa->nama_lengkap }}', '{{ $k->fsiswa->fkelas->kelas }}', '{{ $k->fsiswa->fkompetensi->kompetensi_keahlian }}', '{{ $k->semester }}', '{{ $k->tahun_ajaran }}',)">
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
    $('#example2').DataTable({
        "responsive": true,
    });

    function pilih(id, kasus, nama_lengkap, kdkelas, kdkompetensi, semester, tahun_ajaran) {
        document.getElementById('kdkasus').value = id;
        document.getElementById('kasus').value = kasus;
        document.getElementById('nama_lengkap').value = nama_lengkap;
        document.getElementById('kelas').value = kdkelas;
        document.getElementById('kompetensi_keahlian').value = kdkompetensi;
        document.getElementById('semester_display').value = semester;
        document.getElementById('tahun_ajaran_display').value = tahun_ajaran;

        $('#staticBackdrop').modal('hide');
    }
</script>

@stop