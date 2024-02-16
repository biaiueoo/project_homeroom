@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Siswa')
@section('main')
    @include('dashboard.main')
    <form action="{{ route('kompetensi.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="file">Upload File (jpg, jpeg, png, pdf)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="{{ route('kompetensi.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
