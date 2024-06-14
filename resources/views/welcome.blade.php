<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Utama - Skanamber</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/39b7868803.js" crossorigin="anonymous"></script>
     <!-- Logo Kecil disebelah Title -->
    <link rel="icon" href="img/SMK6.png" type="image/png">
</head>
<body>
	<header>
        <div class="logo-container">
            <a href=""><img class="logo" src="img/SMK6.png" alt="osis"></a>
            <h1 class="logot">E-Kesiswaan</h1>
        </div>
		<nav>
			<ul>
				<li class="test"><a href="{{ route('ekstra') }}">EKSTRAKURIKULER</a></li>
				<li class="test"><a href="{{ route('lap') }}">PELANGGARAN</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<div class="container">
		<section id="hero">
			<h2>Selamat Datang di Website E-Kesiswaan</h2>
			<p>E-Kesiswaan SMKN 6 Jember</p>
			<a href="./login"><button>Masuk</button></a>
		</section>
        <section id="activities">
            <h2>Menu</h2>
			<ul>
				<li><a href="{{ route('ekskul') }}">Laporan Ekskul</a></li>
				<li><a href="{{ route('lap') }}">Laporan Pelanggaran</a></li>
				<li><a href="{{ route('keg') }}">Laporan Kegiatan</a></li>
				<li><a href="{{ route('ekstra') }}">Absen Ekskul</a></li>
				<li><a href="{{ route('rekap_pelatih') }}">Rekap Absen</a></li>
				<li><a href="{{ route('rekap_pelanggaran') }}">Rekap Pelanggaran</a></li>
			</ul>
		</section>

		<section id="contact">
			<h2>Prestasi Siswa</h2>
			<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Dokumentasi</th>
                  <th>Keterangan</th>
                  <th>Tanggal</th>
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
                </tr>
          @endforeach
                </tbody>
              </table>
		</section>
		</div>
	</main>
	<footer>
        <div class="social-media">
            {{-- <a href="https://www.facebook.com/osis.smkn6jember/" target="_blank">
              <i class="fab fa-facebook"></i>
            </a> --}}
            <a href="https://www.instagram.com/smkn6jember/" target="_blank">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/@studio6smkn6jember" target="_blank">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
          <br>
		<p>Hak Cipta © 2024 SMKN 6 Jember</p>
	</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
const icon = document.querySelector('.icon');
const ul = document.querySelector('nav ul');

icon.addEventListener('click', () => {
  ul.classList.toggle('show');
});
</script>
</html>
