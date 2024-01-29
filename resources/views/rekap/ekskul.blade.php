@extends('layouts.master')
@section('content')

<div class="card-header">
    <h3 class="card-title">Rekap Data Absen Pelatih Ekstrakurikuler</h3>
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
                <select name="ekskul" id="" class="form-control">
                    <option selected value="">Semua Ekstrakurikuler</option>
                    @foreach ($ekstra as $item)
                    <option value="{{ $item->id }}" {{ Request::get('ekskul') == $item->id ? 'selected' : '' }}>{{ $item->ekstra }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary">Filter Data</button>
            </div>
        </div>
    </form>
    </div>
    <hr>
    <table id="rekap" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Kehadiran</th>
        <th>Ekstrakurikuler</th>
        <th>Tanggal</th>
        {{-- <th>Aksi</th> --}}
      </tr>
      </thead>
      <tbody>
@foreach($pelatih as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->kehadiran}}</td>
        <td>{{$row->ekstra->ekstra}}</td>
        <td>{{$row->created_at}}</td>
        {{-- <td>
            <div class="row">
            <a href="{{ route('peserta', $row->id) }}" class="btn btn-secondary">Peserta</a> &nbsp &nbsp
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a>
                <a class="dropdown-item" href="{{ route('ekstra_hapus', $row->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
            </div>
            </div>
        </div>
        </td> --}}
      </tr>
@endforeach
      </tbody>
    </table>
  </div>
  @endsection
