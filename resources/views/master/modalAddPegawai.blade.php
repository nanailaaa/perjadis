<div class="modal fade" id="pegawaiModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="pegawaiModalLabel">Tambah Pegawai</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('pegawaii.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

          <div class="mb-3">
            <label class="form-label">Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control"
                   placeholder="Masukkan nama pegawai"
                   value="{{ $data->nama_pegawai ?? '' }}">
          </div>

          <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control"
                   placeholder="Masukkan NIP"
                   value="{{ $data->nip ?? '' }}">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
