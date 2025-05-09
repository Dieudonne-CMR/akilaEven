@extends('layouts.apps')

@section('content')


  <div class="dashboard-main-body">

      <div class="flex-wrap gap-3 mb-24 d-flex align-items-center justify-content-between">
          <h6 class="mb-0 fw-semibold">Créer un Agence</h6>
          <ul class="gap-2 d-flex align-items-center">
              <li class="fw-medium">
                  <a href="index.html" class="gap-1 d-flex align-items-center hover-text-primary">
                      <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg icon"></iconify-icon>
                      Dashboard
                  </a>
              </li>
              <li>-</li>
              <li class="fw-medium">Créer un Agence</li>
          </ul>
      </div>

      <div class="row gy-4">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                      <h5 class="mb-0 card-title">Créer un Agence</h5>
                  </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  <div class="card-body">
                    <form method="POST" action="{{ route('agences.store') }}" class="row gy-3 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                          <div class="col-md-6">
                                <label class="form-label">Nom de l'agence *</label>
                              <div class="icon-field has-validation">
                                  {{-- <span class="icon">
                                      <iconify-icon icon="f7:person"></iconify-icon>
                                  </span> --}}
                                  <input type="text" name="nom_agence" class="form-control"
                                      placeholder="Nom de l'Agence" required>
                                  <div class="invalid-feedback">
                                      Please provide first name
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-6">
                                <label class="form-label">Logo *</label>
                              <div class="icon-field has-validation">
                                  {{-- <span class="icon">
                                      <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                  </span> --}}
                                  <input type="file" name="logo" class="form-control" accept="image/*" required>
                                  <div class="invalid-feedback">
                                      Please provide phone number
                                  </div>
                              </div>
                          </div>

                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <div class="icon-field has-validation">
                                {{-- <span class="icon">
                                    <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                </span> --}}
                                <input type="tel" name="telephone" class="form-control" pattern="[0-9]{10}">
                                
                                <div class="invalid-feedback">
                                    Please provide phone number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <div class="icon-field has-validation">
                                {{-- <span class="icon">
                                    <iconify-icon icon="solar:phone-calling-linear"></iconify-icon>
                                </span> --}}
                                <input type="email" name="email" class="form-control">
                                <div class="invalid-feedback">
                                    Please provide phone number
                                </div>
                            </div>
                        </div>
                          
                          <div class="col-md-6">
                            <label class="form-label">Ville *</label>
                              <div class="icon-field has-validation">
                                  {{-- <span class="icon">
                                      <iconify-icon icon="mage:email"></iconify-icon>
                                  </span> --}}
                                  <input type="text" name="ville" class="form-control"
                                      placeholder="Ville: Douala" required>
                                  <div class="invalid-feedback">
                                      Please provide email address
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Localisation *</label>
                              <div class="icon-field has-validation">
                                  <span class="icon">
                                      {{-- <iconify-icon icon="solar:phone-calling-linear"></iconify-icon> --}}
                                  </span>
                                  <input type="text" name="localisation" class="form-control"
                                      placeholder="Logpom, Douala 5eme" required>
                                  <div class="invalid-feedback">
                                      Please provide phone number
                                  </div>
                              </div>
                          </div>

                          @for($i = 1; $i <= 3; $i++)
                            <div class="col-md-4">
                                <label class="form-label">Bannière {{ $i }}</label>
                                <div class="icon-field has-validation">
                                    <span class="icon">
                                        {{-- <iconify-icon icon="solar:phone-calling-linear"></iconify-icon> --}}
                                    </span>
                                    <input type="file" name="bannier{{ $i }}" class="form-control" id="bannier{{ $i }}Input" accept="image/*">
                                    <div class="invalid-feedback">
                                        Please provide phone number
                                    </div>
                                </div>
                            </div>
                          @endfor

                          <div class="col-md-12">
                            <label class="form-label">Description *</label>
                              <div class="icon-field has-validation">
                                  {{-- <span class="icon">
                                      <iconify-icon icon="f7:person"></iconify-icon>
                                  </span> --}}
                                  <textarea name="description_agence" class="form-control" rows="3" required></textarea>
                                  
                                  <div class="invalid-feedback">
                                      Please provide last name
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <button class="btn btn-primary-600" type="submit">Enregistrer</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection


  <!-- Pour ajouter des styles/scripts spécifiques -->
  @push('page-scripts')
  
  <script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
   
