@extends('layouts.master')
@section('content')

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title">Laporan Ekstrakurikuler</h3>
        <button type="button" class="mb-0 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>
</div>
  <!-- /.card-header -->
  <div class="card-body">
      <p class="mb-0">{{ $jumlah }} Laporan</p>
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
            <div class="col-md-3">
                <select name="ekskul" id="" class="form-control">
                    <option selected value="">Semua Ekstrakurikuler</option>
                    @foreach ($eks as $item)
                    <option value="{{ $item->id }}" {{ Request::get('ekskul') == $item->id ? 'selected' : '' }}>{{ $item->ekstra }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary">Tampilkan</button>
            </div>
        </div>
    </form>
    </div>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Ekstrakurikuler</th>
        <th>Kegiatan</th>
        <th>Deskripsi</th>
        <th>Link Dokumentasi</th>
        @if (in_array(auth()->user()->level, ['admin', 'osis', 'waka']))
        <th>Pelapor</th>
        @endif
        <th>Tanggal</th>
        @if (in_array(auth()->user()->level, ['admin', 'osis', 'waka']))
        <th>Aksi</th>
        @endif
      </tr>
      </thead>
      <tbody>
@foreach($ekskul as $row)
      <tr data-ekstrakurikuler="{{ $row->ekstra->id }}">
        <td>{{$loop->iteration}}</td>
        <td>{{$row->ekstra->ekstra}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->deskripsi}}</td>
        <td><a href="{{$row->link}}" target="_blank">{{$row->link}}</a></td>
        @if (in_array(auth()->user()->level, ['admin', 'osis', 'waka']))
        <td>{{$row->pelapor}}</td>
        @endif
        <td>{{$row->tgl}}</td>
        @if (in_array(auth()->user()->level, ['admin', 'osis', 'waka']))
        <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                {{-- <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a> --}}
                <a class="dropdown-item" href="{{ route('ekskul_hapus', $row->id) }}" data-confirm-delete="true">Hapus</a>
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
          <h5 class="modal-title" id="exampleModalLabel">Laporan Ekstrakurikuler</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('ekskul_simpan') }}">
            @csrf
        <div class="modal-body">
            <label for="">Esktrakurikuler</label>
                    <select name="ekstra_id" id="" class="form-control" required>
                        <option selected disabled>Pilih Ekstrakurikuler</option>
                        @foreach ($eks as $item)
                        <option value="{{ $item->id }}">{{ $item->ekstra }}</option>
                        @endforeach
                    </select>
<br>
            <label for="">Kegiatan</label>
            <input type="text" name="nama" class="form-control" id="" placeholder=" " required>
<br>
            <label for="">Deskripsi</label>
            <textarea name="deskripsi" id="" cols="2" rows="4" class="form-control" required></textarea>
<br>
            <label for="">Link Dokumentasi</label>
            <input type="url" name="link" class="form-control" id="" placeholder=" " required>
<br>
            <label for="">Tanggal</label>
            <input type="date" name="tgl" class="form-control" id="" placeholder=" " required>
            <br>
            <p style="color: red">*Periksa kembali data yang akan diinput, data yang sudah diinput tidak dapat diedit</p>
            <p style="color: red">*Link dokumentasi menggunakan Google Drive dan pastikan untuk akses diubah menjadi "Siapa saja yang memiliki link"</p>
            <p><a target="_blank" href="https://youtu.be/fM0nEr-_g34?si=jm9_YhIM9xS5m8TR">Panduan</a></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  {{-- @foreach ($pelan as $data)
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
          <form id="editForm" method="POST" action="{{ route('ekskul_update', $data->id) }}">
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
  @endforeach --}}
  <script>
    $(document).ready(function () {
        $('#filterEkstrakurikuler').change(function () {
            var selectedEkstrakurikuler = $(this).val();

            // Saring baris tabel berdasarkan ekstrakurikuler yang dipilih
            if (selectedEkstrakurikuler !== '') {
                $('#example1 tbody tr').hide();
                $('#example1 tbody tr[data-ekstrakurikuler="' + selectedEkstrakurikuler + '"]').show();
            } else {
                // Jika dipilih "Semua Ekstrakurikuler", tampilkan semua baris
                $('#example1 tbody tr').show();
            }
        });
    });
</script>



@endsection
