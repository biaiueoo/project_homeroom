@extends('dashboard.master')
@section('nav')
@include('dashboard.nav')
@endsection
@section('page', 'Kunjungan Rumah')
@section('main')
@include('dashboard.main')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('kunjunganrumah.create') }}" class="btn btn-primary mb-2">
                    Tambah
                </a>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kasus</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Solusi</th>
                                <th>Tanggal</th>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Dokumentasi</th>
                                <th>Surat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjunganrumah as $key => $kr)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $kr->fkasus->kasus }}</td>
                                <td>{{ $kr->fkasus->fsiswa->nama_lengkap}}</td>
                                <td>{{ $kr->fkasus->fsiswa->fkelas->kelas}}</td>
                                <td>{{ $kr->fkasus->fsiswa->fkompetensi->kompetensi_keahlian}}</td>
                                <td>{{ $kr->solusi}}</td>
                                <td>{{ $kr->tanggal}}</td>
                                <td>{{ $kr->fkasus->semester }}</td>
                                <td>{{ $kr->fkasus->tahun_ajaran }}</td>
                                <td>
                                    @if($kr->dokumentasi)
                                    <img src="{{ asset('uploads/' . $kr->dokumentasi) }}" alt="{{ $kr->dokumentasi }}" style="max-width: 100px;">
                                    @else
                                    <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td id="fileCell_{{ $kr->id }}">
                                    <!-- Menampilkan file yang sudah diunggah -->
                                    @if ($kr->surat)
                                    <a href="{{ asset("storage/{$kr->surat}") }}" target="_blank">Lihat File</a>
                                    @else
                                    <span id="fileStatus_{{ $kr->id }}">Belum ada file diunggah.</span>
                                    @endif
                                    <div>
                                        <form id="uploadForm_{{ $kr->id }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file_surat" id="file_surat_{{ $kr->id }}">
                                            <input type="hidden" name="kunjunganrumah_id" value="{{ $kr->id }}">
                                            <button type="button" onclick="uploadFile('{{ $kr->id }}')" class="btn btn-sm btn-primary">Unggah</button>
                                        </form>
                                    </div>
                                </td>
                                <!-- <a href="{{ route('kunjunganrumah.edit', $kr) }}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a> -->
                                </td>
                                <td>
                                    <a href="{{ route('kunjunganrumah.pdf', ['id' => $kr->id]) }}" class="btn btn-secondary btn-xs">
                                        Template Surat
                                    </a>
                                    <a href="{{ route('kunjunganrumah.destroy', $kr) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
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
    function uploadFile(kunjunganRumahId) {
        const fileInput = document.getElementById(`file_surat_${kunjunganRumahId}`);
        const file = fileInput.files[0];
        const formData = new FormData();
        formData.append('file_surat', file);
        formData.append('kunjunganrumah_id', kunjunganRumahId);

        fetch('{{ route("kunjungan.uploadFile") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengunggah file.');
                }
                return response.json();
            })
            .then(data => {
                const fileCell = document.getElementById(`fileCell_${kunjunganRumahId}`);
                const fileStatusSpan = document.getElementById(`fileStatus_${kunjunganRumahId}`);
                const uploadForm = document.getElementById(`uploadForm_${kunjunganRumahId}`);
                const saveButton = document.getElementById(`saveButton_${kunjunganRumahId}`);

                if (data.surat) {
                    fileCell.innerHTML = `<a href="${data.surat}" target="_blank">Lihat File</a>`;
                    fileStatusSpan.textContent = ''; // Kosongkan pesan "Belum ada file diunggah."
                    uploadForm.style.display = 'none'; // Sembunyikan form upload
                    saveButton.style.display = 'inline-block'; // Tampilkan tombol Simpan
                } else {
                    fileCell.innerHTML = 'Belum ada file diunggah.';
                }

                fileInput.value = ''; // Reset nilai input file setelah berhasil diunggah
            })
            .catch(error => {
                console.error('Gagal mengunggah file:', error);
            });
    }
</script>
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