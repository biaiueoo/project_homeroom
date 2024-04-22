@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Siswa')
@section('main')
@include('dashboard.main')
<form action="{{ route('dkelas.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkelas" id="kdkelas" readonly value="{{ $cari_id }}">
                                <input type="text" name="kelas" id="kelas" readonly value="{{$kelas}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="nis">Siswa</label>
                            <div class="input-group">
                                <input type="hidden" name="nis" id="nis" value="{{old('nis')}}">
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Nama_Lengkap" id="nama_lengkap" name="nama_lengkap" value="{{old('nama_lengkap')}}" aria-label="nama_lengkap" aria-describedby="cari">
                                <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari" data-bs-target=#staticBackdrop1>Cari Data Siswa</button>
                            </div>
                        </div>

                        <!-- Modal untuk relasi ke obat -->
                        <div class="modal fade" id="staticBackdrop1" data-bsbackdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel1">Pencarian Data Siswa</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <table class="table table-hover table-bordered tablestripped" id="example3">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>NIS</th>
                                                    <th>Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($siswa as $key => $s)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$s->nis}}</td>
                                                    <td>{{$s->nama_lengkap}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary 
                                                    btn-xs" onclick="pilih2('{{$s->nis}}', '{{$s->nama_lengkap}}')" data-bs-dismiss="modal">
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

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kelas.index') }}" class="btn btn-success">Simpan Data</a>
                            <a href="{{ route('dkelas.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stop

        <script>
            $('#example2').DataTable({
                "responsive": true,
            });
            //Fungsi pilih untuk memilih data user dan mengirimkan data user dari Modal ke form tambah
            function pilih1(kdkelas, kelas) {
                document.getElementById('kdkelas').value = kdkelas
                document.getElementById('kelas').value = kelas
            }
        </script>

        <script>
            $('#example3').DataTable({
                "responsive": true,
            });

            function pilih2(nis, nama_lengkap) {
                document.getElementById('nis').value = nis
                document.getElementById('nama_lengkap').value = nama_lengkap
            }
        </script>