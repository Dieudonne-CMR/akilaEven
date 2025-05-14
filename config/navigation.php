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
            'route' => 'site.locations',
            'text' => 'Locations',
            'active' => ['site.locations']
        ],
        [
            'route' => 'site.sallesfetes',
            'text' => 'Salles de fêtes',
            'active' => ['site.sallesfetes']
        ],
        [
          
            'route' => 'site.about',
            'text' => 'À propos',
            'active' => ['site.about'] // Support des wildcards
        ],
        [
            'route' => 'site.contact',
            'text' => 'Contact',
            'active' => ['site.contact']
        ]
    ],
    
    // Liens pour la sidebar admin
    'admin_links' => [
        [
            'route' => 'admin.dashboard',
            'text' => 'Dashboard',
            'icon' => 'layout-dashboard',
            'active' => ['admin.dashboard']
        ],
        [
            'route' => 'admin.agences',
            'text' => 'Agences',
            'icon' => 'building-2',
            'active' => ['admin.agences', 'admin.agence.create', 'admin.agence.edit', 'admin.agence.show'],
            /* 'badge' => [
                'text' => 'Pro',
                'class' => 'bg-gray-100 text-gray-800'
            ] */
        ],
        [
            'route' => 'admin.eventHalls',
            'text' => 'Salles de fête',
            'icon' => 'party-popper',
            'active' => ['admin.eventHalls', 'admin.event-hall.create', 'admin.event-hall.edit', 'admin.event-hall.show'],
           /*  'badge' => [
                'text' => '3',
                'class' => 'bg-blue-100 text-blue-800'
            ] */
        ],
        [
            'route' => 'admin.locations.index',
            'text' => 'Locations',
            'icon' => 'home',
            'active' => ['admin.locations.index', 'admin.location.create', 'admin.location.edit', 'admin.location.show'] 
        ],
        [
            'route' => 'admin.bookings',
            'text' => 'Réservations',
            'icon' => 'ticket-check',
            'active' => ['admin.bookings', 'admin.booking.create', 'admin.booking.edit', 'admin.booking.show']
        ],
        /* [
            'route' => 'admin.products',
            'text' => 'Produits',
            'icon' => 'shopping-bag',
            'active' => ['admin.products']
        ],
        [
            'route' => 'admin.login',
            'text' => 'Connexion',
            'icon' => 'log-in',
            'active' => ['admin.login']
        ],
        [
            'route' => 'admin.register',
            'text' => 'Inscription',
            'icon' => 'clipboard-signature',
            'active' => ['admin.register']
        ] */
    ]
];