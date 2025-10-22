@extends('layouts.default')

@section('content')
<div class="container-fluid mt-2">
  <div class="card shadow-sm border-0">
      @error('jenis_transport')
            <div class="alert alert-danger">
                <p>jenis tranport harus diisi</p>
            </div>

        @enderror
   @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
        <p>{{ session('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      @endif
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0 text-white">jenis transprotasi</h5>
      <button class="btn btn-light btn-sm" type="button" id="openModal">
        <i class="ti ti-plus"></i> Tambah Jenis Tranportasi
      </button>
    </div>
    <div class="card-body">
  <div class="table-responsive">
    <table class="table table-hover table-bordered align-middle">
      <thead class="table-primary">
        <tr class="text-center">
          <th style="width: 50px;">No</th>
          <th>Jenis Transportasi</th>
          <th style="width: 150px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $key => $value)
        <tr>
          {{-- Hitung nomor berdasarkan halaman pagination --}}
          <td class="text-center">{{ $data->firstItem() + $key }}</td>
          <td>{{ $value->jenis_transport }}</td>
          <td class="text-center">
            <button class="btn btn-warning btn-sm" onclick="modal('{{ $value->id }}')">
              <i class="ti ti-edit"></i>
            </button>

            <form action="{{ route('jenis.destroy', $value->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus data ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="ti ti-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="text-center">Tidak ada data</td>
        </tr>
        @endforelse
      </tbody>
    </table>
{{-- copy jo ini jang ubah tapuwale --}}
    <div class="d-flex justify-content-end mt-3">
    <ul class="pagination">
      @if ($data->onFirstPage())
        <li class="page-item disabled"><span class="page-link">‹</span></li>
      @else
        <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}">‹</a></li>
      @endif

      @foreach ($data->links()->elements[0] ?? [] as $page => $url)
        @if ($page == $data->currentPage())
          <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
        @else
          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
      @endforeach

      @if ($data->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}">›</a></li>
      @else
        <li class="page-item disabled"><span class="page-link">›</span></li>
      @endif
    </ul>
    </div>

  </div>
</div>

    </div>
  </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content alert alert-danger">
        <div class="d-flex justify-content-center">
            <div class="p-2">
                <h2 class="text-center">⚠️</h2>
                <p class="text-warning">Perhatian Data Anda Akan Di Hapus <br> Apakah Anda yakin?</p>
            </div>

        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-success" >Ya</button>
            <button class="btn btn-danger" >Tidak</button>
        </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    $('#openModal').click(function (e) {
        e.preventDefault();
        modal()
    });

    function modal(id){
         $.ajax({
            type: "GET",
            url: `{{ route('modal.add.transport') }}`,
            data: {
                id:id
            },
            dataType: "json",
            success: function (response) {
                console.log(response.html)
                $('.modal-view').html(response.html);
                $('#pegawaiModal').modal('show');
            }
        });
    }
    setTimeout(function() {
        let alertSuccess = document.getElementById('alert-success');
        if (alertSuccess) {
            let bsAlert = new bootstrap.Alert(alertSuccess);
            bsAlert.close();
        }
    }, 3000); // 3000ms = 3 detik
</script>
@endsection
