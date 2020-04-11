@extends('admin.layouts.base')

<?php
/**
 * @var \App\Projects[] $models
 */
?>

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item">Портфолио</li>
            <li class="breadcrumb-item active"><a href="{{ route('admin-projects') }}">Проекты</a></li>
        </ol>
    </nav>

    <div class="card shadow mb-4">

        <div class="card-header py-2">
            <div class="row">
                <div class="col-6 p-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold ">Проекты</h6>
                </div>

                <div class="col-6 p-0 d-flex align-items-center justify-content-end">
                    <a class="btn btn-info btn-sm" href="{{ route('admin-projects-create') }}">
                        <i class="fas fa-plus-circle"></i>
                        Добавить проект
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Разработка</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($models as $model)
                        @include('admin.pages.projects.parts.index_tr')
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
