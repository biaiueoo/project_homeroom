@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Pembinaan Kasus')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4">FILTER DATA</h6>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stripped" id="laporanKasusBKTable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Kasus</th>
                                    <th>Tanggal Kasus</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporanKasusBK as $key => $ck)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ck->fkasus->fsiswa->nama_lengkap }}</td>
                                    <td>{{ $ck->fkasus->fsiswa->fkelas->kelas }}</td>
                                    <td>{{ $ck->fkasus->fsiswa->fkompetensi->kompetensi_keahlian }}</td>
                                    <td>{{ $ck->fkasus->semester }}</td>
                                    <td>{{ $ck->fkasus->tahun_ajaran }}</td>
                                    <td>{{ $ck->fkasus->kasus }}</td>
                                    <td>{{ $ck->fkasus->tanggal }}</td>
                                    <td id="status" data-id="{{ $ck->id }}">{{ $ck->status }}</td>


                                    <td> <button id="btnStatus" type="button" class="btn btn-primary" onclick="prosesAksi('status')">Akhiri Pembinaan</button>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function prosesAksi(aksi) {
            let id = document.getElementById('status').getAttribute('data-id');
            let url = '';

            if (aksi === 'status') {
                url = '{{ route("selesaiPembinaan") }}';

                // Kirim permintaan Ajax menggunakan Axios
                axios.post(url, {
                        id: id
                    })
                    .then(response => {
                        if (response.data.success) {
                            // Ubah tampilan tergantung pada hasil sukses dari server
                            document.getElementById('status').textContent = 'Kasus Selesai';
                            // Hapus tombol Penyerahan setelah berhasil
                            document.getElementById('btnStatus').remove();

                            // Simpan status aksi ke localStorage
                            //  localStorage.setItem('pembinaanDone', true);
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan:', error);
                    });
            }
        }

        // Saat halaman dimuat, periksa status aksi dari localStorage
        // document.addEventListener('DOMContentLoaded', function() {
        //     let pembinaanDone = localStorage.getItem('pembinaanDone');
        //     if (pembinaanDone) {
        //         // Jika penyerahan sudah dilakukan sebelumnya, sembunyikan tombol Penyerahan
        //         document.getElementById('btnStatus').style.display = 'none';
        //     }
        // });

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
    </script>