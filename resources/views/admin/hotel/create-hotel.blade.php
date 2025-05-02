@extends('admin.layouts.layout-admin')
@section('content-admin')
<x-admin.dashboard-panel class="">
    <!-- Contenu Principal -->
    <div class="">
      <div class="max-w-full p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
          <!-- Bouton Retour -->
          <a href="{{ route("admin.hotels.show") }}" class="inline-flex items-center mb-6 text-gray-600 transition-colors hover:text-blue-600">
              <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
              </svg>
              Retour aux hôtels
          </a>
          
          <!-- En-tête -->
          <header class="mb-8">
              <h1 class="mb-2 text-3xl font-bold text-gray-900">Ajouter un nouvel hôtel</h1>
              <p class="text-gray-600">Remplissez les détails pour lister votre établissement</p>
          </header>
      </div>
      
      
      <!-- Carte du formulaire -->
      <div class="p-6 mb-8 bg-white rounded-lg shadow-md" x-data="hotelForm()">
          <div class="mb-8">
              <h2 class="mb-1 text-xl font-semibold text-gray-900">Informations sur l'hôtel</h2>
              <p class="text-sm text-gray-500">Tous les champs marqués d'un * sont obligatoires</p>
          </div>
          
          <form @submit.prevent="submitForm">
              <!-- Upload du logo -->
              <div class="mb-6">
                  <label class="block mb-2 text-sm font-medium text-gray-900" for="hotel_logo">
                      Logo de l'hôtel <span class="text-red-500">*</span>
                  </label>
                  <div class="flex items-center justify-center w-full">
                      <label for="hotel_logo" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                          :class="{'border-blue-500 bg-blue-50': logoPreview}">
                          <template x-if="!logoPreview">
                              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                  <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                  </svg>
                                  <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Cliquez pour uploader</span> ou glisser-déposer</p>
                                  <p class="text-xs text-gray-500">SVG, PNG ou JPG (MAX. 800x400px)</p>
                              </div>
                          </template>
                          <template x-if="logoPreview">
                              <div class="absolute inset-0 flex items-center justify-center">
                                  <img :src="logoPreview" class="object-contain max-w-full max-h-full" alt="Aperçu du logo">
                                  <button @click.prevent="removeLogo" type="button" class="absolute p-1 text-white bg-red-500 rounded-full top-2 right-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                      </svg>
                                  </button>
                              </div>
                          </template>
                          <input id="hotel_logo" name="hotel_logo" type="file" class="hidden" accept="image/*" @change="handleLogoUpload" required />
                      </label>
                  </div>
                  <p class="mt-1 text-sm text-gray-500">Uploader un logo clair et de haute qualité représentant votre hôtel.</p>
              </div>
              
              <!-- Nom de l'hôtel -->
              <div class="mb-6">
                  <label for="hotel_name" class="block mb-2 text-sm font-medium text-gray-900">
                      Nom de l'hôtel <span class="text-red-500">*</span>
                  </label>
                  <input type="text" id="hotel_name" name="hotel_name" x-model="formData.hotelName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Entrez le nom de l'hôtel" required>
              </div>
              
              <!-- Email et Téléphone du manager -->
              <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                  <div>
                      <label for="manager_email" class="block mb-2 text-sm font-medium text-gray-900">
                          Email du manager <span class="text-red-500">*</span>
                      </label>
                      <input type="email" id="manager_email" name="manager_email" x-model="formData.managerEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="manager@exemple.com" required>
                      <p x-show="errors.email" x-text="errors.email" class="mt-1 text-sm text-red-600"></p>
                  </div>
                  <div>
                      <label for="manager_phone" class="block mb-2 text-sm font-medium text-gray-900">
                          Téléphone du manager <span class="text-red-500">*</span>
                      </label>
                      <input type="tel" id="manager_phone" name="manager_phone" x-model="formData.managerPhone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="+33 6 12 34 56 78" required>
                      <p x-show="errors.phone" x-text="errors.phone" class="mt-1 text-sm text-red-600"></p>
                  </div>
              </div>
              
              <!-- Sélection de la ville -->
              <div class="mb-6">
                  <label for="city" class="block mb-2 text-sm font-medium text-gray-900">
                      Ville <span class="text-red-500">*</span>
                  </label>
                  <select id="city" name="city" x-model="formData.city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                      <option value="" selected disabled>Sélectionnez une ville</option>
                      <option value="paris">Paris</option>
                      <option value="lyon">Lyon</option>
                      <option value="marseille">Marseille</option>
                      <option value="toulouse">Toulouse</option>
                      <option value="nice">Nice</option>
                      <option value="nantes">Nantes</option>
                      <option value="strasbourg">Strasbourg</option>
                      <option value="montpellier">Montpellier</option>
                      <option value="bordeaux">Bordeaux</option>
                      <option value="lille">Lille</option>
                  </select>
              </div>
              
              <!-- Description -->
              <div class="mb-6">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900">
                      Description <span class="text-red-500">*</span>
                  </label>
                  <textarea id="description" name="description" rows="4" x-model="formData.description" @input="countWords" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Décrivez votre hôtel, ses caractéristiques uniques et ce que les clients peuvent attendre..." required></textarea>
                  <div class="flex justify-between mt-1">
                      <p class="text-sm text-gray-500">Maximum 300 mots</p>
                      <p class="text-sm" :class="wordCount > 300 ? 'text-red-600' : 'text-gray-500'">
                          <span x-text="wordCount"></span>/300 mots
                      </p>
                  </div>
              </div>
              
              <!-- Géolocalisation -->
              <div class="mb-6">
                  <label for="geolocation" class="block mb-2 text-sm font-medium text-gray-900">
                      Adresse/Géolocalisation <span class="text-red-500">*</span>
                  </label>
                  <div class="flex">
                      <input type="text" id="geolocation" name="geolocation" x-model="formData.geolocation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Entrez l'adresse complète ou les coordonnées" required>
                      <button type="button" class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-l-0 border-gray-300 rounded-r-lg hover:bg-gray-300">
                          <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                              <path d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                          </svg>
                      </button>
                  </div>
                  <p class="mt-1 text-sm text-gray-500">Entrez l'adresse complète ou les coordonnées GPS de votre hôtel</p>
              </div>
              
              <!-- Services -->
              <div class="mb-6">
                  <label class="block mb-2 text-sm font-medium text-gray-900">
                      Services & Équipements
                  </label>
                  <div class="flex flex-wrap items-center gap-2 mb-3" id="services-container">
                      <template x-for="(service, index) in formData.services" :key="index">
                          <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full flex items-center">
                              <span x-text="service"></span>
                              <button @click="removeService(index)" type="button" class="ml-1 text-blue-800 hover:text-blue-900 focus:outline-none">
                                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                  </svg>
                              </button>
                          </span>
                      </template>
                  </div>
                  <div class="flex">
                      <input type="text" id="service_input" x-model="newService" @keydown.enter.prevent="addService" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ajouter un service (ex: WiFi, Piscine, Spa)">
                      <button type="button" @click="addService" class="inline-flex items-center px-3 text-sm text-white bg-blue-600 border border-blue-600 rounded-r-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                          </svg>
                      </button>
                  </div>
                  <p class="mt-1 text-sm text-gray-500">Ajoutez jusqu'à 10 services ou équipements proposés par votre hôtel</p>
                  <p x-show="errors.services" x-text="errors.services" class="mt-1 text-sm text-red-600"></p>
              </div>
              
              <!-- Upload des bannières -->
              <div class="mb-8">
                  <label class="block mb-2 text-sm font-medium text-gray-900">
                      Bannières de l'hôtel <span class="text-red-500">*</span>
                  </label>
                  <p class="mb-3 text-sm text-gray-500">Uploader 3 images de haute qualité montrant votre hôtel (vue principale, chambres, équipements)</p>
                  
                  <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                      <!-- Bannière 1 -->
                      <div class="relative">
                          <label for="banner_1" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                              :class="{'border-blue-500 bg-blue-50': bannerPreviews[0]}">
                              <template x-if="!bannerPreviews[0]">
                                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                      <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                      </svg>
                                      <p class="text-xs text-gray-500">Vue principale</p>
                                  </div>
                              </template>
                              <template x-if="bannerPreviews[0]">
                                  <div class="absolute inset-0">
                                      <img :src="bannerPreviews[0]" class="object-cover w-full h-full" alt="Aperçu de la bannière">
                                      <button @click.prevent="removeBanner(0)" type="button" class="absolute p-1 text-white bg-red-500 rounded-full top-2 right-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                          </svg>
                                      </button>
                                  </div>
                              </template>
                              <input id="banner_1" name="banner_1" type="file" class="hidden" accept="image/*" @change="handleBannerUpload($event, 0)" required />
                          </label>
                          <span class="absolute -top-2 left-2 bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">1</span>
                      </div>
                      
                      <!-- Bannière 2 -->
                      <div class="relative">
                          <label for="banner_2" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                              :class="{'border-blue-500 bg-blue-50': bannerPreviews[1]}">
                              <template x-if="!bannerPreviews[1]">
                                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                      <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                      </svg>
                                      <p class="text-xs text-gray-500">Chambres</p>
                                  </div>
                              </template>
                              <template x-if="bannerPreviews[1]">
                                  <div class="absolute inset-0">
                                      <img :src="bannerPreviews[1]" class="object-cover w-full h-full" alt="Aperçu de la bannière">
                                      <button @click.prevent="removeBanner(1)" type="button" class="absolute p-1 text-white bg-red-500 rounded-full top-2 right-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                          </svg>
                                      </button>
                                  </div>
                              </template>
                              <input id="banner_2" name="banner_2" type="file" class="hidden" accept="image/*" @change="handleBannerUpload($event, 1)" required />
                          </label>
                          <span class="absolute -top-2 left-2 bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">2</span>
                      </div>
                      
                      <!-- Bannière 3 -->
                      <div class="relative">
                          <label for="banner_3" class="relative flex flex-col items-center justify-center w-full h-40 overflow-hidden border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                              :class="{'border-blue-500 bg-blue-50': bannerPreviews[2]}">
                              <template x-if="!bannerPreviews[2]">
                                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                      <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                      </svg>
                                      <p class="text-xs text-gray-500">Équipements</p>
                                  </div>
                              </template>
                              <template x-if="bannerPreviews[2]">
                                  <div class="absolute inset-0">
                                      <img :src="bannerPreviews[2]" class="object-cover w-full h-full" alt="Aperçu de la bannière">
                                      <button @click.prevent="removeBanner(2)" type="button" class="absolute p-1 text-white bg-red-500 rounded-full top-2 right-2 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                          </svg>
                                      </button>
                                  </div>
                              </template>
                              <input id="banner_3" name="banner_3" type="file" class="hidden" accept="image/*" @change="handleBannerUpload($event, 2)" required />
                          </label>
                          <span class="absolute -top-2 left-2 bg-blue-500 text-white text-xs font-medium px-2.5 py-0.5 rounded">3</span>
                      </div>
                  </div>
              </div>
              
              <!-- Bouton de soumission -->
              <div class="flex justify-end">
                  <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                      </svg>
                      Enregistrer l'hôtel
                  </button>
              </div>
          </form>
      </div>
  </div>
  </x-admin.dashboard-panel>
  
  <!-- Alpine.js Form Logic -->
  <script>
    function hotelForm() {
        return {
            formData: {
                hotelName: '',
                managerEmail: '',
                managerPhone: '',
                city: '',
                description: '',
                geolocation: '',
                services: []
            },
            logoFile: null,
            logoPreview: null,
            bannerFiles: [null, null, null],
            bannerPreviews: [null, null, null],
            newService: '',
            wordCount: 0,
            errors: {
                email: '',
                phone: '',
                services: ''
            },
            
            // Gérer l'upload du logo
            handleLogoUpload(event) {
                const file = event.target.files[0];
                if (!file) return;
                
                // Vérifier le type de fichier
                if (!file.type.match('image.*')) {
                    alert('Veuillez uploader une image valide (JPEG, PNG, SVG)');
                    return;
                }
                
                this.logoFile = file;
                this.logoPreview = URL.createObjectURL(file);
            },
            
            // Supprimer le logo
            removeLogo() {
                this.logoFile = null;
                this.logoPreview = null;
                document.getElementById('hotel_logo').value = '';
            },
            
            // Gérer l'upload des bannières
            handleBannerUpload(event, index) {
                const file = event.target.files[0];
                if (!file) return;
                
                // Vérifier le type de fichier
                if (!file.type.match('image.*')) {
                    alert('Veuillez uploader une image valide (JPEG, PNG)');
                    return;
                }
                
                this.bannerFiles[index] = file;
                this.bannerPreviews[index] = URL.createObjectURL(file);
            },
            
            // Supprimer une bannière
            removeBanner(index) {
                this.bannerFiles[index] = null;
                this.bannerPreviews[index] = null;
                document.getElementById(`banner_${index + 1}`).value = '';
            },
            
            // Ajouter un service
            addService() {
                if (!this.newService.trim()) return;
                
                if (this.formData.services.length >= 10) {
                    this.errors.services = 'Maximum 10 services autorisés';
                    return;
                }
                
                const serviceText = this.newService.trim();
                if (!this.formData.services.includes(serviceText)) {
                    this.formData.services.push(serviceText);
                }
                
                this.newService = '';
                this.errors.services = '';
                
                // Focus sur l'input après ajout
                document.getElementById('service_input').focus();
            },
            
            // Supprimer un service
            removeService(index) {
                this.formData.services.splice(index, 1);
                this.errors.services = '';
            },
            
            // Compter les mots dans la description
            countWords() {
                const text = this.formData.description.trim();
                this.wordCount = text ? text.split(/\s+/).length : 0;
            },
            
            // Valider l'email
            validateEmail() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(this.formData.managerEmail)) {
                    this.errors.email = 'Veuillez entrer une adresse email valide';
                    return false;
                }
                this.errors.email = '';
                return true;
            },
            
            // Valider le téléphone
            validatePhone() {
                const phoneRegex = /^\+?[0-9\s\-()]{10,20}$/;
                if (!phoneRegex.test(this.formData.managerPhone)) {
                    this.errors.phone = 'Veuillez entrer un numéro de téléphone valide';
                    return false;
                }
                this.errors.phone = '';
                return true;
            },
            
            // Soumettre le formulaire
            submitForm() {
                // Valider le formulaire
                const isEmailValid = this.validateEmail();
                const isPhoneValid = this.validatePhone();
                
                // Vérifier le nombre de mots
                if (this.wordCount > 300) {
                    alert('La description dépasse le nombre maximum de mots (300)');
                    return;
                }
                
                // Vérifier si le logo est uploadé
                if (!this.logoFile) {
                    alert('Veuillez uploader un logo pour votre hôtel');
                    return;
                }
                
                // Vérifier qu’au moins une bannière est uploadée
                const hasAtLeastOneBanner = this.bannerFiles.some(Boolean);
                if (!hasAtLeastOneBanner) {
                    alert('Veuillez uploader au moins une bannière');
                    return;
                }

                
                // Si toutes les validations passent
                if (isEmailValid && isPhoneValid) {
                    // Dans une application réelle, vous soumettriez les données du formulaire à votre serveur ici
                    console.log('Formulaire soumis:', {
                        ...this.formData,
                        logo: this.logoFile,
                        banners: this.bannerFiles
                    });
                    
                    // Afficher un message de succès
                    alert('Hôtel ajouté avec succès!');
                    
                    // Réinitialiser le formulaire (optionnel)
                    // this.resetForm();
                }
            },
            
            // Réinitialiser le formulaire
            resetForm() {
                this.formData = {
                    hotelName: '',
                    managerEmail: '',
                    managerPhone: '',
                    city: '',
                    description: '',
                    geolocation: '',
                    services: []
                };
                this.logoFile = null;
                this.logoPreview = null;
                this.bannerFiles = [null, null, null];
                this.bannerPreviews = [null, null, null];
                this.newService = '';
                this.wordCount = 0;
                this.errors = {
                    email: '',
                    phone: '',
                    services: ''
                };
                
                // Réinitialiser les inputs de fichier
                document.getElementById('hotel_logo').value = '';
                document.getElementById('banner_1').value = '';
                document.getElementById('banner_2').value = '';
                document.getElementById('banner_3').value = '';
            }
        }
    }
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
  </script>
