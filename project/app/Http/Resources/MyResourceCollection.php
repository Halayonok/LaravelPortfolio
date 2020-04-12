<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MyResourceCollection extends ResourceCollection
{

    public function __construct($resource)
    {
        parent::__construct($resource);
        parent::withoutWrapping();
    }
}