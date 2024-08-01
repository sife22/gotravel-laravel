@extends('layouts.page')
@section('title', 'Accueil - GoTravel')
@section('css')
<link rel="stylesheet" href="style/sections/accueil.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@endsection
@section('content')
<div class="container-fluid bg-primary py-2 mb-2 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Voyagez, explorez et profitez avec nous</h1>
                <p class="fs-4 text-white mb-4 animated slideInDown">Consulter votre destination</p>
                <form class="position-relative w-75 mx-auto animated slideInDown" action="/voyagesParPays" method="POST" >
                    @csrf
                      <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" name="pays" placeholder="Ex : France, Madrid, Rabat, Suisse...">
                      <button type="submit" class="btn btn-dark rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2 btn-recherche" style="margin-top: 7px;">Rechercher</button>
                  </form>
            </div>
        </div>
    </div>
</div>
 <!-- Package Start -->
 <div class="py-5 div_voyages">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-dark px-3">Voyages</h6>
            <h1 class="mb-5">Les meilleurs offres</h1>
        </div>
        <div class="voyages">
                      @foreach ($voyages_vip as $voyage)
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
                                    <a href="/voyages/{{ $voyage->id }}" class="btn btn-sm btn-primary px-5 py-1 border-end" style="border-radius: 30px 30px 30px 30px;">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="d-flex justify-content-center mb-2 wow fadeInUp" data-wow-delay="0.5s">
                        <button class="button-59" role="button"><a href="/meilleures_offres">Voir plus</a></button>
                      </div>
        </div>
</div>
<!-- Package End -->
 <!-- Package Start -->
 <div class="py-5 div_voyages">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-dark px-3">Voyages</h6>
            <h1 class="mb-5">Voyages au Maroc</h1>
        </div>
        <div class="voyages">
                      @foreach ($voyages_au_maroc as $voyage)
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
                                    <a href="/voyages/{{ $voyage->id }}" class="btn btn-sm btn-primary px-5 py-1 border-end" style="border-radius: 30px 30px 30px 30px;">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="d-flex justify-content-center mb-2 wow fadeInUp" data-wow-delay="0.5s">
                        <button class="button-59" role="button"><a href="/au_maroc">Voir plus</a></button>
                      </div>
        </div>
</div>
<!-- Package End -->
 <!-- Package Start -->
 <div class="py-5 div_voyages">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-dark px-3">Voyages</h6>
            <h1 class="mb-5">Voyages à l'étranger</h1>
        </div>
        <div class="voyages">
                      @foreach ($voyages_a_etranger as $voyage)
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
                                    <a href="/voyages/{{ $voyage->id }}" class="btn btn-sm btn-primary px-5 py-1 border-end" style="border-radius: 30px 30px 30px 30px;">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="d-flex justify-content-center mb-2 wow fadeInUp" data-wow-delay="0.5s">
                        <button class="button-59" role="button"><a href="/à_étranger">Voir plus</a></button>
                      </div>
        </div>
</div>
<!-- Package End -->



  <!-- Package Start -->
  <div class="py-5 div_voyages">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-dark px-3">Voyages</h6>
            <h1 class="mb-5">Voyages Hajj et oumra</h1>
        </div>
        <div class="voyages">
                      @foreach ($voyages_haj_oumra as $voyage)
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
                                    <a href="/voyages/{{ $voyage->id }}" class="btn btn-sm btn-primary px-5 py-1 border-end" style="border-radius: 30px 30px 30px 30px;">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    </div>
                    <br>
                    <div class="d-flex justify-content-center mb-2 wow fadeInUp" data-wow-delay="0.5s">
                        <button class="button-59" role="button"><a href="/hajj_oumra">Voir plus</a></button>
                      </div>
        </div>
</div>
<!-- Package End -->

  <!-- About Start -->
  <div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="team/team1.jpg" alt="" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">À propos de nous</h6>
                <h1 class="mb-4">Bienvenues chez <span class="text-primary">GOTRAVEL</span></h1>
                <p class="mb-4">GoTravel est conçue pour être un guichet unique pour tous vos besoins de voyage. Nous avons rassemblé une large gamme d'offres de diverses agences de voyages de confiance pour vous donner un accès facile à un large éventail de destinations et d'expériences.</p>
                <p class="mb-4">Notre mission est de simplifier votre recherche de voyage en éliminant le besoin de rechercher plusieurs sites Web pour trouver les meilleures offres.</p>
                <p class="mb-4">Une interface conviviale et intuitive vous permet de comparer facilement les prix, les itinéraires et les options de voyage disponibles pour prendre des décisions éclairées.</p>
                <a class="btn btn-primary py-3 px-5 mt-2" href="/contact" >Contactez-nous</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->







<!-- Process Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3 mb-4">Procédure</h6>
        </div>
        <div class="row gy-5 gx-4 justify-content-center">
            
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-user-plus fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">S'inscrire</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Enregistrez-vous facilement, et de rendre vos réservations plus facile à chaque fois.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-search fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Consultez</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Découvrez toutes les offres proposées et profitez-en.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="position-relative border border-primary pt-5 pb-4 px-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                        <i class="fa fa-plane fa-3x text-white"></i>
                    </div>
                    <h5 class="mt-4">Réservez et voyagez</h5>
                    <hr class="w-25 mx-auto bg-primary mb-1">
                    <hr class="w-50 mx-auto bg-primary mt-0">
                    <p class="mb-0">Réservez en un clic et profitez du voyage.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- Process Start -->
@endsection