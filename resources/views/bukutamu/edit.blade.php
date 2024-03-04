@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Buku Tamu')
@section('main')
    @include('dashboard.main')
<form action="{{ route('bukutamu.update', $bukutamu) }}" method="post">
    @csrf
    @method('PUT') <!-- Menambahkan metode PUT untuk update -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="kdsiswa">Nama Siswa</label>
                        <div class="input-group">
                            <input type="hidden" name="kdsiswa" id="kdsiswa" value="{{ old('kdsiswa', $bukutamu->kdsiswa) }}">
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Nama Siswa" id="nama_lengkap" name="nama_lengkap" aria-label="Nama Siswa" value="{{ old('nama_lengkap', $bukutamu->fsiswa->nama_lengkap) }}" aria-describedby="cari" readonly>
                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Cari Nama Siswa
                            </a>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" readonly placeholder="Masukkan Tanggal" name="tanggal" value="{{ date('Y-m-d') ?? old('tanggal') }}">
                        @error('tanggal') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <input type="text" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" placeholder="keperluan" name="keperluan" value="{{ old('keperluan', $bukutamu->keperluan) }}">
                        @error('keperluan')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Edit Semester --}}
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

    

                
                    <div class="form-group">
                        <label for="tahun_ajaran">tahun_ajaran</label>
                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $bukutamu->tahun_ajaran) }}">
                        @error('tahun_ajaran')
                        <span class="text danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>




                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('bukutamu.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Nama Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>

                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $key => $s)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td id={{$key+1}}>{{$s->nama_lengkap}}</td>
                                <td>{{ $s->fkelas->kelas }}</td>
                                <td>{{ $s->fkompetensi->kompetensi_keahlian }}</td>


                                <td>
                                    <button type="button" class="btn btn-primary btn-xs" onclick="pilih('{{$s->id}}', '{{$s->nama_lengkap}}','{{ $s->fkelas->kelas }}', ' <td>{{ $s->fkompetensi->kompetensi_keahlian }}</td>')" data-bs-dismiss="modal">
                                        Pilih
                                    </button>
                                </td>
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

<script>
    $('#example2').DataTable({
        "responsive": true,
    });
    //Fungsi pilih untuk memilih data Kategori wisata dan mengirimkan data kategori wisata dari Modal ke form tambah

    function pilih(id, nama_lengkap, kelas, kompetensi_keahlian) {
        document.getElementById('kdsiswa').value = id
        document.getElementById('nama_lengkap').value = nama_lengkap
        document.getElementById('kelas').value = kelas
        document.getElementById('kompetensi_keahlian').value = kompetensi_keahlian

    }
</script>

@stop