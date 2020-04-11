<?php

namespace App\Services\FilesService;

use App\MediaFiles;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;

class MyUploadedFile extends UploadedFile
{
    /**
     * @param string $path
     * @param array $options
     * @param null $prefix
     * @return false|string
     */
    public function store($path, $options = [], $prefix = null)
    {
        return $this->storeAs($path, $this->hashName(null, $prefix), $this->parseOptions($options));
    }

    /**
     * @param null $path
     * @param null $prefix
     * @return string
     */
    public function hashName($path = null, $prefix = null)
    {
        if ($path) {
            $path = rtrim($path, '/').'/';
        }

        if (isset($this->hashName)) {
            $hash = $this->hashName;
        } else {
            $str = \Str::random(40);
            $hash = isset($prefix) ? $prefix . '_' . $str : $str;
        }

        if ($extension = $this->guessExtension()) {
            $extension = '.'.$extension;
        }

        return $path.$hash.$extension;
    }

    /**
     * Returns the extension based on the mime type.
     *
     * If the mime type is unknown, returns null.
     *
     * This method uses the mime type as guessed by getMimeType()
     * to guess the file extension.
     *
     * @return string|null The guessed extension or null if it cannot be guessed
     *
     * @see ExtensionGuesser
     * @see getMimeType()
     */
    /*public function guessExtension()
    {
        $type = $this->getClientMimeType();
        if ($type === MediaFiles::TYPE_AAC) {
            $type = MediaFiles::TYPE_X_AAC;
        }

        if (!in_array($type, [MediaFiles::TYPE_X_AAC, MediaFiles::TYPE_AAC])) {
            $type = $this->getMimeType();
        }

        $guesser = ExtensionGuesser::getInstance();

        return $guesser->guess($type);
    }*/
}
