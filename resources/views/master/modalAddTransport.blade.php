<div class="modal fade" id="pegawaiModal" data-bs-backdrop="statis" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="pegawaiModalLabel">Tambah Pegawai</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('jenis.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <input type="hidden" name="id" value="{{ $data->id ?? "" }}">
            <label class="form-label">jenis Transport</label>

            <input type="text" name="jenis_transport" class="form-control" placeholder="Masukkan nama pegawai" value="{{ $data->jenis_transport ?? "" }}">
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
