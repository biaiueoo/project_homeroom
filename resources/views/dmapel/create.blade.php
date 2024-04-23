@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Mapel')
@section('main')
@include('dashboard.main')
<form action="{{ route('dmapel.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">

                        <div class="form-group">
                            <label for="kompetensi">kompetensi</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkompetensi" id="kdkompetensi" readonly value="{{ $kdkomp}}">
                                <input type="text" name="kompetensi" id="kompetensi" readonly value="{{$kompetensi}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kdmapel">kdmapel</label>
                            <div class="input-group">
                                <input type="hidden" name="kdmapel" id="kdmapel" readonly value="{{ $cari_id }}">
                                <input type="text" name="kdmapel" id="kdmapel" readonly value="{{$cari_id}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <input type="text" class="form-control @error('mapel') is-invalid @enderror" id="mapel" placeholder="mapel" name="mapel" value="{{ old('mapel') }}">
                            @error('mapel')
                            <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('mapel.index') }}" class="btn btn-success">Simpan Data</a>
                            <a href="{{ route('dmapel.index') }}" class="btn btn-danger">Batal</a>
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