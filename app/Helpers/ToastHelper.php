<?php

namespace App\Helpers;

class ToastHelper
{
    /**
     * Générer un tableau de configuration pour un toast.
     *
     * @param string $type success|error|warning|info
     * @param string $message Message à afficher
     * @return array
     */
    public static function make(string $type, string $message): array
    {
        return [
            'type' => $type,
            'message' => $message
        ];
    }
    
    /**
     * Générer un toast de succès.
     *
     * @param string $message
     * @return array
     */
    public static function success(string $message): array
    {
        return self::make('success', $message);
    }
    
    /**
     * Générer un toast d'erreur.
     *
     * @param string $message
     * @return array
     */
    public static function error(string $message): array
    {
        return self::make('error', $message);
    }
    
    /**
     * Générer un toast d'avertissement.
     *
     * @param string $message
     * @return array
     */
    public static function warning(string $message): array
    {
        return self::make('warning', $message);
    }
    
    /**
     * Générer un toast d'information.
     *
     * @param string $message
     * @return array
     */
    public static function info(string $message): array
    {
        return self::make('info', $message);
    }
} 