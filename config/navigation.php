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
            'route' => 'admin.hotels',
            'text' => 'Hotels',
            'icon' => 'hotel',
            'active' => ['admin.hotels'],
            'badge' => [
                'text' => 'Pro',
                'class' => 'bg-gray-100 text-gray-800'
            ]
        ],
        [
            'route' => 'admin.eventHalls',
            'text' => 'Salles de fête',
            'icon' => 'party-popper',
            'active' => ['admin.eventHalls'],
            'badge' => [
                'text' => '3',
                'class' => 'bg-blue-100 text-blue-800'
            ]
        ],
        [
            'route' => 'admin.bookings',
            'text' => 'Réservations',
            'icon' => 'ticket-check',
            'active' => ['admin.bookings']
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