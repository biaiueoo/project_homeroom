@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Edit Struktur Organisasi Kelas')
@section('main')
@include('dashboard.main')
<form action="{{ route('struktur.update', $struktur->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Form fields for editing data -->

                    <!-- NIS -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" name="nama" value="{{ $struktur->nama }}">
                        @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- jabatan -->
                    <div class="form-group">
                        <label for="jabatan">jabatan</label>
                        <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
                            <option value="Kepala Sekolah" {{ $struktur->jabatan == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                            <option value="Wali Kelas" {{ $struktur->jabatan == 'Wali Kelas' ? 'selected' : '' }}>Wali Kelas</option>
                            <option value="Ketua Kelas" {{ $struktur->jabatan == 'Ketua Kelas' ? 'selected' : '' }}>Ketua Kelas
                            </option>
                            <option value="Wakil Ketua Kelas" {{ $struktur->jabatan == 'Wakil Ketua Kelas' ? 'selected' : '' }}>Wakil Ketua Kelas</option>
                            <option value="Bendahara Kelas" {{ $struktur->jabatan == 'Bendahara Kelas' ? 'selected' : '' }}>Bendahara Kelas</option> 
                            <option value="Sekretaris Kelas" {{ $struktur->jabatan == 'Sekretaris Kelas' ? 'selected' : '' }}>Sekretaris Kelas</option>
                            <option value="Seksi Kebersihan" {{ $struktur->jabatan == 'Seksi Kebersihan' ? 'selected' : '' }}>Seksi Kebersihan</option>
                            <option value="Seksi Perlengkapan" {{ $struktur->jabatan == 'Seksi Perlengkapan' ? 'selected' : '' }}>Seksi Perlengkapan</option>
                            <option value="Seksi Perlengkapan" {{ $struktur->jabatan == 'Seksi Perlengkapan' ? 'selected' : '' }}>Seksi Perlengkapan</option>
                            <option value="Seksi keamanan" {{ $struktur->jabatan == 'Seksi keamanan' ? 'selected' : '' }}>Seksi keamanan</option>
                            <option value="Seksi kerohanian" {{ $struktur->jabatan == 'Seksi kerohanian' ? 'selected' : '' }}>Seksi kerohanian</option>



                        </select>
                        @error('jabatan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('struktur.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>

@stop