<?php

namespace App\Http\Resources\Entity;

use App\Http\Resources\Lists\TagDataList;
use App\Http\Resources\MyJsonResource;

class Tag extends MyJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'data' => [
                'type' => 'tag',
                'id' => $this->id,
            ]
        ];

        if (isset($this->relations['data'])) {
            $response['relationships']['data'] = new TagDataList($this->relations['data']);
        }

        return $response;
    }
}
