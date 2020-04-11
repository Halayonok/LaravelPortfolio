<?php

namespace App\Services\FilesService;

class FilesService
{
    const UPLOADS_FOLDER = 'uploads';

    const ICONS_FOLDER = 'icons';

    const BANNERS_FOLDER = 'banners';

    const SCREENSHOTS_FOLDER = 'screenshots';

    public static $service = null;

    public static function getUploadsFolderPath($folder = null)
    {
        return public_path($folder ?? '');
    }

    /**
     * @return FilesService
     */
    public static function getService(): FilesService
    {
        if (!self::$service instanceof self) {
            self::$service = new self();
        }

        return self::$service;
    }


    /**
     * @param $path
     * @param MyUploadedFile $file
     * @param $prefix
     * @return bool|false|string
     */
    public function saveFile($path, MyUploadedFile $file, $prefix = null)
    {
        $path = $file->store($path, [], $prefix);
        if (!$path) {
            return false;
        }

        return $path;
    }

    public function subFolderPath(string $folder): string
    {
        return FilesService::UPLOADS_FOLDER . DIRECTORY_SEPARATOR . $folder;
    }
}
