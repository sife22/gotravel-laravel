@extends('layouts.profile_admin')
@section('title', 'Modifier un responsable - GoTravel')
@section('css')
<link rel="stylesheet" href="/style/admin/modifier_voyage.css">
@endsection
@section('content')
<main>
<div class="main__container">
<div class="div_ajoute">
  <form action="/adminModifierResponsable/{{ $responsable->id }}" method="post" class="form_voyage" enctype="multipart/form-data">
    @method('PUT')

    @csrf
  <div>
    <h1 class="form_title">Modifier {{ $responsable->prenom }} {{ $responsable->nom }}</h1>
  </div>
  <br />
  <div>
    <label>
      Nom : <br />
      <input type="text" placeholder="Nom : " name="nom" value="{{ $responsable->nom }}"   class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('nom'))
  <div class="erreur">{{ $errors->first('nom') }}</div>
  @endif
  <br />
  <div>
    <label>
      Prénom : <br />
      <input type="text" placeholder="Prénom : " name="prenom" value="{{ $responsable->prenom }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('prenom'))
  <div class="erreur">{{ $errors->first('prenom') }}</div>
  @endif
  <br />
  <div>
    <label>
      Téléphone : <br />
      <input type="number" placeholder="Téléphone : " name="tel" value="{{ $responsable->tel }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('tel'))
  <div class="erreur">{{ $errors->first('tel') }}</div>
  @endif
  <br />
  <div>
    <label>
      Cin : <br />
      <input type="text" placeholder="Cin : " name="cin" value="{{ $responsable->cin }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('cin'))
  <div class="erreur">{{ $errors->first('cin') }}</div>
  @endif
  <br />
  <div>
    <label>
      Email : <br />
      <input type="email" placeholder="L'email : " name="email" value="{{ $responsable->email }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('email'))
  <div class="erreur">{{ $errors->first('email') }}</div>
  @endif
  <br />
  <div>
    <input
      type="submit"
      name="modifier"
      value="Modifier"
      class="modifier"
    />
  </div>
</form>
    </div>
  </div>
</main>
@endsection





































