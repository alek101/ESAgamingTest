<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Corrector extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public static function correctArmySize($numberOfUnits)
    {
        
        if($numberOfUnits<80)
        {
            $numberOfUnits=80;
        }
        if($numberOfUnits>100)
        {
            $numberOfUnits=100;
        }

        return $numberOfUnits;
    }

    public static function correctStrategy($strategy)
    {
        if($strategy!='random' or $strategy!='weak' or $strategy!='strong')
        {
            $strategy='random';
        }
        
        return $strategy;
    }
}
