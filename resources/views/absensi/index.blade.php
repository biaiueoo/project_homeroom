@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Laporan Kasus BK')
@section('main')
    @include('dashboard.main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Data Absensi Siswa</div>
                    
                    <div class="card-body">
                        <a href="{{ route('attendance.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>

                <div class="card-body">
                    <a href="{{ route('attendance.chart') }}" class="btn 
btn-primary mb-2">
                chart
            </a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS Siswa</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Absensi</th>
                                    <th>Status Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $index => $attendance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $attendance->nis }}</td>
                                        <td>{{ $attendance->siswa->nama_lengkap }}</td>
                                        <td>{{ $attendance->tanggal_absensi }}</td>
                                        <td>{{ $attendance->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
