@extends('layouts.master')
@section('content')

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title">Pelanggaran</h3>
        @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
        <button type="button" class="mb-0 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
        @endif
    </div>
</div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Pelanggaran</th>
        <th>Point</th>
        @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
        <th>Aksi</th>
        @endif
      </tr>
      </thead>
      <tbody>
@foreach($pelan as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->pelanggaran}}</td>
        <td>{{$row->point}}</td>
        @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
        <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a>
                <a class="dropdown-item" href="{{ route('pel_hapus', $row->id) }}" data-confirm-delete="true">Hapus</a>
            </div>
        </td>
        @endif
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('pel_simpan') }}">
            @csrf
        <div class="modal-body">
            <label for="">Pelanggaran</label>
            <input type="text" name="pelanggaran" class="form-control" id="" placeholder=" " required>
<br>
            <label for="">Point</label>
            <input type="text" name="point" class="form-control" id="" placeholder=" " required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  @foreach ($pelan as $data)
    <!-- Modal Edit -->
<div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggaran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="editForm" method="POST" action="{{ route('pel_update', $data->id) }}">
              @csrf
              @method('put')
              <div class="modal-body">
                  <label for="">Pelanggaran</label>
                  <input type="text" name="pelanggaran" class="form-control" id="edit_kelas" value="{{ $data->pelanggaran }}" placeholder=" " required>

                  <label for="">Point</label>
                  <input type="text" name="point" class="form-control" value="{{ $data->point }}" placeholder=" " required>
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
