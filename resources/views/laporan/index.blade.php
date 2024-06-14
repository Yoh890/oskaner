@extends('layouts.master')
@section('content')

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title">Laporan Pelanggaran</h3>
        <a href="{{ route('lap_tambah') }}" class="mb-0 btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
</div>
  <!-- /.card-header -->
  <div class="card-body">
      <p>Data laporan untuk tanggal : {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
      <hr>
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
        @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
        <th>Aksi</th>
        @endif
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
        @if (in_array(auth()->user()->level, ['admin', 'bk', 'waka']))
        <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                {{-- <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a> --}}
                <a class="dropdown-item" href="{{ route('lap_hapus', $row->id) }}" data-confirm-delete="true">Hapus</a>
            </div>
            </div>
        </td>
        @endif
      </tr>
@endforeach
      </tbody>
    </table>
  </div>

  @foreach ($laporan as $data)
<!-- Modal Edit -->
<div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST" action="{{ route('lap_update', $data->id) }}">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder=" " value="{{ $data->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label for="">Kelas</label>
                        <select name="kelas_id" class="form-control">
                            @foreach($kel as $kelas)
                            <option value="{{ $kelas->id }}" {{ $kelas->id == $data->kelas_id ? 'selected' : '' }}>{{ $kelas->kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pelanggaran</label>
                        <select name="pelanggaran_id" class="form-control" id="pelanggaran_id">
                            @foreach($pel as $pelanggaran)
                            <option value="{{ $pelanggaran->id }}" data-kategori="{{ $pelanggaran->kategori_id }}" data-point="{{ $pelanggaran->point }}" {{ $pelanggaran->id == $data->pelanggaran_id ? 'selected' : '' }}>{{ $pelanggaran->pelanggaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Point</label>
                            <input type="text" name="point" class="form-control" id="point" placeholder=" " value="{{ $data->point }}" required readonly>
                        </div>
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

@section('script')
<script>
    // Menangani perubahan pada dropdown pelanggaran
    $('#pelanggaran_id').change(function () {
        var selectedOption = $(this).find(':selected');
        var point = selectedOption.data('point');
        // Set nilai point pada input point
        $('#point').val(point);
    });
</script>

<script>
    $(document).ready(function () {
        // Mendengarkan perubahan pada dropdown kategori
        $('#kategori_id').change(function () {
            var kategoriId = $(this).val();

            // Menyembunyikan atau menampilkan opsi pelanggaran berdasarkan kategori
            $('#pelanggaran_id option').each(function () {
                var optionKategoriId = $(this).data('kategori');
                if (optionKategoriId == kategoriId || optionKategoriId == '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endsection
