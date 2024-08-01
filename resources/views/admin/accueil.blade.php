@extends('layouts.profile_admin')
@section('title', 'Accueil Admin')
@section('css')
<link rel="stylesheet" href="/style/admin/accueil.css" type="text/css" />
@endsection
@section('content')
<main>
    <div class="main__container">
      <!-- MAIN CARDS STARTS HERE -->
      <div class="main__cards">
          <div class="card">
            <i class="fa fa-users fa-2x text-red" aria-hidden="true"></i>
            <br />
  
            <div class="card_inner">
              <p class="text-primary-p">Nombre d'agences</p>
              <span class="font-bold text-title">{{ $nombre_agences }}</span>
            </div>
          </div>

        <div class="card">
          <i
            class="fa fa-plane fa-2x text-lightblue"
            aria-hidden="true"
          ></i>
          <br />
          <div class="card_inner">
            <p class="text-primary-p">Nombre de voyages total</p>
            <span class="font-bold text-title">{{ $nombre_voyages }}</span>
          </div>
        </div>

        <div class="card">
          <i
            class="fa fa-calendar fa-2x text-yellow"
            aria-hidden="true"
          ></i>
          <br />

          <div class="card_inner">
            <p class="text-primary-p">Nombre de réservations</p>
            <span class="font-bold text-title">{{ $nombre_reservations }}</span>
          </div>
        </div>



        <div class="card">
          <i
            class="fa fa-usd fa-2x text-green"
            aria-hidden="true"
          ></i>
          <br />

          <div class="card_inner">
            <p class="text-primary-p">Chiffre d'affaire provisoire</p>
            <span class="font-bold text-title">{{ $chiffre }}</span>
          </div>
        </div>
      </div>
      <!-- MAIN CARDS ENDS HERE -->
    </div>
  </main>

@endsection








