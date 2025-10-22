@extends('layouts.default')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Detail Perjalanan Dinas</h3>
        <a href="{{ route('perjalanan.index') }}" class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="perjalananTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab">Detail Perjalanan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rincian-tab" data-bs-toggle="tab" data-bs-target="#rincian" type="button" role="tab">Rincian Biaya</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bukti-tab" data-bs-toggle="tab" data-bs-target="#bukti" type="button" role="tab">Bukti Transaksi</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3" id="perjalananTabsContent">
        <!-- Tab 1: Detail Perjalanan -->
        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>No Surat:</strong> {{ $data->no_surat }}</p>
                            <p><strong>Tujuan:</strong> {{ $data->tujuan }}</p>
                            <p><strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($data->tgl_berangkat)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($data->tgl_pulang)->format('d M Y') }}
                            </p>
                            <p><strong>Hari:</strong> {{ $data->hari }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Deskripsi:</strong> {{ $data->deskripsi_kegiatan ?? '-' }}</p>
                            <p><strong>Penanggung Jawab:</strong> {{ $data->m_tim ?? '-' }}</p>
                            @if ($data->foto_surat)
                                <p><strong>Foto Surat:</strong></p>
                                <img src="{{ asset('storage/'.$data->foto_surat) }}" width="200" class="rounded border shadow-sm" alt="Foto Surat">
                            @else
                                <p class="text-muted">Tidak ada foto surat.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab 2: Rincian Biaya -->
        <div class="tab-pane fade" id="rincian" role="tabpanel" aria-labelledby="rincian-tab">
            @forelse ($data->rincian as $r)
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header bg-light fw-bold">
                        Rincian #{{ $loop->iteration }}
                    </div>
                    <div class="card-body row">
                        <div class="col-md-4">
                            <p><strong>Biaya ke Bandara:</strong> Rp {{ number_format($r->biaya_ke_bandara, 0, ',', '.') }}</p>
                            <p><strong>Biaya Berangkat:</strong> Rp {{ number_format($r->biaya_berangkat, 0, ',', '.') }}</p>
                            <p><strong>Biaya Pulang:</strong> Rp {{ number_format($r->biaya_pulang, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Biaya Hotel:</strong> Rp {{ number_format($r->biaya_hotel, 0, ',', '.') }}</p>
                            <p><strong>Uang Harian:</strong> Rp {{ number_format($r->biaya_uh, 0, ',', '.') }}</p>
                            <p><strong>Total Biaya:</strong>
                                <span class="text-success fw-bold">
                                    Rp {{ number_format($r->total_biaya, 0, ',', '.') }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Transportasi:</strong></p>
                            <ul class="mb-0">
                                <li><b>Ke Bandara:</b> {{ $r->transportBandara->nama_transport ?? '-' }}</li>
                                <li><b>Berangkat:</b> {{ $r->transportBerangkat->nama_transport ?? '-' }}</li>
                                <li><b>Pulang:</b> {{ $r->transportPulang->nama_transport ?? '-' }}</li>
                            </ul>
                            @if ($r->no_bangku_berangkat)
                                <p><strong>No Kursi Berangkat:</strong> {{ $r->no_bangku_berangkat }}</p>
                            @endif
                            @if ($r->no_bangku_pulang)
                                <p><strong>No Kursi Pulang:</strong> {{ $r->no_bangku_pulang }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center text-muted">
                        Belum ada rincian biaya.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Tab 3: Bukti Transaksi -->
        <div class="tab-pane fade" id="bukti" role="tabpanel" aria-labelledby="bukti-tab">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex flex-wrap gap-3">
                    @php $adaBukti = false; @endphp
                    @foreach ($data->rincian as $r)
                        @if ($r->foto_rincian)
                            @php $adaBukti = true; @endphp
                            <div class="text-center">
                                <img src="{{ asset('storage/'.$r->foto_rincian) }}" width="200" class="rounded border shadow-sm mb-2" alt="Bukti Transaksi">
                                <p class="small text-muted mb-0">Rincian #{{ $loop->iteration }}</p>
                            </div>
                        @endif
                    @endforeach

                    @if (!$adaBukti)
                        <p class="text-muted">Belum ada bukti transaksi.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
