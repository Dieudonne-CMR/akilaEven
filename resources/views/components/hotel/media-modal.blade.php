@props(['hotel', 'updateRoute'])

<!-- Modal de mise à jour des médias -->
<div id="update-media-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full p-4">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- En-tête de la modal -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Mettre à jour les médias de {{ $hotel->nom_hotel }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="update-media-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fermer</span>
                </button>
            </div>

            <!-- Formulaire -->
            <form action="{{ $updateRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="p-6 space-y-6">
                    <!-- Logo -->
                    <div>
                        <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo de l'hôtel</label>
                        <div class="flex items-center space-x-4">
                            <div class="shrink-0 w-20 h-20 overflow-hidden bg-gray-100 rounded-full">
                                @if($hotel->logo)
                                    <img id="logo-preview" src="{{ asset('storage/' . $hotel->logo) }}" alt="Logo actuel" class="object-cover w-full h-full">
                                @else
                                    <div id="logo-preview" class="flex items-center justify-center w-full h-full text-xl font-bold text-blue-600 bg-blue-100">
                                        @avatarBadge($hotel->nom_hotel)
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="logo" id="logo" accept="image/png,image/jpeg,image/jpg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">PNG, JPG ou JPEG (max. 4 Mo)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bannières -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                        <h4 class="mb-4 text-base font-medium text-gray-900 dark:text-white">Bannières de l'hôtel</h4>
                        
                        <!-- Bannière 1 -->
                        <div class="mb-4">
                            <label for="bannier1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bannière principale</label>
                            <div class="flex items-center space-x-4">
                                <div class="shrink-0 w-32 h-20 overflow-hidden bg-gray-100 rounded-lg">
                                    @if($hotel->bannier1)
                                        <img id="banner1-preview" src="{{ asset('storage/' . $hotel->bannier1) }}" alt="Bannière 1" class="object-cover w-full h-full">
                                    @else
                                        <div id="banner1-preview" class="flex flex-col items-center justify-center w-full h-full text-sm text-gray-400">
                                            <i data-lucide="image" class="w-8 h-8 mb-1"></i>
                                            <span>Aucune image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="bannier1" id="bannier1" accept="image/png,image/jpeg,image/jpg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bannière 2 -->
                        <div class="mb-4">
                            <label for="bannier2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bannière secondaire</label>
                            <div class="flex items-center space-x-4">
                                <div class="shrink-0 w-32 h-20 overflow-hidden bg-gray-100 rounded-lg">
                                    @if($hotel->bannier2)
                                        <img id="banner2-preview" src="{{ asset('storage/' . $hotel->bannier2) }}" alt="Bannière 2" class="object-cover w-full h-full">
                                    @else
                                        <div id="banner2-preview" class="flex flex-col items-center justify-center w-full h-full text-sm text-gray-400">
                                            <i data-lucide="image" class="w-8 h-8 mb-1"></i>
                                            <span>Aucune image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="bannier2" id="bannier2" accept="image/png,image/jpeg,image/jpg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bannière 3 -->
                        <div>
                            <label for="bannier3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bannière additionnelle</label>
                            <div class="flex items-center space-x-4">
                                <div class="shrink-0 w-32 h-20 overflow-hidden bg-gray-100 rounded-lg">
                                    @if($hotel->bannier3)
                                        <img id="banner3-preview" src="{{ asset('storage/' . $hotel->bannier3) }}" alt="Bannière 3" class="object-cover w-full h-full">
                                    @else
                                        <div id="banner3-preview" class="flex flex-col items-center justify-center w-full h-full text-sm text-gray-400">
                                            <i data-lucide="image" class="w-8 h-8 mb-1"></i>
                                            <span>Aucune image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="bannier3" id="bannier3" accept="image/png,image/jpeg,image/jpg" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer de la modal -->
                <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Enregistrer
                    </button>
                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" data-modal-hide="update-media-modal">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Prévisualisation du logo
        const logoInput = document.getElementById('logo');
        const logoPreview = document.getElementById('logo-preview');
        
        if (logoInput && logoPreview) {
            logoInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (logoPreview.tagName.toLowerCase() === 'img') {
                            logoPreview.src = e.target.result;
                        } else {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Logo preview';
                            img.id = 'logo-preview';
                            img.className = 'object-cover w-full h-full';
                            logoPreview.parentNode.replaceChild(img, logoPreview);
                        }
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        }
        
        // Prévisualisations des bannières
        function setupPreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            
            if (input && preview) {
                input.addEventListener('change', function(e) {
                    if (e.target.files.length > 0) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            if (preview.tagName.toLowerCase() === 'img') {
                                preview.src = e.target.result;
                            } else {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.alt = 'Banner preview';
                                img.id = previewId;
                                img.className = 'object-cover w-full h-full';
                                preview.parentNode.replaceChild(img, preview);
                            }
                        }
                        reader.readAsDataURL(e.target.files[0]);
                    }
                });
            }
        }
        
        setupPreview('bannier1', 'banner1-preview');
        setupPreview('bannier2', 'banner2-preview');
        setupPreview('bannier3', 'banner3-preview');
    });
</script>
@endpush
@endonce 