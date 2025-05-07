<?php

namespace App\Helpers;

class BookingStatusHelper
{
    /**
     * Retourne les informations de style pour un statut de réservation donné
     * 
     * @param string $status Le statut de la réservation
     * @return array Un tableau avec les classes CSS et l'icône
     */
    public static function getStatusStyle($status)
    {
        $styles = [
            'pending' => [
                'bg' => 'bg-gray-100',
                'text' => 'text-gray-600',
                'icon' => 'clock',
                'label' => 'En attente'
            ],
            'cancelled' => [
                'bg' => 'bg-red-100',
                'text' => 'text-red-800',
                'icon' => 'x-circle',
                'label' => 'Annulée'
            ],
            'booked' => [
                'bg' => 'bg-blue-100',
                'text' => 'text-blue-800',
                'icon' => 'refresh-cw',
                'label' => 'Réservée'
            ],
            'accepted' => [
                'bg' => 'bg-purple-100',
                'text' => 'text-purple-800',
                'icon' => 'check',
                'label' => 'Acceptée'
            ],
            'declined' => [
                'bg' => 'bg-orange-100',
                'text' => 'text-orange-800',
                'icon' => 'thumbs-down',
            'label' => 'Refusée'
            ],
            'completed' => [
                'bg' => 'bg-green-100',
                'text' => 'text-green-800',
                'icon' => 'check-circle',
                'label' => 'Complétée'
            ],
            'refunded' => [
                'bg' => 'bg-yellow-100',
                'text' => 'text-yellow-800',
                'icon' => 'refresh-cw',
                'label' => 'Remboursée'
            ]
        ];

        return $styles[$status] ?? $styles['pending'];
    }

    /**
     * Retourne le HTML du badge pour un statut donné
     * 
     * @param string $status Le statut de la réservation
     * @return string Le HTML du badge
     */
    public static function getStatusBadge($status)
    {
        $style = self::getStatusStyle($status);
        
        return '<span class="' . $style['bg'] . ' ' . $style['text'] . ' text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center w-fit">
                    <i data-lucide="' . $style['icon'] . '" class="w-3 h-3 mr-1"></i>
                    ' . $style['label'] . '
                </span>';
    }
    public static function getPaymentStatusMessage($status)
    {
        $message = [
            'completed' => 'Payé',
            'pending' => 'En attente',
            'refunded' => 'Remboursé',
            'cancelled' => 'Annulé',
            'booked' => 'En attente de paiement',
            'accepted' => 'En attente de confirmation par l\'utilisateur',
            
        ];
        return $message[$status] ?? $message['pending'];
    }
} 