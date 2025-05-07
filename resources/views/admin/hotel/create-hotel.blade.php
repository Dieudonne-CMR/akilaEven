@extends('admin.layouts.layout-admin')
@section('content-admin')

@if(session()->has('errors') && session('errors')->has('general'))
    <x-ui.toast type="error" message="{{ $errors->first('general') }}" position="bottom-right" />
@endif

<x-admin.dashboard-panel class="">
    <!-- Contenu Principal -->
    <div class="">
      <div class="max-w-full p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
          <!-- Bouton Retour -->
          <a href="{{ route("admin.hotels") }}" class="inline-flex items-center mb-6 text-gray-600 transition-colors hover:text-blue-600">
              <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
              Retour aux hôtels
          </a>
          
          <!-- En-tête -->
          <header class="mb-8">
              <h1 class="mb-2 text-3xl font-bold text-gray-900">Ajouter un nouvel hôtel</h1>
              <p class="text-gray-600">Remplissez les détails pour lister votre établissement</p>
          </header>
      </div>
      
      
      <!-- Carte du formulaire -->
      <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
          <div class="mb-8">
              <h2 class="mb-1 text-xl font-semibold text-gray-900">Informations sur l'hôtel</h2>
              <p class="text-sm text-gray-500">Tous les champs marqués d'un * sont obligatoires</p>
          </div>
    
          
          <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
              @csrf              
              <!-- Upload du logo -->
              <div class="mb-6">
                  <label class="block mb-2 text-sm font-medium text-gray-900" for="logo">
                      Logo de l'hôtel <span class="text-red-500">*</span>
                  </label>
                  <div class="flex items-center justify-center w-full">
                      <label for="logo" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2  border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 {{ session()->has('errors') && session('errors')->has('logo') ? 'border-red-500' : 'border-gray-300'}}">
                          <div class="flex flex-col items-center justify-center pt-5 pb-6">
                              <i data-lucide="upload-cloud" class="w-10 h-10 mb-3 text-gray-400"></i>
                              <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Cliquez pour uploader</span> ou glisser-déposer</p>
                              <p class="text-xs text-gray-500">PNG, JPG ou JPEG (MAX. 4 Mo)</p>
                          </div>
                          <input id="logo" name="logo" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg" />
                      </label>
                  </div>
                  @if(session()->has('errors') && session('errors')->has('logo'))
                      <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('logo') }}</p>
                  @endif
              </div>
              
              <!-- Nom de l'hôtel -->
              <div class="mb-6">
                  <label for="nom_hotel" class="block mb-2 text-sm font-medium text-gray-900">
                      Nom de l'hôtel <span class="text-red-500">*</span>
                  </label>
                  <input type="text" id="nom_hotel" name="nom_hotel" value="{{ old('nom_hotel')}}" class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('nom_hotel') ? 'border-red-500' : 'border-gray-300'}} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Entrez le nom de l'hôtel" required>
                  @if(session()->has('errors') && session('errors')->has('nom_hotel'))
                      <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('nom_hotel') }}</p>
                  @endif
              </div>
              
              <!-- Email et Téléphone du manager -->
              <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                          Email <span class="text-red-500">*</span>
                      </label>
                      <div class="relative">
                          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                              <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                          </div>
                          <input type="email" id="email" name="email" value="{{ old('email') }}" class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('email') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="hotel@exemple.com" required>
                      </div>
                      @if(session()->has('errors') && session('errors')->has('email'))
                          <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('email') }}</p>
                      @endif
                  </div>
                  <div>
                      <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900">
                          Téléphone <span class="text-red-500">*</span>
                      </label>
                      <div class="relative">
                          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                              <i data-lucide="phone" class="w-5 h-5 text-gray-400"></i>
                          </div>
                          <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('telephone') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="6xxxxxxxx" required>
                      </div>
                      @if(session()->has('errors') && session('errors')->has('telephone'))
                          <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('telephone') }}</p>
                      @endif
                  </div>
              </div>
              
              <!-- Sélection de la ville -->
              <div class="mb-6">
                  <label for="ville" class="block mb-2 text-sm font-medium text-gray-900">
                      Ville <span class="text-red-500">*</span>
                  </label>
                  <div class="relative">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                          <i data-lucide="map-pin" class="w-5 h-5 text-gray-400"></i>
                      </div>
                      <select id="ville" name="ville" class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('ville') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" required>
                          <option value="" selected disabled>Sélectionnez une ville</option>
                          @foreach($villes as $ville)
                              <option value="{{ $ville->id }}" {{ old('ville') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                          @endforeach
                      </select>
                  </div>
                  @if(session()->has('errors') && session('errors')->has('ville'))
                      <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('ville') }}</p>
                  @endif
              </div>
              
              <!-- Description -->
              <div class="mb-6">
                  <label for="description_hotel" class="block mb-2 text-sm font-medium text-gray-900">
                      Description <span class="text-red-500">*</span>
                  </label>
                  <textarea id="description_hotel" name="description_hotel" rows="4" class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('description_hotel') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Décrivez votre hôtel, ses caractéristiques uniques et ce que les clients peuvent attendre..." required>{{ old('description_hotel') }}</textarea>
                  @if(session()->has('errors') && session('errors')->has('description_hotel'))
                      <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('description_hotel') }}</p>
                  @endif
              </div>
              
              <!-- Géolocalisation -->
              <div class="mb-6">
                  <label for="localisation" class="block mb-2 text-sm font-medium text-gray-900">
                      Adresse/Localisation <span class="text-red-500">*</span>
                  </label>
                  <div class="relative">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                          <i data-lucide="map" class="w-5 h-5 text-gray-400"></i>
                      </div>
                      <input type="text" id="localisation" name="localisation" value="{{ old('localisation') }}" class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('localisation') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Entrez l'adresse complète de l'hôtel" required>
                  </div>
                  @if(session()->has('errors') && session('errors')->has('localisation'))
                      <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('localisation') }}</p>
                  @endif
              </div>
              
              <!-- Services -->
              <div class="mb-6" x-data="tagInput()" x-init="init()">
                  <label class="block mb-2 text-sm font-medium text-gray-900">
                      Services & Équipements
                  </label>
                  <div class="flex flex-wrap items-center gap-2 mb-3" id="services-container">
                      <template x-for="(service, index) in services" :key="index">
                          <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full flex items-center">
                              <span x-text="service"></span>
                              <input type="hidden" name="services[]" :value="service">
                              <button @click="removeService(index)" type="button" class="ml-1 text-blue-800 hover:text-blue-900 focus:outline-none">
                                  <i data-lucide="x" class="w-3 h-3"></i>
                              </button>
                          </span>
                      </template>
                  </div>
                  <div class="flex">
                      <input type="text" x-model="newService" @keydown.enter.prevent="addService()" class="bg-gray-50 border border-gray-300 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ajouter un service (ex: WiFi, Piscine, Spa)">
                      <button type="button" @click="addService()" class="inline-flex items-center px-3 text-sm text-white bg-blue-600 border border-blue-600 rounded-r-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                          <i data-lucide="plus" class="w-4 h-4"></i>
                      </button>
                  </div>
                  <p class="mt-1 text-sm text-gray-500">Ajoutez jusqu'à 10 services ou équipements proposés par votre hôtel</p>
                  @if(session()->has('errors') && session('errors')->has('services'))
                      <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('services') }}</p>
                  @endif
              </div>
              
              <!-- Upload des bannières -->
              <div class="mb-8">
                  <label class="block mb-2 text-sm font-medium text-gray-900">
                      Bannières de l'hôtel <span class="text-red-500">*</span>
                  </label>
                  <p class="mb-3 text-sm text-gray-500">Uploader au moins une image de haute qualité montrant votre hôtel</p>
                  
                  <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                      <!-- Bannière 1 -->
                      <div class="relative">
                          <label for="bannier1" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2  border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 {{ session()->has('errors') && session('errors')->has('bannier1') ? 'border-red-500' : 'border-gray-300' }}">
                              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                  <i data-lucide="image" class="w-8 h-8 mb-2 text-gray-400"></i>
                                  <p class="text-xs text-gray-500">Vue principale</p>
                              </div>
                              <input id="bannier1" name="bannier1" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg" />
                          </label>
                          <span class="absolute -top-2 left-2 bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">1</span>
                      </div>
                      
                      <!-- Bannière 2 -->
                      <div class="relative">
                          <label for="bannier2" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 {{ session()->has('errors') && session('errors')->has('bannier2') ? 'border-red-500' : '' }}">
                              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                  <i data-lucide="image" class="w-8 h-8 mb-2 text-gray-400"></i>
                                  <p class="text-xs text-gray-500">Deuxième vue</p>
                              </div>
                              <input id="bannier2" name="bannier2" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg" />
                          </label>
                          <span class="absolute -top-2 left-2 bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">2</span>
                      </div>
                      
                      <!-- Bannière 3 -->
                      <div class="relative">
                          <label for="bannier3" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2  border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 {{ session()->has('errors') && session('errors')->has('bannier3') ? 'border-red-500' : 'border-gray-300' }}">
                              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                  <i data-lucide="image" class="w-8 h-8 mb-2 text-gray-400"></i>
                                  <p class="text-xs text-gray-500">Troisième vue</p>
                              </div>
                              <input id="bannier3" name="bannier3" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg" />
                          </label>
                          <span class="absolute -top-2 left-2 bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">3</span>
                      </div>
                  </div>
                  @if(session()->has('errors') && session('errors')->has('bannieres'))
                      <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('bannieres') }}</p>
                  @endif
                  @if(session()->has('errors') && (session('errors')->has('bannier1') || session('errors')->has('bannier2') || session('errors')->has('bannier3')))
                      <p class="mt-1 text-sm text-red-600">Veuillez vérifier le format et la taille des images.</p>
                  @endif
              </div>
              
              <!-- Bouton de soumission -->
              <div class="flex justify-end">
                  <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                      <i data-lucide="save" class="w-5 h-5 mr-2"></i>
                      Enregistrer l'hôtel
                  </button>
              </div>
          </form>
      </div>
  </div>
  </x-admin.dashboard-panel>
  
  <script>
     function tagInput() {
            return {
                services: [],
                newService: '',

                init() {
                    if (window.lucide) {
            window.lucide.createIcons();
        }
                // appel initial pour remplacer les icônes déjà en DOM
                lucide.replace()
                },

                addService() {
                if (this.newService.trim()) {
                    this.services.push(this.newService.trim())
                    this.newService = ''
                    // attendre la mise à jour du DOM, puis remplacer l’icône
                    this.$nextTick(() => {
                        if (window.lucide) {
            window.lucide.createIcons();
        }
                    })
                }
                },

                removeService(index) {
                this.services.splice(index, 1)
                this.$nextTick(() => {
                    if (window.lucide) {
            window.lucide.createIcons();
        }
                })
                }
            }
        };
        
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            window.lucide.createIcons();
        }
        lucide.createIcons();

        // Prévisualisation des images uploadées
        const setupImagePreview = (inputId) => {
            const input = document.getElementById(inputId);
            const label = input.parentElement;
            
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                
                const fileType = file.type;
                if (!fileType.startsWith('image/')) {
                    alert('Veuillez sélectionner une image valide.');
                    return;
                }
                
                // Créer une prévisualisation
                const preview = document.createElement('div');
                preview.className = 'absolute inset-0';
                
                const img = document.createElement('img');
                img.className = 'object-cover w-full h-full';
                img.src = URL.createObjectURL(file);
                img.alt = 'Aperçu';
                
                const removeBtn = document.createElement('button');
                removeBtn.className = 'absolute p-1 text-white bg-red-500 rounded-full top-2 right-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400';
                removeBtn.innerHTML = '<i data-lucide="x" class="w-4 h-4"></i>';
                removeBtn.addEventListener('click', function(evt) {
                    evt.preventDefault();
                    evt.stopPropagation();
                    input.value = '';
                    label.removeChild(preview);
                    lucide.createIcons();
                });
                
                preview.appendChild(img);
                preview.appendChild(removeBtn);
                
                // Supprimer l'ancienne prévisualisation si elle existe
                const oldPreview = label.querySelector('.absolute.inset-0');
                if (oldPreview) {
                    label.removeChild(oldPreview);
                }
                
                // Ajouter la nouvelle prévisualisation
                label.appendChild(preview);
                lucide.createIcons();
            });
        };
       
        // Configurer les prévisualisations pour toutes les images
        setupImagePreview('logo');
        setupImagePreview('bannier1');
        setupImagePreview('bannier2');
        setupImagePreview('bannier3');
    });
  </script>

@endsection
