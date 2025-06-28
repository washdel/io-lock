<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/css/home.css'])
    <!-- Google Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />
    
    <style>
        .home_desc{
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
            font-size: 1.2rem;
            color: #34495e;
            text-align: center;
            margin-top: 20px;
        }

        .logo-container {
            position: relative;
            margin: 0 auto;
            
            max-width: 400px;
            max-height: 200px; /* Membatasi ukuran maksimal logo */
        }
        
        .base-image {
            position: relative;
            top: 50%;
            
            width: 100%;
            height: auto;
            max-width: 350px; /* Logo lebih kecil */
        }

        .gear-image {
            position: absolute;
            top: 68%;
            left: 58%;
            transform: translate(-50%, -50%);
            width: 100px; /* Gear lebih kecil dari 200px */
            height: auto;
            z-index: 10;
            animation: pullUp 0.8s ease-out forwards, rotate 6s linear infinite 1.2s;
        }

        /* Animasi untuk gerak dari bawah ke atas (hanya sekali) */
        @keyframes pullUp {
            0% {
                transform: translate(-50%, 20%) rotate(-45deg);
                opacity: 0;
            }
            100% {
                transform: translate(-50%, -50%) rotate(0deg);
                opacity: 1;
            }
        }
        
        /* Animasi untuk rotasi 360 (berulang terus) */
        @keyframes rotate {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</head>
<body class="home-background">
    <!-- Header / Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-bg-custom fixed-top">
        <div class="container-fluid mx-4">
            <a class="navbar-brand fw-bold" id="brand">IO-Lock</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">About</a>
                        <ul class="dropdown-menu text-start" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('about') }}#team-section">Team</a></li>
                        <li><a class="dropdown-item" href="{{ route('about') }}#brand-section">Product Description</a></li>
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
    </nav>    <div class="container">
    <!-- Welcome Section -->
    <section class="welcome-section fade-in">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="logo-container">
                        <!-- Logo utama -->
                        <img src="/images/IOLOCK.png" alt="IO Lock Logo" class="img-fluid mx-auto d-block base-image">
                        <!-- Gear animasi -->
                        <img src="/images/Gear.png" alt="Animated Gear" class="img-fluid mx-auto d-block gear-image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Description -->
    <div class="row justify-content-center text-center mt-4">
    <div class="col-md-8">
        <p class="home-desc animated-load mx-4">Allowing administrators to manage server room access through registered RFID cards while monitoring temperature in real time — all in <span id="brand" class="highlight"> one </span> secure system.
        We're happy to see you here.</p>
    </div>
    </div>
    <!-- Login button -->
    <div class="row justify-content-center text-center mt-4 animated-load-h">
    <div class="col">
        <a class="btn btn-outline-custom btn-sm login-button d-grid gap-1 col-auto mx-auto" href="{{ route('login') }}">Login</a>
    </div>
    </div>


<!-- Javascript -->
<!-- Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</script>


</body>
</html>