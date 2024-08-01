@extends(session()->has('agence_id') === true ? 'layouts.profile_agence' : 'layouts.page')
@section('title', $voyage->titre.' - GoTravel')
@section('style')
<link rel="stylesheet" href="/style/agences/voyage_details.css">
<script></script>
@endsection
@section('content')
<!-- Topbar Start -->

<!-- Slider Start -->
<main>
    <div class="main__container">
@if(session()->has('reservation_succes'))
<br>
        <h3 class="succes">{{ Session()->get('reservation_succes') }}</h3>
@endif
@if(session()->has('reservation_added'))
<br>
        <h3 class="succes">{{ Session()->get('reservation_added') }}</h3>
@endif

<div class="slider">
  @foreach($voyage->images as $image)
    <div class="slide">
      <img src="/images/voyages/{{ $voyage->pays }}/{{ $image->url }}" alt="">
    </div>
  @endforeach
  <div class="buttons">
    <button id="prev"><i class="fas fa-arrow-left"></i></button>
    <button id="next"><i class="fas fa-arrow-right"></i></button>
  </div>
  <script>
   const slides = document.querySelectorAll(".slide");
const next = document.querySelector("#next");
const prev = document.querySelector("#prev");
let currentIndex = 0;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = "none";
        if (i === index) {
            slide.style.display = "block";
        }
    });
}

next.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
});

prev.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
});

showSlide(currentIndex);

  </script>
  
</div>
<!-- Slider End -->
<br>
<div class="center-content"> 
  <div>
    <h2>{{ $voyage->titre }}</h2>
    <h2>{{ $voyage->prix }} Dh</h2>
<br>

  </div>
  <div>
    <h5>Date depart : {{ $voyage->date_depart }}</h5>
    <h5>Date retour : {{ $voyage->date_retour }}</h5>
    <h5>Pays : {{ $voyage->pays }}</h5>
    <h5>Ville : {{ $voyage->ville }}</h5>
    <h5>Agence : {{ $voyage->agence->raison_sociale }}</h5>
  </div>
  <div>
    <p>{{ $voyage->desc }}</p>
  </div>
</div>
<br>
<form class="d-flex justify-content-center mb-2 wow fadeInUp" data-wow-delay="0.5s" method="POST" action="/reserver/btob/{{ $voyage->id }}">
  @csrf
  <button class="button-59 reserver" type="submit" role="button">Réserver</></button>
</form>

    </div>
</main>
@endsection