<?php
/**
 * @var \App\Services\ToggleModelService\EnabledModelInterface $model
 */
?>
@if(isset($model) && $model instanceof \App\Services\ToggleModelService\EnabledModelInterface)
    <span
            id="enable_badge_{{ $model->getId() }}"

            data-action="{{ route('toggle-model-status') }}"
            data-model-id="{{ $model->getId() }}"
            data-model-class="{{ get_class($model) }}"

            class="badge_toggle_enable badge badge-{{ $model->enable ? 'success' : 'danger' }}"

    >{{ $model->enable ? 'вкл' : 'выкл' }}</span>
@endif
