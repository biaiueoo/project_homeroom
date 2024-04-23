@extends('dashboard.master')

@section('nav')
@include('dashboard.nav')
@endsection

@section('page', 'user')

@section('main')
@include('dashboard.main')

<form action="{{ route('users.update', $user) }}" method="post">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control 
@error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="name" value="{{ $user->name ?? old('name') }}">
                        @error('name')
                        <span class="text
danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Email
                            address</label>
                        <input type="email" class="form-control 
@error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email" value="{{ $user->email ?? old('email') }}">
                        @error('email')
                        <span class="text
danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control 
@error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" name="password">
                        @error('password')
                        <span class="text
danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Konfirmasi
                            Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Konfirmasi Password" name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputlevel">Level</label>
                        <select class="form-control @error('level') is
invalid @enderror" id="exampleInputlevel" name="level">
                            <option value="admin" @if ($user->level == 'admin' || old('level') == 'admin') selected @endif>Admin</option>
                            <option value="walikelas" @if ($user->level == 'walikelas' || old('level') == 'walikelas') selected @endif>Wali Kelas
                            </option>
                            <option value="bk" @if ($user->level == 'bk' || old('level') == 'bk') selected @endif>BK</option>
                            <option value="kesiswaan" @if ($user->level == 'kesiswaan' || old('level') == 'kesiswaan') selected @endif>Kesiswaan
                            </option>
                            <option value="kakom" @if ($user->level == 'kakom' || old('level') == 'kakom') selected @endif>Kepala Kompetensi
                            </option>
                            <option value="operator" @if ($user->level == 'operator' || old('level') == 'operator') selected @endif>Operator
                            </option>
                        </select>
                        @error('level')
                        <span class="text
danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="guru_nip">Guru</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" placeholder="Nama Guru" id="nama_guru" name="nama_guru" aria-label="Nama Guru" value="{{ $user->nama_guru ?? old('nama_guru') }}" readonly>
                            <input type="hidden" name="guru_nip" id="guru_nip" value="{{ $user->guru_nip ?? old('guru_nip') }}">
                            <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#11">
                                Cari Guru
                            </a>
                        </div>
                    </div>

                    <!-- Other form fields -->
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
</form>
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
                                <td>{{ $k->nama_guru }}</td>
                                <td>{{ $k->nip }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-xs" onclick="pilihGuru('{{ $k->nama_guru }}', '{{ $k->nip }}')">
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

<!-- JavaScript Section -->
<script>
    $('#example2').DataTable({
        "responsive": true,
    });

    function pilih1(nama_guru, nip) {
        document.getElementById('guru_nip').value = nip;
        document.getElementById('nama_guru').value = nama_guru;
        $('#11').modal('hide'); // Hide the modal with ID #11
    }
</script>
@stop