<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/css/home.css'])
    <!-- Google Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />
</head>
<body>
    <body class="home-background">
    <!-- Header / Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-bg-custom fixed-top">
        <div class="container-fluid mx-4">
            <a class="navbar-brand fw-bold"> <span id="brand" id="team-section">IO-Lock</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">About</a>
                        <ul class="dropdown-menu text-start" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#team-section">Team</a></li>
                        <li><a class="dropdown-item" href="#brand-section">Product Description</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li> 
                </ul>
            </div>
        </div>
    </nav>

    <!-- Meet the People Behind -->

    <div class="container py-5 my-5 animated-load">
        <div class="row mb-4">
            <div class="container text-center">
                <h1 id="about-title">Meet the Team Behind <span id="team-section">IO-Lock</span></h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="card-column col-12 col-md-auto">
                <div class="card">
                    <img src="{{ asset('images/annisa.jpg') }}" class="card-img-top" alt="Annisa Raihanah Maimun">
                    <div class="card-body">
                        <h5 class="card-title">Annisa Raihanah Maimun</h5>
                        <p class="card-detail mb-0"> <span style="font-weight: 700;">NIM  </span>J0404231103</p>
                    </div>
                </div>
            </div>
            <div class="card-column col-12 col-md-auto">
                <div class="card">
                    <img src="{{ asset('images/iqbal.jpg') }}" class="card-img-top" alt="Muhamad Iqbal Faturrahman">
                    <div class="card-body">
                        <h5 class="card-title">Muhamad Iqbal Faturrahman</h5>
                        <p class="card-detail mb-0"> <span style="font-weight: 700;">NIM  </span>J0404231103</p>
                    </div>
                </div>
            </div>
            <div class="card-column col-12 col-md-auto">
                <div class="card">
                    <img src="{{ asset('images/selpi.jpg') }}" class="card-img-top" alt="Selpi Anjeli">
                    <div class="card-body">
                        <h5 class="card-title">Selpi Anjeli</h5>
                        <p class="card-detail mb-0"> <span style="font-weight: 700;">NIM  </span>J0404231006</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 mb-4">
            <div class="container text-center">
                <h1 id="about-title">What is <span id="brand-section">IO-Lock</span> actually?</h1>
            </div>
        </div>
        <div class="row mb-4 justify-content-center">
            <div class="desc-box">
                <h6 class="desc-title mb-3" style="font-weight: 700">Product Description</h6>
                <p class="desc-text" style="text-align: justify">Sistem manajemen kunci elektronik ini memanfaatkan teknologi RFID, sensor BME280, dan servo motor untuk mengontrol akses ke ruangan server.
                                    Pengguna dapat membuka pintu menggunakan kartu RFID yang telah terdaftar, sementara suhu ruangan server dipantau secara real-time melalui sensor BME280.
                                    Semua data, termasuk suhu dan akses pengguna, terintegrasi dengan database yang ditampilkan dalam dashboard berbasis web.
                                    Pegawai dapat memantau suhu ruangan melalui dashboard mereka, sedangkan admin memiliki akses penuh untuk memonitor suhu, mengelola data user (CRUD), melihat riwayat akses terakhir setiap pengguna, serta mengendalikan status pintu secara manual melalui fitur toggle yang mengikuti status terakhir servo.</p>
                <h6 class="desc-title mb-3" style="font-weight: 700">Used Components</h6>
                <div class="row justify-content-center">    
                    <div class="card col-12 col-md-auto card-components">
                        <img src="{{ asset('images/esp8266.jpeg')}}"></img>
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; text-align: center">ESP8266</h5>
                        </div>
                    </div>
                    <div class="card col-12 col-md-auto card-components">
                        <img src="{{ asset('images/servosg90.png')}}"></img>
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; text-align: center">Motor Servo SG90</h5>
                        </div>
                    </div>
                    <div class="card col-12 col-md-auto card-components">
                        <img src="{{ asset('images/sensorbme280.jpeg')}}"></img>
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; text-align: center">Sensor BME280</h5>
                        </div>
                    </div>
                    <div class="card col-12 col-md-auto card-components">
                        <img src="{{ asset('images/rfid.jpg')}}"></img>
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; text-align: center">RFID RC522</h5>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>