@extends('layouts.master')
@section('content')

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
    <h3 class="card-title">Rekap Data Latihan dan Pelatih Ekstrakurikuler</h3>
    {{-- <button type="button" class="mb-0 btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-print"></i></button> --}}
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">

    <div class="form-group">
    <form action="" method="GET">
        <div class="row">
            <div class="col-md-3">
                <label>Start Date</label>
                <input class="form-control" type="date" name="mulai" id="" value="{{ Request::get('mulai') }}">
            </div>
            <div class="col-md-3">
                <label>End Date</label>
                <input class="form-control" type="date" name="akhir" id="" value="{{ Request::get('akhir') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary">Tampilkan</button>
            </div>
        </div>
    </form>
    </div>
    <hr>
    {{-- Total Laporan {{ $jumlah }} Data
    <table id="example3" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Jumlah Latihan</th>
          <th>Kehadiran Pelatih</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{ $latihanBulanIni }}</td>
          <td>{{ $pelatihBulanIni }}</td>
        </tr>
        </tbody>
      </table>
    <hr> --}}
    <table id="rekap" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Ekstrakurikuler</th>
        <th>Latihan</th>
        <th>Kehadiran Pelatih</th>
      </tr>
      </thead>
      <tbody>
@foreach($ekstra as $item)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{ $item->ekstra }}</td>
        <td>{{ $latihanData[$item->id] }}</td>
        <td>{{ $kehadiranData[$item->id] }}</td>
      </tr>
@endforeach
      </tbody>
    </table>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="printContent">
            <table id="rekap" class="table table-bordered table-striped">
            @foreach ($ekstra as $item)
                    <h5>{{ $item->ekstra }}</h5>
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Jumlah Latihan</th>
                  <th>Kehadiran Pelatih</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>{{ $latihanData[$item->id] }}</td>
                  <td>{{ $kehadiranData[$item->id] }}</td>
                </tr>
                </tbody>
              </table>
              <hr>
              @endforeach
            </table>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" id="printButton">Print</button>
      </div>
    </div>
  </div>
  @endsection
  @section('scripts')
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('printButton').addEventListener('click', function() {
          console.log('Print button clicked');
          var printContent = document.getElementById('printContent').innerHTML;
          var originalContent = document.body.innerHTML;
          document.body.innerHTML = printContent;
          window.print();
          document.body.innerHTML = originalContent;
          window.location.reload();  // Refresh page to reset the modal and other page content
      });
  });
  </script>
  @endsection
