<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Utama - SKANAMBER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Logo Kecil disebelah Title -->
    <link rel="icon" href="img/SMK6.png" type="image/png">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-4">
                <div class="card" style="width: 23rem;">
                    {{-- <img src="{{ asset('img/SMK6.png');}}" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">Laporan Ekstrakurikuler</h5>
                        <p class="card-text"><strong><a target="_blank" href="https://youtu.be/fM0nEr-_g34?si=jm9_YhIM9xS5m8TR">PANDUAN</a></strong></p>
                        <a href="{{ route('ekskul') }}" class="btn btn-primary">Kunjungi</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="card" style="width: 23rem;">
                    {{-- <img src="{{ asset('img/SMK6.png');}}" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">Laporan Pelanggaran</h5>
                        <p class="card-text">SMKN 6 JEMBER</p>
                        <a href="{{ route('lap') }}" class="btn btn-primary">Kunjungi</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4">
                <div class="card" style="width: 23rem;">
                    {{-- <img src="{{ asset('img/SMK6.png');}}" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">Laporan Kegiatan OSIS</h5>
                        <p class="card-text"><strong><a target="_blank" href="https://youtu.be/9wiZjpFRO6I?si=dLbexZhKlO8K5h4C">PANDUAN</a></strong></p>
                        <a href="{{ route('keg') }}" class="btn btn-primary">Kunjungi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
