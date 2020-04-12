<?php

namespace App\Http\Resources\Entity;

use App\Http\Resources\Lists\ProjectsDataList;
use App\Http\Resources\Lists\ProjectsScreenshotsList;
use App\Http\Resources\MyJsonResource;

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
        $response = [
            'links' => [
                'self' => null,
            ],
            'data' => [
                'type' => 'project',
                'id' => $this->id,
                'attributes' => [
                    'link' => $this->link,
                    'status' => $this->status,
                ]
            ]
        ];

        if (isset($this->relations['screenshots'])) {
            $response['relationships']['screenshots'] = new ProjectsScreenshotsList($this->relations['screenshots']);
        }

        if (isset($this->relations['data'])) {
            $response['relationships']['data'] = new ProjectsDataList($this->relations['data']);
        }

        return $response;
    }
}
