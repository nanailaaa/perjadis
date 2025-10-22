@extends('layouts.default')

@section('content')
<div class="container-fluid mt-5 pt-5">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0 text-white">Daftar Perjalanan Dinas</h5>
      <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#perjalananModal">
        <i class="ti ti-plus"></i> Tambah Perjalanan
      </button>
    </div>

    <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-primary text-center">
            <tr>
              <th>No</th>
              <th>Nama Pegawai</th>
              <th>No Surat</th>
              <th>Tujuan</th>
              <th>Tanggal</th>
              <th>Hari</th>
              <th>Foto Surat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $key => $item)
              <tr>
                <td class="text-center">{{ $data->firstItem() + $key }}</td>
                <td>{{ $item->user->username ?? '-' }}</td>
                <td>{{ $item->no_surat }}</td>
                <td>{{ $item->tujuan }}</td>
                <td>{{ $item->tgl_berangkat }} - {{ $item->tgl_pulang }}</td>
                <td>{{ $item->hari }}</td>
                <td class="text-center">
                  @if($item->foto_surat)
                    <img src="{{ asset('storage/'.$item->foto_surat) }}" alt="Surat" width="80" class="rounded">
                  @endif
                </td>
                <td class="text-center">
                  <a href="{{ route('perjalanan.show', $item->id) }}" class="btn btn-info btn-sm text-white mb-1">Detail</a>
                  <form action="{{ route('perjalanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center">Tidak ada data</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-center mt-3">
        {{ $data->links() }}
      </div>
    </div>
  </div>
</div>

{{-- ===========================
     MODAL TAMBAH PERJALANAN
   =========================== --}}
<div class="modal fade" id="perjalananModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="perjalananModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="perjalananModalLabel">Tambah Perjalanan Dinas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('perjalanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          {{-- TAB NAVIGATION --}}
          <ul class="nav nav-tabs" id="perjalananTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab-perjalanan" data-bs-toggle="tab" data-bs-target="#content-perjalanan" type="button" role="tab">Perjalanan Dinas</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-rincian" data-bs-toggle="tab" data-bs-target="#content-rincian" type="button" role="tab">Rincian Biaya</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="tab-bukti" data-bs-toggle="tab" data-bs-target="#content-bukti" type="button" role="tab">Bukti Transaksi</button>
            </li>
          </ul>

          <div class="tab-content mt-3" id="perjalananTabsContent">

            {{-- TAB PERJALANAN --}}
            <div class="tab-pane fade show active" id="content-perjalanan" role="tabpanel">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Pegawai</label>
                  <select name="user_id" class="form-select" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Tim Penanggung Jawab</label>
                  <select name="tim_penanggung_jawab" class="form-select" required>
                    <option value="">-- Pilih Tim --</option>
                    @foreach ($tim as $item)
                      <option value="{{ $item->tim_penanggung_jawab }}">{{ $item->tim_penanggung_jawab }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Nomor Surat</label>
                  <input type="text" name="no_surat" class="form-control" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Tujuan</label>
                  <input type="text" name="tujuan" class="form-control" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Tanggal Berangkat</label>
                  <input type="date" name="tgl_berangkat" class="form-control" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Tanggal Pulang</label>
                  <input type="date" name="tgl_pulang" class="form-control" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Hari</label>
                  <input type="number" name="hari" class="form-control" required>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Foto Surat</label>
                  <input type="file" name="foto_surat" class="form-control" accept="image/*" required>
                </div>

                <div class="col-12">
                  <label class="form-label">Deskripsi Kegiatan</label>
                  <textarea name="deskripsi_kegiatan" class="form-control" rows="3" placeholder="Tuliskan deskripsi kegiatan dinas..."></textarea>
                </div>
              </div>
            </div>

            {{-- TAB RINCIAN --}}
            <div class="tab-pane fade" id="content-rincian" role="tabpanel">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Biaya ke Bandara</label>
                  <input type="number" name="biaya_ke_bandara" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Biaya Berangkat</label>
                  <input type="number" name="biaya_berangkat" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Biaya Pulang</label>
                  <input type="number" name="biaya_pulang" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Biaya Hotel</label>
                  <input type="number" name="biaya_hotel" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Uang Harian</label>
                  <input type="number" name="biaya_uh" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Total Biaya</label>
                  <input type="number" name="total_biaya" class="form-control">
                </div>

                {{-- Transport Berangkat --}}
                <div class="col-md-6">
                  <label class="form-label">Transport Berangkat</label>
                  <select name="jenis_transport_berangkat" id="transportBerangkat" class="form-select transport-select">
                    <option value="">-- Pilih Transportasi --</option>
                    @foreach($transport as $t)
                      <option value="{{ $t->id }}">{{ $t->jenis_transport }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6" id="noKursiBerangkatContainer" style="display:none;">
                  <label class="form-label">Nomor Kursi Berangkat (Khusus Pesawat)</label>
                  <input type="text" name="no_kursi_berangkat" class="form-control" placeholder="Masukkan nomor kursi berangkat">
                </div>

                {{-- Transport Pulang --}}
                <div class="col-md-6">
                  <label class="form-label">Transport Pulang</label>
                  <select name="jenis_transport_pulang" id="transportPulang" class="form-select transport-select">
                    <option value="">-- Pilih Transportasi --</option>
                    @foreach($transport as $t)
                      <option value="{{ $t->id }}">{{ $t->jenis_transport }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6" id="noKursiPulangContainer" style="display:none;">
                  <label class="form-label">Nomor Kursi Pulang (Khusus Pesawat)</label>
                  <input type="text" name="no_kursi_pulang" class="form-control" placeholder="Masukkan nomor kursi pulang">
                </div>
              </div>
            </div>

            {{-- TAB BUKTI TRANSAKSI --}}
            <div class="tab-pane fade" id="content-bukti" role="tabpanel">
              <div class="mb-3">
                <label class="form-label">Foto Bukti Transaksi</label>
                <input type="file" name="foto_rincian[]" class="form-control" accept="image/*" multiple>
                <small class="text-muted">Upload struk, tiket, nota, dll.</small>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary text-white">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  const tglBerangkat = document.querySelector('[name="tgl_berangkat"]');
  const tglPulang = document.querySelector('[name="tgl_pulang"]');
  if (tglBerangkat && tglPulang) {
    tglBerangkat.addEventListener('change', () => tglPulang.min = tglBerangkat.value);
  }

  // fungsi untuk tampilkan input nomor kursi bila transport = pesawat
  function toggleKursi(selectId, containerId) {
    const select = document.getElementById(selectId);
    const container = document.getElementById(containerId);
    select.addEventListener('change', function() {
      const selectedText = this.options[this.selectedIndex].text.toLowerCase();
      if (selectedText.includes('pesawat')) {
        container.style.display = 'block';
      } else {
        container.style.display = 'none';
        container.querySelector('input').value = '';
      }
    });
  }

  toggleKursi('transportBerangkat', 'noKursiBerangkatContainer');
  toggleKursi('transportPulang', 'noKursiPulangContainer');
});
</script>
@endsection
