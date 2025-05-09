@props(['agence', 'villes'])

<div class="grid gap-6">
    <!-- Informations de base -->
    <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
        <h3 class="text-lg font-medium text-gray-900">Informations de base</h3>
        <p class="mt-1 text-sm text-gray-600">Ces informations sont nécessaires pour créer une nouvelle location.</p>
        
        <!-- Nom de la location -->
        <div class="my-6">
            <label for="nom_location" class="block text-sm font-medium text-gray-700">Nom de la location</label>
            <input type="text" name="nom_location" id="nom_location" value="{{ old('nom_location') }}" class="block w-full px-3 py-2 mt-1 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            @error('nom_location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>            
        <div class="grid gap-6 sm:grid-cols-2">

            <!-- Type de location -->
            <div>
                <label for="type_location" class="block text-sm font-medium text-gray-700">Type de location</label>
                <select name="type_location" id="type_location" class="block w-full px-3 py-2 mt-1 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Sélectionner un type</option>
                    @foreach(\App\Models\Location::TYPE_LOCATION as $type)
                        <option value="{{ $type }}" {{ old('type_location') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
                @error('type_location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type de logement -->
            <div>
                <label for="type_logement" class="block text-sm font-medium text-gray-700">Type de logement</label>
                <select name="type_logement" id="type_logement" x-data="{}" x-on:change="document.getElementById('prix_unit').textContent = $event.target.value === 'meublé' ? 'FCFA/jour' : 'FCFA/mois'" class="block w-full px-3 py-2 mt-1 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Sélectionner un type</option>
                    @foreach(\App\Models\Location::TYPE_LOGEMENT as $type)
                        <option value="{{ $type }}" {{ old('type_logement') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
                @error('type_logement')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Surface -->
            <div>
                <label for="area" class="block text-sm font-medium text-gray-700">Surface (m²)</label>
                <input type="text" name="area" id="area" value="{{ old('area') }}" min="1" step="0.01" class="block w-full px-3 py-2 mt-1 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                @error('area')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prix -->
            <div>
                <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                <div class="relative mt-1 rounded-lg">
                    <input type="text" name="prix" id="prix" value="{{ old('prix') }}" min="1" step="0.01" class="block w-full px-3 py-2 pr-12 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <span id="prix_unit" class="text-sm text-gray-500">FCFA/jour</span>
                    </div>
                </div>
                @error('prix')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Localisation -->
    <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
        <h3 class="text-lg font-medium text-gray-900">Localisation</h3>
        <div class="grid gap-6 mt-6 sm:grid-cols-2">
          <!-- Adresse -->
          <div class="">
            <label for="localisation" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input type="text" name="localisation" id="localisation" value="{{ old('localisation') }}" class="block w-full px-3 py-2 mt-1 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            @error('localisation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
           <!-- Ville -->
            <div>
              <label for="ville_id" class="block text-sm font-medium text-gray-700">Ville</label>
              <select name="ville_id" id="ville_id" class="block w-full px-3 py-2 mt-1 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                  <option value="">Sélectionner une ville</option>
                  @foreach($villes as $ville)
                      <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                          {{ $ville->nom }}
                      </option>
                  @endforeach
              </select>
              @error('ville_id')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
          </div>
        </div>
        
       
    </div>

    <!-- Description -->
    <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
        <h3 class="text-lg font-medium text-gray-900">Description</h3>
        <div class="mt-6">
            <label for="description_location" class="block text-sm font-medium text-gray-700">Description détaillée</label>
            <textarea name="description_location" id="description_location" rows="4" class="block w-full px-3 py-2 mt-1 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description_location') }}</textarea>
            @error('description_location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Équipements -->
    <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
        <h3 class="text-lg font-medium text-gray-900">Équipements</h3>
        <div class="mt-6">
            <div x-data="{ 
                equipments: {{ old('equipments') ? json_encode(old('equipments')) : '[]' }}, 
                newEquipment: '',
                addEquipment() {
                    if (this.newEquipment.trim() && this.equipments.length < 10) {
                        this.equipments.push(this.newEquipment.trim());
                        this.newEquipment = '';
                        this.$nextTick(() => lucide.createIcons());
                    }
                },
                removeEquipment(index) {
                    this.equipments.splice(index, 1);
                    this.$nextTick(() => lucide.createIcons());
                }
            }">
                <label for="equipment-input" class="block mb-2 text-sm font-medium text-gray-700">Équipements (max 10)</label>
                <div class="mb-3">                          
                    <div class="flex">
                        <input 
                            type="text" 
                            id="equipment-input" 
                            x-model="newEquipment" 
                            @keydown.enter.prevent="addEquipment()" 
                            class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('equipments') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            placeholder="Tapez et appuyez sur Entrée pour ajouter"
                            :disabled="equipments.length >= 10"
                        >
                        <button 
                            type="button" 
                            @click="addEquipment()" 
                            :disabled="equipments.length >= 10"
                            class="inline-flex items-center px-3 text-sm text-white bg-blue-600 border border-blue-600 rounded-r-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 disabled:opacity-50"
                        >
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mb-2">
                    <template x-for="(equipment, index) in equipments" :key="index">
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">
                            <span x-text="equipment"></span>
                            <input type="hidden" name="equipments[]" :value="equipment">
                            <button 
                                type="button" 
                                @click="removeEquipment(index)" 
                                class="inline-flex items-center justify-center w-4 h-4 ml-2 text-blue-400 rounded-full hover:bg-blue-200 hover:text-blue-900 focus:outline-none"
                            >
                                <i data-lucide="x" class="w-3 h-3"></i>
                                <span class="sr-only">Retirer</span>
                            </button>
                        </span>
                    </template>
                </div>
                <p class="text-xs text-gray-500">
                    <span x-text="equipments.length"></span>/10 équipements ajoutés
                </p>
                @if(session()->has('errors') && session('errors')->has('equipments'))
                    <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('equipments') }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Règlement -->
    <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
        <h3 class="text-lg font-medium text-gray-900">Règlement</h3>
        <div class="mt-6">
            <div id="hs-editor-tiptap" class="border border-gray-300 rounded-lg">
                <div class="flex items-center gap-x-1 border-b border-gray-300 bg-gray-50 px-2 py-1.5">
                    <button data-hs-editor-bold type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="bold" class="w-4 h-4"></i>
                    </button>
                    <button data-hs-editor-italic type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="italic" class="w-4 h-4"></i>
                    </button>
                    <button data-hs-editor-underline type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="underline" class="w-4 h-4"></i>
                    </button>
                    <button data-hs-editor-strike type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="strikethrough" class="w-4 h-4"></i>
                    </button>
                    <button data-hs-editor-link type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="link" class="w-4 h-4"></i>
                    </button>
                    <button data-hs-editor-ol type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="list-ordered" class="w-4 h-4"></i>
                    </button>
                    <button data-hs-editor-ul type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="list" class="w-4 h-4"></i>
                    </button>
                    <button data-hs-editor-blockquote type="button" class="inline-flex items-center justify-center w-8 h-8 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                        <i data-lucide="quote" class="w-4 h-4"></i>
                    </button>
                </div>
                <div data-hs-editor-field class="p-3 min-h-[200px]"></div>
                <input type="hidden" name="rules" id="rules-content">
            </div>
            @error('rules')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div> 