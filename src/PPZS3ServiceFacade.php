<?php

namespace PPZ\S3Service;

use Illuminate\Support\Facades\Facade;

class PPZS3ServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ppzs3service';
    }
}