@if(isset($model) && $model instanceof \App\Services\ToggleModelService\EnabledModelInterface)
    <span
            id="enable_badge_{{ $model->id }}"

            data-action="{{ route('toggle-model-status') }}"
            data-model-id="{{ $model->id }}"
            data-model-class="{{ get_class($model) }}"

            class="badge_toggle_enable badge badge-pill {{ $model->enable ? 'success' : 'danger' }}-color"

    >{{ $model->enable ? 'вкл' : 'выкл' }}</span>
@endif
