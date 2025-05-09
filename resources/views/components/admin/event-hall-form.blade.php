@props(['agence', 'villes' => []])

<div class="p-6 bg-white rounded-lg shadow-sm">
    <h2 class="flex items-center mb-6 text-xl font-semibold text-gray-900">
        <i data-lucide="clipboard-list" class="w-5 h-5 mr-2 text-blue-600"></i>
        Informations de la Salle
    </h2>
    
    <div class="space-y-6">
        <!-- Name -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nom de la Salle <span class="text-red-500">*</span></label>
            <div class="relative">                          
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('name') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required
                >
            </div>
            @if(session()->has('errors') && session('errors')->has('name'))
                <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('name') }}</p>
            @endif
        </div>
        
        <!-- Ville et Localisation -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Ville -->
            <div>
                <label for="ville_id" class="block mb-2 text-sm font-medium text-gray-700">Ville <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="building" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <select 
                        id="ville_id" 
                        name="ville_id" 
                        class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('ville_id') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                        required
                    >
                        <option value="" selected disabled>Sélectionner une ville</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </div>
                @if(session()->has('errors') && session('errors')->has('ville_id'))
                    <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('ville_id') }}</p>
                @endif
            </div>
            
            <!-- Localisation -->
            <div>
                <label for="location" class="block mb-2 text-sm font-medium text-gray-700">Adresse/Emplacement précis <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="map-pin" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        value="{{ old('location') }}"
                        class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('location') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                        placeholder="ex: Quartier, rue, etc."
                        required
                    >
                </div>
                @if(session()->has('errors') && session('errors')->has('location'))
                    <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('location') }}</p>
                @endif
            </div>
        </div>
        
        <!-- Capacity, Surface Area, Price -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Capacity -->
            <div>
                <label for="capacity" class="block mb-2 text-sm font-medium text-gray-700">Capacité <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="users" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input 
                        type="number"
                        id="capacity" 
                        name="capacity"
                        value="{{ old('capacity') }}"
                        class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('capacity') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" 
                        placeholder="ex: 150"                                  
                        required
                    >
                </div>
                @if(session()->has('errors') && session('errors')->has('capacity'))
                    <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('capacity') }}</p>
                @endif
            </div>
            
            <!-- Surface Area -->
            <div>
                <label for="area" class="block mb-2 text-sm font-medium text-gray-700">Surface <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="square" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input 
                        type="number"
                        step="0.01"
                        id="area" 
                        name="area"
                        value="{{ old('area') }}" 
                        class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('area') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 p-2.5" 
                        placeholder="ex: 200"                                 
                        required
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <span class="text-gray-500">m²</span>
                    </div>
                </div>
                @if(session()->has('errors') && session('errors')->has('area'))
                    <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('area') }}</p>
                @endif
            </div>
            
            <!-- Price -->
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-700">Prix <span class="text-red-500">*</span></label>
                <div class="relative">     
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="banknote" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input
                        type="number"
                        step="0.01"
                        id="price" 
                        name="price"
                        value="{{ old('price') }}" 
                        class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('price') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-24 p-2.5"
                        placeholder="ex: 50000"
                        required
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <span class="text-gray-500">FCFA / jour</span>
                    </div>
                </div>
                @if(session()->has('errors') && session('errors')->has('price'))
                    <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('price') }}</p>
                @endif
            </div>
        </div>
        
        <!-- Amenities -->
        <div x-data="{ 
            amenities: {{ old('amenities') ? json_encode(old('amenities')) : '[]' }}, 
            newAmenity: '',
            addAmenity() {
                if (this.newAmenity.trim() && this.amenities.length < 10) {
                    this.amenities.push(this.newAmenity.trim());
                    this.newAmenity = '';
                    this.$nextTick(() => lucide.createIcons());
                }
            },
            removeAmenity(index) {
                this.amenities.splice(index, 1);
                this.$nextTick(() => lucide.createIcons());
            }
        }">
            <label for="amenity-input" class="block mb-2 text-sm font-medium text-gray-700">Équipements (max 10)</label>
            <div class="mb-3">                          
                <div class="flex">
                    <input 
                        type="text" 
                        id="amenity-input" 
                        x-model="newAmenity" 
                        @keydown.enter.prevent="addAmenity()" 
                        class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('amenities') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                        placeholder="Tapez et appuyez sur Entrée pour ajouter"
                        :disabled="amenities.length >= 10"
                    >
                    <button 
                        type="button" 
                        @click="addAmenity()" 
                        :disabled="amenities.length >= 10"
                        class="inline-flex items-center px-3 text-sm text-white bg-blue-600 border border-blue-600 rounded-r-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 disabled:opacity-50"
                    >
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
            <div class="flex flex-wrap gap-2 mb-2">
                <template x-for="(amenity, index) in amenities" :key="index">
                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">
                        <span x-text="amenity"></span>
                        <input type="hidden" name="amenities[]" :value="amenity">
                        <button 
                            type="button" 
                            @click="removeAmenity(index)" 
                            class="inline-flex items-center justify-center w-4 h-4 ml-2 text-blue-400 rounded-full hover:bg-blue-200 hover:text-blue-900 focus:outline-none"
                        >
                            <i data-lucide="x" class="w-3 h-3"></i>
                            <span class="sr-only">Retirer</span>
                        </button>
                    </span>
                </template>
            </div>
            <p class="text-xs text-gray-500">
                <span x-text="amenities.length"></span>/10 équipements ajoutés
            </p>
            @if(session()->has('errors') && session('errors')->has('amenities'))
                <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('amenities') }}</p>
            @endif
        </div>
        
        <!-- Description -->
        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
            <textarea 
                id="description" 
                name="description" 
                rows="4" 
                class="bg-gray-50 border {{ session()->has('errors') && session('errors')->has('description') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                placeholder="Décrivez la salle en détail..."
                required
            >{{ old('description') }}</textarea>
            @if(session()->has('errors') && session('errors')->has('description'))
                <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('description') }}</p>
            @endif
        </div>
        
        <!-- Rules -->
        <div>
            <label for="rules" class="block mb-2 text-sm font-medium text-gray-700">Règles <span class="text-red-500">*</span></label>
            <!-- Tiptap Editor -->
            <div class="overflow-hidden bg-white border border-gray-200 rounded-xl {{ session()->has('errors') && session('errors')->has('rules') ? 'border-red-500' : '' }}">
                <div id="hs-editor-tiptap">
                    <div class="sticky top-0 flex align-middle gap-x-0.5 border-b border-gray-200 p-2 bg-white">
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-bold="">
                            <i data-lucide="bold" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-italic="">
                            <i data-lucide="italic" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-underline="">
                            <i data-lucide="underline" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-strike="">
                            <i data-lucide="strikethrough" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-link="">
                            <i data-lucide="link" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ol="">
                            <i data-lucide="list-ordered" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-ul="">
                            <i data-lucide="list" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-blockquote="">
                            <i data-lucide="quote" class="w-4 h-4"></i>
                        </button>
                        <button class="inline-flex items-center justify-center text-sm font-semibold text-gray-800 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" type="button" data-hs-editor-code="">
                            <i data-lucide="code" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="h-40 overflow-auto" data-hs-editor-field=""></div>
                    <input type="hidden" name="rules" id="rules-content" value="{{ old('rules') }}">
                </div>
            </div>
            @if(session()->has('errors') && session('errors')->has('rules'))
                <p class="mt-1 text-sm text-red-600">{{ session('errors')->first('rules') }}</p>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-4">
            <button 
                type="submit" 
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
            >
                <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                Enregistrer la Salle
            </button>
        </div>
    </div>
</div> 
