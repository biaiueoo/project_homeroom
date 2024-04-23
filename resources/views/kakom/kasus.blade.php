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
                <h6 class="mb-4">FILTER DATA</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <form action="{{ route('kakom.kasus') }}" method="get" id="filter-form">
                            <div class="col-md-8 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Cari Berdasarkan Nama kasus">
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
                            <a href="{{ route('kakom.kasus') }}" class="btn btn-secondary">Clear Filter</a>
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
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Kasus</th>
                                <th>Dokumentasi</th>
                                <th>Tanggal Kasus</th>
                                <th>Dampingan BK</th>
                                <th>Tindak Lanjut</th>
                                <th>Status Kasus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catatankasus as $key => $ck)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ck->fsiswa->nama_lengkap }}</td>
                                <td>{{ $ck->fsiswa->fkelas->kelas }}</td>
                                <td>{{ $ck->fsiswa->fkompetensi->kompetensi_keahlian }}</td>
                                <td>{{ $ck->semester }}</td>
                                <td>{{ $ck->tahun_ajaran }}</td>
                                <td>{{ $ck->kasus }}</td>
                                <td>
                                    @if($ck->keterangan)
                                    <a href="data:application/pdf;base64,{{ base64_encode($ck->keterangan) }}" target="_blank">Lihat Dokumen</a>
                                    @else
                                    <span>Tidak ada dokumen</span>
                                    @endif
                                </td>
                                <td>{{ $ck->tanggal }}</td>
                                <td>{{ $ck->dampingan_bk }}</td>
                                <td>{{ $ck->tindak_lanjut }}</td>
                                <td id="status" data-id="{{ $ck->id }}">{{ $ck->status_kasus }}</td>
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
    $('#example2').DataTable({
        "responsive": true,
    });

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

    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }

    function prosesAksi(aksi) {
        let id = document.getElementById('status').getAttribute('data-id');
        let url = '';

        if (aksi === 'status') { // Sesuaikan dengan aksi yang diberikan pada tombol HTML
            url = '{{ route("selesaikanKasus") }}';

            // Kirim permintaan Ajax menggunakan Axios
            axios.post(url, {
                    id: id
                })
                .then(response => {
                    if (response.data.success) {
                        // Ubah tampilan tergantung pada hasil sukses dari server
                        document.getElementById('status').textContent = 'Kasus Selesai';
                        // Hapus tombol "Mulai Pembinaan" setelah berhasil
                        document.getElementById('btnStatus').remove();

                        // Simpan status aksi ke localStorage
                        localStorage.setItem('kasusDone', true);
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
        }
    }

    // Saat halaman dimuat, periksa status aksi dari localStorage
    document.addEventListener('DOMContentLoaded', function() {
        let kasusDone = localStorage.getItem('kasusDone');
        if (kasusDone) {
            // Jika pembinaan sudah dilakukan sebelumnya, sembunyikan tombol "Mulai Pembinaan"
            document.getElementById('btnStatus').style.display = 'none';
        }
    });
</script>