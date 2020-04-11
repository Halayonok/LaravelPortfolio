<?php

namespace App\Services\LocalisationService;

interface LocalizedModelInterface
{
    public function getLocalizedDataTableName(): string;

    public function getLocalizedData();
}