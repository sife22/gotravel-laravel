@extends('layouts.profile_admin')
@section('title', 'Ajouter une agence - GoTravel')
@section('css')
<link rel="stylesheet" href="/style/admin/modifier_voyage.css">
@endsection
@section('content')
<main>
<div class="main__container">
<div class="div_ajoute">
  <form action="/adminAjouterAgence" method="post" class="form_voyage" enctype="multipart/form-data">
    @csrf
  <div>
    <h1 class="form_title">Ajouter une agence</h1>
  </div>
  <br />
  <div>
    <label>
      Raison sociale : <br />
      <input type="text" placeholder="Le nom d'agence : " name="raison_sociale" value="{{ old('raison_sociale') }}"   class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('raison_sociale'))
  <div class="erreur">{{ $errors->first('raison_sociale') }}</div>
  @endif
  <br />
  <div>
    <label>
      Ice : <br />
      <input type="number" placeholder="Le numéro d'identification fiscale : " name="ice" value="{{ old('ice') }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('ice'))
  <div class="erreur">{{ $errors->first('ice') }}</div>
  @endif
  <br />
  <div>
    <label>
      Téléphone : <br />
      <input type="number" placeholder="Téléphone / Fix : " name="tel" value="{{ old('tel') }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('tel'))
  <div class="erreur">{{ $errors->first('tel') }}</div>
  @endif
  <br />
  <div>
    <label>
      Ville : <br />
      <input type="text" placeholder="Ville : " name="ville" value="{{ old('ville') }}"  class="input_inscription" />
    </label>
  </div>
  @if ($errors->has('ville'))
  <div class="erreur">{{ $errors->first('ville') }}</div>
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
      value="Ajouter l'agence"
      class="modifier"
    />
  </div>
</form>
    </div>
  </div>
</main>
@endsection
