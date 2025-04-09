@extends('layouts.apps')
@section('content')

@push('style')
      <style>
        .card-img-overlay {
          background: rgba(0, 0, 0, 0.5);
          display: none;
      }

      .card:hover .card-img-overlay {
          display: flex;
      }
 </style>
  
@endpush
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Modification de la salle {{ $eventHall->hotel->nom_hotel }}</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Add Blog</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-lg-12">
                <div class="card mt-24">
                    {{-- <div class="card-header border-bottom">
                        <h6 class="text-xl mb-0">Modification de la salle</h6>
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif
                    </div> --}}
                    <div class="card-body p-24">
                        <form action="{{ route('event-halls.update', $eventHall->id) }}" class="d-flex flex-column gap-20"
                            method="POST" enctype="multipart/form-data">
                            @csrf               
                            @method('PUT')
                            <input type="hidden" name="hotel_id" value="{{ session('current_hotel_id') }}">
                            <div>
                                <label class="form-label fw-bold text-neutral-900" for="title">Nom de la salle: </label>
                                <input type="text" name="nom_salle" value="{{ old('nom_salle', $eventHall->nom_salle) }}"
                                    class="form-control border border-neutral-200 radius-8" id="title"
                                    placeholder="Enter Post Title">
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-neutral-900" for="title">Localisation: </label>
                                    <input type="text" name="localisation" value="{{ old('localisation', $eventHall->localisation) }}"
                                        class="form-control border border-neutral-200 radius-8" id="title"
                                        placeholder="Enter Post Title">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-neutral-900" for="title">Capacité: </label>
                                    <input type="number" name="capacite" value="{{ old('capacite', $eventHall->capacite) }}"
                                        class="form-control border border-neutral-200 radius-8" id="title"
                                        placeholder="Enter Post Title">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-neutral-900" for="title">Prix: </label>
                                    <input type="number" name="prix" value="{{ old('prix', $eventHall->prix) }}"
                                        class="form-control border border-neutral-200 radius-8" id="title"
                                        placeholder="Enter Post Title">
                                </div>
                                
                                <div class="col-md-6">


                                    <label class="form-label fw-bold text-neutral-900" for="ville_id">Ville :</label>
                                    <select class="form-control border border-neutral-200 radius-8" name="ville_id"
                                        required>
                                        @foreach ($villes as $ville)
                                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="form-label fw-bold text-neutral-900">Description de la salle </label>
                                <div class="border border-neutral-200 radius-8 overflow-hidden">
                                    <div class="height-200">
                                        <!-- Editor Toolbar Start -->
                                        <div id="toolbar-container">
                                            <span class="ql-formats">
                                                <select class="ql-font"></select>
                                                <select class="ql-size"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-strike"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <select class="ql-color"></select>
                                                <select class="ql-background"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-script" value="sub"></button>
                                                <button class="ql-script" value="super"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-header" value="1"></button>
                                                <button class="ql-header" value="2"></button>
                                                <button class="ql-blockquote"></button>
                                                <button class="ql-code-block"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-list" value="ordered"></button>
                                                <button class="ql-list" value="bullet"></button>
                                                <button class="ql-indent" value="-1"></button>
                                                <button class="ql-indent" value="+1"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-direction" value="rtl"></button>
                                                <select class="ql-align"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-link"></button>
                                                <button class="ql-image"></button>
                                                <button class="ql-video"></button>
                                                <button class="ql-formula"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-clean"></button>
                                            </span>
                                        </div>
                                        <!-- Editor Toolbar Start -->

                                        <!-- Editor start -->
                                        <textarea name="description_salle" id="editor" cols="30" rows="10">
                                            {{ old('description_salle', $eventHall->description_salle) }}
                                        </textarea>
                                        {{-- <div id="editor">
                                            <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                Omnis dolores explicabo
                                                corrupti, fuga</p>
                                            <p><br></p>
                                        </div> --}}
                                        <!-- Edit End -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="mb-4">
                                  <h4>Gestion des photos</h4>
                                  
                                  <!-- Aperçu des photos existantes -->
                                  <div class="row mb-3">
                                      @php $photoFields = ['photo', 'photo1', 'photo2', 'photo3'] @endphp
                                      @foreach($photoFields as $field)
                                          <div class="col-md-3 mb-3">
                                              <div class="card h-100">
                                                  @if($eventHall->$field)
                                                      <img src="{{ asset('storage/' . $eventHall->$field) }}" 
                                                          class="card-img-top img-thumbnail" 
                                                          style="height: 150px; object-fit: cover;">
                                                      <div class="card-body text-center">
                                                          <div class="form-check">
                                                              <input type="checkbox" 
                                                                    name="delete_{{ $field }}" 
                                                                    id="delete_{{ $field }}" 
                                                                    class="form-check-input">
                                                              <label class="form-check-label text-danger" 
                                                                    for="delete_{{ $field }}">
                                                                  Supprimer
                                                              </label>
                                                          </div>
                                                      </div>
                                                  @endif
                                                  <div class="card-footer bg-white">
                                                      <input type="file" 
                                                            name="{{ $field }}" 
                                                            class="form-control form-control-sm"
                                                            accept="image/*">
                                                      <small class="text-muted">Max 2MB - Format: JPG, PNG</small>
                                                  </div>
                                              </div>
                                          </div>
                                      @endforeach
                                  </div>
                                </div>

                            </div>


                            <button type="submit" class="btn btn-primary-600 radius-8">Submit</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/editor.highlighted.min.js') }}"></script>
    <script src="{{ asset('assets/js/editor.quill.js') }}"></script>
    <script src="{{ asset('assets/js/editor.katex.min.js') }}"></script>

    <script>
        // Editor Js Start
        const quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: 'Compose an epic...',
            theme: 'snow',
        });
        // Editor Js End


        // // =============================== Upload Single Image js start here ================================================
        // const fileInput = document.getElementById("upload-file");
        // const imagePreview = document.getElementById("uploaded-img__preview");
        // const uploadedImgContainer = document.querySelector(".uploaded-img");
        // const removeButton = document.querySelector(".uploaded-img__remove");

        // fileInput.addEventListener("change", (e) => {
        //     if (e.target.files.length) {
        //         const src = URL.createObjectURL(e.target.files[0]);
        //         imagePreview.src = src;
        //         uploadedImgContainer.classList.remove('d-none');
        //     }
        // });
        // removeButton.addEventListener("click", () => {
        //     imagePreview.src = "";
        //     uploadedImgContainer.classList.add('d-none');
        //     fileInput.value = "";
        // });
        // =============================== Upload Single Image js End here ================================================
    </script>

    <script>
      // Add event listener to all file inputs
            document.querySelectorAll('input[type="file"]').forEach(input => {
          input.addEventListener('change', function(e) {
              const preview = this.closest('.card').querySelector('img');
              const file = e.target.files[0];
              
              if (file) {
                  preview.src = URL.createObjectURL(file);
                  preview.style.display = 'block';
              }
          });
      });
    </script>
@endpush
