@extends('layouts.master')
@section('content')

<div class="card-header">
    <h3 class="card-title">Laporan Pelanggaran</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
    <form method="POST" action="{{ route('lapdat_hapus') }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua laporan pelanggaran?')">Hapus Semua Data Laporan</button>
    </form>
    </div>
    <hr>
    <div class="form-group">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-1">
                    <label>Start Date</label>
                    <input class="form-control" type="date" name="mulai" id="" value="{{ Request::get('mulai') }}">
                </div>
                <div class="col-md-1">
                    <label>End Date</label>
                    <input class="form-control" type="date" name="akhir" id="" value="{{ Request::get('akhir') }}">
                </div>
                <div class="col-md-3">
                    <select name="kelas" id="" class="form-control">
                        <option selected value="">Semua Kelas</option>
                        @foreach ($kel as $item)
                        <option value="{{ $item->id }}" {{ Request::get('kelas') == $item->id ? 'selected' : '' }}>{{ $item->kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="pelanggaran" id="" class="form-control">
                        <option selected value="">Semua Pelanggaran</option>
                        @foreach ($pel as $item)
                        <option value="{{ $item->id }}" {{ Request::get('pelanggaran') == $item->id ? 'selected' : '' }}>{{ $item->pelanggaran }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
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
        <th>Pelanggaran</th>
        @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
        <th>Pelapor</th>
        @endif
        <th>Point</th>
        <th>Tanggal</th>
      </tr>
      </thead>
      <tbody>
@foreach($laporan as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->siswa->nama}}</td>
        <td>{{$row->kelas->kelas}}</td>
        <td>{{$row->pelanggaran->pelanggaran}}</td>
        @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
        <td>{{$row->pelapor}}</td>
        @endif
        <td>{{$row->point}}</td>
        <td>{{$row->updated_at}}</td>
      </tr>
@endforeach
      </tbody>
    </table>
  </div>



@endsection
