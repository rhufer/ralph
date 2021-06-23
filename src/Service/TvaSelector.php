<?php

namespace App\Service;

class TvaSelector
{
    public function getTauxTva(float $price){
        return $price*0.20;    
    }

    
}


