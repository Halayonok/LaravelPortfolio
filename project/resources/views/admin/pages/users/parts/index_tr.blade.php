<?php
/**
 * @var \App\Users $model
 */
?>

@if(isset($model) && $model instanceof \App\Users)
    <tr id="tr_model_{{ $model->id }}">

        <td>{{ $model->name }}</td>

        <td>{{ $model->email }}</td>

        <td class="text-right">
            <a class="btn btn-sm btn-circle btn-info " href="{{ route('admin-users-update', ['id' => $model->id]) }}"><i
                    class="fas fa-edit"></i></a>

            <button class="btn btn-sm btn-circle btn-danger init_delete_model"
                    data-product-id="{{ $model->id }}"
                    data-toggle="modal" data-target="#delete_modal"
                    data-delete-action="{{ route('admin-users-delete', ['id' => $model->id]) }}"
                    data-delete-title="Пользователь {{ $model->name }}"
            >
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>

    </tr>
@endif
