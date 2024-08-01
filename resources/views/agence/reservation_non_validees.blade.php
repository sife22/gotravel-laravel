@extends('layouts.profile_agence')
@section('title', 'Réservations non validées - GoTravel')
@section('css')
<link rel="stylesheet" href="style/agences/nos_voyages.css">
@endsection
@section('content')
<main>
    <div class="main__container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Date réservation</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Voyage</th>
            <th scope="col">Prix</th>
            <th scope="col">Validation</th>
            <th scope="col">Supprimer</th>
          </tr>
        </thead>
    <tbody>
      @foreach($reservations as $reservation)
      <tr>
          <td>{{ $reservation->date_reservation }}</td>
          <td>{{ $reservation->client->nom }}</td>
          <td>{{ $reservation->client->prenom }}</td>
          <td>{{ $reservation->client->tel }}</td>
          <td>{{ $reservation->voyage->titre }}</td>
          <td>{{ $reservation->voyage->prix }}</td>
          <td><a href="/agence/valider/reservation/{{ $reservation->id }}">Valider</a></td>
          <td><a href="/agence/supprimer/reservation/{{ $reservation->id }}">Supprimer</a></td>
      </tr>
      @endforeach
    </tbody>
    </table>
</div>
</main>
@endsection





