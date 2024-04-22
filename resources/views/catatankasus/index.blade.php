@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Catatan Kasus')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('catatankasus.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>
                <a href="{{ route('ckpdf') }}" class="btn btn-secondary mb-2">Template SP</a>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Catatan Kasus</th>
                                <th>Keterangan</th>
                                <th>Tanggal Kasus</th>
                                <th>Tindak Lanjut</th>
                                <th>Status Kasus</th>
                                <th>Dampingan BK</th>
                                {{-- @if (Auth::user()->level == 'admin')
                                        <th>User Admin</th>
                                    @elseif(Auth::user()->level == 'walas')
                                        <th>User Walas</th>
                                    @elseif(Auth::user()->level == 'bk')
                                        <th>User BK</th>
                                    @elseif(Auth::user()->level == 'kakom')
                                        <th>User Kakom</th>
                                    @endif --}}
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catatankasus as $key => $ck)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ck->fsiswa->nama_lengkap }}</td>
                                <td>{{ $ck->semester }}</td>
                                <td>{{ $ck->tahun_ajaran }}</td>
                                <td>{{ $ck->kasus }}</td>
                                {{-- <td>
                                            @if ($ck->keterangan)
                                                @php
                                                    $extension = pathinfo($ck->keterangan, PATHINFO_EXTENSION);
                                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                                @endphp

                                                @if (in_array($extension, $imageExtensions))
                                                    <img src="{{ asset('uploads/' . $ck->keterangan) }}"
                                alt="File Image" style="max-width: 100px; max-height: 100px;">
                                @else
                                <a href="{{ asset('uploads/' . $ck->keterangan) }}" target="_blank">
                                    Tampilkan File
                                </a>
                                @endif
                                @endif
                                <form action="{{ route('catatankasus.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="kdsiswa" value="{{ old('kdsiswa') }}">
                                    <input type="file" name="keterangan" accept=".pdf, .doc, .docx, .xls, .xlsx, .jpg, .jpeg, .png">
                                    <button type="submit" class="btn btn-primary">Upload Keterangan</button>
                                </form>
                                </td> --}}

                                {{-- <td>
                                            @if ($ck->keterangan)
                                                @php
                                                    $extension = pathinfo($ck->keterangan, PATHINFO_EXTENSION);
                                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                                @endphp

                                                @if (in_array($extension, $imageExtensions))
                                                    <img src="{{ asset('uploads/' . $ck->keterangan) }}" alt="File Image"
                                style="max-width: 100px; max-height: 100px;">
                                @else
                                <a href="{{ asset('uploads/' . $ck->keterangan) }}" target="_blank">
                                    {{ $ck->keterangan }}
                                </a>
                                @endif
                                @endif
                                </td> --}}

                                <td>
                                    @if ($ck->keterangan)
                                    <a href="data:application/pdf;base64,{{ base64_encode($ck->keterangan) }}" target="_blank">Lihat Dokumen</a>
                                    @else
                                    <span>Tidak ada dokumen</span>
                                    @endif
                                </td>


                                <td>{{ $ck->tanggal }}</td>
                                <td>{{ $ck->tindak_lanjut }}</td>
                                <td>
                                    <form action="{{ route('catatankasus.updateStatus', $ck->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="baru" {{ $ck->status_kasus == 'baru' ? 'selected' : '' }}>Baru</option>
                                            <option value="proses" {{ $ck->status_kasus == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="selesai" {{ $ck->status_kasus == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Ubah Status</button>
                                    </form>
                                </td>

                                <td>{{ $ck->dampingan_bk }}</td>
                                {{-- @if (Auth::user()->level == 'admin')
                                            <td>{{ $ck->user_admin }}</td>
                                @elseif(Auth::user()->level == 'walas')
                                <td>{{ $ck->user_walas }}</td>
                                @elseif(Auth::user()->level == 'bk')
                                <td>{{ $ck->user_bk }}</td>
                                @elseif(Auth::user()->level == 'kakom')
                                <td>{{ $ck->user_kakom }}</td>
                                @endif --}}
                                <td>
                                    <a href="{{ route('catatankasus.edit', $ck) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('catatankasus.destroy', $ck) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
                                    <a href="{{ route('ckpdf', ['id' => $ck->id]) }}" class="btn btn-secondary btn-xs">
                                        Unduh BAP
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
<script>
    $('#example2').DataTable({
        "responsive": true,
    });

    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
</script>