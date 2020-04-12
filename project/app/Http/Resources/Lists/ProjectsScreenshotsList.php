<?php

namespace App\Http\Resources\Lists;

use App\Http\Resources\Entity\Episode;
use App\Http\Resources\Entity\Preview;
use App\Http\Resources\Entity\ProjectsScreenshot;
use App\Http\Resources\Entity\Tag;
use App\Http\Resources\MyResourceCollection;

class ProjectsScreenshotsList extends MyResourceCollection
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return ProjectsScreenshot::collection($this->collection);
    }
}
