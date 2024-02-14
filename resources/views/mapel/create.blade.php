@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Mata Pelajaran')
@section('main')
    @include('dashboard.main')
<form action="{{route('mapel.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran</label>
                        <input type="text" class="form-control 
@error('mata_pelajaran') is-invalid @enderror" id="mata_pelajaran" placeholder="Mata Pelajaran" name="mata_pelajaran" value="{{old('mata_pelajaran')}}">
                        @error('mata_pelajaran') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('mapel.index')}}" class="btn btn-danger">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    @stop