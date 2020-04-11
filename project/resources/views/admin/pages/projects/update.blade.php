@extends('admin.layouts.base')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item"><a href="{{ route('admin-projects') }}">Проекты</a></li>
            <li class="breadcrumb-item active">Редактировать проект "{{ $model->back_name }}"</li>
        </ol>
    </nav>

    <div class="card">
        <!--Card content-->
        <div class="card-body">
            <div class="row m-0">
                <div class="col-12 p-0">
                    @include('admin.pages.projects._form')
                </div>
            </div>
        </div>
    </div>

@endsection
