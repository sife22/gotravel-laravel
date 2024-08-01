@extends('layouts.profile_agence')
@section('title', 'Accueil agence - GoTravel')
@section('css')
<link rel="stylesheet" href="style/agences/accueil.css">
@endsection
@section('content')


<main>
    <div class="main__container">
      <!-- MAIN CARDS STARTS HERE -->
      <div class="main__cards">
        <div class="card">
          <i
            class="fa fa-plane fa-2x text-lightblue"
            aria-hidden="true"
          ></i>
          <br />
          <div class="card_inner">
            <p class="text-primary-p">Nombre de voyages</p>
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
          <i class="fa fa-calendar fa-2x text-red" aria-hidden="true"></i>
          <br />

          <div class="card_inner">
            <p class="text-primary-p">Nombre de réservation validées</p>
            <span class="font-bold text-title">{{ $nombre_reservations_validees }}</span>
          </div>
        </div>


        <div class="card">
          <i
            class="fa fa-usd fa-2x text-green"
            aria-hidden="true"
          ></i>
          <br />

          <div class="card_inner">
            <p class="text-primary-p">Chiffre d'affaire en DH</p>
            <span class="font-bold text-title">{{ $chiffre_affaire }}</span>
          </div>
        </div>
      </div>
      <!-- MAIN CARDS ENDS HERE -->
    </div>
  </main>

@endsection