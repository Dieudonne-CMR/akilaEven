@props(['errors' => null])

<div class="p-6 bg-white rounded-lg shadow-sm lg:sticky lg:top-8">
    <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-900">
        <i data-lucide="image" class="w-5 h-5 mr-2 text-blue-600"></i>
        Images de la Location
    </h2>
    
    <!-- Main Image Upload -->
    <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-700">Image Principale <span class="text-red-500">*</span></label>
        <div 
            class="relative p-6 text-center transition-colors border-2 rounded-lg cursor-pointer hover:bg-gray-50 {{ session()->has('errors') && session('errors')->has('photo') ? 'border-red-500' : 'border-gray-300 border-dashed' }}"
            x-data="{ mainImagePreview: null }"
            x-on:click="$refs.mainImageInput.click()"
            :class="mainImagePreview ? 'border-blue-500' : ''"
        >
            <template x-if="!mainImagePreview">
                <div>
                    <i data-lucide="upload-cloud" class="w-12 h-12 mx-auto text-gray-400"></i>
                    <p class="mt-2 text-sm text-gray-600">Cliquez pour télécharger <span class="font-medium text-blue-600">ou glissez-déposez</span></p>
                    <p class="mt-1 text-xs text-gray-500">PNG, JPG ou JPEG (max. 4MB)</p>
                </div>
            </template>
            <template x-if="mainImagePreview">
                <div class="relative w-full overflow-hidden rounded-lg aspect-video">
                    <img :src="mainImagePreview" alt="Image preview" class="object-cover w-full h-full">
                    <button 
                        @click.stop="mainImagePreview = null; $refs.mainImageInput.value = ''" 
                        class="absolute top-2 right-2 p-1.5 bg-red-600 text-white rounded-full hover:bg-red-700 focus:outline-none"
                    >
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </template>
            <input 
                x-ref="mainImageInput" 
                type="file" 
                name="photo"
                accept="image/jpeg,image/png,image/jpg" 
                class="hidden" 
                @change="
                    const file = $event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            mainImagePreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                "
                required
            >
        </div>
        @error('photo')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <!-- Additional Images Upload -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Images Additionnelles</label>
        <div class="grid grid-cols-2 gap-4">
            @for($i = 0; $i < 3; $i++)
            <div
                x-data="{ 
                    preview: null,
                    showImage(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.preview = e.target.result;
                                lucide.createIcons();
                            };
                            reader.readAsDataURL(file);
                        }
                    },
                    clearImage() {
                        this.preview = null;
                        this.$refs.fileInput.value = '';
                    }
                }"
                class="relative flex items-center justify-center transition-colors border-2 border-gray-300 border-dashed rounded-lg cursor-pointer aspect-square hover:bg-gray-50 {{ session()->has('errors') && session('errors')->has('additional_images.'.$i) ? 'border-red-500' : '' }}"
                :class="preview ? 'border-blue-500' : ''"
                @click="$refs.fileInput.click()"
            >
                <template x-if="!preview">
                    <div class="text-center">
                        <i data-lucide="image-plus" class="w-8 h-8 mx-auto text-gray-400"></i>
                        <p class="mt-1 text-xs text-gray-500">Photo {{ $i + 1 }}</p>
                    </div>
                </template>
                <template x-if="preview">
                    <div class="relative w-full h-full">
                        <img :src="preview" alt="Additional image preview" class="object-cover w-full h-full rounded-lg">
                        <button 
                            @click.stop="clearImage" 
                            class="absolute p-1 text-white bg-red-600 rounded-full top-2 right-2 hover:bg-red-700 focus:outline-none"
                        >
                            <i data-lucide="x" class="w-3 h-3"></i>
                        </button>
                    </div>
                </template>
                <input 
                    x-ref="fileInput" 
                    type="file" 
                    name="additional_images[]"
                    accept="image/jpeg,image/png,image/jpg" 
                    class="hidden" 
                    @change="showImage"
                >
            </div>
            @endfor
        </div>
        @if(session()->has('errors') && (
            session('errors')->has('additional_images') || 
            session('errors')->has('additional_images.0') || 
            session('errors')->has('additional_images.1') || 
            session('errors')->has('additional_images.2') || 
            session('errors')->has('additional_images.3')
        ))
            <p class="mt-1 text-sm text-red-600">
                @if(session('errors')->has('additional_images'))
                    {{ session('errors')->first('additional_images') }}
                @else
                    Veuillez vérifier le format et la taille des images additionnelles.
                @endif
            </p>
        @endif
    </div>
</div>