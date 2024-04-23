@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Agenda Kegiatan')
@section('main')
@include('dashboard.main')
<form action="{{ route('agenda.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">



                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kdkelas">
                            @foreach($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Kompetensi Keahlian --}}
                    <div class="form-group">
                        <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                        <select class="form-control" id="kompetensi_keahlian" name="kdkompetensi">
                            @foreach($kompetensi as $item)
                                <option value="{{ $item->id }}">{{ $item->kompetensi_keahlian }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Tahun Ajaran --}}
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}">
                        @error('tahun_ajaran')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Input Semester --}}
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-control">
                            @foreach($semester as $semester)
                            <option value="{{ $semester->keterangan }}">{{ $semester->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>



                    {{-- Input Hari --}}
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control">
                            @foreach($hari as $hari)
                            <option value="{{ $hari->keterangan }}">{{ $hari->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Tanggal Reservasi" name="tanggal" value="{{old('tanggal')}}">
                        @error('tanggal') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control  @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" placeholder="Nama Kegiatan" name="nama_kegiatan" value="{{old('nama_kegiatan')}}">
                        @error('nama_kegiatan') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="waktu">waktu</label>
                        <input type="text" class="form-control  @error('waktu') is-invalid @enderror" id="waktu" placeholder="waktu Reservasi" name="waktu" value="{{old('waktu')}}">
                        @error('waktu') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="dokumentasi" class="formlabel">Dokumentasi</label>
                        <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil" alt="..." width="15%" id="tampil">
                        <input class="form-control @error('dokumentasi') isinvalid @enderror" type="file" id="dokumentasi" name="dokumentasi">
                        @error('dokumentasi') <span class="textdanger">{{$message}}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Keterangan" name="keterangan" value="{{ old('keterangan') }}">
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



    <!-- Modal for Kode Kelas -->
    <div class="modal fade" id="staticBackdropKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelKelas" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabelKelas">Pencarian Kode Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="exampleKelas">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $key => $kelasItem)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td id="kdkelas{{ $key + 1 }}">{{ $kelasItem->kelas }}</td>
                                <td id="kdkelas{{ $key + 1 }}">
                                    {{ $kelasItem->fkompetensi->kompetensi_keahlian }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilihKelas('{{ $kelasItem->id }}', '{{ $kelasItem->kelas }}', '{{ $kelasItem->fkompetensi->kompetensi_keahlian }}')">
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
    <!-- End Modal for Kode Kelas -->

</form>


<script>
    $('#exampleKelas').DataTable({
        "responsive": true,
    });

    function pilihKelas(id, kelas, kompetensi_keahlian) {
        document.getElementById('kdkelas').value = id;
        document.getElementById('kelas').value = kelas;
        document.getElementById('kdkompetensi').value = id; // Change this line according to your data structure
        document.getElementById('kompetensi_keahlian').value =
            kompetensi_keahlian; // Change this line according to your data structure
        $('#staticBackdropKelas').modal('hide');
    }




    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#tampil').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#dokumentasi").change(function() {
        readURL(this);
    });
</script>
</script>

@stop