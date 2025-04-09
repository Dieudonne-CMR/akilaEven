@extends('layouts.apps')
@section('content')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Ajouter une salle {{ $hotel->nom_hotel }}</h6>
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
                    <div class="card-header border-bottom">
                        <h6 class="text-xl mb-0">Ajouter une salle</h6>
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
                    </div>
                    <div class="card-body p-24">
                        <form action="{{ route('event_halls.store', $hotel->id) }}" class="d-flex flex-column gap-20"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label class="form-label fw-bold text-neutral-900" for="title">Nom de la salle: </label>
                                <input type="text" name="nom_salle" value="{{ old('nom_salle') }}"
                                    class="form-control border border-neutral-200 radius-8" id="title"
                                    placeholder="Enter Post Title">
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-neutral-900" for="title">Localisation: </label>
                                    <input type="text" name="localisation" value="{{ old('localisation') }}"
                                        class="form-control border border-neutral-200 radius-8" id="title"
                                        placeholder="Enter Post Title">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-neutral-900" for="title">Capacité: </label>
                                    <input type="number" name="capacite" value="{{ old('capacite') }}"
                                        class="form-control border border-neutral-200 radius-8" id="title"
                                        placeholder="Enter Post Title">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-neutral-900" for="title">Prix: </label>
                                    <input type="number" name="prix" value="{{ old('prix') }}"
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
                                            {{ old('description_salle') }}
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

                                <div class="col-md-6">
                                    <div class="">
                                        <label class="form-label"> image</label>
                                        <input class="form-control" type="file" name="photo"
                                            id="imgInput">
                                        <div class="invalid-feedback">
                                            Please choose a file.
                                        </div>
                                    </div>
                                </div>

                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="col-md-6">
                                        <div class="">
                                            <label class="form-label"> image{{ $i }}</label>
                                            <input class="form-control" type="file" name="photo{{ $i }}"
                                                id="photo{{ $i }}Input">
                                            <div class="invalid-feedback">
                                                Please choose a file.
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                            </div>

                            <button type="submit" class="btn btn-primary-600 radius-8">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Start -->
            {{-- <div class="col-lg-4">
        <div class="d-flex flex-column gap-24">
          <!-- Latest Blog -->
          <div class="card">
            <div class="card-header border-bottom">
              <h6 class="text-xl mb-0">Latest Posts</h6>
            </div>
            <div class="card-body d-flex flex-column gap-24 p-24">
              <div class="d-flex flex-wrap">
                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                  <img src="assets/images/blog/blog1.png" alt="" class="w-100 h-100 object-fit-cover">
                </a>
                <div class="blog__content">
                  <h6 class="mb-8">
                    <a href="blog-details.html" class="text-line-2 text-hover-primary-600 text-md transition-2">How to
                      hire a right business executive for your company</a>
                  </h6>
                  <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem
                    eveniet enim minus.</p>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                  <img src="assets/images/blog/blog2.png" alt="" class="w-100 h-100 object-fit-cover">
                </a>
                <div class="blog__content">
                  <h6 class="mb-8">
                    <a href="blog-details.html" class="text-line-2 text-hover-primary-600 text-md transition-2">The
                      Gig Economy: Adapting to a Flexible Workforce</a>
                  </h6>
                  <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem
                    eveniet enim minus.</p>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                  <img src="assets/images/blog/blog3.png" alt="" class="w-100 h-100 object-fit-cover">
                </a>
                <div class="blog__content">
                  <h6 class="mb-8">
                    <a href="blog-details.html" class="text-line-2 text-hover-primary-600 text-md transition-2">The
                      Future of Remote Work: Strategies for Success</a>
                  </h6>
                  <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem
                    eveniet enim minus.</p>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                  <img src="assets/images/blog/blog4.png" alt="" class="w-100 h-100 object-fit-cover">
                </a>
                <div class="blog__content">
                  <h6 class="mb-8">
                    <a href="blog-details.html" class="text-line-2 text-hover-primary-600 text-md transition-2">Lorem
                      ipsum dolor sit amet consectetur adipisicing.</a>
                  </h6>
                  <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem
                    eveniet enim minus.</p>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                  <img src="assets/images/blog/blog5.png" alt="" class="w-100 h-100 object-fit-cover">
                </a>
                <div class="blog__content">
                  <h6 class="mb-8">
                    <a href="blog-details.html" class="text-line-2 text-hover-primary-600 text-md transition-2">How to
                      hire a right business executive for your company</a>
                  </h6>
                  <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem
                    eveniet enim minus.</p>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                  <img src="assets/images/blog/blog6.png" alt="" class="w-100 h-100 object-fit-cover">
                </a>
                <div class="blog__content">
                  <h6 class="mb-8">
                    <a href="blog-details.html" class="text-line-2 text-hover-primary-600 text-md transition-2">The
                      Gig Economy: Adapting to a Flexible Workforce</a>
                  </h6>
                  <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem
                    eveniet enim minus.</p>
                </div>
              </div>
              <div class="d-flex flex-wrap">
                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                  <img src="assets/images/blog/blog7.png" alt="" class="w-100 h-100 object-fit-cover">
                </a>
                <div class="blog__content">
                  <h6 class="mb-8">
                    <a href="blog-details.html" class="text-line-2 text-hover-primary-600 text-md transition-2">The
                      Future of Remote Work: Strategies for Success</a>
                  </h6>
                  <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet consectetur
                    adipisicing elit. Omnis dolores explicabo corrupti, fuga necessitatibus fugiat adipisci quidem
                    eveniet enim minus.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
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


        // =============================== Upload Single Image js start here ================================================
        const fileInput = document.getElementById("upload-file");
        const imagePreview = document.getElementById("uploaded-img__preview");
        const uploadedImgContainer = document.querySelector(".uploaded-img");
        const removeButton = document.querySelector(".uploaded-img__remove");

        fileInput.addEventListener("change", (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                imagePreview.src = src;
                uploadedImgContainer.classList.remove('d-none');
            }
        });
        removeButton.addEventListener("click", () => {
            imagePreview.src = "";
            uploadedImgContainer.classList.add('d-none');
            fileInput.value = "";
        });
        // =============================== Upload Single Image js End here ================================================
    </script>
@endpush
