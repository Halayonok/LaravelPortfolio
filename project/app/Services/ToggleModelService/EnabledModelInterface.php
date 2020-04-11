<?php

namespace App\Services\ToggleModelService;

interface EnabledModelInterface {

    public function toggleStatus(): bool;

    public function isEnabled(): bool;

    public function getPrimaryName();

    public function getId();
}
