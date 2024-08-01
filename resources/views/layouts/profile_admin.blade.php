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
          <a class="active_link" href="#">Bienvenu {{ App\Models\Admin::find(session()->get('admin_id'))->prenom;}}</a>
        </div>
        @yield('navbar')
      </nav>

      
      @yield('content')

      <div id="sidebar">
        <div class="sidebar__title">
          <div class="sidebar__img">
            {{-- <img src="assets/logo.png" alt="logo" /> --}}
            <h1>Gérer votre plateforme</h1>
          </div>
          <i
            onclick="closeSidebar()"
            class="fa fa-times"
            id="sidebarIcon"
            aria-hidden="true"
          ></i>
        </div>


        <div class="sidebar__menu">
          <div class="sidebar__link active_menu_link">
            <i class="fa fa-home"></i>
            <a href="/accueil-admin">Accueil</a>
          </div>
          <div class="sidebar__link ">
            <i class="fa fa-users"></i>
            <a href="/accueil-admin/agences">Agences</a>
          </div>
          <hr>
          <div class="sidebar__link">
            <i class="fa fa-plane"></i>
            <a href="/accueil-admin/voyages">Voyages</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-plane"></i>
            <a href="/accueil-admin/voyages/btob">Voyages B to B</a>
          </div>
          <hr>

          <div class="sidebar__link">
            <i class="fa fa-user-circle"></i>
            <a href="/accueil-admin/responsables">Responsables</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-user" aria-hidden="true"></i>
            <a href="/accueil-admin/clients">Clients</a>
          </div>

          <div class="sidebar__logout">
            <i class="fa fa-sign-out"></i>
            <a href="/logoutAdmin">Se déconnecter</a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="/js/script.js"></script>
  </body>
</html>