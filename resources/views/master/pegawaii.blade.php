@extends('layouts.default')

@section('content')
<div class="container-fluid mt-2">
  <div class="card shadow-sm border-0">
      {{-- Validasi Error --}}
      @error('nama_pegawai')
            <div class="alert alert-danger">
                <p>Nama Pegawai harus diisi</p>
            </div>
      @enderror

      {{-- Notifikasi sukses --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0 text-white"> Pegawai</h5>
      <button class="btn btn-light btn-sm" type="button" id="openModal">
        <i class="ti ti-plus"></i> Tambah Pegawai
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-primary">
            <tr class="text-center">
              <th style="width: 50px;">No</th>
              <th>Nama Pegawai</th>
              <th>NIP</th>
              <th>Username</th>
              <th >Aksi</th>
            </tr>
          </thead>
          <tbody>
          @php $no = 1; @endphp
          @forelse ($data as $value)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $value['nama_pegawai'] }}</td>
                <td>{{ $value['nip'] }}</td>
                <td>{{ $value['username'] ?? "Belum Ada User" }}</td>
                <td class="">
                    <button class="btn btn-warning btn-sm" onclick="modal('{{ $value['id'] }}')">
                       <i class="ti ti-edit"></i>
                    </button>

                    <form action="{{ route('pegawaii.destroy', $value->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </button>
                    </form>
                    @if($value['user_id'] === null):
                    <button class="btn btn-primary btn-sm" data-idPegawai="{{ $value['id'] }}" type="button" id="btn-add-users">
                        <i class="ti ti-user"></i>
                    </button>
                    @endif
                </td>
            </tr>
          @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
          @endforelse
          </tbody>
        </table>

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

{{-- Modal kosong, konten diisi via Ajax --}}
<div class="modal fade" id="pegawaiModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-view">
        {{-- isi modal akan dimuat dari Ajax --}}
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    // tombol tambah
    $('#openModal').click(function (e) {
        e.preventDefault();
        modal('');
    });

    // load modal via ajax
    function modal(id){
         $.ajax({
            type: "GET",
            url: `{{ route('modal.add.pegawai') }}`,
            data: { id:id },
            dataType: "json",
            success: function (response) {
                $('.modal-view').html(response.html);
                $('#pegawaiModal').modal('show');
            }
        });
    }

    // auto close alert
    setTimeout(function() {
        let alertSuccess = document.getElementById('alert-success');
        if (alertSuccess) {
            let bsAlert = new bootstrap.Alert(alertSuccess);
            bsAlert.close();
        }
    }, 3000);


    $('#btn-add-users').click(function (e) {
        e.preventDefault();
        let id = $(this).data('idpegawai');

        $.ajax({
            type: "GET",
            url: "{{ route('modal.add.user') }}",
            data: {
                id: id
            },
            dataType: "json",
            success: function (response) {
                $('.modal-view').html(response.html);
                $('#pegawaiUserModal').modal('show');
            }
        });
    });
</script>
@endsection
