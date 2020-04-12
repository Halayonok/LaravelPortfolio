<?php

namespace App\Http\Resources\Entity;

use App\Http\Resources\MyJsonResource;

class TagData extends MyJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'links' => [
                'related' => null //project route
            ],
            'data' => [
                'type' => 'tag_data',
                'id' => $this->model_id . '_' . $this->language_id,
                'attributes' => [
                    'language_id' => $this->language_id,
                    'title' => $this->title,
                ]
            ]
        ];
    }
}
