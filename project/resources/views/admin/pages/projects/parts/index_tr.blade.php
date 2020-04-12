<?php
/**
 * @var \App\Projects $model
 */
?>

@if(isset($model) && $model instanceof \App\Projects)
    <tr id="tr_model_{{ $model->id }}">
        <td>
            {{ $model->back_name }}
        </td>
        <td>
            {{ $model->status ?? null }}
        </td>
        <td class="text-center">
            @include('admin.parts.list_enable_trigger')
        </td>

        <td class="text-right">
            <a class="btn btn-sm btn-circle btn-info" href="{{ route('admin-projects-update', ['id' => $model->id]) }}">
                <i class="fas fa-edit"></i>
            </a>
            <button class="btn btn-sm btn-circle btn-danger init_delete_model"
                    data-toggle="modal"
                    data-target="#delete_modal"
                    data-delete-action="{{ route('admin-projects-delete', ['id' => $model->id]) }}"
                    data-delete-title="Проект {{ $model->back_name }}"
            >
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
@endif
