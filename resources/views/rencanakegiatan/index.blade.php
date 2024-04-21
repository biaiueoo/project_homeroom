@extends('dashboard.master')

@section('nav')
@include('dashboard.nav')
@endsection

@section('page', 'Rencana Kegiatan')

@section('main')
@include('dashboard.main')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <a href="{{ route('rencanakegiatan.pdf') }}" class="btn btn-secondary mb-2">
                    Download PDF
                </a>
                    <!-- <h1>Rencana Kegiatan Walikelas</h1> -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Uraian Kegiatan</th>
                                    <th colspan="20">Pelaksanaan Kegiatan Minggu Ke</th>
                                    <th>Bukti Fisik</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rencanakegiatan as $key => $k)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $k->fkegiatan->nama }}</td>
                                    <td colspan="20">
                                        <div class="form-check form-check-inline">
                                            @for ($i = 1; $i <= 20; $i++) @php $isChecked=in_array($i, explode(',', $k->minggu_ke));
                                                @endphp
                                                <input type="checkbox" id="minggu_ke_{{ $k->id }}_{{ $i }}" name="minggu_ke[{{ $k->id }}][]" value="{{ $i }}" {{ $isChecked ? 'checked' : '' }} onchange="handleCheckboxChange('{{ $k->id }}', 'minggu_ke_{{ $k->id }}_{{ $i }}')">
                                                <label for="minggu_ke_{{ $k->id }}_{{ $i }}">{{ $i }}</label>
                                                @endfor
                                        </div>
                                    </td>
                                    <td>{{ $k->fbukti->bukti }}</td>
                                    <td id="fileCell_{{ $k->id }}">
                                        <!-- Menampilkan file yang sudah diunggah -->
                                        @if ($k->keterangan)
                                        <a href="{{ asset("storage/{$k->keterangan}") }}" target="_blank">Lihat File</a>
                                        @else
                                        <span id="fileStatus_{{ $k->id }}">Belum ada file diunggah.</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form id="uploadForm_{{ $k->id }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file_keterangan" id="file_keterangan_{{ $k->id }}">
                                            <input type="hidden" name="rencanakegiatan_id" value="{{ $k->id }}">
                                            <button type="button" onclick="uploadFile('{{ $k->id }}')" class="btn btn-sm btn-primary">Unggah</button>
                                        </form>
                                    </td>


                                    <td>
                                        <button type="button" onclick="saveChanges('{{ $k->id }}')" class="btn btn-primary btn-xs">Simpan</button>

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
</div>

<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>

<script>
function uploadFile(rencanaKegiatanId) {
        const fileInput = document.getElementById(`file_keterangan_${rencanaKegiatanId}`);
        const file = fileInput.files[0];
        const formData = new FormData();
        formData.append('file_keterangan', file);
        formData.append('rencanakegiatan_id', rencanaKegiatanId);

        fetch('{{ route("rencana.uploadFile") }}', {
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
            localStorage.setItem(`fileUploaded_${rencanaKegiatanId}`, 'true');
            const fileCell = document.getElementById(`fileCell_${rencanaKegiatanId}`);
            const fileStatusSpan = document.getElementById(`fileStatus_${rencanaKegiatanId}`);
            const uploadForm = document.getElementById(`uploadForm_${rencanaKegiatanId}`);
            const saveButton = document.getElementById(`saveButton_${rencanaKegiatanId}`);

            if (data.keterangan) {
                fileCell.innerHTML = `<a href="${data.keterangan}" target="_blank">Lihat File</a>`;
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
    document.addEventListener('DOMContentLoaded', () => {
    // Periksa status pengunggahan di localStorage saat halaman dimuat
    const forms = document.querySelectorAll('[id^="uploadForm_"]');
    forms.forEach(form => {
        const rencanaKegiatanId = form.id.replace('uploadForm_', '');
        const isUploaded = localStorage.getItem(`fileUploaded_${rencanaKegiatanId}`);

        if (isUploaded === 'true') {
            form.style.display = 'none'; // Sembunyikan form upload
        }
    });
});


</script>

<script>
    function handleCheckboxChange(rencanaKegiatanId, checkboxId) {
        const checkboxes = document.querySelectorAll(`input[name="minggu_ke[${rencanaKegiatanId}][]"]`);

        checkboxes.forEach((checkbox) => {
            if (checkbox.id !== checkboxId) {
                checkbox.checked = false; // Hapus centang dari checkbox lain
            }
        });
    } // Impor Axios dari node_modules

    function saveChanges(rencanaKegiatanId) {
        console.log('ID Rencana Kegiatan:', rencanaKegiatanId);

        const checkboxes = document.querySelectorAll(`input[name="minggu_ke[${rencanaKegiatanId}][]"]:checked`);
        const minggu_ke = Array.from(checkboxes).map(checkbox => checkbox.value).join(',');

        console.log('Minggu ke yang dipilih:', minggu_ke);

        // Konfigurasi objek untuk permintaan PATCH
        const requestOptions = {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json', // Atur header Content-Type untuk tipe JSON
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Atur CSRF token jika diperlukan untuk perlindungan CSRF di Laravel
            },
            body: JSON.stringify({
                minggu_ke: minggu_ke
            }) // Konversi data ke JSON dan kirim sebagai body
        };

        // Kirim permintaan menggunakan fetch API
        fetch(`/rencanakegiatan/${rencanaKegiatanId}`, requestOptions)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menyimpan perubahan.');
                }
                return response.json(); // Mengurai respons sebagai JSON jika perlu
            })
            .then(data => {
                alert('Perubahan disimpan!');
                // Di sini Anda dapat menambahkan logika tambahan jika perlu
            })
            .catch(error => {
                console.error('Gagal menyimpan perubahan:', error);
                alert('Gagal menyimpan perubahan. Periksa konsol untuk detail kesalahan.');
            });
    }
    // Ekspor fungsi saveChanges agar dapat diimpor di file lain jika diperlukan
</script>

<script>
    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah Anda yakin akan menghapus data?')) {
            window.location.href = el.getAttribute('href');
        }
    }
</script>
@endsection