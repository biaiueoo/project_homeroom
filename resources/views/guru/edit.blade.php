@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Guru')
@section('main')
    @include('dashboard.main')
    <form action="{{ route('guru.update', $guru) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="NIP" name="nip" value="{{ $guru->nip }}">
                            @error('nip') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_guru">Nama Guru</label>
                            <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" id="nama_guru" placeholder="Nama Guru" name="nama_guru" value="{{ $guru->nama_guru }}">
                            @error('nama_guru') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="notelp">No Telepon</label>
                            <input type="text" class="form-control @error('notelp') is-invalid @enderror" id="notelp" placeholder="No. Telepon" name="notelp" value="{{ $guru->notelp }}">
                            @error('notelp') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" id="jkL" value="L" @if($guru->jk=='L' ) checked @endif>
                                        <label class="form-check-label" for="jkL">Laki-laki</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jk" id="jkP" value="P" @if($guru->jk=='P' ) checked @endif>
                                        <label class="form-check-label" for="jkP">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea rows="5" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ $guru->alamat }}</textarea>
                            @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-select @error('agama') is-invalid @enderror" id="agama" name="agama">
                                <option value="Islam" @if($guru->agama=='Islam' ) selected @endif>Islam</option>
                                <option value="Hindu" @if($guru->agama=='Hindu' ) selected @endif>Hindu</option>
                                <option value="Buddha" @if($guru->agama=='Buddha' ) selected @endif>Budha</option>
                                <option value="Katolik" @if($guru->agama=='Katolik' ) selected @endif>Katolik</option>
                                <option value="Protestan" @if($guru->agama=='Protestan' ) selected @endif>Protestan</option>
                                <option value="Lainnya" @if($guru->agama=='Lainnya' ) selected @endif>Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Tempat Lahir" name="tempat_lahir" value="{{ $guru->tempat_lahir }}">
                            @error('tempat_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}">
                            @error('tanggal_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('guru.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
