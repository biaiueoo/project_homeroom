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
                    <h1>Rencana Kegiatan Walikelas</h1>
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
                                    <td>
                                        <!-- Form untuk mengunggah file -->
                                        <form method="POST" action="{{ route('uploadFile') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file_keterangan" id="file_keterangan_{{ $k->id }}">
                                            <input type="hidden" name="rencanakegiatan_id" value="{{ $k->id }}">
                                            <button type="submit" class="btn btn-sm btn-primary">Unggah</button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- Menampilkan file yang sudah diunggah -->
                                            @if ($k->keterangan)
                                            <a href="{{ asset("storage/{$k->keterangan}") }}" alt="{{ $k->keterangan }} target="_blank">Lihat File</a>
                            
                                            @else
                                            Belum ada file diunggah.
                                            @endif
                                    </td>
                                    <td>
                                        <button type="button" onclick="saveChanges('{{ $k->id }}')" class="btn btn-primary btn-xs">Simpan</button>
                                        <a href="{{ route('rencanakegiatan.edit', $k->id) }}" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="{{ route('rencanakegiatan.destroy', $k->id) }}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">Delete</a>
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