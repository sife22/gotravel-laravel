@extends('layouts.page')
@section('title', 'Créer un nouveau mot de passe')
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
  <form action="/resetPassword" method="POST" class="form_connexion">
    @csrf
    <div>
      <h1 class="form_title">Créer un nouveau mot de passe</h1>
    </div>
    <div>
      <label>
        Entrer un mot de passe : <br />
        <input type="password" placeholder="Entrer un nouveau mot de passe : " name="mot_de_passe"/>
        @if ($errors->has('mot_de_passe'))
        <p class="erreur">{{ $errors->first('mot_de_passe') }}</p>
        @endif
      </label>
    </div>
    
    <div> 
      <input
        type="submit"
        name="login"
        value="Confirmer"
        class="login"
      />
    </div>
  </form>
</div>
@endsection