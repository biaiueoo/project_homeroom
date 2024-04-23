@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Kunjungan Rumah')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4">FILTER DATA</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <form action="{{ route('kakom.homevisit') }}" method="get" id="filter-form">
                                <div class="col-md-8 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Cari Berdasarkan Nama homevisit">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control">
                                        <option value="">-- Pilih Kompetensi Keahlian --</option>
                                        @foreach ($kompetensiKeahlianOptions as $option)
                                            <option value="{{ $option->id }}" {{ request('kompetensi_keahlian') == $option->id ? 'selected' : '' }}>
                                                {{ $option->kompetensi_keahlian }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-4 mb-3" id="kelas-filter" style="{{ request('kompetensi_keahlian') ? '' : 'display:none;' }}">
                            <div class="form-group">
                                <select name="kelas" id="kelas" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelasOptions as $option)
                                        <option value="{{ $option->id }}" {{ request('kelas') == $option->id ? 'selected' : '' }}>
                                            {{ $option->kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (request('kompetensi_keahlian'))
                            <div class="col-md-4 mb-3">
                                <div class="form-group text-right">
                                    <a href="{{ route('kakom.homevisit') }}" class="btn btn-secondary">Clear Filter</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    </form>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kasus</th>
                                <th>Nama Siswa</th>
                                <th>Solusi</th>
                                <th>Tanggal</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Dokumentasi</th>
                                <th>Surat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjunganrumah as $key => $kr)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $kr->fkasus->kasus }}</td>
                                <td>{{ $kr->fkasus->fsiswa->nama_lengkap}}</td>
                                <td>{{ $kr->solusi}}</td>
                                <td>{{ $kr->tanggal}}</td>
                                <td>{{ $kr->fkasus->semester }}</td>
                                <td>{{ $kr->fkasus->tahun_ajaran }}</td>
                                <td>
                                    @if($kr->dokumentasi)
                                    <img src="{{ asset('uploads/' . $kr->dokumentasi) }}" alt="{{ $kr->dokumentasi }}" style="max-width: 100px;">
                                    @else
                                    <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td id="fileCell_{{ $kr->id }}">
                                    <!-- Menampilkan file yang sudah diunggah -->
                                    @if ($kr->surat)
                                    <a href="{{ asset("storage/{$kr->surat}") }}" target="_blank">Lihat File</a>
                                    @else
                                    <span id="fileStatus_{{ $kr->id }}">Belum ada file diunggah.</span>
                                    @endif
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
        // Menyimpan nilai input nama_lengkap saat submit form
        var namaLengkapValue = "{{ request('nama_lengkap') }}";
        $('#nama_lengkap').val(namaLengkapValue);

        // Submit form when competency field changes
        $('#kompetensi_keahlian').change(function() {
            $('#filter-form').submit();
        });

        // Submit form when class field changes
        $('#kelas').change(function() {
            $('#filter-form').submit();
        });

        // Submit form when nama_lengkap field value changes
        $('#nama_lengkap').on('input', function() {
            $('#filter-form').submit();
        });
    });
</script>