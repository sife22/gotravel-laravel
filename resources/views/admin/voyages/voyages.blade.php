@extends('layouts.profile_admin')
@section('title', 'Voyages - GoTravel')
@section('navbar')
<form class="d-flex" role="search" action="/trouverVoyage" method="POST">
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
        @if(session()->has('vip_succes'))
            <p class="succes">{{ Session()->get('vip_succes') }}</p>
              <br />
        @endif
        @if(session()->has('supprimer_voyage_succes'))
            <p class="succes">{{ Session()->get('supprimer_voyage_succes') }}</p>
              <br />
        @endif
        <a class="nav-link" href="/accueil-admin/ajouter_voyage">Ajouter un voyage</a>

        
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Titre de voyage</th>
            <th scope="col">Prix</th>
            <th scope="col">Pays</th>
            <th scope="col">Ville</th>
            <th scope="col">Date expiration</th>
            <th scope="col">Vip</th>
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
            <td>{{ $voyage->vip }}</td>
            <td><a href="/admin/modifier/voyage/{{ $voyage->id }}">Modifier</a>
              <a href="/supprimer/voyage/{{ $voyage->id }}" class="btn2">Supprimer </a>
              @if($voyage->type === 'Client')
              <a href="/vip/voyage/{{ $voyage->id }}">Vip</a>
              @endif
          </td>
          </tr>
        @endforeach
    </tbody>
  </table>
</div>
</main>
@endsection



