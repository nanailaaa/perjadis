@extends('layouts.default')

@section('title', 'Dashboard - SIJADIS XVI')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
              <h4 class="card-title mb-0">Dashboard</h4>
              <p class="text-muted">Selamat datang, Admin</p>
            </div>
            <div class="d-flex align-items-center">
              <i class="ti ti-bell me-2"></i>
              <span class="badge bg-danger">3</span>
            </div>
          </div>

          <!-- Statistics Cards -->
          <div class="row mb-4">
            <div class="col-md-3">
              <div class="card border-left-primary">
                <div class="card-body">
                  <h6 class="text-primary">Total Perjalanan</h6>
                  <h4>12</h4>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card border-left-success">
                <div class="card-body">
                  <h6 class="text-success">Total Biaya</h6>
                  <h4>Rp 50.000.000</h4>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card border-left-warning">
                <div class="card-body">
                  <h6 class="text-warning">Menunggu Validasi</h6>
                  <h4>4</h4>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card border-left-info">
                <div class="card-body">
                  <h6 class="text-info">Disetujui</h6>
                  <h4>8</h4>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Trips Table -->
          <div class="card">
            <div class="card-header">
              <h5 class="mb-0">Perjalanan Terbaru</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No. Surat</th>
                      <th>Pegawai</th>
                      <th>Tujuan</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th>Total Biaya</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>ST/2024/001</td>
                      <td>Andi</td>
                      <td>Jakarta</td>
                      <td>10/09/2024</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                      <td>Rp 5.000.000</td>
                    </tr>
                    <tr>
                      <td>ST/2024/002</td>
                      <td>Budi</td>
                      <td>Bandung</td>
                      <td>15/09/2024</td>
                      <td><span class="badge bg-success">Approved</span></td>
                      <td>Rp 3.000.000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
