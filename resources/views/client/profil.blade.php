@extends('layouts.profile_client')
@section('title', 'Mon profil - GoTravel')
@section('css')
<link rel="stylesheet" href="/style/clients/profil.css">
<style>
   .navbar{
    background-color: white;
    color: black;
  }
  .title{
    color: #0d2680;
  }
  .footer{
    display: none;
  }
</style>
@endsection
@section('css')
<link rel="stylesheet" href="style/clients/profil.css">
@endsection
@section('content')
<div class="div_ajoute">
    <form action="/modifierProfil/{{ $client->id }}" method="post" class="form_voyage" enctype="multipart/form-data">
        @csrf
      <div>
        <h1 class="form_title">Mon profil</h1>
      </div>
      <br />
      <div>
        <label>
          Nom : <br />
          <input type="text" name="nom" placeholder="Nom :"  class="input_inscription" value="{{ $client->nom }}" />
        </label>
      </div>
      @if ($errors->has('nom'))
      <div class="erreur">{{ $errors->first('nom') }}</div>
      @endif
      <br />
      <div>
        <label>
          Prénom : <br />
          <input type="text" name="prenom" placeholder="Prénom : " class="input_inscription" value="{{ $client->prenom }}" />
        </label>
      </div>
      @if ($errors->has('prenom'))
      <div class="erreur">{{ $errors->first('prenom') }}</div>
      @endif
      <br />

      <div>
        <label>
          Téléphone : <br />
          <input type="number" name="tel" placeholder="Téléphone :"  class="input_inscription"  value="{{ $client->tel }}"/>
        </label>
      </div>
      @if ($errors->has('tel'))
      <div class="erreur">{{ $errors->first('tel') }}</div>
      @endif
      <br />

      <div>
        <label>
          Email : <br />
          <input type="email" name="email" placeholder="Email :"  class="input_inscription"  value="{{ $client->email }}"/>
        </label>
      </div>
      @if ($errors->has('email'))
      <div class="erreur">{{ $errors->first('email') }}</div>
      @endif
      <br />
      <div>
        <input
          type="submit"
          name="ajouter"
          value="Modifier mon profile"
          class="ajouter"
        />
      </div>
    </form>
    </div>
@endsection