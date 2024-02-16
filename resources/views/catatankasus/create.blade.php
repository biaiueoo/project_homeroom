@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Catatan Kasus')
@section('main')
    @include('dashboard.main')
    <form action="{{ route('catatankasus.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="kdsiswa">Nama Siswa</label>
                            <div class="input-group">
                                <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('kdsiswa') }}">
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    placeholder="Nama Siswa" id="nama_lengkap" name="nama_lengkap" aria-label="Nama Siswa"
                                    value="{{ old('nama_lengkap') }}" aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Cari Nama Siswa
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="hidden" name="kdkelas" id="kdkelas" value="{{ old('kdkelas') }}">
                            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas"
                                placeholder="Kelas" name="kelas" value="{{ old('kelas') }}" readonly>
                            @error('kelas')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                            <input type="hidden" name="kdkompetensi" id="kdkompetensi" value="{{ old('kdkompetensi') }}">
                            <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror"
                                id="kompetensi_keahlian" placeholder="Kompetensi Keahlian" name="kompetensi_keahlian"
                                value="{{ old('kompetensi_keahlian') }}" readonly>
                            @error('kompetensi_keahlian')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                @foreach ($semester as $semester)
                                    <option value="{{ $semester->keterangan }}">{{ $semester->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran"
                                value="{{ old('tahun_ajaran') }}">
                            @error('tahun_ajaran')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kasus">Kasus</label>
                            <input type="text" class="form-control @error('kasus') is-invalid @enderror" id="kasus"
                                placeholder="Kasus" name="kasus" value="{{ old('kasus') }}">
                            @error('kasus')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="keterangan">keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" placeholder="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        {{-- <div class="form-group">
                            <label for="keterangan">File Upload Keterangan (PDF, DOC, XLS, IMG, PNG, JPG)</label>
                            <input type="file" class="form-control-file @error('keterangan') is-invalid @enderror" 
                                id="keterangan" name="keterangan" accept=".pdf, .doc, .xls, .jpg, .jpeg, .png">
                            @error('keterangan')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div> --}}


                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                placeholder="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tindak_lanjut">Tindak Lanjut</label>
                            <input type="text" class="form-control @error('tindak_lanjut') is-invalid @enderror"
                                id="tindak_lanjut" placeholder="Tindak Lanjut" name="tindak_lanjut"
                                value="{{ old('tindak_lanjut') }}">
                            @error('tindak_lanjut')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status_kasus">Status Kasus</label>
                            <input type="text" class="form-control @error('status_kasus') is-invalid @enderror"
                                id="status_kasus" placeholder="Status Kasus" name="status_kasus"
                                value="{{ old('status_kasus') }}">
                            @error('status_kasus')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="dampingan_bk">Dampingan BK</label>
                            <select class="form-control @error('dampingan_bk') is-invalid @enderror" id="dampingan_bk"
                                name="dampingan_bk">
                                <option value="Tidak" {{ old('dampingan_bk') == 'Tidak' ? 'selected' : '' }}>Tidak
                                </option>
                                <option value="Ya" {{ old('dampingan_bk') == 'Ya' ? 'selected' : '' }}>Ya
                                </option>
                            </select>
                            @error('dampingan_bk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="user_admin">User Admin</label>
                            <input type="text" class="form-control" id="user_admin" name="user_admin"
                                value="{{ old('user_admin') }}">
                        </div>

                        {{-- <div class="form-group">
                            <label for="user_name">Nama Pengguna</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" value="{{ auth()->user()->name }}" readonly>
                        </div> --}}



                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('catatankasus.index') }}" class="btn btn-default">Batal</a>
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Nama Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $key => $s)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td id="kdsiswa{{ $key + 1 }}">{{ $s->nama_lengkap }}</td>
                                        <td id="kdsiswa{{ $key + 1 }}">{{ $s->fkelas->kelas }}</td>
                                        <td id="kdsiswa{{ $key + 1 }}">{{ $s->fkompetensi->kompetensi_keahlian }}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                                onclick="pilih('{{ $s->id }}', '{{ $s->nama_lengkap }}', '{{ $s->fkelas->kelas }}', '{{ $s->fkompetensi->kompetensi_keahlian }}')">
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

        function pilih(id, nama_lengkap, kdkelas, kdkompetensi) {
            document.getElementById('kdsiswa').value = id;
            document.getElementById('nama_lengkap').value = nama_lengkap;
            document.getElementById('kelas').value = kdkelas;
            document.getElementById('kompetensi_keahlian').value = kdkompetensi;
            $('#staticBackdrop').modal('hide');
        }
    </script>

@stop
