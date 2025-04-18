@props([
    'size' => 'normal',
    'centered' => false,
    'networks' => [
        [
            'name' => 'Facebook',
            'icon' => 'la la-facebook',
            'url' => 'https://facebook.com/',
            'color' => '#3b5998'
        ],
        [
            'name' => 'Twitter',
            'icon' => 'la la-twitter',
            'url' => 'https://twitter.com/',
            'color' => '#1da1f2'
        ],
        [
            'name' => 'Instagram',
            'icon' => 'la la-instagram',
            'url' => 'https://instagram.com/',
            'color' => '#c32aa3'
        ],
        [
            'name' => 'LinkedIn',
            'icon' => 'la la-linkedin',
            'url' => 'https://linkedin.com/',
            'color' => '#0a66c2'
        ],
        [
            'name' => 'YouTube',
            'icon' => 'la la-youtube',
            'url' => 'https://youtube.com/',
            'color' => '#ff0000'
        ]
    ]
])

<div class="social-media-links {{ $centered ? 'text-center' : '' }}">
    <h4 class="mb-3">Suivez-nous</h4>
    <ul class="mb-0 list-inline">
        @foreach($networks as $network)
            <li class="list-inline-item me-2">
                <a 
                    href="{{ $network['url'] }}" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="social-icon-link {{ $size === 'large' ? 'social-icon-link-lg' : '' }}"
                    style="background-color: {{ $network['color'] }};"
                    aria-label="{{ $network['name'] }}"
                    title="{{ $network['name'] }}"
                >
                    <i class="{{ $network['icon'] }}"></i>
                </a>
            </li>
        @endforeach
    </ul>
</div>
<style>
    .social-icon-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: white;
        transition: all 0.3s ease;
    }
    
    .social-icon-link:hover {
        opacity: 0.8;
        transform: translateY(-3px);
        color: white;
    }
    
    .social-icon-link-lg {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
</style> 
{{-- Styles supprimés et déplacés dans un fichier CSS séparé --}} 