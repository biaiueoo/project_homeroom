@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Laporan Kasus BK')
@section('main')
    @include('dashboard.main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Absensi Siswa</div>

                    <div class="card-body">
                        @if (session('success_message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success_message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('attendance.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nis">NIS Siswa</label>
                                <input type="text" class="form-control" id="nis" name="nis" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_absensi">Tanggal Absensi</label>
                                <input type="date" class="form-control" id="tanggal_absensi" name="tanggal_absensi"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="status">Status Absensi</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="hadir">Hadir</option>
                                    <option value="absen">Absen</option>
                                    <option value="izin">Izin</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
