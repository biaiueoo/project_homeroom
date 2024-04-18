@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'kegiatan')
@section('main')
@include('dashboard.main')
<form action="{{ route('kegiatan.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kegiatan">Uraian Kegiatan</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kegiatan">Bukti Fisik</label>
                        <input type="text" class="form-control @error('bukti') is-invalid @enderror" id="bukti" placeholder="bukti" name="bukti" value="{{ old('bukti') }}">
                        @error('bukti')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>



@stop