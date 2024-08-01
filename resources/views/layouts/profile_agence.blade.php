<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    

    <link rel="stylesheet" href="/css/styles.css" />
    
    <title>@yield('title')</title>
    @yield('css')
    @yield('style')
  </head>
  <body id="body">
    <div class="container">
      <nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
          <a class="active_link" href="#">Bienvenu {{ App\Models\Agence::find(session()->get('agence_id'))->raison_sociale;}}</a>
        </div>
        @yield('navbar')
      </nav>

      
      @yield('content')

      <div id="sidebar">
        <div class="sidebar__title">
          <div class="sidebar__img">
            {{-- <img src="assets/logo.png" alt="logo" /> --}}
            <h1>{{ App\Models\Agence::find(session()->get('agence_id'))->raison_sociale;}}</h1>
          </div>
          <i
            onclick="closeSidebar()"
            class="fa fa-times"
            id="sidebarIcon"
            aria-hidden="true"
          ></i>
        </div>


        <div class="sidebar__link">
          <i class="fa fa-home"></i>
          <a href="/accueil-agence">Accueil</a>
        </div>
        <div class="sidebar__menu">
          <div class="sidebar__link">
            <i class="fa fa-globe"></i>
            <a href="/nos_voyages">Nos voyages</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-bold"></i>
            <a href="/nos_voyages_btob">Nos voyages B to B</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-plane" aria-hidden="true"></i>
            <a href="/ajouter-voyage">Déposer un voyage</a>
          </div>
          <hr>
          <div class="sidebar__link">
            <i class="fa fa-users"></i>
            <a href="/agence/reservations/nonvalidées">Réservations</a>
          </div>
          <div class="sidebar__link">
             <i class="fa fa-users"></i>
            <a href="/agence/reservations/validées">Réservation validées</a>
          </div>
          <hr>
          
          <div class="sidebar__link">
            <i class="fa fa-users"></i>
            <a href="/agence/reservations/btob">Réservations B to B</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-users"></i>
            <a href="/agence/reservations/btob/validées">Réservations B to B validées</a>
          </div>
          <hr>
          <div class="sidebar__link">
            <i class="fa fa-money" aria-hidden="true"></i>
            <a href="/voyages_btob">Les offres B to B</a>
          </div>

          <div class="sidebar__logout">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <a href="/logoutAgence">Se déconnecter</a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="/js/script.js"></script>
  </body>
</html>
