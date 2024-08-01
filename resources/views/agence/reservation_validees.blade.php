@extends('layouts.profile_agence')
@section('title', 'Réservations validées - GoTravel')
{{-- @section('css')
<link rel="stylesheet" href="style/agences/nos_voyages.css">
@endsection --}}
@section('content')
<main>
    <div class="main__container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">
                Date réservation
            </th>
            <th scope="col">
                Nom
            </th>
            <th scope="col">
                Prenom
            </th>
            <th scope="col">
                Téléphone
            </th>
            <th scope="col">
                Voyage
            </th>
            <th scope="col">
                Prix
            </th>
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
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</main>
@endsection