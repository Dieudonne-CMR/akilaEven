@props([
    'title' => 'Prêt à organiser votre prochain événement ?',
    'subtitle' => 'Découvrez nos hôtels et salles de fêtes disponibles pour votre prochain événement.',
    'buttonText' => 'Réserver maintenant',
    'buttonUrl' => route('home')
])

<div class="py-5 my-5 text-center text-white cta-section bg-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-3 cta-title">{{ $title }}</h2>
                <p class="mb-4 cta-description">{{ $subtitle }}</p>
                <a href="{{ $buttonUrl }}" class="border-0 theme-btn">
                    {{ $buttonText }}
                    <i class="la la-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.cta-section {
    background: linear-gradient(135deg, #287bff 0%, #2a52be 100%);
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.cta-title {
    font-size: 2.2rem;
    font-weight: 700;
}

.cta-description {
    font-size: 1.1rem;
    opacity: 0.9;
}
</style> 