@extends('layouts.master')
@section('content')

<div class="card-header">
    <h3 class="card-title">Kelas</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah
      </button>
    <hr>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Id Kelas</th>
        <th>Kelas</th>
        @if (in_array(auth()->user()->level, ['admin', 'waka']))
        <th>Aksi</th>
        @endif
      </tr>
      </thead>
      <tbody>
@foreach($kelas as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->id}}</td>
        <td>{{$row->kelas}}</td>
        @if (in_array(auth()->user()->level, ['admin', 'waka']))
        <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a>
                <a class="dropdown-item" href="{{ route('kel_hapus', $row->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
            </div>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('kel_simpan') }}">
            @csrf
        <div class="modal-body">
            <label for="">Kelas</label>
            <input type="text" name="kelas" class="form-control" id="" placeholder=" " required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  @foreach ($kelas as $data)
    <!-- Modal Edit -->
<div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="editForm" method="POST" action="{{ route('kel_update', $data->id) }}">
              @csrf
              @method('put')
              <div class="modal-body">
                  <label for="">Kelas</label>
                  <input type="text" name="kelas" class="form-control" id="edit_kelas" value="{{ $data->kelas }}" placeholder=" " required>
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
