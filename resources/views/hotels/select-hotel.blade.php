@extends('layouts.apps')

@section('content')

  <div class="dashboard-main-body">

      <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
          {{-- <h6 class="fw-semibold mb-0">Basic Table</h6> --}}
          <ul class="d-flex align-items-center gap-2">
              <li class="fw-medium">
                  <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                      <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                      Hotels
                  </a>
              </li>
              <li>-</li>
              <li class="fw-medium">Liste des Hotels</li>
          </ul>
      </div>

      <div class="card basic-data-table">
          <div class="card-header">
              <h5 class="card-title mb-0">Liste des Hotels</h5>
          </div>
          {{-- @if($hotels->isEmpty())
            <div class="alert alert-info">Aucun hôtel trouvé</div>
          @endif; --}}
          <div class="card-body">
              <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                  <thead>
                      <tr>
                          <th scope="col">
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      S.L
                                  </label>
                              </div>
                          </th>
                          <th scope="col">Logo</th>
                          <th scope="col">Name</th>
                          <th scope="col">Issued Date</th>
                          <th scope="col">Telepone</th>
                          <th scope="col">Email</th>
                          <th scope="col">Ville</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($hotels as $hotel)
                    {{-- @dd($hotel); --}}
                    
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      01
                                  </label>
                              </div>
                          </td>
                          <td>

                            {{-- <form method="POST" action="">
                              @csrf
                              <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                              <button type="submit" class="btn btn-primary">
                                    @if ($hotel->logo)
                                    <img src="{{ asset('storage/' . $hotel->logo) }}" alt="" width="50" height="50" class="flex-shrink-0 me-12 radius-8">
                                    @else
                                    aucune image
                                  @endif
                              </button> --}}
                            
                            <a href="{{route('hotels.manage', $hotel->id)}}" class="text-primary-600"> 
                            @if ($hotel->logo)
                              <img src="{{ asset('storage/' . $hotel->logo) }}" alt="" width="50" height="50" class="flex-shrink-0 me-12 radius-8">
                              @else
                              aucune image
                            @endif</a>
                          </td>
                          <td>
                              <div class="d-flex align-items-center">
                               
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">{{$hotel->nom_hotel}}</h6>
                              </div>
                              {{-- @if($hotel->logo)
                              <img src="{{ asset('storage/' . $hotel->logo) }}" 
                                   alt="Logo" 
                                   style="width: 50px; height: 50px; object-fit: cover;">
                              @else
                                  <span class="text-muted">Aucun logo</span>
                              @endif --}}
                          </td>
                          <td>{{$hotel->created_at}}</td>
                          <td>{{$hotel ->telephone}}</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">{{$hotel ->email}}</span>
                          </td>
                          <td>{{$hotel ->ville}}</td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                    @endforeach

                      <?php /*<tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      02
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#696589</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list2.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Annette Black</h6>
                              </div>
                          </td>
                          <td>25 Jan 2024</td>
                          <td>$200.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      03
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#256584</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list3.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Ronald Richards</h6>
                              </div>
                          </td>
                          <td>10 Feb 2024</td>
                          <td>$200.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      04
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526587</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list4.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Eleanor Pena</h6>
                              </div>
                          </td>
                          <td>10 Feb 2024</td>
                          <td>$150.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      05
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#105986</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list5.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Leslie Alexander</h6>
                              </div>
                          </td>
                          <td>15 March 2024</td>
                          <td>$150.00</td>
                          <td> <span
                                  class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      06
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526589</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list6.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Albert Flores</h6>
                              </div>
                          </td>
                          <td>15 March 2024</td>
                          <td>$150.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      07
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526520</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list7.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Jacob Jones</h6>
                              </div>
                          </td>
                          <td>27 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      08
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#256584</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list8.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Jerome Bell</h6>
                              </div>
                          </td>
                          <td>27 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      09
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#200257</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list9.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Marvin McKinney</h6>
                              </div>
                          </td>
                          <td>30 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      10
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526525</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list10.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Cameron Williamson</h6>
                              </div>
                          </td>
                          <td>30 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      01
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list1.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Kathryn Murphy</h6>
                              </div>
                          </td>
                          <td>25 Jan 2024</td>
                          <td>$200.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      02
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#696589</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list2.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Annette Black</h6>
                              </div>
                          </td>
                          <td>25 Jan 2024</td>
                          <td>$200.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      03
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#256584</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list3.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Ronald Richards</h6>
                              </div>
                          </td>
                          <td>10 Feb 2024</td>
                          <td>$200.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      04
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526587</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list4.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Eleanor Pena</h6>
                              </div>
                          </td>
                          <td>10 Feb 2024</td>
                          <td>$150.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      05
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#105986</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list5.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Leslie Alexander</h6>
                              </div>
                          </td>
                          <td>15 March 2024</td>
                          <td>$150.00</td>
                          <td> <span
                                  class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      06
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526589</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list6.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Albert Flores</h6>
                              </div>
                          </td>
                          <td>15 March 2024</td>
                          <td>$150.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      07
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526520</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list7.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Jacob Jones</h6>
                              </div>
                          </td>
                          <td>27 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      08
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#256584</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list8.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Jerome Bell</h6>
                              </div>
                          </td>
                          <td>27 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      09
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#200257</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list9.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Marvin McKinney</h6>
                              </div>
                          </td>
                          <td>30 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="form-check style-check d-flex align-items-center">
                                  <input class="form-check-input" type="checkbox">
                                  <label class="form-check-label">
                                      10
                                  </label>
                              </div>
                          </td>
                          <td><a href="javascript:void(0)" class="text-primary-600">#526525</a></td>
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="assets/images/user-list/user-list10.png" alt=""
                                      class="flex-shrink-0 me-12 radius-8">
                                  <h6 class="text-md mb-0 fw-medium flex-grow-1">Cameron Williamson</h6>
                              </div>
                          </td>
                          <td>30 April 2024</td>
                          <td>$250.00</td>
                          <td> <span
                                  class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                          </td>
                          <td>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="lucide:edit"></iconify-icon>
                              </a>
                              <a href="javascript:void(0)"
                                  class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                  <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                              </a>
                          </td>
                      </tr> */?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

@endsection



