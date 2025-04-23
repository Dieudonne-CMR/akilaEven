<?php

return [
    'links' => [
        [
            'route' => 'home',
            'text' => 'Accueil',
            'icon' => 'home', // Optionnel
            'active' => ['home'] // Routes qui activent ce lien
        ],
        [
            'route' => 'site.bl-rooms.rooms',
            'text' => 'Chambres d\'hôtel',
            'active' => ['site.bl-rooms.rooms']
        ],
        [
            'route' => 'site.sallesfetes',
            'text' => 'Salles de fêtes',
            'active' => ['site.sallesfetes']
        ],
        [
          
            'route' => 'site.bl-about.about',
            'text' => 'À propos',
            'active' => ['site.bl-about.about'] // Support des wildcards
        ],
        [
            'route' => 'site.bl-contact.contact',
            'text' => 'Contact',
            'active' => ['site.bl-contact.contact']
        ]
    ]
];