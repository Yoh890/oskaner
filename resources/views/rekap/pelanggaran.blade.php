@extends('layouts.master')
@section('content')

<div class="card-header">
    <h3 class="card-title">10 Siswa Dengan Point Terbanyak</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="rekap2" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Point</th>
      </tr>
      </thead>
      <tbody>
@foreach($siswa as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->kelas->kelas}}</td>
        <td>{{$row->point}}</td>
      </tr>
@endforeach
      </tbody>
    </table>
  </div>
  @endsection
