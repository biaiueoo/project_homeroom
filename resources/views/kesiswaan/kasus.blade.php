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
                                <th>Opsi</th>
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
                                <td> <button id="btnStatus" type="button" class="btn btn-primary" onclick="prosesAksi('status')">Tutup Kasus</button>
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