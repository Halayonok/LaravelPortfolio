<?php

namespace App;

use App\Services\LocalisationService\LocalisationToggleService;
use App\Services\ToggleModelService\EnabledModelInterface;
use App\Services\ToggleModelService\ToggleStatusModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Projects extends Model implements EnabledModelInterface
{
    use ToggleStatusModelTrait;

    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_SUCCESS = 'success';

    protected $table = 'projects';

    /** @var ProjectsData */
    protected $dataModel = ProjectsData::class;

    protected $fillable = [
        'back_name',
        'link',
        'status',
        'enable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tags::class,'projects_tags', 'project_id', 'tag_id');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function screenshots()
    {
        return $this->hasMany(ProjectsScreenshots::class, 'project_id');
    }

    /**
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_SUCCESS,
            self::STATUS_IN_PROGRESS
        ];
    }

    /**
     * @param Request $request
     * @return bool
     * @throws \Throwable
     */
    public function builder(Request $request)
    {
        $this->back_name = $request->post('back_name');
        $this->link = $request->post('link');
        $this->status = $request->post('status');
        $this->enable = (int)filter_var($request->post('enable'), FILTER_VALIDATE_BOOLEAN) ?? self::$enableFlag;

        DB::beginTransaction();

        $status =
            $this->save() &&
            $this->saveData($request) &&
            $this->updateScreenshots($request->file('screenshots') ?? []) &&
            $this->updateTags($request->post('tags_ids') ?? []);

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
                'title' => $request->post('title_' . $language->id) ?? $this->back_name,
                'content' => $request->post('content_' . $language->id) ?? null,
                'meta_title' => $request->post('meta_title_' . $language->id) ?? null,
                'meta_keywords' => $request->post('meta_keywords_' . $language->id) ?? null,
                'meta_description' => $request->post('meta_description_' . $language->id) ?? null,
            ];
        }

        if (empty($insertData)) {
            return true;
        }

        return $this->dataModel::replace($insertData) !== false;
    }

    /**
     * @param array $screenshots
     * @return bool
     */
    public function updateScreenshots(array $screenshots = []): bool
    {
        if (empty($this->id) || empty($screenshots)) {
            return true;
        }

        return ProjectsScreenshots::updateScreenshots($screenshots, $this);
    }


    /**
     * @param array $tagsIds
     * @return bool
     */
    public function updateTags(array $tagsIds = []): bool
    {
        ProjectsTags::whereProjectId($this->id)->delete();
        if (empty($tagsIds)) {
            return true;
        }

        $tags = Tags::whereIn('id', $tagsIds)->whereEnable(Tags::$enableFlag)->get();

        $ids = [];
        foreach ($tags as $tag) {
            $ids[] = $tag->id;
        }

        $insert = [];
        foreach ($ids as $id) {
            $insert[] = [
                'project_id' => $this->id,
                'tag_id' => $id
            ];
        }

        if (!count($insert)) {
            return true;
        }

        return ProjectsTags::replace($insert) !== false;
    }
}
