<?php

namespace App\Http\Resources\Entity;

use App\Http\Resources\MyJsonResource;

class ProjectsScreenshot extends MyJsonResource
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
                'type' => 'projects_screenshot',
                'id' => $this->id,

                'attributes' => [
                    'src' => asset($this->response->assetPath()),
                    'main' => $this->main,
                    'order' => $this->order,
                ]
            ]
        ];
    }
}
