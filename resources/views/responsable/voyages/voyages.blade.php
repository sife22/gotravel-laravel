@extends('layouts.profile_responsable')
@section('title', 'Voyages - GoTravel')
@section('navbar')
<form class="d-flex" role="search" method="POST" action="/responsableTrouverVoyage">
  @csrf
      <input class="form_input" name="titre" type="search" placeholder="Nom de voyage :" aria-label="Search">
      <button class="form_btn" type="submit">Rechercher</button>
    </form>
@endsection
@section('content')
<main>
    <div class="main__container">
      @if(session()->has('ajouter_voyage_succes'))
      <p class="succes">{{ Session()->get('ajouter_voyage_succes') }}</p>
      <br />
              @endif
        @if(session()->has('modifier_voyage_succes'))
            <p class="succes">{{ Session()->get('modifier_voyage_succes') }}</p>
              <br />
        @endif
        @if(session()->has('supprimer_voyage_succes'))
            <p class="succes">{{ Session()->get('supprimer_voyage_succes') }}</p>
              <br />
        @endif
        @if(session()->has('vip_succes'))
            <p class="succes">{{ Session()->get('vip_succes') }}</p>
              <br />
        @endif
        <a class="nav-link" href="/accueil-responsable/ajouter_voyage">Ajouter un voyage</a>

        
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
        @foreach($voyages as $voyage)
          <tr>
            <th scope="row">{{ $voyage->titre }}</th>
            <td>{{ $voyage->prix }}</td>
            <td>{{ $voyage->pays }}</td>
            <td>{{ $voyage->ville }}</td>
            <td>{{ $voyage->date_expiration }}</td>
            <td>
              <a href="/responsable/modifier/voyage/{{ $voyage->id }}">Modifier</a>
              <a href="/responsable/supprimer/voyage/{{ $voyage->id }}">Supprimer</a>
              <a href="/responsable/vip/voyage/{{ $voyage->id }}">Vip</a>
          </td>
          </tr>
        @endforeach
    </tbody>
    </table>
</div>
</main>
@endsection


















