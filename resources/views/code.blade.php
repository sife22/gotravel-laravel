@extends('layouts.page')
@section('title', 'Vérification de votre adresse email')
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
  <form action="/verificationCode" method="POST" class="form_connexion">
    @csrf
    <div>
      <h1 class="form_title">Réinitialiser votre mot de passe</h1>
    </div>
    <div>
      <label>
        Entrer le code envoyé vers votre mail : <br />
        <input type="number" placeholder="Entrer le code envoyé sur votre boite mail : " name="code"/>
      </label>
      @if(session()->has('codeIncorrect'))
        <p class="erreur">{{ Session()->get('codeIncorrect') }}</p>
        @endif
    </div>
    <div>
      <input
        type="submit"
        name="login"
        value="Valider"
        class="login"
      />
    </div>
  </form>
</div>
@endsection








