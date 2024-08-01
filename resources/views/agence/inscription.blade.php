@extends('layouts.page')
@section('title', 'Inscription Agence - GoTravel')
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
  <form method="POST" action="/ajouterAgence" class="form_connexion">
    @csrf
    <div>
      <h1 class="form_title">Créer votre compte</h1>
    </div>
    @if(session()->has('inscription_succes'))
      <h3 class="succes">{{ Session()->get('inscription_succes') }}</h3>
      @endif 
    <br />
    <div>
      <label>
        Raison sociale : <br />
        <input type="text" name="raison_sociale" placeholder="Raison sociale :" value="{{ old('raison_sociale') }}" />
        @if ($errors->has('raison_sociale'))
         <p class="erreur">{{ $errors->first('raison_sociale') }}</p>
         @endif
      </label>
    </div>
    <br>
    <div>
      <label>
        Le numéro d'identification fiscale : <br />
        <input type="number" name="ice" placeholder="Le numéro d'identification fiscale :  :" value="{{ old('ice') }}" />
        @if ($errors->has('ice'))
        <p class="erreur">{{ $errors->first('ice') }}</p>
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
        Ville : <br />
        <input type="text" name="ville" placeholder="Ville :" value="{{ old('ville') }}" />
        @if ($errors->has('ville'))
        <p class="erreur">{{ $errors->first('ville') }}</p>
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
    <br />
    <div>
      <a href="/connexion/agence" class="btn-inscription"
          >j'ai déja un compte!</a
        >
    </div>
  </form>
</div>
@endsection