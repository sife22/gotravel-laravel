@extends(session()->has('client_id') === true ? 'layouts.profile_client' : 'layouts.page')
@section('title', $voyage->titre.' - GoTravel')
@section('style')
<link rel="stylesheet" href="/style/sections/voyage_details.css">
<script></script>
@endsection
@section('content')
<!-- Topbar Start -->
<div class="container-fluid bg-primary hero-header">
  <div class="container">
      <div class="row justify-content-center py-5">
          <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
              <h1 class="display-3 mb-0 text-white animated slideInDown">{{ $voyage->titre }}</h1>
          </div>
      </div>
  </div>
</div>
<!-- Topbar End -->
<!-- Slider Start -->
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
  <h4 class="destination">{{ $voyage->pays }}, {{ $voyage->ville }}</h4>
  <br>
  <div>
    <h2 class="prix">{{ $voyage->prix }} Dh</h2>
<br>

  </div>
  <div>
    <h5>Date depart : {{ $voyage->date_depart }}</h5>
    <h5>Date retour : {{ $voyage->date_retour }}</h5>
  </div>
  <div>
    <p>{{ $voyage->desc }}</p>
  </div>
  <div>
    <h3>Programme : </h3>
    @foreach(json_decode($voyage->description, true) as $jour => $description)
      @if($description !== null)
        <h5 class="jour">Jour {{ $jour }} : </h5>
        <p>{{ $description }}</p>
      @endif
    @endforeach 
  </div>
</div>
<br>
<form class="d-flex justify-content-center mb-2 wow fadeInUp" data-wow-delay="0.5s" method="POST" action="/reserver/{{ $voyage->id }}">
  @csrf
  <button class="button-59 reserver" type="submit" role="button">Réserver</></button>
</form>

<div class="div_voyages">
  <h1 class="autre">Autre voyages pour vous</h1>
  <div class="voyages">
            @foreach ($voyages as $voyage)
            <div class="col-lg-4 col-md-6 wow fadeInUp voyage" data-wow-delay="0.1s">
              <div class="package-item">
                  <div class="overflow-hidden">
                      <img class="img-fluid image" src="/images/voyages/{{ $voyage->pays }}/{{ $voyage->images[0]->url }}" alt="">
                  </div>
                  <div class="d-flex border-bottom">
                      <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $voyage->pays }}</small>
                      <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>{{ $voyage->date_expiration }}</small>
                      <small class="flex-fill text-center border-end py-2"><i class="fa fa-eye text-primary me-2"></i>{{ $voyage->nombre_vues }}</small>

                  </div>
                  <div class="text-center p-4">
                      <h2 class="mb-3"><a class="titre" href="/voyages/{{ $voyage->id }}">{{ $voyage->titre }}</a></h2>
                      <h3 class="mb-3 prix">{{ $voyage->prix }} DH</h3>
                      <div class="d-flex justify-content-center mb-2">
                          <a href="/voyages/{{ $voyage->id }}" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 30px 30px 30px;">Voir plus</a>
                      </div>
                  </div>
              </div>
          </div>
              @endforeach
  </div>
</div>
@endsection