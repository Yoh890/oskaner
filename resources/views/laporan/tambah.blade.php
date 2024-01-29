@extends('layouts.master')
@section('content')

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Tambah Laporan</h3>
</div>


<form method="POST" action="{{ route('lap_simpan') }}">
	@csrf
   <div class="card-body">
    <div class="row">

        <div class="col-md-2">
              <div class="form-group">
                    <label for="">Kelas</label>
                    <select name="kelas_id" id="kelasan" class="form-control">
                        <option selected disabled>Silahkan Dipilih</option>
                        @foreach($kel as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                        @endforeach
                    </select>
              </div>
        </div>

        <div class="col-md-10">
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

<div class="col-md-6">
              <div class="form-group">
                    <label for="">Pelanggaran</label>
                    <select name="pelanggaran_id" class="form-control" id="pelanggaran_id">
                        <option selected disabled>Silahkan Dipilih</option>
                        @foreach($pel as $pelanggaran)
                            <option value="{{ $pelanggaran->id }}" data-kategori="{{ $pelanggaran->kategori_id }}" data-point="{{ $pelanggaran->point }}">{{ $pelanggaran->pelanggaran }}</option>
                        @endforeach
                    </select>
              </div>
</div>

<div class="col-md-6">
      <div class="form-group">
            <label for="">Point</label>
            <input type="text" name="point" class="form-control" id="point" placeholder=" " required readonly>
      </div>
    </div>
    </div>

      <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Simpan">
      </div>
  </div>
</form>
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


<script>
    $(document).ready(function () {
        // Mendengarkan perubahan pada dropdown pelanggaran
        $('#pelanggaran_id').change(function () {
            var selectedOption = $(this).find(':selected');
            var pointValue = selectedOption.data('point');

            // Mengisi otomatis nilai point pada input
            $('#point').val(pointValue);
        });
    });
</script>


@endsection
