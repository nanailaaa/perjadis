@extends('layouts.default')

@section('content')
<div style="margin-top:100px"></div>
<div class="container mt-4">
    <h3>Rincian Perjalanan: {{ $perjalanan->no_surat }}</h3>
    <p><strong>Tujuan:</strong> {{ $perjalanan->tujuan }}</p>
    <p><strong>Petugas:</strong> {{ $perjalanan->user->name }}</p>
    <hr>

    <form action="{{ route('rincian.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="perjalanan_id" value="{{ $perjalanan->id }}">

        <div class="mb-3">
            <label>Biaya Ke Bandara</label>
            <input type="number" name="biaya_ke_bandara" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Biaya Berangkat</label>
            <input type="number" name="biaya_berangkat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Biaya Pulang</label>
            <input type="number" name="biaya_pulang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Biaya Hotel</label>
            <input type="number" name="biaya_hotel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Biaya Uang Harian</label>
            <input type="number" name="biaya_uh" class="form-control" required>
        </div>

        {{-- Input nomor kursi, tersembunyi dulu --}}
        <div class="mb-3" id="noKursiContainer" style="display:none;">
            <label>Nomor Kursi (Khusus Pesawat)</label>
            <input type="text" name="no_bangku" class="form-control" placeholder="Masukkan nomor kursi">
        </div>

        <div class="mb-3">
            <label>Jenis Transport Berangkat</label>
            <select name="jenis_transport_berangkat" class="form-control transport-select">
                <option value="">-- Pilih Transportasi --</option>
                @foreach($transport as $t)
                    <option value="{{ $t->id }}">{{ $t->nama_transport }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Transport Pulang</label>
            <select name="jenis_transport_pulang" class="form-control transport-select">
                <option value="">-- Pilih Transportasi --</option>
                @foreach($transport as $t)
                    <option value="{{ $t->id }}">{{ $t->nama_transport }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Transport Bandara</label>
            <select name="jenis_transport_bandara" class="form-control transport-select">
                <option value="">-- Pilih Transportasi --</option>
                @foreach($transport as $t)
                    <option value="{{ $t->id }}">{{ $t->nama_transport }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Upload Bukti / Struk / Tiket</label>
            <input type="file" name="foto_rincian" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Rincian</button>
    </form>
</div>

{{-- Script untuk menampilkan Nomor Kursi hanya jika pilih Pesawat --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('.transport-select');
    const noKursiContainer = document.getElementById('noKursiContainer');

    selects.forEach(select => {
        select.addEventListener('change', function() {
            const selectedText = this.options[this.selectedIndex].text.toLowerCase();

            // Kalau pilih transportasi yang mengandung kata 'pesawat'
            if (selectedText.includes('pesawat')) {
                noKursiContainer.style.display = 'block';
            } else {
                noKursiContainer.style.display = 'none';
                document.querySelector('[name="no_bangku"]').value = '';
            }
        });
    });
});
</script>
@endsection
