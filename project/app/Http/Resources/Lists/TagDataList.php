<?php

namespace App\Http\Resources\Lists;

use App\Http\Resources\Entity\Episode;
use App\Http\Resources\Entity\Preview;
use App\Http\Resources\Entity\ProjectsScreenshot;
use App\Http\Resources\Entity\Tag;
use App\Http\Resources\Entity\TagData;
use App\Http\Resources\MyResourceCollection;
use App\ProjectsData;

class TagDataList extends MyResourceCollection
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return TagData::collection($this->collection);
    }
}
