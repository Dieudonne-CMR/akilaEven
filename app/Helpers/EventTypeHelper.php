<?php

namespace App\Helpers;

class EventTypeHelper
{
    /**
     * Liste des types d'événements disponibles avec leurs icônes et couleurs
     */
    public static function getEventTypes()
    {
        return [
            'Mariage' => 'Mariage',
            'Anniversaire' => 'Anniversaire',
            'Conférence' => 'Conférence',
            'Séminaire' => 'Séminaire',
            'Réunion d\'affaires' => 'Réunion d\'affaires',
            'Fête' => 'Fête',
            'Gala' => 'Gala',
            'Cérémonie' => 'Cérémonie',
            'Autre' => 'Autre'
        ];
    }
    
    /**
     * Liste des types d'événements avec leurs icônes et couleurs
     */
    public static function getEventTypeIcons()
    {
        return [
            'Mariage' => ['icon' => 'la-heart', 'color' => 'bg-danger'],
            'Anniversaire' => ['icon' => 'la-birthday-cake', 'color' => 'bg-success'],
            'Conférence' => ['icon' => 'la-microphone', 'color' => 'bg-primary'],
            'Séminaire' => ['icon' => 'la-chalkboard-teacher', 'color' => 'bg-info'],
            'Réunion d\'affaires' => ['icon' => 'la-briefcase', 'color' => 'bg-warning'],
            'Fête' => ['icon' => 'la-glass-cheers', 'color' => 'bg-warning'],
            'Gala' => ['icon' => 'la-star', 'color' => 'bg-dark'],
            'Cérémonie' => ['icon' => 'la-award', 'color' => 'bg-primary'],
            'Autre' => ['icon' => 'la-calendar-day', 'color' => 'bg-secondary']
        ];
    }
} 