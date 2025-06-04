<?php

namespace Siza\S3Service;

use Illuminate\Support\Facades\Facade;

class SiZAS3ServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sizas3service';
    }
}