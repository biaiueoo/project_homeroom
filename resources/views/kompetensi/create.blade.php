@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Guru')
@section('main')
@include('dashboard.main')
<form action="{{ route('kompetensi.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="form-group">
                            <label for="file">Upload File (jpg, jpeg, png, pdf)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="form-group">
                    <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                    <input type="text" class="form-control 
    @error('kompetensi_keahlian') is-invalid @enderror" id="kompetensi_keahlian" placeholder="Kompetensi Keahlian" name="kompetensi_keahlian" value="{{old('kompetensi_keahlian')}}">
                    @error('kompetensi_keahlian') <span class="text-danger">{{$message}}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="guru_nip">Kepala Program</label>
                    <input type="hidden" name="guru_nip" id="guru_nip" value="{{ old('guru_nip') }}">
                    <div class="input-group">
                        <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" placeholder="nama_guru" id="nama_guru" name="nama_guru" aria-label="nama_guru" value="{{ old('nama_guru') }}" aria-describedby="cari" readonly>
                        <div class="input-group-append">
                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                Cari Guru
                            </a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}">
                    @error('tahun_ajaran')
                    <span class="text danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Modal GURU -->
                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel1">Pencarian Guru</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover table-bordered table-stripped" id="example2">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guru as $key => $k)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td id="guru_nip{{ $key + 1 }}">{{ $k->nama_guru }}</td> <!-- Perbaiki di sini -->
                                            <td id="guru_nip{{ $key + 1 }}">{{ $k->nip }}</td> <!-- Perbaiki di sini -->
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs" onclick="pilih1('{{ $k->nama_guru }}', '{{ $k->nip }}')">
                                                    Pilih
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
                <!-- End Modal -->

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
                <a href="{{ route('kompetensi.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </div>
    </div>
</form>
<script>
    $('#example2').DataTable({
        "responsive": true,
    });

    function pilih1(nama_guru, nip) {
        document.getElementById('guru_nip').value = nip; // Perbaiki variabel nip
        document.getElementById('nama_guru').value = nama_guru;
        $('#staticBackdrop1').modal('hide');
    }
</script>

@stop