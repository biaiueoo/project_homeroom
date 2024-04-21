@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Daftar Rapot')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('daftarrapot.create') }}" class="btn 
btn-primary mb-2">
                    Tambah
                </a>

                <a href="{{ route('daftarrapot.pdf') }}" class="btn btn-secondary mb-2">
                    Download PDF
                </a>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered 
table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Nama Orang tua</th>
                                <th>tanggal</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Dokumentasi</th>
                                <th>Status</th>
                                <th></th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarrapot as $key => $dr)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $dr->fsiswa->nama_lengkap }}</td>
                                <td>{{ $dr->fsiswa->nama_ayah }}</td>

                                <td>{{ $dr->tanggal }}</td>
                                <td>{{ $dr->semester }}</td>

                                <td>{{ $dr->tahun_ajaran }}</td>

                                <td>
                                    <img src="{{ asset("storage/{$dr->Dokumentasi}") }}" alt="{{ $dr->Dokumentasi }} tidak tampil" class="img-thumbnail" width="200">
                                </td>


                                <td id="rapot" data-id="{{ $dr->id }}">{{ $dr->rapor }}</td>


                                <td> <button id="btnPenyerahan" type="button" class="btn btn-primary" onclick="prosesAksi('penyerahan')">Penyerahan</button>
                                </td>
                                <td>
                                    <a href="{{ route('daftarrapot.edit', $dr) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{ route('daftarrapot.destroy', $dr) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<script>
    function prosesAksi(aksi) {
        let id = document.getElementById('rapot').getAttribute('data-id');
        let url = '';

        if (aksi === 'penyerahan') {
            url = '{{ route("prosesPenyerahan") }}';

            // Kirim permintaan Ajax menggunakan Axios
            axios.post(url, {
                    id: id
                })
                .then(response => {
                    if (response.data.success) {
                        // Ubah tampilan tergantung pada hasil sukses dari server
                        document.getElementById('rapot').textContent = 'Selesai';
                        // Hapus tombol Penyerahan setelah berhasil
                        document.getElementById('btnPenyerahan').remove();

                        // Simpan status aksi ke localStorage
                        localStorage.setItem('penyerahanDone', true);
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
        }
    }

    // Saat halaman dimuat, periksa status aksi dari localStorage
    document.addEventListener('DOMContentLoaded', function() {
        let penyerahanDone = localStorage.getItem('penyerahanDone');
        if (penyerahanDone) {
            // Jika penyerahan sudah dilakukan sebelumnya, sembunyikan tombol Penyerahan
            document.getElementById('btnPenyerahan').style.display = 'none';
        }
    });
</script>