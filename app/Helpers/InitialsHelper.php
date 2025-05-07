<?php

namespace App\Helpers;

class InitialsHelper
{
    /**
     * Génère les initiales à partir d'un nom
     * 
     * @param string|null $name Le nom dont on veut extraire les initiales
     * @return string Les initiales en majuscules
     */
    public static function generate(?string $name): string
    {
        if (!$name) return '';
        
        $words = explode(' ', $name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= mb_substr($word, 0, 1);
            }
        }
        
        return mb_strtoupper($initials);
    }
    
    /**
     * Génère un badge d'avatar avec les initiales
     * 
     * @param string|null $name Le nom dont on veut extraire les initiales
     * @param string $bgClass Classe CSS de l'arrière-plan (par défaut: bg-blue-100)
     * @param string $textClass Classe CSS du texte (par défaut: text-blue-600)
     * @return string HTML du badge d'avatar
     */
    public static function avatarBadge(?string $name, string $bgClass = 'bg-blue-100', string $textClass = 'text-blue-600'): string
    {
        $initials = self::generate($name);
        
        return '<div class="relative flex items-center justify-center w-10 h-10 overflow-hidden ' . $bgClass . ' rounded-full">
                    <span class="font-bold ' . $textClass . '">' . $initials . '</span>
                </div>';
    }
} 