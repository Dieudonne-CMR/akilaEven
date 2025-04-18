@props([
    'adresse' => '123 Avenue des Hôtels, Paris, France',
    'telephone' => '+33 123 456 789',
    'email' => 'contact@hotel-booking.com',
    'horaires' => [
        'Lundi - Vendredi: 9h00 - 18h00',
        'Samedi: 10h00 - 17h00',
        'Dimanche: Fermé'
    ]
])

<div class="contact-info-container">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="info-box">
                <h4 class="info-box-title"><i class="la la-map-marker text-primary me-2"></i>Adresse</h4>
                <p class="info-box-desc">{{ $adresse }}</p>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="info-box">
                <h4 class="info-box-title"><i class="la la-phone text-primary me-2"></i>Téléphone</h4>
                <p class="info-box-desc">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $telephone) }}" class="d-block text-decoration-none">
                        {{ $telephone }}
                    </a>
                </p>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="info-box">
                <h4 class="info-box-title"><i class="la la-envelope text-primary me-2"></i>Email</h4>
                <p class="info-box-desc">
                    <a href="mailto:{{ $email }}" class="d-block text-decoration-none">
                        {{ $email }}
                    </a>
                </p>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="info-box">
                <h4 class="info-box-title"><i class="la la-clock text-primary me-2"></i>Horaires d'ouverture</h4>
                <ul class="list-unstyled">
                    @foreach($horaires as $horaire)
                        <li class="mb-2">{{ $horaire }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div> 