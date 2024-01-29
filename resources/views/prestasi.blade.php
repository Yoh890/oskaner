@extends('layouts.master')
@section('content')

<div class="card-header">
    <h3 class="card-title">Data Prestasi</h3>
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
        <th>Dokumentasi</th>
        <th>Keterangan</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
@foreach($prestasi as $row)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->siswa->nama}}</td>
        <td>{{$row->kelas->kelas}}</td>
        <td><a href="{{$row->dokumentasi}}">DOKUMENTASI</a></td>
        <td>{{$row->keterangan}}</td>
        <td>{{$row->tanggal}}</td>
        <td>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                      </svg>
                </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" data-toggle="modal" data-target="#editModal-{{ $row->id }}">Edit</a>
                <a class="dropdown-item" href="{{ route('prestasi_hapus', $row->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('prestasi_simpan') }}">
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

            <div class="form-group">
                <label for="">Link Dokumentasi</label>
                <input type="url" name="dokumentasi" class="form-control" id="" placeholder=" " required>
            </div>

            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" id="" cols="2" rows="4" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="" placeholder=" " required>
            </div>
            <p style="color: red">*Link dokumentasi menggunakan Google Drive dan pastikan untuk akses diubah menjadi "Siapa saja yang memiliki link"</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  {{-- @foreach ($user as $data)
    <!-- Modal Edit -->
<div class="modal fade" id="editModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form id="editForm" method="POST" action="{{ route('pengguna_update', $data->id) }}">
              @csrf
              @method('put')
              <div class="modal-body">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $data->name }}" id="" placeholder=" " required>
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $data->email }}" id="" placeholder=" " required>
                </div>

                <div class="form-group">
                    <label for="">Level</label>
                    <select name="level" class="form-control" id="">
                        <option value="admin">admin</option>
                        <option value="waka">waka</option>
                        <option value="bk">bk</option>
                        <option value="osis">osis</option>
                        <option value="ekskul">ekskul</option>
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
  @endforeach --}}

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
