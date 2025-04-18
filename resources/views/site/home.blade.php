@extends('site.layouts.app-site')
@section('content-site')
<!-- ================================
START HERO-WRAPPER AREA
================================= -->
<section class="hero-wrapper hero-wrapper2">
  <div class="pb-0 hero-box">
    <div id="fullscreen-slide-contain">
      <ul class="slides-container">
        <li><img src="assets_site/images/hero-bg2.jpg" alt="" /></li>
        <li><img src="assets_site/images/hero--bg2.jpg" alt="" /></li>
        <li><img src="assets_site/images/hero--bg3.jpg" alt="" /></li>
      </ul>
    </div>
    <!-- End background slider -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="pb-5 hero-content">
            <div class="section-heading">
              <p class="pb-2 sec__desc">Partout au cameroun</p>
              <h2 class="sec__title">
              Trouvez l'espace idéal pour tous vos événements            
              </h2>
              <p style="color: white;font-size: 20px;">
            Salles de fêtes, chambres d'hôtel et espaces de réception <br /> pour vos mariages, séminaires et célébrations.
          </p>
            </div>
          </div>
          <!-- end hero-content -->
          <div class="search-fields-container">
            <!-- Tabs Navigation -->
            <ul class="mb-3 nav nav-tabs" id="searchTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="rooms-tab" data-bs-toggle="tab" data-bs-target="#rooms-search" type="button" role="tab" aria-controls="rooms-search" aria-selected="true">
                  <i class="mr-1 la la-bed"></i> Chambres
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events-search" type="button" role="tab" aria-controls="events-search" aria-selected="false">
                  <i class="mr-1 la la-calendar-check-o"></i> Salles de Fêtes
                </button>
              </li>
            </ul>
            
            <!-- Tabs Content -->
            <div class="tab-content" id="searchTabsContent">
              <!-- Chambres Tab -->
              <div class="tab-pane fade show active" id="rooms-search" role="tabpanel" aria-labelledby="rooms-tab">
                <div class="contact-form-action">
                  <form action="#" class="row">
                    <div class="col-lg-3 pe-0">
                      <div class="input-box">
                        <label class="label-text">Destination / Nom de l'hôtel</label>
                        <div class="form-group">
                          <span class="la la-map-marker form-icon"></span>
                          <input
                            class="form-control"
                            type="text"
                            placeholder="Entrez une ville ou un hôtel"
                          />
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3 pe-0">
                      <div class="input-box">
                        <label class="label-text">Check in - Check out</label>
                        <div class="form-group">
                          <span class="la la-calendar form-icon"></span>
                          <input
                            class="date-range form-control"
                            type="text"
                            name="daterange"
                          />
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3 pe-0">
                      <div class="input-box">
                        <label class="label-text">Type de Chambre</label>
                        <div class="form-group select2-container-wrapper">
                          <div
                            class="w-auto select-contain select-contain-shadow"
                          >
                            <select class="select-contain-select">
                              <option value="0">Sélectionner</option>
                              <option value="1">Simple</option>
                              <option value="2">Double</option>
                              <option value="3">Triple</option>
                              <option value="4">Quad</option>
                              <option value="5">Queen</option>
                              <option value="6">King</option>
                              <option value="7">Twin</option>
                              <option value="8">Double-double</option>
                              <option value="9">Studio</option>
                              <option value="10">Suite</option>
                              <option value="11">Mini Suite</option>
                              <option value="12">Suite Présidentielle</option>
                              <option value="14">Appartements</option>
                              <option value="15">Chambres communicantes</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3">
                      <div class="input-box">
                        <label class="label-text">Invités et Chambres</label>
                        <div class="form-group">
                          <div class="dropdown dropdown-contain gty-container">
                            <a
                              class="dropdown-toggle dropdown-btn"
                              href="#"
                              role="button"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                              data-bs-auto-close="outside"
                            >
                              <span
                                class="adult"
                                data-text="Adulte"
                                data-text-multi="Adultes"
                                >0 Adulte</span
                              >
                              -
                              <span
                                class="children"
                                data-text="Enfant"
                                data-text-multi="Enfants"
                                >0 Enfant</span
                              >
                            </a>
                            <div class="dropdown-menu dropdown-menu-wrap">
                              <div class="dropdown-item">
                                <div
                                  class="qty-box d-flex align-items-center justify-content-between"
                                >
                                  <label>Chambres</label>
                                  <div class="qtyBtn d-flex align-items-center">
                                    <div class="qtyDec">
                                      <i class="la la-minus"></i>
                                    </div>
                                    <input
                                      type="text"
                                      name="room_number"
                                      value="0"
                                      class="qty-input"
                                    />
                                    <div class="qtyInc">
                                      <i class="la la-plus"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="dropdown-item">
                                <div
                                  class="qty-box d-flex align-items-center justify-content-between"
                                >
                                  <label>Adultes</label>
                                  <div class="qtyBtn d-flex align-items-center">
                                    <div class="qtyDec">
                                      <i class="la la-minus"></i>
                                    </div>
                                    <input
                                      type="text"
                                      name="adult_number"
                                      value="0"
                                    />
                                    <div class="qtyInc">
                                      <i class="la la-plus"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="dropdown-item">
                                <div
                                  class="qty-box d-flex align-items-center justify-content-between"
                                >
                                  <label>Enfants</label>
                                  <div class="qtyBtn d-flex align-items-center">
                                    <div class="qtyDec">
                                      <i class="la la-minus"></i>
                                    </div>
                                    <input
                                      type="text"
                                      name="child_number"
                                      value="0"
                                    />
                                    <div class="qtyInc">
                                      <i class="la la-plus"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- .end dropdown-contain -->
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                  </form>
                  <div class="pt-2 btn-box">
                    <a href="room-search-result.html" class="theme-btn">
                      <i class="mr-1 la la-search"></i> Rechercher
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- Salles de Fêtes Tab -->
              <div class="tab-pane fade" id="events-search" role="tabpanel" aria-labelledby="events-tab">
                <div class="contact-form-action">
                  <form action="#" class="row">
                    <div class="col-lg-3 pe-0">
                      <div class="input-box">
                        <label class="label-text">Ville / Localisation</label>
                        <div class="form-group">
                          <span class="la la-map-marker form-icon"></span>
                          <input
                            class="form-control"
                            type="text"
                            placeholder="Entrez une ville"
                          />
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3 pe-0">
                      <div class="input-box">
                        <label class="label-text">Date de l'événement</label>
                        <div class="form-group">
                          <span class="la la-calendar form-icon"></span>
                          <input
                            class="date-range form-control"
                            type="text"
                            name="     <input
                            class="date-range form-control"
                            type="text"
                            name="daterange"
                          />"
                          />
                        
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3 pe-0">
                      <div class="input-box">
                        <label class="label-text">Type d'événement</label>
                        <div class="form-group select2-container-wrapper">
                          <div
                            class="w-auto select-contain select-contain-shadow"
                          >
                            <select class="select-contain-select">
                              <option value="0">Sélectionner</option>
                              <option value="1">Mariage</option>
                              <option value="2">Anniversaire</option>
                              <option value="3">Conférence</option>
                              <option value="4">Séminaire</option>
                              <option value="5">Réunion d'affaires</option>
                              <option value="6">Fête</option>
                              <option value="7">Gala</option>
                              <option value="8">Autre</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3">
                      <div class="input-box">
                        <label class="label-text">Nombre d'invités</label>
                        <div class="form-group">
                          <span class="la la-users form-icon"></span>
                          <input
                            class="form-control"
                            type="number"
                            placeholder="Nombre de personnes"
                            min="1"
                          />
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                  </form>
                  <div class="pt-2 btn-box">
                    <a href="event-halls-search-result.html" class="theme-btn">
                      <i class="mr-1 la la-search"></i> Rechercher
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
</section>
<!-- end hero-wrapper -->
<!-- ================================
END HERO-WRAPPER AREA
================================= -->

<!-- ================================
START INFO AREA
================================= -->
<section
  class="info-area info-bg info-area2 padding-top-80px padding-bottom-45px"
>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb text-color-2">
            <i class="las la-radiation"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Unique Atmosphere</h4>
            <p class="info__desc">Varius quam quisque id diam vel quam</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb-2 text-color-3">
            <i class="la la-tree"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Environment</h4>
            <p class="info__desc">Varius quam quisque id diam vel quam</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb-3 text-color-4">
            <i class="las la-map-marked-alt"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Great Location</h4>
            <p class="info__desc">Varius quam quisque id diam vel quam</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
      <div class="col-lg-3 responsive-column">
        <div class="icon-box icon-layout-2 d-flex">
          <div class="flex-shrink-0 info-icon bg-rgb-4 text-color-5">
            <i class="las la-bed"></i>
          </div>
          <!-- end info-icon-->
          <div class="info-content">
            <h4 class="info__title">Homey Comfort</h4>
            <p class="info__desc">Varius quam quisque id diam vel quam</p>
          </div>
          <!-- end info-content -->
        </div>
        <!-- end icon-box -->
      </div>
      <!-- end col-lg-3 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end info-area -->
<!-- ================================
END INFO AREA
================================= -->

<!-- ================================
START ABOUT AREA
================================= -->
<section class="overflow-hidden about-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="about-content pe-5">
          <div class="section-heading">
            <h4 class="pb-2 font-size-16">Our Story</h4>
            <h2 class="sec__title">Atmosphere and Design</h2>
            <p class="pt-4 pb-2 sec__desc">
              It is a long established fact that a reader will be distracted
              by the readable content of a page when looking at its layout.
              The point of using Lorem Ipsum is that it has a more-or-less
              normal distribution of letters
            </p>
            <p class="sec__desc">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A
              accusamus amet consectetur ipsa officia. Doloremque error
              porro sit soluta totam! A iste nobis vel voluptatem!
            </p>
          </div>
          <!-- end section-heading -->
          <div class="pt-4 btn-box">
            <a href="about.html" class="theme-btn"
              >Read More <i class="la la-arrow-right ms-1"></i
            ></a>
          </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
      <div class="col-lg-6">
        <div class="image-box about-img-box">
          <img
            src="assets_site/images/img5.jpg"
            alt="about-img"
            class="img__item img__item-1"
          />
          <img
            src="assets_site/images/tripadvisor.png"
            alt="about-img"
            class="img__item img__item-2"
          />
        </div>
      </div>
      <!-- end col-lg-6 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- ================================
END ABOUT AREA
================================= -->

<div class="section-block"></div>

<!-- ================================
START ROOM TYPE AREA
================================= -->
<section class="room-type-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center section-heading">
          <h2 class="sec__title">Find a Room Type</h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="row padding-top-50px">
      <div class="col-lg-6">
        <div class="room-type-content">
          <div class="image-box">
            <a href="room-list.html" class="d-block">
              <img
                src="assets_site/images/img27.jpg"
                alt="room type img"
                class="img__item"
              />
              <div class="room-type-link">
                Dorm Beds <i class="la la-arrow-right ms-2"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
      <div class="col-lg-6">
        <div class="room-type-content">
          <div class="image-box">
            <a href="room-list.html" class="d-block">
              <img
                src="assets_site/images/img28.jpg"
                alt="room type img"
                class="img__item"
              />
              <div class="room-type-link">
                Private Room <i class="la la-arrow-right ms-2"></i>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- end col-lg-6 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- ================================
END ROOM TYPE AREA
================================= -->

<!-- ================================
START HOTEL AREA
================================= -->
<section
  class="overflow-hidden hotel-area section-bg padding-top-100px padding-bottom-200px"
>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center section-heading">
          <h2 class="sec__title line-height-55">
            Popular Hotel Destinations <br />
            You Might Like
          </h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="row padding-top-50px">
      <div class="col-lg-12">
        <div class="hotel-card-wrap">
          <div class="hotel-card-carousel-2 carousel-action">
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img1.jpg" alt="hotel-img" />
                </a>
                <span class="badge">Bestseller</span>
                <span class="badge badge-ribbon">30% off</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >The Millennium Hilton New York</a
                  >
                </h3>
                <p class="card-meta">124 E Huron St, New york</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__num">$90.00</span>
                    <span class="price__num before-price color-text-3"
                      >$120.00</span
                    >
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img2.jpg" alt="hotel-img" />
                </a>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Best Western Grant Park Hotel</a
                  >
                </h3>
                <p class="card-meta">124 E Huron St, Chicago</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$58.00</span>
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img3.jpg" alt="hotel-img" />
                </a>
                <span class="badge">Featured</span>
                <span class="badge badge-ribbon">20% off</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Hyatt Regency Maui Resort & Spa</a
                  >
                </h3>
                <p class="card-meta">200 Nohea Kai Dr, Lahaina, HI</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__num">$80.00</span>
                    <span class="price__num before-price color-text-3"
                      >$100.00</span
                    >
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img4.jpg" alt="hotel-img" />
                </a>
                <span class="badge">Popular</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Four Seasons Resort Maui at Wailea</a
                  >
                </h3>
                <p class="card-meta">3900 Wailea Alanui Drive, Kihei, HI</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$88.00</span>
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img5.jpg" alt="hotel-img" />
                </a>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Ibis Styles London Heathrow</a
                  >
                </h3>
                <p class="card-meta">272 Bath Road, Harlington, England</p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__from">From</span>
                    <span class="price__num">$88.00</span>
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
            <div class="card-item">
              <div class="card-img">
                <a href="hotel-single.html" class="d-block">
                  <img src="assets_site/images/img6.jpg" alt="hotel-img" />
                </a>
                <span class="badge badge-ribbon">10% off</span>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="hotel-single.html"
                    >Hotel Europe Saint Severin Paris</a
                  >
                </h3>
                <p class="card-meta">
                  38-40 Rue Saint Séverin, Paris, Paris
                </p>
                <div class="card-rating">
                  <span class="text-white badge">4.4/5</span>
                  <span class="review__text">Average</span>
                  <span class="rating__text">(30 Reviews)</span>
                </div>
                <div
                  class="card-price d-flex align-items-center justify-content-between"
                >
                  <p>
                    <span class="price__num">$70.00</span>
                    <span class="price__num before-price color-text-3"
                      >$80.00</span
                    >
                    <span class="price__text">Per night</span>
                  </p>
                  <a href="hotel-single.html" class="btn-text"
                    >See details<i class="la la-angle-right"></i
                  ></a>
                </div>
              </div>
            </div>
            <!-- end card-item -->
          </div>
          <!-- end hotel-card-carousel -->
        </div>
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container-fluid -->
</section>
<!-- end hotel-area -->
<!-- ================================
END HOTEL AREA
================================= -->

<!-- ================================
START DISCOUNT AREA
================================= -->
<section class="discount-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="discount-box">
          <div class="discount-img">
            <img src="assets_site/images/discount-hotel-img.jpg" alt="discount img" />
          </div>
          <!-- end discount-img -->
          <div class="discount-content">
            <div class="section-heading">
              <p class="text-white sec__desc">Hot deal, save 50%</p>
              <h2 class="mb-0 text-white sec__title line-height-50">
                Discount 50% for the <br />
                First Booking
              </h2>
            </div>
            <!-- end section-heading -->
            <div class="pt-4 btn-box">
              <a href="#" class="border-0 theme-btn"
                >Learn More <i class="la la-arrow-right ms-1"></i
              ></a>
            </div>
          </div>
          <!-- end discount-content -->
          <div class="company-logo">
            <img src="assets_site/images/logo2.png" alt="" />
            <p class="text-white font-size-14 text-end">*Terms applied</p>
          </div>
          <!-- end company-logo -->
        </div>
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end discount-area -->
<!-- ================================
END DISCOUNT AREA
================================= -->

<!-- ================================
   START TESTIMONIAL AREA
================================= -->
<section class="testimonial-area section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="mb-0 text-center section-heading">
          <h2 class="sec__title line-height-50">
            What Our Customers <br />
            are Saying Us?
          </h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row  -->
    <div class="row padding-top-50px">
      <div class="col-lg-12">
        <div class="testimonial-carousel carousel-action">
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team8.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Leroy Bell</h4>
                <span class="author__meta">United States</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team9.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Richard Pam</h4>
                <span class="author__meta">Canada</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team10.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Luke Jacobs</h4>
                <span class="author__meta">Australia</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
          <div class="testimonial-card">
            <div class="testi-desc-box">
              <p class="testi__desc">
                Excepteur sint occaecat cupidatat non proident sunt in culpa
                officia deserunt mollit anim laborum sint occaecat cupidatat
                non proident. Occaecat cupidatat non proident des.
              </p>
            </div>
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/team8.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <h4 class="author__title">Chulbul Panday</h4>
                <span class="author__meta">Italy</span>
                <span class="ratings d-flex align-items-center">
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                  <i class="la la-star"></i>
                </span>
              </div>
            </div>
          </div>
          <!-- end testimonial-card -->
        </div>
        <!-- end testimonial-carousel -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end testimonial-area -->
<!-- ================================
   START TESTIMONIAL AREA
================================= -->

<div class="section-block"></div>

<!-- ================================
   START BLOG AREA
================================= -->
<section class="blog-area section--padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center section-heading">
          <h2 class="sec__title">Recent Articles</h2>
        </div>
        <!-- end section-heading -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
    <div class="row padding-top-50px">
      <div class="col-lg-4 responsive-column">
        <div class="card-item blog-card">
          <div class="card-img">
            <img src="assets_site/images/img5.jpg" alt="blog-img" />
            <div class="post-format icon-element">
              <i class="la la-photo"></i>
            </div>
            <div class="card-body">
              <div class="post-categories">
                <a href="#" class="badge">Travel</a>
                <a href="#" class="badge">lifestyle</a>
              </div>
              <h3 class="card-title line-height-26">
                <a href="blog-single.html"
                  >Best Scandinavian Accommodation – Treat Yourself</a
                >
              </h3>
              <p class="card-meta">
                <span class="post__date"> 1 January, 2020</span>
                <span class="post-dot"></span>
                <span class="post__time">5 Mins read</span>
              </p>
            </div>
          </div>
          <div
            class="card-footer d-flex align-items-center justify-content-between"
          >
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/small-team1.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <a href="#" class="author__title">Leroy Bell</a>
              </div>
            </div>
            <div class="post-share">
              <ul>
                <li>
                  <i class="la la-share icon-element"></i>
                  <ul class="post-share-dropdown d-flex align-items-center">
                    <li>
                      <a href="#"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-instagram"></i></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4 responsive-column">
        <div class="card-item blog-card">
          <div class="card-img">
            <img src="assets_site/images/img6.jpg" alt="blog-img" />
            <div class="post-format icon-element">
              <i class="la la-play"></i>
            </div>
            <div class="card-body">
              <div class="post-categories">
                <a href="#" class="badge">Video</a>
              </div>
              <h3 class="card-title line-height-26">
                <a href="blog-single.html"
                  >Amazing Places to Stay in Norway</a
                >
              </h3>
              <p class="card-meta">
                <span class="post__date"> 1 February, 2020</span>
                <span class="post-dot"></span>
                <span class="post__time">4 Mins read</span>
              </p>
            </div>
          </div>
          <div
            class="card-footer d-flex align-items-center justify-content-between"
          >
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/small-team2.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <a href="#" class="author__title">Phillip Hunt</a>
              </div>
            </div>
            <div class="post-share">
              <ul>
                <li>
                  <i class="la la-share icon-element"></i>
                  <ul class="post-share-dropdown d-flex align-items-center">
                    <li>
                      <a href="#"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-instagram"></i></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div>
      <!-- end col-lg-4 -->
      <div class="col-lg-4 responsive-column">
        <div class="card-item blog-card">
          <div class="card-img">
            <img src="assets_site/images/img7.jpg" alt="blog-img" />
            <div class="post-format icon-element">
              <i class="la la-music"></i>
            </div>
            <div class="card-body">
              <div class="post-categories">
                <a href="#" class="badge">audio</a>
              </div>
              <h3 class="card-title line-height-26">
                <a href="blog-single.html"
                  >Feel Like Home on Your Business Trip</a
                >
              </h3>
              <p class="card-meta">
                <span class="post__date"> 1 March, 2020</span>
                <span class="post-dot"></span>
                <span class="post__time">3 Mins read</span>
              </p>
            </div>
          </div>
          <div
            class="card-footer d-flex align-items-center justify-content-between"
          >
            <div class="author-content d-flex align-items-center">
              <div class="author-img">
                <img src="assets_site/images/small-team3.jpg" alt="testimonial image" />
              </div>
              <div class="author-bio">
                <a href="#" class="author__title">Luke Jacobs</a>
              </div>
            </div>
            <div class="post-share">
              <ul>
                <li>
                  <i class="la la-share icon-element"></i>
                  <ul class="post-share-dropdown d-flex align-items-center">
                    <li>
                      <a href="#"><i class="lab la-facebook-f"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="lab la-instagram"></i></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end card-item -->
      </div>
      <!-- end col-lg-4 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end blog-area -->
<!-- ================================
   START BLOG AREA
================================= -->

<!-- ================================
START CTA AREA
================================= -->
<section class="cta-area subscriber-area section-bg-2 padding-top-60px padding-bottom-60px" >
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <div class="section-heading">
          <p class="pb-1 sec__desc text-white-50">Newsletter Sign up</p>
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

 