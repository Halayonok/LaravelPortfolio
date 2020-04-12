<?php
/**
 * @var \App\Languages $model
 */
?>

@if(isset($model) && $model instanceof \App\Languages)
    <tr id="tr_model_{{ $model->id }}">
        <td class="text-center">{{ strtoupper($model->code) }}</td>
        <td class="text-center">{!! $model->isMain() ? '<button class="btn btn-success btn-circle btn-supersm"><i class="fas fa-check"></i></button>' : '' !!}</td>
        <td class="text-center">
            @include('admin.parts.list_enable_trigger')
        </td>

        <td class="text-right">
            <a class="btn btn-sm btn-circle btn-info"
               href="{{ route('admin-languages-update', ['id' => $model->id]) }}"><i
                    class="fas fa-edit"></i></a>

            <button class="btn btn-sm btn-circle btn-danger init_delete_model"
                    data-product-id="{{ $model->id }}"
                    data-toggle="modal" data-target="#delete_modal"
                    data-delete-action="{{ route('admin-languages-delete', ['id' => $model->id]) }}"
                    data-delete-title="Язык {{ $model->code }}"
            ><i class="fas fa-trash"></i></button>
        </td>
    </tr>
@endif
