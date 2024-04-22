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
                    <h6 class="mb-4">FILTER DATA</h6>
                    <div class="row">
                        <div class="col-md-40 mb-3">
                            <form action="{{ route('laporan.kasus.bk') }}" method="GET" id="filter-form">
                                <div class="col-md-50 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text text-body"><i class="fas fa-search"
                                                aria-hidden="true"></i></span>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                            placeholder="Cari Berdasarkan Nama Siswa">
                                    </div>
                                </div>
                                <div class="form-group col-md-3 mb-3">
                                    {{-- <label for="kompetensi_keahlian">Kompetensi Keahlian:</label> --}}
                                    <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control">
                                        <option value="">-- Pilih Kompetensi Keahlian --</option>
                                        @foreach ($kompetensiKeahlianOptions as $option)
                                            <option value="{{ $option->id }}"
                                                {{ request('kompetensi_keahlian') == $option->id ? 'selected' : '' }}>
                                                {{ $option->kompetensi_keahlian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-4 mb-3" id="kelas-filter"
                            style="{{ request('kompetensi_keahlian') ? '' : 'display:none;' }}">
                            <div class="form-group">
                                {{-- <label for="kelas">Kelas:</label> --}}
                                <select name="kelas" id="kelas" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelasOptions as $option)
                                        <option value="{{ $option->id }}"
                                            {{ request('kelas') == $option->id ? 'selected' : '' }}>
                                            {{ $option->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        @if (request('kompetensi_keahlian'))
                            <div class="col-md-4 mb-3">
                                <div class="form-group text-right">
                                    <a href="{{ route('laporan.kasus.bk') }}" class="btn btn-secondary">Clear Filter</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="laporanKasusBKTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
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
                                            <a href="{{ route('catatankasus.destroy', $ck) }}"
                                                onclick="notificationBeforeDelete(event, this)"
                                                class="btn btn-danger btn-xs">
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
