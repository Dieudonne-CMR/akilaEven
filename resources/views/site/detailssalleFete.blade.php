@extends('site.layouts.app-site')
@section('content-site')

    <!-- ================================
    START ROOM DETAIL BREAD
================================= -->
<section class="room-detail-bread">
  <div class="full-width-slider carousel-action">
    <?php $fiels= ['photo', 'photo1', 'photo2', 'photo3', 'photo4'] ?>

    @foreach ($fiels as $fiel)
      @if( $eventHall->$fiel)
      <div class="full-width-slide-item">
        <img src="{{ asset('storage/' .  $eventHall->$fiel) }}" alt="" />
      </div>
      @endif
    @endforeach

    {{-- <!-- end full-width-slide-item -->
    <div class="full-width-slide-item">
      <img src="assets_site/images/img31.jpg" alt="" />
    </div>
    <!-- end full-width-slide-item -->
    <div class="full-width-slide-item">
      <img src="assets_site/images/img32.jpg" alt="" />
    </div>
    <!-- end full-width-slide-item -->
    <div class="full-width-slide-item">
      <img src="assets_site/images/img33.jpg" alt="" />
    </div>
    <!-- end full-width-slide-item -->
    <div class="full-width-slide-item">
      <img src="assets_site/images/img34.jpg" alt="" />
    </div> --}}
    <!-- end full-width-slide-item -->
  </div>
  <!-- end full-width-slider -->
</section>
<!-- end room-detail-bread -->
<!-- ================================
END ROOM DETAIL BREAD
================================= -->

<!-- ================================
START TOUR DETAIL AREA
================================= -->
<section class="tour-detail-area padding-bottom-90px">
  <div
    class="single-content-navbar-wrap menu section-bg"
    id="single-content-navbar"
  >
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="single-content-nav" id="single-content-nav">
            <ul>
              {{-- <li>
                <a
                  data-scroll="description"
                  href="#description"
                  class="scroll-link active"
                  >Description</a
                >
              </li>
              <li>
                <a
                  data-scroll="services"
                  href="#services"
                  class="scroll-link"
                  >Services</a
                >
              </li>
              <li>
                <a
                  data-scroll="amenities"
                  href="#amenities"
                  class="scroll-link"
                  >Amenities</a
                >
              </li>
              <li>
                <a
                  data-scroll="location-map"
                  href="#location-map"
                  class="scroll-link"
                  >Map</a
                >
              </li>
              <li>
                <a data-scroll="reviews" href="#reviews" class="scroll-link"
                  >Reviews</a
                >
              </li> --}}
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end single-content-navbar-wrap -->
  <div class="single-content-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="single-content-wrap padding-top-60px">
            <div id="description" class="page-scroll">
              <div class="pb-4 single-content-item">
                <h3 class="title font-size-26">{{$eventHall->nom_salle}}</h3>
                <p class="pt-2">
                  <span
                    class="text-white badge text-bg-warning font-size-16"
                    >4.6</span
                  >
                  <span>(4,209 Reviews)</span>
                </p>
              </div>

              <h3 class="pb-3 title font-size-15 font-weight-medium">
                House Rules
              </h3>
              <div class="container">
                <div class="row">
                    <div class=" col-md-4 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/8565/8565868.png" class="img-icone me-2">{{ $eventHall->hotel->nom_hotel }}</div>
                    <div class=" col-md-4 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/2901/2901609.png" class="img-icone me-2" >{{$eventHall->ville->nom }}, {{ $eventHall->localisation }}</div>
                    <div class=" col-md-4 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/6896/6896407.png" class="img-icone me-2">{{ $eventHall->capacite }} places</div>
                    <div class=" col-md-4 d-flex align-items-center"><img src="https://cdn-icons-png.flaticon.com/128/9130/9130025.png" class="img-icone me-2" >{{ $eventHall->prix }} FCFA </div>
                </div>
            </div>
              
              <!-- end single-content-item -->
              <div class="section-block"></div>
              <div class="single-content-item padding-top-30px padding-bottom-40px" >
                <h3 class="title font-size-20">Description</h3>
                
                <p class="pb-4">
                  {{$eventHall->description_salle}}
                </p>
              </div>
              <!-- end single-content-item -->
              <div class="section-block"></div>
            </div>
            {{-- <!-- end description -->
            <div id="services" class="page-scroll">
              <div
                class="single-content-item padding-top-40px padding-bottom-40px"
              >
                <h3 class="title font-size-20">Services</h3>
                <div class="pt-4 row">
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Bicycle Hire
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Conference Rooms
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Fruit Basket
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Massage
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Sightseeing
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Car Hire
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Fitness Center
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Laundry
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Own Parking Space
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-check-circle"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Wake-Up Call
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                </div>
                <!-- end row -->
              </div>
              <!-- end single-content-item -->
              <div class="section-block"></div>
            </div>
            <!-- end itinerary -->
            <div id="amenities" class="page-scroll">
              <div
                class="single-content-item padding-top-40px padding-bottom-40px"
              >
                <h3 class="title font-size-20">Amenities</h3>
                <div class="pt-4 row">
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-couch"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          2 Seater Sofa
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-television"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          40-Inch Samsung LED TV
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-gear"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Butler Service
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-wifi"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Free Wi – Fi
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-swimming-pool"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Private Pool
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-user"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          24h Room Service
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-air-freshener"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Air Conditioning
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-phone"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Direct Dial Phone
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-bullhorn"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Hair Dryer
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-bathtub"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Bathtub
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-hand-holding-usd"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Safe Deposit Box
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                  <div class="col-lg-4 responsive-column">
                    <div
                      class="mb-3 single-tour-feature d-flex align-items-center"
                    >
                      <div
                        class="flex-shrink-0 single-feature-icon icon-element ms-0 me-3"
                      >
                        <i class="la la-luggage-cart"></i>
                      </div>
                      <div class="single-feature-titles">
                        <h3 class="title font-size-15 font-weight-medium">
                          Luggage storage
                        </h3>
                      </div>
                    </div>
                    <!-- end single-tour-feature -->
                  </div>
                  <!-- end col-lg-4 -->
                </div>
                <!-- end row -->
              </div>
              <!-- end single-content-item -->
              <div class="section-block"></div>
            </div>
            <!-- end itinerary -->
            <div id="location-map" class="page-scroll">
              <div
                class="single-content-item padding-top-40px padding-bottom-40px"
              >
                <h3 class="title font-size-20">Location</h3>
                <div class="map-container padding-top-30px">
                  <div id="map"></div>
                </div>
                <!-- end map-container -->
              </div>
              <!-- end single-content-item -->
              <div class="section-block"></div>
            </div>
            <!-- end location-map -->
            <div id="reviews" class="page-scroll">
              <div
                class="single-content-item padding-top-40px padding-bottom-40px"
              >
                <h3 class="title font-size-20">Reviews</h3>
                <div class="review-container padding-top-30px">
                  <div class="row align-items-center">
                    <div class="col-lg-4">
                      <div class="review-summary">
                        <h2>4.5<span>/5</span></h2>
                        <p>Excellent</p>
                        <span>Based on 4 reviews</span>
                      </div>
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-8">
                      <div class="review-bars">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="progress-item">
                              <h3 class="progressbar-title">Service</h3>
                              <div
                                class="progressbar-content line-height-20 d-flex align-items-center justify-content-between"
                              >
                                <div class="flex-shrink-0 progressbar-box">
                                  <div
                                    class="progressbar-line"
                                    data-percent="70%"
                                  >
                                    <div
                                      class="progressbar-line-item bar-bg-1"
                                    ></div>
                                  </div>
                                  <!-- End Skill Bar -->
                                </div>
                                <div class="bar-percent">4.6</div>
                              </div>
                            </div>
                            <!-- end progress-item -->
                          </div>
                          <!-- end col-lg-6 -->
                          <div class="col-lg-6">
                            <div class="progress-item">
                              <h3 class="progressbar-title">Location</h3>
                              <div
                                class="progressbar-content line-height-20 d-flex align-items-center justify-content-between"
                              >
                                <div class="flex-shrink-0 progressbar-box">
                                  <div
                                    class="progressbar-line"
                                    data-percent="55%"
                                  >
                                    <div
                                      class="progressbar-line-item bar-bg-2"
                                    ></div>
                                  </div>
                                  <!-- End Skill Bar -->
                                </div>
                                <div class="bar-percent">4.7</div>
                              </div>
                            </div>
                            <!-- end progress-item -->
                          </div>
                          <!-- end col-lg-6 -->
                          <div class="col-lg-6">
                            <div class="progress-item">
                              <h3 class="progressbar-title">
                                Value for Money
                              </h3>
                              <div
                                class="progressbar-content line-height-20 d-flex align-items-center justify-content-between"
                              >
                                <div class="flex-shrink-0 progressbar-box">
                                  <div
                                    class="progressbar-line"
                                    data-percent="40%"
                                  >
                                    <div
                                      class="progressbar-line-item bar-bg-3"
                                    ></div>
                                  </div>
                                  <!-- End Skill Bar -->
                                </div>
                                <div class="bar-percent">2.6</div>
                              </div>
                            </div>
                            <!-- end progress-item -->
                          </div>
                          <!-- end col-lg-6 -->
                          <div class="col-lg-6">
                            <div class="progress-item">
                              <h3 class="progressbar-title">Cleanliness</h3>
                              <div
                                class="progressbar-content line-height-20 d-flex align-items-center justify-content-between"
                              >
                                <div class="flex-shrink-0 progressbar-box">
                                  <div
                                    class="progressbar-line"
                                    data-percent="60%"
                                  >
                                    <div
                                      class="progressbar-line-item bar-bg-4"
                                    ></div>
                                  </div>
                                  <!-- End Skill Bar -->
                                </div>
                                <div class="bar-percent">3.6</div>
                              </div>
                            </div>
                            <!-- end progress-item -->
                          </div>
                          <!-- end col-lg-6 -->
                          <div class="col-lg-6">
                            <div class="progress-item">
                              <h3 class="progressbar-title">Facilities</h3>
                              <div
                                class="progressbar-content line-height-20 d-flex align-items-center justify-content-between"
                              >
                                <div class="flex-shrink-0 progressbar-box">
                                  <div
                                    class="progressbar-line"
                                    data-percent="50%"
                                  >
                                    <div
                                      class="progressbar-line-item bar-bg-5"
                                    ></div>
                                  </div>
                                  <!-- End Skill Bar -->
                                </div>
                                <div class="bar-percent">2.6</div>
                              </div>
                            </div>
                            <!-- end progress-item -->
                          </div>
                          <!-- end col-lg-6 -->
                        </div>
                        <!-- end row -->
                      </div>
                    </div>
                    <!-- end col-lg-8 -->
                  </div>
                </div>
              </div>
              <!-- end single-content-item -->
              <div class="section-block"></div>
            </div>
            <!-- end reviews -->
            <div class="review-box">
              <div class="single-content-item padding-top-40px">
                <h3 class="title font-size-20">Showing 3 guest reviews</h3>
                <div class="comments-list padding-top-50px">
                  <div class="comment">
                    <div class="comment-avatar">
                      <img
                        class="avatar__img"
                        alt=""
                        src="assets_site/images/team8.jpg"
                      />
                    </div>
                    <div class="comment-body">
                      <div class="meta-data">
                        <h3 class="comment__author">Jenny Doe</h3>
                        <div class="meta-data-inner d-flex">
                          <span
                            class="ratings d-flex align-items-center me-1"
                          >
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                          </span>
                          <p class="comment__date">April 5, 2019</p>
                        </div>
                      </div>
                      <p class="comment-content">
                        Lorem ipsum dolor sit amet, dolores mandamus
                        moderatius ea ius, sed civibus vivendum imperdiet
                        ei, amet tritani sea id. Ut veri diceret fierent
                        mei, qui facilisi suavitate euripidis
                      </p>
                      <div
                        class="comment-reply d-flex align-items-center justify-content-between"
                      >
                        <a
                          class="theme-btn"
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#replayPopupForm"
                        >
                          <span class="la la-mail-reply me-1"></span>Reply
                        </a>
                        <div class="reviews-reaction">
                          <a href="#" class="comment-like"
                            ><i class="la la-thumbs-up"></i> 13</a
                          >
                          <a href="#" class="comment-dislike"
                            ><i class="la la-thumbs-down"></i> 2</a
                          >
                          <a href="#" class="comment-love"
                            ><i class="la la-heart-o"></i> 5</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end comments -->
                  <div class="comment comment-reply-item">
                    <div class="comment-avatar">
                      <img
                        class="avatar__img"
                        alt=""
                        src="assets_site/images/team9.jpg"
                      />
                    </div>
                    <div class="comment-body">
                      <div class="meta-data">
                        <h3 class="comment__author">Jenny Doe</h3>
                        <div class="meta-data-inner d-flex">
                          <span
                            class="ratings d-flex align-items-center me-1"
                          >
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                          </span>
                          <p class="comment__date">April 5, 2019</p>
                        </div>
                      </div>
                      <p class="comment-content">
                        Lorem ipsum dolor sit amet, dolores mandamus
                        moderatius ea ius, sed civibus vivendum imperdiet
                        ei, amet tritani sea id. Ut veri diceret fierent
                        mei, qui facilisi suavitate euripidis
                      </p>
                      <div
                        class="comment-reply d-flex align-items-center justify-content-between"
                      >
                        <a
                          class="theme-btn"
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#replayPopupForm"
                        >
                          <span class="la la-mail-reply me-1"></span>Reply
                        </a>
                        <div class="reviews-reaction">
                          <a href="#" class="comment-like"
                            ><i class="la la-thumbs-up"></i> 13</a
                          >
                          <a href="#" class="comment-dislike"
                            ><i class="la la-thumbs-down"></i> 2</a
                          >
                          <a href="#" class="comment-love"
                            ><i class="la la-heart-o"></i> 5</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end comments -->
                  <div class="comment">
                    <div class="comment-avatar">
                      <img
                        class="avatar__img"
                        alt=""
                        src="assets_site/images/team10.jpg"
                      />
                    </div>
                    <div class="comment-body">
                      <div class="meta-data">
                        <h3 class="comment__author">Jenny Doe</h3>
                        <div class="meta-data-inner d-flex">
                          <span
                            class="ratings d-flex align-items-center me-1"
                          >
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                          </span>
                          <p class="comment__date">April 5, 2019</p>
                        </div>
                      </div>
                      <p class="comment-content">
                        Lorem ipsum dolor sit amet, dolores mandamus
                        moderatius ea ius, sed civibus vivendum imperdiet
                        ei, amet tritani sea id. Ut veri diceret fierent
                        mei, qui facilisi suavitate euripidis
                      </p>
                      <div
                        class="comment-reply d-flex align-items-center justify-content-between"
                      >
                        <a
                          class="theme-btn"
                          href="#"
                          data-bs-toggle="modal"
                          data-bs-target="#replayPopupForm"
                        >
                          <span class="la la-mail-reply me-1"></span>Reply
                        </a>
                        <div class="reviews-reaction">
                          <a href="#" class="comment-like"
                            ><i class="la la-thumbs-up"></i> 13</a
                          >
                          <a href="#" class="comment-dislike"
                            ><i class="la la-thumbs-down"></i> 2</a
                          >
                          <a href="#" class="comment-love"
                            ><i class="la la-heart-o"></i> 5</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end comments -->
                  <div class="text-center btn-box load-more">
                    <button
                      class="theme-btn theme-btn-small theme-btn-transparent"
                      type="button"
                    >
                      Load More Review
                    </button>
                  </div>
                </div>
                <!-- end comments-list -->
                <div class="comment-forum padding-top-40px">
                  <div class="form-box">
                    <div class="form-title-wrap">
                      <h3 class="title">Write a Review</h3>
                    </div>
                    <!-- form-title-wrap -->
                    <div class="form-content">
                      <div class="p-2 rate-option">
                        <div class="row">
                          <div class="col-lg-4 responsive-column">
                            <div class="rate-option-item">
                              <label>Service</label>
                              <div class="rate-stars-option">
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="lst1"
                                  value="1"
                                />
                                <label for="lst1"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="lst2"
                                  value="2"
                                />
                                <label for="lst2"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="lst3"
                                  value="3"
                                />
                                <label for="lst3"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="lst4"
                                  value="4"
                                />
                                <label for="lst4"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="lst5"
                                  value="5"
                                />
                                <label for="lst5"></label>
                              </div>
                            </div>
                          </div>
                          <!-- col-lg-4 -->
                          <div class="col-lg-4 responsive-column">
                            <div class="rate-option-item">
                              <label>Location</label>
                              <div class="rate-stars-option">
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="l1"
                                  value="1"
                                />
                                <label for="l1"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="l2"
                                  value="2"
                                />
                                <label for="l2"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="l3"
                                  value="3"
                                />
                                <label for="l3"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="l4"
                                  value="4"
                                />
                                <label for="l4"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="l5"
                                  value="5"
                                />
                                <label for="l5"></label>
                              </div>
                            </div>
                          </div>
                          <!-- col-lg-4 -->
                          <div class="col-lg-4 responsive-column">
                            <div class="rate-option-item">
                              <label>Value for Money</label>
                              <div class="rate-stars-option">
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="vm1"
                                  value="1"
                                />
                                <label for="vm1"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="vm2"
                                  value="2"
                                />
                                <label for="vm2"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="vm3"
                                  value="3"
                                />
                                <label for="vm3"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="vm4"
                                  value="4"
                                />
                                <label for="vm4"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="vm5"
                                  value="5"
                                />
                                <label for="vm5"></label>
                              </div>
                            </div>
                          </div>
                          <!-- col-lg-4 -->
                          <div class="col-lg-4 responsive-column">
                            <div class="rate-option-item">
                              <label>Cleanliness</label>
                              <div class="rate-stars-option">
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="cln1"
                                  value="1"
                                />
                                <label for="cln1"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="cln2"
                                  value="2"
                                />
                                <label for="cln2"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="cln3"
                                  value="3"
                                />
                                <label for="cln3"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="cln4"
                                  value="4"
                                />
                                <label for="cln4"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="cln5"
                                  value="5"
                                />
                                <label for="cln5"></label>
                              </div>
                            </div>
                          </div>
                          <!-- col-lg-4 -->
                          <div class="col-lg-4 responsive-column">
                            <div class="rate-option-item">
                              <label>Facilities</label>
                              <div class="rate-stars-option">
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="f1"
                                  value="1"
                                />
                                <label for="f1"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="f2"
                                  value="2"
                                />
                                <label for="f2"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="f3"
                                  value="3"
                                />
                                <label for="f3"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="f4"
                                  value="4"
                                />
                                <label for="f4"></label>
                                <input
                                  type="checkbox"
                                  class="form-check-input"
                                  id="f5"
                                  value="5"
                                />
                                <label for="f5"></label>
                              </div>
                            </div>
                          </div>
                          <!-- col-lg-4 -->
                        </div>
                        <!-- end row -->
                      </div>
                      <!-- end rate-option -->
                      <div class="contact-form-action">
                        <form method="post">
                          <div class="row">
                            <div class="col-lg-6 responsive-column">
                              <div class="input-box">
                                <label class="label-text">Name</label>
                                <div class="form-group">
                                  <span class="la la-user form-icon"></span>
                                  <input
                                    class="form-control"
                                    type="text"
                                    name="text"
                                    placeholder="Your name"
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6 responsive-column">
                              <div class="input-box">
                                <label class="label-text">Email</label>
                                <div class="form-group">
                                  <span
                                    class="la la-envelope-o form-icon"
                                  ></span>
                                  <input
                                    class="form-control"
                                    type="email"
                                    name="email"
                                    placeholder="Email address"
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="input-box">
                                <label class="label-text">Message</label>
                                <div class="form-group">
                                  <span
                                    class="la la-pencil form-icon"
                                  ></span>
                                  <textarea
                                    class="message-control form-control"
                                    name="message"
                                    placeholder="Write message"
                                  ></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="btn-box">
                                <button type="button" class="theme-btn">
                                  Leave a Review
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- end contact-form-action -->
                    </div>
                    <!-- end form-content -->
                  </div>
                  <!-- end form-box -->
                </div>
                <!-- end comment-forum -->
              </div>
              <!-- end single-content-item -->
            </div> --}}
            <!-- end review-box -->
          </div>
          <!-- end single-content-wrap -->
        </div>
        <!-- end col-lg-8 -->
        <div class="col-lg-4">
          <div class="mb-0 sidebar single-content-sidebar">
            <div class="sidebar-widget single-content-widget">
              <h3 class="title stroke-shape">Your Reservation</h3>
              <div class="sidebar-widget-item">
                <div class="contact-form-action">
                  <form action="#">
                    <div class="input-box">
                      <label class="label-text">Check-in</label>
                      <div class="form-group">
                        <span class="la la-calendar form-icon"></span>
                        <input
                          class="date-range form-control"
                          type="text"
                          name="daterange-single"
                        />
                      </div>
                    </div>
                    <div class="input-box">
                      <label class="label-text">Check-out</label>
                      <div class="form-group">
                        <span class="la la-calendar form-icon"></span>
                        <input
                          class="date-range form-control"
                          type="text"
                          name="daterange-single"
                        />
                      </div>
                    </div>
                    {{-- <div class="input-box">
                      <label class="label-text">Rooms</label>
                      <div class="form-group select2-container-wrapper">
                        <div class="w-auto select-contain">
                          <select class="select-contain-select">
                            <option value="0">Select Room</option>
                            <option value="1" selected>1 Room</option>
                            <option value="2">2 Rooms</option>
                            <option value="3">3 Rooms</option>
                            <option value="4">4 Rooms</option>
                            <option value="5">5 Rooms</option>
                            <option value="6">6 Rooms</option>
                            <option value="7">7 Rooms</option>
                            <option value="8">8 Rooms</option>
                            <option value="9">9 Rooms</option>
                            <option value="10">10 Rooms</option>
                          </select>
                        </div>
                      </div>
                    </div> --}}
                    <div class="btn-box">
                      <button type="submit" class="mb-2 text-center theme-btn w-100">Book Now</button>
                      
                    </div>
                  </form>
                </div>
              </div>
              <!-- end sidebar-widget-item -->
              <div class="sidebar-widget-item">
                
                <!-- end qty-box -->
                
                <!-- end qty-box -->
                
                <!-- end qty-box -->
              </div>
              <!-- end sidebar-widget-item -->
              {{-- <div class="py-4 sidebar-widget-item">
                <h3 class="title stroke-shape">Extra Services</h3>
                <div class="extra-service-wrap">
                  <form
                    action="#"
                    method="post"
                    class="extraServiceForm"
                    id="extraServiceForm"
                  >
                    <div id="checkboxContainPrice">
                      <div class="custom-checkbox">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          name="cleaning"
                          id="cleaningChb"
                          value="15.00"
                        />
                        <label
                          for="cleaningChb"
                          class="d-flex justify-content-between align-items-center"
                          >Cleaning Fee
                          <span class="text-black font-weight-regular"
                            >$15</span
                          ></label
                        >
                      </div>
                      <div class="custom-checkbox">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          name="airport-pickup"
                          id="airportPickupChb"
                          value="20.00"
                        />
                        <label
                          for="airportPickupChb"
                          class="d-flex justify-content-between align-items-center"
                          >Airport pickup
                          <span class="text-black font-weight-regular"
                            >$20</span
                          ></label
                        >
                      </div>
                      <div class="custom-checkbox">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          name="breakfast"
                          id="breakfastChb"
                          value="10.00"
                        />
                        <label
                          for="breakfastChb"
                          class="d-flex justify-content-between align-items-center"
                          >Breakfast
                          <span class="text-black font-weight-regular"
                            >$10/ per person</span
                          ></label
                        >
                      </div>
                      <div class="custom-checkbox">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          name="parking"
                          id="parkingChb"
                          value="5.00"
                        />
                        <label
                          for="parkingChb"
                          class="d-flex justify-content-between align-items-center"
                          >Parking
                          <span class="text-black font-weight-regular"
                            >$5/ per night</span
                          ></label
                        >
                      </div>
                    </div>
                    <div class="pt-3 total-price">
                      <p class="text-black">Your Price</p>
                      <p class="d-flex align-items-center">
                        <span class="text-black font-size-17">$</span>
                        <input
                          type="text"
                          name="total"
                          class="num"
                          value="80.00"
                          readonly="readonly"
                        /><span>/ per room</span>
                      </p>
                    </div>
                  </form>
                </div>
              </div> --}}
              <!-- end sidebar-widget-item -->
              {{-- <div class="btn-box">
                <a href="cart.html" class="mb-2 text-center theme-btn w-100"
                  >Book Now</a
                >
              </div> --}}
            </div>
            <!-- end sidebar-widget -->
            {{-- <div class="sidebar-widget single-content-widget">
              <h3 class="title stroke-shape">Why Book With Us?</h3>
              <div class="sidebar-list">
                <ul class="list-items">
                  <li>
                    <i class="la la-dollar icon-element me-2"></i>No-hassle
                    best price guarantee
                  </li>
                  <li>
                    <i class="la la-microphone icon-element me-2"></i
                    >Customer care available 24/7
                  </li>
                  <li>
                    <i class="la la-thumbs-up icon-element me-2"></i
                    >Hand-picked Tours & Activities
                  </li>
                  <li>
                    <i class="la la-file-text icon-element me-2"></i>Free
                    Travel Insureance
                  </li>
                </ul>
              </div>
              <!-- end sidebar-list -->
            </div>
            <!-- end sidebar-widget -->
            <div class="sidebar-widget single-content-widget">
              <h3 class="title stroke-shape">Get a Question?</h3>
              <p class="font-size-14 line-height-24">
                Do not hesitate to give us a call. We are an expert team and
                we are happy to talk to you.
              </p>
              <div class="pt-3 sidebar-list">
                <ul class="list-items">
                  <li>
                    <i class="la la-phone icon-element me-2"></i
                    ><a href="#">+ 61 23 8093 3400</a>
                  </li>
                  <li>
                    <i class="la la-envelope icon-element me-2"></i
                    ><a href="mailto:info@trizen.com">info@trizen.com</a>
                  </li>
                </ul>
              </div>
              <!-- end sidebar-list -->
            </div> --}}
            <!-- end sidebar-widget -->
          </div>
          <!-- end sidebar -->
        </div>
        <!-- end col-lg-4 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
  <!-- end single-content-box -->
</section>
<!-- end tour-detail-area -->
<!-- ================================
END TOUR DETAIL AREA
================================= -->

<div class="section-block"></div>

<!-- ================================
START RELATE TOUR AREA
================================= -->
<section class="related-tour-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center section-heading">
          <h2 class="sec__title">Autres salles de fetes</h2>
          <p class="sec__desc">Peut également vous intéresser</p>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="row padding-top-50px">
      @foreach ($event_Halls as $event_Hall)
        
      <div class="col-lg-6">
        <div class="card-item room-card">
          <div class="card-img-carousel carousel-action carousel--action">
            <div class="card-img">
              <a href="room-details.html" class="d-block">
                <img src="assets_site/images/img5.jpg" alt="hotel-img" />
              </a>
            </div>
            <div class="card-img">
              <a href="room-details.html" class="d-block">
                <img src="assets_site/images/img29.jpg" alt="hotel-img" />
              </a>
            </div>
            <div class="card-img">
              <a href="room-details.html" class="d-block">
                <img src="assets_site/images/img30.jpg" alt="hotel-img" />
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="pb-2 card-price">
              <p>
                <span class="price__from">From</span>
                <span class="price__num">$88.00</span>
              </p>
            </div>
            <h3 class="card-title font-size-26">
              <a href="room-details.html">Premium Lake View Room</a>
            </h3>
            <p class="pt-2 card-text">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Aperiam asperiores commodi deleniti hic inventore laboriosam
              laborum molestias, non odit quaerat! Aperiam culpa facilis
              fuga impedit.
            </p>
            <div class="pt-3 pb-4 card-attributes">
              <ul class="d-flex align-items-center">
                <li class="d-flex align-items-center">
                  <i class="la la-bed"></i><span>2 Beds</span>
                </li>
                <li class="d-flex align-items-center">
                  <i class="la la-building"></i
                  ><span>24 ft<sup>2</sup></span>
                </li>
                <li class="d-flex align-items-center">
                  <i class="la la-bathtub"></i><span>2 Bathrooms</span>
                </li>
              </ul>
            </div>
            <div class="card-btn d-flex align-items-center">
              <div class="btn-box">
                <a
                  href="room-details.html"
                  class="theme-btn theme-btn-transparent"
                  >Book Now</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div>
      @endforeach
      <!-- end col-lg-6 -->
      {{-- <div class="col-lg-6">
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
            <div class="pb-2 card-price">
              <p>
                <span class="price__from">From</span>
                <span class="price__num">$45.00</span>
              </p>
            </div>
            <h3 class="card-title font-size-26">
              <a href="room-details.html">Standard 2 Bed Male Dorm</a>
            </h3>
            <p class="pt-2 card-text">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Aperiam asperiores commodi deleniti hic inventore laboriosam
              laborum molestias, non odit quaerat! Aperiam culpa facilis
              fuga impedit.
            </p>
            <div class="pt-3 pb-4 card-attributes">
              <ul class="d-flex align-items-center">
                <li class="d-flex align-items-center">
                  <i class="la la-bed"></i><span>2 Beds</span>
                </li>
                <li class="d-flex align-items-center">
                  <i class="la la-building"></i
                  ><span>24 ft<sup>2</sup></span>
                </li>
                <li class="d-flex align-items-center">
                  <i class="la la-bathtub"></i><span>2 Bathrooms</span>
                </li>
              </ul>
            </div>
            <div class="card-btn d-flex align-items-center">
              <div class="btn-box">
                <a
                  href="room-details.html"
                  class="theme-btn theme-btn-transparent"
                  >Book Now</a
                >
              </div>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div> --}}
    
      <!-- end col-lg-6 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end related-tour-area -->
<!-- ================================
END RELATE TOUR AREA
================================= -->

<!-- ================================
START CTA AREA
================================= -->
<section
  class="cta-area subscriber-area section-bg-2 padding-top-60px padding-bottom-60px"
>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <div class="section-heading">
          <p class="pb-1 sec__desc text-white-50">Newsletter sign up</p>
          <h2 class="text-white sec__title font-size-30">
            Subscribe to Get Special Offers
          </h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-7 -->
      <div class="col-lg-5">
        <div class="subscriber-box">
          <div class="contact-form-action">
            <form action="#">
              <div class="input-box">
                <label class="text-white label-text"
                  >Enter email address</label
                >
                <div class="mb-0 form-group">
                  <span class="la la-envelope form-icon"></span>
                  <input
                    class="form-control"
                    type="email"
                    name="email"
                    placeholder="Email address"
                  />
                  <button
                    class="theme-btn theme-btn-small submit-btn"
                    type="submit"
                  >
                    Subscribe
                  </button>
                  <span class="pt-1 font-size-14 text-white-50"
                    ><i class="la la-lock me-1"></i>Don't worry your
                    information is safe with us.</span
                  >
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-5 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end cta-area -->
<!-- ================================
END CTA AREA
================================= -->
@endsection

 