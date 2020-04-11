<?php

namespace App;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use jdavidbakr\ReplaceableModel\ReplaceableModel;

class TagsData extends Model
{
    use HasCompositePrimaryKey, ReplaceableModel;

    protected $table = 'tags_data';

    protected $primaryKey = ['model_id', 'language'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'model_id',
        'language_id',
        'title',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tags::class, 'model_id');
    }
}
