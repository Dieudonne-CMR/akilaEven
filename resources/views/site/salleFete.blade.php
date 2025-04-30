
@extends('site.layouts.app-site')
@section('content-site')

<section class="breadcrumb-area bread-bg-10">
  <div class="breadcrumb-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-content text-center">
            <div class="section-heading">
              <h2 class="sec__title text-white">
                Meilleur Annuaire de location de <br> salle de fête au Cameroun </h2>
            </div>
            <span class="arrow-blink">
              <i class="la la-arrow-down"></i>
            </span>
          </div>
          <!-- end breadcrumb-content -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
  <!-- end breadcrumb-wrap -->
  <div class="bread-svg-box">
    <svg class="bread-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
      <polygon points="100 0 50 10 0 0 0 10 100 10"></polygon>
    </svg>
  </div>
  <!-- end bread-svg -->
</section>
<!-- end breadcrumb-area -->
<!-- ================================
  END BREADCRUMB AREA
================================= -->

<!-- ================================
  START CARD AREA
================================= -->
<section class="card-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="filter-wrap margin-bottom-40px">
          <div class="filter-top d-flex align-items-center justify-content-between">
            <div class="section-tab section-tab-3">
              <ul class="nav nav-tabs" id="myTab4" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                    aria-controls="all" aria-selected="false">
                    All
                  </a>
                </li>
                
              </ul>
            </div>
            <!-- end section-tab -->
            <div class="layout-view d-flex align-items-center">
              <a href="room-grid.html" data-bs-toggle="tooltip" data-placement="top" title="Grid View"
                class="active"><i class="la la-th-large"></i></a>
              <a href="room-list.html" data-bs-toggle="tooltip" data-placement="top" title="List View"><i
                  class="la la-th-list"></i></a>
            </div>
          </div>
        </div>
        <!-- end filter-wrap -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="tab-content" id="may-tabContent4">
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
        
        <div class="row">
          @foreach ($eventHalls as $hall)
          {{-- @dd($hall->ville->nom) --}}
            <div class="col-lg-4">
              <div class="card-item room-card">
                <div class="card-img-carousel carousel-action carousel--action">
                  <?php $fiels= ['photo', 'photo1', 'photo2', 'photo3', 'photo4'] ?>
                  @foreach ($fiels as $fiel)
                  {{-- @dd($fiel) --}}
                    @if( $hall->$fiel)
                      <div class="card-img">
                        <a href="{{route('site.detailSallesfetes', $hall->id)}}" class="d-block">
                          <img src="{{ asset('storage/' .  $hall->$fiel) }}" alt="hotel-img" />
                        </a>
                      </div>
                    @endif
                  @endforeach

                  {{-- <div class="card-img">
                    <a href="room-details.html" class="d-block">
                      <img src="assets_site/images/img29.jpg" alt="hotel-img" />
                    </a>
                  </div>

                  <div class="card-img">
                    <a href="room-details.html" class="d-block">
                      <img src="assets_site/images/img30.jpg" alt="hotel-img" />
                    </a>
                  </div> --}}

                </div>
                <div class="card-body">
                  <h3 class="card-title  text-xl md:text-2xl lg:text-3xl font-bold mb-6">
                    <a href="{{route('site.detailSallesfetes', $hall->id)}}">{{ $hall->nom_salle }}</a>
                  </h3>
                 
                  <p class=" text-sm md:text-basecard-text pt-2">
                    {{ Str::limit(strip_tags($hall->description_salle), 100)  }}
                  </p>
               
                  
                  <div class="card-attributes pt-3 pb-4">
                    <ul class=" align-items-center">
                      {{-- <li class="d-flex align-items-center text-sm ">
                        <img src="https://cdn-icons-png.flaticon.com/128/8565/8565868.png" class="img-icone" alt="" sizes="" srcset=""><p> {{ $hall->hotel->nom_hotel }}  </p>
                      </li>
                      <li class="d-flex align-items-center text-sm ">
                        <img src="https://cdn-icons-png.flaticon.com/128/2901/2901609.png" class="img-icone" > <p> {{$hall->ville->nom }}, {{ $hall->localisation }}</p>
                      </li>
                      <li class="d-flex align-items-center text-sm ">
                        <img src="https://cdn-icons-png.flaticon.com/128/6896/6896407.png" class="img-icone" alt="" sizes="" srcset=""><p> {{ $hall->capacite }} places </p>
                      </li>
                      <li class="d-flex align-items-center">
                        <img src="https://cdn-icons-png.flaticon.com/128/9130/9130025.png" class="img-icone" alt="" sizes="" srcset=""><p>{{ $hall->prix }} FCFA </p>
                      </li> --}}
                      {{-- <li class="d-flex align-items-center">
                        <i class="la la-bathtub"></i><span> {{ $hall->ville?->nom_ville ?? 'Non renseignée' }}, {{ $hall->localisation }}</span>
                      </li> --}}
                    </ul>

                    <div class="row">
                      <div class=" col-md-12 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/8565/8565868.png" class="img-icone me-1">{{ $hall->hotel->nom_hotel }}</div>
                      <div class=" col-md-12 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/2901/2901609.png" class="img-icone me-1" >{{$hall->ville->nom }}, {{ $hall->localisation }}</div>
                      <div class=" col-md-12 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/6896/6896407.png" class="img-icone me-1">{{ $hall->capacite }} places</div>
                      <div class=" col-md-12 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/9130/9130025.png" class="img-icone me-1">{{ number_format($hall->prix , 0, ',', ' ') }} FCFA / la journée</div>
                  </div>
                    
                  </div>
                  <div class="card-btn">
                    <a href="{{route('site.detailSallesfetes', $hall->id)}}" class="theme-btn theme-btn-transparent">Consultez la salle</a>
                  </div>
                </div>
              </div>
              <!-- end card-item -->
            </div>
          @endforeach

          {{-- <!-- end col-lg-6 -->
          <div class="col-lg-6">
            <div class="card-item room-card">
              <div class="card-img-carousel carousel-action carousel--action">
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img31.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img32.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img33.jpg" alt="hotel-img" />
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="card-price pb-2">
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$45.00</span>
                  </p>
                </div>
                <h3 class="card-title font-size-26">
                  <a href="room-details.html">Standard 2 Bed Male Dorm</a>
                </h3>
                <p class="card-text pt-2">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Aperiam asperiores commodi deleniti hic inventore
                  laboriosam laborum molestias, non odit quaerat! Aperiam
                  culpa facilis fuga impedit.
                </p>
                <div class="card-attributes pt-3 pb-4">
                  <ul class="d-flex align-items-center">
                    <li class="d-flex align-items-center">
                      <i class="la la-bed"></i><span>2 Beds</span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-building"></i><span>24 ft<sup>2</sup></span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-bathtub"></i><span>2 Bathrooms</span>
                    </li>
                  </ul>
                </div>
                <div class="card-btn">
                  <a href="room-details.html" class="theme-btn theme-btn-transparent">Book Now</a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6">
            <div class="card-item room-card">
              <div class="card-img-carousel carousel-action carousel--action">
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img33.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img32.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img31.jpg" alt="hotel-img" />
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="card-price pb-2">
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$145.00</span>
                  </p>
                </div>
                <h3 class="card-title font-size-26">
                  <a href="room-details.html">Deluxe King Bed Private</a>
                </h3>
                <p class="card-text pt-2">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Aperiam asperiores commodi deleniti hic inventore
                  laboriosam laborum molestias, non odit quaerat! Aperiam
                  culpa facilis fuga impedit.
                </p>
                <div class="card-attributes pt-3 pb-4">
                  <ul class="d-flex align-items-center">
                    <li class="d-flex align-items-center">
                      <i class="la la-bed"></i><span>2 Beds</span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-building"></i><span>24 ft<sup>2</sup></span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-bathtub"></i><span>2 Bathrooms</span>
                    </li>
                  </ul>
                </div>
                <div class="card-btn">
                  <a href="room-details.html" class="theme-btn theme-btn-transparent">Book Now</a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6">
            <div class="card-item room-card">
              <div class="card-img-carousel carousel-action carousel--action">
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img32.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img33.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img31.jpg" alt="hotel-img" />
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="card-price pb-2">
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$145.00</span>
                  </p>
                </div>
                <h3 class="card-title font-size-26">
                  <a href="room-details.html">Premium Lake View Suite</a>
                </h3>
                <p class="card-text pt-2">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Aperiam asperiores commodi deleniti hic inventore
                  laboriosam laborum molestias, non odit quaerat! Aperiam
                  culpa facilis fuga impedit.
                </p>
                <div class="card-attributes pt-3 pb-4">
                  <ul class="d-flex align-items-center">
                    <li class="d-flex align-items-center">
                      <i class="la la-bed"></i><span>2 Beds</span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-building"></i><span>24 ft<sup>2</sup></span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-bathtub"></i><span>2 Bathrooms</span>
                    </li>
                  </ul>
                </div>
                <div class="card-btn">
                  <a href="room-details.html" class="theme-btn theme-btn-transparent">Book Now</a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6">
            <div class="card-item room-card">
              <div class="card-img-carousel carousel-action carousel--action">
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img31.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img32.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img33.jpg" alt="hotel-img" />
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="card-price pb-2">
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$145.00</span>
                  </p>
                </div>
                <h3 class="card-title font-size-26">
                  <a href="room-details.html">Superior Room</a>
                </h3>
                <p class="card-text pt-2">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Aperiam asperiores commodi deleniti hic inventore
                  laboriosam laborum molestias, non odit quaerat! Aperiam
                  culpa facilis fuga impedit.
                </p>
                <div class="card-attributes pt-3 pb-4">
                  <ul class="d-flex align-items-center">
                    <li class="d-flex align-items-center">
                      <i class="la la-bed"></i><span>2 Beds</span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-building"></i><span>24 ft<sup>2</sup></span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-bathtub"></i><span>2 Bathrooms</span>
                    </li>
                  </ul>
                </div>
                <div class="card-btn">
                  <a href="room-details.html" class="theme-btn theme-btn-transparent">Book Now</a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
          </div>
          <!-- end col-lg-6 -->
          <div class="col-lg-6">
            <div class="card-item room-card">
              <div class="card-img-carousel carousel-action carousel--action">
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img31.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img32.jpg" alt="hotel-img" />
                  </a>
                </div>
                <div class="card-img">
                  <a href="room-details.html" class="d-block">
                    <img src="assets_site/images/img33.jpg" alt="hotel-img" />
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="card-price pb-2">
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$145.00</span>
                  </p>
                </div>
                <h3 class="card-title font-size-26">
                  <a href="room-details.html">Superior Room</a>
                </h3>
                <p class="card-text pt-2">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Aperiam asperiores commodi deleniti hic inventore
                  laboriosam laborum molestias, non odit quaerat! Aperiam
                  culpa facilis fuga impedit.
                </p>
                <div class="card-attributes pt-3 pb-4">
                  <ul class="d-flex align-items-center">
                    <li class="d-flex align-items-center">
                      <i class="la la-bed"></i><span>2 Beds</span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-building"></i><span>24 ft<sup>2</sup></span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="la la-bathtub"></i><span>2 Bathrooms</span>
                    </li>
                  </ul>
                </div>
                <div class="card-btn">
                  <a href="room-details.html" class="theme-btn theme-btn-transparent">Book Now</a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
          </div> --}}
          <!-- end col-lg-6 -->
        </div>
        <!-- end row -->
      </div>

    </div>

    <!-- Pagination links -->
      <div class="mt-6">
        {{ $eventHalls->links() }}
    </div>
    
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end card-area -->
<!-- ================================
  END CARD AREA
================================= -->

  
@endsection

 