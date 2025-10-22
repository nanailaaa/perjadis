@extends('layouts.default')

@section('content')
<div class="container-fluid mt-2">
  <div class="card shadow-sm border-0">
      @error('tim_pj')
            <div class="alert alert-danger">
                <p>Bidang harus diisi</p>
            </div>
      @enderror

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0 text-white">Tim Penanggung Jawab</h5>
      <button class="btn btn-light btn-sm" type="button" id="openModal">
        <i class="ti ti-plus"></i> Tambah Bidang
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-primary">
            <tr class="text-center">
              <th style="width: 50px;">No</th>
              <th>Tim Penanggung Jawab</th>
              <th style="width: 150px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
          @php $no = 1; @endphp
          @forelse ($data as $key => $value)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $value['tim_penanggung_jawab'] }}</td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm" onclick="modal('{{ $value['id'] }}')">
                       <i class="ti ti-edit"></i>
                    </button>

                    <form action="{{ route('tim.destroy', $value['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus data ini?')">
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
     </div>
    </div>
  </div>
</div>

{{-- Modal kosong, konten diisi via Ajax --}}
<div class="modal fade" id="timModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-view">
        {{-- isi modal akan dimuat dari Ajax --}}
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    // Tombol tambah data
    $('#openModal').click(function (e) {
        e.preventDefault();
        modal('');
    });

    // Ajax buka modal
    function modal(id){
         $.ajax({
            type: "GET",
            url: `{{ route('modal.add.tim') }}`,
            data: { id:id },
            dataType: "json",
            success: function (response) {
                $('.modal-view').html(response.html);
                $('#timModal').modal('show');
            },
            error: function(xhr){
                console.log("Error:", xhr);
            }
        });
    }

    // Auto close alert sukses
    setTimeout(function() {
        let alertSuccess = document.getElementById('alert-success');
        if (alertSuccess) {
            let bsAlert = new bootstrap.Alert(alertSuccess);
            bsAlert.close();
        }
    }, 3000);
</script>
@endsection
