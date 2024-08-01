@extends('layouts.profile_responsable')
@section('title', 'Modifier un voyage - GoTravel')
@section('css')
<link rel="stylesheet" href="/style/admin/modifier_voyage.css">
@endsection
@section('content')
<main>
<div class="main__container">
<div class="div_ajoute">
  <form action="/responsableModifierVoyage/{{ $voyage->id }}" method="post" class="form_voyage" enctype="multipart/form-data">
    @method('PUT')
    @csrf
  <div>
    <h1 class="form_title">Modifier le voyage : {{ $voyage->titre }}</h1>
  </div>
  <br />
  <div>
    <label>
      Titre : <br />
      <input type="text" name="titre" placeholder="Titre :"  class="input_inscription" value="{{ $voyage->titre }}" />
    </label>
  </div>
  @if ($errors->has('titre'))
  <div class="erreur">{{ $errors->first('titre') }}</div>
  @endif
  <br />
  <div>
    <label>
      Description : <br />
      <input type="text" name="desc" placeholder="Description :"  class="input_inscription" value="{{ $voyage->desc }}" />
    </label>
  </div>
  @if ($errors->has('desc'))
  <div class="erreur">{{ $errors->first('desc') }}</div>
  @endif
  <br />

  <div>
    <label>
      Prix : <br />
      <input type="number" name="prix" placeholder="Prix :"  class="input_inscription"  value="{{ $voyage->prix }}"/>
    </label>
  </div>
  @if ($errors->has('prix'))
  <div class="erreur">{{ $errors->first('prix') }}</div>
  @endif
  <br />

  <div>
    <label>
      Catégorie : 
      <select name="categorie" value="{{ $voyage->categorie }}">
        <option disabled selected> -- Choisi une catégorie -- </option>
        <option value="Haj et oumra" @if ($voyage->categorie == 'Haj et oumra') selected @endif>Haj et oumra</option>
        <option value="Au Maroc" @if($voyage->categorie == 'Au Maroc') selected @endif>Au Maroc</option>
        <option value="À l'étranger" @if($voyage->categorie == "À l'étranger") selected @endif>À l'étranger</option>
    </select>
    </label>
  </div>
  @if ($errors->has('categorie'))
  <div class="erreur">{{ $errors->first('categorie') }}</div>
  @endif
  <br />

  <div>
    <label>
      Pays : <br />
      <input
        type="text"
        name="pays"
        placeholder="Pays :"
      class="input_inscription"  value="{{ $voyage->pays }}"/>
    </label>
  </div>
  @if ($errors->has('pays'))
  <div class="erreur">{{ $errors->first('pays') }}</div>
  @endif
  
  <br />
  <div>
    <label>
      Ville : <br />
      <input
        type="text"
        name="ville"
        placeholder="Ville :"
      class="input_inscription"  value="{{ $voyage->ville }}"/>
    </label>
  </div>
  @if ($errors->has('ville'))
  <div class="erreur">{{ $errors->first('ville') }}</div>
  @endif
  <br />
  <div>
    <label>
      Date expiration : <br />
      <input
        type="date"
        name="date_expiration"
        placeholder="Date expiration d'inscription :"
     class="input_inscription"  value="{{ $voyage->date_expiration }}" />
    </label>
  </div>
  @if ($errors->has('date_expiration'))
  <div class="erreur">{{ $errors->first('date_expiration') }}</div>
  @endif
  <br />
  <div>
    <label>
      Date départ : <br />
      <input
        type="date"
        name="date_depart"
        placeholder="Date départ :"
     class="input_inscription"  value="{{ $voyage->date_depart }}" />
    </label>
  </div>
  @if ($errors->has('date_depart'))
  <div class="erreur">{{ $errors->first('date_depart') }}</div>
  @endif
  <br />
  <div>
    <label>
      Date retour : <br />
      <input
        type="date"
        name="date_retour"
        placeholder="Date retour :"
      class="input_inscription"  value="{{ $voyage->date_retour }}"/>
    </label>
  </div>
  @if ($errors->has('date_retour'))
  <div class="erreur">{{ $errors->first('date_retour') }}</div>
  @endif
  <br />

  <div>
    <label>
      Agence : 
  <br />
  <br />


  <select name="agence_id" value="{{ $voyage->agence->id }}">
    <option disabled selected> -- Choisi l'agence de voyage -- </option>
    @foreach ($agences as $agence)
    <option value="{{ $agence->id }}" @if($voyage->agence->id == $agence->id)) selected @endif>{{ $agence->raison_sociale }}</option>
    @endforeach
</select>




    </label>
  </div>
  @if ($errors->has('agence_id'))
  <div class="erreur">{{ $errors->first('agence_id') }}</div>
  @endif
  <br />
  <div>
    <label>
      Description (Programme) : <br />
      @foreach(json_decode($voyage->description, true) as $jour => $description)
      <div>
        <textarea name="descriptions[{{ $jour }}]" cols="30" placeholder="Jour {{ $jour }} : " class="input_inscription" style="resize: none; 
          height:150px">{{ $description }}</textarea>
      </div>
      @endforeach
      
      
    </label>
  </div>
  @if ($errors->has('description'))
  <div class="erreur">{{ $errors->first('description') }}</div>
  @endif
  <br />
  <div>
    <label>
      Images : <br />
      <input
        type="file"
        name="images[]"
        class="input_inscription"  value="{{ $voyage->images }}"
        multiple />
    </label>
  </div>
<br>
  
  
  <div>
    <input
      type="submit"
      name="modifier"
      value="Modifier le voyage"
      class="modifier"
    />
  </div>
</form>
    </div>
  </div>
</main>
@endsection



