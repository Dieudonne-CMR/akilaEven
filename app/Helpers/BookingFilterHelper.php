<?php

namespace App\Helpers;

class BookingFilterHelper
{
    /**
     * Retourne les informations de style pour un filtre de statut de réservation
     * 
     * @param string $status Le statut de la réservation
     * @return array Un tableau avec les classes CSS et l'icône
     */
    public static function getFilterStyle($status)
    {
        $styles = [
            'all' => [
                'icon' => 'list',
                'dot_class' => 'hidden',
                'label' => 'Toutes les réservations'
            ],
            'pending' => [
                'icon' => 'clock',
                'dot_class' => 'bg-gray-300',
                'label' => 'En attente'
            ],
            'cancelled' => [
                'icon' => 'x-circle',
                'dot_class' => 'bg-red-500',
                'label' => 'Annulées'
            ],
            'booked' => [
                'icon' => 'lock',
                'dot_class' => 'bg-blue-500',
                'label' => 'Réservées'
            ],
            'accepted' => [
                'icon' => 'check',
                'dot_class' => 'bg-purple-500',
                'label' => 'Acceptées'
            ],
           
            'completed' => [
                'icon' => 'check-circle',
                'dot_class' => 'bg-green-500',
                'label' => 'Complétées'
            ],
            'refunded' => [
                'icon' => 'refresh-cw',
                'dot_class' => 'bg-yellow-500',
                'label' => 'Remboursées'
            ]
        ];

        return $styles[$status] ?? $styles['pending'];
    }

    /**
     * Génère une liste de filtres pour les statuts de réservation
     * 
     * @return array La liste des statuts avec leurs styles
     */
    public static function getFiltersList()
    {
        $statuses = ['all', 'pending', 'accepted', 'booked', 'completed', 'cancelled', 'refunded'];
        $filters = [];
        
        foreach ($statuses as $status) {
            $filters[$status] = self::getFilterStyle($status);
        }
        
        return $filters;
    }
} 