@extends('layouts.master')
@section('content')

<div class="card">
    <div class="card-header">
        <a href="{{ url()->previous() }}" class="btn btn-danger" style="position:left: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp&nbspKembali</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Nama : {{ $siswa->nama }}</h4>
                <span>Kelas : {{ $siswa->kelas->kelas }}</span><br>
                <span>Point : {{ $siswa->point }}</span><br>
                <span>Ekstrakurikuler : {{ $ek }}</span><br>
                <span>Prestasi : {{ $hitpres }}</span><br>
            </div>
        </div>

            <br><h4><b>Data Pelanggaran Siswa</b></h4>
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Pelanggaran</th>
                        <th>Point</th>
                        <th>Pelapor</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $row)
                    <tr>
                        <td>{{ $row->pelanggaran->pelanggaran }}</td>
                        <td>{{ $row->point }}</td>
                        <td>{{ $row->pelapor }}</td>
                        <td>{{ $row->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br><h4><b>Data Prestasi Siswa</b></h4>
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Dokumentasi</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prestasi as $row)
                    <tr>
                        <td>{{ $row->keterangan }}</td>
                        <td><a href="{{ $row->dokumentasi }}">DOKUMENTASI</a></td>
                        <td>{{ $row->tanggal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>

@endsection
