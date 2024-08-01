@extends('layouts.profile_admin')
@section('title', 'Clients - GoTravel')
@section('content')
<main>
    <div class="main__container">
              @if(session()->has('supprimer_client_succes'))
              <p class="succes nav-link">{{ Session()->get('supprimer_client_succes') }}</p>
              <br />
              @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach ($clients as $client)
          <tr>
            <th scope="row">{{ $client->id }}</th>
            <td>{{ $client->nom }}</td>
            <td>{{ $client->prenom }}</td>
            <td>{{ $client->tel }}</td>
            <td>{{ $client->email }}</td>
            <td><a href="/supprimer/client/{{ $client->id }}">Supprimer</a></td>
          </tr>
          @endforeach
          </tbody>
    </table>
</div>
</main>
@endsection
