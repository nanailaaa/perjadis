<div class="modal fade" id="timModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="timModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      {{-- Header --}}
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white" id="timModalLabel">
          {{ !empty($data->id) ? 'Edit Tim Penanggung Jawab' : 'Tambah Tim Penanggung Jawab' }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      {{-- Form --}}
      <form action="{{ route('tim.store') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

          <div class="mb-3">
            <label class="form-label">Tim Penanggung Jawab</label>
            <input type="text"
                   name="tim_penanggung_jawab"
                   class="form-control"
                   placeholder="Masukkan nama tim"
                   value="{{ $data->tim_penanggung_jawab ?? '' }}"
                   required>
          </div>
          <label class="form-label">Pegawai</label>
        <select name="user_id" class="form-select" required>
          <option value="">-- Pilih Pegawai --</option>
        </div>

        {{-- Footer --}}
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>
