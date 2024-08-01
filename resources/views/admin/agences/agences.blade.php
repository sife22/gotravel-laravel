@extends('layouts.profile_admin')
@section('title', 'Agences - GoTravel')
@section('navbar')
<form class="d-flex" role="search" action="/trouverAgence" method="POST">
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
                <a class="nav-link" href="/accueil-admin/ajouter_agence">Ajouter une agence</a>
                
                
        
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
              <td><a href="/modifier/agence/{{ $agence->id }}">Modifier</a> <a href="/supprimer/agence/{{ $agence->id }}">Supprimer</a></></td>
            </tr>
            @endforeach
          </tbody>
    </table>
</div>
</main>
@endsection























{{-- ============= --}}

{{-- @extends('layouts.profile_admin')
@section('title', 'Accueil Admin')
@section('css')
<link rel="stylesheet" href="/style/admin/agences.css" type="text/css" />
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="agences" style="width: 100%">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          @if(session()->has('supprimer_agence_succes'))
          <p class="succes nav-link">{{ Session()->get('supprimer_agence_succes') }}</p>
          <br />
          @endif
            <div class="container-fluid">
                <a class="nav-link" href="/accueil-admin/ajouter_agence">Ajouter une agence</a>
                @if(session()->has('ajoute_agence_succes'))
                <p class="succes">{{ Session()->get('ajoute_agence_succes') }}</p>
                <br />
                @endif
                @if(session()->has('modifier_agence_succes'))
                <p class="succes">{{ Session()->get('modifier_agence_succes') }}</p>
                <br />
                @endif
            <form class="d-flex" role="search" action="/trouverAgence" method="POST">
              @csrf
                <input class="form-control me-2" type="search" placeholder="Nom d'agence :" aria-label="Search" name="raison_sociale">
                <button class="btn btn-outline-success" type="submit">Chercher</button>
              </form>
            </div>
            </nav>
            <h2>Nombre d'agences : {{ count($agences) }}</h2>
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
                <td><a href="/modifier/agence/{{ $agence->id }}">Modifier</a> <a href="/supprimer/agence/{{ $agence->id }}">Supprimer</a></></td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection --}}