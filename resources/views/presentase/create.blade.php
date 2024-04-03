@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Presentase Ekonomi Sosial')
@section('main')
@include('dashboard.main')
<form action="{{route('presentase.store')}}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Siswa" id="nama_lengkap" name="nama_lengkap" aria-label="Siswa" value="{{ old('nama_lengkap') }}" aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Cari Siswa
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pekerjaan_ortu">Pekerjaan Ortu</label>
                            <select name="pekerjaan_ortu" id="pekerjaan_ortu" class="form-control">
                                @foreach($pekerjaan_ortus as $pekerjaan_ortu)
                                <option value="{{ $pekerjaan_ortu->keterangan }}">{{ $pekerjaan_ortu->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{route('presentase.index')}}" class="btn btn-default">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Siswa</h1>
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
                            @foreach($siswa as $key => $s)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td id={{$key+1}}>{{$s->nama_lengkap}}</td>
                                <td>{{ $s->fkelas->kelas }}</td>
                                <td>{{ $s->fkompetensi->kompetensi_keahlian }}</td>


                                <td>
                                    <button type="button" class="btn btn-primary btn-xs" onclick="pilih('{{$s->id}}', '{{$s->nama_lengkap}}','{{ $s->fkelas->kelas }}', ' <td>{{ $s->fkompetensi->kompetensi_keahlian }}</td>')" data-bs-dismiss="modal">
                                        Pilih
                                    </button>
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
    @stop

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tampil').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#hasil").change(function() {
            readURL(this);
        });
    </script>
    <script>
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tampil2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#ttd").change(function() {
            readURL2(this);
        });
    </script>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });
        //Fungsi pilih untuk memilih data Kategori wisata dan mengirimkan data kategori wisata dari Modal ke form tambah

        function pilih(id, nama_lengkap, kelas, kompetensi_keahlian) {
            document.getElementById('kdsiswa').value = id
            document.getElementById('nama_lengkap').value = nama_lengkap
            document.getElementById('kelas').value = kelas
            document.getElementById('kompetensi_keahlian').value = kompetensi_keahlian

        }
    </script>