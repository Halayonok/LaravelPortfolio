<?php

namespace App\Http\Resources\Entity;

use App\Http\Resources\Lists\ProjectsScreenshots;
use App\Http\Resources\Lists\RatingsList;
use App\Http\Resources\Lists\ReviewsList;
use App\Http\Resources\MyJsonResource;
use App\Services\FilesService\FilesService;

class Project extends MyJsonResource
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
                'type' => 'projects_data',
                'id' => $this->model_id . '_' . $this->language_id,
                'attributes' => [
                    'language_id' => $this->language_id,
                    'title' => $this->title,
                    'content' => $this->content,
                    'meta_title' => $this->meta_title,
                    'meta_keywords' => $this->meta_keywords,
                    'meta_description' => $this->meta_description,
                ]
            ]
        ];
    }
}
