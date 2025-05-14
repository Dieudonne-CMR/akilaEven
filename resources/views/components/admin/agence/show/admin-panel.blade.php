@props(['agence'])

<div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900 dark:text-white">
        <i data-lucide="plus-circle" class="w-5 h-5 mr-2 text-blue-600"></i>
        Administration
    </h2>
    
    <div class="space-y-4">
        <a href="{{ route('locations.create', $agence) }}" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
            <i data-lucide="bed" class="w-4 h-4 mr-2"></i>
            Ajouter une location
        </a>
        
        <a href="{{ route('admin.event-hall.create', $agence) }}" class="w-full text-white bg-purple-600 hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
            <i data-lucide="landmark" class="w-4 h-4 mr-2"></i>
            Ajouter une salle de fête
        </a>
        
        <button 
            type="button" 
            class="w-full text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center"
            data-modal-target="update-agence-modal"
            data-modal-toggle="update-agence-modal"
        >
            <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
            Paramètres de l'agence
        </button>
    </div>
    
    <div class="mt-6">
        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Localisation</h3>
        <div class="overflow-hidden border border-gray-200 rounded-lg h-[200px] dark:border-gray-700">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215053348743!2d-73.97686532342224!3d40.75790623646392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258e4a1c884e5%3A0x24fe1071086b36d5!2sPark%20Ave%2C%20New%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sca!4v1685123456789!5m2!1sen!2sca" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div> 