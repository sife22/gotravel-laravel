@extends('layouts.profile_agence')
@section('title', 'Nos voyages B to B - GoTravel')
@section('css')
<link rel="stylesheet" href="style/agences/nos_voyages.css">
@endsection
@section('content')
<main>
    
    <div class="main__container">
        @if(session()->has('supprimer_voyage_succes'))
                  <p class="succes">{{ Session()->get('supprimer_voyage_succes') }}</p>
                    <br />
        @endif
        @if(session()->has('ajouter_voyage_succes'))
                    <p class="succes">{{ Session()->get('ajouter_voyage_succes') }}</p>
                    <br />
              @endif
              @if(session()->has('modifier_voyage_succes'))
              <p class="succes">{{ Session()->get('modifier_voyage_succes') }}</p>
                  <br />
        @endif 
        
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Titre de voyage</th>
            <th scope="col">Prix</th>
            <th scope="col">Pays</th>
            <th scope="col">Ville</th>
            <th scope="col">Date expiration</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
    <tbody>
        @foreach($nos_voyages as $voyage)
          <tr>
            <th scope="row">{{ $voyage->titre }}</th>
            <td>{{ $voyage->prix }}</td>
            <td>{{ $voyage->pays }}</td>
            <td>{{ $voyage->ville }}</td>
            <td>{{ $voyage->date_expiration }}</td>
            <td><a href="/agence/modifier/voyage/{{ $voyage->id }}">Modifier</a>
                <a href="/agence/supprimer/voyage/{{ $voyage->id }}">Supprimer</a>
            </td>
          </tr>
        @endforeach
    </tbody>
    </table>
</div>
</main>
@endsection