<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class GetValidImagesHelper
{
  /**
     * Vérifie et retourne les photos valides d'un modèle
     * 
     * @param mixed $model
     * @param array $photoFields
     * @return array
     */
  public static function getValidImages($model, array $photoFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'])
  {
    $validPhotos = [];
        
        foreach ($photoFields as $field) {
            if (!empty($model->$field)) {
                $validPhotos[$field] = $model->$field;
            }
        }
        
        return $validPhotos;
  }
   /**
     * Vérifie si une photo spécifique est valide
     * 
     * @param mixed $model
     * @param string $field
     * @return bool
     */
    public static function isValidPhoto($model, $field)
    {
        return !empty($model->$field);
    }
}
