@extends('layouts.master')
@section('content')

<div class="card-header">
    <h3 class="card-title">Laporan Kegiatan OSIS</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah
      </button>
    <hr>
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
                <div class="col-md-6">
                    <button type="submit" class="btn btn-secondary">Filter Data</button>
                </div>
            </div>
        </form>
        </div>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Kegiatan</th>
        <th>Deskripsi</th>
        <th>Link Dokumentasi</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
@foreach($kegiatan as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->deskripsi}}</td>
        <td><a href="{{$row->link}}" target="_blank">{{$row->link}}</a></td>
        <td>{{$row->tgl}}</td>
        <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a>
                <a class="dropdown-item" href="{{ route('keg_hapus', $row->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
            </div>
        </td>
      </tr>
@endforeach
      </tbody>
    </table>
  </div>

  <!-- Modal Tambah-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Laporan Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('keg_simpan') }}">
            @csrf
        <div class="modal-body">
    <div class="form-group">
            <label for="">Kegiatan</label>
            <input type="text" name="nama" class="form-control" id="" placeholder=" " required>
    </div>
    <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="deskripsi" id="" cols="2" rows="4" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="">Link Dokumentasi</label>
            <input type="url" name="link" class="form-control" id="" placeholder=" " required>
        </div>
        <div class="form-group">
            <label for="">Tanggal</label>
            <input type="date" name="tgl" class="form-control" id="" placeholder=" " required>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  @foreach ($kegiatan as $data)
    <!-- Modal Edit -->
<div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Laporan Kegiatan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="editForm" method="POST" action="{{ route('keg_update', $data->id) }}">
              @csrf
              @method('put')
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Kegiatan</label>
                    <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="" placeholder=" " required>
            </div>
            <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="" cols="2" rows="4" class="form-control" required>{{ $data->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Link Dokumentasi</label>
                    <input type="url" name="link" value="{{ $data->link }}" class="form-control" id="" placeholder=" " required>
                </div>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tgl" value="{{ $data->tgl }}" class="form-control" id="" placeholder=" " required>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
      </div>
  </div>
</div>
  @endforeach

@endsection
