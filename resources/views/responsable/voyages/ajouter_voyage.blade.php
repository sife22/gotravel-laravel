@extends('layouts.profile_responsable')
@section('title', 'Ajouter un voyage - GoTravel')
@section('css')
<link rel="stylesheet" href="/style/agences/ajouter_voyage.css">
@endsection
@section('content')
<main>
    <div class="main__container">
      <div class="div_ajoute">
        <form action="/responsableAjouterVoyage" method="post" class="form_voyage" enctype="multipart/form-data">
            @csrf
          <div>
            <h1 class="form_title">Ajouter un Voyage</h1>
          </div>
          <br />
          <div>
            <label>
              Titre : <br />
              <input type="text" name="titre" placeholder="Titre :"  class="input_inscription" value="{{ old('titre') }}" />
            </label>
          </div>
          @if ($errors->has('titre'))
          <div class="erreur">{{ $errors->first('titre') }}</div>
          @endif
          <br />
          <div>
            <label>
              Description : <br />
              <textarea name="desc" cols="30" placeholder="Description : " class="input_inscription" style="resize: none; 
              height:150px" >{{ old('desc') }}</textarea>
            </label>
          </div>
          @if ($errors->has('desc'))
          <div class="erreur">{{ $errors->first('desc') }}</div>
          @endif
          <br />
  
          <div>
            <label>
              Prix : <br />
              <input type="number" name="prix" placeholder="Prix :"  class="input_inscription"  value="{{ old('prix') }}"/>
            </label>
          </div>
          @if ($errors->has('prix'))
          <div class="erreur">{{ $errors->first('prix') }}</div>
          @endif
          <br />
  
          <div>
            <label>
              Catégorie : 
              <select name="categorie" value="{{ old('categorie') }}">
                <option disabled selected> -- Choisi une catégorie -- </option>
                <option value="Haj et oumra" @if(old('categorie') == 'Haj et oumra') selected @endif>Haj et oumra</option>
                <option value="Au Maroc" @if(old('categorie') == 'Au Maroc') selected @endif>Au Maroc</option>
                <option value="À l'étranger" @if(old('categorie') == "À l'étranger") selected @endif>À l'étranger</option>
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
              class="input_inscription"  value="{{ old('pays') }}"/>
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
              class="input_inscription"  value="{{ old('ville') }}"/>
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
             class="input_inscription"  value="{{ old('date_expiration') }}" />
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
             class="input_inscription"  value="{{ old('date_depart') }}" />
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
              class="input_inscription"  value="{{ old('date_retour') }}"/>
            </label>
          </div>
          @if ($errors->has('date_retour'))
          <div class="erreur">{{ $errors->first('date_retour') }}</div>
          @endif
          <br />
          <div>
            <label>
              Description (Programme) : <br />
              @for($jour = 1; $jour <= 10; $jour++)
              <div>
                {{-- <input type="text" name="descriptions[{{ $jour }}]" id="description_jour{{ $jour }}" value="{{ old('descriptions.'.$jour) }}"> --}}
                <textarea name="descriptions[{{ $jour }}]" cols="30" placeholder="Jour {{ $jour }} : " class="input_inscription" style="resize: none; 
                  height:150px">{{ old('descriptions.'.$jour) }}</textarea>
                  {{-- <label>Jour {{ $jour }} :</label> --}}
              </div>
              @endfor
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
                class="input_inscription" value="{{ old('images') }}"
                multiple />
            </label>
          </div>
          @if ($errors->has('images'))
          <div class="erreur">{{ $errors->first('images') }}</div>
          @endif
          <br />
          
          <div>
            <label>
              Agence : 
          <br />
          <br />
          <select name="agence_id" value="{{ old('agence_id') }}">
            <option disabled selected> -- Choisi l'agence de voyage -- </option>
            @foreach ($agences as $agence)
            <option value="{{ $agence->id }}" @if(old('agence_id') == $agence->id)) selected @endif>{{ $agence->raison_sociale }}</option>
            @endforeach
        </select>
        </label>
      </div>
      @if ($errors->has('agence_id'))
      <div class="erreur">{{ $errors->first('agence_id') }}</div>
      @endif
          
    <br>

          <div>
            <input
              type="submit"
              name="ajouter"
              value="Ajouter le voyage"
              class="ajouter"
            />
          </div>
        </form>
        </div>
    </div>
  </main>

@endsection






















