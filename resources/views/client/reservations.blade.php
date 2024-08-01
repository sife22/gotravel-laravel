@extends(session()->has('client_id') === true ? 'layouts.profile_client' : 'layouts.page')
@section('title', 'Mes réservations - GoTravel')
@section('css')
<style>
  .navbar{
    background-color: white;
    /* color: whitesmoke; */
  }
  .title{
    color: #0d2680;
  }
  .footer{
    display: none;
  }
  .prix {
    color: black;
    border: 1px solid orange;
    border-radius: 3px;
    padding: 10px;
    background-color: orange;
}  
</style>
@endsection
@section('content')
<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <div class="container-fluid bg-primary py-2 mb-5 hero-header">
        <div class="container py-2">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Mes réservations</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->
<!-- Package Start -->
<div class="container-xxl ">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($voyages as $voyage)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="package-item">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="/images/voyages/{{ $voyage->pays }}/{{ $voyage->images[0]->url }}" alt="">
                    </div>
                    <div class="d-flex border-bottom">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $voyage->pays }}</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>{{ $voyage->date_expiration }}</small>
                    </div>
                    <div class="text-center p-4">
                        <h2 class="mb-3"><a class="titre" href="/voyages/{{ $voyage->id }}">{{ $voyage->titre }}</a></h2>
                        <h3 class="mb-3 prix">{{ $voyage->prix }} DH</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <br>
    
</div>
<!-- Package End -->
@endsection