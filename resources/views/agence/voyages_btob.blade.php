@extends(session()->has('agence_id') === true ? 'layouts.profile_agence' : 'layouts.page')
@section('title', 'Offres B to B - GoTravel')
@section('content')
<!-- Navbar & Hero Start -->
<main>
<div class="main__container">
    <div class="voyages">
            @foreach($voyages as $voyage)
            <div class="voyage" data-wow-delay="0.1s">
                    <div class="">
                        <img class="" src="/images/voyages/{{ $voyage->pays }}/{{ $voyage->images[0]->url }}" alt="">
                    </div>
                    
                    <div class="">
                        <h2 class=""><a href="/voyages/btob/{{ $voyage->id }}" class="titre" >{{ $voyage->titre }}</a></h2>
                        <h3 class="">{{ $voyage->prix }} DH</h3>
                        <div class="">
                            <a href="/voyages/btob/{{ $voyage->id }}" class="voir_plus" >Voir plus</a>
                        </div>
                     </div>
            </div>
            @endforeach
    </div>
    <br>
</div>
</main>
@endsection