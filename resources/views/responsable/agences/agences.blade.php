@extends('layouts.profile_responsable')
@section('title', 'Agences - GoTravel')
@section('navbar')
<form class="d-flex" role="search" action="/responsableTrouverAgence" method="POST">
  @csrf
    <input class="form_input" type="search" placeholder="Nom d'agence :" aria-label="Search" name="raison_sociale">
    <button class="form_btn" type="submit">Rechercher</button>
  </form>
@endsection
@section('content')
<main>
    <div class="main__container">
      @if(session()->has('supprimer_agence_succes'))
          <p class="succes nav-link">{{ Session()->get('supprimer_agence_succes') }}</p>
          <br />
          @endif
          @if(session()->has('ajoute_agence_succes'))
                <p class="succes">{{ Session()->get('ajoute_agence_succes') }}</p>
                <br />
                @endif
                @if(session()->has('modifier_agence_succes'))
                <p class="succes">{{ Session()->get('modifier_agence_succes') }}</p>
                <br />
                @endif
            <div class="container-fluid">
                <a class="nav-link" href="/accueil-responsable/ajouter_agence">Ajouter une agence</a>
                
                
        
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Ice</th>
            <th scope="col">Raison sociale</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Ville</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach ($agences as $agence)
            <tr>
              <th scope="row">{{ $agence->id }}</th>
              <th>{{ $agence->ice }}</th>
              <td>{{ $agence->raison_sociale }}</td>
              <td>{{ $agence->tel }}</td>
              <td>{{ $agence->ville }}</td>
              <td>{{ $agence->email }}</td>
              <td><a href="/responsable/modifier/agence/{{ $agence->id }}">Modifier</a> <a href="/responsable/supprimer/agence/{{ $agence->id }}">Supprimer</a></></td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
</main>
@endsection































