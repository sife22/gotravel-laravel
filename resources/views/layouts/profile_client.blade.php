<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/img/favicon.ico" rel="icon">

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
            <a href="/accueil-client" class="navbar-brand p-0">
                <h1 class="title m-0"><i class="fa fa-user-circle-o me-3"></i>Bienvenue {{ App\Models\Client::find(session()->get('client_id'))->prenom;}}</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/accueil-client" class="nav-item nav-link">Accueil</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Nos voyage</a>
                        <div class="dropdown-menu m-0">
                            <a href="/meilleures_offres" class="dropdown-item">Meilleures offres</a>
                            <a href="/au_maroc" class="dropdown-item">Au Maroc</a>
                            <a href="/à_étranger" class="dropdown-item">L'étranger</a>
                            <a href="/hajj_oumra" class="dropdown-item">Hajj et oumra</a>
                        </div>
                    </div>
                    <a href="/mes_réservations" class="nav-item nav-link">Mes réservations</a>
                    <a href="/profil/{{ session()->get('client_id') }}" class="nav-item nav-link">Profil</a>
                    <a href="/logoutClient" class="nav-item nav-link">Se déconnecter</a>
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
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


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