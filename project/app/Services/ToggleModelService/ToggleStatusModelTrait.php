<?php

namespace App\Services\ToggleModelService;

trait ToggleStatusModelTrait
{
    public static $enableFlag = 1;

    public static $disableFlag = 0;

    /**
     * @return bool
     */
    public function toggleStatus(): bool
    {
        return $this->update([
            'enable' => !$this->enable
        ]);
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (int)$this->enable === self::$enableFlag;
    }

    public function getPrimaryName()
    {
        return $this->primaryKey;
    }

    public function getId()
    {
        $primaryName = $this->getPrimaryName();

        return $this->$primaryName;
    }
}
