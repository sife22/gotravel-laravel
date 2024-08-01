@extends('layouts.page')
@section('title', 'Inscription Client - GoTravel')
@section('css')
<style>
  .navbar{
    background-color: white;
    color: black;
  }
  .title{
    color: whitesmoke;
  }
  .footer{
    display: none;
  }
</style>
@endsection
@section('content')
<div class="div_connexion">
  <form method="POST" action="/ajouterClient" class="form_connexion">
    @csrf
    <div>
      <h1 class="form_title">Créer votre compte</h1>
    </div>
    
    <br />
    <div>
      <label>
        Nom : <br />
        <input type="text" name="nom" placeholder="Nom :" value="{{ old('nom') }}" />
        @if ($errors->has('nom'))
        <p class="erreur">{{ $errors->first('nom') }}</p>
        @endif
      </label>
    </div>
    <br>
    <div>
      <label>
        Prénom : <br />
        <input type="text" name="prenom" placeholder="Prénom :" value="{{ old('prenom') }}" />
        @if ($errors->has('prenom'))
        <p class="erreur">{{ $errors->first('prenom') }}</p>
        @endif
      </label>
    </div>
    <br>
    <div>
      <label>
        Téléphone : <br />
        <input type="number" name="tel" placeholder="Téléphone :" value="{{ old('tel') }}" />
        @if ($errors->has('tel'))
        <p class="erreur">{{ $errors->first('tel') }}</p>
        @endif
      </label>
    </div>
    <br>

    <div>
      <label>
        Email : <br />
        <input type="email" name="email" placeholder="Email :" value="{{ old('email') }}" />
        @if ($errors->has('email'))
        <p class="erreur">{{ $errors->first('email') }}</p>
        @endif
      </label>
    </div>
    <br>
    <div>
      <label>
        Mot de passe : <br />
        <input type="password" name="mot_de_passe" placeholder="Mot de passe :" />
        @if($errors->has('mot_de_passe'))
        <p class="erreur">{{ $errors->first('mot_de_passe') }}</p>
        @endif
      </label>
    </div>
    <div>
      <input
        type="submit"
        name="login"
        value="Se connecter"
        class="login"
      />
    </div>
    @if(session()->has('failed_connexion'))
    <br>
        <p class="erreur">{{ Session()->get('failed_connexion') }}</p>
        @endif
    <br />
    <div>
      <a href="/connexion/client" class="btn-inscription"
          >j'ai déja un compte!</a
        >
    </div>
  </form>
</div>
@endsection