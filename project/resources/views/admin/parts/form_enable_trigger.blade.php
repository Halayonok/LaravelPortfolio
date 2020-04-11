@php

$enable = \App\Services\ToggleModelService\ToggleStatusModelTrait::$enableFlag;

$disable = \App\Services\ToggleModelService\ToggleStatusModelTrait::$disableFlag;

if (isset($model) && $model instanceof \App\Services\ToggleModelService\EnabledModelInterface) {
    $toggleModel = $model;
}

@endphp

<div class="form-group">
    <div class="label small">Статус</div>

    <select name="enable" class="form-control form-control-sm">
        <option
            value="{{ $enable }}" {{ isset($toggleModel) && $enable === (int)$toggleModel->enable ? 'selected' : '' }}>
            Вкл
        </option>
        <option
            value="{{ $disable }}" {{ isset($toggleModel) && $disable === (int)$toggleModel->enable ? 'selected' : '' }}>
            Выкл
        </option>
    </select>
</div>
