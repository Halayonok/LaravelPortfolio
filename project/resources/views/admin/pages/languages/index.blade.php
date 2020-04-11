@extends('admin.layouts.base')

<?php
/**
 * @var \App\Languages[] $models
 */
?>

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item">Система</li>
            <li class="breadcrumb-item active"><a href="{{ route('admin-languages') }}">Локализация</a></li>
        </ol>
    </nav>

    <div class="card shadow mb-4">

        <div class="card-header py-2">
            <div class="row">
                <div class="col-6 p-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold ">Локализация</h6>
                </div>

                <div class="col-6 p-0 d-flex align-items-center justify-content-end">
                    <a class="btn btn-info btn-sm" href="{{ route('admin-languages-create') }}">
                        <i class="fas fa-plus-circle"></i>
                        Добавить язык
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="row m-0 p-0">
                <div class="col-12 p-0">
                    <table class="dataTable table table-hover table-sm">
                        <thead>
                        <th>Код</th>
                        <th>Главный</th>
                        <th class="text-center">Статус</th>
                        <th></th>
                        </thead>

                        <tbody>
                        @foreach($models as $model)
                            <tr>
                                <td>{{ $model->code }}</td>
                                <td>{{ $model->isMain() ? 'Главный' : '' }}</td>
                                <td class="text-center">
                                    @include('admin.parts.list_enable_trigger')
                                </td>

                                <td class="text-right">
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('admin-languages-update', ['id' => $model->id]) }}"><i
                                            class="fas fa-edit"></i></a>

                                    <button class="btn btn-danger btn-sm init_delete_model"
                                            data-product-id="{{ $model->id }}"
                                            data-toggle="modal" data-target="#delete_modal"
                                            data-delete-action="{{ route('admin-languages-delete', ['id' => $model->id]) }}"
                                            data-delete-title="Язык {{ $model->code }}"
                                    ><i
                                            class="fas fa-trash-alt"></i></button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
