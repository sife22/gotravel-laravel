<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="data:image/png;base64,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" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
    @yield('css')
    @yield('style')
</head>

<body>
    <!-- Navbar & Hero Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="/" class="navbar-brand p-0">
                <img src="/bg/logo.png" alt="Logo" style="width: 200px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/" class="nav-item nav-link">Accueil</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Nos voyage</a>
                        <div class="dropdown-menu m-0">
                            <a href="/meilleures_offres" class="dropdown-item">Meilleures offres</a>
                            <a href="/au_maroc" class="dropdown-item">Au Maroc</a>
                            <a href="/à_étranger" class="dropdown-item">L'étranger</a>
                            <a href="/hajj_oumra" class="dropdown-item">Hajj et oumra</a>
                        </div>
                    </div>
                    <a href="/contact" class="nav-item nav-link">Contactez-nous</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Connexion</a>

                        <div class="dropdown-menu m-0">
                            <a href="/connexion/client" class="dropdown-item">Client</a>
                            <a href="/connexion/agence" class="dropdown-item">Agence</a>
                        </div>
                    </div>
                    </div>
            </div>
        </nav>

        
    </div>
    <!-- Navbar & Hero End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <a class="btn btn-link" href="/contact">Contactez-nous</a>
                    <a class="btn btn-link" href="/meilleures_offres">Les meilleurs offres</a>
                    <a class="btn btn-link" href="/hajj_oumra">Hajj et oumra</a>
                    <a class="btn btn-link" href="/au_maroc">Voyages Au Maroc</a>
                    <a class="btn btn-link" href="/à_étranger">Voyages à étranger</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Angle avenue de France, Agdal, Rabat</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+212 658 99 34 98</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>maroc.gotravel@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/profile.php?id=100093049351066&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://instagram.com/gotravel.ma?igshid=MmU2YjMzNjRlOQ=="><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="https://www.gotravel.ma">GOTRAVEL</a>, Tous droits réservés. {{ date('Y') }}

                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> --}}


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>