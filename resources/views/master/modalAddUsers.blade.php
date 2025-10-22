<div class="modal fade" id="pegawaiUserModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="pegawaiModalLabel">Tambah Pegawai</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('user.pegawai.store') }}" method="post">
        @csrf

        <div class="modal-body">
          <input type="hidden" name="id_pegawai" value="{{ $id_pegawai ?? '' }}">

          <div class="mb-3">
            <label class="form-label">username</label>
            <input type="text" name="username" class="form-control"
                   placeholder="Masukkan username Login"
                   required>
          </div>

          <div class="mb-3">
            <label class="form-label">NIP
                  <span class="text-warning">Default Nip</span>

            </label>
            <input type="password" name="password" class="form-control"
                   placeholder="Masukkan Password"
                   value="{{ $password ?? "" }}"
                  >
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
