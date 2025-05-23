@props(['location'])

<div class="mb-8">
    <h2 class="mb-4 text-xl font-semibold">Localisation</h2>
    <div class="overflow-hidden bg-gray-200 rounded-lg aspect-video">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15918.41622567714!2d{{ rand(95, 99)/10 }}!3d{{ rand(35, 45)/10 }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2scm!4v1701126171189!5m2!1sfr!2scm" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div> 