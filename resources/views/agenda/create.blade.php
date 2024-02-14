@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Agenda')
@section('main')
    @include('dashboard.main')
    <form action="{{ route('agenda.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                    

                        {{-- Input Kelas --}}
                        <div class="form-group">
                            <label for="kdkelas">Kelas</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkelas" id="kdkelas"
                                    value="{{ old('kdkelas') }}">
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                    placeholder="Kelas" id="kelas" name="kelas"
                                    aria-label="Kelas" value="{{ old('kelas') }}"
                                    aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropKelas">
                                    Cari Kelas
                                </a>
                            </div>
                        </div>

                        {{-- Input Kompetensi --}}
                        <div class="form-group">
                            <label for="kdkompetensi">Kompetensi Keahlian</label>
                            <div class="input-group">
                                <input type="hidden" name="kdkompetensi" id="kdkompetensi"
                                    value="{{ old('kdkompetensi') }}">
                                <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror"
                                    placeholder="Kompetensi Keahlian" id="kompetensi_keahlian" name="kompetensi_keahlian"
                                    aria-label="Kompetensi Keahlian" value="{{ old('kompetensi_keahlian') }}"
                                    aria-describedby="cari" readonly>
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropKompetensi">
                                    Cari Kompetensi Keahlian
                                </a>
                            </div>
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
                        <label for="waktu">waktu</label>
                        <input type="time" class="form-control  @error('waktu') is-invalid @enderror" id="waktu" placeholder="waktu Reservasi" name="waktu" value="{{old('waktu')}}">
                        @error('waktu') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                        {{-- Input Tahun Ajaran --}}
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran"
                                placeholder="Tahun Ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}">
                            @error('tahun_ajaran')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Input Tahun Ajaran --}}
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                placeholder="Keterangan" name="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <span class="text danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="hasil" class="formlabel">Hasil</label>
                            <img src="/img/no-image.png" class="imgthumbnail d-block" name="tampil" alt="..." width="15%" id="tampil">
                            <input class="form-control @error('hasil') isinvalid @enderror" type="file" id="hasil" name="hasil">
                            @error('hasil') <span class="textdanger">{{$message}}</span> @enderror
                        </div>


                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('agenda.index') }}" class="btn btn-default">Batal</a>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Modal Kelas -->
        <div class="modal fade" id="staticBackdropKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropKelas" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropKelas">Pencarian Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="carikelas">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kelas</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $key => $kel)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td id="kdkelas{{ $key + 1 }}">{{ $kel->kelas }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                                onclick="pilihkelas('{{ $kel->id }}', '{{ $kel->kelas }}')">
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

        <!-- Modal Kompetensi -->
        <div class="modal fade" id="staticBackdropKompetensi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropKompetensi" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropKompetensi">Pencarian Kompetensi Keahlian</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered table-stripped" id="carikompetensi">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kompetensi as $key => $k)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td id="kdkompetensi{{ $key + 1 }}">{{ $k->kompetensi_keahlian }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-xs"
                                                onclick="pilihkompetensi('{{ $k->id }}', '{{ $k->kompetensi_keahlian }}')">
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

        
    </form>

    @push('js')
        <script>

           

            $('#carikelas').DataTable({
                "responsive": true,
            });

            function pilihkelas(id, kelas) {
                document.getElementById('kdkelas').value = id;
                document.getElementById('kelas').value = kelas;
                $('#staticBackdropKelas').modal('hide');
            }

            $('#carikompetensi').DataTable({
                "responsive": true,
            });

            function pilihkompetensi(id, kompetensi_keahlian) {
                document.getElementById('kdkompetensi').value = id;
                document.getElementById('kompetensi_keahlian').value = kompetensi_keahlian;
                $('#staticBackdropKompetensi').modal('hide');
            }

           
        </script>

<script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tampil').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#hasil").change(function() {
            readURL(this);
        });
    </script>
    @endpush
@stop