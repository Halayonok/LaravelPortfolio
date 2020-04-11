<?php

namespace App;

use App\Services\LocalisationService\LocalisationToggleService;
use App\Services\ToggleModelService\EnabledModelInterface;
use App\Services\ToggleModelService\ToggleStatusModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tags extends Model implements EnabledModelInterface
{
    use ToggleStatusModelTrait;

    protected $table = 'tags';

    protected $dataModel = TagsData::class;

    public $timestamps = false;

    protected $fillable = [
        'back_name',
        'enable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Projects::class,'projects_tags', 'tag_id', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function data()
    {
        return $this->hasMany($this->dataModel, 'model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function localization()
    {
        $language = (new LocalisationToggleService)->getSessionLanguage();

        return $this->hasOne($this->dataModel, 'model_id')->where('language', $language);
    }

    public function builder(Request $request)
    {
        $this->back_name = $request->post('back_name');
        $this->enable = (int)filter_var($request->post('enable'), FILTER_VALIDATE_BOOLEAN) ?? self::$enableFlag;

        DB::beginTransaction();

        $status = $this->save() && $this->saveData($request);
        $status = isset($this->id) && $status;

        if ($status) {
            DB::commit();
        } else {
            DB::rollBack();
        }

        return $status;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function saveData(Request $request): bool
    {
        $insertData = [];

        foreach (LocalisationToggleService::getLanguages() as $language) {
            $insertData[] = [
                'model_id' => $this->id,
                'language' => $language,
                'title' => $request->post('title_' . $language) ?? $this->back_name,
            ];
        }

        if (empty($insertData)) {
            return true;
        }

        return $this->dataModel::replace($insertData) !== false;
    }
}
