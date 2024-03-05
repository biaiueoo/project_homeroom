@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Penerahan/Pengambilan Rapot')
@section('main')
@include('dashboard.main')
<form action="{{route('daftarrapot.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">


                        <div class="form-group">
                            <label for="kdsiswa">Nama Siswa</label>
                            <div class="input-group">
                                <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('kdsiswa') }}">
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Nama Siswa" id="nama_lengkap" name="kelas" aria-label="Kelas" value="{{ old('kelas') }}" aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropSiswa">
                                    Cari Siswa
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kdsiswa">Nama Orang Tua</label>
                            <div class="input-group">
                                <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('kdsiswa') }}">
                                <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" placeholder="Nama Orang tua" id="nama_ayah" name="nama_ayah" aria-label="Kompetensi Keahlian" value="{{ old('nama_ayah') }}" aria-describedby="cari" readonly>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                @foreach($semester as $semester)
                                <option value="{{ $semester->keterangan }}">{{ $semester->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input type="decimal" class="form-control 
@error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                            @error('tahun_ajaran') <span class="text-danger">{{$message}}</span> @enderror
                        </div>



                        <div class="form-group">
                            <select name="rapor" id="rapor" class="form-control">
                                @foreach($rapor as $r)
                                <option value="{{ $r->keterangan }}">{{ $r->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tanggal Reservasi" name="tanggal" value="{{old('tanggal')}}">
                            @error('tanggal') <span class="text-danger">{{$message}}</span> @enderror
                        </div>


                        <div class="form-group">
                            <label for="dokumentasi" class="formlabel">Dokumentasi</label>
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil" alt="..." width="15%" id="tampil">
                            <input class="form-control @error('dokumentasi') isinvalid @enderror" type="file" id="dokumentasi" name="dokumentasi">
                            @error('dokumentasi') <span class="textdanger">{{$message}}</span> @enderror
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('daftarrapot.index')}}" class="btn btn-default">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Kode siswa -->
    <div class="modal fade" id="staticBackdropSiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelKelas" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabelSiswa">Pencarian Kode Kelas</h1>
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
                            @foreach ($siswa as $key => $s)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td id="kdsiswa{{ $key + 1 }}">{{ $s->nama_lengkap }}</td>
                                <td id="kdsiswa{{ $key + 1 }}">
                                    {{ $s->nama_ayah }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilihSiswa('{{ $s->id }}', '{{ $s->nama_lengkap }}', '{{ $s->nama_ayah }}')">
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

    @stop

    <script>
        $('#siswa').DataTable({
            "responsive": true,
        });

        function pilihSiswa(id, nama_lengkap, nama_ayah) {
            document.getElementById('kdsiswa').value = id;
            document.getElementById('nama_lengkap').value = nama_lengkap; // Change this line according to your data structure
            document.getElementById('nama_ayah').value = nama_ayah; // Change this line according to your data structure
            $('#staticBackdropSiswa').modal('hide');
        }
    </script>