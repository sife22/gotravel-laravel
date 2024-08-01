@extends('layouts.page')
@section('title', 'Connexion responsable - GoTravel')
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
  <form action="/loginResponsable" method="POST" class="form_connexion">
    @csrf
    <div>
      <h1 class="form_title">Gérer votre platform <br>Responsable</h1>
    </div>
    <br />
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
  </form>
</div>
@endsection







