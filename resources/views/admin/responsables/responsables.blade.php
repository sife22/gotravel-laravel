@extends('layouts.profile_admin')
@section('title', 'Responsables - GoTravel')
@section('content')
<main>
    <div class="main__container">
      @if(session()->has('ajoute_responsable_succes'))
                <p class="succes">{{ Session()->get('ajoute_responsable_succes') }}</p>
                <br />
          @endif
          @if(session()->has('modifier_responsable_succes'))
              <p class="succes">{{ Session()->get('modifier_responsable_succes') }}</p>
                <br />
          @endif
          @if(session()->has('supprimer_responsable_succes'))
            <p class="succes">{{ Session()->get('supprimer_responsable_succes') }}</p>
            <br />
          @endif
            <div class="container-fluid">
              <a class="nav-link" href="/accueil-admin/ajouter_responsable">Ajouter un responsable</a>

                
                
        
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Tél</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach ($responsables as $responsable)
          <tr>
            <th scope="row">{{ $responsable->id }}</th>
            <td>{{ $responsable->nom }}</td>
            <td>{{ $responsable->prenom }}</td>
            <td>{{ $responsable->tel }}</td>
            <td>{{ $responsable->email }}</td>
            <td><a href="/modifier/responsable/{{ $responsable->id }}">Modifier</a> <a href="/supprimer/responsable/{{ $responsable->id }}">Supprimer</a></td>
          </tr>
          @endforeach
          </tbody>
    </table>
</div>
</main>
@endsection



























