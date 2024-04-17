@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Laporan Kasus BK')
@section('main')
    @include('dashboard.main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('catatankasus.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="kelas" class="form-control">
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($laporanKasusBK as $item)
                                            <option value="{{ $item->fsiswa->fkelas->id }}">{{ $item->fsiswa->fkelas->kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="kompetensi_keahlian" class="form-control">
                                        <option value="">Pilih Kompetensi Keahlian</option>
                                        @foreach ($laporanKasusBK as $item)
                                            <option value="{{ $item->fsiswa->fkompetensi->id }}">{{ $item->fsiswa->fkompetensi->kompetensi_keahlian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    @if(request('kelas') || request('kompetensi_keahlian'))
                                        <a href="{{ route('catatankasus.index') }}" class="btn btn-secondary">Clear Filter</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="laporanKasusBKTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Id Catatan Kasus</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Catatan Kasus</th>
                                    <th>Tanggal Kasus</th>
                                    <th>Tindak Lanjut</th>
                                    <th>Status Kasus</th>
                                    <th>Dampingan BK</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanKasusBK as $key => $ck)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $ck->id }}</td>
                                        <td>{{ $ck->fsiswa->nama_lengkap }}</td>
                                        <td>{{ $ck->fsiswa->fkelas->kelas }}</td>
                                        <td>{{ $ck->fsiswa->fkompetensi->kompetensi_keahlian }}</td>
                                        <td>{{ $ck->semester }}</td>
                                        <td>{{ $ck->tahun_ajaran }}</td>
                                        <td>{{ $ck->kasus }}</td>
                                        <td>{{ $ck->tanggal }}</td>
                                        <td>{{ $ck->tindak_lanjut }}</td>
                                        <td>{{ $ck->status_kasus }}</td>
                                        <td>{{ $ck->dampingan_bk }}</td>
                                        <td>
                                            <a href="{{ route('catatankasus.edit', $ck) }}" class="btn btn-primary btn-xs">
                                                Edit
                                            </a>
                                            <a href="{{ route('catatankasus.destroy', $ck) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                                Delete
                                            </a>
                                        </td>
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

<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Submit form when competency field changes
        $('#kompetensi_keahlian').change(function() {
            console.log("pilih kompetensi keahlian")
            $('#filter-form').submit();
        });

        // Submit form when class field changes
        $('#kelas').change(function() {
            $('#filter-form').submit();
        });
    });
</script>
