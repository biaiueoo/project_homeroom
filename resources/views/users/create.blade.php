@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'kegiatan')
@section('main')
@include('dashboard.main')
<form action="{{ route('users.store') }}" method="post">
    @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      
                        <div class="form-group">
                            <label for="exampleInputName">Nama</label>
                            <input type="text" class="form-control 
@error('name') is-invalid @enderror"
                                id="exampleInputName" placeholder="Nama lengkap" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text
danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email
                                address</label>
                            <input type="email" class="form-control 
@error('email') is-invalid @enderror"
                                id="exampleInputEmail" placeholder="Masukkan Email" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text
danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" class="form-control 
@error('password') is-invalid @enderror"
                                id="exampleInputPassword" placeholder="Password" name="password">
                            @error('password')
                                <span class="text
danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Konfirmasi
                                Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword"
                                placeholder="Konfirmasi Password" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputlevel">Level</label>
                            <select class="form-control @error('level') is
invalid @enderror" id="exampleInputlevel"
                                name="level">
                                <option value="admin" @if (old('level') == 'admin') selected @endif>Admin</option>
                                <option value="walikelas" @if (old('level') == 'walikelas') selected @endif>Wali Kelas
                                </option>
                                <option value="bk" @if (old('level') == 'bk') selected @endif>BK</option>
                                <option value="kakom" @if (old('level') == 'kakom') selected @endif>Kepala Kompetensi
                                </option>
                                <option value="kesiswaan" @if (old('level') == 'kesiswaan') selected @endif>Kesiswaan
                                </option>
                                <option value="operator" @if (old('level') == 'operator') selected @endif>operator
                                </option>
                            </select>
                            @error('level')
                                <span class="text
danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="guru_nip">Guru</label>
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

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
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

