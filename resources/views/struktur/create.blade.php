@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Struktur Organisasi Kelas')
@section('main')
@include('dashboard.main')
<form action="{{ route('struktur.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kegiatan">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
    <label for="jabatan">Jabatan</label>
    <select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
        <option value="Kepala Sekolah" {{ old('jabatan') == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
        <option value="Wali Kelas" {{ old('jabatan') == 'Wali Kelas' ? 'selected' : '' }}>Wali Kelas</option>
        <option value="Ketua Kelas" {{ old('jabatan') == 'Ketua Kelas' ? 'selected' : '' }}>Ketua Kelas</option>
        <option value="Wakil Ketua Kelas" {{ old('jabatan') == 'Wakil Ketua Kelas' ? 'selected' : '' }}>Wakil Ketua Kelas</option>
        <option value="Bendahara Kelas" {{ old('jabatan') == 'Bendahara Kelas' ? 'selected' : '' }}>Bendahara Kelas</option>
        <option value="Sekretaris Kelas" {{ old('jabatan') == 'Sekretaris Kelas' ? 'selected' : '' }}>Sekretaris Kelas</option>
        <option value="Seksi Kebersihan" {{ old('jabatan') == 'Seksi Kebersihan' ? 'selected' : '' }}>Seksi Kebersihan</option>
        <option value="Seksi Perlengkapan" {{ old('jabatan') == 'Seksi Perlengkapan' ? 'selected' : '' }}>Seksi Perlengkapan</option>
        <option value="Seksi Keamanan" {{ old('jabatan') == 'Seksi Keamanan' ? 'selected' : '' }}>Seksi Keamanan</option>
        <option value="Seksi Kerohanian" {{ old('jabatan') == 'Seksi Kerohanian' ? 'selected' : '' }}>Seksi Kerohanian</option>
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