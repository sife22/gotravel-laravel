@extends('layouts.profile_admin')
@section('title', 'Ajouter un responsable - GoTravel')
@section('css')
<link rel="stylesheet" href="/style/admin/modifier_voyage.css">
@endsection
@section('content')
<main>
<div class="main__container">
<div class="div_ajoute">
  <form action="/adminAjouterResponsable" method="post" class="form_voyage" enctype="multipart/form-data">
    @csrf
  <div>
    <h1 class="form_title">Ajouter un responsable</h1>
  </div>
  <br />
  <div>
    <label>
      Nom : <br />
      <input type="text" placeholder="Nom : " name="nom" value="{{ old('nom') }}"   class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('nom'))
  <div class="erreur">{{ $errors->first('nom') }}</div>
  @endif
  <br />
  <div>
    <label>
      Prénom : <br />
      <input type="text" placeholder="Prénom : " name="prenom" value="{{ old('prenom') }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('prenom'))
  <div class="erreur">{{ $errors->first('prenom') }}</div>
  @endif
  <br />
  <div>
    <label>
      Téléphone : <br />
      <input type="number" placeholder="Téléphone : " name="tel" value="{{ old('tel') }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('tel'))
  <div class="erreur">{{ $errors->first('tel') }}</div>
  @endif
  <br />
  <div>
    <label>
      Cin : <br />
      <input type="text" placeholder="Cin : " name="cin" value="{{ old('cin') }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('cin'))
  <div class="erreur">{{ $errors->first('cin') }}</div>
  @endif
  <br />
  <div>
    <label>
      Email : <br />
      <input type="email" placeholder="L'email : " name="email" value="{{ old('email') }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('email'))
  <div class="erreur">{{ $errors->first('email') }}</div>
  @endif
  <br />
  <div>
    <label>
      Mot de passe : <br />
      <input type="password" placeholder="Enter un mot de passe : " name="mot_de_passe" value="{{ old('mot_de_passe') }}"  class="input_inscription"/>
    </label>
  </div>
  @if ($errors->has('mot_de_passe'))
  <div class="erreur">{{ $errors->first('mot_de_passe') }}</div>
  @endif
  <br />
  <div>
    <input
      type="submit"
      name="modifier"
      value="Ajouter un responsable"
      class="modifier"
    />
  </div>
</form>
    </div>
  </div>
</main>
@endsection



















