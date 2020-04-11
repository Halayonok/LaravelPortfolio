<?php

namespace App;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use jdavidbakr\ReplaceableModel\ReplaceableModel;

class ProjectsData extends Model
{
    use HasCompositePrimaryKey, ReplaceableModel;

    protected $table = 'projects_data';

    protected $primaryKey = ['model_id', 'language'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'model_id',
        'language_id',
        'title',
        'content',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Projects::class, 'model_id');
    }
}
