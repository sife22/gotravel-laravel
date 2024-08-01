@extends(session()->has('client_id') === true ? 'layouts.profile_client' : 'layouts.page')
@section('title', 'Contactez-nous - GoTravel')
@section('content')
<!-- Topbar Start -->
<div class="container-fluid bg-primary py-2 mb-2 hero-header">
    <div class="container py-3">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Contactez-nous</h1>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
   <!-- Contact Start -->
   <div class="container-xxl py-5">
    <div class="container">
      <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <h2>Informations</h2>
            <div class="d-flex align-items-center mb-4">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0 " style="width: 50px; height:50px;background-color:rgb(254, 123, 54);">
                    <i class="fa fa-map-marker-alt text-white"></i>
                </div>
                <div class="ms-3" style="color: black;">
                    <h5 class="icon">Bureau</h5>
                    <p class="mb-0">Angle avenue de France, Agdal, Rabat</p>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0 " style="width: 50px; height:50px;background-color:rgb(254, 123, 54);">
                    <i class="fa fa-phone-alt text-white"></i>
                </div>
                <div class="ms-3" style="color: black;">
                    <h5 class="icon">Tél</h5>
                    <p class="mb-0">+212 6 58 99 3498</p>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center flex-shrink-0 " style="width: 50px; height:50px;background-color:rgb(254, 123, 54);">
                    <i class="fa fa-envelope-open text-white"></i>
                </div>
                <div class="ms-3" style="color: black;">
                    <h5 class="icon">Email</h5>
                    <p class="mb-0">maroc.gotravel@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
        </div>
        <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
            <iframe
              class="position-relative rounded w-100 h-100"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3307.8353965187785!2d-6.852894184904599!3d33.99676148753304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76c8de2941f27%3A0x8fc4002facf873bf!2s37%20Av.%20Ibn%20Sina%2C%20Rabat!5e0!3m2!1sen!2sma!4v1692352990113!5m2!1sen!2sma"
              frameborder="0"
              style="min-height: 300px; border: 0"
              allowfullscreen=""
              aria-hidden="false"
              tabindex="0"
            ></iframe>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact End -->
@endsection