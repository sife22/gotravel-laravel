@extends('layouts.page')
@section('title', 'Connexion - GoTravel')
@section('css')
<link rel="stylesheet" href="style/sections/connexion.css">
@endsection
@section('style')
<style>
    .footer{
        display: none;
    }
    .navbar{
        background-color: transparent;
    }
</style>
@endsection
@section('content')


<div class="connexion">
    <div class="middle">
        <button class="button btn1"><a href="/connexion/client" class="btn-client">Espace Client</a
          ></button>
        <button class="button btn2"><a href="/connexion/agence" class="btn-agence"
            >Espace Agence</a
          ></button>
    </div>
</div>
@endsection