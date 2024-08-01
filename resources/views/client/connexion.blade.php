@extends(session()->has('client_id') === true ? 'layouts.profile_client' : 'layouts.page')
@section('title', 'Connexion client - GoTravel')
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
  <form action="/loginClient" method="POST" class="form_connexion">
    @csrf
    
    <div>
      <h1 class="form_title">Connectez-vous</h1>
    </div>
    
    @if(session()->has('middleware_client'))
        <h3 class="erreur">{{ Session()->get('middleware_client') }}</h3>
        @endif
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
    <div style="display: grid; justify-content:center;">
      <div>
        <a href="/inscription/client" class="btn-inscription">
          Créer un compte
        </a>
      </div>
      <div>
        <a href="/mot_de_passe_oublié" class="btn-mdp"
        >Mot de passe oublié!</a
        >
        @if(session()->has('resetPassword'))
        <h5 class="erreur">{{ Session()->get('resetPassword') }}</h5>
        @endif
      </div>
    </div>
  </form>
</div>
@endsection
