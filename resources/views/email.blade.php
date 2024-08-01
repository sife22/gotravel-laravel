@extends('layouts.page')
@section('title', 'Réinitialiser votre mot de passe')
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
  <form action="/sendCode" method="POST" class="form_connexion">
    @csrf
    <div>
      <h1 class="form_title">Réinitialiser votre mot de passe</h1>
    </div>
    
    
    <div>
      <label>
        Entrer votre adresse email : <br />
        <input type="email" placeholder="Entrer votre email : " name="email" />
      </label>
      @if(session()->has('userNotFound'))
      <br>
        <p class="erreur">{{ Session()->get('userNotFound') }}</p>
    @endif
    </div>
    <div>
      <input
        type="submit"
        name="login"
        value="Envoyer"
        class="login"
      />
    </div>
  </form>
</div>
@endsection
