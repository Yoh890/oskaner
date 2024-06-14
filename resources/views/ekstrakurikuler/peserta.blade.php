@extends('layouts.master')
@section('content')

<div class="card-header">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="card-title">Daftar Peserta Ekstrakurikuler {{ $ekstra->ekstra }}</h3>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>
</div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#import">
        Import
      </button>&nbsp; --}}
      <a class="btn btn-success" href="{{ route('absen', $ekstra->id) }}">Absen</a>&nbsp;
      @if (in_array(auth()->user()->level, ['admin', 'osis', 'waka']))
      <form method="POST" action="{{ route('peserta_reset', $ekstra->id) }}">
        @csrf
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin mereset kehadiran?')">Reset Kehadiran</button>
    </form>&nbsp;
    <form method="POST" action="{{ route('absendat_hapus', $ekstra->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua data absen?')">Hapus Semua Data Absen</button>
    </form>
    @endif
    </div>
    <hr>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Hadir</th>
        <th>S</th>
        <th>I</th>
        <th>A</th>
        <th>Predikat</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
@foreach($peserta as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->siswa->nama}}</td>
        <td>{{$row->kelas->kelas}}</td>
        <td>{{$row->hadir}}</td>
        <td>{{$row->sakit}}</td>
        <td>{{$row->ijin}}</td>
        <td>{{$row->alpa}}</td>
        <td>{{$row->predikat}}</td>
        <td>{{$row->deskripsi}}</td>
        <td><a class="btn btn-danger" href="{{ route('peserta_hapus', $row->id) }}" data-confirm-delete="true"><i class="fa fa-trash" data-confirm-delete="true"></i></a></td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>

    {{-- <!-- Modal Import-->
    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Data Peserta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('peserta_import') }}" enctype="multipart/form-data">
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
      </div> --}}

  <!-- Modal Tambah-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Peserta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('peserta_simpan', $ekstra->id) }}">
            @csrf
        <div class="modal-body">
                <div class="form-group">
                      <label for="">Kelas</label>
                      <select name="kelas_id" id="kelasan" class="form-control">
                          <option selected disabled>Silahkan Dipilih</option>
                          @foreach($kel as $kelas)
                              <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                          @endforeach
                      </select>
                </div>

        <div class="form-group">
        <label for="">Nama</label>
                      <select name="siswa_id" id="siswaan" class="form-control">
                          <option selected disabled>Silahkan Dipilih</option>
                          @foreach($sis as $siswa)
                              <option value="{{ $siswa->id }}" data-kelas-id="{{ $siswa->kelas_id }}">{{ $siswa->nama }}</option>
                          @endforeach
                      </select>
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      // Ambil elemen-elemen yang dibutuhkan
      var kelasan = document.getElementById('kelasan');
      var siswaan = document.getElementById('siswaan');

      // Simpan opsi siswa awal untuk setiap kelas
      var siswaOptions = {};
      for (var i = 0; i < siswaan.options.length; i++) {
        var siswa = siswaan.options[i];
        var kelasId = siswa.getAttribute('data-kelas-id');
        if (!siswaOptions[kelasId]) {
          siswaOptions[kelasId] = [];
        }
        siswaOptions[kelasId].push(siswa);
      }

      // Sembunyikan semua opsi siswa saat halaman dimuat
      hideAllOptions();

      // Tambahkan event listener pada pemilihan kelas
      kelasan.addEventListener('change', function () {
        var selectedKelas = kelasan.value;

        // Sembunyikan semua opsi siswa
        hideAllOptions();

        // Tampilkan hanya opsi siswa yang terkait dengan kelas yang dipilih
        showOptionsByKelas(selectedKelas);
      });

      // Fungsi untuk menyembunyikan semua opsi siswa
      function hideAllOptions() {
        for (var kelasId in siswaOptions) {
          siswaOptions[kelasId].forEach(function (siswa) {
            siswa.style.display = 'none';
          });
        }
      }

      // Fungsi untuk menampilkan opsi siswa berdasarkan kelas
      function showOptionsByKelas(selectedKelas) {
        var selectedOptions = siswaOptions[selectedKelas];
        if (selectedOptions) {
          selectedOptions.forEach(function (siswa) {
            siswa.style.display = '';
          });
        }
      }
    });
  </script>
@endsection
