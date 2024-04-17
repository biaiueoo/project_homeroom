@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Siswa (Kesiswaan)')
@section('main')
    @include('dashboard.main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4">FILTER DATA</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <form action="{{ route('siswakes.index') }}" method="get" id="filter-form">
                                <div class="form-group"> 
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
                                    <a href="{{ route('siswakes.index') }}" class="btn btn-secondary">Clear Filter</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    </form>
                    {{-- <hr> //
                    @if (request('kompetensi_keahlian'))
                        <p><strong>Kompetensi Keahlian:</strong>
                            {{ $kompetensiKeahlianOptions->firstWhere('id', request('kompetensi_keahlian'))->kompetensi_keahlian }}
                        </p>
                    @endif
                    @if (request('kelas'))
                        <p><strong>Kelas:</strong> {{ $kelasOptions->firstWhere('id', request('kelas'))->kelas }}</p>
                    @endif
                    <hr> --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Nama Ayah</th>
                                    <th>Nama Ibu</th>
                                    <th>Tempat Lahir</th>
                                    <th>Alamat</th>
                                    <th>Agama</th>
                                    <th>Kewarganegaraan</th>
                                    <th>No. HP</th>
                                    <th>Email</th>
                                    <th>NISN</th>
                                    <th>Tahun Masuk</th>
                                    <th>Alamat Orang Tua</th>
                                    <th>No. Orang Tua</th>
                                    <th>Nama Sekolah Asal</th>
                                    <th>Alamat Sekolah</th>
                                    <th>Tahun Lulus</th>
                                    <th>Riwayat Penyakit</th>
                                    <th>Alergi</th>
                                    <th>Prestasi Akademik</th>
                                    <th>Prestasi Non-Akademik</th>
                                    <th>Ekstrakurikuler</th>
                                    <th>Biografi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $key => $s)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $s->nis }}</td>
                                        <td>{{ $s->nama_lengkap }}</td>
                                        <td>{{ $s->fkelas->kelas }}</td>
                                        <td>{{ $s->fkompetensi->kompetensi_keahlian }}</td>
                                        <td>{{ $s->nama_ayah }}</td>
                                        <td>{{ $s->nama_ibu }}</td>
                                        <td>{{ $s->tempat_lahir }}</td>
                                        <td>{{ $s->alamat }}</td>
                                        <td>{{ $s->agama }}</td>
                                        <td>{{ $s->kewarganegaraan }}</td>
                                        <td>{{ $s->no_hp }}</td>
                                        <td>{{ $s->email }}</td>
                                        <td>{{ $s->nisn }}</td>
                                        <td>{{ $s->tahun_masuk }}</td>
                                        <td>{{ $s->alamat_ortu }}</td>
                                        <td>{{ $s->no_ortu }}</td>
                                        <td>{{ $s->nama_sekolah_asal }}</td>
                                        <td>{{ $s->alamat_sekolah }}</td>
                                        <td>{{ $s->tahun_lulus }}</td>
                                        <td>{{ $s->riwayat_penyakit }}</td>
                                        <td>{{ $s->alergi }}</td>
                                        <td>{{ $s->prestasi_akademik }}</td>
                                        <td>{{ $s->prestasi_non_akademik }}</td>
                                        <td>{{ $s->ekstrakurikuler }}</td>
                                        <td>{{ $s->biografi }}</td>
                                        <td>
                                            <a href="{{ route('siswakes.edit', $s) }}"
                                                class="btn btn-primary btn-xs">Edit</a>
                                            <a href="{{ route('siswakes.destroy', $s) }}"
                                                onclick="notificationBeforeDelete(event, this)"
                                                class="btn btn-danger btn-xs">Delete</a>
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
