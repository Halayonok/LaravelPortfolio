<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyJsonResource extends JsonResource
{

    protected $relations = [];

    public function __construct($resource)
    {
        parent::__construct($resource);
        parent::withoutWrapping();

        $this->relations = $this->getRelations();
    }
}
