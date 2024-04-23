@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Agenda Kegiatan')
@section('main')
@include('dashboard.main')
<form action="{{ route('agenda.update', $agenda) }}" method="post">
    @csrf
    @method('PUT') <!-- Menambahkan metode PUT untuk update -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-control">
                            @foreach($semester as $semester)
                            <option value="{{ $semester->keterangan }}" {{ old('semester', $dataEdit->semester) == $semester->keterangan ? 'selected' : '' }}>
                                {{ $semester->keterangan }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Edit Tahun Ajaran --}}
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $agenda->tahun_ajaran) }}">
                        @error('tahun_ajaran')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hari">hari</label>
                        <select name="hari" id="hari" class="form-control">
                            @foreach($hari as $hari)
                            <option value="{{ $hari->keterangan }}" {{ old('hari', $dataEdit->hari) == $hari->keterangan ? 'selected' : '' }}>
                                {{ $hari->keterangan }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tempat Lahir" name="tanggal" value="{{ $agenda->tanggal }}">
                        @error('tanggal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit nama_kegiatan --}}
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" placeholder="Tahun Ajaran" name="nama_kegiatan" value="{{ old('nama_kegiatan', $agenda->nama_kegiatan) }}">
                        @error('nama_kegiatan')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit waktu --}}
                    <div class="form-group">
                        <label for="waktu">Waktu </label>
                        <input type="text" class="form-control @error('waktu') is-invalid @enderror" id="waktu" placeholder="Tahun Ajaran" name="waktu" value="{{ old('waktu', $agenda->waktu) }}">
                        @error('waktu')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit keterangan --}}
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Tahun Ajaran" name="keterangan" value="{{ old('keterangan', $agenda->keterangan) }}">
                        @error('keterangan')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>




                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('agenda.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>

   
@stop