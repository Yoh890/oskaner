@extends('layouts.master')
@section('content')

<div class="card-header">
    <h3 class="card-title">Data Siswa</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah
      </button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#import">
        Import
      </button>
      <a href="{{ route('siswa_reset') }}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mereset point?')">Reset Point</a>
    <hr>
    <div class="form-group">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <select name="kelas" id="" class="form-control">
                        <option selected value="">Semua Kelas</option>
                        @foreach ($kel as $item)
                        <option value="{{ $item->id }}" {{ Request::get('kelas') == $item->id ? 'selected' : '' }}>{{ $item->kelas }}</option>
                        @endforeach
                    </select>
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
        <th>Nama</th>
        <th>Kelas</th>
        <th>Point</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
@foreach($siswa as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->kelas->kelas}}</td>
        <td>{{$row->point}}</td>
        <td>
            <div class="row">
            <a href="{{ route('sis_view', $row->id) }}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
              </svg></a>&nbsp&nbsp
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a>
                @if (in_array(auth()->user()->level, ['admin', 'waka']))
                <a class="dropdown-item" href="{{ route('sis_hapus', $row->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
            @endif
            </div>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('sis_simpan') }}">
            @csrf
        <div class="modal-body">
    <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="nama" class="form-control" id="" placeholder=" " required>
    </div>
    <div class="form-group">
            <label for="">Kelas</label>
            <select name="kelas_id" class="form-control">
                <option selected disabled>Silahkan Dipilih</option>
                @foreach($kel as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Point</label>
            <input type="text" name="point" class="form-control" id="" placeholder=" " required>
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
  <!-- Modal Import-->
  <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('sis_import') }}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
    <div class="form-group">
            <input type="file" name="file" required>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  @foreach ($siswa as $data)
    <!-- Modal Edit -->
<div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="editForm" method="POST" action="{{ route('sis_update', $data->id) }}">
              @csrf
              @method('put')
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" id="" placeholder=" " required>
            </div>
            <div class="form-group">
                <label for="">Kelas</label>
                <select name="kelas_id" class="form-control">
                    <option selected disabled>Silahkan Dipilih</option>
                    @foreach($kel as $kelas)
                        <option value="{{ $kelas->id }}" {{ $kelas->id == $data->kelas_id ? 'selected' : '' }}>
                            {{ $kelas->kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
                <div class="form-group">
                    <label for="">Point</label>
                    <input type="number" name="point" value="{{ $data->point }}" class="form-control" id="" placeholder=" ">
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
