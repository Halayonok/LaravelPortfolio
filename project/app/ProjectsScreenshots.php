<?php

namespace App;

use App\Services\FilesService\FilesService;
use App\Services\FilesService\MyUploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use jdavidbakr\ReplaceableModel\ReplaceableModel;

class ProjectsScreenshots extends Model
{
    use ReplaceableModel;

    const MAIN = 1;

    const NOT_MAIN = 0;

    protected $table = 'projects_screenshots';

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'src',
        'order',
        'main'
    ];

    /**
     * @param $previews
     * @param Projects $project
     * @return bool
     */
    public static function updateScreenshots($previews, Projects $project)
    {
        if (!is_array($previews)) {
            return true;
        }

        if (!count($previews)) {
            return true;
        }

        $self = new self();

        $replace = [];
        foreach ($previews as $idx => $preview) {
            if (!$preview instanceof UploadedFile) {
                continue;
            }

            $src = $self->saveFile($preview, $project);
            if (!$src) {
                continue;
            }

            $replace[] = [
                'project_id' => $project->id,
                'src' => $src,
                'order' => (int)$idx,
                'main' => !$idx ? self::MAIN : self::NOT_MAIN
            ];
        }

        if (self::replace($replace) === false) {
            return false;
        }

        return true;
    }

    /**
     * @param UploadedFile $file
     * @param Projects $project
     * @return bool
     */
    public function saveFile(UploadedFile $file, Projects $project): bool
    {
        if (!isset($application->id)) {
            return false;
        }

        $prefix = 'project_screenshot_' . $project->id;

        $fileService = FilesService::getService();

        return $fileService->saveFile($fileService::SCREENSHOTS_FOLDER, MyUploadedFile::createFromBase($file), $prefix);
    }

    /**
     * @return string
     */
    public function assetPath(): string
    {
        return \App\Services\FilesService\FilesService::UPLOADS_FOLDER . DIRECTORY_SEPARATOR . $this->src;
    }
}
