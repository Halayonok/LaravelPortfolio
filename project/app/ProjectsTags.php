<?php

namespace App;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use jdavidbakr\ReplaceableModel\ReplaceableModel;

class ProjectsTags extends Model
{
    use HasCompositePrimaryKey, ReplaceableModel;

    protected $table = 'projects_tags';

    protected $primaryKey = ['project_id', 'tag_id'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'project_id', 'tag_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Projects::class, 'tag_id');
    }
}
